<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('posts')->truncate();

        $posts = [];
        $faker=Factory::create();
        $date=\Carbon\Carbon::create(2018,10,04,5);

        for ($i=1;$i<=10;$i++)
        {
            $image = "Post_Image_".rand(1,5).".jpg";
            $date=$date->addDays($i);
            $publishedDate = clone($date);

            $posts[]=[
                'author_id'=>rand(1,3),
                'title'=>$faker->sentence(rand(8,12)),
                'excerpt'=>$faker->text(rand(250,300)),
                'body'=>$faker->paragraph(rand(10,15),true),
                'slug'=>$faker->slug(),
                'image' => rand(0,1)==1?$image:null,
                'created_at'=>new DateTime,
                'updated_at'=>new DateTime,
                'published_at'=> $i < 5 ? $publishedDate : (rand(0,1)==0 ? NULL : $publishedDate->addDays(4)),
                'category_id'=> rand(1,5),

            ];
        }

        DB::table('posts')->insert($posts);
    }
}
