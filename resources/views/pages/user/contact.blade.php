@extends('layouts.app')

@section('title', 'Kontak - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Hubungi Kami</h1>
                        <p class="mb-0">
                            Mari berkomunikasi untuk kemajuan desa yang lebih baik
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Kontak</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-lg-4 mb-4">
                    <div class="contact-info">
                        <h3 class="mb-4">Informasi Kontak</h3>

                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Alamat Kantor</h5>
                                <p class="text-muted mb-0">
                                    Jl. Pembangunan No. 123<br>
                                    Desa Maju Jaya, Kec. Sejahtera<br>
                                    Kabupaten Bina Mandiri
                                </p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Telepon</h5>
                                <p class="text-muted mb-0">
                                    (021) 1234-5678<br>
                                    (021) 8765-4321
                                </p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Email</h5>
                                <p class="text-muted mb-0">
                                    info@binadesa.id<br>
                                    support@binadesa.id
                                </p>
                            </div>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h5>Jam Operasional</h5>
                                <p class="text-muted mb-0">
                                    Senin - Jumat: 08.00 - 16.00<br>
                                    Sabtu: 08.00 - 12.00<br>
                                    Minggu: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="contact-form">
                        <h3 class="mb-4">Kirim Pesan</h3>
                        <p class="text-muted mb-4">
                            Punya pertanyaan atau saran? Silakan isi form berikut dan kami akan segera merespons.
                        </p>

                        <form action="#" method="POST">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Subjek *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Pesan *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="emergency-contact bg-light rounded p-4 text-center">
                        <div class="emergency-icon mb-3">
                            <i class="bi bi-telephone-fill display-4 text-danger"></i>
                        </div>
                        <h4>Kontak Darurat</h4>
                        <p class="text-muted mb-3">
                            Untuk keadaan darurat yang membutuhkan penanganan segera
                        </p>
                        <div class="emergency-number">
                            <h3 class="text-danger">112</h3>
                            <p class="text-muted">Hotline Darurat 24/7</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="faq-section">
                        <h3 class="text-center mb-4">Pertanyaan Umum</h3>
                        <div class="accordion" id="faqAccordion">
                            <!-- FAQ 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Bagaimana cara mengajukan pengaduan?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Anda dapat mengajukan pengaduan melalui menu "Ajukan Pengaduan" di website atau aplikasi Bina Desa. Isi form dengan data yang lengkap dan benar.
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        Berapa lama proses penanganan pengaduan?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Proses penanganan biasanya memakan waktu 3-7 hari kerja, tergantung kompleksitas pengaduan. Anda dapat memantau progressnya secara real-time.
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Apakah data pribadi saya aman?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Ya, kami menjamin keamanan data pribadi Anda. Data hanya digunakan untuk keperluan verifikasi dan tidak disebarluaskan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->

</main>

<style>
.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}
.contact-icon {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    flex-shrink: 0;
}
.contact-details h5 {
    margin-bottom: 5px;
    color: #495057;
}
.emergency-contact {
    border: 2px solid #dc3545;
}
.emergency-icon {
    color: #dc3545;
}
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #495057;
}
.contact-form {
    background: white;
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}
</style>
@endsection
