<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard Admin',
            'list' => ['Home', 'Admin']
        ];

        $page = (object) [
            'title' => 'Dashboard Admin'
        ];

        $activeMenu = 'dashboard'; //set menu yang aktif

        return view('admin', compact('breadcrumb', 'page', 'activeMenu'));
    }
}