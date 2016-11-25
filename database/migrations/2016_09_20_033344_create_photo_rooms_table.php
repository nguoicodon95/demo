<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_rooms', function (Blueprint $table) {
            $table->increments('id');

            $table->char('room_id',36);
            $table->foreign('room_id')->references('id')->on('rooms');
            
            $table->string('name')->nullable()->default(null)->unique();
            $table->string('caption')->nullable()->default(null);
            $table->boolean('cover')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photo_rooms');
    }
}
