<?php

namespace Database\Seeders;

use App\Models\JenisKebutuhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKebutuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'kategori' => 'bahan '
            ],
            [
                'kategori' => 'peralatan'
            ]
        ];

        foreach ($data as $item) {
            JenisKebutuhan::create($item);
        }
    }
}
