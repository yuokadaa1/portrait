<?php

use Illuminate\Database\Seeder;

class ModelkbnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('modelkbns')->truncate();

      // 初期データ用意（列名をキーとする連想配列）
      $postData = [
          ['kbnId' => 1,
           'kbnName' => "撮影会"
          ],
          ['kbnId' => 2,
           'kbnName' => "イベント"
          ],
          ['kbnId' => 3,
           'kbnName' => "街歩き"
          ],
          ['kbnId' => 4,
           'kbnName' => "コスプレ"
          ],
        ];

        // 登録
      foreach($postData as $post) {
        \App\Modelkbn::create($post);
      }

    }
}
