<?php

namespace Wimdevgroup\ProxmoxveApi\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AuthenticationClientService
{
    private HttpClientInterface $httpClient;
    private string $authHeader;
    private ConfigurationService $configurationService;

    public function __construct
    (
        HttpClientInterface $client,
        ConfigurationService $configurationService
    ) {
        $this->httpClient = $client;
        $this->authHeader = sprintf('PVEAPIToken=%s', $configurationService->getPveApiToken());
    }

    /**
     * Sends an HTTP request.
     *
     * @param string $method
     * @param string $url
     * @return string
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function request(string $method, string $url): string
    {
        try {
            $response = $this->httpClient->request($method, $url, [
                'headers' => ['Authorization' => $this->authHeader],
                'max_redirects' => 10,
            ]);

            return $this->handleResponse($response, $method);
        } catch (\Exception $e) {
            throw new \RuntimeException("HTTP {$method} error: " . $e->getMessage());
        }
    }

    /**
     *
     * Method GET
     *
     * @param string $url
     * @return string
     * @throws TransportExceptionInterface
     */
    public function get(string $url): string
    {
        return $this->request('GET', $url);
    }

    /**
     * Method POST
     *
     * @param string $url
     * @return string
     * @throws TransportExceptionInterface
     */
    public function post(string $url): string
    {
        return $this->request('POST', $url);
    }

    /**
     * Method DELETE
     *
     * @param string $url
     * @return string
     * @throws TransportExceptionInterface
     */
    public function delete(string $url): string
    {
        return $this->request('DELETE', $url);
    }

    /**
     * Handles the HTTP response.
     *
     * @param ResponseInterface $response
     * @param string $method
     * @return string
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    private function handleResponse(ResponseInterface $response, string $method): string
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            throw new \RuntimeException("Error during HTTP {$method}, HTTP code: {$statusCode}");
        }

        return $response->getContent();
    }
}
