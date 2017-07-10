<?php

use Illuminate\Database\Seeder;

class LinkstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'links_name' => '百度链接',
                'links_title'=>'链接',
                'links_url'=>'www.baidu.com',
                'links_order'=>0,
            ],
            [
                'links_name' => '新浪链接',
                'links_title'=>'链接',
                'links_url'=>'www.sina.com.cn',
                'links_order'=>2,
            ]
        ];
        DB::table('links')->insert($data);
    }
}
