<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id()->startingValue(10_001);
            $table->string('type')->nullable()->default('days.racing');
            $table->string('code')->index();
            $table->string('name')->nullable();
            $table->string('location')->index()->nullable();
            $table->string('daynight')->index()->nullable();
            $table->date('date')->nullable();
            $table->json('meta')->nullable();
            $table->json('info')->nullable();
            $table->string('state')->index()->default('days.confirmed');
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
        Schema::dropIfExists('days');
    }
}
