<?php
require('joola.php');

$endpoint = '';
$apiKey = '';

// Initialize Joola
$joola = new Joola($endpoint, $apiKey);

// Push demo documents
$doc = array(
    array(
        'timestamp' => null,
        'visits' => 1,
        'ip' => '206.44.11.1'
    ),
    array(
        'timestamp' => null,
        'visits' => 1,
        'ip' => '205.44.11.1'
    ),
    array(
        'timestamp' => null,
        'visits' => 1,
        'ip' => '200.44.11.1'
    ),
    array(
        'timestamp' => null,
        'visits' => 1,
        'ip' => '199.44.11.1'
    )
);

$result = $joola->pushDocument("workspace", "demo", $doc);
print_r($result);

// Run a query

$query = array(
    'timeframe' => 'last_7_days',
    'metrics' => Array('visits'),
    'dimensions' => Array('ip'),
    'collection' => 'demo'
);

$result = $joola->query($query);
print_r($result);

?>