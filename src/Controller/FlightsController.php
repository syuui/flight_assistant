<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\FlightUploadForm;
use Cake\ORM\TableRegistry;


/**
 * Flights Controller
 *
 * @property \App\Model\Table\FlightsTable $Flights
 *
 * @method \App\Model\Entity\Flight[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FlightsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // 关联取出一系列数据
        $this->paginate = [
            'contain' => [
                'Enterprises',
                'Registers',
                'Registers.Aircrafts',
                'OriTerminals',
                'OriTerminals.Airports',
                'DesTerminals',
                'DesTerminals.Airports'
            ],
            'order' => [
                'ori_datetime' => 'DESC'
            ]
        ];
        $flights = $this->paginate($this->Flights);
        $this->set(compact('flights'));
    }

    /**
     * View method
     *
     * @param string|null $id
     *            Flight id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flight = $this->Flights->get($id, [
            'contain' => [
                'Enterprises',
                'Registers',
                'Registers.Aircrafts',
                'OriTerminals',
                'OriTerminals.Airports',
                'DesTerminals',
                'DesTerminals.Airports'
            ]
        ]);
        $this->set(compact('flight'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Enterprises');
        $this->loadModel('Registers');
        $this->loadModel('Terminals');
        
        $flight = $this->Flights->newEntity();
        if ($this->request->is('post')) {
            $flight = $this->Flights->patchEntity($flight, $this->request->getData());
            if ($this->Flights->save($flight)) {
                $this->Flash->success(__('The {0} has been saved.', __('Flights')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Flights')));
        }
        $enterprises = $this->Enterprises->find('list');
        $enterList = $this->Enterprises->find('list', [
            'keyField' => 'id',
            'valueField' => 'iata'
        ]);
        
        $rgs = $this->Enterprises->getNestedRegisters();
        
        // Warning: 这里必须使用findNameList3，即：长机场名+短航站楼名。否则与携程返回的数据不符，JS将会失效！！！
        $terminals = $this->Terminals->find('nameList3');
        $this->set(compact('flight', 'enterprises', 'terminals', 'enterList', 'rgs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id
     *            Flight id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Enterprises');
        $this->loadModel('Registers');
        $this->loadModel('Terminals');
        $flight = $this->Flights->get($id, [
            'contain' => [
                'Enterprises',
                'Registers',
                'OriTerminals',
                'OriTerminals.Airports',
                'DesTerminals',
                'DesTerminals.Airports'
            ]
        ]);
        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $flight = $this->Flights->patchEntity($flight, $this->request->getData());
            if ($this->Flights->save($flight)) {
                $this->Flash->success(__('The {0} has been saved.', __('Flights')));
                
                return $this->redirect([
                    'action' => 'index'
                ]);
            }
            $this->Flash->error(__('The {0} not saved.', __('Flights')));
        }
        $enterprises = $this->Enterprises->find('list');
        $enterList = $this->Enterprises->find('list', [
            'keyField' => 'id',
            'valueField' => 'iata'
        ]);
        
        $rgs = $this->Enterprises->getNestedRegisters();
        
        // Warning: 这里必须使用findNameList3，即：长机场名+短航站楼名。否则与携程返回的数据不符，JS将会失效！！！
        $terminals = $this->Terminals->find('nameList3');
        $this->set(compact('flight', 'enterprises', 'terminals', 'enterList', 'rgs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id
     *            Flight id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $flight = $this->Flights->get($id);
        if ($this->Flights->delete($flight)) {
            $this->Flash->success(__('The {0} has been deleted.', __('Flights')));
        } else {
            $this->Flash->error(__('The {0} not deleted.', __('Flights')));
        }
        
        return $this->redirect([
            'action' => 'index'
        ]);
    }

    /**
     * Upload method
     *
     * @return \Cake\Http\Response|NULL Redirects to index.
     */
    public function upload()
    {
        $fuForm = new FlightUploadForm();
        
        if ($this->request->is('post')) {
            $fuForm->execute($this->request->getData());
            
            if (empty($fuForm->errors())) {
                $keys = [
                    'enterprise',
                    'number',
                    'aircraft',
                    'ori_terminal',
                    'ori_datetime',
                    'gate',
                    'des_terminal',
                    'des_datetime',
                    'seat',
                    'memo'
                ];
                $lines = [];
                $data = $this->request->getData('uploadFile');
                $file = fopen($data['tmp_name'], 'r');
                while (!feof($file)) {
                    $csvline = fgetcsv($file);
                    $csvline = array_map([
                        __CLASS__,
                        '_encoding_converter'
                    ], $csvline);
                    $lines[] = array_combine($keys, $csvline);
                }
                fclose($file);
            }
            
            // Prepare masters
            $enters = $this->Flights->Enterprises->find('list', [
                'keyField' => 'sname',
                'valueField' => 'id'
            ])->toArray();
            $aircrafts = $this->Flights->Aircrafts->find('list', [
                'keyField' => 'type',
                'valueField' => 'id'
            ])->toArray();
            $terminals = $this->Flights->Terminals->find('list', [
                'fields' => [
                    'fname' => 'CONCAT(Airports.sname,Terminals.sname)',
                    'Terminals.id'
                ],
                'keyField' => 'fname',
                'valueField' => 'id',
                'contain' => 'Airports'
            ])->toArray();
            
            $line_number = 1;
            foreach ($lines as $line) {
                if (!array_key_exists($line['enterprise'], $enters)) {
                    $fuForm->setErrors([
                        'uploadFile' => [
                            'custom' => __("[Line {0}] Unknown enterprise {1}", $line_number, $line['enterprise'])
                        ]
                    ]);
                    break;
                }
                if (!array_key_exists($line['aircraft'], $aircrafts)) {
                    $fuForm->setErrors([
                        'uploadFile' => [
                            'custom' => __("[Line {0}] Unknown aircraft {1}", $line_number, $line['aircraft'])
                        ]
                    ]);
                    break;
                }
                if (!array_key_exists($line['ori_terminal'], $terminals)) {
                    $fuForm->setErrors([
                        'uploadFile' => [
                            'custom' => __("[Line {0}] Unknown Terminal {1}", $line_number, $line['ori_terminal'])
                        ]
                    ]);
                    break;
                }
                if (!array_key_exists($line['des_terminal'], $terminals)) {
                    $fuForm->setErrors([
                        'uploadFile' => [
                            'custom' => __("[Line {0}] Unknown Terminal {1}", $line_number, $line['des_terminal'])
                        ]
                    ]);
                    break;
                }
                
                $line_number++;
            }
            if (!$fuForm->errors()) {
                $flightTable = TableRegistry::get('Flights');
                foreach ($lines as $line) {
                    $flight = $flightTable->newEntity();
                    $flight->enterprise_id = $enters[$line['enterprise']];
                    $flight->number = $line['number'];
                    $flight->aircraft_id = $aircrafts[$line['aircraft']];
                    $flight->ori_terminal_id = $terminals[$line['ori_terminal']];
                    $flight->ori_datetime = $line['ori_datetime'];
                    $flight->gate = $line['gate'];
                    $flight->des_terminal_id = $terminals[$line['des_terminal']];
                    $flight->des_datetime = $line['des_datetime'];
                    $flight->seat = $line['seat'];
                    $flight->memo = $line['memo'];
                    if ($flightTable->save($flight)) {
                        $flight->clean();
                    }
                }
            }
            
            $this->Flash->success(__('The flight has been saved.'));
            
            return $this->redirect([
                'action' => 'index'
            ]);
        }
        
        $this->set(compact('fuForm'));
    }

    /**
     * _encoding_converter method
     * Private method, convert encoding.
     *
     * @param unknown $v            
     * @return string
     */
    private static function _encoding_converter($v)
    {
        $encode = mb_detect_encoding($v, array(
            'ASCII',
            'UTF-8',
            'GB2312',
            'GBK',
            'BIG5',
            'EUC-CN'
        ));
        if ('UTF-8' !== $encode) {
            $v = iconv($encode, 'UTF-8', $v);
        }
        return $v;
    }
}
