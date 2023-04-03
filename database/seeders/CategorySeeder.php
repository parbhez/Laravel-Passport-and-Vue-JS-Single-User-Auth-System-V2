<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 200; ++$i) {
            Category::create([
                'category_name' => Str::random(10),
                'remarks' => $i % 2 != 0 ? Str::random(5) : Str::random(7),
                'status' => $i %2 == 0 ? 1 : 0,
            ]);
        }
    }
}
