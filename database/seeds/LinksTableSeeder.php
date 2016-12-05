<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('links')->insert([
            'name'=>'百度',
            'title'=>'百度一下',
            'url'=>'https://www.baidu.com',
            'order'=>'0',
        ]);
    }
}
