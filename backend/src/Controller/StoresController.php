<?php
declare(strict_types=1);

namespace App\Controller;

use Carbon\Carbon;

/**
 * Stores Controller
 *
 * @property \App\Model\Table\StoresTable $Stores
 * @method \App\Model\Entity\Store[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $stores = $this->paginate($this->Stores);

        $this->set(compact('stores'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $store = $this->Stores->newEmptyEntity();
        if ($this->request->is('post')) {
            $store = $this->Stores->patchEntity($store, $this->request->getData());
            try {
                $this->Stores->saveOrFail($store);
                $this->Flash->success(__('店舗を追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('店舗の追加に失敗しました。(' . $e->getMessage() . ')'));
            }
        }
        $this->set(compact('store'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $store = $this->Stores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $store = $this->Stores->patchEntity($store, $data);
            try {
                $this->Stores->saveOrFail($store);
                $this->Flash->success(__('店舗情報を更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('店舗の更新に失敗しました。(' . $e->getMessage() . ')'));
            }
        }
        $this->set(compact('store'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Store id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $store = $this->Stores->get($id);
        $store = $this->Stores->patchEntity($store, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        try {
            $this->Stores->saveOrFail($store);
            $this->Flash->success(__('店舗を削除しました。'));
            return $this->redirect(['action' => 'index']);
        } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
            $this->Flash->error(__('店舗の削除に失敗しました。(' . $e->getMessage() . ')'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
