<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'financial_institution_id',
        'investment_type_id',
        'risk_level_id',
    ];
}
