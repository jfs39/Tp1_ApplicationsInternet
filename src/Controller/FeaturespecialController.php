<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Featurespecial Controller
 *
 * @property \App\Model\Table\FeaturespecialTable $Featurespecial
 *
 * @method \App\Model\Entity\Featurespecial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeaturespecialController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Colors'],
        ];
        $featurespecial = $this->paginate($this->Featurespecial);

        $this->set(compact('featurespecial'));
    }

    /**
     * View method
     *
     * @param string|null $id Featurespecial id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $featurespecial = $this->Featurespecial->get($id, [
            'contain' => ['Colors'],
        ]);

        $this->set('featurespecial', $featurespecial);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $featurespecial = $this->Featurespecial->newEntity();
        if ($this->request->is('post')) {
            $featurespecial = $this->Featurespecial->patchEntity($featurespecial, $this->request->getData());
            if ($this->Featurespecial->save($featurespecial)) {
                $this->Flash->success(__('The featurespecial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The featurespecial could not be saved. Please, try again.'));
        }
        $colors = $this->Featurespecial->Colors->find('list', ['limit' => 200]);
        $this->set(compact('featurespecial', 'colors'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Featurespecial id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $featurespecial = $this->Featurespecial->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $featurespecial = $this->Featurespecial->patchEntity($featurespecial, $this->request->getData());
            if ($this->Featurespecial->save($featurespecial)) {
                $this->Flash->success(__('The featurespecial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The featurespecial could not be saved. Please, try again.'));
        }
        $colors = $this->Featurespecial->Colors->find('list', ['limit' => 200]);
        $this->set(compact('featurespecial', 'colors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Featurespecial id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $featurespecial = $this->Featurespecial->get($id);
        if ($this->Featurespecial->delete($featurespecial)) {
            $this->Flash->success(__('The featurespecial has been deleted.'));
        } else {
            $this->Flash->error(__('The featurespecial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
