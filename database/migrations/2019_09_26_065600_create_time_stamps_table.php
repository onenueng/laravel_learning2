<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_stamps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_card');
            $table->string('sap_id');
            $table->string('full_name');
            $table->date('date');
            $table->time('time');
            $table->integer('reader');
            $table->boolean('come_in')->default(1);
            $table->string('door');
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
        Schema::dropIfExists('time_stamps');
    }
}
