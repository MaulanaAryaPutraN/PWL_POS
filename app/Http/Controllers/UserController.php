<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // $data = [
        //     'level_id'=>2,
        //     'username'=>'manager_tiga',
        //     'nama'=>'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        $user = UserModel::create(
            [
                'username'=>'manager11',
                'nama'=>'Manager11',
                'password'=> Hash::make('12345'),
                'level_id'=> 2
            ]
        );
        // dd($user);

        $user->username='Manager12';

        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged(['username','level_id']);
        $user->wasChanged('nama');
        dd($user->wasChanged(['nama','username']));
    }
}
