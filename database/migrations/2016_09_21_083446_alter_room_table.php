<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('title', 255)->after('bathroom_count')->nullable()->default(null);
            $table->text('description')->after('bathroom_count')->nullable()->default(null);
            $table->string('place_close', 255)->after('bathroom_count')->nullable()->default(null);
            $table->string('space_special', 255)->after('place_close')->nullable()->default(null);
            $table->boolean('status')->after('place_close')->default(0);
            $table->boolean('publish')->after('place_close')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'place_close', 'space_special']);
        });
    }
}
