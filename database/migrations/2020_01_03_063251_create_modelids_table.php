<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('modelids', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->smallInteger('modelId');
          $table->string('modelName');
          $table->timestamps();

          $table->unique('modelId');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelids');
    }
}
