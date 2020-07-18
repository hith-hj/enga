<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('name');
            $table->string('gender')->default('notsot');
            $table->string('age')->default('notset');
            $table->string('phone')->default('notset');                
            $table->string('district')->default('notset');
            $table->string('user_image')->default('notset');
            $table->string('education')->default('notset');
            $table->string('bio')->default('notset');            
            $table->string('socialStatus')->default('notset');          
            $table->smallInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
