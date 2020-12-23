<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['index']);
    }

    public function index()
    {
        $products = $this->Products->find('all');
      //  $users = $this->Auth->user();
        $this->set([
            'products' => $products,
            '_serialize' => ['products']
        ]);
    }

    public function view($id)
    {
        $product = $this->Products->get($id);
        $this->set([
            'product' => $product,
            '_serialize' => ['product']
        ]);
    }

    public function add()
    {
        $product = $this->Products->newEntity($this->request->getData());
        if ($this->Products->save($product)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'product' => $product,
            '_serialize' => ['message', 'product']
        ]);
    }

    public function edit($id)
    {
        $product = $this->Products->get($id);
        if ($this->request->is(['get', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id)
    {
        $product = $this->Products->get($id);
        $message = 'Deleted';
        if (!$this->Products->delete($product)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}