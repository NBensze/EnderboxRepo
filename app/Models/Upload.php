<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'User_hash', 'File_hash', 'File_name', 'File_blob', 'File_comment'];
}
