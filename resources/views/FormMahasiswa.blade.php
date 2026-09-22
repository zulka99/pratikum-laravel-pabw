<!DOCTYPE html>
<head>
    <title>Biodata Mahasiswa</title>
</head>
<body>
    <h2>Input Biodata Mahasiswa</h2>
    <form action="/PostMahasiswa" method="post">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="nama"><br><br>

        <label>NIM:</label><br>
        <input type="text" name="nim"><br><br>

        <label>Program Studi:</label><br>
        <input type="text" name="programstudi"><br><br>

        <label>Semester:</label><br>
        <input type="number" name="semester"><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>