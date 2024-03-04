<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => "Maulana",
                'penjualan_kode' => 'KODE1',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 1,
                'pembeli' => "Arya",
                'penjualan_kode' => 'KODE2',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 1,
                'pembeli' => "Putra",
                'penjualan_kode' => 'KODE3',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 2,
                'pembeli' => "Nugraha",
                'penjualan_kode' => 'KODE4',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => "Yusriyah",
                'penjualan_kode' => 'KODE5',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 2,
                'pembeli' => "Atiyan",
                'penjualan_kode' => 'KODE6',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => "Nopal",
                'penjualan_kode' => 'KODE7',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => "Dido",
                'penjualan_kode' => 'KODE8',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => "Yuma",
                'penjualan_kode' => 'KODE9',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => "Tata",
                'penjualan_kode' => 'KODE10',
                'penjualan__tanggal' => '2000-12-25 00:28:00',
            ],

        ];
        DB::table('t_penjualan')->insert($data);
    }
}