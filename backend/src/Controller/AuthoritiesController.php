<?php
declare(strict_types=1);

namespace App\Controller;

use Carbon\Carbon;

/**
 * Authorities Controller
 *
 * @property \App\Model\Table\AuthoritiesTable $Authorities
 * @method \App\Model\Entity\Authority[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AuthoritiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $authorities = $this->paginate($this->Authorities);

        $this->set(compact('authorities'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $authority = $this->Authorities->newEmptyEntity();
        if ($this->request->is('post')) {
            $authority = $this->Authorities->patchEntity($authority, $this->request->getData());
            try {
                $this->Authorities->saveOrFail($authority);
                $this->Flash->success(__('権限を追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('権限追加できませんでした。(' . $e->getMessage()));
            }
        }
        $this->set(compact('authority'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Authority id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $authority = $this->Authorities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $authority = $this->Authorities->patchEntity($authority, $data);
            try {
                $this->Authorities->saveOrFail($authority);
                $this->Flash->success(__('権限情報を更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('権限の更新に失敗しました。(' . $e->getMessage()));
            }
        }
        $this->set(compact('authority'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Authority id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $authority = $this->Authorities->get($id);
        $authority = $this->Authorities->patchEntity($authority, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        try {
            $this->Authorities->saveOrFail($authority);
            $this->Flash->success(__('権限情報を削除しました。'));
            return $this->redirect(['action' => 'index']);
        } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
            $this->Flash->error(__('権限の削除に失敗しました。(' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }
}
