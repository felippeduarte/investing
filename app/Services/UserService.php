<?php

namespace App\Services;

use App\User;

class UserService extends Service
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}