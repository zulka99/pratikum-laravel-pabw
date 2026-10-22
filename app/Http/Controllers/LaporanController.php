<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function form()
    {
        return view('form-laporan');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'lokasi' => 'required',
            'tinggi_genangan' => 'required',
            'tanggal_kejadian' => 'required|date',
        ]);

        Laporan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'lokasi' => $request->lokasi,
            'tinggi_genangan' => $request->tinggi_genangan,
            'tanggal_kejadian' => $request->tanggal_kejadian,
        ]);

        return view('hasil-laporan');
    }

    public function daftar()
    {
        $laporan = Laporan::all();

        return view('daftar-laporan', compact('laporan'));
    }
}
