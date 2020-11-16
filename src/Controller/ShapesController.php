<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Shapes Controller
 *
 * @property \App\Model\Table\ShapesTable $Shapes
 *
 * @method \App\Model\Entity\Shape[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShapesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Features'],
        ];
        $shapes = $this->paginate($this->Shapes);

        $this->set(compact('shapes'));
    }

    /**
     * View method
     *
     * @param string|null $id Shape id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shape = $this->Shapes->get($id, [
            'contain' => ['Features'],
        ]);

        $this->set('shape', $shape);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shape = $this->Shapes->newEntity();
        if ($this->request->is('post')) {
            $shape = $this->Shapes->patchEntity($shape, $this->request->getData());
            if ($this->Shapes->save($shape)) {
                $this->Flash->success(__('The shape has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shape could not be saved. Please, try again.'));
        }
        $features = $this->Shapes->Features->find('list', ['limit' => 200]);
        $this->set(compact('shape', 'features'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shape id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shape = $this->Shapes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shape = $this->Shapes->patchEntity($shape, $this->request->getData());
            if ($this->Shapes->save($shape)) {
                $this->Flash->success(__('The shape has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shape could not be saved. Please, try again.'));
        }
        $features = $this->Shapes->Features->find('list', ['limit' => 200]);
        $this->set(compact('shape', 'features'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shape id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shape = $this->Shapes->get($id);
        if ($this->Shapes->delete($shape)) {
            $this->Flash->success(__('The shape has been deleted.'));
        } else {
            $this->Flash->error(__('The shape could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
