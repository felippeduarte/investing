<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialInstitution extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'short_name',
        'financial_institution_type_id',
    ];
}
