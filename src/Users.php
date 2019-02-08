<?php

namespace App;


interface Users
{
    public function store(User $user);
    public function get(int $userId):User;
}