<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAbsen extends Model
{
    use HasFactory;

    protected $table = 'data_absen';
    public $timestamps = true;
    protected $fillable = ['nama', 'nim'];
}