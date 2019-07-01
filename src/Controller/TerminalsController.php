<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Terminals Controller
 *
 * @property \App\Model\Table\TerminalsTable $Terminals
 *
 * @method \App\Model\Entity\Terminal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TerminalsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Airports');
        
        $terminals = $this->paginate($this->Terminals, [
            'contain' => 'Airports'
        ]);
        
        $this->set(compact('terminals'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Terminal id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $terminal = $this->Terminals->get($id, [
            'contain' => [
                'Airports'
            ]
        ]);
        
        $this->set('terminal', $terminal);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $terminal = $this->Terminals->newEntity();
        if ($this->request->is('post')) {
            $terminal = $this->Terminals->patchEntity($terminal, $this->request->getData());
            if ($this->Terminals->save($terminal)) {
                $this->Flash->success(__('The {0} has been saved.', __('Terminals')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Terminals')));
        }
        $airports = $this->Terminals->Airports->find('list', [
            'order' => [
                'name' => 'ASC'
            ]
        ]);
        $this->set(compact('terminal', 'airports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Terminal id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Airports');
        $terminal = $this->Terminals->get($id);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $terminal = $this->Terminals->patchEntity($terminal, $this->request->getData());
            if ($this->Terminals->save($terminal)) {
                $this->Flash->success(__('The {0} has been saved.', __('Terminals')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Terminals')));
        }
        $airports = $this->Airports->find('list', [
            'order' => [
                'name' => 'ASC'
            ]
        ]);
        $this->set(compact('terminal', 'airports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Terminal id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $terminal = $this->Terminals->get($id);
        if ($this->Terminals->delete($terminal)) {
            $this->Flash->success(__('The {0} has been deleted.', __('Terminals')));
        } else {
            $this->Flash->error(__('The {0} not deleted', __('Terminals')));
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
                    'Terminals.name LIKE' => "%$key%",
                    'Terminals.sname LIKE' => "%$key%"
                ]
            ];
            $this->paginate['contain'] = [
                'Airports'
            ];
            $terminals = $this->paginate($this->Terminals);
            $this->set(compact('terminals'));
        } else {
            $this->set('terminals', null);
        }
        
        $this->render('index');
    }
}
