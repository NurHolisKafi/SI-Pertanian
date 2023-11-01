<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
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
                'nama' => 'bibit jagung(murah)',
                'harga' => 55000
            ], [
                'nama' => 'bibit jagung(mahal)',
                'harga' => 110000
            ], [
                'nama' => 'pupuk kandang(kg)',
                'harga' => 5000
            ], [
                'nama' => 'pupuk oria(kg)',
                'harga' => 2500
            ], [
                'nama' => 'pupuk boska(kg)',
                'harga' => 2600
            ], [
                'nama' => 'cangkul',
                'harga' => 50000
            ], [
                'nama' => 'mesin tanam jagung',
                'harga' => 1000000
            ]
        ];

        foreach ($data as $item) {
            Bahan::create($item);
        }
    }
}
