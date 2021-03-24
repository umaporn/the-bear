<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'content', function( Blueprint $table ){
            $table->increments( 'id' );
            $table->unsignedInteger( 'fk_sitename_id' )->nullable();
            $table->foreign( 'fk_sitename_id' )->references( 'id' )->on( 'sitename' );
            $table->unsignedInteger( 'fk_category_id' )->nullable();
            $table->foreign( 'fk_category_id' )->references( 'id' )->on( 'category' );
            $table->string( 'title', 255 )->nullable();
            $table->string( 'sub_title', 255 )->nullable();
            $table->unsignedInteger( 'fk_author_id' )->nullable();
            $table->foreign( 'fk_author_id' )->references( 'id' )->on( 'author' );
            $table->unsignedInteger( 'fk_country_id' )->nullable();
            $table->foreign( 'fk_country_id' )->references( 'id' )->on( 'country' );
            $table->string( 'keyword', 255 )->nullable();
            $table->text( 'description' )->nullable();
            $table->unsignedInteger( 'fk_series_id' )->nullable();
            $table->foreign( 'fk_series_id' )->references( 'id' )->on( 'series' );
            $table->integer( 'episode' )->nullable();
            $table->string( 'featured', 255 )->nullable();
            $table->longText( 'content' )->nullable();
            $table->string( 'image_path', 255 )->nullable();
            $table->string( 'media_path', 255 )->nullable();
            $table->string( 'geo_location', 255 )->nullable();
            $table->unsignedInteger( 'fk_web_story_id' )->nullable();
            $table->foreign( 'fk_web_story_id' )->references( 'id' )->on( 'web_story' );
            $table->timestamp( 'updated_at' )->nullable();
            $table->timestamp( 'created_at' )->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'content' );
    }
}
