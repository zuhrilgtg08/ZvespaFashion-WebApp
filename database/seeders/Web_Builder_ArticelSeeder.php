<?php

namespace Database\Seeders;
use App\Models\Web_Builder\Articel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Web_Builder_ArticelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Articel::create([
            'user_id' => 3,
            'category_id' => 3,
            'title' => 'Cara Mengatur dan Management Waktu Yang Tepat',
            'slug' => 'cara-mengatur-dan-management-waktu-yang-tepat',
            'content' => '<p>Nisi tincidunt vehicula potenti porta semper commodo nisl. Ut sociosqu amet neque id sapien inceptos a conubia. 
                            Curabitur ullamcorper sociosqu donec sollicitudin dis. Feugiat tincidunt dignissim donec tempus lorem.
                            </p>',
            'thumbnail' => null,
            'photo_articel' => null,
        ]);
    }
}
