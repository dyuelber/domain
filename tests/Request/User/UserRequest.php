<?php

namespace Tests\Request\User;

use Tests\Request\AbstractFaker;

class UserRequest extends AbstractFaker
{
    public function create()
    {
        return [
            'name'     => $this->faker()->name(),
            'email'    => $this->faker()->email(),
            'password' => $this->faker()->password(6, 10),
        ];
    }
}
