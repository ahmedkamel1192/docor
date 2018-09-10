<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_name')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('patient_phone')->nullable();
            $table->string('doctor_phone')->nullable();
            $table->double('src_lat')->nullable();
            $table->double('src_long')->nullable();
            $table->double('dist_lat')->nullable();
            $table->double('dist_long')->nullable();
            $table->string('status')->nullable();


           $table->date('order_date')->nullable();
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
        Schema::dropIfExists('events');
    }
}
