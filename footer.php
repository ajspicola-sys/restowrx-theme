<?php
/**
 * Restowrx Elite Theme — Footer Template
 * Premium tactical theme footer with Tier C state recovery guard
 */
?>



<!-- Floating Mobile Dispatch CTA -->
<div class="floating-cta" id="floating-cta" role="navigation" aria-label="Quick action dispatch">
    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="floating-cta__btn floating-cta__btn--dispatch">
        <i data-lucide="zap"></i>
        Dispatch
    </a>
    <a href="tel:+18136994009" class="floating-cta__btn floating-cta__btn--call">
        <i data-lucide="phone"></i>
        Call Center
    </a>
</div>

<!-- Scroll to Top -->
<button class="scroll-top" id="scroll-top" aria-label="Back to top">
    <i data-lucide="chevron-up"></i>
</button>

<style>
    /* Floating CTA styles for Restowrx Elite */
    .floating-cta {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 99999;
        display: none;
        gap: 10px;
        background: rgba(18, 3, 3, 0.9);
        border: 1px solid var(--brand, #F22F3A);
        padding: 6px 12px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(255, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        transition: opacity 0.3s, transform 0.3s;
    }
    .floating-cta__btn {
        display: flex;
        align-items: center;
        gap: 6px;
        color: white;
        text-decoration: none;
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 8px 16px;
        border-radius: 30px;
        transition: background 0.2s;
    }
    .floating-cta__btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor !important;
        fill: none !important;
    }
    .floating-cta__btn--dispatch {
        background: var(--brand, #F22F3A);
    }
    .floating-cta__btn--dispatch:hover {
        background: white;
        color: var(--brand, #F22F3A);
    }
    .floating-cta__btn--call {
        background: rgba(255, 255, 255, 0.1);
    }
    .floating-cta__btn--call:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    @media (max-width: 768px) {
        .floating-cta {
            display: flex;
        }
    }

    /* Scroll Top styles */
    .scroll-top {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 9999;
        width: 45px;
        height: 45px;
        background: #120303;
        border: 1px solid rgba(255, 0, 0, 0.3);
        border-radius: 4px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
    }
    .scroll-top:hover {
        background: var(--brand, #F22F3A);
        border-color: var(--brand, #F22F3A);
        transform: translateY(-3px);
    }
    .scroll-top.is-visible {
        opacity: 1;
        visibility: visible;
    }

    /* --- RESTOWRX TACTICAL COMMAND FOOTER --- */
    .elite-footer {
        background-color: #000000 !important;
        color: #ffffff !important;
        font-family: 'Inter', sans-serif;
        padding: 90px 0 45px;
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Technical Background Grid */
    .footer-grid-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            linear-gradient(to right, rgba(255, 255, 255, 0.01) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.01) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }

    .footer-container {
        width: 100%;
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 40px;
        display: grid;
        grid-template-columns: 1.2fr 0.8fr 0.8fr 1.2fr;
        gap: 50px;
        position: relative;
        z-index: 10;
    }

    .footer-col h3 {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.8rem;
        letter-spacing: 2px;
        margin-bottom: 25px;
        color: #ffffff !important;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
        margin-top: 0;
    }

    .footer-col h3::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 30px;
        height: 2px;
        background: var(--brand, #F22F3A);
    }

    .footer-logo img {
        height: 40px !important;
        width: auto !important;
        object-fit: contain !important;
        margin-bottom: 20px;
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    .footer-about p {
        color: #bbbbbb !important;
        line-height: 1.6;
        font-size: 0.9rem;
        max-width: 300px;
        margin-top: 0;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #bbbbbb !important;
        text-decoration: none;
        transition: 0.3s;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
        display: inline-block;
    }

    .footer-links a:hover {
        color: var(--brand, #F22F3A) !important;
        transform: translateX(4px);
    }

    /* Radar Zones */
    .radar-zones {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 10px;
    }

    .zone-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #bbbbbb !important;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'Space Mono', monospace;
        white-space: nowrap !important;
    }

    .zone-pulse {
        width: 6px;
        height: 6px;
        background: var(--brand, #F22F3A);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--brand, #F22F3A);
        animation: zonePulse 1.5s infinite;
    }

    @keyframes zonePulse {
        0% { opacity: 1; }
        50% { opacity: 0.3; }
        100% { opacity: 1; }
    }

    /* Contact Block */
    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
    }

    .contact-icon {
        color: var(--brand, #F22F3A);
        margin-top: 3px;
        display: flex;
        align-items: center;
    }

    .contact-icon i, .contact-icon svg {
        width: 20px;
        height: 20px;
        color: var(--brand, #F22F3A) !important;
        stroke: var(--brand, #F22F3A) !important;
        fill: none !important;
        display: inline-block;
    }

    .contact-text span {
        display: block;
        font-size: 0.65rem;
        color: #777777 !important;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'Space Mono', monospace;
    }

    .contact-text b {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.5rem;
        color: #ffffff !important;
        letter-spacing: 1px;
    }

    /* Social Stack */
    .social-stack {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .social-btn {
        width: 40px;
        height: 40px;
        background: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        color: #ffffff !important;
        text-decoration: none;
        transition: 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .social-btn i, .social-btn svg {
        width: 18px;
        height: 18px;
        color: #ffffff !important;
        stroke: #ffffff !important;
        fill: none !important;
        display: inline-block;
        transition: transform 0.3s;
    }

    .social-btn:hover i, .social-btn:hover svg {
        transform: scale(1.15);
    }

    .social-btn:hover {
        background: var(--brand, #F22F3A);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(242, 47, 58, 0.4);
    }

    /* Bottom Certification Bar */
    .footer-bottom {
        max-width: 1300px;
        margin: 60px auto 0;
        padding: 30px 40px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .cert-list {
        display: flex;
        gap: 25px;
        color: #bbbbbb !important; /* Brightened from #444 to #bbbbbb for beautiful contrast on solid black background */
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.1rem;
        letter-spacing: 2px;
    }

    .cert-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .cert-item i, .cert-item svg {
        width: 16px;
        height: 16px;
        color: var(--brand, #F22F3A) !important; /* Brand red accent for cert icons */
        stroke: var(--brand, #F22F3A) !important;
        fill: none !important;
        display: inline-block;
    }

    .copyright {
        color: #777777 !important; /* Brightened from #444 to #777777 for readability on black background */
        font-size: 0.75rem;
        letter-spacing: 1px;
    }

    @media (max-width: 1100px) {
        .footer-container {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .footer-container {
            grid-template-columns: 1fr;
            text-align: center;
            padding: 0 20px;
        }

        .footer-col h3::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .footer-contact-item {
            justify-content: center;
        }

        .social-stack {
            justify-content: center;
        }

        .footer-bottom {
            flex-direction: column;
            text-align: center;
            padding: 20px 20px 0;
        }

        .cert-list {
            flex-direction: column;
            gap: 10px;
        }

        .footer-about p {
            margin: 0 auto;
        }
    }

    /* --- GLOBAL CTA BLOCK --- */
    .rwx-cta-block {
        background: radial-gradient(circle at 50% 50%, #200202 0%, #000000 100%);
        padding: clamp(80px, 12vw, 150px) 0;
        text-align: center;
        border-top: 1px solid rgba(255, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
        width: 100%;
        box-sizing: border-box;
    }

    .rwx-cta-block__pulse {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 0, 0, 0.12) 0%, transparent 70%);
        transform: translate(-50%, -50%);
        z-index: 1;
        pointer-events: none;
        animation: rwx-pulse-radar-global 4s infinite linear;
        border-radius: 50%;
    }

    @keyframes rwx-pulse-radar-global {
        0% { transform: translate(-50%, -50%) scale(0.6); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1.4); opacity: 0; }
    }

    .rwx-cta-block__inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 5;
        box-sizing: border-box;
    }

    .rwx-cta-block__eyebrow {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        display: block;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .rwx-cta-block__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3rem, 6vw, 5.5rem);
        margin: 0 0 25px 0;
        line-height: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }

    .rwx-cta-block__title em {
        color: transparent;
        -webkit-text-stroke: 1.5px white;
        font-style: normal;
    }

    .rwx-cta-block__desc {
        color: #aaa;
        font-size: 1.15rem;
        line-height: 1.7;
        margin-bottom: 40px;
    }

    .rwx-cta-block__actions {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    /* Global rwx-btn styles */
    .rwx-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.3rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        padding: 16px 36px;
        border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
        cursor: pointer;
    }

    .rwx-btn i, .rwx-btn svg {
        width: 18px;
        height: 18px;
        display: inline-block;
        color: currentColor;
        stroke: currentColor !important;
        fill: none !important;
    }

    .rwx-btn--red {
        background: var(--brand, #ff0000);
        color: white !important;
        border: 1px solid var(--brand, #ff0000);
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
    }

    .rwx-btn--red:hover {
        background: var(--brand-dark, #a31d24) !important;
        color: white !important;
        border-color: var(--brand-dark, #a31d24) !important;
        box-shadow: 0 0 30px rgba(255, 0, 0, 0.6);
        transform: translateY(-2px);
    }

    .rwx-btn--outline {
        background: rgba(255, 255, 255, 0.04);
        color: white !important;
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .rwx-btn--outline:hover {
        background: #ffffff !important;
        color: #000000 !important;
        border-color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.25);
    }
</style>

<?php if ( ! is_page( array( 'contact', 'privacy-policy', 'refund-policy', 'cancellation-policy' ) ) && ! is_404() ) : ?>
    <!-- ── Bottom Command CTA ────────────────────────────────────── -->
    <section class="rwx-cta-block" aria-label="Mitigation request call to action">
        <div class="rwx-cta-block__pulse" aria-hidden="true"></div>
        <div class="rwx-cta-block__inner">
            <span class="rwx-cta-block__eyebrow">24/7 Emergency Response</span>
            <h2 class="rwx-cta-block__title">Catastrophic Loss?<br><em>Activate Rapid Mitigation</em></h2>
            <p class="rwx-cta-block__desc">
                Do not wait for property destruction to become permanent. Our team stands ready to coordinate insurance claims and deploy critical recovery systems immediately.
            </p>
            <div class="rwx-cta-block__actions">
                <a href="tel:+18136994009" class="rwx-btn rwx-btn--red">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" style="margin-right:5px; vertical-align:-3px;">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Dispatch: 813.699.4009
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="rwx-btn rwx-btn--outline">Request a Free Estimate</a>
            </div>
        </div>
    </section>
<?php endif; ?>

<footer class="elite-footer" role="contentinfo">
    <div class="footer-grid-bg"></div>

    <div class="footer-container">
        <!-- BRANDING -->
        <div class="footer-col footer-about">
            <div class="footer-logo">
                <img src="https://restowrx.com/wp-content/uploads/2025/04/GetAttachmentThumbnail.png" alt="Restowrx Elite Logo" width="180" height="36" loading="lazy">
            </div>
            <p>TAMPA BAY'S COMMAND CENTER FOR PROPERTY RECOVERY. SURGICAL PRECISION. ELITE RESPONSE. 24/7 ACTIVE RADAR.</p>
            <div class="social-stack">
                <a href="https://www.instagram.com/restowrx/" class="social-btn" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                </a>
                <a href="https://www.facebook.com/restowrx/" class="social-btn" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="https://www.linkedin.com/company/restowrx/" class="social-btn" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                </a>
            </div>
        </div>

        <!-- DISPATCH LINKS -->
        <div class="footer-col">
            <h3>Mission Control</h3>
            <?php
            if ( has_nav_menu('footer-menu') ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer-menu',
                    'menu_class'     => 'footer-links', 
                    'container'      => false,          
                    'depth'          => 1,              
                ) );
            } else {
                echo '<ul class="footer-links">';
                echo '<li><a href="' . esc_url(home_url('/services/')) . '">Water Damage</a></li>';
                echo '<li><a href="' . esc_url(home_url('/services/')) . '">Fire Damage</a></li>';
                echo '<li><a href="' . esc_url(home_url('/services/')) . '">Mold Remediation</a></li>';
                echo '<li><a href="' . esc_url(home_url('/about/')) . '">About Us</a></li>';
                echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Ready Dispatch</a></li>';
                echo '</ul>';
            }
            ?>
        </div>

        <!-- RADAR ZONES -->
        <div class="footer-col">
            <h3>Active Radar</h3>
            <div class="radar-zones">
                <div class="zone-item"><div class="zone-pulse"></div>TAMPA</div>
                <div class="zone-item"><div class="zone-pulse"></div>ST. PETE</div>
                <div class="zone-item"><div class="zone-pulse"></div>CWATER</div>
                <div class="zone-item"><div class="zone-pulse"></div>BRANDON</div>
                <div class="zone-item"><div class="zone-pulse"></div>WESLEY</div>
                <div class="zone-item"><div class="zone-pulse"></div>LITHIA</div>
            </div>
        </div>

        <!-- CONTACT DISPATCH -->
        <div class="footer-col">
            <h3>Ready Dispatch</h3>
            <div class="footer-contact-item">
                <div class="contact-icon"><i data-lucide="phone-call" size="24"></i></div>
                <div class="contact-text">
                    <span>EMERGENCY DISPATCH</span>
                    <b>813.699.4009</b>
                </div>
            </div>
            <div class="footer-contact-item">
                <div class="contact-icon"><i data-lucide="mail" size="24"></i></div>
                <div class="contact-text">
                    <span>EMAIL INTEL</span>
                    <b>JOE@RESTOWRX.COM</b>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM STRIP -->
    <div class="footer-bottom">
        <div class="cert-list">
            <div class="cert-item"><i data-lucide="shield-check" size="18"></i> IICRC LICENSED</div>
            <div class="cert-item"><i data-lucide="shield-check" size="18"></i> OSHA COMPLIANT</div>
            <div class="cert-item"><i data-lucide="shield-check" size="18"></i> ELITE CERTIFIED</div>
        </div>
        <div class="copyright">
            &copy; <?php echo date('Y'); ?> RESTOWRX. ALL RIGHTS RESERVED. OPERATING AT THE APEX.
        </div>
    </div>
</footer>

<script>
(function() {
    'use strict';
    
    // Core Elements
    var header      = document.getElementById('site-header');
    var toggle      = document.getElementById('mobile-toggle');
    var mobileMenu  = document.getElementById('mobile-menu');
    var mobileOver  = document.getElementById('mobile-overlay');
    var mobileClose = document.getElementById('mobile-close');
    var scrollBtn   = document.getElementById('scroll-top');
    var lastScrollY = 0, ticking = false;

    // Remove leaving class or scroll locks on DOM loads
    document.body.classList.add('is-loaded');
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) document.body.classList.remove('is-leaving');
    });

    // ── INTERSECTION OBSERVER FOR FADE-IN REVEAL ──
    (function() {
        var obs = new IntersectionObserver(function(entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting) { 
                    entries[i].target.classList.add('is-visible'); 
                    obs.unobserve(entries[i].target); 
                }
            }
        }, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });
        
        document.querySelectorAll('.reveal').forEach(function(el) {
            var r = el.getBoundingClientRect();
            if (r.top < window.innerHeight && r.bottom > 0) el.classList.add('is-visible');
            else obs.observe(el);
        });
        
        // Safety net to show everything if observer is blocked
        setTimeout(function() { 
            document.querySelectorAll('.reveal:not(.is-visible)').forEach(function(el) { 
                el.classList.add('is-visible'); 
            }); 
        }, 1200);
    })();

    // ── HEADER & SCROLL TO TOP TRANSITIONS ──
    function onScroll() { 
        lastScrollY = window.scrollY; 
        if (!ticking) { 
            requestAnimationFrame(function() { 
                if (header) {
                    header.classList.toggle('is-scrolled', lastScrollY > 50); 
                }
                if (scrollBtn) {
                    scrollBtn.classList.toggle('is-visible', lastScrollY > 500); 
                }
                ticking = false; 
            }); 
            ticking = true; 
        } 
    }
    window.addEventListener('scroll', onScroll, { passive: true });

    // ── MOBILE MENU ACTIONS ──
    function openMenu() { 
        if(!mobileMenu || !toggle) return; 
        mobileMenu.classList.add('is-open'); 
        mobileMenu.setAttribute('aria-hidden','false'); 
        toggle.setAttribute('aria-expanded','true'); 
        document.body.style.setProperty('overflow', 'hidden', 'important'); 
        document.documentElement.style.setProperty('overflow', 'hidden', 'important');
        if (mobileClose) mobileClose.focus(); 
    }
    
    function closeMenu() { 
        if(!mobileMenu || !toggle) return; 
        mobileMenu.classList.remove('is-open'); 
        mobileMenu.setAttribute('aria-hidden','true'); 
        toggle.setAttribute('aria-expanded','false'); 
        document.body.style.removeProperty('overflow');
        document.documentElement.style.removeProperty('overflow');
        toggle.focus(); 
    }
    
    if (toggle) toggle.addEventListener('click', openMenu);
    if (mobileOver) mobileOver.addEventListener('click', closeMenu);
    if (mobileClose) mobileClose.addEventListener('click', closeMenu);
    
    document.addEventListener('keydown', function(e) { 
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) {
            closeMenu(); 
        }
    });

    if (scrollBtn) {
        scrollBtn.addEventListener('click', function() { 
            window.scrollTo({ top: 0, behavior: 'smooth' }); 
        });
    }

    // ── OPTIMIZED CLICK HANDLERS (EXITS & ANCHORS) ──
    setTimeout(function() {
        // Exit Transitions
        document.querySelectorAll('a[href]').forEach(function(link) {
            var href = link.getAttribute('href');
            if (href && href.charAt(0) !== '#' && !href.startsWith('tel:') && !href.startsWith('mailto:') && !link.hasAttribute('target') && (href.indexOf(window.location.hostname) !== -1 || href.charAt(0) === '/')) {
                
                // Exclude AJAX-driven links to allow seamless filtering/pagination
                if (link.classList.contains('blog-filter-btn') || link.closest('.blog-pagination') || link.hasAttribute('data-ajax') || link.classList.contains('no-transition')) {
                    return;
                }
                
                link.addEventListener('click', function(e) {
                    if (e.ctrlKey || e.metaKey || e.shiftKey) return;
                    e.preventDefault(); 
                    document.body.classList.add('is-leaving');
                    setTimeout(function() { window.location.href = href; }, 200);
                });
            }
        });

        // Smooth Anchor Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var id = this.getAttribute('href'); 
                if (id === '#') return;
                var target = document.querySelector(id);
                if (target) { 
                    e.preventDefault(); 
                    var y = target.getBoundingClientRect().top + window.scrollY - (header ? header.offsetHeight : 0) - 20; 
                    window.scrollTo({ top: y, behavior: 'smooth' }); 
                }
            });
        });
    }, 100);

    // ── THREE-TIER STATE RECOVERY TIMER WATCHDOG ──
    // In case mobile menu or other popups fail to clean up on navigate
    function isSafeToUnlock() {
        var menuOpen = mobileMenu && mobileMenu.classList.contains('is-open');
        return !menuOpen;
    }
    
    function tryUnlock() {
        if (!isSafeToUnlock()) return;
        document.documentElement.classList.remove('has-scroll-lock');
        document.body.classList.remove('has-scroll-lock');
        document.body.classList.remove('modal-open');
        
        if (window.getComputedStyle(document.body).overflow === 'hidden') {
            document.body.style.removeProperty('overflow');
        }
        if (window.getComputedStyle(document.documentElement).overflow === 'hidden') {
            document.documentElement.style.removeProperty('overflow');
        }
    }
    setInterval(tryUnlock, 2000);

})();
</script>

<!-- ═══ Tier C: DOM Reset Guard (Instant State & Visibility Sanitization) ═══
     Runs synchronously during HTML parsing at the bottom of the page, ensuring
     the DOM is fully reconstructed but not yet painted. Restores a clean,
     unlocked, and fully visible state, bypassing deferred event-listeners.
     ═══════════════════════════════════════════════════════════════════════ -->
<script data-no-optimize="1" data-no-defer="1" data-cfasync="false" class="no-defer">
(function() {
    var doc = document.documentElement;
    var body = document.body;
    
    // 1. Double check and clear scroll locks on html and body
    if (doc) {
        doc.classList.remove('has-scroll-lock');
        doc.style.setProperty('overflow', '', 'important');
        doc.style.setProperty('overflow-y', '', 'important');
    }
    if (body) {
        body.classList.remove('has-scroll-lock');
        body.classList.remove('modal-open');
        body.classList.remove('is-leaving');
        body.style.setProperty('overflow', '', 'important');
        body.style.setProperty('overflow-y', '', 'important');
    }

    // 2. Clear cached open states on mobile menu drawer to prevent overlay blocks
    var mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) {
        mobileMenu.classList.remove('is-open');
        mobileMenu.setAttribute('aria-hidden', 'true');
    }
    var toggle = document.getElementById('mobile-toggle');
    if (toggle) {
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
    }
})();
</script>

<?php wp_footer(); ?>

<script>
    (function() {
        function initLucide() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            } else {
                setTimeout(initLucide, 100);
            }
        }
        initLucide();
    })();
</script>

</body>
</html>
