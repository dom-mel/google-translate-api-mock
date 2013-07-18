<?php

define('BASE', realpath(dirname(__FILE__)) . '/');

require BASE . 'helper.php';

$apiKey = getArg('key', '');
$source = getArg('source', '');
$target = getArg('target', '');
$text = array();
$callback = getArg('callback', '');

$query = $_SERVER['QUERY_STRING'];
$query = str_replace('q=', 'q[]=', $query);
$args = array();
parse_str($query, $args);
if (isset($args['q'])) {
    $text = $args['q'];
}

if ($apiKey !== 'API_KEY') {
    header('HTTP/1.0 400 Not Found');
    include BASE.'response/errorApiKey.json';
    exit;
}

if ($query === '') {
    header('HTTP/1.0 400 Not Found');
    include BASE.'response/errorNoQuery.json';
    exit;
}

if ($target === '') {
    header('HTTP/1.0 400 Not Found');
    include BASE.'response/errorNoTarget.json';
    exit;
}


$translations = array();
foreach ($text as $t) {
    $translatedObject = array('translatedText' => strrev($t));
    if ($source === '') {
        $translatedObject['detectedSourceLanguage'] = 'en';
    }
    $translations[] = $translatedObject;
}
$result = array('data' => array('translations' => $translations));

$json = json_encode($result);

if ($callback !== '') {
    $json = "// API callback\n$callback(" . $json . ');';
}

echo $json;