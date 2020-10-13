<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FeaturesProducts Controller
 *
 * @property \App\Model\Table\FeaturesProductsTable $FeaturesProducts
 *
 * @method \App\Model\Entity\FeaturesProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeaturesProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Features'],
        ];
        $featuresProducts = $this->paginate($this->FeaturesProducts);

        $this->set(compact('featuresProducts'));
    }

    /**
     * View method
     *
     * @param string|null $id Features Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $featuresProduct = $this->FeaturesProducts->get($id, [
            'contain' => ['Products', 'Features'],
        ]);

        $this->set('featuresProduct', $featuresProduct);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $featuresProduct = $this->FeaturesProducts->newEntity();
        if ($this->request->is('post')) {
            $featuresProduct = $this->FeaturesProducts->patchEntity($featuresProduct, $this->request->getData());
            if ($this->FeaturesProducts->save($featuresProduct)) {
                $this->Flash->success(__('The features product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The features product could not be saved. Please, try again.'));
        }
        $products = $this->FeaturesProducts->Products->find('list', ['limit' => 200]);
        $features = $this->FeaturesProducts->Features->find('list', ['limit' => 200]);
        $this->set(compact('featuresProduct', 'products', 'features'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Features Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $featuresProduct = $this->FeaturesProducts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $featuresProduct = $this->FeaturesProducts->patchEntity($featuresProduct, $this->request->getData());
            if ($this->FeaturesProducts->save($featuresProduct)) {
                $this->Flash->success(__('The features product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The features product could not be saved. Please, try again.'));
        }
        $products = $this->FeaturesProducts->Products->find('list', ['limit' => 200]);
        $features = $this->FeaturesProducts->Features->find('list', ['limit' => 200]);
        $this->set(compact('featuresProduct', 'products', 'features'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Features Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $featuresProduct = $this->FeaturesProducts->get($id);
        if ($this->FeaturesProducts->delete($featuresProduct)) {
            $this->Flash->success(__('The features product has been deleted.'));
        } else {
            $this->Flash->error(__('The features product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
