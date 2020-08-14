<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $table = "patient_record";

    protected  $primaryKey = 'patient_id';

    public $timestamps = true;

}
