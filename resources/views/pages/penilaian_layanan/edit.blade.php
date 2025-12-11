@extends('layouts.guest.app')

@section('title', 'Edit Penilaian Layanan - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Edit Penilaian Layanan</h1>
                            <p class="mb-0">
                                Perbarui penilaian Anda untuk mencerminkan pengalaman yang lebih akurat.
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
                        <li><a href="{{ route('penilaian_layanan.show', $penilaian->penilaian_id) }}">Detail Penilaian</a></li>
                        <li class="current">Edit Penilaian</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Edit Penilaian Section -->
        <section id="penilaian" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Edit Penilaian</h2>
                                <p>Perbarui penilaian Anda sebelum waktu edit berakhir.</p>
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

                                <!-- Info Waktu Edit -->
                                @php
                                    $created = $penilaian->created_at;
                                    $deadline = $created->addHours(24);
                                    $remaining = now()->diffInHours($deadline, false);
                                @endphp

                                @if ($remaining > 0)
                                    <div class="alert alert-warning">
                                        <i class="bi bi-clock"></i>
                                        <strong>Waktu Edit Tersisa:</strong> {{ $remaining }} jam
                                        (berakhir pada {{ $deadline->format('d/m/Y H:i') }})
                                    </div>
                                @endif

                                <form action="{{ route('penilaian_layanan.update', $penilaian->penilaian_id) }}" method="POST"
                                    class="php-email-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="row gy-4">

                                        <!-- Informasi Pengaduan (Readonly) -->
                                        <div class="col-12">
                                            <label class="form-label">Pengaduan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $penilaian->pengaduan->nomor_tiket }} - {{ $penilaian->pengaduan->judul }}"
                                                readonly>
                                            <small class="text-muted">Pengaduan tidak dapat diubah</small>
                                        </div>

                                        <!-- Rating -->
                                        <div class="col-12">
                                            <label class="form-label">Rating Pelayanan *</label>
                                            <div class="rating-input">
                                                <div class="rating-stars">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}" name="rating"
                                                               value="{{ $i }}"
                                                               {{ old('rating', $penilaian->rating) == $i ? 'checked' : '' }}
                                                               required>
                                                        <label for="star{{ $i }}" title="{{ $i }} bintang">
                                                            <i class="bi bi-star-fill"></i>
                                                        </label>
                                                    @endfor
                                                </div>
                                                <div class="rating-labels mt-2">
                                                    <small class="text-muted">
                                                        <span id="rating-text">{{ $penilaian->rating }} bintang</span>
                                                        <span id="rating-desc">- {{ $penilaian->ratingText }}</span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Komentar -->
                                        <div class="col-12">
                                            <label for="komentar" class="form-label">Komentar (Opsional)</label>
                                            <textarea name="komentar" class="form-control" rows="4"
                                                placeholder="Bagikan pengalaman atau saran perbaikan... (maks. 500 karakter)"
                                                maxlength="500">{{ old('komentar', $penilaian->komentar) }}</textarea>
                                            <small class="text-muted float-end"><span id="char-count">{{ strlen(old('komentar', $penilaian->komentar)) }}</span>/500 karakter</small>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-12 text-center">
                                            @if ($remaining > 0)
                                                <button type="submit" class="btn-book">Update Penilaian</button>
                                            @else
                                                <button type="button" class="btn-book" disabled title="Waktu edit telah berakhir">
                                                    Waktu Edit Berakhir
                                                </button>
                                            @endif
                                            <a href="{{ route('penilaian_layanan.show', $penilaian->penilaian_id) }}"
                                                class="btn btn-secondary mt-2">Kembali ke Detail</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Setelah 24 jam, penilaian akan terkunci dan tidak dapat diubah lagi.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Edit Penilaian Section -->

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

        .btn-book:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
