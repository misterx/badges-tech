<?php

namespace App;


class UserBadge
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var string
     */
    private $badge;

    /**
     * UserBadges constructor.
     */
    public function __construct(int $userId, Badge $badge)
    {
        $this->userId = $userId;
        $this->badge = $badge;
    }

    public function badge():Badge{
        return $this->badge;
    }

    public function userId():int {
        return $this->userId;
    }
}