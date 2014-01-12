<?php

use Illuminate\Database\Migrations\Migration;

class AddUploadKeys extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_keys', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('userid')->unique();
            $table->string('apikey');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists("user_keys");
    }

}
