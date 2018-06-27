<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
    //与topicFactory联合产数据
        // $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) {
        //     if ($index == 0) {
        //         // $topic->field = 'value';
        //     }
        // });

        // Topic::insert($topics->toArray());
        // 所有用户 ID 数组，如：[1,2,3,4]
       /* $user_ids = User::all()->pluck('id')->toArray();

        // 所有分类 ID 数组，如：[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
                        ->times(100)
                        ->make()
                        ->each(function ($topic, $index)
                            use ($user_ids, $category_ids, $faker)
        {
            // 从用户 ID 数组中随机取出一个并赋值
            $topic->user_id = $faker->randomElement($user_ids);

            // 话题分类，同上
            $topic->category_id = $faker->randomElement($category_ids);
        });

        // 将数据集合转换为数组，并插入到数据库中
        Topic::insert($topics->toArray());*/

//直接在seeder中产生数据
        $faker = app(Faker\Generator::class);
        $user_ids = User::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();
        $datas = [];
        foreach (range(1,100) as $index)
        {
            $sentence = $faker->sentence();

            $updated_at = $faker->dateTimeThisMonth();
            $created_at = $faker->dateTimeThisMonth($updated_at);

            $datas[] = [
                'user_id' => $faker->randomElement($user_ids),
                'category_id' => $faker->randomElement($category_ids),
                'title' => $sentence,
                'body' => $faker->text(),
                'excerpt' => $sentence,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ];
        }
        DB::table('topics')->insert($datas);
    }

}

