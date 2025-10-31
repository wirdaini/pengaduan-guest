<!-- Floating WhatsApp Button -->
<div class="whatsapp-float" id="whatsappFloat">
    <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20mengajukan%20pengaduan%20melalui%20sistem%20ini"
       target="_blank"
       class="whatsapp-link"
       id="whatsappLink">
        <i class="fab fa-whatsapp"></i>
    </a>
    <div class="whatsapp-tooltip" id="whatsappTooltip">
        Hubungi kami via WhatsApp
    </div>
</div>

<style>
.whatsapp-float {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 1000;
}

.whatsapp-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: #25D366;
    border-radius: 50%;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    text-decoration: none;
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.whatsapp-link:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
    background: #128C7E;
}

.whatsapp-link i {
    font-size: 32px;
    color: white;
}

.whatsapp-tooltip {
    position: absolute;
    bottom: 70px;
    right: 0;
    background: #333;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
    pointer-events: none;
}

.whatsapp-tooltip:after {
    content: '';
    position: absolute;
    top: 100%;
    right: 20px;
    border: 5px solid transparent;
    border-top-color: #333;
}

.whatsapp-float:hover .whatsapp-tooltip {
    opacity: 1;
    transform: translateY(0);
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .whatsapp-float {
        bottom: 20px;
        right: 20px;
    }

    .whatsapp-link {
        width: 55px;
        height: 55px;
    }

    .whatsapp-link i {
        font-size: 28px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const whatsappFloat = document.getElementById('whatsappFloat');
    const whatsappLink = document.getElementById('whatsappLink');

    // Optional: Add click tracking
    whatsappLink.addEventListener('click', function() {
        console.log('WhatsApp button clicked - Pengaduan Masyarakat');
    });
});
</script>
