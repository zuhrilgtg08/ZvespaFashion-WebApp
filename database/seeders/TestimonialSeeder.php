<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'user_id' => 1,
            'product_id' => 1,
            'rate' => 2.5,
            'content' => 'Lumayan bagus untuk berkendara, cuman boros besin aja!',
        ]);
    }
}
