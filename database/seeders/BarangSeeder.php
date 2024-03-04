<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'barang_kode' => 'ROG',
                'kategori_id' => 1,
                'barang_nama' => 'Republik OF Gamer',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 2,
                'barang_kode' => 'LGN',
                'kategori_id' => 1,
                'barang_nama' => 'Legion',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 3,
                'barang_kode' => 'XIO',
                'kategori_id' => 2,
                'barang_nama' => 'xiaomi redmi 5 plus',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 4,
                'barang_kode' => 'PCO',
                'kategori_id' => 2,
                'barang_nama' => 'poco x6',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 5,
                'barang_kode' => 'CVC',
                'kategori_id' => 3,
                'barang_nama' => 'civic turbo type r',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 6,
                'barang_kode' => 'AVN',
                'kategori_id' => 3,
                'barang_nama' => 'avanza',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 7,
                'barang_kode' => 'VRO',
                'kategori_id' => 4,
                'barang_nama' => 'vario',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 8,
                'barang_kode' => 'BET',
                'kategori_id' => 4,
                'barang_nama' => 'beat',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 9,
                'barang_kode' => 'MTR',
                'kategori_id' => 5,
                'barang_nama' => 'maternal disaster',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 10,
                'barang_kode' => 'EMB',
                'kategori_id' => 5,
                'barang_nama' => 'emba',
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],

        ];
        DB::table('m_barang')->insert($data);
    }
}