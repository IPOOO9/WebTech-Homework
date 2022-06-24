<?php

namespace root\app2;

use PDO;
use root\app2\Person;

class PersonMapper
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'mysqladmin', 'oeru3ooj4nec');
    }

    public function add($person) {
        $id = $person->getId();
        $name = $person->getName();
        $age = $person->getAge();
        $sql = 'INSERT INTO person(id, name, age) values (:id, :name, :age)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('age', $age, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($person) {
        $id = $person->getId();
        $name = $person->getName();
        $age = $person->getAge();
        $sql = 'DELETE FROM person WHERE id=:id and name=:name and age=:age';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('age', $age, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update($person) {
        $id = $person->getId();
        $name = $person->getName();
        $age = $person->getAge();
        $sql = 'UPDATE person SET name=:name, age=:age WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('age', $age, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function findAll()
    {
        $sql = 'SELECT * from person';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $persons = [];
        if (isset($results)) {
            foreach ($results as $row) {
                if (isset($row)) {
                    array_push($persons, new Person($row['id'], $row['name'], $row['age']));
                }
            }
        }
        return $persons;
    }
}