<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->truncate();

        // 初期データ用意（列名をキーとする連想配列）
        $postData = [
            ['modelId' => 1,
             'modelIdNum' => 1,
             'folderPath' => 'images/ninja_woman_face1_smile.png',
             'date' => '2019-10-08',
            ],
            ['modelId' => 1,
             'modelIdNum' => 2,
             'folderPath' => 'images/ninja_woman_face2_angry.png',
             'date' => '2019-10-08',
            ],
            ['modelId' => 1,
             'modelIdNum' => 3,
             'folderPath' => 'images/ninja_woman_face3_sad.png',
             'date' => '2019-10-08',
            ],
            ['modelId' => 1,
             'modelIdNum' => 4,
             'folderPath' => 'images/ninja_woman_face4_laugh.png',
             'date' => '2019-10-08',
            ]
          ];

          // 登録
        foreach($postData as $post) {
          \App\Post::create($post);
        }
    }
}
