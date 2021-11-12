<?php
declare(strict_types=1);

namespace App\Model\Baked\Entity;

use App\Model\Entity\BaseEntity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $postal_code
 * @property int $area_id
 * @property int $influxe_id
 * @property int $prefecture_id
 * @property string $tel_1
 * @property string $address_1
 * @property string|null $tel_2
 * @property string|null $address_2
 * @property string|null $tel_3
 * @property string|null $address_3
 * @property string|null $email
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Area $area
 * @property \App\Model\Entity\Influx $influx
 * @property \App\Model\Entity\Prefecture $prefecture
 */
class Customer extends BaseEntity
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
        'name' => true,
        'postal_code' => true,
        'area_id' => true,
        'influxe_id' => true,
        'prefecture_id' => true,
        'tel_1' => true,
        'address_1' => true,
        'tel_2' => true,
        'address_2' => true,
        'tel_3' => true,
        'address_3' => true,
        'email' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'area' => true,
        'influx' => true,
        'prefecture' => true,
    ];
}
