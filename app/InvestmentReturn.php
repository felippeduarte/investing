<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentReturn extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'investment_product_id',
        'period_id',
        'value',
    ];
}
