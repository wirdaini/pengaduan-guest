@extends('layouts.app')

@section('title', 'Tambah Warga - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Appointment</h1>
                            <p class="mb-0">
                                Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo
                                odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum
                                debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat
                                ipsum dolorem.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Appointment</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Appointmnet Section -->
        <section id="appointmnet" class="appointmnet section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">
                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Isi Data Warga</h2>
                                <p>Lengkapi data diri Anda untuk dapat mengajukan pengaduan dan aspirasi.</p>
                            </div>

                            <div class="booking-steps" data-aos="fade-up" data-aos-delay="300">
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="bi bi-person-vcard"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>Data Pribadi</h4>
                                        <p>Isi informasi data diri lengkap</p>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="bi bi-house-check"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>Verifikasi Data</h4>
                                        <p>Pastikan data yang diisi benar</p>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div class="step-content">
                                        <h4>Selesai</h4>
                                        <p>Data tersimpan dan siap membuat pengaduan</p>
                                    </div>
                                </div>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="400">
                                <form action="{{ route('warga.store') }}" method="POST" class="php-email-form">
                                    @csrf
                                    <div class="row gy-4">

                                        <div class="col-12">
                                            <label for="no_ktp" class="form-label">Nomor KTP *</label>
                                            <input type="text" name="no_ktp" class="form-control"
                                                placeholder="Nomor KTP (16 digit)" required maxlength="16">
                                        </div>

                                        <div class="col-12">
                                            <label for="nama" class="form-label">Nama Lengkap *</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Nama Lengkap" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="agama" class="form-label">Agama *</label>
                                            <select name="agama" class="form-select" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="pekerjaan" class="form-label">Pekerjaan *</label>
                                            <input type="text" name="pekerjaan" class="form-control"
                                                placeholder="Pekerjaan" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="telp" class="form-label">Nomor Telepon *</label>
                                            <input type="tel" name="telp" class="form-control"
                                                placeholder="Nomor Telepon" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Alamat Email *</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Alamat Email" required>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Simpan Data Warga</button>
                                            <a href="{{ route('warga.index') }}" class="btn btn-secondary mt-2">Kembali</a>
                                        </div>

                                    </div>
                                </form>

                            </div>

                            <div class="emergency-info" data-aos="fade-up" data-aos-delay="500">
                                <p><i class="bi bi-info-circle"></i> Data yang Anda isi akan digunakan untuk proses
                                    pengaduan dan verifikasi.</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Appointmnet Section -->

    </main>
@endsection
