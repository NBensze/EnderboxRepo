<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;

class AdminController extends Controller
{
    public function index()
    {
        $AllFiles = Upload::all();
        return view('admin.index', compact('AllFiles'));
    }
}
