<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Features Controller
 *
 * @property \App\Model\Table\FeaturesTable $Features
 *
 * @method \App\Model\Entity\Feature[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeaturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $features = $this->paginate($this->Features);

        $this->set(compact('features'));
    }

    /**
     * View method
     *
     * @param string|null $id Feature id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feature = $this->Features->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('feature', $feature);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feature = $this->Features->newEntity();
        if ($this->request->is('post')) {
            $feature = $this->Features->patchEntity($feature, $this->request->getData());
            if ($this->Features->save($feature)) {
                $this->Flash->success(__('The feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feature could not be saved. Please, try again.'));
        }
        $products = $this->Features->Products->find('list', ['limit' => 200]);
        $this->set(compact('feature', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feature id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feature = $this->Features->get($id, [
            'contain' => ['Products'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feature = $this->Features->patchEntity($feature, $this->request->getData());
            if ($this->Features->save($feature)) {
                $this->Flash->success(__('The feature has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feature could not be saved. Please, try again.'));
        }
        $products = $this->Features->Products->find('list', ['limit' => 200]);
        $this->set(compact('feature', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feature id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feature = $this->Features->get($id);
        if ($this->Features->delete($feature)) {
            $this->Flash->success(__('The feature has been deleted.'));
        } else {
            $this->Flash->error(__('The feature could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
{
    $action = $this->request->getParam('action');
    // The add and tags actions are always allowed to logged in users.
    if (in_array($action, ['add', 'tags'])) {
        return true;
    }

    // All other actions require a slug.
    $slug = $this->request->getParam('pass.0');
    if (!$slug) {
        return false;
    }

    // Check that the article belongs to the current user.
    $caract = $this->Features->findBySlug($slug)->first();

    return $caract->user_id === $user['id'];
}
}
