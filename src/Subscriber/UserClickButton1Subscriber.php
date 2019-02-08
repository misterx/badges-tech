<?php

namespace App\Subscriber;


use App\Account;
use App\Accounts;
use App\Event\UserWasClickedButton1Event;
use Fesor\DomainEvents\EventSubscriber;

class UserClickButton1Subscriber implements EventSubscriber
{
    /**
     * @var Accounts
     */
    private $accounts;

    public function __construct(Accounts $accounts)
    {

        $this->accounts = $accounts;
    }

    public function subscribe():array
    {
        return [
            'class' => UserWasClickedButton1Event::class,
            'method' => 'onClick'
        ];
    }

    public function onClick(UserWasClickedButton1Event $event){
        $userId = $event->userId();
        if(!$this->accounts->hasAccount($userId)){
            //Create user account
            $account = new Account($userId);
        }else{
            $account = $this->accounts->getUserAccount($userId);
        }

        $account->addPoints(UserWasClickedButton1Event::COST);
        $this->accounts->store($account);
    }
}