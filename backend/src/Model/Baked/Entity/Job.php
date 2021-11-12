<?php
declare(strict_types=1);

namespace App\Model\Baked\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $store_id
 * @property int|null $driver_id
 * @property int|null $influxe_id
 * @property string $name
 * @property string|null $description
 * @property string|null $description_note
 * @property string $accept_type
 * @property \Cake\I18n\FrozenTime $date_of_visit
 * @property int $estimated_amount
 * @property string|null $note
 * @property string $call_status
 * @property string|null $call_note
 * @property string|null $hope_date
 * @property string|null $note_2
 * @property string|null $note_3
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\Driver $driver
 * @property \App\Model\Entity\Influx $influx
 */
class Job extends Entity
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
        'customer_id' => true,
        'store_id' => true,
        'driver_id' => true,
        'influxe_id' => true,
        'name' => true,
        'description' => true,
        'description_note' => true,
        'accept_type' => true,
        'date_of_visit' => true,
        'estimated_amount' => true,
        'note' => true,
        'call_status' => true,
        'call_note' => true,
        'hope_date' => true,
        'note_2' => true,
        'note_3' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'store' => true,
        'driver' => true,
        'influx' => true,
    ];
}
