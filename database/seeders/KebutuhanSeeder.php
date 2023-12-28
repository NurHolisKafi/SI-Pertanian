<?php

namespace Database\Seeders;

use App\Models\Kebutuhan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KebutuhanSeeder extends Seeder
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
                'harga' => 28000,
                'id_jenis' => 1
            ], [
                'nama' => 'bibit jagung(mahal)',
                'harga' => 55000,
                'id_jenis' => 1
            ], [
                'nama' => 'pupuk kandang',
                'harga' => 5000,
                'id_jenis' => 1
            ], [
                'nama' => 'pupuk urea',
                'harga' => 10000,
                'id_jenis' => 1
            ], [
                'nama' => 'pupuk phonska',
                'harga' => 15000,
                'id_jenis' => 1
            ], [
                'nama' => 'cangkul',
                'harga' => 50000,
                'id_jenis' => 2
            ], [
                'nama' => 'mesin tanam jagung',
                'harga' => 1000000,
                'id_jenis' => 2
            ]
        ];

        foreach ($data as $item) {
            Kebutuhan::create($item);
        }
    }
}
