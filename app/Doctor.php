<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $table = "doctor_record";

    protected  $primaryKey = 'doctor_id';

    public $timestamps = true;
}
