<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Madrasah extends Model
{
    use HasFactory;
    protected $table = "madrasah";
    public $incrementing = false;
  
    protected $fillable = [
        'kode_madrasah',
        'nama_madrasah',
        'lokasi_madrasah',
        'radius_madrasah',
        
    ];
}
