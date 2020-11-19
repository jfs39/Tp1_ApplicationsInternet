<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('file', $file);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            $filerequest = $this->request->getData();
//            debug($filerequest);
//            debug($this->request->getData()['name']);
//            die();
            if (!empty($filerequest['name']['name'])) {
                $fileName = $filerequest['name']['name'];
                $uploadPath = 'files/add/';
                $uploadFile = $uploadPath . $fileName;
                if (move_uploaded_file($filerequest['name']['tmp_name'], 'img/' . $uploadFile)) {
                    $file = $this->Files->newEntity();
                    $file->name = $fileName;
                    $file->path = $uploadPath;
                    if ($this->Files->save($file)) {
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));

                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            } else {
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        }
        $products = $this->Files->Products->find('list', ['limit' => 200]);
        $this->set(compact('file', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Products'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $products = $this->Files->Products->find('list', ['limit' => 200]);
        $this->set(compact('file', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
