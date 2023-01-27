<?php

namespace Tests\Request;

use Illuminate\Foundation\Testing\WithFaker;

abstract class AbstractFaker
{
    use WithFaker;

    public function __construct()
    {
        $this->setUpFaker();
    }

    public function faker()
    {
        return $this->faker;
    }
}
