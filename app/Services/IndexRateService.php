<?php

namespace App\Services;

use App\IndexRate;

class IndexRateService extends Service
{
    public function __construct(IndexRate $model)
    {
        $this->model = $model;
    }
}