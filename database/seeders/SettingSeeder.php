<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => 'larabBlogs',
            'contact_email' => 'info@larablogs.com',
            'address' => 'Egypt,haram,giza'
        ]);
    }
}
