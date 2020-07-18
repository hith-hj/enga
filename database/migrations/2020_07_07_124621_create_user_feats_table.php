<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_feats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('height')->default('notset');
            $table->string('weight')->default('notset');
            $table->string('skinColor')->default('notset');
            $table->string('eyeColor')->default('notset');
            $table->string('hairColor')->default('notset');
            $table->string('hairLength')->default('notset');            
            $table->string('faceShape')->default('notset');
            $table->string('eyeSize')->default('notset');
            $table->string('mouthSize')->default('notset');
            $table->string('chinShape')->default('notset');
            $table->string('hairBeard')->default('notset');
            $table->string('bodyType')->default('notset');
            $table->string('bodyShape')->default('notset');
            $table->string('waistMuscles')->default('notset');           
            $table->string('wealth')->default('notset');
            $table->string('musicListinging')->default('notset');
            $table->string('foodLove')->default('notset');
            $table->string('bookReading')->default('notset');
            $table->string('movieWatching')->default('notset');
            $table->string('entertainment')->default('notset');
            $table->string('senseHumor')->default('notset');
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
        Schema::dropIfExists('user_feats');
    }
}
