<?php
declare(strict_types=1);

namespace App\Model\Baked\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\BaseEntity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $store_id
 * @property \Cake\I18n\FrozenTime|null $visited
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $deleted
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\LoginHistory[] $login_histories
 * @property \App\Model\Entity\Authority[] $authorities
 */
class User extends BaseEntity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'store_id' => true,
        'visited' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'store' => true,
        'login_histories' => true,
        'authorities' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
