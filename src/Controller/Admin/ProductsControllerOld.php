<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users','Files'],
        ];
        $products = $this->paginate($this->Products);
       // $this->viewBuilder()->setLayout('productsSpa');
       // $products = $this->Products->find('all');

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Users', 'Features','Files'],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->user_id = $this->Auth->user('id');
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $features = $this->Products->Features->find('list', ['limit' => 200]);
        $files = $this->Products->Files->find('list', ['limit' => 200]);
        $this->set(compact('product', 'users', 'features','files'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Features'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $features = $this->Products->Features->find('list', ['limit' => 200]);
        $files = $this->Products->Files->find('list', ['limit' => 200]);
        $this->set(compact('product', 'users', 'features','files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function findProductNames(){
        if ($this->request->is('ajax')) {

            $this->autoRender = false;
            $name = $this->request->query['term'];
            $results = $this->Products->find('all', array(
                'conditions' => array('Products.product_name LIKE ' => '%' . $name . '%')
            ));

            $resultArr = array();
            foreach ($results as $result) {
                $resultArr[] = array('label' => $result['product_name'], 'value' => $result['product_name']);
            }
            echo json_encode($resultArr);
        }
    }

  /*  public function isAuthorized($user)
    {
        if($user['role']== 'admin' || $user['role']== 'user'){
            return true;
        } else {
            return false;
    
        }
    }*/

    public function initialize()
    {
        parent::initialize();
       // $this->Auth->allow(['findProductNames']);
    }
}
