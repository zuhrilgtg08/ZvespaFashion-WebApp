<?php

namespace Database\Seeders;
use App\Models\Web_Builder\Portofolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Web_Builder_PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portofolio::create([
            'title_porto' => 'Latihan Project MVC dengan CI 3',
            'slug' => 'latihan-project-mvc-dengan-ci-3',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat adipisci repellat aspernatur commodi doloremque sint perferendis, perspiciatis veritatis iure quis',
            'image_porto' => null,
            'link_porto' => 'https:/www.zero.com',
            'year' => 2003,
        ]);
    }
}
