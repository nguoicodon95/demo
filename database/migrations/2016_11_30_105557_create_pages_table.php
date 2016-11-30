<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('page_template', 100)->nullable()->default(NULL);
            $table->string('description')->nullable()->default(NULL);
            $table->text('content')->nullable()->default(NULL);
            $table->string('image')->nullable()->default(NULL);
            $table->string('keywords')->nullable()->default(NULL);
            $table->enum('status', ['activated','disabled'])->default('activated');
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
        Schema::dropIfExists('pages');
    }
}
