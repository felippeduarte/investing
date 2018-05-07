<?php

namespace App\Services;

use App\FinancialInstitution;

class FinancialInstitutionService extends Service
{
    public function __construct(FinancialInstitution $model)
    {
        $this->model = $model;
    }
}