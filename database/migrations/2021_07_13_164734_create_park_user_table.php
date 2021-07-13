<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('park_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('park_id');


            $table->foreign('park_id') //создание ключа
            ->references('id')
                ->on('parks')
                ->onDelete('cascade');

            $table->foreign('user_id') //создание ключа
            ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('park_user', function (Blueprint $table) { //  удаление ключа
            $table->dropForeign('park_user_parks_id_foreign');
            $table->dropForeign('park_user_users_id_foreign');
        });
        Schema::dropIfExists('park_user');
    }
}
