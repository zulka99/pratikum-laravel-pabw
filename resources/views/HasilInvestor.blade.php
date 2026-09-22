<!DOCTYPE html>
<html>
<head>
    <title>Hasil Data Investor</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f6fc;
            margin: 0;
            padding: 40px;
        }

        .container {
            width: 450px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #1565c0;
            margin-bottom: 10px;
        }

        .status {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        .data {
            background-color: #f5f7fa;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 10px;
        }

        .data strong {
            color: #333;
        }

        .data span {
            display: block;
            margin-top: 5px;
            color: #555;
        }

        .kembali {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 12px;
            background-color: #1565c0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .kembali:hover {
            background-color: #0d47a1;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Hasil Data Investor</h1>
    <p class="status">
        Data investor berhasil diproses.
    </p>
    <div class="data">
        <strong>Nama Investor</strong>
        <span>{{ $nama }}</span>
    </div>
    <div class="data">
        <strong>Jenis Investasi</strong>
        <span>{{ $jenisInvestasi }}</span>
    </div>
    <div class="data">
        <strong>Modal Investasi</strong>
        <span>Rp {{ number_format($modal, 0, ',', '.') }}</span>
    </div>
    <div class="data">
        <strong>Jangka Waktu</strong>
        <span>{{ $jangkaWaktu }}</span>
    </div>
    <a href="{{ route('forminvestor') }}" class="kembali">Kembali ke Form</a>
</div>
</body>
</html>