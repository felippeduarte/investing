<?php

namespace App\Services;

use App\RiskLevel;

class RiskLevelService extends Service
{
    public function __construct(RiskLevel $model)
    {
        $this->model = $model;
    }
}