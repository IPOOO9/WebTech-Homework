<?php
use  root\app6\Controller\UserDataController;

require_once __DIR__ . "/vendor/autoload.php";

$login = $_POST['login'];
$pass = $_POST['pass'];

if ($login != '' && $pass !='') {
    $userController = new UserDataController();
    $userController->reg($login, $pass);
}

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
header("LOCATION: " . $root);