<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name_app' => 'E-mart Online Shopping',
            'logo' => '',
            'address' => 'Phuc Yen, Vinh Phuc',
            'email' => 'info@emart.com',
            'phone_1' => '0352621297',
            'phone_2' => '0352621297',
            'facebook' =>'',
            'instagram' =>'',
            'linked' =>'',
            'youtube' =>'',
        ]); 
    }
}
