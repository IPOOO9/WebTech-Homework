<?php

use root\app5\Controller;
use root\app5\Person;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . "/vendor/autoload.php";

$loader = new FilesystemLoader(__DIR__ . '/templates/');
$twig = new \Twig\Environment($loader);

$controller = new Controller($twig);

$person = new Person();
$db_results = $person->getAll();

$controller->showTable($db_results);

echo '<br>
    <form action="/" method="get">
        <label> Найти по ID:
            <input name="id" type="number">
        </label>
        <input type="submit" value="Submit">
    </form>
    <br>
    ';

$getId = $_GET['id'];
if ($getId != '') {
    $personById = $person->findById($getId);
    if (!is_null($personById)) {
        $id = $personById->getId();
        $name = $personById->getName();
        $age = $personById->getAge();
        echo 'Человек с ID = ' . $id . '<br>';
        echo "$id <br>";
        echo "$name <br>";
        echo "$age <br><br>";
    }
    else {
        echo 'Человек с таким ID не найден<br>';
    }
}

echo '<br>
    <form action="/updateTable.php" method="post"> User<br>
        <label> ID:
            <input name="id" type="number">
        </label><br>
        <label> Name:
            <input name="name" type="text">
        </label><br>
        <label> Age:
            <input name="age" type="number">
        </label><br>
        <label> Action:
            <select name="action">
                <option value="insert">INSERT</option>
                <option value="delete">DELETE</option>
                <option value="update">UPDATE</option>
            </select>
        </label><br>
        <input type="submit" value="Submit">
    </form>
    <br>
    ';

