<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Mailer\TransportFactory;
use Cake\Routing\Router;
use Carbon\Carbon;
use App\Lib\Mail;

/**
 * PasswordReset Controller
 *
 * @property \App\Model\Table\PasswordResetTable $PasswordReset
 * @method \App\Model\Entity\PasswordReset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PasswordResetsController extends AppController
{
    /**
     * クラスの前処理
     * - 各種認証不要ページを設定
     */

    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated(['inputEmail', 'apply', 'accept', 'inputPassword', 'resetPassword', 'applyResetPassword']);
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('PasswordResets');

        $this->session = $this->getRequest()->getSession();
    }

    /**
     * パスワード再設定用メールアドレス入力
     * 入力のみのため無条件で表示
     *
     * @param void
     * @return void
     */
    public function inputEmail()
    {
        $this->viewBuilder()->setLayout('PasswordResets/input_email');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function apply()
    {
        if (!$this->request->is('post')) {
            $this->redirectLogin();
        }

        $params = $this->request->getData();
        $email = $params['email'];
        if (empty($email)) {
            return $this->redirect(['controller' => 'PasswordResets', 'action' => 'inputEmail']);
        }

        $user = $this->Users->find()
            ->where(['email ' => $email])
            ->toList();

        if (count($user) > 0) {
            $passwordResets = $this->PasswordResets->find()
                ->select(['id'])
                ->where(['email' => $email])
                ->first();

            if (!empty($passwordResets) && count($passwordResets->toArray()) > 0){
                // expireを更新するために、すでにテーブルに登録されていたら削除する
                $this->PasswordResets->delete($passwordResets);
            }
        } else {
            // 未登録のメールアドレスの場合は、なにもせずに結果画面を表示
            return $this->redirect(['controller' => 'PasswordResets', 'action' => 'accept']);
        }

        // DB登録値
        $token = bin2hex(random_bytes(32));
        $data['email'] = $email;
        $data['selector'] = bin2hex(random_bytes(8));
        $data['token'] = $token;    // password_hash 化は Entity で実施
        $data['expire'] = Carbon::now()->addHour(); // 有効期限 1時間

        // パスワードリセット用URL生成
        $url = Router::url(
            [
                'controller' => 'PasswordResets',
                'action' => 'inputPassword',
                '?' => [
                        'selector' => $data['selector'],
                        'token' => $token,
                    ],
            ],
            true);

        $passwordReset = $this->PasswordResets->newEntity($data);
        $this->PasswordResets->save($passwordReset);

        $mailer = new Mail();
        $mailer->sendMail(
            $email,
            'text/password_reset',
            'パスワード再発行のお知らせ',
            'text/plain',
            [
                'url' => $url,
            ]
        );

        return $this->redirect(['controller' => 'PasswordResets', 'action' => 'accept']);
    }

    public function accept()
    {
        $this->viewBuilder()->setLayout('PasswordResets/accept');
    }

    public function inputPassword()
    {
        // URL直接遷移なので get のみ
        if (!$this->request->is('get')) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        $this->viewBuilder()->setLayout('PasswordResets/input_password');

        $selector = $this->request->getQuery('selector');
        $token = $this->request->getQuery('token');
        $hasError = $this->request->getQuery('hasError');
        if (!empty($hasError)) {
            $this->viewBuilder()->setLayout('PasswordResets/input_password_error');
        }

        // パラメータなし
        if (empty($selector) || empty($token)) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        // レコードがない場合
        $passwordReset = $this->PasswordResets->findBySelector($selector)->first();
        if (empty($passwordReset)) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        // URL有効期限チェック
        if (Carbon::now()->gt(Carbon::parse($passwordReset->expire))) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        // token 検証
        if (!password_verify($token, $passwordReset->token)) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        // パスワード保存先を特定するために使うため、session 保存
        $this->session->write('email', $passwordReset->email);
    }

    public function resetPassword()
    {
        // URL直接遷移なので get のみ
        if (!$this->request->is('post')) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }
        $email = $this->session->read('email');
        $this->session->delete('email');
        if (empty($email)){
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        // email 認証
        $user = $this->Users->findByEmail($email)->select(['id'])->first();
        if (empty($user)) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }

        // パスワード更新できたら password_resets テーブルのレコードは消すので Entity 取得
        $passwordReset = $this->PasswordResets->findByEmail($email)->select(['id'])->first();

        // 入力されたパスワードを更新する Entity に反映
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($user->hasErrors()) {
            return $this->redirect($this->referer() . '&hasError=1');
        }

        // DB 保存処理
        // 確認用との一致は Validation に任せる
        $saveProcess = function () use ($user, $passwordReset) {
            // パスワード変更
            if (!$this->Users->save($user, ['atomic' => false])) {
                $this->Flash->error(__('パスワード変更に失敗しました。(users)'));
                return false;
            }

            // 不要になった password_resets のレコードを削除
            if (!$this->PasswordResets->delete($passwordReset)) {
                $this->Flash->error(__('パスワード変更に失敗しました。(password_resets)'));
                return false;
            }

            return true;
        };

        // トランザクションを実行
        $conn = $this->Users->getConnection();
        if (!$conn->transactional($saveProcess)) {
            // 失敗したらパスワード入力へ戻りエラーメッセージ表示
            return $this->redirect($this->referer() . '&hasError=1');
        }

        return $this->redirect(['controller' => 'PasswordResets', 'action' => 'applyResetPassword']);
    }

    public function applyResetPassword()
    {
        if (!$this->request->is('post')) {
//            return $this->redirect(['controller' => 'Auth', 'action' => 'loginView']);
        }
        $this->viewBuilder()->setLayout('PasswordResets/apply_reset_password');
    }
}
