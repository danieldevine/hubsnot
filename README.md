# Hubsnot

PHP client for the Hubspot API v3

[![Latest Packagist Version](https://img.shields.io/packagist/v/coderjerk/hubsnot?logo=github&logoColor=white&style=flat-square)](https://packagist.org/packages/coderjerk/hubsnot)  [![Total Downloads](https://img.shields.io/packagist/dt/coderjerk/hubsnot.svg?logo=github&logoColor=white&style=flat-square)](https://packagist.org/packages/coderjerk/hubsnot)



###
A very simple client because their own one looks unfinished and isn't really usable.

Just solving my own use case for now, which is simply to grab a list of available forms, more to come. Don't use in production unless this is all you want to do too.


```php

$credentials = [
    'hubspot_access_token' => $_ENV['HUBSPOT_ACCESS_TOKEN']
];

$hubsnot = new Hubsnot($credentials);

$params = [
    'limit' => 200,
];

$forms = $hubsnot->forms()->getForms($params);

foreach ($forms->results as $form) {
    echo nl2br($form->name . "\r\n");
    echo nl2br($form->id . "\r\n");
}

```
