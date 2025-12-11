@extends('layouts.guest.app')

@section('title', 'Beri Penilaian Layanan - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Beri Penilaian Layanan</h1>
                            <p class="mb-0">
                                Bagikan pengalaman Anda dalam menilai pelayanan yang telah diberikan.
                                Feedback Anda sangat berharga untuk perbaikan kami.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('penilaian_layanan.index') }}">Data Penilaian</a></li>
                        <li class="current">Beri Penilaian</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Penilaian Section -->
        <section id="penilaian" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Penilaian Layanan</h2>
                                <p>Berikan penilaian jujur untuk membantu kami meningkatkan kualitas pelayanan.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('penilaian_layanan.store') }}" method="POST" class="php-email-form">
                                    @csrf

                                    <div class="row gy-4">

                                        <div class="col-12">
                                            <label for="pengaduan_id" class="form-label">Pilih Pengaduan *</label>
                                            <select name="pengaduan_id" class="form-select" required>
                                                <option value="">Pilih Pengaduan yang Sudah Selesai</option>
                                                @foreach ($pengaduan as $item)
                                                    <option value="{{ $item->pengaduan_id }}">
                                                        {{ $item->nomor_tiket }} - {{ Str::limit($item->judul, 50) }}
                                                        ({{ $item->created_at->format('d M Y') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Hanya menampilkan pengaduan dengan status 'Selesai' dan belum dinilai</small>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Rating Pelayanan *</label>
                                            <div class="rating-input">
                                                <div class="rating-stars">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                                        <label for="star{{ $i }}" title="{{ $i }} bintang">
                                                            <i class="bi bi-star-fill"></i>
                                                        </label>
                                                    @endfor
                                                </div>
                                                <div class="rating-labels mt-2">
                                                    <small class="text-muted">
                                                        <span id="rating-text">Pilih rating</span>
                                                        <span id="rating-desc"></span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="komentar" class="form-label">Komentar (Opsional)</label>
                                            <textarea name="komentar" class="form-control" rows="4"
                                                placeholder="Bagikan pengalaman atau saran perbaikan... (maks. 500 karakter)"
                                                maxlength="500"></textarea>
                                            <small class="text-muted float-end"><span id="char-count">0</span>/500 karakter</small>
                                        </div>

                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <i class="bi bi-info-circle"></i>
                                                <strong>Informasi:</strong> Penilaian hanya dapat diedit dalam 24 jam setelah dibuat.
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Kirim Penilaian</button>
                                            <a href="{{ route('penilaian_layanan.index') }}"
                                                class="btn btn-secondary mt-2">Kembali</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Penilaian Anda akan membantu kami meningkatkan kualitas pelayanan di masa depan.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Penilaian Section -->

    </main>

    <style>
        .rating-input .rating-stars {
            display: flex;
            justify-content: center;
            flex-direction: row-reverse;
            gap: 5px;
        }

        .rating-input input[type="radio"] {
            display: none;
        }

        .rating-input label {
            font-size: 2.5rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }

        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input[type="radio"]:checked ~ label {
            color: #ffc107;
        }

        .rating-input .rating-labels {
            text-align: center;
            font-size: 0.9rem;
        }

        #rating-text {
            font-weight: bold;
            color: #2c3e50;
        }

        #rating-desc {
            color: #6c757d;
            margin-left: 5px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rating star interaction
            const stars = document.querySelectorAll('.rating-input input[type="radio"]');
            const ratingText = document.getElementById('rating-text');
            const ratingDesc = document.getElementById('rating-desc');

            const ratingDescriptions = {
                1: 'Sangat Tidak Puas',
                2: 'Tidak Puas',
                3: 'Cukup Puas',
                4: 'Puas',
                5: 'Sangat Puas'
            };

            stars.forEach(star => {
                star.addEventListener('change', function() {
                    const value = this.value;
                    ratingText.textContent = value + ' bintang';
                    ratingDesc.textContent = '- ' + ratingDescriptions[value];
                });
            });

            // Character counter for komentar
            const komentar = document.querySelector('textarea[name="komentar"]');
            const charCount = document.getElementById('char-count');

            komentar.addEventListener('input', function() {
                charCount.textContent = this.value.length;
            });
        });
    </script>
@endsection
