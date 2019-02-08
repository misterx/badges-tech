<?php

namespace App;


interface Accounts
{
    public function store(Account $account);
    public function getUserAccount(int $userId):Account;
    public function hasAccount(int $userId):bool;

}