<?php

use Illuminate\Database\Migrations\Migration;

class AddViewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_images', function($table) {
            $table->dropColumn('thumb_views');
        });

        Schema::create('user_images_views', function($table) {
            $table->bigInteger('imageid');
            $table->bigInteger('useraddress');
            $table->dateTime('viewtime');
            $table->boolean('processed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_images', function($table) {
            $table->bigInteger('thumb_views')
                    ->nullable()
                    ->default(0);
        });
        Schema::drop('user_images_views');
    }

}
