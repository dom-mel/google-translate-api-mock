<?php

define('BASE', realpath(dirname(__FILE__)) . '/');

require BASE . 'helper.php';

$apiKey = getArg('key', '');
$target = getArg('target', '');
$callback = getArg('callback', '');

if ($apiKey !== 'API_KEY') {
    header('HTTP/1.0 400 Not Found');
    include BASE.'response/errorApiKey.json';
    exit;
}

$languages = array();
if ($target === '') {
    $languages[] = array('language' => 'en');
    $languages[] = array('language' => 'de');
} else {
    $languages[] = array('language' => 'en', 'name' => 'English');
    $languages[] = array('language' => 'de', 'name' => 'German');
}

$result = array('data' => array('languages' => $languages));
$json = json_encode($result);

if ($callback !== '') {
    $json = "// API callback\n$callback(" . $json . ');';
}

echo $json;