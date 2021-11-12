<?php
declare(strict_types=1);

namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use Cake\Event\EventInterface;
use Cake\Routing\Router;
use Carbon\Carbon;

class AuthController extends AppController
{
    private const LOGIN_HISTORY_MAX = 50;
    private $userId;

    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated(['loginView']);
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('LoginHistories');

        // ログイン済みの場合
        if (!empty($this->Authentication->getResult()->getData())) {
            $this->userId = $this->Authentication->getResult()->getData()->id;
            // ユーザー状態チェック、ログイン権限チェック
            //$this->checkStatus();
            //$this->checkAuthority();
        }
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function loginView()
    {
        // ログイン用の画面をLayoutで使用
        $this->viewBuilder()->setLayout('login_view');

        $result = $this->Authentication->getResult();

        // 認証成功
        if ($result->isValid()) {
            $this->saveVisited();   // ログイン日時
            $this->saveLoginHistory();  // ログイン履歴
            $this->deletePastLoginHistories();  // 過去のログイン履歴削除

            //            $target = $this->Authentication->getLoginRedirect() ?? '/home';
            $refererUrl = $this->Authentication->getLoginRedirect();
            $refererUrl = '/';
            return $this->redirect($refererUrl);
        }
        // ログインできなかった場合
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Email または パスワードが違います');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }

    /**
     * ログイン日時を記録
     *
     * @return void
     */
    private function saveVisited(): void
    {
        $userQuery = $this->Users->query();
        $userQuery->update()
        ->set(['visited' => Carbon::now()->format('Y-m-d H:i:s')])
        ->where(['id' => $this->userId])
        ->execute();
    }

    /**
     * ログイン履歴（最新50件）を保存
     *
     * @return void
     */
    private function saveLoginHistory(): void
    {
        $historyData = [
            'user_id' => $this->userId,
            'ip_address' => intval(ip2long(Router::getRequest()->clientIp())),
            'user_agent' => $this->request->getHeaderLine('User-Agent'),
        ];
        $newLoginHistory = $this->LoginHistories->newEntity($historyData);
        $this->LoginHistories->save($newLoginHistory);
    }

    /**
     * 古いログイン履歴を削除
     *
     * @return void
     */
    private function deletePastLoginHistories(): void
    {
        // 規定の件数に達したレコードの ID を取得
        // 規定件数を取得し、最後の行の ID より古いレコードを削除
        $lastLoginHistory = $this->LoginHistories->find()
        ->select(['id'])
        ->where(['user_id' => $this->userId])
        ->order(['id' => 'desc'])
        ->limit(self::LOGIN_HISTORY_MAX)
        ->toArray();

        if (count($lastLoginHistory) > self::LOGIN_HISTORY_MAX) {
            $loginHistoryId = $lastLoginHistory[self::LOGIN_HISTORY_MAX-1]['id'];
            $this->LoginHistories->deleteAll(['id < ' => $loginHistoryId]);
        }
    }

    /**
     * 古いログイン履歴を削除（1件）
     *
     * @return void
     */
    private function deletePastLoginHistory(): void
    {
        $lastLoginHistory = $query
        ->select([
            'id_min' => $query->func()->min('id'),
            'id_count' => $query->func()->max('id'),
        ])
        ->where(['user_id' => $this->userId])
        ->group(['user_id'])
        ->first();

        if ($lastLoginHistory['id_count'] > self::LOGIN_HISTORY_MAX) {
            $lastEntity = $this->LoginHistories->get($lastLoginHistory->id_min);
            $this->LoginHistories->delete($lastEntity);
        }
    }
}
