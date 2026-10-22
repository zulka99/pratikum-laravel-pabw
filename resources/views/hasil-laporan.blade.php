@extends('layouts.app')

@section('content')
    <h1>Laporan Banjir</h1>
    <x-alert>
        Laporan berhasil disimpan ke database.
    </x-alert>
    <p>Data laporan berhasil diproses.</p>
    <a href="/daftar-laporan">
        Lihat Daftar Laporan
    </a>
@endsection
