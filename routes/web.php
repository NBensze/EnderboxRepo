<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

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

//Upload without login
Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');

//Upload with login
Route::middleware('auth')->group(function ()
{
    Route::get('/main', [UploadController::class, 'index'])->name('upload.index');
    Route::delete('/main{a}', [UploadController::class, 'delete'])->name('upload.delete');
    Route::get('/main{index}', [UploadController::class, 'download'])->name('upload.download');
});

//View (login not required)
Route::get('/view/{hash}', [UploadController::class, 'view'])->name('upload.view');


//Admin stuff
Route::middleware(AdminMiddleware::class)->group(function () 
{
    Route::delete('/admin/index{deletehash}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/index', [AdminController::class, 'searchbyuser'])->name('admin.searchbyuser');
});
//Route::get('/admin/index', [AdminController::class, 'getall'])->name('admin.getall')->middleware(AdminMiddleware::class);


require __DIR__.'/auth.php';
