<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Exception\PersistenceFailedException;
use Carbon\Carbon;

/**
 * Drivers Controller
 *
 * @method \App\Model\Entity\Driver[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DriversController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Drivers');
        $this->loadModel('Stores');
        $this->loadModel('DriversStores');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $driversQuery = $this->Drivers->find()
        ->contain(['Stores'])
        ->select([
            'id',
            'name',
            'tel',
            'email',
            'description',
            'deleted',
            'created',
            'modified',
        ])
        ->order(['Drivers.id']);
        $drivers = $this->paginate($driversQuery);

        $this->set(compact('drivers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $driver = $this->Drivers->newEmptyEntity();
        if ($this->request->is('post')) {
            $saveProcess = function () use ($driver) {
                try {
                    $driver = $this->Drivers->patchEntity($driver, $this->request->getData());
                    $this->Drivers->saveOrFail($driver);

                    // 所属店舗レコード作成
                    $driversStoresParams = [
                        'store_id' => $this->request->getData('drivers_stores.store_id'),
                        'driver_id' => $driver->id,
                    ];
                    $driversStores = $this->DriversStores->newEntity($driversStoresParams);
                    $this->DriversStores->saveOrFail($driversStores);

                    $this->Flash->success(__('ドライバーを追加しました。'));
                    return $this->redirect(['action' => 'index']);
                } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                    $this->Flash->error(__('ドライバーの追加に失敗しました。(' . $e->getMessage()));
                    return false;
                }
                return true;
            };
    
            // トランザクションを実行
            $conn = $this->Drivers->getConnection();
            $conn->transactional($saveProcess);
        }

        $stores = $this->Stores->find('list')
        ->select(['id', 'name'])
        ->where(function ($exp) {
            return $exp->isNull('deleted');
        });

        $this->set(compact('driver', 'stores'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $driver = $this->Drivers->get($id, [
            'contain' => ['Stores'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $driver = $this->Drivers->patchEntity($driver, $data);

            // DELETE-INSERT のため権限情報を取得
            $driversStores = $this->DriversStores->findByDriverId($id)->select(['id'])->all();

            $saveProcess = function () use ($driver, $driversStores) {
                try {
                    $this->Drivers->saveOrFail($driver);

                    // 管理者の権限登録
                    // DELETE-INSERT のため先に削除
                    $this->DriversStores->deleteManyOrFail($driversStores);

                    // 権限レコード作成
                    $driversStoresParams = [
                        'store_id' => $this->request->getData('drivers_stores.store_id'),
                        'driver_id' => $driver->id,
                    ];
                    $driversStores = $this->DriversStores->newEntity($driversStoresParams);
                    $this->DriversStores->saveOrFail($driversStores);

                    $this->Flash->success(__('ドライバーを更新しました。'));
                    return $this->redirect(['action' => 'index']);
                } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                    $this->Flash->error(__('ドライバーの更新に失敗しました。(' . $e->getMessage()));
                    return false;
                }
                return true;
            };
    
            // トランザクションを実行
            $conn = $this->Drivers->getConnection();
            $conn->transactional($saveProcess);
        }

        $stores = $this->Stores->find('list')
        ->select(['id', 'name'])
        ->where(function ($exp) {
            return $exp->isNull('deleted');
        });

        $this->set(compact('driver', 'stores'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $driver = $this->Drivers->get($id);
        $driver = $this->Drivers->patchEntity($driver, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        if ($this->Drivers->save($driver)) {
            $this->Flash->success(__('ドライバーを削除しました。'));
        } else {
            $this->Flash->error(__('ドライバーの削除に失敗しました。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
