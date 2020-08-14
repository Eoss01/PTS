<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    protected $table = "advice_record";

    protected  $primaryKey = 'advice_id';

    public $timestamps = true;
}
