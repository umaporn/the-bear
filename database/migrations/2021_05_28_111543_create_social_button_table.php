<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialButtonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_button', function (Blueprint $table) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'fk_sitename_id' )->nullable();
            $table->foreign( 'fk_sitename_id' )->references( 'id' )->on( 'sitename' );
            $table->string( 'name', 255 )->nullable();
            $table->string( 'url', 255 )->nullable();
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
        Schema::dropIfExists('social_button');
    }
}
