<?php
declare(strict_types=1);

namespace App\Model\Baked\Entity;

use Cake\ORM\Entity;

/**
 * Prefecture Entity
 *
 * @property int $id
 * @property int $area_id
 * @property string $name
 * @property \Cake\I18n\FrozenTime|null $deleted
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Area $area
 */
class Prefecture extends Entity
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
        'area_id' => true,
        'name' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'area' => true,
    ];
}
