<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Registers Controller
 *
 * @property \App\Model\Table\RegistersTable $Registers
 *
 * @method \App\Model\Entity\Register[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $registers = $this->paginate($this->Registers, [
            'order' => [
                'register' => 'ASC'
            ],
            'contain' => [
                'Enterprises',
                'Aircrafts'
            ]
        ]);
        
        $this->set(compact('registers'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Register id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $register = $this->Registers->get($id, [
            'contain' => [
                'Enterprises',
                'Aircrafts'
            ]
        ]);
        
        $this->set('register', $register);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Enterprises');
        $this->loadModel('Aircrafts');
        
        $register = $this->Registers->newEntity();
        if ($this->request->is('post')) {
            $register = $this->Registers->patchEntity($register, $this->request->getData());
            if ($this->Registers->save($register)) {
                $this->Flash->success(__('The {0} has been saved.', __('Registers')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Registers')));
        }
        
        // Master Data
        $enterprises = $this->Enterprises->find('list', [
            'order' => [
                'name' => 'ASC'
            ]
        ]);
        // Master Data
        $aircrafts = $this->Aircrafts->find('list', [
            'order' => [
                'type' => 'ASC'
            ]
        ]);
        $this->set(compact('register', 'enterprises', 'aircrafts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Register id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Enterprises');
        $this->loadModel('Aircrafts');
        
        $register = $this->Registers->get($id);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $register = $this->Registers->patchEntity($register, $this->request->getData());
            if ($this->Registers->save($register)) {
                $this->Flash->success(__('The {0} has been saved.', __('Registers')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Registers')));
        }
        // Master Data
        $enterprises = $this->Enterprises->find('list', [
            'order' => [
                'name' => 'ASC'
            ]
        ]);
        // Master Data
        $aircrafts = $this->Aircrafts->find('list', [
            'order' => [
                'type' => 'ASC'
            ]
        ]);
        $this->set(compact('register', 'enterprises', 'aircrafts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Register id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $register = $this->Registers->get($id);
        if ($this->Registers->delete($register)) {
            $this->Flash->success(__('The {0} has been deleted . ', __('Registers')));
        } else {
            $this->Flash->error(__('The {0} not deleted . ', __('Registers')));
        }
        
        return $this->redirect([
            'action' => 'index'
        ]);
    }

    /**
     * Search Method
     *
     * @return \Cake\Http\Response|null Render index.
     */
    public function search()
    {
        $key = $this->request->getData('key');
        if (isset($key) && !empty($key)) {
            $this->paginate['conditions'] = [
                'OR' => [
                    'Registers.register LIKE' => "%$key%",
                    'Enterprises.name LIKE' => "%$key%",
                    'Enterprises.sname LIKE' => "%$key%",
                    'Enterprises.ename LIKE' => "%$key%",
                    'Aircrafts.type LIKE' => "%$key%"
                ]
            ];
            $this->paginate['contain'] = [
                'Enterprises',
                'Aircrafts'
            ];
            $registers = $this->paginate($this->Registers);
            $this->set(compact('registers'));
        } else {
            $this->set('registers', null);
        }
        
        $this->render('index');
    }
}
