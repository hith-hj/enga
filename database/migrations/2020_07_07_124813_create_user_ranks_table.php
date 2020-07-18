<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('stackRank')->default(0);
            $table->smallInteger('stackSum')->default(0);
            $table->string('smartRank')->default(0);
            $table->smallInteger('smartSum')->default(0);
            $table->string('semiRank')->default(0);
            $table->smallInteger('semiSum')->default(0);            
            $table->string('stockRank')->default(0);
            $table->smallInteger('stockSum')->default(0); 
            $table->boolean('isFull')->default(false); 
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
        Schema::dropIfExists('user_ranks');
    }
}
