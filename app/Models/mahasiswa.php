<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';    
    protected $fillable = ['nim', 'nama','dosen'];

    public function dosen()
    {
        return $this->belongsTo(Dummy::class); // Relasi ke tabel dosen
    }
}