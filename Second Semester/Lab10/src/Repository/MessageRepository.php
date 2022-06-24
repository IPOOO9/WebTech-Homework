<?php

namespace root\app6\Repository;

use root\app6\Model\Mapper\MessageMapper;

class MessageRepository
{
    private $dataMapper;
    private $data = [];

    public function __construct()
    {
        $this->dataMapper = new MessageMapper();
        $this->data = $this->dataMapper->findAll();
    }

    public function updateData() {
        $this->data = $this->dataMapper->findAll();
    }

    public function findAll() {
        return $this->data;
    }

    public function addMessage($message) {
        $this->dataMapper->add($message);
        $this->updateData();
    }

    public function deleteMessage($id) {
        $this->dataMapper->delete($id);
        $this->updateData();
        echo ' repMessageDeleted ';
    }
}