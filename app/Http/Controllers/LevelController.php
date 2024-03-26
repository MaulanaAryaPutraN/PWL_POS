<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable)
    {
//        DB::insert('insert into m_level(level_id, level_kode, level_nama, created_at) values(?, ?, ?, ?)', [4, 'CUS', 'Customer', now()]);
//
//        return 'Insert data berhasil';

//        $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
//        return 'Update data berhasil, jumlah data yang diupdate : ' . $row . ' baris';

//        $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
//        return 'delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

//        $data = DB::select('select * from m_level');
//        return view('m_level', ['data' => $data]);

        return $dataTable->render('level.index');
    }

    public function create(): view
    {
        return view('level.create');
    }

}