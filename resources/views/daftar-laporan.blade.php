@extends('layouts.app')

@section('content')
    <h1>Daftar Laporan Banjir</h1>
    @foreach ($laporan as $data)
        @if ($data->tinggi_genangan <= 50)
            @php
                $status = 'Waspada';
            @endphp
        @elseif ($data->tinggi_genangan <= 100)
            @php
                $status = 'Siaga';
            @endphp
        @else
            @php
                $status = 'Awas';
            @endphp
        @endif
        <div>
            <h3>{{ $data->nama_pelapor }}</h3>
            <p>
                Lokasi: {{ $data->lokasi }}
            </p>
            <p>
                Tinggi Genangan:
                {{ $data->tinggi_genangan }} cm
            </p>
            <p>
                Tanggal:
                {{ $data->tanggal_kejadian }}
            </p>
            <p>
                Status:
                <strong>{{ $status }}</strong>
            </p>
            <hr>
        </div>
    @endforeach
@endsection
