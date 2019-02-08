<?php

namespace App\Repository;


use App\Badge;
use App\UserBadge;
use App\UserBadges;

class ArrayUserBadges implements UserBadges
{
    private $userBadges = [];

    public function getByUser(int $userId): array
    {
        return array_filter($this->userBadges, function (UserBadge $userBadge) use ($userId){
            return $userBadge->userId() == $userId;
        });
    }

    public function getByBadge(Badge $badge): array
    {
        return array_filter($this->userBadges, function (UserBadge $userBadge) use ($badge){
            return $userBadge->badge() == $badge;
        });
    }

    public function store(UserBadge $userBadge): void
    {
        $this->userBadges[] = $userBadge;
    }


}