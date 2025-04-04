<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

Route::middleware('auth')->group(function ()
{
    Route::get('/main', [UploadController::class, 'index'])->name('upload.index');
    Route::delete('/main{a}', [UploadController::class, 'delete'])->name('upload.delete');
    Route::get('/main{index}', [UploadController::class, 'download'])->name('upload.download');
});

Route::get('/view{hash}', [UploadController::class, 'view'])->name('upload.view');

//Sessions
Route::get('/set-session', function() 
{
    //session(['XD' => 'success']);
    //return redirect()->route('Session');
});

require __DIR__.'/auth.php';
