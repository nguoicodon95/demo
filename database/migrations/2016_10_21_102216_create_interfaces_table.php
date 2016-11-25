<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interfaces', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('location_id')->unsigned()->default(NULL);
            $table->foreign('location_id')->references('id')->on('locations');

            $table->char('room_id',36)->nullable()->default(NULL);
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->unsignedTinyInteger('position');
            $table->text('config')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interfaces');
    }
}
