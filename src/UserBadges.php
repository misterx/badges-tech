<?php

namespace App;


interface UserBadges
{
    public function getByUser(int $userId):array;
    public function getByBadge(Badge $badge):array;
    public function store(UserBadge $userBadge):void;
}