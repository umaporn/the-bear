<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create/drop a user table.
 */
class CreateUsersTable extends Migration
{
    const Table = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( self::Table, function( Blueprint $table ){
            $table->increments( 'id' );
            $table->string( 'email', 254 )->unique();
            $table->string( 'second_email', 254 )->nullable();
            $table->string( 'password', 255 )->nullable();
            $table->string( 'username', 255 )->nullable();
            $table->string( 'title_name', 255 )->nullable();
            $table->string( 'firstname', 255 )->nullable();
            $table->string( 'lastname', 255 )->nullable();
            $table->string( 'middlename', 255 )->nullable();
            $table->string( 'gender', 255 )->nullable();
            $table->text( 'address' )->nullable();
            $table->string( 'country', 255 )->nullable();
            $table->string( 'state', 255 )->nullable();
            $table->string( 'city', 255 )->nullable();
            $table->string( 'postcode', 255 )->nullable();
            $table->string( 'phone', 20 )->nullable();
            $table->string( 'mobile', 20 )->nullable();
            $table->string( 'website', 255 )->nullable();
            $table->string( 'image_path', 255 )->nullable();
            $table->string( 'status', 255 )->nullable();
            $table->string( 'kyc_status', 255 )->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists( self::Table );
    }
}
