<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('quest_id');
            $table->string('user_id');
            $table->string('question')->default('what');
            $table->string('firstAns')->default('notSet');
            $table->string('secondAns')->default('notSet');
            $table->string('thirdAns')->default('notSet');
            $table->string('fullAns')->default('notSet');
            $table->string('correctAns')->default('notSet');
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
        Schema::dropIfExists('questions');
    }
}
