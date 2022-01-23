<?php

namespace App\Service;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class CreateClientElasticSearch
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $localHost = '172.17.0.1';

    /**
     * @var string
     */
    private $localPort = '9200';

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    public function __construct()
    {
        $address = $this->createAddress($this->getLocalHost(), $this->getLocalPort());
        $this->client = ClientBuilder::create()
            ->setSSLVerification(false)
            ->setHosts([$address])->build();
    }

    /**
     * @param $localHost
     * @param $localPort
     * @return string
     */
    private function createAddress($localHost, $localPort): string
    {
        return sprintf('%s:%s',$localHost,$localPort);
    }

    /**
     * @return string
     */
    public function getLocalHost(): string
    {
        return $this->localHost;
    }

    /**
     * @param string $localHost
     */
    public function setLocalHost(string $localHost): void
    {
        $this->localHost = $localHost;
    }

    /**
     * @return string
     */
    public function getLocalPort(): string
    {
        return $this->localPort;
    }

    /**
     * @param string $localPort
     */
    public function setLocalPort(string $localPort): void
    {
        $this->localPort = $localPort;
    }
}