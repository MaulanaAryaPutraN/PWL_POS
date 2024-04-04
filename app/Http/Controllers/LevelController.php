<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\DataTables\LevelDataTable;
use App\Http\Requests\LevelRequest;
use App\Models\KategoriModel;
use App\Models\LevelModel;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

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

$breadcrumb = (object)[
    'title' => 'Daftar Level',
    'list'  => ['Home','Level']
];
$page =(object) [
    'title' => 'Daftar level yang terdaftar dalam sistem'
];
$activeMenu = 'level';
$level = LevelModel::all();

return view('level.index',['breadcrumb'=>$breadcrumb,'page'=>$page,'level'=>$level,'activeMenu'=>$activeMenu]);
    }
    public function list(Request $request)
    {
    $levels = LevelModel::select('level_id','level_kode', 'level_nama');
    if($request->level_id){
        $levels->where('level_id',$request->level_id);
    }
    return DataTables::of($levels)
    ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
    ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
    $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm" > Detail</a> ';
    $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
    $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/'.$level->level_id).'">'. csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
    return $btn;
    })
    ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
    ->make(true);
    }
    public function create()
{
    $breadcrumb = (object)[
        'title' => 'Tambah Level',
        'list'  => ['Home','Level','Tambah']
    ];

    $page = (object) [
        'title'=>'Tambah level baru'
    ];

    $activeMenu = 'level';

    return view('level.create',['breadcrumb'=>$breadcrumb,'page'=>$page,'activeMenu'=>$activeMenu]);
}

public function store(Request $request)
{
    $request->validate([
        //Level_kode harus diisi,beruba string,minim 3 karakter,dan bernilai unik di tabel levek kolom level_kode
        'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
        'level_nama'     => 'required|string|max:100'
    ]);
    
    LevelModel::create([
        'level_kode' => $request->level_kode,
        'level_nama'     => $request->level_nama
    ]);
    return redirect('/level')->with('success','Data Level berhasil disimpan');
}
public function show(string $id)
{
    $level = LevelModel::find($id);

    $breadcrumb = (object)[
        'title' => 'Detail Level',
        'list'  => ['Home','Level','Detail']
    ];
    $page = (object) [
        'title'=>'Detail level'
    ];

    $activeMenu = '/level';
    return view('level.show',['breadcrumb'=>$breadcrumb,'page'=>$page,'level'=>$level,'activeMenu'=>$activeMenu]);
}
public function edit(string $id)
{
    $level = LevelModel::find($id);

    $breadcrumb = (object)[
        'title' => 'Edit Level',
        'list'  => ['Home','Level','Edit']
    ];
    $page = (object) [
        'title'=>'Edit level'
    ];
    $activeMenu = '/level';
    return view('level.edit',['breadcrumb'=>$breadcrumb,'page'=>$page,'level'=>$level,'activeMenu'=>$activeMenu]);
}
public function update(Request $request,string $id)
{
    $request->validate([
        //username harus diisi,beruba string,minim 3 karakter,dan bernilai unik di tabel user kolom username
        'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
        'level_nama'     => 'required|string|max:100'
    ]);
    LevelModel::find($id)->update([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama
    ]);
    return redirect('/level')->with('success','Data Level berhasil diubah');
}
public function destroy(string $id)
{
    $check = LevelModel::find($id);
    if(!$check){
        return redirect('/level')->with('error','Data Tidak ditemukan');
    }

    try{
        LevelModel::destroy($id);

        return redirect('/level')->with('succes','Data level berhasil dihapus');
    }catch(\Illuminate\Database\QueryException $e){

        return redirect('/level')->with('error','Dara level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}

   
    // public function create(): view
    // {
    //     return view('level.create');
    // }
    // /**
    //  * validate Level form and store that in database
    //  */
    // public function store(LevelRequest $request): RedirectResponse
    // {
    //     $validated = $request->validate([
    //         'level_kode' => 'bail|required',
    //         'level_nama' => 'required'
    //     ]);

    //     return redirect('/level');
    // }

}