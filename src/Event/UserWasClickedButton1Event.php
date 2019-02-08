<?php

namespace App\Event;


use Fesor\DomainEvents\Event;

class UserWasClickedButton1Event implements Event
{
    public const COST = 50;
    /**
     * @var int
     */
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function userId():int {
        return $this->userId;
    }

}