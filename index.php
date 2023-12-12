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

// Comparison function
function compareDates($a, $b)
{
    return strtotime($b->createdAt) <=> strtotime($a->createdAt);
}

usort($forms->results, 'compareDates');

dd($forms->results);

foreach ($forms->results as $form) {

    dd($form);

    echo nl2br($form->name . "\r\n");
    echo nl2br($form->id . "\r\n");
}

// git ignored file that I use for testing.
if (file_exists('scratchpad.php')) :
    require_once('scratchpad.php');
endif;
