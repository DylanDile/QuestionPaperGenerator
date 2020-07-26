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
            $table->integer('q_number')->unique();
            $table->string('q_trade');
            $table->string('q_subject');
            $table->text('question');
            $table->string('q_chapter');
            $table->integer('q_weight');
            $table->string('q_level');           
            $table->string('q_class');           
            $table->string('q_type');           
            $table->string('q_status');
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
