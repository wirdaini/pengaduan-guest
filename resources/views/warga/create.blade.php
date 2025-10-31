<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Warga - PBN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .form-section {
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .form-section:last-child {
            border-bottom: none;
        }
        .section-title {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="form-container">
                    <h1 class="text-center mb-4">📋 Form Data Warga</h1>
                    <p class="text-center text-muted mb-4">PBN - Layanan Digital Masyarakat</p>

                    <form action="{{ route('datawarga.store') }}" method="POST">
                        @csrf

                        <!-- Data Pribadi -->
                        <div class="form-section">
                            <h3 class="section-title">Data Pribadi</h3>

                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan) *</label>
                                <input type="text" class="form-control" id="nik" name="no_ktp" placeholder="16 digit NIK" maxlength="16" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap *</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir *</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="agama" class="form-label">Agama *</label>
                                        <select class="form-control" id="agama" name="agama" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="islam">Islam</option>
                                            <option value="kristen">Kristen</option>
                                            <option value="katolik">Katolik</option>
                                            <option value="hindu">Hindu</option>
                                            <option value="buddha">Buddha</option>
                                            <option value="konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status Perkawinan *</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="belum_kawin">Belum Kawin</option>
                                            <option value="kawin">Kawin</option>
                                            <option value="cerai_hidup">Cerai Hidup</option>
                                            <option value="cerai_mati">Cerai Mati</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Alamat -->
                        <div class="form-section">
                            <h3 class="section-title">Data Alamat</h3>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="rt" class="form-label">RT *</label>
                                        <input type="text" class="form-control" id="rt" name="rt" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="rw" class="form-label">RW *</label>
                                        <input type="text" class="form-control" id="rw" name="rw" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kelurahan" class="form-label">Kelurahan/Desa *</label>
                                        <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan *</label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota/Kabupaten *</label>
                                        <input type="text" class="form-control" id="kota" name="kota" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Kontak & Pekerjaan -->
                        <div class="form-section">
                            <h3 class="section-title">Data Kontak & Pekerjaan</h3>

                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan *</label>
                                <select class="form-control" id="pekerjaan" name="pekerjaan" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    <option value="pns">PNS</option>
                                    <option value="swasta">Swasta</option>
                                    <option value="wiraswasta">Wiraswasta</option>
                                    <option value="pelajar">Pelajar/Mahasiswa</option>
                                    <option value="irt">Ibu Rumah Tangga</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">No. Telepon/HP *</label>
                                        <input type="tel" class="form-control" id="telepon" name="telp" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar Data Warga</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg">Kembali ke Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Format input NIK hanya angka
        document.getElementById('nik').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Format input telepon hanya angka
        document.getElementById('telepon').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Set tanggal default untuk tanggal lahir (18 tahun yang lalu)
        const today = new Date();
        const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        document.getElementById('tanggal_lahir').valueAsDate = eighteenYearsAgo;
    </script>
</body>
</html>
