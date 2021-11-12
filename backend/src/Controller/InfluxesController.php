<?php
declare(strict_types=1);

namespace App\Controller;

use Carbon\Carbon;

/**
 * Influxes Controller
 *
 * @property \App\Model\Table\InfluxesTable $Influxes
 * @method \App\Model\Entity\Influx[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InfluxesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $influxes = $this->paginate($this->Influxes);

        $this->set(compact('influxes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $influx = $this->Influxes->newEmptyEntity();
        if ($this->request->is('post')) {
            $influx = $this->Influxes->patchEntity($influx, $this->request->getData());
            try {
                $this->Influxes->saveOrFail($influx);
                $this->Flash->success(__('流入マスタを追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('流入マスタを追加できませんでした。(' . $e->getMessage()));
            }
        }
        $this->set(compact('influx'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Influx id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $influx = $this->Influxes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $influx = $this->Influxes->patchEntity($influx, $data);
            try {
                $this->Influxes->saveOrFail($influx);
                $this->Flash->success(__('流入マスタを更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('流入マスタの更新に失敗しました。(' . $e->getMessage()));
            }
        }
        $this->set(compact('influx'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Influx id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $influx = $this->Influxes->get($id);
        $influx = $this->Influxes->patchEntity($influx, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        try {
            $this->Influxes->saveOrFail($influx);
            $this->Flash->success(__('流入マスタを削除しました。'));
            return $this->redirect(['action' => 'index']);
        } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
            $this->Flash->error(__('流入マスタの削除に失敗しました。(' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }
}
