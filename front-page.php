<?php
/**
 * Template Name: Restowrx Elite Homepage
 * Custom tactical landing page for Restowrx Elite
 */
get_header(); ?>

<main class="site-main" id="main-content">

<!-- ── Structured Data ── -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": ["GeneralContractor", "HomeAndConstructionBusiness", "LocalBusiness"],
    "@id": "<?php echo esc_url(home_url('/')); ?>#business",
    "name": "Restowrx Elite",
    "description": "Tampa Bay's trusted property restoration and recovery contractor — expert water damage restoration, fire damage recovery, mold remediation, and emergency reconstruction services.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18136994009",
    "email": "joe@restowrx.com",
    "priceRange": "$$-$$$",
    "address": { "@type": "PostalAddress", "addressLocality": "Tampa", "addressRegion": "FL", "addressCountry": "US" },
    "areaServed": [
        {"@type":"City","name":"Tampa"},{"@type":"City","name":"St. Petersburg"},
        {"@type":"City","name":"Clearwater"},{"@type":"City","name":"Brandon"},
        {"@type":"City","name":"Wesley Chapel"},{"@type":"City","name":"Lithia"}
    ],
    "aggregateRating": {"@type":"AggregateRating","ratingValue":"5","reviewCount":"32","bestRating":"5"},
    "sameAs": ["https://www.facebook.com/restowrx/","https://www.instagram.com/restowrx/"]
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<!-- ══════════════════════════════════════════════════════
     SECTION 1 — HERO: Parallax GSAP glass form panel
     ══════════════════════════════════════════════════════ -->
<style>
    .hyper-hero {
        width: 100%;
        padding: clamp(140px, 9vw, 180px) 0;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: linear-gradient(135deg, #090c15 0%, #151821 40%, #06070a 100%);
        overflow: hidden;
        color: #ffffff;
        font-family: var(--font-main, 'Inter', sans-serif);
    }

    .hero-canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2000');
        background-size: cover;
        background-position: center;
        z-index: 1;
        opacity: 0.22;
        filter: grayscale(0.6) contrast(1.1) brightness(0.6);
    }

    .hero-grid-decor {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(to right, rgba(255, 255, 255, 0.015) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
        background-size: 40px 40px;
        z-index: 2;
        pointer-events: none;
    }

    /* Ambient Tech Orbs */
    .hero-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        z-index: 2;
        pointer-events: none;
        opacity: 0.8;
    }

    .hero-orb--1 {
        width: 400px;
        height: 400px;
        background: rgba(255, 0, 0, 0.15);
        top: -10%;
        left: -5%;
        animation: float-orb-1 12s ease-in-out infinite alternate;
    }

    .hero-orb--2 {
        width: 500px;
        height: 500px;
        background: rgba(30, 80, 180, 0.14);
        bottom: -15%;
        right: -10%;
        animation: float-orb-2 15s ease-in-out infinite alternate;
    }

    .hero-orb--3 {
        width: 350px;
        height: 350px;
        background: rgba(255, 0, 0, 0.08);
        top: 30%;
        left: 45%;
        animation: float-orb-3 10s ease-in-out infinite alternate;
    }

    @keyframes float-orb-1 {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(40px, 30px) scale(1.1); }
    }

    @keyframes float-orb-2 {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(-50px, -40px) scale(1.05); }
    }

    @keyframes float-orb-3 {
        0% { transform: translate(0, 0) scale(0.9); }
        100% { transform: translate(30px, -30px) scale(1.1); }
    }

    .hero-overlay-dark {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 30%, rgba(9, 12, 21, 0.3) 0%, rgba(6, 7, 10, 0.85) 85%);
        z-index: 3;
    }

    /* Huge Background Text */
    .bg-text-large {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 15vw;
        color: rgba(255, 255, 255, 0.02);
        text-transform: uppercase;
        white-space: nowrap;
        z-index: 3;
        letter-spacing: -2px;
        pointer-events: none;
        overflow: hidden;
    }

    .hero-container {
        width: 100%;
        max-width: 1400px;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: clamp(40px, 6vw, 90px);
        align-items: center;
    }

    .hero-badge {
        background: rgba(255, 0, 0, 0.08); 
        border: 1px solid rgba(255, 0, 0, 0.3); 
        color: #ff3333; 
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.15); 
        padding: 6px 18px; 
        border-radius: 100px; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        font-family: var(--font-mono, 'Space Mono', monospace); 
        font-size: 0.72rem; 
        font-weight: 700; 
        letter-spacing: 2px; 
        margin-bottom: 25px;
        text-transform: uppercase;
    }
    .hero-badge i {
        width: 12px; height: 12px;
        color: #ff3333;
    }

    h1.ultra-headline {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.2rem, 6.8vw, 7.8rem);
        line-height: 0.9;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: -2px;
        position: relative;
    }

    h1.ultra-headline b {
        display: block;
        background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    h1.ultra-headline span {
        display: block;
        background: linear-gradient(135deg, #ff0000 0%, #ff6666 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-tech-stats {
        display: flex;
        gap: clamp(15px, 3vw, 30px);
        margin-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding-top: 30px;
    }

    .stat-box {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-left: 3px solid var(--brand, #ff0000);
        padding: 16px 22px;
        border-radius: 8px;
        flex: 1;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .stat-box:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }

    .stat-box h4 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2rem, 3.2vw, 2.8rem);
        margin: 0;
        color: #ffffff;
        line-height: 1;
        letter-spacing: 0.5px;
    }

    .stat-box p {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(255, 255, 255, 0.4);
        margin: 6px 0 0 0;
        font-weight: 700;
        font-family: var(--font-mono, 'Space Mono', monospace);
    }

    /* PREMIUM WHITE GLASS DISPATCH FORM */
    .glass-form-panel {
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        padding: clamp(30px, 4.5vw, 48px);
        border-radius: 16px;
        position: relative;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25), 0 10px 20px rgba(0, 0, 0, 0.15);
        z-index: 15;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-top: 8px solid var(--brand, #ff0000);
        color: #1a202c;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .glass-form-panel:hover {
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.35);
    }

    .form-title {
        text-align: center;
        margin-bottom: 25px;
        width: 100%;
    }

    .form-title img {
        max-width: 200px;
        height: auto;
        margin-bottom: 8px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        filter: brightness(0); /* Make black on white panel */
        opacity: 0.95;
    }

    .form-title p {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.72rem;
        color: var(--brand, #ff0000);
        letter-spacing: 3px;
        margin: 0;
        text-transform: uppercase;
        font-weight: 800;
    }

    /* Form Fields Stylings inside White Panel */
    .glass-form-panel input[type="text"],
    .glass-form-panel input[type="email"],
    .glass-form-panel input[type="tel"],
    .glass-form-panel textarea,
    .glass-form-panel select {
        width: 100%;
        padding: 12px 16px !important;
        background: rgba(0, 0, 0, 0.03) !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        border-radius: 6px !important;
        color: #111111 !important;
        font-family: var(--font-main) !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        margin-bottom: 15px !important;
        transition: all 0.3s ease !important;
        box-sizing: border-box !important;
    }

    .glass-form-panel input:focus,
    .glass-form-panel textarea:focus,
    .glass-form-panel select:focus {
        background: #ffffff !important;
        border-color: var(--brand, #ff0000) !important;
        box-shadow: 0 0 0 3px rgba(255, 0, 0, 0.12) !important;
        outline: none !important;
    }

    .glass-form-panel ::placeholder {
        color: #718096 !important;
        opacity: 0.8 !important;
    }

    /* Submit Button styling */
    .glass-form-panel input[type="submit"] {
        width: 100% !important;
        background: linear-gradient(135deg, var(--brand, #ff0000) 0%, #990000 100%) !important;
        color: #ffffff !important;
        font-family: var(--font-accent) !important;
        font-size: 1.25rem !important;
        letter-spacing: 1.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        border: none !important;
        border-radius: 6px !important;
        padding: 14px 20px !important;
        cursor: pointer !important;
        box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3) !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        box-sizing: border-box !important;
    }

    .glass-form-panel input[type="submit"]:hover {
        background: #000000 !important;
        color: #ffffff !important;
        transform: translateY(-2px) scale(1.01) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25) !important;
    }

    /* TACTICAL OVERLAPPING HOTLINE BADGE */
    .floating-dispatch {
        position: absolute;
        bottom: -20px;
        right: -20px;
        background: #111111;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
        padding: 14px 28px;
        border-radius: 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.4);
        z-index: 20;
        transform: rotate(3deg);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .floating-dispatch:hover {
        transform: rotate(0deg) scale(1.05);
        border-color: var(--brand, #ff0000);
        box-shadow: 0 25px 50px rgba(255, 0, 0, 0.15);
    }

    .floating-dispatch b {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        line-height: 1;
        letter-spacing: 0.5px;
        margin-top: 2px;
        color: #ffffff;
    }

    .floating-dispatch span {
        font-size: 0.62rem;
        color: var(--brand, #ff0000);
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-family: var(--font-mono, 'Space Mono', monospace);
    }

    @media (max-width: 1100px) {
        .hyper-hero {
            padding: 100px 0 60px 0;
        }

        .hero-container {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 50px;
        }

        h1.ultra-headline {
            font-size: clamp(3rem, 9vw, 5.5rem);
            letter-spacing: -1.5px;
        }

        .hero-badge {
            margin-bottom: 20px;
        }

        .hero-tech-stats {
            justify-content: center;
        }

        .floating-dispatch {
            position: relative;
            bottom: auto;
            right: auto;
            margin-top: 20px;
            transform: none;
            width: 100%;
            max-width: 280px;
        }
        .floating-dispatch:hover {
            transform: scale(1.02);
        }

        .bg-text-large {
            font-size: 20vw;
        }
    }
</style>

<section class="hyper-hero">
    <div class="hero-canvas"></div>
    <div class="hero-grid-decor"></div>
    
    <!-- Dynamic Glowing Tech Orbs -->
    <div class="hero-orb hero-orb--1"></div>
    <div class="hero-orb hero-orb--2"></div>
    <div class="hero-orb hero-orb--3"></div>
    
    <div class="hero-overlay-dark"></div>
    <div class="bg-text-large" id="bg-text">ELITE RESPONSE</div>

    <div class="hero-container">
        <!-- LEFT CONTENT -->
        <div class="reveal">
            <div class="hero-badge">
                <i data-lucide="shield"></i> Certified Agency Excellence
            </div>
            <h1 class="ultra-headline"><b>ELITE-GRADE</b><span>RESTORATION</span></h1>
            <p style="color: rgba(255,255,255,0.75); font-size: clamp(1.05rem, 1.4vw, 1.25rem); line-height: 1.75; margin: 25px 0 35px 0; max-width: 600px;">
                Operating at the apex of recovery science. We deliver rapid, surgical stabilization for high-value properties in the Tampa Bay market.
            </p>
            <div class="hero-tech-stats">
                <div class="stat-box">
                    <h4>45</h4>
                    <p>Min Response</p>
                </div>
                <div class="stat-box">
                    <h4>100%</h4>
                    <p>Precision</p>
                </div>
                <div class="stat-box">
                    <h4>24/7</h4>
                    <p>Active Radar</p>
                </div>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div style="position: relative;" class="reveal">
            <div class="glass-form-panel" id="form-panel">
                <div class="form-title">
                    <img src="https://restowrx.com/wp-content/uploads/2025/04/GetAttachmentThumbnail.png" alt="Restowrx Logo" width="220" height="44">
                    <p>DISPATCH CENTER</p>
                </div>

                <?php 
                // Render Custom Hero Form
                echo rwx_render_contact_form('rwx-hero-contact'); 
                ?>

                <div class="floating-dispatch" id="dispatch-badge">
                    <span>HOTLINE</span>
                    <b>813.699.4009</b>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("mousemove", (e) => {
        const x = (e.clientX - window.innerWidth / 2) / 200;
        const y = (e.clientY - window.innerHeight / 2) / 200;

        const formPanel = document.getElementById("form-panel");
        const bgText = document.getElementById("bg-text");

        if (formPanel && window.innerWidth > 1100) {
            gsap.to(formPanel, { x: x * 5, y: y * 5, rotateY: x * 0.8, rotateX: -y * 0.8, duration: 1.2, ease: "power2.out" });
        }
        if (bgText) {
            gsap.to(bgText, { x: -x * 3, y: -y * 3, duration: 2.5, ease: "power2.out" });
        }
    });
</script>


<!-- ══════════════════════════════════════════════════════
     SECTION 2 — EMERGENCY TICKER: Scrolling CSS marquee
     ══════════════════════════════════════════════════════ -->
<style>
    .resto-ticker-wrap {
        --ticker-red: var(--brand, #ff0000);
        --ticker-glow: rgba(255, 0, 0, 0.8);
        width: 100%;
        background-color: var(--ticker-red);
        padding: 15px 0;
        overflow: hidden;
        white-space: nowrap;
        position: relative;
        display: flex;
        align-items: center;
        box-shadow: 0 0 50px var(--ticker-glow);
        z-index: 99;
    }

    .resto-ticker-wrap::before,
    .resto-ticker-wrap::after {
        content: "";
        position: absolute;
        top: 0;
        width: clamp(50px, 10vw, 150px);
        height: 100%;
        z-index: 5;
    }

    .resto-ticker-wrap::before {
        left: 0;
        background: linear-gradient(to right, var(--ticker-red), transparent);
    }

    .resto-ticker-wrap::after {
        right: 0;
        background: linear-gradient(to left, var(--ticker-red), transparent);
    }

    .resto-ticker {
        display: flex;
        align-items: center;
        animation: ticker-slide 30s linear infinite;
        width: fit-content;
    }

    @keyframes ticker-slide {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .ticker-item {
        display: flex;
        align-items: center;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        color: white;
        font-size: clamp(1.2rem, 2vw, 1.8rem);
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 0 40px;
        flex-shrink: 0;
        line-height: 1;
    }

    .ticker-dot {
        width: 10px;
        height: 10px;
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        box-shadow: 0 0 15px white;
        flex-shrink: 0;
        margin: 0;
    }

    .emergency-text {
        font-weight: 900;
        text-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
</style>

<div class="resto-ticker-wrap">
    <div class="resto-ticker">
        <div class="ticker-item">24/7 EMERGENCY RESPONSE</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">WATER DAMAGE RECOVERY</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item"><span class="emergency-text">ELITE FIRE RESTORATION</span></div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">MOLD REMEDIATION</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">STORM DAMAGE STABILIZATION</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">CERTIFIED DISASTER RECOVERY</div>
        <div class="ticker-dot"></div>
        
        <!-- Duplicated content for seamless loop -->
        <div class="ticker-item">24/7 EMERGENCY RESPONSE</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">WATER DAMAGE RECOVERY</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item"><span class="emergency-text">ELITE FIRE RESTORATION</span></div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">MOLD REMEDIATION</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">STORM DAMAGE STABILIZATION</div>
        <div class="ticker-dot"></div>
        <div class="ticker-item">CERTIFIED DISASTER RECOVERY</div>
        <div class="ticker-dot"></div>
    </div>
</div>


<!-- ══════════════════════════════════════════════════════
     SECTION 3 — SPECIALIZATIONS GRID: Loop or fallback
     ══════════════════════════════════════════════════════ -->
<style>
    .services-grid-section {
        --color-black: #000000;
        --color-dark: #0a0a0a;
        --glow-red: rgba(255, 0, 0, 0.5);
        --transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);

        width: 100%;
        background-color: var(--color-black);
        padding: clamp(60px, 8vw, 100px) 0;
        color: white;
        font-family: var(--font-main, 'Inter', sans-serif);
        position: relative;
    }

    .grid-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    .service-card {
        background: var(--color-dark);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 50px 30px;
        position: relative;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        text-decoration: none;
        color: #ffffff !important;
        overflow: hidden;
        height: 100%;
        box-sizing: border-box;
    }

    /* Forensic Numbering */
    .card-number {
        position: absolute;
        top: 30px;
        right: 40px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.02);
        transition: var(--transition);
        line-height: 1;
    }

    .service-card:hover .card-number {
        color: rgba(255, 0, 0, 0.15);
        transform: scale(1.1);
    }

    .service-card:hover {
        background: #111111;
        transform: translateY(-10px);
        border-color: var(--brand, #ff0000);
        box-shadow: 0 40px 80px rgba(0,0,0,0.8);
    }

    /* Red Top Line Animation */
    .service-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 2px;
        background: var(--brand, #ff0000);
        transform: scaleX(0);
        transform-origin: left;
        transition: var(--transition);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .card-icon {
        color: var(--brand, #ff0000);
        margin-bottom: 40px;
        filter: drop-shadow(0 0 10px var(--glow-red));
        transition: var(--transition);
        display: flex;
        align-items: center;
    }

    .service-card:hover .card-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .service-card h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2rem, 3vw, 2.8rem);
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
        line-height: 1;
        margin-top: 0;
    }

    .service-card h3 b { display: block; }
    .service-card h3 span { color: var(--brand, #ff0000); }

    .service-card p {
        color: #888;
        line-height: 1.6;
        margin-bottom: 40px;
        font-size: 0.95rem;
        flex-grow: 1;
        margin-top: 0;
    }

    .card-list {
        list-style: none;
        padding: 0;
        margin-bottom: 40px;
        margin-top: 0;
    }

    .card-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 0.85rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card-list li i {
        color: var(--brand, #ff0000);
        display: flex;
        align-items: center;
    }

    .card-brief-link {
        display: flex;
        align-items: center;
        gap: 15px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.4rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
    }

    .service-card:hover .card-brief-link {
        color: var(--brand, #ff0000);
        gap: 25px;
    }

    @media (max-width: 1200px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .grid-container { padding: 0 20px; }
        .services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .service-card { padding: 40px 25px; }
    }
</style>

<section class="services-grid-section">
    <div class="grid-container">
        
        <div style="text-align: center; margin-bottom: 80px;" class="reveal">
            <span style="color: var(--brand, #ff0000); font-family: var(--font-mono, 'Space Mono', monospace); text-transform: uppercase; letter-spacing: 4px; font-size: 0.9rem; font-weight: 700; margin-bottom: 10px; display: block;">CORE COMPETENCIES</span>
            <h2 style="font-family: var(--font-accent, 'Bebas Neue', sans-serif); font-size: clamp(3rem, 8vw, 6rem); line-height: 0.95; margin: 0; text-transform: uppercase; letter-spacing: 2px;">SPECIALIZATIONS</h2>
        </div>

        <div class="services-grid">
            <?php
            // Dynamic WP_Query loop for Service post type
            $services_query = new WP_Query([
                'post_type'      => 'service',
                'post_status'    => 'publish',
                'posts_per_page' => 4,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'no_found_rows'  => true,
            ]);

            // Fallback content in case no services exist in the WP backend
            $fallback_services = [
                [
                    'num'   => '01',
                    'icon'  => 'droplets',
                    'title' => 'Water<b>Extraction</b>',
                    'desc'  => 'High-capacity extraction and precision thermal drying to stabilize structural integrity and mitigate secondary damage.',
                    'list'  => ['Rapid Response', 'Thermal Imaging', 'Humidity Control']
                ],
                [
                    'num'   => '02',
                    'icon'  => 'flame',
                    'title' => 'Fire<b>Damage</b>',
                    'desc'  => 'Molecular deodorization and specialized soot removal. We restore the original atmospheric quality and structural safety of your property.',
                    'list'  => ['Char Removal', 'Debris Recovery', 'Odor Removal']
                ],
                [
                    'num'   => '03',
                    'icon'  => 'shield-alert',
                    'title' => 'Mold<b>Removal</b>',
                    'desc'  => 'Clinical remediation using HEPA-grade filtration to eliminate airborne spores and ensure biological safety standards.',
                    'list'  => ['Containment', 'Air Scrubbing', 'Anti-Microbial']
                ],
                [
                    'num'   => '04',
                    'icon'  => 'cloud-lightning',
                    'title' => 'Storm<b>Impact</b>',
                    'desc'  => 'Emergency board-up and structural stabilization following catastrophic meteorological outbreaks and flooding.',
                    'list'  => ['Roof Tarping', 'Board Up', 'Tree Removal']
                ],
                [
                    'num'   => '05',
                    'icon'  => 'hammer',
                    'title' => 'Complete<b>Build Back</b>',
                    'desc'  => 'Advanced reconstruction in partnership with Spicola Construction. Returning your property to pre-loss perfection.',
                    'list'  => ['Full Repair', 'Elite Finishing', 'Fast Turnaround']
                ]
            ];

            if ($services_query->have_posts()) :
                $idx = 1;
                while ($services_query->have_posts()) : $services_query->the_post();
                    $num = str_pad($idx, 2, '0', STR_PAD_LEFT);
                    $title = get_the_title();
                    
                    // Format Title to make first word bold, subsequent ones normal
                    $title_words = explode(' ', $title);
                    $first_word = array_shift($title_words);
                    $formatted_title = $first_word . '<b>' . implode(' ', $title_words) . '</b>';

                    $desc = has_excerpt() ? get_the_excerpt() : wp_trim_words(strip_shortcodes(wp_strip_all_tags(get_the_content())), 20);
                    
                    // Determine Icon
                    $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                    if (empty($icon)) {
                        if (stripos($title, 'water') !== false || stripos($title, 'flood') !== false || stripos($title, 'dry') !== false) {
                            $icon = 'droplets';
                        } elseif (stripos($title, 'fire') !== false || stripos($title, 'soot') !== false || stripos($title, 'smoke') !== false) {
                            $icon = 'flame';
                        } elseif (stripos($title, 'mold') !== false || stripos($title, 'mildew') !== false) {
                            $icon = 'shield-alert';
                        } elseif (stripos($title, 'storm') !== false || stripos($title, 'wind') !== false || stripos($title, 'roof') !== false) {
                            $icon = 'cloud-lightning';
                        } else {
                            $icon = 'hammer';
                        }
                    }

                    // Map list features
                    $features = get_post_meta(get_the_ID(), '_service_features', true);
                    if (empty($features)) {
                        if ($icon === 'droplets') {
                            $features = ['Rapid Response', 'Thermal Imaging', 'Humidity Control'];
                        } elseif ($icon === 'flame') {
                            $features = ['Char Removal', 'Debris Recovery', 'Odor Removal'];
                        } elseif ($icon === 'shield-alert') {
                            $features = ['Containment', 'Air Scrubbing', 'Anti-Microbial'];
                        } elseif ($icon === 'cloud-lightning') {
                            $features = ['Roof Tarping', 'Board Up', 'Tree Removal'];
                        } else {
                            $features = ['Full Repair', 'Elite Finishing', 'Fast Turnaround'];
                        }
                    } else if (is_string($features)) {
                        $features = array_map('trim', explode(',', $features));
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="service-card reveal">
                        <div class="card-number"><?php echo esc_html($num); ?></div>
                        <div class="card-icon"><i data-lucide="<?php echo esc_attr($icon); ?>" size="56"></i></div>
                        <h3><?php echo $formatted_title; ?></h3>
                        <p><?php echo esc_html($desc); ?></p>
                        <ul class="card-list">
                            <?php foreach ($features as $feature) : ?>
                                <li><i data-lucide="check-circle" size="14"></i> <?php echo esc_html($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="card-brief-link">Access Briefing <i data-lucide="arrow-right"></i></div>
                    </a>
                    <?php
                    $idx++;
                endwhile;
                wp_reset_postdata();
            else :
                // Render fallback static services
                foreach (array_slice($fallback_services, 0, 4) as $svc) :
                    ?>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="service-card reveal">
                        <div class="card-number"><?php echo esc_html($svc['num']); ?></div>
                        <div class="card-icon"><i data-lucide="<?php echo esc_attr($svc['icon']); ?>" size="56"></i></div>
                        <h3><?php echo $svc['title']; ?></h3>
                        <p><?php echo esc_html($svc['desc']); ?></p>
                        <ul class="card-list">
                            <?php foreach ($svc['list'] as $item) : ?>
                                <li><i data-lucide="check-circle" size="14"></i> <?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="card-brief-link">Access Briefing <i data-lucide="arrow-right"></i></div>
                    </a>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     SECTION: ABOUT US (OUR STORY) - Adapted for tactical dark mode
     ══════════════════════════════════════════════════════ -->
<section class="about-story" aria-label="Our story">
    <div class="rwx-container">
        <div class="rwx-header reveal">
            <span class="eyebrow">Strategic Foundations</span>
            <h2>Built from the Ground Up</h2>
        </div>
        <div class="about-story__layout reveal">
            <div class="about-story__left">
                <div class="about-story__accent-bar" aria-hidden="true"></div>
                <div class="about-story__chips">
                    <span class="about-story__chip">Est. 2020</span>
                    <span class="about-story__chip">Tampa Bay, FL</span>
                    <span class="about-story__chip">CGC Licensed</span>
                </div>
                <blockquote class="about-story__quote">
                    &ldquo;Quality and integrity above everything else &mdash; no shortcuts, no excuses.&rdquo;
                </blockquote>
                <div class="about-story__stat-row">
                    <div class="about-story__stat">
                        <strong>10+</strong>
                        <span>Years in Business</span>
                    </div>
                    <div class="about-story__stat">
                        <strong>250+</strong>
                        <span>Projects Delivered</span>
                    </div>
                    <div class="about-story__stat">
                        <strong>3</strong>
                        <span>Counties Served</span>
                    </div>
                </div>
            </div>
            <div class="about-story__right">
                <p>Restowrx Elite was born out of a passion for property recovery done right. With extensive hands-on experience in Florida's disaster mitigation and construction industry, our leadership established a command center that puts elite containment, thorough dehumidification, and absolute safety above everything else &mdash; no shortcuts, no excuses.</p>
                <p>Word travels fast when you do exceptional work. From emergency water extraction to full structural stabilization, we've grown by securing properties rapidly and coordinating seamlessly with insurance carriers. Every case file in our portfolio represents a property saved and a client supported through a crisis.</p>
                <p>Today, Restowrx Elite is Tampa Bay's premier property damage mitigation and restoration firm, serving Hillsborough, Pinellas, and Pasco counties. In direct partnership with Spicola Construction, our licensed general contracting partner, we handle every phase of recovery, from negative-pressure biological containment to complete structural build-back.</p>
            </div>
        </div>
    </div>
</section>

<style>
.about-story {
    position: relative;
    padding: clamp(60px, 8vw, 100px) 0;
    background-color: #070707;
    color: white;
    font-family: var(--font-main, 'Inter', sans-serif);
    overflow: hidden;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.about-story::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(to right, rgba(255,255,255,0.01) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,0.01) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
}
.about-story__layout {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: clamp(30px, 5vw, 60px);
    margin-top: clamp(40px, 6vw, 80px);
    align-items: start;
}
.about-story__left {
    position: relative;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    padding: 40px 30px 40px 45px;
    backdrop-filter: blur(10px);
}
.about-story__accent-bar {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, var(--brand, #ff0000) 0%, rgba(255, 0, 0, 0.1) 100%);
}
.about-story__chips {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 30px;
}
.about-story__chip {
    font-family: var(--font-mono, 'Space Mono', monospace);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--brand, #ff0000);
    background: rgba(255, 0, 0, 0.05);
    border: 1px solid rgba(255, 0, 0, 0.2);
    border-radius: 4px;
    padding: 6px 14px;
}
.about-story__quote {
    font-family: var(--font-main, 'Inter', sans-serif);
    font-size: clamp(1.1rem, 2vw, 1.4rem);
    font-weight: 700;
    font-style: italic;
    color: #ffffff;
    line-height: 1.5;
    margin: 0 0 35px;
    border: none;
    padding: 0;
    letter-spacing: -0.5px;
}
.about-story__stat-row {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 30px;
}
.about-story__stat {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 100px;
}
.about-story__stat strong {
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: 2.8rem;
    font-weight: 400;
    color: var(--brand, #ff0000);
    line-height: 1;
    letter-spacing: 1px;
}
.about-story__stat span {
    font-family: var(--font-mono, 'Space Mono', monospace);
    font-size: 0.65rem;
    font-weight: 600;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-top: 8px;
}
.about-story__right p {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #e5e5e5;
    margin: 0 0 25px;
    font-weight: 400;
}
.about-story__right p:last-child {
    margin-bottom: 0;
}
@media(max-width:991px) {
    .about-story__layout {
        grid-template-columns: 1fr;
    }
    .about-story__left {
        order: 2;
    }
    .about-story__right {
        order: 1;
        margin-bottom: 20px;
    }
}
</style>


<!-- ══════════════════════════════════════════════════════
     SECTION 4 — WHY CHOOSE US: Tactical grid features
     ══════════════════════════════════════════════════════ -->
<style>
    .rwx-why-choose {
        --primary-red: var(--brand, #ff0000);
        --deep-black: #050505;
        --border-gray: rgba(255, 255, 255, 0.1);

        width: 100%;
        background-color: var(--deep-black);
        padding: clamp(60px, 8vw, 100px) 0;
        color: white;
        font-family: var(--font-main, 'Inter', sans-serif);
        position: relative;
        overflow: hidden;
    }

    .rwx-why-choose::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: 
            linear-gradient(to right, rgba(255,255,255,0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255,255,255,0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    .rwx-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
    }

    .rwx-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .rwx-header .eyebrow {
        color: var(--primary-red);
        font-family: var(--font-mono, 'Space Mono', monospace);
        text-transform: uppercase;
        letter-spacing: 4px;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 10px;
        display: block;
    }

    .rwx-header h2 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3rem, 8vw, 6rem);
        line-height: 0.95;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .rwx-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .rwx-feature-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-gray);
        padding: 50px 30px;
        position: relative;
        transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-sizing: border-box;
    }

    /* Tactical Corners */
    .rwx-feature-card::before, .rwx-feature-card::after {
        content: '';
        position: absolute;
        width: 10px; height: 10px;
        border-color: var(--primary-red);
        border-style: solid;
        opacity: 0;
        transition: 0.3s;
    }
    .rwx-feature-card::before {
        top: 0; left: 0; border-width: 2px 0 0 2px;
    }
    .rwx-feature-card::after {
        bottom: 0; right: 0; border-width: 0 2px 2px 0;
    }

    .rwx-feature-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 0, 0, 0.3);
        transform: translateY(-10px);
    }

    .rwx-feature-card:hover::before, .rwx-feature-card:hover::after {
        opacity: 1;
        width: 20px; height: 20px;
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 0, 0, 0.1);
        border: 1px solid rgba(255, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        position: relative;
    }

    .feature-icon i {
        color: var(--primary-red);
        transition: 0.3s;
        display: flex;
        align-items: center;
    }

    .rwx-feature-card:hover .feature-icon i {
        transform: scale(1.1);
        filter: drop-shadow(0 0 8px var(--primary-red));
    }

    .rwx-feature-card h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 2.2rem;
        margin: 0 0 15px 0;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: white;
    }

    .rwx-feature-card p {
        color: #888;
        line-height: 1.6;
        font-size: 0.95rem;
        margin: 0;
    }

    .rwx-feature-number {
        position: absolute;
        bottom: 20px;
        left: 30px;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.7rem;
        color: var(--primary-red);
        opacity: 0.3;
        letter-spacing: 2px;
    }

    /* Vertical line decor */
    .rwx-decor-line {
        position: absolute;
        top: 0; right: 10%;
        width: 1px; height: 100%;
        background: linear-gradient(to bottom, transparent, rgba(255,0,0,0.2), transparent);
        z-index: 1;
    }

    @media (max-width: 1024px) {
        .rwx-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .rwx-grid {
            grid-template-columns: 1fr;
        }
        .rwx-header h2 {
            font-size: 3.5rem;
        }
    }
</style>

<section class="rwx-why-choose">
    <div class="rwx-decor-line"></div>
    <div class="rwx-container">
        
        <div class="rwx-header reveal">
            <span class="eyebrow">Strategic Advantage</span>
            <h2>Why Restowrx Elite?</h2>
        </div>

        <div class="rwx-grid">
            
            <!-- Feature 1 -->
            <div class="rwx-feature-card reveal">
                <span class="rwx-feature-number">PROT_01</span>
                <div class="feature-icon">
                    <i data-lucide="timer" size="40"></i>
                </div>
                <h3>Rapid Deploy</h3>
                <p>On-site in 60 minutes or less. Every second matters when mitigating secondary damage.</p>
            </div>

            <!-- Feature 2 -->
            <div class="rwx-feature-card reveal">
                <span class="rwx-feature-number">PROT_02</span>
                <div class="feature-icon">
                    <i data-lucide="shield-check" size="40"></i>
                </div>
                <h3>Elite Team</h3>
                <p>IICRC certified specialists trained in advanced structure drying and biohazard protocols.</p>
            </div>

            <!-- Feature 3 -->
            <div class="rwx-feature-card reveal">
                <span class="rwx-feature-number">PROT_03</span>
                <div class="feature-icon">
                    <i data-lucide="microscope" size="40"></i>
                </div>
                <h3>Advanced Tech</h3>
                <p>Using thermal imaging and industrial moisture mapping to detect hidden moisture paths.</p>
            </div>

            <!-- Feature 4 -->
            <div class="rwx-feature-card reveal">
                <span class="rwx-feature-number">PROT_04</span>
                <div class="feature-icon">
                    <i data-lucide="phone-incoming" size="40"></i>
                </div>
                <h3>24/7 Dispatch</h3>
                <p>Strategic response units are active 24/7/365. Emergency command is always listening.</p>
            </div>

        </div>
    </div>
</section>


<!-- ══════════════════════════════════════════════════════
     SECTION 5 — REVIEWS: Custom quote carousel slider
     ══════════════════════════════════════════════════════ -->
<style>
    .resto-reviews {
        --color-red: var(--brand, #ff0000);
        --color-black: #000000;
        --color-white: #ffffff;
        --color-gold: #FFD700;

        width: 100%;
        background: radial-gradient(circle at 70% 50%, #4a0909 0%, #170000 100%);
        padding: clamp(60px, 10vw, 120px) 0;
        color: white;
        font-family: var(--font-main, 'Inter', sans-serif);
        position: relative;
        overflow: hidden;
    }

    /* Technical Grid Background */
    .reviews-bg-grid {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: 
            linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    .reviews-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 60px;
        align-items: center;
    }

    /* LEFT SIDE: HEADING & STATS */
    .reviews-header {
        position: relative;
    }

    .reviews-header::before {
        content: '';
        position: absolute;
        left: -40px;
        top: 0;
        width: 4px;
        height: 100px;
        background: var(--color-white);
    }

    .reviews-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-family: var(--font-mono, monospace);
        font-weight: 800;
        font-size: 0.9rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 20px;
        display: block;
    }

    .reviews-header h2 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.5rem, 5vw, 5.5rem);
        margin: 0 0 30px 0;
        line-height: 0.9;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .reviews-header h2 span {
        color: transparent;
        -webkit-text-stroke: 2px rgba(255, 255, 255, 0.8);
    }

    .leave-review-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        border: 1px solid white;
        color: white !important;
        padding: 15px 30px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.2rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none !important;
        transition: 0.3s;
        border-radius: 4px;
    }

    .leave-review-btn:hover {
        background: white;
        color: var(--color-black) !important;
        box-shadow: 0 0 20px rgba(255,255,255,0.4);
    }

    /* RIGHT SIDE: CUSTOM CAROUSEL */
    .custom-carousel-container {
        position: relative;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        padding: clamp(30px, 5vw, 60px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.8);
        box-sizing: border-box;
    }

    .custom-carousel-container::after,
    .custom-carousel-container::before {
        content: '';
        position: absolute;
        width: 80px; height: 80px;
        pointer-events: none;
    }

    .custom-carousel-container::after {
        top: -15px; right: -15px;
        border-top: 2px solid rgba(255,255,255,0.4);
        border-right: 2px solid rgba(255,255,255,0.4);
    }

    .custom-carousel-container::before {
        bottom: -15px; left: -15px;
        border-bottom: 2px solid rgba(255,255,255,0.4);
        border-left: 2px solid rgba(255,255,255,0.4);
    }

    .carousel-track {
        position: relative;
        min-height: 220px;
    }

    .carousel-slide {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
    }

    .carousel-slide.active {
        opacity: 1;
        visibility: visible;
        position: relative;
    }

    .slide-stars {
        display: flex;
        gap: 5px;
        color: var(--color-gold);
        margin-bottom: 20px;
    }

    .slide-stars i {
        display: flex;
        align-items: center;
    }

    .slide-text {
        font-size: clamp(1.1rem, 1.4vw, 1.3rem);
        font-style: italic;
        line-height: 1.6;
        color: #eee;
        margin: 0 0 20px 0;
    }

    .slide-author {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.5rem;
        letter-spacing: 2px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .slide-author img {
        width: 25px;
        height: auto;
    }

    /* Carousel Controls */
    .carousel-controls {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 20px;
    }

    .nav-btn {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.3s;
        padding: 0;
    }

    .nav-btn:hover {
        background: white;
        color: var(--color-black);
        border-color: white;
    }

    .nav-btn i {
        display: flex;
        align-items: center;
    }

    @media (max-width: 1024px) {
        .reviews-container {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .reviews-header::before {
            display: none;
        }
        .reviews-header h2 {
            font-size: 4.5rem;
        }
        .carousel-controls {
            justify-content: center;
        }
    }
</style>

<section class="resto-reviews">
    <div class="reviews-bg-grid"></div>
    <div class="reviews-container">
        
        <!-- LEFT: STATS & HEADER -->
        <div class="reviews-header reveal">
            <span class="reviews-subtitle">// AFTER ACTION REPORTS //</span>
            <h2>PROVEN <span>EXECUTION</span></h2>
            
            <a href="https://g.page/r/CSnpRAQ17nXnEAE/review" target="_blank" class="leave-review-btn" rel="noopener noreferrer">
                <i data-lucide="message-square-plus"></i> SUBMIT REPORT
            </a>
        </div>

        <!-- RIGHT: CUSTOM CAROUSEL -->
        <div class="custom-carousel-container reveal">
            <i data-lucide="quote" size="48" style="color: rgba(255,255,255,0.05); position: absolute; top: 20px; left: 20px;"></i>
            
            <div class="carousel-track">
                
                <!-- SLIDE 1 -->
                <div class="carousel-slide active">
                    <div class="slide-stars">
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                    </div>
                    <p class="slide-text">"After Hurricane Milton left significant damage to our home, we were overwhelmed... RestoWrx turned a stressful situation into a smooth recovery process. Lauren and the team were professional, responsive, and genuinely compassionate."</p>
                    <div class="slide-author">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" width="25" height="25">
                        LEIGH VALENTI
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div class="carousel-slide">
                    <div class="slide-stars">
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                    </div>
                    <p class="slide-text">"I recently hired RestoWrx to replace drywall damaged by Hurricane Milton... From start to finish, their team was professional, knowledgeable, and efficient. A special shout-out to Alek for going above and beyond."</p>
                    <div class="slide-author">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" width="25" height="25">
                        EUNICE PAYANO
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div class="carousel-slide">
                    <div class="slide-stars">
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                    </div>
                    <p class="slide-text">"Thank God for Restowrx! As a property manager I have worked with 11 different restoration companies and this one by far takes the cake... transparent, thorough and see the jobs through! Yianni has been a breath of fresh air."</p>
                    <div class="slide-author">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" width="25" height="25">
                        THEOHARI TSAGARIS
                    </div>
                </div>

                <!-- SLIDE 4 -->
                <div class="carousel-slide">
                    <div class="slide-stars">
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                        <i data-lucide="star" fill="currentColor" size="20"></i>
                    </div>
                    <p class="slide-text">"We had the fortunate opportunity to work with RestoWrx when our home was flooded. Alek, Lauren and Joe were there on day 2. The team did awesome work... thankfully these people made a terrible situation manageable."</p>
                    <div class="slide-author">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" width="25" height="25">
                        PAUL CAPUTO
                    </div>
                </div>

            </div>

            <!-- CAROUSEL CONTROLS -->
            <div class="carousel-controls">
                <button class="nav-btn prev" aria-label="Previous review"><i data-lucide="chevron-left"></i></button>
                <button class="nav-btn next" aria-label="Next review"><i data-lucide="chevron-right"></i></button>
            </div>

        </div>
        
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.querySelector('.nav-btn.prev');
        const nextBtn = document.querySelector('.nav-btn.next');
        if (!slides.length || !prevBtn || !nextBtn) return;

        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetInterval();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetInterval();
        });

        function startInterval() {
            slideInterval = setInterval(nextSlide, 6000);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }

        startInterval();
    });
</script>

<!-- ══════════════════════════════════════════════════════
     SECTION: FROM THE BLOG — Premium Dark Tactical Redesign
     ══════════════════════════════════════════════════════ -->
<?php
$blog_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
]);
if ( $blog_query->have_posts() ) : ?>
<section class="sc-blog" aria-label="Latest construction tips and news">
    <div class="rwx-container">
        <div class="rwx-header reveal">
            <span class="eyebrow">INTELLIGENCE BRIEFINGS</span>
            <h2>From <em>The Blog</em></h2>
        </div>
        <div class="sc-blog__grid reveal">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
                $cats = get_the_category();
                $cat_name = $cats ? esc_html( $cats[0]->name ) : 'Construction';
            ?>
            <article class="sc-blog__card">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="sc-blog__thumb" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail( 'medium', [ 'loading' => 'lazy', 'decoding' => 'async', 'alt' => esc_attr( get_the_title() ) ] ); ?>
                </a>
                <?php else : ?>
                <a href="<?php the_permalink(); ?>" class="sc-blog__thumb sc-blog__thumb--placeholder" tabindex="-1" aria-hidden="true">
                    <i data-lucide="newspaper" size="32"></i>
                </a>
                <?php endif; ?>
                <div class="sc-blog__body">
                    <div class="sc-blog__meta">
                        <span class="sc-blog__cat"><?php echo $cat_name; ?></span>
                        <time class="sc-blog__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                    </div>
                    <h3 class="sc-blog__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="sc-blog__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                    <div class="sc-blog__footer">
                        <a href="<?php the_permalink(); ?>" class="sc-blog__read">ACCESS FIELD FILE <i data-lucide="arrow-right"></i></a>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="sc-blog__cta reveal">
            <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="btn btn--outline">View All Briefings →</a>
        </div>
    </div>
</section>

<style>
.sc-blog {
    position: relative;
    padding: clamp(60px, 8vw, 100px) 0;
    background-color: #050505;
    color: white;
    font-family: var(--font-main, 'Inter', sans-serif);
    overflow: hidden;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.sc-blog::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(to right, rgba(255,255,255,0.01) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,0.01) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
}
.sc-blog .rwx-header h2 em {
    color: var(--brand, #ff0000);
    font-style: normal;
}
.sc-blog__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: clamp(40px, 6vw, 80px);
}
.sc-blog__card {
    background: rgba(15, 15, 15, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.06);
    border-radius: 4px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    backdrop-filter: blur(10px);
    transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
}
.sc-blog__card:hover {
    transform: translateY(-8px);
    border-color: rgba(255, 0, 0, 0.3);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
}
.sc-blog__thumb {
    display: block;
    aspect-ratio: 16/9;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
}
.sc-blog__thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.19, 1, 0.22, 1);
}
.sc-blog__thumb--placeholder {
    background: linear-gradient(135deg, #0a0a0a 0%, #151515 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.15);
}
.sc-blog__card:hover .sc-blog__thumb img {
    transform: scale(1.06);
}
.sc-blog__body {
    padding: 25px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.sc-blog__meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}
.sc-blog__cat {
    font-family: var(--font-mono, 'Space Mono', monospace);
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--brand, #ff0000);
    background: rgba(255, 0, 0, 0.07);
    border: 1px solid rgba(255, 0, 0, 0.2);
    border-radius: 2px;
    padding: 3px 10px;
    display: inline-block;
}
.sc-blog__date {
    font-family: var(--font-mono, 'Space Mono', monospace);
    font-size: 0.7rem;
    color: #666;
}
.sc-blog__title {
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: 1.8rem;
    letter-spacing: 1px;
    margin: 0 0 15px;
    line-height: 1.2;
    text-transform: uppercase;
}
.sc-blog__title a {
    color: #ffffff;
    text-decoration: none;
    transition: color 0.3s;
}
.sc-blog__title a:hover {
    color: var(--brand, #ff0000);
}
.sc-blog__excerpt {
    font-size: 0.95rem;
    line-height: 1.65;
    color: #888;
    margin: 0 0 25px;
    flex: 1;
}
.sc-blog__footer {
    display: flex;
    align-items: center;
    margin-top: auto;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 20px;
}
.sc-blog__read {
    font-family: var(--font-mono, 'Space Mono', monospace);
    font-size: 0.75rem;
    font-weight: 700;
    color: var(--brand, #ff0000);
    text-decoration: none;
    letter-spacing: 1.5px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: gap 0.3s;
}
.sc-blog__read i {
    transition: transform 0.3s;
}
.sc-blog__card:hover .sc-blog__read i {
    transform: translateX(4px);
}
.sc-blog__cta {
    text-align: center;
    margin-top: 50px;
}
@media(max-width:991px){
    .sc-blog__grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:650px){
    .sc-blog__grid{grid-template-columns:1fr;}
}
</style>
<?php endif; ?>


<!-- ══════════════════════════════════════════════════════
     SECTION 6 — BOTTOM CTA: Pulsing radar & Google Map
     ══════════════════════════════════════════════════════ -->
<style>
    .elite-cta-section {
        width: 100%;
        padding: clamp(80px, 12vw, 160px) 0;
        background-color: var(--color-black, #000000);
        position: relative;
        overflow: hidden;
        color: white;
        font-family: var(--font-main, 'Inter', sans-serif);
    }

    .cta-bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=2000');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        filter: grayscale(1) brightness(0.3);
        z-index: 1;
    }

    .cta-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, #000 30%, transparent 100%),
            radial-gradient(circle at 80% 50%, rgba(255, 0, 0, 0.1) 0%, transparent 70%);
        z-index: 2;
    }

    .cta-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: clamp(40px, 6vw, 80px);
        align-items: center;
        position: relative;
        z-index: 10;
    }

    /* MASSIVE PULSING ELEMENT (LEFT BACKGROUND) */
    .massive-pulse-bg {
        position: absolute;
        top: 50%;
        left: 20%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 600px;
        border: 4px solid rgba(255, 0, 0, 0.1);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
        animation: pulseRadarLarge 6s ease-in-out infinite;
    }

    .massive-pulse-bg::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        border: 2px solid rgba(255, 0, 0, 0.3);
        border-radius: 50%;
        animation: pulseRadarLarge 4s ease-in-out infinite reverse;
    }

    .massive-pulse-bg::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 800px;
        height: 800px;
        background: radial-gradient(circle, rgba(255, 0, 0, 0.05) 0%, transparent 60%);
        border-radius: 50%;
    }

    @keyframes pulseRadarLarge {
        0% {
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 0.5;
        }
        50% {
            transform: translate(-50%, -50%) scale(1.1);
            opacity: 1;
        }
        100% {
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 0.5;
        }
    }

    .cta-content-left {
        max-width: 600px;
        position: relative;
        z-index: 10;
    }

    .cta-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 0, 0, 0.15);
        border: 1px solid var(--brand, #ff0000);
        color: white;
        padding: 12px 24px;
        border-radius: 100px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.1rem;
        letter-spacing: 2px;
        margin-bottom: 40px;
        text-transform: uppercase;
        animation: badgePulse 2s infinite;
        backdrop-filter: blur(10px);
    }

    @keyframes badgePulse {
        0% { box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.4); }
        70% { box-shadow: 0 0 0 15px rgba(255, 0, 0, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 0, 0, 0); }
    }

    .cta-title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.5rem, 6vw, 7.5rem);
        line-height: 0.85;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: -3px;
        position: relative;
        z-index: 5;
    }

    .cta-title span {
        display: block;
        color: transparent;
        -webkit-text-stroke: 3px var(--brand, #ff0000);
    }

    .cta-description {
        font-size: clamp(1.1rem, 1.5vw, 1.4rem);
        color: #888;
        line-height: 1.7;
        margin: 40px 0;
        position: relative;
        z-index: 5;
    }

    .cta-map-container {
        margin-top: 40px;
        width: 100%;
        height: 250px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 10;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .cta-map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
        filter: invert(90%) hue-rotate(180deg) brightness(85%) contrast(120%);
    }

    .cta-form-wrapper {
        position: relative;
        z-index: 10;
    }

    .cta-glass-panel {
        background: rgba(10, 10, 10, 0.7);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: clamp(30px, 5vw, 60px);
        box-shadow: 0 50px 100px rgba(0, 0, 0, 0.8);
        border-top: 5px solid var(--brand, #ff0000);
        position: relative;
        box-sizing: border-box;
    }

    /* Floating Status Badge */
    .floating-status {
        position: absolute;
        top: -30px;
        right: -30px;
        background: white;
        color: black;
        padding: 15px 30px;
        border-radius: 4px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        transform: rotate(5deg);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 20;
    }

    .floating-status span {
        font-size: 0.7rem;
        color: var(--brand, #ff0000);
        font-weight: 800;
        letter-spacing: 2px;
    }

    .floating-status b {
        font-size: 1.8rem;
        line-height: 1;
    }

    /* SPINNING CIRCULAR BADGE */
    .spinning-badge-wrapper {
        position: absolute;
        top: -50px;
        left: -50px;
        width: 140px;
        height: 140px;
        z-index: 25;
        display: flex;
        justify-content: center;
        align-items: center;
        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
    }

    .spinning-text {
        animation: rotateText 15s linear infinite;
        width: 100%;
        height: 100%;
        position: absolute;
    }

    .spinning-icon-center {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #000;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 2px solid var(--brand, #ff0000);
        z-index: 2;
        color: white;
    }

    @keyframes rotateText {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 1100px) {
        .cta-container {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 60px;
        }

        .cta-content-left { margin: 0 auto; }
        .floating-status { display: none; }
        .massive-pulse-bg { left: 50%; }
    }

    @media (max-width: 768px) {
        .cta-title {
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            letter-spacing: -1px;
        }

        .spinning-badge-wrapper {
            width: 110px;
            height: 110px;
            top: -55px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .spinning-text {
            width: 110px;
            height: 110px;
        }

        .spinning-icon-center {
            width: 50px;
            height: 50px;
        }

        .cta-map-container {
            height: 200px;
        }
    }
</style>

<section class="elite-cta-section">
    <div class="cta-bg-image"></div>
    <div class="cta-overlay"></div>

    <!-- THE MASSIVE PULSING RADAR (LEFT SIDE) -->
    <div class="massive-pulse-bg"></div>

    <div class="cta-container">
        <!-- LEFT: THE CALL TO ACTION -->
        <div class="cta-content-left reveal">
            <div class="cta-badge">
                <i data-lucide="zap" size="18"></i>
                Emergency Support Active
            </div>
            <h2 class="cta-title">
                COMMAND THE
                <span>RECOVERY.</span>
            </h2>
            <p class="cta-description">
                Don't let the damage dictate the terms. Deploy Restowrx today and take immediate control of your property's future.
            </p>

            <div style="display: flex; gap: 30px; align-items: center;" class="cta-stats-mini">
                <div>
                    <h4 style="font-family: var(--font-accent, 'Bebas Neue', sans-serif); font-size: 2.5rem; margin: 0; color: var(--brand, #ff0000);">45</h4>
                    <p style="margin: 0; font-size: 0.75rem; color: #888; letter-spacing: 3px; margin-top: 10px; text-transform: uppercase; font-weight: 700;">Min Response</p>
                </div>
                <div style="width: 1px; height: 50px; background: rgba(255,255,255,0.1);"></div>
                <div>
                    <h4 style="font-family: var(--font-accent, 'Bebas Neue', sans-serif); font-size: 2.5rem; margin: 0; color: white;">24/7</h4>
                    <p style="margin: 0; font-size: 0.75rem; color: #888; letter-spacing: 3px; margin-top: 10px; text-transform: uppercase; font-weight: 700;">Active Response</p>
                </div>
            </div>

            <!-- TACTICAL DARK MODE MAP -->
            <div class="cta-map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3521.94435882436!2d-82.35515228492023!3d28.025530182661877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c2c6114eb6cbb1%3A0x6b4be939bbbd0bc4!2s9249%20Lazy%20Ln%2C%20Tampa%2C%20FL%2033610!5e0!3m2!1sen!2sus!4v1689990000000!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Restowrx Elite Headquarters Location"></iframe>
            </div>
        </div>

        <!-- RIGHT: THE FORM -->
        <div class="cta-form-wrapper reveal">
            <div class="cta-glass-panel" id="cta-form">

                <!-- SPINNING CORNER BADGE -->
                <div class="spinning-badge-wrapper">
                    <svg class="spinning-text" viewBox="0 0 100 100" width="140" height="140">
                        <defs>
                            <path id="circlePath" d="M 50, 50 m -35, 0 a 35,35 0 1,1 70,0 a 35,35 0 1,1 -70,0" />
                        </defs>
                        <text font-family="var(--font-main, 'Inter', sans-serif)" font-weight="800" font-size="10" fill="var(--brand, #ff0000)" letter-spacing="1.2">
                            <textPath href="#circlePath">
                                RESTOWRX ELITE • 24/7 ACTIVE DISPATCH •
                            </textPath>
                        </text>
                    </svg>
                    <div class="spinning-icon-center">
                        <i data-lucide="triangle-alert" size="28"></i>
                    </div>
                </div>

                <div style="text-align: center; margin-bottom: 40px;">
                    <h3 style="font-family: var(--font-accent, 'Bebas Neue', sans-serif); font-size: 2.5rem; margin: 0; letter-spacing: 2px; color: white;">REQUEST <span style="color: var(--brand, #ff0000);">DISPATCH</span></h3>
                    <p style="font-size: 0.75rem; color: #888; letter-spacing: 3px; margin-top: 10px; text-transform: uppercase; font-weight: 700;">Response: 24/7 Emergency</p>
                </div>

                <?php 
                // Render Custom Bottom Form
                echo rwx_render_contact_form('rwx-footer-contact'); 
                ?>

                <!-- Floating 24/7 Badge -->
                <div class="floating-status" id="status-tag">
                    <span>STATUS</span>
                    <b>ACTIVE</b>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // GSAP Parallax Effect for CTA
    document.addEventListener("mousemove", (e) => {
        const x = (e.clientX - window.innerWidth / 2) / 100;
        const y = (e.clientY - window.innerHeight / 2) / 100;

        const ctaForm = document.getElementById("cta-form");
        const statusTag = document.getElementById("status-tag");

        if (ctaForm) {
            gsap.to(ctaForm, { x: x * 2, y: y * 2, rotateY: x, rotateX: -y, duration: 1, ease: "power2.out" });
        }
        if (statusTag) {
            gsap.to(statusTag, { x: x * 5, y: y * 5, duration: 2, ease: "power2.out" });
        }
    });
</script>

</main>

<?php get_footer(); ?>
