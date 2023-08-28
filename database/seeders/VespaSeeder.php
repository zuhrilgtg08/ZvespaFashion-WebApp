<?php

namespace Database\Seeders;

use App\Models\Vespa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VespaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name_product' => 'Vespa LX', 
                'stock_product' => 200, 
                'nomor_seri' => 'GS160 SERIES 2', 
                'launch_year' => 1963, 
                'category_id' => 1, 
                'photo_product' => null, 
                'thumbnail' => null,
                'harga_product' => 22500000,
                'excerpt' => 'Desainnya yang serupa dengan bentuk tawon...',
                'detail_product' => 'Desainnya yang serupa dengan bentuk tawon membuat karakteristik Vespa menjadi unik yang memadukan secara harmonis antara warisan budaya Vespa dengan modernitas abad 21.',
            ],
            [
                'name_product' => 'Vespa GTS 150',
                'stock_product' => 250,
                'nomor_seri' => 'MODEL 42L2',
                'launch_year' => 1990,
                'category_id' => 1,
                'photo_product' => null,
                'thumbnail' => null,
                'harga_product' => 52500000,
                'excerpt' => 'Sempurna untuk mereka yang suka berkendara...',
                'detail_product' => 'Sempurna untuk mereka yang suka berkendara dengan kenyamanan lebih dengan tampilan elegan dan canggih. Kombinasi yang brilian antara tradisi, inovasi, dan ramah pada lingkungan.',
            ],
            [
                'name_product' => 'Vespa Primavera',
                'stock_product' => 300,
                'nomor_seri' => 'GS GRANSPORTS',
                'launch_year' => 1980,
                'category_id' => 1,
                'photo_product' => null,
                'thumbnail' => null,
                'harga_product' => 32500000,
                'excerpt' => 'Vespa Primavera telah menjadi sebuah revolusi...',
                'detail_product' => 'Vespa Primavera telah menjadi sebuah revolusi dalam berkendara sejak 1980 dan menjadi ikon klasik sepanjang masa.Dengan karakternya yang muda, lincah, inovatif, aman dan ramah lingkungan.',
            ],
        ];

        foreach($datas as $data) {
            Vespa::create($data);
        }
    }
}
