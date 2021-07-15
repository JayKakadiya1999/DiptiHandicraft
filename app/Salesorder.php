<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesorder extends Model
{
    public $timestamps = false;
    protected $table = 'sales_order';
}