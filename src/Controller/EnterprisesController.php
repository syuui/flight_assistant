<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Enterprises Controller
 *
 * @property \App\Model\Table\EnterprisesTable $Enterprises
 *
 * @method \App\Model\Entity\Enterprise[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnterprisesController extends AppController
{

    /**
     * 检索时的分页设定
     *
     * @var array
     */
    public $paginate = [
        'limit' => 25,
        'order' => [
            'Enterprises.name' => 'asc'
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $enterprises = $this->paginate($this->Enterprises);
        $this->set(compact('enterprises'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Enterprise id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enterprise = $this->Enterprises->get($id);
        $this->set(compact('enterprise'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $enterprise = $this->Enterprises->newEntity();
        if ($this->request->is('post')) {
            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            if ($this->Enterprises->save($enterprise)) {
                $this->Flash->success(__('The {0} has been saved.', __('Enterprises')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Enterprises')));
        }
        $this->set(compact('enterprise'));
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Enterprise id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enterprise = $this->Enterprises->get($id);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $enterprise = $this->Enterprises->patchEntity($enterprise, $this->request->getData());
            if ($this->Enterprises->save($enterprise)) {
                $this->Flash->success(__('The {0} has been saved.', __('Enterprises')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Enterprises')));
        }
        $this->set(compact('enterprise'));
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Enterprise id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $enterprise = $this->Enterprises->get($id);
        if ($this->Enterprises->delete($enterprise)) {
            $this->Flash->success(__('The {0} has been deleted.', __('Enterprises')));
        } else {
            $this->Flash->error(__('The {0} not deleted.', __('Enterprises')));
        }
        
        return $this->redirect([
            'action' => 'index'
        ]);
    }

    /**
     * Search method
     *
     * @return \Cake\Http\Response|null Render index.
     */
    public function search()
    {
        $key = $this->request->getData('key');
        if (isset($key) && !empty($key)) {
            $this->paginate['conditions'] = [
                'OR' => [
                    'Enterprises.name LIKE' => "%$key%",
                    'Enterprises.sname LIKE' => "%$key%",
                    'Enterprises.ename LIKE' => "%$key%",
                    'Enterprises.iata LIKE' => "%$key%",
                    'Enterprises.icao LIKE' => "%$key%"
                ]
            ];
            $enterprises = $this->paginate($this->Enterprises);
            $this->set(compact('enterprises'));
        } else {
            $this->set('enterprises', null);
        }
        
        $this->render('index');
    }
}
