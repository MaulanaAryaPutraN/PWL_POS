<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'LTP',
                'kategori_nama' => 'laptop',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'HP',
                'kategori_nama' => 'hp',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'MBL',
                'kategori_nama' => 'mobil',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'SPD',
                'kategori_nama' => 'sepeda',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'PKN',
                'kategori_nama' => 'pakaian',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}