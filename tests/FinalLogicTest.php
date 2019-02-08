<?php

namespace App\Tests;


use App\Accounts;
use App\Badge;
use App\Event\UserWasClickedButton1Event;
use App\Repository\ArrayAccounts;
use App\Repository\ArrayUserBadges;
use App\Repository\ArrayUsers;
use App\Subscriber\BatmanBadgeSubscriber;
use App\Subscriber\SpiderManBadgeSubscriber;
use App\Subscriber\UserClickButton1Subscriber;
use App\User;
use App\UserBadges;
use App\Users;
use Fesor\DomainEvents\EventDispatcher;
use PHPUnit\Framework\TestCase;

class FinalLogicTest extends TestCase
{

    /**
     * @var UserBadges
     */
    private $userBadges;
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;
    /**
     * @var Accounts
     */
    private $accounts;
    /**
     * @var Users
     */
    private $users;

    protected function setUp():void 
    {
        parent::setUp();
        $this->eventDispatcher = new EventDispatcher();
        $this->userBadges = new ArrayUserBadges();
        $this->accounts = new ArrayAccounts($this->eventDispatcher);
        $this->users = new ArrayUsers($this->eventDispatcher);
        $this->eventDispatcher->addSubscriber(new UserClickButton1Subscriber($this->accounts));
        $this->eventDispatcher->addSubscriber(new BatmanBadgeSubscriber($this->userBadges));
        $this->eventDispatcher->addSubscriber(new SpiderManBadgeSubscriber($this->userBadges));
    }

    public function testUserPoins()
    {
        $user = new User(1,'Mark');
        $user->clickButton1();
        $this->users->store($user);
        //Fetch user points
        $account = $this->accounts->getUserAccount(1);
        $this->assertSame($account->points(), UserWasClickedButton1Event::COST);
    }

    public function testUsersFetching():void {
        //Create user without badges
        $this->users->store(new User(1,'Mark'));
        $this->users->store((new User(2,'Petro'))->clickButton1());
        $this->users->store((new User(3,'Clicker'))->clickButton1()->clickButton1());
        $this->users->store((new User(4,'MegaClicker'))->clickButton1()->clickButton1()->clickButton1());

        //fetch users by badge
        $this->assertCount(2, $this->userBadges->getByBadge(new Badge(Badge::BATMAN)));
        $this->assertCount(1, $this->userBadges->getByBadge(new Badge(Badge::SPIDERMAN)));

        //Fetch badge by users
        $this->assertCount(1, $this->userBadges->getByUser(3));
        $this->assertCount(2, $this->userBadges->getByUser(4));
    }

}
