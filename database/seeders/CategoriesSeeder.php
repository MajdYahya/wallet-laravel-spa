<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Salary',
            'type' => 'income'
        ]);

        Category::create([
            'name' => 'Bonuses',
            'type' => 'income'
        ]);

        Category::create([
            'name' => 'Overtime',
            'type' => 'income'
        ]);
        Category::create([
            'name' => 'Housing',
            'type' => 'expanse'
        ]);
        Category::create([
            'name' => 'Food & Drinks',
            'type' => 'expanse'
        ]);
        Category::create([
            'name' => 'Shopping',
            'type' => 'expanse'
        ]);
        Category::create([
            'name' => 'Transportation',
            'type' => 'expanse'
        ]);
    }
}
