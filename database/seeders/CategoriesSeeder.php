<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['name_category' => 'Otomotif dan Kendaraan', 'slug' => 'otomotif-dan-kendaraan'],
            ['name_category' => 'Produktivitas', 'slug' => 'produktivitas'],
            ['name_category' => 'Personalisasi', 'slug' => 'personalisasi'],
            ['name_category' => 'Komunikasi', 'slug' => 'komunikasi'],
            ['name_category' => 'Bisnis', 'slug' => 'bisnis'],
        ];

        foreach ($datas as $data) {
            Categories::create($data);
        }
    }
}
