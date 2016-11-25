<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces_room', function (Blueprint $table) {
            $table->integer('space_id')->unsigned();

            $table->foreign('space_id')
                ->references('id')
                ->on('spaces');

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
        Schema::drop('spaces_room');
    }
}
