<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Flights Model
 *
 * @property \App\Model\Table\EnterprisesTable|\Cake\ORM\Association\BelongsTo $Enterprises
 * @property \App\Model\Table\AircraftsTable|\Cake\ORM\Association\BelongsTo $Aircrafts
 * @property \App\Model\Table\TerminalsTable|\Cake\ORM\Association\BelongsTo $Terminals
 * @property \App\Model\Table\TerminalsTable|\Cake\ORM\Association\BelongsTo $Terminals
 *
 * @method \App\Model\Entity\Flight get($primaryKey, $options = [])
 * @method \App\Model\Entity\Flight newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Flight[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Flight|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Flight|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Flight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Flight[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Flight findOrCreate($search, callable $callback = null, $options = [])
 *        
 *         @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FlightsTable extends Table
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
        
        $this->setTable('flights');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Enterprises', [
            'foreignKey' => 'enterprise_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Registers', [
            'foreignKey' => 'register_id',
            'joinType' => 'INNER'
        ]);
        
        $this->belongsTo('OriTerminals', [
            'className' => 'Terminals',
            'foreignKey' => 'ori_terminal_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DesTerminals', [
            'className' => 'Terminals',
            'foreignKey' => 'des_terminal_id',
            'joinType' => 'INNER'
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
        
        $validator->scalar('number')
            ->maxLength('number', 8)
            ->requirePresence('number', 'create')
            ->notEmpty('number');
        
        $validator->dateTime('ori_datetime')
            ->requirePresence('ori_datetime', 'create')
            ->notEmpty('ori_datetime');
        
        $validator->scalar('gate')
            ->maxLength('gate', 8)
            ->requirePresence('gate', 'create')
            ->notEmpty('gate');
        
        $validator->dateTime('des_datetime')
            ->requirePresence('des_datetime', 'create')
            ->notEmpty('des_datetime');
        
        $validator->scalar('seat')
            ->maxLength('seat', 8)
            ->requirePresence('seat', 'create')
            ->notEmpty('seat');
        
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
            'register_id'
        ], 'Registers'));
        /*
        $rules->add($rules->existsIn([
            'ori_terminal_id'
        ], 'Terminals'));
        $rules->add($rules->existsIn([
            'des_terminal_id'
        ], 'Terminals'));
        */
        return $rules;
    }
/*
    public function findManual(Query $query, array $options)
    {
        $query->sql = "SELECT Enterprises.sname, Flights.number, Aircrafts.type, OriAirports.sname ori_airport_sname, OriTerminals.sname ori_terminal_sname, Flights.ori_datetime, Flights.gate, DesAirports.sname des_airport_sname, DesTerminals.sname des_terminal_sname, Flights.des_datetime, Flights.seat, Flights.memo FROM flights Flights INNER JOIN enterprises Enterprises ON Flights.enterprise_id = Enterprises.id INNER JOIN aircrafts Aircrafts ON Flights.aircraft_id = Aircrafts.id INNER JOIN ( airports OriAirports LEFT JOIN terminals OriTerminals on OriAirports.id = OriTerminals.airport_id ) ON Flights.ori_terminal_id = OriTerminals.id INNER JOIN ( airports DesAirports LEFT JOIN terminals DesTerminals on DesAirports.id = DesTerminals.airport_id ) ON Flights.des_terminal_id = DesTerminals.id LIMIT 200";
        return $query;
    }
*/
}
