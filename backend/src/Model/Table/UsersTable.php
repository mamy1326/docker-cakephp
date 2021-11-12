<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Baked\Table\UsersTable as BakedTable;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * {@inheritDoc}
 */
class UsersTable extends BakedTable
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
            ->sameAs('password', 'password_check', '確認用のパスワードと一致しません。');

        $validator
            ->notEmptyString('password', 'パスワードが空です。');

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

        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
