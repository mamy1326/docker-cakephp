<?php
declare(strict_types=1);

namespace App\Model\Baked\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DriversStores Model
 *
 * @property \App\Model\Table\DriversTable&\Cake\ORM\Association\BelongsTo $Drivers
 * @property \App\Model\Table\StoresTable&\Cake\ORM\Association\BelongsTo $Stores
 *
 * @method \App\Model\Entity\DriversStore newEmptyEntity()
 * @method \App\Model\Entity\DriversStore newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DriversStore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DriversStore get($primaryKey, $options = [])
 * @method \App\Model\Entity\DriversStore findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DriversStore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DriversStore[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DriversStore|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DriversStore saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DriversStore[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DriversStore[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DriversStore[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DriversStore[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DriversStoresTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('drivers_stores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'), ['errorField' => 'driver_id']);
        $rules->add($rules->existsIn(['store_id'], 'Stores'), ['errorField' => 'store_id']);

        return $rules;
    }
}
