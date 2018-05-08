<?php

namespace App\Services;

use App\FinancialInstitutionType;

class FinancialInstitutionTypeService extends Service
{
    public function __construct(FinancialInstitutionType $model)
    {
        $this->model = $model;
    }
}