<!DOCTYPE html>
<html>
<head>
    <title>Simulasi Investor</title>

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

        .deskripsi {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input:focus,
        select:focus {
            border-color: #1565c0;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #1565c0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0d47a1;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Simulasi Investor</h1>
    <p class="deskripsi">Form Data Profil Investor</p>
    <form action="{{ route('prosesinvestor') }}" method="POST">
        @csrf
        <label>Nama Investor</label>
        <input type="text" name="nama" placeholder="Masukkan nama" required><br><br>
        <label>Jenis Investasi</label>
        <select name="jenis_investasi" required>
            <option value="">Pilih Investasi</option>
            <option value="Saham">Saham</option>
            <option value="Reksa Dana">Reksa Dana</option>
            <option value="Obligasi">Obligasi</option>
            <option value="Emas">Emas</option>
        </select><br><br>
        <label>Modal Investasi (Rp)</label>
        <input
            type="number"
            name="modal"
            placeholder="Contoh: 5000000"
            min="0"
            required><br><br>
        <label>Jangka Waktu Investasi</label>
        <select name="jangka_waktu" required>
            <option value="">Pilih Jangka Waktu</option>
            <option value="Kurang dari 1 Tahun">Kurang dari 1 Tahun</option>
            <option value="1 - 3 Tahun">1 - 3 Tahun</option>
            <option value="3 - 5 Tahun">3 - 5 Tahun</option>
            <option value="Lebih dari 5 Tahun">Lebih dari 5 Tahun</option>
        </select>
        <button type="submit">Proses Data Investor</button>
    </form>
</div>
</body>
</html>