<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialInstitution extends Model
{
    protected $fillable = [
        'full_name',
        'short_name',
        'financial_institution_type_id',
    ];
}
