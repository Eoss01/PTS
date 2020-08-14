<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdviceRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice_record', function (Blueprint $table) {
            $table->id('advice_id');
            $table->foreignId('doctor_id');
            $table->foreignId('patient_id');
            $table->text('advice');
            $table->text('prescription');
            $table->date('appointment_date');
            $table->time('appointment_time');
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
        Schema::dropIfExists('advice_record');
    }
}
