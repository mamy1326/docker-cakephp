<?php
declare(strict_types=1);

namespace App\Model\Baked\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \App\Model\Table\AreasTable&\Cake\ORM\Association\BelongsTo $Areas
 * @property \App\Model\Table\InfluxesTable&\Cake\ORM\Association\BelongsTo $Influxes
 * @property \App\Model\Table\PrefecturesTable&\Cake\ORM\Association\BelongsTo $Prefectures
 *
 * @method \App\Model\Entity\Customer newEmptyEntity()
 * @method \App\Model\Entity\Customer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Influxes', [
            'foreignKey' => 'influxe_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Prefectures', [
            'foreignKey' => 'prefecture_id',
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 7)
            ->allowEmptyString('postal_code');

        $validator
            ->scalar('tel_1')
            ->maxLength('tel_1', 255)
            ->requirePresence('tel_1', 'create')
            ->notEmptyString('tel_1');

        $validator
            ->scalar('address_1')
            ->maxLength('address_1', 255)
            ->requirePresence('address_1', 'create')
            ->notEmptyString('address_1');

        $validator
            ->scalar('tel_2')
            ->maxLength('tel_2', 255)
            ->allowEmptyString('tel_2');

        $validator
            ->scalar('address_2')
            ->maxLength('address_2', 255)
            ->allowEmptyString('address_2');

        $validator
            ->scalar('tel_3')
            ->maxLength('tel_3', 255)
            ->allowEmptyString('tel_3');

        $validator
            ->scalar('address_3')
            ->maxLength('address_3', 255)
            ->allowEmptyString('address_3');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

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
        $rules->add($rules->existsIn(['area_id'], 'Areas'), ['errorField' => 'area_id']);
        $rules->add($rules->existsIn(['influxe_id'], 'Influxes'), ['errorField' => 'influxe_id']);
        $rules->add($rules->existsIn(['prefecture_id'], 'Prefectures'), ['errorField' => 'prefecture_id']);

        return $rules;
    }
}
