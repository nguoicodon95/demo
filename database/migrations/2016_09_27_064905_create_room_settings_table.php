<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->char('room_id',36);
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('experience_question')->default(0);
            $table->string('occupancy_question')->nullable()->default(null);
            $table->text('calendar')->nullable()->default(null);
            $table->unsignedTinyInteger('min_trip_length')->nullable()->default(0);
            $table->unsignedTinyInteger('max_trip_length')->nullable()->default(0);
            $table->string('advance_notice')->nullable()->default(null);
            $table->string('preparation_time')->nullable()->default(null);
            $table->string('booking_window')->nullable()->default(null);
            $table->string('pricing_mode')->nullable()->default(null);
            $table->float('min_price')->nullable()->default(null);
            $table->float('max_price')->nullable()->default(null);
            $table->float('base_price')->nullable()->default(null);
            $table->unsignedTinyInteger('weekly_discount')->nullable()->default(0);
            $table->unsignedTinyInteger('monthly_discount')->nullable()->default(0);
            $table->text('rules')->nullable()->default(null);
            $table->string('check_in')->nullable()->default(null);
            $table->string('check_out')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_settings');
    }
}
