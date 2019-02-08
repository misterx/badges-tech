<?php

namespace App\Repository;

use App\User;
use App\Users;
use Fesor\DomainEvents\EventDispatcher;

class ArrayUsers implements Users
{
    private $users;
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function get(int $userId):User
    {
        if(!array_key_exists($userId,$this->users)){
            throw new \Exception('User not found');
        }

        return clone $this->users[$userId];
    }

    public function store(User $user):void
    {
        $idReflection = new \ReflectionProperty(User::class,'id');
        $idReflection->setAccessible(true);
        $this->users[(int)$idReflection->getValue($user)] = $user;
        $this->eventDispatcher->dispatch((array)$user->releaseEvents());
    }


}