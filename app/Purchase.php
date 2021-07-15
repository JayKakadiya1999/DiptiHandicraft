<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $timestamps = false;
    protected $table = 'purchase_order';
}
