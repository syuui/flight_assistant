<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Aircrafts Controller
 *
 * @property \App\Model\Table\AircraftsTable $Aircrafts
 *
 * @method \App\Model\Entity\Aircraft[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AircraftsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $aircrafts = $this->paginate($this->Aircrafts, [
            'order' => [
                'type' => 'ASC'
            ]
        ]);
        $this->set(compact('aircrafts'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Aircraft id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aircraft = $this->Aircrafts->get($id);
        $this->set(compact('aircraft'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aircraft = $this->Aircrafts->newEntity();
        
        if ($this->request->is('post')) {
            $aircraft = $this->Aircrafts->patchEntity($aircraft, $this->request->getData());
            if ($this->Aircrafts->save($aircraft)) {
                $this->Flash->success(__('The {0} has been saved.', __('Aircrafts')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Aircrafts')));
        }
        $this->set(compact('aircraft'));
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Aircraft id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $aircraft = $this->Aircrafts->get($id);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $aircraft = $this->Aircrafts->patchEntity($aircraft, $this->request->getData());
            if ($this->Aircrafts->save($aircraft)) {
                $this->Flash->success(__('The {0} has been saved.', __('Aircrafts')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Aircrafts')));
        }
        $this->set(compact('aircraft'));
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Aircraft id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $aircraft = $this->Aircrafts->get($id);
        if ($this->Aircrafts->delete($aircraft)) {
            $this->Flash->success(__('The {0} has been deleted.', __('Aircrafts')));
        } else {
            $this->Flash->error(__('The {0} not deleted.', __('Aircrafts')));
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
                    'Aircrafts.type LIKE' => "%$key%",
                    'Aircrafts.maker LIKE' => "%$key%"
                ]
            ];
            $aircrafts = $this->paginate($this->Aircrafts);
            $this->set(compact('aircrafts'));
        } else {
            $this->set('aircrafts', null);
        }
        
        $this->render('index');
    }
}
