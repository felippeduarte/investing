<?php

namespace App\Services;

use App\Index;

class IndexService extends Service
{
    public function __construct(Index $model)
    {
        $this->model = $model;
    }
}