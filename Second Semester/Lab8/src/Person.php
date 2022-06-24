<?php

namespace root\app5;

use PDO;

class Person
{
    private $id;
    private $name;
    private $age;
    private $connection;

    public function __construct() {
        $this->connection = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'mysqladmin', 'oeru3ooj4nec');
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function findById($id): ?Person {
        $sql = 'SELECT * from person WHERE id=:id LIMIT 1';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll()[0];
        $foundPerson = null;
        if (isset($result)) {
            $foundPerson = new Person();
            $foundPerson->setId($result['id']);
            $foundPerson->setName($result['name']);
            $foundPerson->setAge($result['age']);
        }
        return $foundPerson;
    }

    public function getAll() {
        $sql = 'SELECT * from person';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save() {
        $id = $this->id;
        $name = $this->name;
        $age = $this->age;
        $sql = 'INSERT INTO person(id, name, age) values(:id, :name, :age)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('age', $age);
        $stmt->execute();
    }

    public function update() {
        $id = $this->id;
        $name = $this->name;
        $age = $this->age;
        $sql = 'UPDATE person SET name=:name, age=:age WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('age', $age);
        $stmt->execute();
    }

    public function delete() {
        $id = $this->id;
        $sql = 'DELETE FROM person WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
    }

}