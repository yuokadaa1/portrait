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
          //主キー
          $table->increments('id');
          //ユニークキー①：モデルさんのID
          $table->smallInteger('modelId');
          //ユニークキー①：一画面内で登録した写真の連番
          $table->smallInteger('modelIdNum');
          //同一モデルさん何回目の登録か。AndroidのNo.Xかをカウント。
          $table->smallInteger('modelInsertNum');
          //KBNID,KBNNameは面倒なだけなので廃止
          // $table->smallInteger('kbnId')->default(0);
          // $table->string('kbnName')->default('');
          $table->string('folderPath')->nullable();
          $table->boolean('thumbnailFlg')->default(false);
          $table->string('date')->nullable();
          $table->boolean('publishFlg')->default(false);
          $table->timestamps();

          $table->unique(['modelId', 'modelIdNum']);
          // $table->index('kbnId');
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
