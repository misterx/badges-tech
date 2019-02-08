<?php

namespace App\Repository;

use App\Account;
use App\Accounts;
use Fesor\DomainEvents\EventDispatcher;

class ArrayAccounts implements Accounts
{
    private $accounts=[];
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * ArrayAccounts constructor.
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }


    public function store(Account $account)
    {
        $idReflection = new \ReflectionProperty(Account::class,'userId');
        $idReflection->setAccessible(true);
        $this->accounts[(int)$idReflection->getValue($account)] = $account;
        $this->eventDispatcher->dispatch((array)$account->releaseEvents());
    }

    public function getUserAccount(int $userId): Account
    {
        if(!$this->hasAccount($userId)){
            throw new \Exception('User not found');
        }

        return clone $this->accounts[$userId];
    }

    public function hasAccount(int $userId): bool
    {
        return array_key_exists($userId,$this->accounts);
    }


}