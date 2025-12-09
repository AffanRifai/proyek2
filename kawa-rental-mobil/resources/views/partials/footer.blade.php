<style>
    footer {
        background-color: #882412;
        color: #e4e7ec;
        padding: 2.5rem 0rem 8rem 1.5rem;
        font-size: 0.9rem;
    }

    footer .footer-container {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 1.5rem;
    }

    footer .footer-col {
        flex: 1 1 220px;
        min-width: 220px;
    }

    footer .footer-col h4 {
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    footer .footer-logo {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    footer .footer-logo img {
        width: 150px;
        height: auto;
    }

    footer .social-icons {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    footer .social-icons a {
        color: #e4e7ec;
        font-size: 1.5rem;
        transition: color 0.3s ease;
    }

    footer .social-icons a:hover {
        color: #00b894;
    }

    footer .contact-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        line-height: 1.3;
    }

    footer .contact-info div {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    footer .contact-info div svg {
        fill: #e4e7ec;
        width: 18px;
        height: 18px;
    }

    .footer-col .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #fff;
        margin-right: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: background 0.2s, box-shadow 0.2s;
    }

    .footer-col .social-icons a:hover {
        background: #A62F19;
        box-shadow: 0 4px 16px rgba(166, 47, 25, 0.10);
    }

    .footer-col .social-icons a img {
        width: 22px;
        height: auto;
        display: block;
    }
</style>
<footer>
    <div class="footer-container">
        <div class="footer-col">
            <a href="#" class="footer-logo" aria-label="Rental Mobil Indramayu">
                <img src="{{ asset('img/logo-kawa-stroke2.png') }}" alt="logo kawa rental mobil" />
            </a>
            <small>©2025 KAWA Rental mobil Indramayu All Rights Reserved. Published by
                <a href="http://www.polindra.ac.id" target="_blank" rel="noopener noreferrer" style="color:#00b894;">
                    www.polindra.ac.id
                </a>
            </small>
        </div>

        <div class="footer-col">
            <h4>Media Sosial</h4>
            <div class="social-icons" role="navigation" aria-label="Media sosial">
                <a href="#"><img src="{{ asset('/img/instagram-icon.png') }}" alt="Instagram"
                        style="width:30px"></a>
                <a href="#"><img src="{{ asset('/img/Facebook.png') }}" alt="Facebook" style="width:30px"></a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Kontak</h4>
            <div class="contact-info">
                <div>+62 1234 5678 910</div>
                <div>+62 1234 5678 910</div>
                <div>+62 1234 5678 910</div>
            </div>
        </div>

        <div class="footer-col">
            <h4>Alamat</h4>
            <address>
                Jl. Raya Lohbener No.08,<br />
                Lohbener, Kec. Indramayu,<br />
                Kabupaten Indramayu, Jawa Barat 45252
            </address>
        </div>
    </div>
</footer>
