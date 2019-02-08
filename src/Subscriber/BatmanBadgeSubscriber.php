<?php

namespace App\Subscriber;


use App\Badge;
use App\Event\PointsWasAddedEvent;
use App\UserBadge;
use App\UserBadges;
use Fesor\DomainEvents\EventSubscriber;

class BatmanBadgeSubscriber implements EventSubscriber
{
    /**
     * @var UserBadges
     */
    private $badges;

    /**
     * BatmanBadgeSubscriber constructor.
     * @param UserBadges $badges
     */
    public function __construct(UserBadges $badges)
    {
        $this->badges = $badges;
    }

    public function subscribe():array
    {
        return ['class'=>PointsWasAddedEvent::class, 'method' => 'onPointsAdded'];
    }

    public function onPointsAdded(PointsWasAddedEvent $event):void {
        //If user collect 100 points at first time
        if($event->initial()< 100 && $event->initial() + $event->added() >= 100 ){
            $userBadge = new UserBadge($event->userId(),new Badge(Badge::BATMAN));
            $this->badges->store($userBadge);
        }
    }

}