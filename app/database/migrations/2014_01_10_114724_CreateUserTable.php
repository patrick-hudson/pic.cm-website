<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments("id");
            $table
                    ->string("username")
                    ->nullable()
                    ->default(null);
            $table
                    ->string("password")
                    ->nullable()
                    ->default(null);
            $table
                    ->string("email")
                    ->nullable()
                    ->default(null);
            $table
                    ->dateTime("created_at")
                    ->nullable()
                    ->default(null);
            $table
                    ->dateTime("updated_at")
                    ->nullable()
                    ->default(null);
            $table
                    ->integer("state")
                    ->nullable()
                    ->default(1);
            $table
                    ->integer("group")
                    ->nullable()
                    ->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists("user");
    }

}
