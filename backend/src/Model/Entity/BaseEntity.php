<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * {@inheritDoc}
 */
class BaseEntity extends Entity
{
    protected function _getDeleteIcon(): string
    {
        if (!$this->has('deleted')) {
            return '';
        }
        return '<i class="fa fa-minus-circle"></i>';
    }
}
