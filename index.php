<?php

require_once('bootstrap.php');

use Coderjerk\Hubsnot\Hubsnot;

session_start();

$credentials = [
    'hubspot_access_token' => $_ENV['HUBSPOT_ACCESS_TOKEN']
];

$params = [
    'limit' => 200,
];

$hubsnot = new Hubsnot($credentials);

$forms = $hubsnot->forms()->getForms($params);

foreach ($forms->results as $form) {
    echo nl2br($form->name . "\r\n");
    echo nl2br($form->id . "\r\n");
}

// git ignored file that I use for testing.
if (file_exists('scratchpad.php')) :
    require_once('scratchpad.php');
endif;
