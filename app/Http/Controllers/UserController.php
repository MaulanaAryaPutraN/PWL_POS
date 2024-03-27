<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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
//        $user = m_userModel::with('level')->get();
//        return view('m_user', ['data' => $user]);

        return $dataTable->render('user.index');
    }

    public function create(): view
    {
        return view('user.create');
    }
    public function store(UserRequest $request): RedirectResponse
    {
        /**
         * The incoming request is valid...
         */
        /**
         * Retrieve the validated input data...
         */
        $validated = $request->validated();
        /**
         * Retrieve a portion of the validated input data...
         */

        $validated = $request->safe()->only(['nama', 'password','level_id']);

        UserModel::create([
            'username' => $request['username'],
            'nama' => $validated['nama'],
            'password' => $validated['password'],
            'level_id' => $validated['level_id'],
        ]);

        return redirect('/user');
    }
    public function tambah()
    {
        return view('user_tambah');
    }
    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);
        return redirect('/user');
    }
    public function ubah($id)
    {
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }
    public function ubah_simpan($id, Request $request)
    {
        $user = UserModel::find($id);
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;
        $user->save();
        return redirect('/user');
    }
    public function hapus($id)
    {
        $user = UserModel::find($id);
        $user->delete();
        return redirect('/user');
    }
}