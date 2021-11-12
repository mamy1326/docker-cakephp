<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JobsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Stores', 'Drivers', 'Influxes'],
        ];
        $jobs = $this->paginate($this->Jobs);

        $this->set(compact('jobs'));
    }

    /**
     * View method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $job = $this->Jobs->get($id, [
            'contain' => ['Customers', 'Stores', 'Drivers', 'Influxes'],
        ]);

        $this->set(compact('job'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $job = $this->Jobs->newEmptyEntity();
        if ($this->request->is('post')) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            try {
                $this->Jobs->saveOrFail($job);
                $this->Flash->success(__('案件情報を追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('案件情報を追加できませんでした。(' . $e->getMessage()));
            }
        }
        $customers = $this->Jobs->Customers->find('list')->where(['deleted is NULL']);
        $stores = $this->Jobs->Stores->find('list')->where(['deleted is NULL']);
        $drivers = $this->Jobs->Drivers->find('list')->where(['deleted is NULL']);
        $influxes = $this->Jobs->Influxes->find('list')->where(['deleted is NULL']);
        $this->set(compact('job', 'customers', 'stores', 'drivers', 'influxes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Job id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $job = $this->Jobs->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $job = $this->Jobs->patchEntity($job, $this->request->getData());
            try {
                $this->Jobs->saveOrFail($job);
                $this->Flash->success(__('案件情報を更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('案件情報を更新できませんでした。(' . $e->getMessage()));
            }
        }
        $customers = $this->Jobs->Customers->find('list')->where(['deleted is NULL']);
        $stores = $this->Jobs->Stores->find('list')->where(['deleted is NULL']);
        $drivers = $this->Jobs->Drivers->find('list')->where(['deleted is NULL']);
        $influxes = $this->Jobs->Influxes->find('list')->where(['deleted is NULL']);
        $this->set(compact('job', 'customers', 'stores', 'drivers', 'influxes'));
    }
}
