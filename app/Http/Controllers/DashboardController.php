<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function fileManager() {
        return view('admin.file-manager.index');
    }
}
