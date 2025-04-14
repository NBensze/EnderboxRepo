<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    //Delete
    public function delete($deletehash)
    {
        Upload::where('File_hash', $deletehash)->delete();
        return redirect()->back()->with('success', $deletehash);
    }

    private function getuserhash($username)
    {
        
        return $UserHash;
    }

    public function searchbyuser(Request $Req)
    {
        if ($Req->SearchINP != "")
        {
            $UserHash = User::where('name', 'LIKE', $Req->SearchINP)->get();
            $AllFiles = Upload::where('User_hash', 'LIKE', $UserHash[0]->User_hash)->get();
            return view('admin.index', compact('AllFiles'));
        }

        if ($Req->SearchINP == "")
        {
            $AllFiles = Upload::all();
            return view('admin.index', compact('AllFiles'));
        }
    }
}
