<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Airports Controller
 *
 * @property \App\Model\Table\AirportsTable $Airports
 *
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AirportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $airports = $this->paginate($this->Airports, [
            'order' => [
                'ename' => 'ASC'
            ]
        ]);
        
        $this->set(compact('airports'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Airport id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $airport = $this->Airports->get($id);
        $this->set('airport', $airport);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $airport = $this->Airports->newEntity();
        if ($this->request->is('post')) {
            $airport = $this->Airports->patchEntity($airport, $this->request->getData());
            if ($this->Airports->save($airport)) {
                $this->Flash->success(__('The {0} has been saved.', __('Airports')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Airports')));
        }
        $this->set(compact('airport'));
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Airport id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $airport = $this->Airports->get($id);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $airport = $this->Airports->patchEntity($airport, $this->request->getData());
            if ($this->Airports->save($airport)) {
                $this->Flash->success(__('The {0} has been saved.', __('Airports')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Airports')));
        }
        $this->set(compact('airport'));
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Airport id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $airport = $this->Airports->get($id);
        if ($this->Airports->delete($airport)) {
            $this->Flash->success(__('The {0} has been deleted.', __('Airports')));
        } else {
            $this->Flash->error(__('The {0} not deleted.', __('Airports')));
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
                    'Airports.name LIKE' => "%$key%",
                    'Airports.sname LIKE' => "%$key%",
                    'Airports.ename LIKE' => "%$key%",
                    'Airports.iata LIKE' => "%$key%",
                    'Airports.icao LIKE' => "%$key%"
                ]
            ];
            $airports = $this->paginate($this->Airports);
            $this->set(compact('airports'));
        } else {
            $this->set('airports', null);
        }
        
        $this->render('index');
    }
}
