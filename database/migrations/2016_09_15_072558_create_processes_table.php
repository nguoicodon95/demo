<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->increments('id');
            $table->char('room_id',36);
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->char('member_id', 36);
            $table->foreign('member_id')->references('id')->on('members');

            $table->text('step_one')->nullable();
            $table->text('step_two')->nullable();
            $table->text('step_three')->nullable();
            $table->string('completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('processes');
    }
}
