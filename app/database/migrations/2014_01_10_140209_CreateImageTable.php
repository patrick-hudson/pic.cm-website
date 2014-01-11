<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_images', function($table) {
            $table->engine = 'InnoDB';
            $table->increments("imageid");
            $table->integer('imagesize');
            $table->integer('userid');
            $table->string('mimetype')->nullable()->default('jpeg');
            $table->dateTime("uploaddate")->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists("user_images");
    }

}
