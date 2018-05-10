<?php

namespace App\Services;

use App\Period;

class PeriodService extends Service
{
    public function __construct(Period $model)
    {
        $this->model = $model;
    }
}