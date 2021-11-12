<?php
declare(strict_types=1);

namespace App\Model\Baked\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Jobs Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\StoresTable&\Cake\ORM\Association\BelongsTo $Stores
 * @property \App\Model\Table\DriversTable&\Cake\ORM\Association\BelongsTo $Drivers
 * @property \App\Model\Table\InfluxesTable&\Cake\ORM\Association\BelongsTo $Influxes
 *
 * @method \App\Model\Entity\Job newEmptyEntity()
 * @method \App\Model\Entity\Job newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Job[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Job get($primaryKey, $options = [])
 * @method \App\Model\Entity\Job findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Job patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Job[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Job|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Job saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Job[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JobsTable extends Table
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

        $this->setTable('jobs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id',
        ]);
        $this->belongsTo('Influxes', [
            'foreignKey' => 'influxe_id',
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('description_note')
            ->allowEmptyString('description_note');

        $validator
            ->scalar('accept_type')
            ->maxLength('accept_type', 255)
            ->requirePresence('accept_type', 'create')
            ->notEmptyString('accept_type');

        $validator
            ->dateTime('date_of_visit')
            ->requirePresence('date_of_visit', 'create')
            ->notEmptyDateTime('date_of_visit');

        $validator
            ->nonNegativeInteger('estimated_amount')
            ->requirePresence('estimated_amount', 'create')
            ->notEmptyString('estimated_amount');

        $validator
            ->scalar('note')
            ->allowEmptyString('note');

        $validator
            ->scalar('call_status')
            ->maxLength('call_status', 255)
            ->requirePresence('call_status', 'create')
            ->notEmptyString('call_status');

        $validator
            ->scalar('call_note')
            ->allowEmptyString('call_note');

        $validator
            ->scalar('hope_date')
            ->allowEmptyString('hope_date');

        $validator
            ->scalar('note_2')
            ->allowEmptyString('note_2');

        $validator
            ->scalar('note_3')
            ->allowEmptyString('note_3');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'), ['errorField' => 'customer_id']);
        $rules->add($rules->existsIn(['store_id'], 'Stores'), ['errorField' => 'store_id']);
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'), ['errorField' => 'driver_id']);
        $rules->add($rules->existsIn(['influxe_id'], 'Influxes'), ['errorField' => 'influxe_id']);

        return $rules;
    }
}
