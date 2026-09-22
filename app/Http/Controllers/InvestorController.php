<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function form()
    {
        return view('FormInvestor');
    }

    public function proses(Request $request)
    {
        $nama = $request->input('nama');
        $jenisInvestasi = $request->input('jenis_investasi');
        $modal = $request->input('modal');
        $jangkaWaktu = $request->input('jangka_waktu');

        return view('HasilInvestor', [
            'nama' => $nama,
            'jenisInvestasi' => $jenisInvestasi,
            'modal' => $modal,
            'jangkaWaktu' => $jangkaWaktu
        ]);
    }
}