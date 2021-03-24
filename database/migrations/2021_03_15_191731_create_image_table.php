<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'title', 255 )->nullable();
            $table->string( 'description', 255 )->nullable();
            $table->string( 'alt_tag', 255 )->nullable();
            $table->string( 'keyword', 255 )->nullable();
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
        Schema::dropIfExists('image');
    }
}
