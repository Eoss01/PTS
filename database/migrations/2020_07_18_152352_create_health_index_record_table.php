<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthIndexRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_index_record', function (Blueprint $table) {
            $table->id('index_id');
            $table->foreignId('patient_id');
            $table->string('blood_pressure_systolic');
            $table->string('blood_pressure_diastolic');
            $table->string('fasting_blood_sugar');
            $table->string('blood_sugar_after_eat');
            $table->string('HbA1c');
            $table->string('weight');
            $table->string('height');
            $table->string('body_temprature');
            $table->text('question');
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
        Schema::dropIfExists('health_index_record');
    }
}
