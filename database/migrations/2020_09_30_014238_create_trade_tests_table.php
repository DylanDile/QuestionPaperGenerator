<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_tests', function (Blueprint $table) {
            $table->id();
            $table->string('qp_number');
            $table->date('exam_date');
            $table->time('exam_time');
            $table->string('status')->default('on');
            $table->string('class')->nullable();
            $table->string('trade')->nullable();
            $table->string('posted_by')->nullable();
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
        Schema::dropIfExists('trade_tests');
    }
}
