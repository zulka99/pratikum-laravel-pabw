<!DOCTYPE html>
<html>
<head>
    <title>LaporBanjir</title>
</head>
<body>
    <h1>Laporan Banjir</h1>
    <p>Form Pelaporan Kejadian Banjir</p>
    <form action="/laporbanjir/proses" method="POST">
        @csrf
        <label>Nama Pelapor</label><br>
        <input type="text" name="nama" required><br><br>
        <label>Lokasi Kejadian</label><br>
        <input type="text" name="lokasi" required><br><br>
        <label>Tinggi Genangan Air (cm)</label><br>
        <input type="number" name="tinggi_genangan" required><br><br>
        <button type="submit">Kirim Laporan</button>

    </form>
</body>
</html>