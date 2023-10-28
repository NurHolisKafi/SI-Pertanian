<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->text(50),
            'isi_berita' => fake()->text(),
            'thumbnail' => fake()->imageUrl(640, 480, 'berita'),
            'tanggal_posting' => fake()->date('Y-m-d'),
            'id_user' => 10
        ];
    }
}
