<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndexRate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'index_id',
        'period_id',
        'value',
    ];
}
