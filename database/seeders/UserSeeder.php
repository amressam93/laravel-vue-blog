<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'amr essam',
            'email' => 'amressam@gmail.com',
            'password' => bcrypt('123456'),
            'profile_img' => 'profile_img1.jpg'
        ]);


        User::create([
            'name' => 'ahmed ali',
            'email' => 'ahmedali@gmail.com',
            'password' => bcrypt('123456'),
            'profile_img' => 'profile_img2.jpg'
        ]);


    }
}
