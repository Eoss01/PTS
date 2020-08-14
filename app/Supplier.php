<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "supplier_record";

    protected  $primaryKey = 'supplier_id';

    public $timestamps = true;
}
