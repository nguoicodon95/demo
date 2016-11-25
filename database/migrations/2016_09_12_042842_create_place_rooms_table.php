<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_rooms', function (Blueprint $table) {
            $table->increments('id');
            
            $table->char('room_id',36);

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('street_number');
            
            $table->string('route');
            
            $table->string('street');
            
            $table->string('city');

            $table->string('locality');
            
            $table->string('state');
            
            $table->string('country');
            
            $table->string('latitude', 50);
            
            $table->string('longitude', 50);

            $table->string('zipcode', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('place_rooms');
    }
}
