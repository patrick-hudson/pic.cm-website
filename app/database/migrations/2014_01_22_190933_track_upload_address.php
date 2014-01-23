<?php

use Illuminate\Database\Migrations\Migration;

class TrackUploadAddress extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_upload_addresses', function($table) {
            $table->increments('addressid');
            $table->bigInteger('address')->unique();
            $table->timestamps();
        });

        Schema::table('user_images', function($table) {
            $table->integer('addressid');
            $table->foreign('addressid')->references('addressid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('user_upload_addresses');
        Schema::table('user_images', function($table) {
            $table->dropColumn('addressid');
        });
    }

}
