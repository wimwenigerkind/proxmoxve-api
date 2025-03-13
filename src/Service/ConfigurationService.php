<?php

namespace Wimdevgroup\ProxmoxveApi\Service;

class ConfigurationService
{
    private string $pveApiToken;
    public function __construct
    (
        string $pveApiToken
    ) {
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