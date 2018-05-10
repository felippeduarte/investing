<?php

namespace App\Services;

use App\InvestmentType;

class InvestmentTypeService extends Service
{
    public function __construct(InvestmentType $model)
    {
        $this->model = $model;
    }
}