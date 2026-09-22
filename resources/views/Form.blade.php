<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Biodata</title>
</head>
<body>
    <h2>Input Biodata</h2>
    <form action="/proses" method="post">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="nama"><br><br>

        <label>Umur:</label><br>
        <input type="number" name="umur"><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat"></textarea><br><br>

        <button type="submit">Kirim</button>
    </form>
</body>
</html>