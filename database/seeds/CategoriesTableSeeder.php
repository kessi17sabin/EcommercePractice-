<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'title'=>'Web Design',
                'slug'=>'web-design'
            ],

            [
                '$title'=>'Web Programming',
                '$slug'=>'web-programming'
            ],

            [
                'title'=>'Internet',
                'slug'=>'internet'
            ],

            [
                'title'=>'Social Marketing',
                'slug'=>'Social marketing'
            ],

            [
                'title'=>'Photography',
                'slug'=>'photography'
            ],
        ]);


    }

}
