<?php

use Illuminate\Database\Seeder;

class ModelidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('modelids')->truncate();

      // 初期データ用意（列名をキーとする連想配列）
      $postData = [
          ['modelId' => 1,
           'modelName' => "一人目のID"
          ],
          ['modelId' => 2,
           'modelName' => "二人目のID"
          ],
          ['modelId' => 3,
           'modelName' => "三人目のID"
          ],
          ['modelId' => 4,
           'modelName' => "四人目のID"
          ]
        ];

        // 登録
      foreach($postData as $post) {
        \App\Modelid::create($post);
      }
    }
}
