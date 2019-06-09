<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Airports Model
 *
 * @method \App\Model\Entity\Airport get($primaryKey, $options = [])
 * @method \App\Model\Entity\Airport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Airport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Airport|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airport|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Airport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Airport findOrCreate($search, callable $callback = null, $options = [])
 *        
 *         @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AirportsTable extends Table
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
        
        $this->setTable('airports');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->hasMany('Terminals');
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
        
        $validator->scalar('IATA')
            ->maxLength('IATA', 3)
            ->requirePresence('IATA', 'create')
            ->notEmpty('IATA');
        
        $validator->scalar('ICAO')
            ->maxLength('ICAO', 4)
            ->requirePresence('ICAO', 'create')
            ->notEmpty('ICAO');
        
        return $validator;
    }
}
