<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use DateTime;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //Index
    public function index()
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
        
        Upload::create(
            [
                'User_hash' => $HashSeed,
                'File_hash' => hash('sha256', $HashSeed),
                'File_name' => $Req->FileNameINP,
                'File_blob' => $Req->FileUploadINP,
                'File_comment' => $Req->FileCommentTAREA,
            ]);
        
        return redirect()->back();
    }
}
