<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script> --}}
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Bypass navigation block -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Force enable semua link navigation
        const navLinks = document.querySelectorAll('#navmenu a, .navbar a, header a');
        navLinks.forEach(link => {
            // Hapus event listener lama
            const newLink = link.cloneNode(true);
            link.parentNode.replaceChild(newLink, link);

            // Tambahkan event listener sederhana
            newLink.addEventListener('click', function(e) {
                console.log('Navigation clicked:', this.href);
                // Biarkan browser handle navigasi normal
            });
        });
    });
</script>
