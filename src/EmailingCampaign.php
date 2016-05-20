<?php

namespace Buuyers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;

class EmailingCampaign
{
    /** @var url $url_api */
    private $url_api="http://buuyers.dev/api/v1/emailing-campaign";

    /** @var Client $http_client */
    private $http_client;

    /** @var string API user authentication */
    protected $usernamePart;

    /** @var string API password authentication */
    protected $passwordPart;

    public function __construct($usernamePart, $passwordPart)
    {
        $this->setDefaultClient();
        $this->usernamePart = $usernamePart;
        $this->passwordPart = $passwordPart;
    }
    private function setDefaultClient()
    {
        $this->http_client = new Client();
    }
    public function post($json)
    {
        $response = $this->http_client->post($this->url_api,[
            'json' => $json,
            'auth' => $this->getAuth(),
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        return $this->handleResponse($response);
    }


    public function getAuth()
    {
        return [$this->usernamePart, $this->passwordPart];
    }

    private function handleResponse(Response $response){
        $stream = stream_for($response->getBody());
        $data = json_decode($stream->getContents());
        return $data;
    }


}