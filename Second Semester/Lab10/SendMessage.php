<?php
use  root\app6\Repository\MessageRepository;
use  root\app6\Model\Entity\Message;

require_once __DIR__ . "/vendor/autoload.php";

$datetime = date("Y-m-d H:i:s");
$login = $_POST['login'];
$message = $_POST['mess'];

if ($login != '' and $message != '') {
    $messageRepository = new MessageRepository();
    $mes = new Message($datetime, $login, $message);
    $messageRepository->addMessage($mes);
}

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
header("LOCATION: " . $root);