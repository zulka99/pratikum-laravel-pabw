<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function FormMahasiswa() {
        return view('FormMahasiswa');
    }

    public function PostMahasiswa(Request $requestdata) {
        $nama = $requestdata->input('nama');
        $nim = $requestdata->input('nim');
        $programstudi = $requestdata->input('programstudi');
        $semester = $requestdata->input('semester');

        return view('PostMahasiswa', compact('nama', 'nim', 'programstudi', 'semester'));
    }
}