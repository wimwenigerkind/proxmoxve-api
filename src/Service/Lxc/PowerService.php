<?php

namespace Wimdevgroup\ProxmoxveApi\Service\Lxc;

use Wimdevgroup\ProxmoxveApi\Service\AuthenticationClientService;

class PowerService
{
    private AuthenticationClientService $authenticationClientService;

    public function __construct
    (
        AuthenticationClientService $authenticationClientService
    ) {
        $this->authenticationClientService = $authenticationClientService;
    }

    /**
     * Start
     * @param string $node
     * @param int $vmid
     * @return string
     */
    public function start(string $node, int $vmid): string
    {
        $url = sprintf('/api2/extjs/nodes/%s/lxc/%s/status/start', $node, $vmid);
        return $this->authenticationClientService->post($url);
    }

    /**
     * Stop
     * @param string $node
     * @param int $vmid
     * @return string
     */
    public function stop(string $node, int $vmid): string
    {
        $url = sprintf('/api2/extjs/nodes/%s/lxc/%s/status/stop', $node, $vmid);
        return $this->authenticationClientService->post($url);
    }

    /**
     * Restart
     * @param string $node
     * @param int $vmid
     * @return string
     */
    public function reboot(string $node, int $vmid): string
    {
        $url = sprintf('/api2/extjs/nodes/%s/lxc/%s/status/reboot', $node, $vmid);
        return $this->authenticationClientService->post($url);
    }
}