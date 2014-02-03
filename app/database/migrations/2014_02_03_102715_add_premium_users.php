<?php

use Illuminate\Database\Migrations\Migration;

class AddPremiumUsers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_premium', function($table) {
            $table->bigInteger('userid');
            $table->bigInteger('useraddress');
            $table->dateTime('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_premium');
    }

}
