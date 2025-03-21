<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use DateTime;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //Index
    public function index()
    {
        $Uploads = Upload::where('User_hash', 'LIKE', Auth::user()->User_hash)->get();
        return view('upload.index', compact('Uploads'));
    }

    //Create
    public function create()
    {
        return view('upload.create');
    }

    //Store
    public function store(Request $Req)
    {
        
        $Req->validate(
            [
               'FileNameINP' => 'required|string|max:100',
               //'FileUploadINP' => 'required|file',
               'FileCommentTAREA' => 'string|max:500',    
            ]);

        $Now = new DateTime();
        $HashSeed = $Now->format('Y-m-d_H:i:s').$Req->FileNameINP;
        
        $UserHash = "";

        if (Auth::check())
        {
            $UserHash = Auth::user()->User_hash;
        }
/*
        $FIle = $Req->file($Req->FileUploadINP);
         $ext = $FIle->extension();

        session()->flash('success', $ext);/**/ 

        Upload::create(
            [
                'User_hash' => $UserHash,
                'File_hash' => hash('sha256', $HashSeed),
                'File_name' => $Req->FileNameINP,
                'File_extension' =>  ".".explode(".", $Req->FileUploadINP)[1],
                'File_blob' => $Req->FileUploadINP,
                'File_comment' => $Req->FileCommentTAREA,
            ]);
        
        return redirect()->back();
    }

    //Delete
    public function delete($a)
    {
        Upload::where('File_hash', $a)->delete();
        //Upload::delete($a);
        //return redirect()->back()->with('success', $a);
        //echo $a;
        //Upload::where('File_hash', $a)->delete();
    }

    public function download($index)
    {
        $File = Upload::find($index); //Upload::where('File_hash', 'LIKE', $index); //Upload::where('User_hash', 'LIKE', Auth::user()->User_hash)->get();
        return response($File->File_blob)->header('Content-Type', $File->File_extension)->header('Content-Disposition', 'attachment; filename='.$File->File_name);
        //return Storage::download('/download/', $File->File_blob);
    }
    
}
