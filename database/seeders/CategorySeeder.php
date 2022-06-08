<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'html tutorials',
            'slug' => 'html-tutorials'
        ]);


        Category::create([
            'name' => 'php tutorials',
            'slug' => 'php-tutorials'
        ]);


        Category::create([
            'name' => 'javascript tutorials',
            'slug' => 'javascript-tutorials'
        ]);


    }
}
