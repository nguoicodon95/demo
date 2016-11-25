<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->integer('kind_room_id')->unsigned();

            $table->foreign('kind_room_id')
                ->references('id')
                ->on('kinds')->onDelete('cascade')->onUpdate('cascade');

            $table->char('member_id', 36);

            $table->foreign('member_id')
                ->references('id')
                ->on('members')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('property_type_id')->unsigned()->nullable();

            $table->foreign('property_type_id')
                ->references('id')
                ->on('properties')->onDelete('cascade')->onUpdate('cascade');

            $table->smallInteger('bedroom_count')->nullable();;
            $table->smallInteger('count_bed')->default(0);
            $table->string('bed_types', 50)->nullable();
            $table->smallInteger('count_guest')->default(0);
            $table->smallInteger('bathroom_count')->default(0);
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
        Schema::drop('rooms');
    }
}
