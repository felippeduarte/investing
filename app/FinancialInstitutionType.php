<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialInstitutionType extends Model
{
    protected $fillable = ['description'];
    public $timestamps = false;
}
