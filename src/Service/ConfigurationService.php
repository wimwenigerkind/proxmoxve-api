<?php

/*
 * This file is part of the WimDevGroup/proxmoxve-api package.
 *
 * (c) Wim Wenigerkind <wim.wenigerkind@heptacom.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Wimdevgroup\ProxmoxveApi\Service;

class ConfigurationService
{
    private string $pveApiToken;

    public function __construct
    (
        string $pveApiToken
    )
    {
        $this->pveApiToken = $pveApiToken;
    }

    /**
     * @return string
     */
    public function getPveApiToken(): string
    {
        return $this->pveApiToken;
    }
}