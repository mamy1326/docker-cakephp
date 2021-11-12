<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Baked\Table\CustomersTable as BakedTable;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * {@inheritDoc}
 */
class CustomersTable extends BakedTable
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
    }
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        parent::validationDefault($validator);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', '顧客名 は必須入力です');

        $validator
            ->scalar('tel_1')
            ->regex('tel_1', '/^[0-9]*$/', '半角数字のみで入力してください')
            ->lengthBetween('tel_1', [10, 11], '桁数が違います')
            ->requirePresence('tel_1', 'create')
            ->notEmptyString('tel_1', '電話番号1 は必須入力です');

        $validator
            ->scalar('tel_2')
            ->regex('tel_2', '/^[0-9]*$/', '半角数字のみで入力してください')
            ->lengthBetween('tel_2', [10, 11], '桁数が違います')
            ->requirePresence('tel_2', 'create')
            ->allowEmptyString('tel_2');

        $validator
            ->scalar('tel_3')
            ->regex('tel_3', '/^[0-9]*$/', '半角数字のみで入力してください')
            ->lengthBetween('tel_3', [10, 11], '桁数が違います')
            ->requirePresence('tel_3', 'create')
            ->allowEmptyString('tel_3');

        $validator
            ->scalar('address_1')
            ->maxLength('address_1', 255)
            ->requirePresence('address_1', 'create')
            ->notEmptyString('address_1', '住所1 は必須入力です');

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
        parent::buildRules($rules);
        return $rules;
    }
}
