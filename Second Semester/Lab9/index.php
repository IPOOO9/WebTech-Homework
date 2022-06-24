<?php

use root\app2\PersonRepository;

require_once __DIR__ . "/vendor/autoload.php";

$personRepository = new PersonRepository();
$persons = $personRepository->findAll();

foreach($persons as $person) {
    $id = $person->getId();
    $name = $person->getName();
    $age = $person->getAge();
    echo "$id <br>";
    echo "$name <br>";
    echo "$age <br><br>";
}

echo '<br>
    <form action="/" method="get">
        <label> Найти по ID:
            <input name="id" type="number">
        </label>
        <input type="submit" value="Отправить">
    </form>
    <br>
    ';

$getId = $_GET['id'];

if ($getId != '') {
    $personById = $personRepository->findById($getId);
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


