<?php

namespace root\app6\Repository;

use root\app6\Model\Mapper\UserMapper;

class UserRepository
{
    private $dataMapper;
    private $data = [];

    public function __construct()
    {
        $this->dataMapper = new UserMapper();
        $this->data = $this->dataMapper->findAll();
    }

    public function updateData() {
        $this->data = $this->dataMapper->findAll();
    }

    public function findAll() {
        return $this->data;
    }

    public function findByName($name) {
        for ($i = 0; $i < count($this->data); $i++) {
            if ($this->data[$i]->getName() == $name) {
                return $this->data[$i];
            }
        }
    }

    public function addUser($user) {
        $this->dataMapper->add($user);
        $this->updateData();
    }
}