<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Terminals Model
 *
 * @property \App\Model\Table\AirportsTable|\Cake\ORM\Association\BelongsTo $Airports
 *
 * @method \App\Model\Entity\Terminal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Terminal newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Terminal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Terminal|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Terminal|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Terminal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Terminal[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Terminal findOrCreate($search, callable $callback = null, $options = [])
 *        
 *         @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TerminalsTable extends Table
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
        
        $this->setTable('terminals');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Airports', [
            'foreignKey' => 'airport_id',
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
        
        $validator->scalar('name')
            ->maxLength('name', 64)
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        
        $validator->scalar('sname')
            ->maxLength('sname', 8)
            ->requirePresence('sname', 'create')
            ->notEmpty('sname');
        
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
            'airport_id'
        ], 'Airports'));
        
        return $rules;
    }

    /**
     * Short terminal name with short airport name.
     *
     * @param Query $query            
     * @param array $options            
     * @return \Cake\ORM\Query
     */
    public function findNameList1(Query $query, array $options)
    {
        $query->contain('Airports');
        $query->find('list', [
            'keyField' => 'id',
            'valueField' => function ($terminal)
            {
                return $terminal->airport->sname . $terminal->sname;
            }
        ]);
        return $query;
    }

    /**
     * Short terminal name with long airport name.
     *
     * @param Query $query            
     * @param array $options            
     * @return \Cake\ORM\Query
     */
    public function findNameList2(Query $query, array $options)
    {
        $query->contain('Airports');
        $query->find('list', [
            'keyField' => 'id',
            'valueField' => function ($terminal)
            {
                return $terminal->airport->name . $terminal->sname;
            }
        ]);
        return $query;
    }

    /**
     * Long terminal name with short airport name.
     *
     * @param Query $query            
     * @param array $options            
     * @return \Cake\ORM\Query
     */
    public function findNameList3(Query $query, array $options)
    {
        $query->contain('Airports');
        $query->find('list', [
            'keyField' => 'id',
            'valueField' => function ($terminal)
            {
                return $terminal->airport->name . $terminal->sname;
            }
        ]);
        return $query;
    }

    /**
     * Long terminal name with long airport name.
     * 
     * @param Query $query            
     * @param array $options            
     * @return \Cake\ORM\Query
     */
    public function findNameList4(Query $query, array $options)
    {
        $query->contain('Airports');
        $query->find('list', [
            'keyField' => 'id',
            'valueField' => function ($terminal)
            {
                return $terminal->airport->name . $terminal->name;
            }
        ]);
        return $query;
    }
}
