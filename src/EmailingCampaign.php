<?php

namespace Buuyers;

class EmailingCampaign
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function campaigns($options)
    {
        $path = $this->campaignsPath();
        return $this->client->post($path, $options);
    }

    public function campaignsPath()
    {
        return "emailing-campaign";
    }

}
