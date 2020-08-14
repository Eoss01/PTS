<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_record', function (Blueprint $table) {
            $table->id('doctor_id');
            $table->string('doctor_name');
            $table->string('doctor_phone');            
            $table->string('doctor_email');
            $table->text('doctor_clinic_address')->nullable();
            $table->string('doctor_gender')->nullable();
            $table->string('doctor_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_record');
    }
}
