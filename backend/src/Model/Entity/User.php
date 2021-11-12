<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Baked\Entity\User as BakedEntity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * {@inheritDoc}
 */
class User extends BakedEntity
{
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
