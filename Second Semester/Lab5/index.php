<?php

spl_autoload_register(function($className) {
    $path = __DIR__ . "/src/" . str_replace("\\", "/", $className) . ".php";
    require $path;
});

use ClassOne;
use SubSrc\ClassTwo;

$obj01 = new ClassOne();
$obj02 = new ClassTwo();

$obj01->call();
echo "<br>";
$obj02->call();
