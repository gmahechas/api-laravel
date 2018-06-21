<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username', 64);
            $table->string('email')->unique();
            $table->string('password', 128);
            $table->rememberToken();

            $table->timestamp('user_created_at')->nullable();
            $table->timestamp('user_updated_at')->nullable();
            $table->softDeletes('user_deleted_at');

            $table->integer('person_id')->nullable()->unsigned();
            $table->foreign('person_id')
                  ->references('person_id')
                  ->on('two_person')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->integer('profile_id')->nullable()->unsigned();
            $table->foreign('profile_id')
                  ->references('profile_id')
                  ->on('two_profile')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('two_user');
    }
}
