<?php

namespace Buuyers;


class BuuyersCompanies
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getCompany($id)
    {
        $path = $this->companiesPath($id);
        return $this->client->get($path,[]);
    }

    public function getCompanyReviews($id)
    {
        $path = $this->companiesReviewsPath($id);
        return $this->client->get($path);
    }


    public function companiesPath($id)
    {
        return "companies/" . $id;
    }

    public function companiesReviewsPath($id)
    {
        return "companies/" . $id . "/reviews";
    }
}