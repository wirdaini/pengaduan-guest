<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 30px;
        }
        .container {
            width: 60%;
            margin: auto;
            background: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
        }
        h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #bdbdbd;
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            background: #2a2a2a;
            border: 1px solid #444;
            border-radius: 8px;
            color: #ffffff;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="file"] {
            width: 100%;
        }
        /* fokus: garis putih tanpa cahaya */
        input:focus, textarea:focus, select:focus {
            border-color: #ffffff;
            outline: none;
        }
        textarea {
            resize: none;
        }
        /* tombol putih polos */
        button {
            width: 100%;
            padding: 14px;
            background: #ffffff;
            color: #121212;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Form Pengaduan Warga</h2>

    <form method="POST" enctype="multipart/form-data">
        @csrf
        <label for="judul">Judul Pengaduan</label>
        <input type="text" id="judul" name="judul" required>

        <label for="kategori_id">Kategori</label>
        <select id="kategori_id" name="kategori_id">
            @foreach($list_kategori as $kategori)
                <option value="{{ $kategori }}">{{ $kategori }}</option>
            @endforeach
        </select>

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>

        <label for="lokasi_text">Lokasi</label>
        <input type="text" id="lokasi_text" name="lokasi_text">

        <label for="rt">RT</label>
        <select id="rt" name="rt">
            @foreach($rt_list as $rt)
                <option value="{{ $rt }}">{{ $rt }}</option>
            @endforeach
        </select>

        <label for="rw">RW</label>
        <select id="rw" name="rw">
            @foreach($rw_list as $rw)
                <option value="{{ $rw }}">{{ $rw }}</option>
            @endforeach
        </select>

        <label for="media">Lampiran Bukti</label>
        <input type="file" id="media" name="media">

        <button type="submit">Kirim Pengaduan</button>
    </form>
</div>
</body>
</html>
