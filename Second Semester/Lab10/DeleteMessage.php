<?php
use  root\app6\Repository\MessageRepository;

require_once __DIR__ . "/vendor/autoload.php";

$mes_id = $_POST['id'];

if ($mes_id != '') {
    $messageRepository = new MessageRepository();
    $messageRepository->deleteMessage($mes_id);
}

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
header("LOCATION: " . $root);