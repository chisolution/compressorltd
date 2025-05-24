<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Air Compressors',
                'slug' => 'air-compressors',
                'description' => 'Industrial and commercial air compressors for various applications',
                'parent_id' => null,
            ],
            [
                'name' => 'Generators',
                'slug' => 'generators',
                'description' => 'Power generators for backup and primary power solutions',
                'parent_id' => null,
            ],
            [
                'name' => 'Inverters',
                'slug' => 'inverters',
                'description' => 'Power inverters and conversion equipment',
                'parent_id' => null,
            ],
            [
                'name' => 'Portable Generators',
                'slug' => 'portable-generators',
                'description' => 'Portable power generators for mobile applications',
                'parent_id' => null,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }
    }
}
