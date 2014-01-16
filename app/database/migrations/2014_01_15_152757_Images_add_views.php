<?php

use Illuminate\Database\Migrations\Migration;

class ImagesAddViews extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_images', function($table) {
            $table->bigInteger('full_views')
                    ->nullable()
                    ->default(0);
            $table->bigInteger('thumb_views')
                    ->nullable()
                    ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_images', function($table) {
            $table->dropColumn('full_views');
            $table->dropColumn('thumb_views');
        });
    }

}
