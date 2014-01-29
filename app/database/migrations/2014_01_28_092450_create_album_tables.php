<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('album_images', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('albumid');
            $table->integer('userid');
            $table->timestamps();
        });

        Schema::create('user_albums', function(Blueprint $table) {
            $table->increments('albumid');
            $table->integer('userid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('album_images');
        Schema::drop('user_albums');
    }

}
