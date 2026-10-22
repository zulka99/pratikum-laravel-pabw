@extends('layouts.app')

@section('content')
    <h1>Form Laporan Banjir</h1>

    @auth
        <div class="alert alert-info">
            Anda sedang login sebagai petugas; form ini adalah mode warga.
        </div>
    @else
        <div class="alert alert-secondary">
            Anda melapor sebagai warga tanpa login.
        </div>
    @endauth

    <form action="/laporbanjir/simpan" method="POST">
        @csrf
        <div>
            <label>Nama Pelapor</label>
            <input type="text" name="nama_pelapor" required>
        </div>
        <br>
        <div>
            <label>Lokasi</label>
            <input type="text" name="lokasi" required>
        </div>
        <br>
        <div>
            <label>Tinggi Genangan (cm)</label>
            <input type="number" name="tinggi_genangan" required>
        </div>
        <br>
        <div>
            <label>Tanggal Kejadian</label>
            <input type="date" name="tanggal_kejadian" required>
        </div>
        <br>
        <button type="submit">Kirim Laporan</button>
    </form>
@endsection
