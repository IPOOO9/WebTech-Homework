<?php
use  root\app6\Controller\UserDataController;

require_once __DIR__ . "/vendor/autoload.php";

$userController = new UserDataController();
$userController->logout();

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
header("LOCATION: " . $root);