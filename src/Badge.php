<?php

namespace App;


final class Badge
{
    public const BATMAN = 'BATMAN';
    public const SPIDERMAN = 'SPIDERMAN';
    /**
     * @var string
     */
    private $name;

    /**
     * Badge constructor.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name():string
    {
        return $this->name;
    }
}