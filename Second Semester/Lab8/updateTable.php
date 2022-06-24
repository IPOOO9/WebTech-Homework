<?php

use root\app5\Person;

require_once __DIR__ . "/vendor/autoload.php";

$personId = $_POST['id'];
$personName = $_POST['name'];
$personAge = $_POST['age'];
$action = $_POST['action'];

if ($personId != '' && $personName != '' && $personAge != '' && $action != '') {
    $person = new Person();
    $person->setId($personId);
    $person->setName($personName);
    $person->setAge($personAge);
    switch ($action) {
        case 'insert':
            $person->save();
            break;
        case 'delete':
            $person->delete();
            break;
        case 'update':
            $person->update();

    }
}

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
header("LOCATION: " . $root);