<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = ['nama_pelapor', 'lokasi', 'tinggi_genangan', 'tanggal_kejadian'];
}
