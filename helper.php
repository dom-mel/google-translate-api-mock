<?php


function getArg($name, $default) {
    if (!isset($_REQUEST[$name])) return $default;
    return $_REQUEST[$name];
}