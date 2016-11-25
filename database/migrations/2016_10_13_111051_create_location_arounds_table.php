<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationAroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations_arounds', function (Blueprint $table) {
            $table->increments('id');

            $table->char('room_id',36);
            $table->foreign('room_id')->references('id')->on('rooms');
            
            $table->string('location_name');

            $table->string('street_number');
            
            $table->string('route')->nullable()->default(null);
            
            $table->string('street')->nullable()->default(null);
            
            $table->string('city')->nullable()->default(null);

            $table->string('locality')->nullable()->default(null);
            
            $table->string('state')->nullable()->default(null);
            
            $table->string('country')->nullable()->default(null);
            
            $table->string('latitude', 50)->nullable()->default(null);
            
            $table->string('longitude', 50)->nullable()->default(null);

            $table->string('zipcode', 50)->nullable()->default(null);

            $table->string('marker_icon')->nullable()->default(null);

            // $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_arounds');
    }
}
