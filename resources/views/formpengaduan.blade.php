<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #111;
            padding: 20px;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #fff;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #444;
            border-radius: 4px;
            background: #222;
            color: #fff;
        }
        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            border: none;
            background: #444;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Pengaduan</h2>
        <form>
            <label for="nomor_tiket">Nomor Tiket</label>
            <input type="text" id="nomor_tiket" name="nomor_tiket">

            <label for="warga_id">Warga ID</label>
            <input type="text" id="warga_id" name="warga_id">

            <label for="kategori_id">Kategori</label>
            <select id="kategori_id" name="kategori_id">
                <option value="1">Fasilitas Umum</option>
                <option value="2">Lingkungan</option>
                <option value="3">Lain-lain</option>
            </select>

            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul">

            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"></textarea>

            <label for="status">Status</label>
            <input type="text" id="status" name="status">

            <label for="lokasi_text">Lokasi</label>
            <input type="text" id="lokasi_text" name="lokasi_text">

            <label for="rt">RT</label>
            <input type="text" id="rt" name="rt">

            <label for="rw">RW</label>
            <input type="text" id="rw" name="rw">

            <label for="lampiran">Lampiran Bukti</label>
            <input type="file" id="lampiran" name="lampiran">

            <button type="submit">Kirim</button>
        </form>
    </div>
</body>
</html>
