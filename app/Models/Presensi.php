<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    // Specify the table name if it differs from the model name in plural
    protected $table = 'presensi';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'nim',
        'timestamp',
        'jenis',
        'lokasi',
        'kamera'
    ];
}
