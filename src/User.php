<?php

namespace App;

use App\Event\UserWasClickedButton1Event;
use Fesor\DomainEvents\DomainEvents;

class User
{
    use DomainEvents;
    private $id;
    private $name;

    public function __construct(int $id, string $name)
    {
        $this->name = $name;
        $this->id = $id;
    }


    public function clickButton1():self {
        $this->rememberThat(new UserWasClickedButton1Event($this->id));
        return $this;
    }

}