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
            'name' => 'Html',
            'slug' => 'html-tutorial',
        ]);
        Category::create([
            'name' => 'CSS',
            'slug' => 'css-tutorial',
        ]);
        Category::create([
            'name' => 'Javascript',
            'slug' => 'javascript-tutorial',
        ]);
        Category::create([
            'name' => 'VUE JS',
            'slug' => 'vue-js-tutorial',
        ]);
        Category::create([
            'name' => 'Laravel',
            'slug' => 'laravel-tutorial',
        ]);
    }
}
