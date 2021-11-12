<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Baked\Entity\PasswordReset as BakedEntity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * {@inheritDoc}
 */
class PasswordReset extends BakedEntity
{
    protected function _setToken($token)
    {
        if (strlen($token) > 0) {
            return (new DefaultPasswordHasher)->hash($token);
        }
    }
}
