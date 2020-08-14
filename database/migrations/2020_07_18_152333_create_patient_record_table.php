<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_record', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('patient_name');
            $table->string('patient_phone');            
            $table->string('patient_email');
            $table->text('patient_address')->nullable();
            $table->string('patient_gender')->nullable();
            $table->date('patient_admission_date')->nullable();
            $table->date('patient_birth_date')->nullable();
            $table->string('patient_chronic_type')->nullable();
            $table->string('patient_blood_type')->nullable();
            $table->text('patient_medical_history')->nullable();
            $table->string('patient_photo')->nullable();
            $table->foreignId('created_by')->nullable();
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
        Schema::dropIfExists('patient_record');
    }
}
