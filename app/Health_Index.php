<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health_Index extends Model
{
    protected $table = "health_index_record";

    protected  $primaryKey = 'index_id';

    public $timestamps = true;

}
