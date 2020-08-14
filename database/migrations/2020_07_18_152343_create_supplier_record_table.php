<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_record', function (Blueprint $table) {
            $table->id('supplier_id');
            $table->string('supplier_name');
            $table->string('supplier_phone');            
            $table->string('supplier_email');
            $table->text('supplier_address');
            $table->text('supplier_description');
            $table->string('supplier_photo');
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
        Schema::dropIfExists('supplier_record');
    }
}
