<?php

$messages = [];

if (!file_exists("history.json")) {
    file_put_contents("history.json", '');
}
else {
    $messages = json_decode(file_get_contents("history.json"));
}

$users = [
    [
        "admin",
        "123"
    ],
    [
        "aboba",
        "amogus"
    ]
];

echo '
    <form action="/" method="post">
        <label> Логин: 
            <input name="name" type="text">
        </label> <br>
        <label> Пароль: 
            <input name="pass" type="text">
        </label> <br>
        <label> Текст: 
            <input name="mess" type="text">
        </label> <br>
        <input type="submit" value="Отправить">
    </form>
    ';

$name = $_POST['name'];
$pass = $_POST['pass'];
$mess = $_POST['mess'];

if ((($name == $users[0][0] && $pass == $users[0][1]) ||
     ($name == $users[1][0] && $pass == $users[1][1])) && trim($mess) != '') {
    $mes_title = $name. " " . date("d.m.y D H:i (e)");

    $messages[] = ['mes_title' => $mes_title, 'mes' => $mess];
    file_put_contents("history.json", json_encode($messages));
}

if (file_exists("history.json")) {
    $messages = json_decode(file_get_contents("history.json"));
    foreach ($messages as $message) {
        $mes_title = $message->mes_title;
        $mes = $message->mes;
        echo "<br>$mes_title: $mes<br>";
    }
}

