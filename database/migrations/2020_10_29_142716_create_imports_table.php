<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id()->startingValue(1_000_001);
            $table->nullableMorphs('importable');
            $table->string('type')->nullable()->default('types.default');
            $table->string('code')->index();
            $table->string('name')->nullable();
            $table->longText('html')->nullable();
            $table->json('data')->nullable();
            $table->json('meta')->nullable();
            $table->json('info')->nullable();
            $table->string('state')->index()->default('imports.pending');
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
        Schema::dropIfExists('imports');
    }
}
