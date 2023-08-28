<?php

namespace Database\Seeders;

use App\Models\Provinces;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Provinces::create([
            'name_province' => 'Bali',
        ]);

        Provinces::create([
            'name_province' => 'Bangka Belitung',
        ]);

        Provinces::create([
            'name_province' => 'Banten',
        ]);

        Provinces::create([
            'name_province' => 'Bengkulu',
        ]);

        Provinces::create([
            'name_province' => 'DI Yogyakarta',
        ]);

        Provinces::create([
            'name_province' => 'DKI Jakarta',
        ]);

        Provinces::create([
            'name_province' => 'Gorontalo',
        ]);

        Provinces::create([
            'name_province' => 'Jambi',
        ]);

        Provinces::create([
            'name_province' => 'Jawa Barat',
        ]);

        Provinces::create([
            'name_province' => 'Jawa Tengah',
        ]);

        Provinces::create([
            'name_province' => 'Jawa Timur',
        ]);

        Provinces::create([
            'name_province' => 'Kalimantan Barat',
        ]);

        Provinces::create([
            'name_province' => 'Kalimantan Selatan',
        ]);

        Provinces::create([
            'name_province' => 'Kalimantan Tengah',
        ]);

        Provinces::create([
            'name_province' => 'Kalimantan Timur',
        ]);

        Provinces::create([
            'name_province' => 'Kalimantan Utara',
        ]);

        Provinces::create([
            'name_province' => 'Kepulauan Riau',
        ]);

        Provinces::create([
            'name_province' => 'Lampung',
        ]);

        Provinces::create([
            'name_province' => 'Maluku',
        ]);

        Provinces::create([
            'name_province' => 'Maluku Utara',
        ]);

        Provinces::create([
            'name_province' => 'Nanggroe Aceh Darussalam (NAD)',
        ]);

        Provinces::create([
            'name_province' => 'Nusa Tenggara Barat (NTB)',
        ]);

        Provinces::create([
            'name_province' => 'Nusa Tenggara Timur (NTT)',
        ]);

        Provinces::create([
            'name_province' => 'Papua',
        ]);

        Provinces::create([
            'name_province' => 'Papua Barat',
        ]);

        Provinces::create([
            'name_province' => 'Riau',
        ]);

        Provinces::create([
            'name_province' => 'Sulawesi Barat',
        ]);

        Provinces::create([
            'name_province' => 'Sulawesi Selatan',
        ]);

        Provinces::create([
            'name_province' => 'Sulawesi Tengah',
        ]);

        Provinces::create([
            'name_province' => 'Sulawesi Tenggara',
        ]);

        Provinces::create([
            'name_province' => 'Sulawesi Utara',
        ]);

        Provinces::create([
            'name_province' => 'Sumatera Barat',
        ]);

        Provinces::create([
            'name_province' => 'Sumatera Selatan',
        ]);

        Provinces::create([
            'name_province' => 'Sumatera Utara',
        ]);
    }
}
