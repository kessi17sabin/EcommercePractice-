<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the user table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        //generate 3 values
        DB::table('users')->insert([
            [
            'name' => 'sabin',
            'email' => 'kessi17sabin@gmail.com',
            'password' => bcrypt('123456'),
            ],

            [
                'name' => 'rupak',
                'email' => 'kessi1807sabin@gmail.com',
                'password' => bcrypt('123456'),
            ],

            [
                'name' => 'nischal',
                'email' => 'kessi10sabin@gmail.com',
                'password' => bcrypt('123456'),
            ]
          ]
        );

    }
}
