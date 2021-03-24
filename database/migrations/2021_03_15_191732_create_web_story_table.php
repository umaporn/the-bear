<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_story', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'name', 255 )->nullable();
            $table->string( 'status', 255 )->nullable();
            $table->timestamp( 'updated_at' )->nullable();
            $table->timestamp( 'created_at' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_story');
    }
}
