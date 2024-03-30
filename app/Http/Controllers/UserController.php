<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // public function index()
    // {

    //     // $user = UserModel::all();
    //     // return view('user',['data'=>$user]);
    //     $user = UserModel::with('level')->get();
    //     return view('user',['data'=> $user]);
    // }
    // public function tambah()
    // {
    //     return view('user_tambah');
    // }
    // public function tambah_simpan(Request $request)
    // {
    //     UserModel::create([
    //         'username'=>$request->username,
    //         'nama'=>$request->nama,
    //         'password'=>Hash::make('$request->password'),
    //         'level_id'=>$request->level_id
    //     ]);
    //     return redirect('/user');
    // }
    // public function ubah($id)
    // {
    //     $user = UserModel::find($id);
    //     return view('user_ubah',['data' => $user]);
    // }
    // public function ubah_simpan($id,Request $request)
    // {
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }
    // public function hapus($id)
    // {
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }
    public function index(UserDataTable $dataTable)
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list'  => ['Home','User']
        ];
        $page =(object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];
        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index',['breadcrumb'=>$breadcrumb,'page'=>$page,'level'=>$level,'activeMenu'=>$activeMenu]);
    }
    // Ambil data user dalam bentuk json untuk datatables
public function list(Request $request)
{
$users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');
if($request->level_id){
    $users->where('level_id',$request->level_id);
}
return DataTables::of($users)
->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
->addColumn('aksi', function ($user) { // menambahkan kolom aksi
$btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm" > Detail</a> ';
$btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
$btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id).'">'. csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm"onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
return $btn;
})
->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
->make(true);
}
public function create()
{
    $breadcrumb = (object)[
        'title' => 'Tambah User',
        'list'  => ['Home','User','Tambah']
    ];

    $page = (object) [
        'title'=>'Tambah user baru'
    ];

    $level = LevelModel::all();
    $activeMenu = 'user';

    return view('user.create',['breadcrumb'=>$breadcrumb,'page'=>$page,'level'=>$level,'activeMenu'=>$activeMenu]);
}
public function store(Request $request)
{
    $request->validate([
        //username harus diisi,beruba string,minim 3 karakter,dan bernilai unik di tabel user kolom username
        'username' => 'required|string|min:3|unique:m_user,username',
        'nama'     => 'required|string|max:100',
        'password' => 'required|min:5',
        'level_id' => 'required|integer'
    ]);
    
    UserModel::create([
        'username' => $request->username,
        'nama'     => $request->nama,
        'password' => bcrypt($request->password),
        'level_id' => $request->level_id
    ]);
    return redirect('/user')->with('success','Data User berhasil disimpan');
}
public function show(string $id)
{
    $user = UserModel::with('level')->find($id);

    $breadcrumb = (object)[
        'title' => 'Detail User',
        'list'  => ['Home','User','Detail']
    ];
    $page = (object) [
        'title'=>'Detail user'
    ];

    $activeMenu = '/user';
    return view('user.show',['breadcrumb'=>$breadcrumb,'page'=>$page,'user'=>$user,'activeMenu'=>$activeMenu]);
}
public function edit(string $id)
{
    $user = UserModel::find($id);
    $level = LevelModel::all();

    $breadcrumb = (object)[
        'title' => 'Edit User',
        'list'  => ['Home','User','Edit']
    ];
    $page = (object) [
        'title'=>'Edit user'
    ];
    $activeMenu = '/user';
    return view('user.edit',['breadcrumb'=>$breadcrumb,'page'=>$page,'user'=>$user,'level'=>$level,'activeMenu'=>$activeMenu]);
}
public function update(Request $request,string $id)
{
    $request->validate([
        //username harus diisi,beruba string,minim 3 karakter,dan bernilai unik di tabel user kolom username
        'username' => 'required|string|min:3|unique:m_user,username',
        'nama'     => 'required|string|max:100',
        'password' => 'required|min:5',
        'level_id' => 'required|integer'
    ]);
    UserModel::find($id)->update([
        'username' => $request->username,
        'nama'     => $request->nama,
        'password' => $request->password ? bcrypt($request->password): UserModel::find($id)->password,
        'level_id' => $request->level_id
    ]);
    return redirect('/user')->with('success','Data User berhasil diubah');
}
public function destroy(string $id)
{
    $check = UserModel::find($id);
    if(!$check){
        return redirect('/user')->with('error','Data Tidak ditemukan');
    }

    try{
        UserModel::destroy($id);

        return redirect('/user')->with('succes','Data user berhasil dihapus');
    }catch(\Illuminate\Database\QueryException $e){

        return redirect('/user')->with('error','Dara user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
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