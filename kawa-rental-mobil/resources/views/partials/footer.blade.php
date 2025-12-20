<style>
    :root {
        --footer-bg: #882412;
        --footer-text: #e4e7ec;
        --footer-accent: #00b894;
        --footer-border: rgba(255, 255, 255, 0.1);
        --footer-hover: #A62F19;
    }

    footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
        position: relative;
        overflow: hidden;
    }

    footer .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1.5rem 3rem;
        /* DIKURANGI: dari 6rem jadi 3rem */
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 2.5rem;
        position: relative;
    }

    /* Efek dekoratif */
    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--footer-accent), var(--footer-hover));
    }

    /* Kolom utama (logo) */
    footer .footer-col:first-child {
        flex: 1 1 100%;
        max-width: 300px;
        margin-bottom: 1rem;
    }

    /* Kolom lainnya */
    footer .footer-col {
        flex: 1 1 200px;
        min-width: 200px;
    }

    footer .footer-col h4 {
        font-weight: 700;
        margin-bottom: 1.2rem;
        font-size: 1.1rem;
        color: #fff;
        position: relative;
        padding-bottom: 0.5rem;
    }

    footer .footer-col h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--footer-accent);
    }

    footer .footer-logo {
        display: inline-block;
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    footer .footer-logo:hover {
        transform: translateY(-3px);
    }

    footer .footer-logo img {
        width: 160px;
        height: auto;
    }

    /* Social Icons */
    footer .social-icons {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .footer-col .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .footer-col .social-icons a:hover {
        background: var(--footer-hover);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(166, 47, 25, 0.3);
    }

    .footer-col .social-icons a img {
        width: 22px;
        height: auto;
    }

    /* Contact Info */
    footer .contact-info {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        line-height: 1.5;
    }

    footer .contact-info div {
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
        transition: color 0.3s ease;
    }

    footer .contact-info div:hover {
        color: #fff;
    }

    /* Address */
    footer address {
        font-style: normal;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Copyright Section - DIKURANGI margin-top dan padding */
    .footer-copyright {
        background: rgba(0, 0, 0, 0.2);
        padding: 1rem 1.5rem;
        /* DIKURANGI: dari 1.5rem */
        text-align: center;
        border-top: 1px solid var(--footer-border);
        margin-top: 1rem;
        /* DIKURANGI: dari 2rem */
        position: relative;
        width: 100%;
    }

    .footer-copyright small {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
        display: block;
        line-height: 1.6;
    }

    .footer-copyright a {
        color: var(--footer-accent);
        text-decoration: none;
        transition: color 0.3s ease;
        font-weight: 600;
    }

    .footer-copyright a:hover {
        color: #fff;
        text-decoration: underline;
    }

    /* === RESPONSIVE DESIGN === */

    /* Tablet */
    @media (max-width: 1024px) {
        footer .footer-container {
            padding: 2.5rem 1.5rem 3rem;
            /* DIKURANGI: dari 5rem jadi 3rem */
            gap: 2rem;
        }

        footer .footer-col:first-child {
            flex: 1 1 100%;
            max-width: 100%;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        footer .footer-logo img {
            width: 140px;
        }

        footer .footer-col {
            flex: 1 1 calc(50% - 2rem);
            min-width: calc(50% - 2rem);
        }

        .footer-copyright {
            padding: 0.8rem 1rem;
            /* DIKURANGI: dari 1.2rem */
            margin-top: 0.8rem;
            /* DIKURANGI */
        }
    }

    /* Mobile */
    @media (max-width: 768px) {
        footer .footer-container {
            padding: 2rem 1rem 2.5rem;
            /* DIKURANGI: dari 5.5rem jadi 2.5rem */
            gap: 1.5rem;
            flex-direction: column;
        }

        footer .footer-col:first-child {
            order: 1;
            margin-bottom: 0.5rem;
        }

        footer .footer-col:nth-child(2) {
            order: 3;
            /* Social media */
        }

        footer .footer-col:nth-child(3) {
            order: 2;
            /* Kontak */
        }

        footer .footer-col:nth-child(4) {
            order: 4;
            /* Alamat */
        }

        footer .footer-col {
            flex: 1 1 100%;
            min-width: 100%;
            text-align: center;
        }

        footer .footer-col h4 {
            text-align: center;
        }

        footer .footer-col h4::after {
            left: 50%;
            transform: translateX(-50%);
        }

        footer .footer-logo {
            margin-bottom: 1rem;
        }

        footer .footer-logo img {
            width: 130px;
        }

        /* Social Icons di mobile - center */
        footer .social-icons {
            justify-content: center;
            gap: 0.8rem;
        }

        .footer-col .social-icons a {
            width: 42px;
            height: 42px;
        }

        .footer-col .social-icons a img {
            width: 20px;
        }

        /* Contact info di mobile - center */
        footer .contact-info {
            align-items: center;
        }

        footer .contact-info div {
            justify-content: center;
        }

        /* Copyright section di mobile - DIKURANGI margin dan padding */
        .footer-copyright {
            padding: 0.8rem 0.8rem;
            /* DIKURANGI: dari 1rem */
            position: relative;
            margin-top: 1rem;
            /* DIKURANGI: dari 1.5rem */
            z-index: 1;
            background: rgba(0, 0, 0, 0.2);
        }

        .footer-copyright small {
            font-size: 0.8rem;
            line-height: 1.4;
        }
    }

    /* Small Mobile */
    @media (max-width: 480px) {
        footer .footer-container {
            padding: 1.5rem 0.8rem 2rem;
            /* DIKURANGI: dari 5rem jadi 2rem */
        }

        footer .footer-logo img {
            width: 120px;
        }

        footer .footer-col h4 {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .footer-col .social-icons a {
            width: 40px;
            height: 40px;
        }

        .footer-col .social-icons a img {
            width: 18px;
        }

        footer .contact-info {
            font-size: 0.9rem;
        }

        footer address {
            font-size: 0.9rem;
        }

        .footer-copyright {
            padding: 0.6rem 0.5rem;
            /* DIKURANGI: dari 0.8rem */
            margin-top: 0.8rem;
            /* DIKURANGI: dari 1rem */
        }

        .footer-copyright small {
            font-size: 0.75rem;
        }
    }

    /* Very Small Mobile */
    @media (max-width: 360px) {
        .footer-copyright small {
            font-size: 0.7rem;
        }

        footer .footer-logo img {
            width: 110px;
        }

        .footer-copyright {
            padding: 0.5rem 0.4rem;
            margin-top: 0.6rem;
        }
    }

    /* Print Styles */
    @media print {
        footer {
            display: none;
        }
    }
</style>
<footer>
    <div class="footer-container">
        <!-- Logo Section -->
        <div class="footer-col">
            <a href="#" class="footer-logo" aria-label="Rental Mobil Indramayu">
                <img src="{{ asset('img/logo-kawa-stroke2.png') }}" alt="logo kawa rental mobil" />
            </a>
            <!-- Hapus copyright dari sini -->
        </div>

        <!-- Social Media -->
        <div class="footer-col">
            <h4>Media Sosial</h4>
            <div class="social-icons" role="navigation" aria-label="Media sosial">
                <a href="#"><img src="{{ asset('/img/instagram-icon.png') }}" alt="Instagram"></a>
                <a href="#"><img src="{{ asset('/img/Facebook.png') }}" alt="Facebook"></a>
            </div>
        </div>

        <!-- Contact -->
        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="contact-info">
                <div>+62 1234 5678 910</div>
                <div>+62 1234 5678 910</div>
                <div>+62 1234 5678 910</div>
            </div>
        </div>

        <!-- Address -->
        <div class="footer-col">
            <h4>Alamat</h4>
            <address>
                Jl. Raya Lohbener No.08,<br />
                Lohbener, Kec. Indramayu,<br />
                Kabupaten Indramayu, Jawa Barat 45252
            </address>
        </div>
    </div>

    <!-- Copyright Section - Dipisah untuk mobile -->
    <div class="footer-copyright">
        <small>
            ©2025 KAWA Rental mobil Indramayu All Rights Reserved. Published by
            <a href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer">
                www.polindra.ac.id
            </a>
        </small>
    </div>
</footer>
