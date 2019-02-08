<?php

namespace App\Tests;


use App\Account;
use App\Repository\ArrayAccounts;
use Fesor\DomainEvents\EventDispatcher;
use PHPUnit\Framework\TestCase;

class AccountsTest extends TestCase
{
    public function testUsersRepository():void {
        $account = new Account(1);
        $accounts = new ArrayAccounts(new EventDispatcher());
        $accounts->store($account);
        $this->assertEquals($account, $accounts->getUserAccount(1));
    }

    public function testClickEvents(){
        $account = new Account(1);
        $account->addPoints(50);
        $this->assertCount(1,$account->releaseEvents());
        //All events should be empty
        $this->assertCount(0,$account->releaseEvents());
        $this->assertSame(50,$account->points());
    }
}