<?php

namespace Database\Seeders;

use App\Models\Tanaman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tanaman::create([
            'nama' => 'jagung'
        ]);
    }
}
