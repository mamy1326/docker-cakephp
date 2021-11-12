<?php
declare(strict_types=1);

namespace App\Controller;

use Carbon\Carbon;

/**
 * Progresses Controller
 *
 * @property \App\Model\Table\ProgressesTable $Progresses
 * @method \App\Model\Entity\Progress[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProgressesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $progresses = $this->paginate($this->Progresses);

        $this->set(compact('progresses'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $progress = $this->Progresses->newEmptyEntity();
        if ($this->request->is('post')) {
            $progress = $this->Progresses->patchEntity($progress, $this->request->getData());
            try {
                $this->Progresses->saveOrFail($progress);
                $this->Flash->success(__('進捗マスタを追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('進捗マスタを追加できませんでした。(' . $e->getMessage()));
            }
        }
        $this->set(compact('progress'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Progress id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $progress = $this->Progresses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $progress = $this->Progresses->patchEntity($progress, $data);
            try {
                $this->Progresses->saveOrFail($progress);
                $this->Flash->success(__('進捗マスタを更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('進捗マスタの更新に失敗しました。(' . $e->getMessage()));
            }
        }
        $this->set(compact('progress'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Progress id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $progress = $this->Progresses->get($id);
        $progress = $this->Progresses->patchEntity($progress, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        try {
            $this->Progresses->saveOrFail($progress);
            $this->Flash->success(__('進捗マスタを削除しました。'));
            return $this->redirect(['action' => 'index']);
        } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
            $this->Flash->error(__('進捗マスタの削除に失敗しました。(' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }
}
