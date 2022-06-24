<?php

namespace root\app6\Model\Entity;

class Message
{
    private $datetime;
    private $user;
    private $message;

    public function __construct($datetime, $user, $message)
    {
        $this->datetime = $datetime;
        $this->user = $user;
        $this->message = $message;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function setDatetime($datetime): void
    {
        $this->datetime = $datetime;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }
}