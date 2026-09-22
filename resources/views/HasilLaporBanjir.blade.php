<!DOCTYPE html>
<html>
<head>
    <title>Hasil Laporan Banjir</title>
</head>
<body>
    <h1>Laporan Banjir</h1>
    <p>Laporan berhasil diproses.</p>
    <p>
        <strong>Nama Pelapor:</strong>
        {{ $nama }}
    </p>
    <p>
        <strong>Lokasi Kejadian:</strong>
        {{ $lokasi }}
    </p>
    <p>
        <strong>Tinggi Genangan:</strong>
        {{ $tinggiGenangan }} cm
    </p><br>
    <a href="/laporbanjir">Kembali ke Form</a>
</body>
</html>