<?php

namespace Wimdevgroup\ProxmoxveApi\Service\Node;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Wimdevgroup\ProxmoxveApi\Service\AuthenticationClientService;

class NodeService
{
    private AuthenticationClientService $authenticationClientService;

    public function __construct
    (
        AuthenticationClientService $authenticationClientService
    )
    {
        $this->authenticationClientService = $authenticationClientService;
    }

    /**
     * Get all nodes
     * @return string
     * @throws TransportExceptionInterface
     */
    public function list(): string
    {
        $url = '/api2/json/nodes';
        return $this->authenticationClientService->get($url);
    }

    /**
     * Get node status
     * @param string $node
     * @return string
     * @throws TransportExceptionInterface
     */
    public function status(string $node): string
    {
        $url = sprintf('/api2/json/nodes/%s/status', $node);
        return $this->authenticationClientService->get($url);
    }
}