<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    //Index
    public function new()
    {
        return view('upload.index');
    }

    //Store
    public function store(Request $Req)
    {
        
        $Req->validate(
            [
               'FileNameINP' => 'required|string|max:100',
               'FileCommentTAREA' => 'string|max:500',    
            ]);

        $Now = new DateTime();
        $HashSeed = $Now->format('Y-m-d_H:i:s').$Req->FileNameINP;
        
        $UserHash = "";

        if (Auth::check())
        {
            $UserHash = Auth::user()->User_hash;
        }

        Upload::create(
            [
                'User_hash' => $UserHash,
                'File_hash' => hash('sha256', $HashSeed),
                'File_name' => $Req->FileNameINP,
                'File_blob' => $Req->FileUploadINP,
                'File_comment' => $Req->FileCommentTAREA,
            ]);
        
        return redirect()->back();
    }
}
