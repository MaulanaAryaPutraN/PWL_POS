<?php
namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (Object)[
            'title' => 'Selamat Datang',
            'list'  => ['Home','Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('welcome',['breadcrumb' => $breadcrumb,'activeMenu' => $activeMenu]);
    }
}
