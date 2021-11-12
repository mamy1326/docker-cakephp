<?php
declare(strict_types=1);

namespace App\Controller;

use Carbon\Carbon;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Areas');
        $this->loadModel('Prefectures');
        $this->loadModel('Influxes');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Areas', 'Prefectures', 'Influxes'],
        ];

        // 検索パラメータを取得
        $params = $this->request->getQuery() + [
            'name' => '',
            'tel' => '',
            'address' => '',
            'deleted' => 0,
        ];

        // 検索パラメータを保存
        $this->set('params', $params);

        $customers = $this->Customers->find();

        if ($params['name']) {
            $customers->where([
                'Customers.name LIKE' => '%' . addcslashes(trim($params['name']), '%_') . '%',
            ]);
        }
        if ($params['address']) {
            $customers->where([
                'OR' => [
                    ['Customers.address_1 LIKE ' => '%' . addcslashes(trim($params['address']), '%_') . '%'],
                    ['Customers.address_2 LIKE ' => '%' . addcslashes(trim($params['address']), '%_') . '%'],
                    ['Customers.address_3 LIKE ' => '%' . addcslashes(trim($params['address']), '%_') . '%'],
                ],
            ]);
        }
        if ($params['tel']) {
            $customers->where([
                'OR' => [
                    ['Customers.tel_1 LIKE ' => '%' . addcslashes(trim($params['tel']), '%_') . '%'],
                    ['Customers.tel_2 LIKE ' => '%' . addcslashes(trim($params['tel']), '%_') . '%'],
                    ['Customers.tel_3 LIKE ' => '%' . addcslashes(trim($params['tel']), '%_') . '%'],
                ],
            ]);
        }

        if ($params['deleted'] == 0) {
            $customers->where([
                'Customers.deleted IS NULL',
            ]);
        }

        $customers = $this->paginate($customers);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Areas', 'Prefectures', 'Influxes'],
        ]);

        // 案件情報を表示する

        $this->set(compact('customer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            try {
                $this->Customers->saveOrFail($customer);
                $this->Flash->success(__('顧客情報を追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('顧客情報を追加できませんでした。(' . $e->getMessage()));
            }
        }

        $areas = $this->Areas->find('list')->select(['id', 'name'])->where([
            function ($exp) {
                return $exp->isNull('deleted');
            },
        ]);
        $prefectures = $this->Prefectures->find('list')->select(['id', 'name'])->where([
            function ($exp) {
                return $exp->isNull('deleted');
            },
        ]);
        $influxes = $this->Influxes->find('list')->select(['id', 'name'])->where([
            function ($exp) {
                return $exp->isNull('deleted');
            },
        ]);
        $this->set(compact('customer', 'areas', 'prefectures', 'influxes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $customer = $this->Customers->patchEntity($customer, $data);
            try {
                $this->Customers->saveOrFail($customer);
                $this->Flash->success(__('顧客情報を更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('顧客情報を更新できませんでした。(' . $e->getMessage()));
            }
        }
        $areas = $this->Areas->find('list')->select(['id', 'name'])->where([
            function ($exp) {
                return $exp->isNull('deleted');
            },
        ]);
        $prefectures = $this->Prefectures->find('list')->select(['id', 'name'])->where([
            function ($exp) {
                return $exp->isNull('deleted');
            },
        ]);
        $influxes = $this->Influxes->find('list')->select(['id', 'name'])->where([
            function ($exp) {
                return $exp->isNull('deleted');
            },
        ]);
        $this->set(compact('customer', 'areas', 'prefectures', 'influxes'));
    }
}
