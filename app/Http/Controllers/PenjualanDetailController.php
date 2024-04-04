<?php

namespace App\Http\Controllers;

use App\DataTables\PenjualanDetailDataTable;
use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\BarangModel;
use App\Models\LevelModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Database\Seeders\PenjualanDetailSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PenjualanDetailController extends Controller
{
    public function index(PenjualanDetailDataTable $dataTable)
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Transaksi',
            'list'  => ['Home','Transaksi']
        ];
        $page =(object) [
            'title' => 'Daftar transaksi yang terdaftar dalam sistem'
        ];
        $activeMenu = 'transaksi';

        $penjualan = PenjualanModel::all();
        $user = UserModel::all();
        $barang = BarangModel::all();

        return view('transaksi.index',['breadcrumb'=>$breadcrumb,'page'=>$page,'user'=>$user,'barang'=>$barang,'penjualan'=>$penjualan,'activeMenu'=>$activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $penjualandetails = PenjualanDetailModel::with(['penjualan.user', 'barang']); 
    
        if ($request->barang_id) {
            $penjualandetails->where('barang_id', $request->barang_id);
        }
    
        return DataTables::of($penjualandetails)
            ->addIndexColumn() 
            ->addColumn('user_nama', function ($penjualandetail) { 
                return $penjualandetail->penjualan->user->nama; 
            })
            ->addColumn('aksi', function ($penjualandetail) { 
                $btn = '<a href="'.url('/transaksi/' . $penjualandetail->detail_id).'" class="btn btn-info btn-sm" > Detail</a> ';
                $btn .= '<a href="'.url('/transaksi/' . $penjualandetail->detail_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/transaksi/'.$penjualandetail->detail_id).'">'. csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) 
            ->make(true);
    }
    
public function create()
{
    $breadcrumb = (object)[
        'title' => 'Tambah Transaksi',
        'list'  => ['Home','Transaksi','Tambah']
    ];

    $page = (object) [
        'title'=>'Tambah transaksi baru'
    ];

    $barang = BarangModel::all();
    $penjualan = PenjualanModel::all();
    $user = UserModel::all();
    $activeMenu = 'transaksi';

    return view('transaksi.create',['breadcrumb'=>$breadcrumb,'page'=>$page,'barang'=>$barang,'penjualan'=>$penjualan,'user'=>$user,'activeMenu'=>$activeMenu]);
}


public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'pembeli' => 'required|string|max:100|unique:t_penjualan,pembeli',
        'barang_id' => 'required',
        'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
        'penjualan_tanggal' => 'required',
        'harga' => 'required|integer',
        'jumlah' => 'required|integer'
    ]);

    
    $penjualan = PenjualanModel::create([
        'user_id' => $request->user_id,
        'pembeli' => $request->pembeli,
        'penjualan_kode' => $request->penjualan_kode,
        'penjualan_tanggal' => $request->penjualan_tanggal
    ]);

    
    $penjualanDetail = new PenjualanDetailModel([
        'barang_id' => $request->barang_id,
        'harga' => $request->harga,
        'jumlah' => $request->jumlah
    ]);

   
    $penjualan->penjualanDetails()->save($penjualanDetail);

    return redirect('/transaksi')->with('success', 'Data Transaksi berhasil disimpan');
}

public function show(string $id)
{
    $penjualandetail = PenjualanDetailModel::with('barang','penjualan')->find($id);

    $breadcrumb = (object)[
        'title' => 'Detail Penjualan',
        'list'  => ['Home','Penjualan','Detail']
    ];
    $page = (object) [
        'title'=>'Detail penjualan'
    ];

    $activeMenu = '/transaksi';
    return view('transaksi.show',['breadcrumb'=>$breadcrumb,'page'=>$page,'penjualandetail'=>$penjualandetail,'activeMenu'=>$activeMenu]);
}
public function edit(string $id)
{
    $penjualandetail = PenjualanDetailModel::find($id);
    $penjualan = PenjualanModel::all();
    $barang= BarangModel::all();
    $user = UserModel::all();

    $breadcrumb = (object)[
        'title' => 'Edit Transaksi',
        'list'  => ['Home','Transaksi','Edit']
    ];
    $page = (object) [
        'title'=>'Edit transaksi'
    ];
    $activeMenu = '/transaksi';
    return view('transaksi.edit',['breadcrumb'=>$breadcrumb,'page'=>$page,'penjualandetail'=>$penjualandetail,'penjualan'=>$penjualan,'barang'=>$barang,'user'=>$user,'activeMenu'=>$activeMenu]);
}
public function update(Request $request, string $id)
{
    $request->validate([
        'user_id' => 'required',
        'pembeli' => 'required|string|max:100||unique:t_penjualan,pembeli',
        'barang_id' => 'required',
        'penjualan_kode' => 'required|string|unique:t_penjualan,penjualan_kode',
        'penjualan_tanggal' => 'required',
        'harga' => 'required|integer',
        'jumlah' => 'required|integer'
    ]);

    // Temukan data penjualan detail berdasarkan ID
    $penjualanDetail = PenjualanDetailModel::find($id);

    // Pastikan data ditemukan sebelum melanjutkan
    if($penjualanDetail) {
        // Perbarui atribut-atribut dari penjualan detail
        $penjualanDetail->update([
            'barang_id' => $request->barang_id,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah
        ]);

        // Perbarui atribut-atribut dari penjualan yang terkait
        $penjualanDetail->penjualan->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);

        return redirect('/transaksi')->with('success', 'Data Transaksi berhasil diubah');
    } else {
        // Jika data tidak ditemukan, kembalikan ke halaman sebelumnya dengan pesan error
        return back()->with('error', 'Data tidak ditemukan');
    }
}

public function destroy(string $id)
{
    $check = PenjualanDetailModel::find($id);
    if(!$check){
        return redirect('/transaksi')->with('error','Data Tidak ditemukan');
    }

    try{
        PenjualanDetailModel::destroy($id);

        return redirect('/transaksi')->with('succes','Data user berhasil dihapus');
    }catch(\Illuminate\Database\QueryException $e){

        return redirect('/transaksi')->with('error','Dara user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}
//     public function create(): view
//     {
//         return view('user.create');
//     }
//     public function store(UserRequest $request): RedirectResponse
//     {
//         /**
//          * The incoming request is valid...
//          */
//         /**
//          * Retrieve the validated input data...
//          */
//         $validated = $request->validated();
//         /**
//          * Retrieve a portion of the validated input data...
//          */

//         $validated = $request->safe()->only(['nama', 'password','level_id']);

//         UserModel::create([
//             'username' => $request['username'],
//             'nama' => $validated['nama'],
//             'password' => $validated['password'],
//             'level_id' => $validated['level_id'],
//         ]);

//         return redirect('/user');
//     }
//     public function tambah()
//     {
//         return view('user_tambah');
//     }
//     public function tambah_simpan(Request $request)
//     {
//         UserModel::create([
//             'username' => $request->username,
//             'nama' => $request->nama,
//             'password' => Hash::make($request->password),
//             'level_id' => $request->level_id,
//         ]);
//         return redirect('/user');
//     }
//     public function ubah($id)
//     {
//         $user = UserModel::find($id);
//         return view('user_ubah', ['data' => $user]);
//     }
//     public function ubah_simpan($id, Request $request)
//     {
//         $user = UserModel::find($id);
//         $user->username = $request->username;
//         $user->nama = $request->nama;
//         $user->level_id = $request->level_id;
//         $user->save();
//         return redirect('/user');
//     }
//     public function hapus($id)
//     {
//         $user = UserModel::find($id);
//         $user->delete();
//         return redirect('/user');
//     }
 }