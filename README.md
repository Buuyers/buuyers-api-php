# buuyers-api-php

## Installation

Using Composer:

```json
{
    "require": {
      "buuyers/buuyers-api-php": "1.0.0"
    }
}
```

## Clients

```php
$client = new EmailingCampaign(appId, apiKey);
```

## Emailing Campaign

```php
$client->post([
    'company_id'=>xxx, // Id company
    'email'=>xxx@yopmail.com, // Email
    'type'=>'feedback', // feedback or avis
    'date'=>xxxx-xx-xx, // Date to send
    'time'=>xx, // Time to send
    'name'=>xxxx, // Name (optional parameter)
    'resend'=>xxxx-xx-xx, // Date to send
]);
```