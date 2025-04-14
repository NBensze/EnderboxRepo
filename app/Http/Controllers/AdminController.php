<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $AllFiles = Upload::all();
        return view('admin.index', compact('AllFiles'));
    }
}
