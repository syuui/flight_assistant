<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Enterprises Model
 *
 * @method \App\Model\Entity\Enterprise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Enterprise newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Enterprise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Enterprise|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enterprise|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enterprise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Enterprise[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Enterprise findOrCreate($search, callable $callback = null, $options = [])
 *        
 *         @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnterprisesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config
     *            The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setTable('enterprises');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->hasMany('Flights');
        $this->hasMany('Registers');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator
     *            Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->integer('id')->allowEmpty('id', 'create');
        
        $validator->scalar('name')
            ->maxLength('name', 64)
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        
        $validator->scalar('sname')
            ->maxLength('sname', 32)
            ->requirePresence('sname', 'create')
            ->notEmpty('sname');
        
        $validator->scalar('ename')
            ->maxLength('ename', 64)
            ->requirePresence('ename', 'create')
            ->notEmpty('ename');
        
        $validator->scalar('iata')
            ->maxLength('iata', 2)
            ->requirePresence('iata', 'create')
            ->notEmpty('iata');
        
        $validator->scalar('icao')
            ->maxLength('icao', 3)
            ->requirePresence('icao', 'create')
            ->notEmpty('icao');
        
        $validator->scalar('url')
            ->maxLength('url', 64)
            ->requirePresence('url', 'create')
            ->notEmpty('url');
        
        return $validator;
    }

    /**
     * getNestedRegisters method.
     *
     * @param unknown $enterprise_id            
     * @return array nested registers
     */
    public function getNestedRegisters($enterprise_id = null)
    {
        $enters = $this->find('all', [
            'fileds' => 'id',
            'conditions' => $enterprise_id == null ? '' : [
                'id' => $enterprise_id
            ]
        ]);
        
        $rlt = array();
        foreach ($enters as $enter) {
            $registers = $this->Registers->find('all', [
                'conditions' => [
                    'enterprise_id' => $enter->id
                ],
                'fields' => [
                    'id',
                    'register'
                ],
                'order' => [
                    'register' => 'ASC'
                ]
            ]);
            
            foreach ($registers as $register) {
                $rlt[$enter->id][] = array(
                    'id' => $register->id,
                    'register' => $register->register
                );
            }
        }
        
        return $rlt;
    }
}
