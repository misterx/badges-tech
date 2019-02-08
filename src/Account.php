<?php

namespace App;


use App\Event\PointsWasAddedEvent;
use Fesor\DomainEvents\DomainEvents;

class Account
{
    use DomainEvents;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var int
     */
    private $points;

    public function __construct(int $userId, int $initialPoints = 0)
    {
        $this->userId = $userId;
        $this->points = abs($initialPoints);
    }

    public function addPoints(int $points):void {
        $this->rememberThat(new PointsWasAddedEvent($this->userId,$this->points,$points));
        $this->points+=$points;
    }

    public function points():int {
        return $this->points;
    }

}