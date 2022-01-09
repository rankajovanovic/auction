<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = [
      [
        'name' => 'Electronics',
        'slug' => 'electronics',
      ],
      [
        'name' => 'Kitchen accessories',
        'slug' => 'kitchen',
      ],
      [
        'name' => 'Gaming',
        'slug' => 'gaming',
      ],
      [
        'name' => "Furniture",
        'slug' => 'furniture',
      ],
      [
        'name' => "Fashion",
        'slug' => 'fashion',
      ],
      [
        'name' => "Books",
        'slug' => 'books',
      ],
      [
        'name' => "Baby Products",
        'slug' => 'baby',
      ],
      [
        'name' => "Jewelry",
        'slug' => 'jewelry',
      ],
      [
        'name' => "Arts, Crafts & Sewing",
        'slug' => 'arts',
      ],
      [
        'name' => "Pet supplies",
        'slug' => 'pet',
      ],
      [
        'name' => "Garden & Outdoor",
        'slug' => 'garden',
      ],
      [
        'name' => "Sporting goods	",
        'slug' => 'sport',
      ],
      [
        'name' => "Watches",
        'slug' => 'watches',
      ],
      [
        'name' => "Musical Instruments	",
        'slug' => 'music',
      ]
    ];

    foreach ($categories as $category) {
      Category::create($category);
    }
  }
}