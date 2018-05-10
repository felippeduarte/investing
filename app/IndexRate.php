<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndexRate extends Model
{
    protected $fillable = [
        'index_id',
        'period_id',
        'value',
    ];
}
