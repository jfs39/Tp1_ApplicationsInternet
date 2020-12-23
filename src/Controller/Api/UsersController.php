<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Utility\Text;
use Cake\Mailer\Email;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('user', $user);
    }

    public function token() {
        //debug($this->request->getData()); die();
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }
        $this->set([
            'success' => true,
            'data' => [
                'id' => $user['id'],
                'token' => JWT::encode([
                    'sub' => $user['id'],
                    'exp' => time() + 604800
                        ],
                        Security::salt())
            ],
            '_serialize' => ['success', 'data']
        ]);
    }
    

    public function envoyerEmailConfirmation($user){
        $email = new Email('default');
        $email->to($user->email)->subject(__('Confirm your email'))->send('http://' . $_SERVER['HTTP_HOST'] . $this->request->webroot . 'users/confirm/' . $user->uuid);
    }

    public function confirm($uuid){
        $user = $this->Users->findByUuid($uuid)->firstOrFail();
        $user->active = true;
        if($this->Users->save($user)){
            $this->Flash->success(__('Thank you') . ' . '. __('Your email has been confirmed'));
            $this->redirect(['action'=>'index']);
        } else {
            $this->Flash->error(__('There was a problem with your email confirmation. Please try again'));
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->request->allowMethod(['post', 'put']);
        $user = $this->Users->newEntity($this->request->getData());
        $user->uuid = Text::uuid();
        $user->active = true;
        $data = '';
//        debug($user); die();
        $savedUser = $this->Users->save($user);
        if ($savedUser) {
            $message = 'Saved';
            $data = [
                'id' => $savedUser->id,
                'token' => JWT::encode(
                        [
                            'sub' => $savedUser->id,
                            'exp' => time() + 604800
                        ],
                        Security::salt())
            ];
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'data' => $data,
            '_serialize' => ['message', 'data']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function apropos(){
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout','add','confirm','apropos','token']);
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user)
    {
    
        if($user['role'] == 'admin'){
            return true;
        } else{
            return false;
    
        }
    }
}
