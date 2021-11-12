<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Baked\Table\DriversTable as BakedTable;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * {@inheritDoc}
 */
class DriversTable extends BakedTable
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
            ->scalar('tel')
            ->regex('tel', '/^[0-9]*$/', '半角数字のみで入力してください')
            ->lengthBetween('tel', [10, 11], '桁数が違います')
            ->requirePresence('tel', 'create')
            ->notEmptyString('tel');

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
