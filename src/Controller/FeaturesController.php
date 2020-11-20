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
        $this->viewBuilder()->setLayout('default');
        $this->set(compact('features'));
    }

    public function initialize()
    {
        parent::initialize();
        
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

   // public function getByShapeOrColor() {
      //  $feature_id = $this->request->query('feature_data_type');
    //    $feature_type =

      //  $shapes = $this->Shapes->find('all', [
     //       'conditions' => ['OkresCounties.kraj_region_id' => $feature_id],
      //  ]);
      //  $this->set('okresCounties', $shapes);
      //  $this->set('_serialize', ['okresCounties']);
  //  }

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
        $colors = $this->Features->Colors->find('list', ['limit' => 200]);
        $shapes = $this->Features->Shapes->find('list', ['limit' => 200]);
        $data_Types = ['Colors', 'Shapes'];
        $this->set(compact('feature', 'products','colors','shapes','data_Types'));
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

    public function findFeatureNames(){
        if ($this->request->is('ajax')) {

            $this->autoRender = false;
            $name = $this->request->query['term'];
            $results = $this->Features->find('all', array(
                'conditions' => array('Features.feature_name LIKE ' => '%' . $name . '%')
            ));

            $resultArr = array();
            foreach ($results as $result) {
                $resultArr[] = array('label' => $result['feature_name'], 'value' => $result['feature_name']);
            }
            echo json_encode($resultArr);
        }
    }

    public function isAuthorized($user)
    {
        if($user['role']== 'admin' || $user['role']== 'user'){
            return true;
        } else {
            return false;
    
        }
    }
}
