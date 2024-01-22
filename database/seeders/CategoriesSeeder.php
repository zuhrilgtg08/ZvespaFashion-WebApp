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
            ['name_category' => 'Alat dan Aksesoris', 'slug' => 'alat-dan-aksesoris'],
            ['name_category' => 'Personalisasi', 'slug' => 'personalisasi'],
            ['name_category' => 'Styled Design', 'slug' => 'styled-design'],
            ['name_category' => 'Perlengkapan Mesin', 'slug' => 'perlengkapan-mesin'],
        ];

        foreach ($datas as $data) {
            Categories::create($data);
        }
    }
}
