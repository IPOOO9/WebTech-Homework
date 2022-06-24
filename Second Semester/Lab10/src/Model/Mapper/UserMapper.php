<?php

namespace root\app6\Model\Mapper;

use PDO;
use root\app6\Model\Entity\User;

class UserMapper
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=messenger;host=127.0.0.1', 'mysqladmin', 'oeru3ooj4nec');
    }

    public function add($user) {
        $name = $user->getName();
        $pass = $user->getPass();
        $sql = 'INSERT INTO users(name, password) values (:name, :pass)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->debugDumpParams();
    }

    public function delete($user) {
        $name = $user->getName();
        $pass = $user->getPass();
        $sql = 'DELETE FROM users WHERE name=:name and password=:pass';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update($user) {
        $name = $user->getName();
        $pass = $user->getPass();
        $sql = 'UPDATE users SET password=:pass WHERE name=:name';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('name', $name, PDO::PARAM_STR);
        $stmt->bindParam('pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function findAll(): ?array
    {
        $sql = 'SELECT * from users';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $users = [];
        if (isset($results)) {
            foreach ($results as $row) {
                if (isset($row)) {
                    array_push($users, new User($row['name'], $row['password']));
                }
            }
        }
        return $users;
    }
}