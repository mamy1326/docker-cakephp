<?php
declare(strict_types=1);

namespace App\Model\Entity;

use App\Model\Baked\Entity\LoginHistory as BakedEntity;

/**
 * {@inheritDoc}
 */
class LoginHistory extends BakedEntity
{
    /**
     * IPv4 インターネットネットアドレスをドット形式の文字列へ変換
     *
     * @return string ドット区切りのIPアドレス
     */
    protected function _getIpAddressesOfDecimal(): string
    {
        if (!$this->has('ip_address')) {
            return '';
        }
        return long2ip($this->ip_address);
    }
}
