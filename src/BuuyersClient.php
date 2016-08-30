<?php

namespace Buuyers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;

class BuuyersClient
{

    /** @var url $url_api */
    private $url_api = "https://www.buuyers.com/api/v1/";

    /** @var Client $http_client */
    private $http_client;

    /** @var string API user authentication */
    protected $usernamePart;

    /** @var string API password authentication */
    protected $passwordPart;

    /** @var BuuyersCompanies $companies */
    public $companies;


    /** @var EmailingCampaign $emailingCampaigns */
    public $emailingCampaigns;



    public function __construct($usernamePart, $passwordPart)
    {
        $this->setDefaultClient();
        $this->companies = new  BuuyersCompanies($this);
        $this->emailingCampaigns = new EmailingCampaign($this);
        $this->usernamePart = $usernamePart;
        $this->passwordPart = $passwordPart;
    }

    public function post($endpoint, $json)
    {
        $url_path = $this->urlApiPath($endpoint);
        $response = $this->http_client->request('POST', $url_path, [
            'json' => $json,
            'auth' => $this->getAuth(),
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        return $this->handleResponse($response);
    }

    public function get($endpoint, $query)
    {
        $url_path = $this->urlApiPath($endpoint);
        $response = $this->http_client->request('GET', $url_path, [
            'query' => $query,
            'auth' => $this->getAuth(),
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        return $this->handleResponse($response);
    }


    private function setDefaultClient()
    {
        $this->http_client = new Client();
    }

    public function setClient($client)
    {
        $this->http_client = $client;
    }

    public function getAuth()
    {
        return [$this->usernamePart, $this->passwordPart];
    }

    private function handleResponse(Response $response)
    {
        $stream = Psr7\stream_for($response->getBody());
        $data = json_decode($stream->getContents());
        return $data;
    }

    public function urlApiPath($endpoint)
    {
        return $this->url_api . $endpoint;
    }


}
