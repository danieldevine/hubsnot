# Hubsnot

PHP client for the Hubspot API v3

[![Latest Packagist Version](https://img.shields.io/packagist/v/coderjerk/hubsnot?logo=github&logoColor=white&style=flat-square)](https://packagist.org/packages/hubspot/api-client)  [![Total Downloads](https://img.shields.io/packagist/dt/coderjerk/hubsnot.svg?logo=github&logoColor=white&style=flat-square)](https://packagist.org/packages/hubspot/api-client)



###
A very simple client because their own one looks unfinished and isn't really usable.

Just solving my own use case for now, which is simply to grab a list of available forms, more to come.


```php

$credentials = [
    'hubspot_access_token' => $_ENV['HUBSPOT_ACCESS_TOKEN']
];

$hubsnot = new Hubsnot($credentials);

$forms = $hubsnot->forms()->getForms();

// dd($forms);

foreach ($forms->results as $form) {
    echo nl2br($form->name . "\r\n");
    echo nl2br($form->id . "\r\n");
}

```
