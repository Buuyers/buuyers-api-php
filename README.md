# buuyers-api-php

## Installation

Using Composer:

```json
{
    "require": {
      "buuyers/buuyers-api-php": "2.3.0"
    }
}
```

## Clients

```php
$client = new EmailingCampaign(appId, apiKey);
```

## Emailing Campaign

```php
$client->emailingCampaigns->campaigns([
    'company_id'=>xxx, // Id company
    'email'=>xxx@yopmail.com, // Email
    'type'=>'feedback', // feedback or avis
    'date'=>xxxx-xx-xx, // Date to send
    'time'=>xx, // Time to send
    'name'=>xxxx, // Name (optional parameter)
    'resend'=>xxxx-xx-xx, // Date to send (optional parameter),
    'products'=>[], // Array of Products
]);
```

## Get Info Campany

```php
$client->companies->getCompany(id);
```

## Get Campany Reviews

```php
$client->companies->getCompanyReviews(id);
```


## Post Add Review

```php
$client->companies->addReview([
    'company_id'=>xxx, // Id company
    'email'=>xxx@yopmail.com, // Email
    'note'=>xx, // Note Review (1,2,3,4,5)
    'title'=>xxxx, // Title Review (optional parameter)
    'text'=>"Lorem ipsum dolor sit amet.", // Review Text (optional parameter),
]);
```
