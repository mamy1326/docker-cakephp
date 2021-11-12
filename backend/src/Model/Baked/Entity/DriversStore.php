<?php
declare(strict_types=1);

namespace App\Model\Baked\Entity;

use Cake\ORM\Entity;

/**
 * DriversStore Entity
 *
 * @property int $id
 * @property int $driver_id
 * @property int $store_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Driver $driver
 * @property \App\Model\Entity\Store $store
 */
class DriversStore extends Entity
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
        'driver_id' => true,
        'store_id' => true,
        'created' => true,
        'modified' => true,
        'driver' => true,
        'store' => true,
    ];
}
