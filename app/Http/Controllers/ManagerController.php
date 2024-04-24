<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard Manager',
            'list' => ['Home', 'Manager']
        ];

        $page = (object) [
            'title' => 'Dashboard Manager'
        ];

        $activeMenu = 'dashboard'; //set menu yang aktif

        return view('manager', compact('breadcrumb', 'page', 'activeMenu'));
    }
}