<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitiesRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities_room', function (Blueprint $table) {
            $table->integer('amenities_id')->unsigned();

            $table->foreign('amenities_id')->references('id')->on('amenities');

            $table->char('room_id',36);
            $table->foreign('room_id')->references('id')->on('rooms');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('amenities_room');
    }
}
