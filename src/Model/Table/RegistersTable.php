<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Registers Model
 *
 * @property \App\Model\Table\EnterprisesTable|\Cake\ORM\Association\BelongsTo $Enterprises
 * @property \App\Model\Table\AircraftsTable|\Cake\ORM\Association\BelongsTo $Aircrafts
 *
 * @method \App\Model\Entity\Register get($primaryKey, $options = [])
 * @method \App\Model\Entity\Register newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Register[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Register|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Register|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Register patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Register[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Register findOrCreate($search, callable $callback = null, $options = [])
 *        
 *         @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegistersTable extends Table
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
        
        $this->setTable('registers');
        $this->setDisplayField('register');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Enterprises', [
            'foreignKey' => 'enterprise_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Aircrafts', [
            'foreignKey' => 'aircraft_id',
            'joinType' => 'LEFT'
        ]);
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
        
        $validator->scalar('register')
            ->maxLength('register', 16)
            ->requirePresence('register', 'create')
            ->notEmpty('register');
        
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules
     *            The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn([
            'enterprise_id'
        ], 'Enterprises'));
        $rules->add($rules->existsIn([
            'aircraft_id'
        ], 'Aircrafts'));
        
        return $rules;
    }
}
