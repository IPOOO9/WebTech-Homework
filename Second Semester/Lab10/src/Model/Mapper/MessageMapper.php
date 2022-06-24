<?php

namespace root\app6\Model\Mapper;

use PDO;
use root\app6\Model\Entity\Message;

class MessageMapper
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:dbname=messenger;host=127.0.0.1', 'mysqladmin', 'oeru3ooj4nec');
    }

    public function add($message) {
        $datetime = $message->getDatetime();
        $user = $message->getUser();
        $message_content = $message->getMessage();
        $sql = 'INSERT INTO messages(mes_datetime, mes_user, mes_message) values (:datetime, :user, :message)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('datetime', $datetime, PDO::PARAM_STR);
        $stmt->bindParam('user', $user, PDO::PARAM_STR);
        $stmt->bindParam('message', $message_content, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM messages WHERE mes_id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function findAll(): ?array
    {
        $sql = 'SELECT * from messages';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}