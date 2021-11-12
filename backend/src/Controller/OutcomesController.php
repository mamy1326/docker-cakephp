<?php
declare(strict_types=1);

namespace App\Controller;

use Carbon\Carbon;

/**
 * Outcomes Controller
 *
 * @method \App\Model\Entity\Outcome[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OutcomesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $outcomes = $this->paginate($this->Outcomes);

        $this->set(compact('outcomes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $outcome = $this->Outcomes->newEmptyEntity();
        if ($this->request->is('post')) {
            $outcome = $this->Outcomes->patchEntity($outcome, $this->request->getData());
            try {
                $this->Outcomes->saveOrFail($outcome);
                $this->Flash->success(__('成果マスタを追加しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('成果マスタを追加できませんでした。(' . $e->getMessage()));
            }
        }
        $this->set(compact('outcome'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Outcome id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $outcome = $this->Outcomes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['deleted'] = $data['deleted'] == '1' ? Carbon::now()->format('Y-m-d H:i:s') : null;
            $outcome = $this->Outcomes->patchEntity($outcome, $data);
            try {
                $this->Outcomes->saveOrFail($outcome);
                $this->Flash->success(__('成果マスタを更新しました。'));
                return $this->redirect(['action' => 'index']);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $this->Flash->error(__('成果マスタの更新に失敗しました。(' . $e->getMessage()));
            }
        }
        $this->set(compact('outcome'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Outcome id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $outcome = $this->Outcomes->get($id);
        $outcome = $this->Outcomes->patchEntity($outcome, ['deleted' => Carbon::now()->format('Y-m-d H:i:s')]);
        try {
            $this->Outcomes->saveOrFail($outcome);
            $this->Flash->success(__('成果マスタを削除しました。'));
            return $this->redirect(['action' => 'index']);
        } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
            $this->Flash->error(__('成果マスタの削除に失敗しました。(' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }
}
