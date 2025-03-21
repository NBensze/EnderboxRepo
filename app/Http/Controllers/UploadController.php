<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use DateTime;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use lluminate\Http\RedirectResponse;

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
               'FileUploadINP' => 'required',
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
                'File_extension' => $Req->FileUploadINP->extension(),
                'File_blob' => file_get_contents($Req->FileUploadINP->getRealPath()),
                'File_comment' => $Req->FileCommentTAREA,
            ]);

            if (Auth::check())
            {
                session()->flash('upload_session', 'success');
            }


        return redirect()->back();
    }

    //Delete
    public function delete($a)
    {
        Upload::where('File_hash', $a)->delete();
        //Upload::delete($a);
        return redirect()->back()->with('success', $a);
        //echo $a;
        //Upload::where('File_hash', $a)->delete();
    }

    public function download($index)
    {
        $File = Upload::find($index); //Upload::where('File_hash', 'LIKE', $index); //Upload::where('User_hash', 'LIKE', Auth::user()->User_hash)->get();
        return response($File->File_blob)->header('Content-Type', $File->File_extension)->header('Content-Disposition', 'attachment; filename='.$File->File_name.".".$File->File_extension)->header('Content-Length', strlen($File->File_blob));
        //return Storage::download('/download/', $File->File_blob);
    }
    
}
