<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Exception\PersistenceFailedException;
use Carbon\Carbon;

/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'logout']);
    }

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Users');
        $this->loadModel('Stores');
        $this->loadModel('Authorities');
        $this->loadModel('LoginHistories');
        $this->loadModel('UsersAuthorities');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $usersQuery = $this->Users->find()
        ->contain(['Stores', 'Authorities'])
        ->select([
            'id',
            'username',
            'email',
            'store_id',
            'visited',
            'created',
            'modified',
            'deleted',
            'Stores.name',
        ])
        ->order(['Users.id']);
        $users = $this->paginate($usersQuery);

        $this->set(compact('users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            // ダミーパスワード設定
            $dummyPassword = bin2hex(random_bytes(8));
            $user = $this->Users->patchEntity(
                $user,
                $this->request->getData() +
                [
                    'password' => $dummyPassword,
                    'password_check' => $dummyPassword
                ]
            );

            $saveProcess = function () use ($user) {
                try {
                    $this->Users->saveOrFail($user);

                    // 権限レコード作成
                    $usersAuthoritiesParams = [
                        'authority_id' => $this->request->getData('users_authorities.authority_id'),
                        'user_id' => $user->id,
                    ];
                    $usersAuthorities = $this->UsersAuthorities->newEntity($usersAuthoritiesParams);
                    $this->UsersAuthorities->saveOrFail($usersAuthorities);

                    $this->Flash->success(__('管理者を追加しました。'));
                    return $this->redirect(['action' => 'index']);
                } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                    $this->Flash->error(__('管理者の追加に失敗しました。(' . $e->getMessage()));
                    return false;
                }
                return true;
            };
    
            // トランザクションを実行
            $conn = $this->Users->getConnection();
            $conn->transactional($saveProcess);
        }

        $stores = $this->Stores->find('list')
        ->select(['id', 'name'])
        ->where(function ($exp) {
            return $exp->isNull('deleted');
        });

        $authorities = $this->Authorities->find('list')
        ->select(['id', 'name'])
        ->where(function ($exp) {
            return $exp->isNull('deleted');
        });

        $this->set(compact('user', 'stores', 'authorities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Authorities'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $user = $this->Users->patchEntity($user, $data);

            // DELETE-INSERT のため権限情報を取得
            $usersAuthorities = $this->UsersAuthorities->findByUserId($id)->select(['id'])->all();

            $saveProcess = function () use ($user, $usersAuthorities) {
                try {
                    $this->Users->saveOrFail($user);

                    // 管理者の権限登録
                    // DELETE-INSERT のため先に削除
                    $this->UsersAuthorities->deleteManyOrFail($usersAuthorities);

                    // 権限レコード作成
                    $usersAuthoritiesParams = [
                        'authority_id' => $this->request->getData('users_authorities.authority_id'),
                        'user_id' => $user->id,
                    ];
                    $usersAuthorities = $this->UsersAuthorities->newEntity($usersAuthoritiesParams);
                    $this->UsersAuthorities->saveOrFail($usersAuthorities);

                    $this->Flash->success(__('管理者を更新しました。'));
                    return $this->redirect(['action' => 'index']);
                } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                    $this->Flash->error(__('管理者の更新に失敗しました。(' . $e->getMessage()));
                    return false;
                }
                return true;
            };
    
            // トランザクションを実行
            $conn = $this->Users->getConnection();
            $conn->transactional($saveProcess);
        }

        $stores = $this->Stores->find('list')
        ->select(['id', 'name'])
        ->where(function ($exp) {
            return $exp->isNull('deleted');
        });

        $authorities = $this->Authorities->find('list')
        ->select(['id', 'name'])
        ->where(function ($exp) {
            return $exp->isNull('deleted');
        });

        $this->set(compact('user', 'stores', 'authorities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('管理者を削除しました。'));
        } else {
            $this->Flash->error(__('管理者の削除に失敗しました。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * 履歴閲覧
     *
     * @return \Cake\Http\Response|null
     */
    public function viewLogs(string $userId)
    {
        $loginHistories = $this->LoginHistories
        ->findByUserId($userId)
        ->select(
            [
                'user_id',
                'ip_address',
                'user_agent',
                'created',
                'Users.email',
            ]
        )
        ->join(
            [
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'INNER',
                'conditions' => 'LoginHistories.user_id = Users.id',
            ]
        )
        ->order(['LoginHistories.created' => 'DESC'])
        ->toArray();

        $this->set('loginHistories', $loginHistories);
    }
}
