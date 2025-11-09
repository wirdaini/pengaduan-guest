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
                            <h1 class="heading-title">Kontak</h1>
                            <p class="mb-0">
                                Hubungi kami untuk informasi lebih lanjut tentang pelayanan desa.
                                Tim kami siap membantu menjawab pertanyaan dan menangani pengaduan
                                Anda dengan cepat dan profesional.
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
        <section id="contact" class="contact section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="contact-info-wrapper">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="info-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h3>Alamat Kantor</h3>
                                    <p>Jl. Pembangunan No. 123, Desa Maju Jaya, Kec. Sejahtera</p>
                                </div>
                            </div>

                            <div class="contact-info-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="info-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h3>Email</h3>
                                    <p>info@binadesa.id</p>
                                    <p>pengaduan@binadesa.id</p>
                                </div>
                            </div>

                            <div class="contact-info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="info-icon">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="info-content">
                                    <h3>Jam Operasional</h3>
                                    <p>Senin-Jumat: 08.00 - 16.00</p>
                                    <p>Sabtu: 08.00 - 12.00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form-card" data-aos="fade-up" data-aos-delay="200">
                            <h2>Kirim Pesan</h2>
                            <p class="mb-4">Ada pertanyaan atau ingin informasi lebih lanjut? Hubungi kami
                                dan tim kami akan segera merespons Anda.</p>

                            <form action="forms/contact.php" method="post" class="php-email-form">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Nama Lengkap" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Anda" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject" id="subject"
                                            placeholder="Subjek" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" id="message" placeholder="Pesan Anda" rows="6" required=""></textarea>
                                    </div>

                                    <div class="col-12">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-submit">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid map-container" data-aos="fade-up" data-aos-delay="200">
                <div class="map-overlay"></div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </section><!-- /Contact Section -->

    </main>

    @endsection
