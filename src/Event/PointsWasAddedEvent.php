<?php

namespace App\Event;


use Fesor\DomainEvents\Event;

class PointsWasAddedEvent implements Event
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $initial;
    /**
     * @var int
     */
    private $added;

    /**
     * PointsWasAddedEvent constructor.
     */
    public function __construct(int $userId, int $initial, int $added)
    {
        $this->userId = $userId;
        $this->initial = $initial;
        $this->added = $added;
    }

    public function initial():int {
        return $this->initial;
    }

    public function added():int {
        return $this->added;
    }

    public function userId():int {
        return $this->userId;
    }
}