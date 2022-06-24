<?php

use root\app6\Controller\MainController;
use root\app6\Controller\UserDataController;
use root\app6\Repository\MessageRepository;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . "/vendor/autoload.php";

$loader = new FilesystemLoader(__DIR__ . '/templates/');
$twig = new Twig\Environment($loader);

$mainController = new MainController($twig);
$userController = new UserDataController();

if (!$userController->verify()) {
    echo ' 
    <a href="/src/View/login.html">Логин</a>
    ';
    echo ' 
    <a href="/src/View/register.html">Регистрация</a>
    ';
}
else {
    $login = $userController->getLogin();
    echo '
    <form action="/SendMessage.php" method="post">
    <input name="login" type="hidden" value="' . $login . '">
        <label> Message:
            <input name="mess" type="text">
        </label> <br>
        <input type="submit" value="Submit">
    </form>
    <form action="/Logout.php">
        <input type="submit" value="Logout">
    </form>
    ';
    $messagesRepository = new MessageRepository();
    $messages = $messagesRepository->findAll();

    echo $mainController->showMessages($messages, $userController->isAdmin());
}
