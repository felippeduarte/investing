<?php

namespace App\Services;

use App\InvestmentReturn;

class InvestmentReturnService extends Service
{
    public function __construct(InvestmentReturn $model)
    {
        $this->model = $model;
    }
}