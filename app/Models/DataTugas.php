<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTugas extends Model
{
    use HasFactory;

    protected $table = 'data_tugas';
    public $timestamps = true;
    protected $fillable = ['nama', 'nim', 'nama_file', 'path_file', 'waktu_kumpul'];
}