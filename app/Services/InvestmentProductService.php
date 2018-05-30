<?php

namespace App\Services;

use App\InvestmentProduct;

class InvestmentProductService extends Service
{
    public function __construct(InvestmentProduct $model)
    {
        $this->model = $model;
    }
}