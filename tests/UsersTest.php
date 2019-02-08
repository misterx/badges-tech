<?php

namespace App\Tests;


use App\Repository\ArrayUsers;
use App\User;
use Fesor\DomainEvents\EventDispatcher;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function testUsersRepository():void {
        $user = new User(1,'Mark');
        $users = new ArrayUsers(new EventDispatcher());
        $users->store($user);
        $receivedUser = $users->get(1);
        $this->assertEquals($user,$receivedUser);
    }

    public function testClickEvents(){
        $user = new User(1,'Mark');
        $user->clickButton1();
        $this->assertCount(1,$user->releaseEvents());
        //All events should be empty
        $this->assertCount(0,$user->releaseEvents());
    }
}