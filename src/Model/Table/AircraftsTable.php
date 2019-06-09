<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Aircrafts Model
 *
 * @method \App\Model\Entity\Aircraft get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aircraft newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Aircraft[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aircraft|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aircraft|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aircraft patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aircraft[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aircraft findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AircraftsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('aircrafts');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 64)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->scalar('maker')
            ->maxLength('maker', 64)
            ->requirePresence('maker', 'create')
            ->notEmpty('maker');

        return $validator;
    }
}
