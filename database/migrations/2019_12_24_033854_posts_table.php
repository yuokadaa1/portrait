<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Posts', function (Blueprint $table) {
          $table->increments('id');
          $table->smallInteger('modelId');
          // $table->string('modelName')->default('');
          $table->smallInteger('modelIdNum');
          $table->smallInteger('kbnId')->default(0);
          // $table->string('kbnName')->default('');
          $table->string('folderPath')->nullable();
          $table->boolean('thumbnailFlg')->default(false);
          $table->string('date')->nullable();
          $table->boolean('publishFlg')->default(false);
          $table->timestamps();

          $table->unique(['modelId', 'modelIdNum']);
          $table->index('kbnId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Posts');
    }
}
