<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporBanjirController extends Controller
{
    public function form()
    {
        return view('FormLaporBanjir');
    }

    public function proses(Request $requestdata)
    {
        $nama = $requestdata->input('nama');
        $lokasi = $requestdata->input('lokasi');
        $tinggiGenangan = $requestdata->input('tinggi_genangan');

        return view('HasilLaporBanjir', [
            'nama' => $nama,
            'lokasi' => $lokasi,
            'tinggiGenangan' => $tinggiGenangan
        ]);
    }
}