<?php
/**
 * Hot Water Heroes — Footer v3
 * Clean dark navy footer, no emergency bar
 */
?>

<!-- Floating Mobile CTA -->
<div class="floating-cta" id="floating-cta" aria-label="Quick actions">
    <a href="/contact/" class="floating-cta__btn floating-cta__btn--book">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
        Book Now
    </a>
    <a href="tel:+18134275862" class="floating-cta__btn floating-cta__btn--call">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        Call
    </a>
</div>

<!-- Scroll to Top -->
<button class="scroll-top" id="scroll-top" aria-label="Back to top">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m18 15-6-6-6 6"/></svg>
</button>

<footer class="hwh-foot" role="contentinfo">

    <!-- Main footer body -->
    <div class="hwh-foot__main">
        <div class="hwh-foot__inner">

            <!-- Brand col -->
            <div class="hwh-foot__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hwh-foot__logo" aria-label="Hot Water Heroes — Home">
                    <img src="https://hotwaterheroesplumbing.com/wp-content/uploads/2024/11/Untitled-design-12-scaled.png"
                         alt="Hot Water Heroes Plumbing" width="300" height="144"
                         loading="lazy" decoding="async">
                </a>
                <p class="hwh-foot__brand-text">Tampa Bay's trusted plumbing team — fast, honest, and available around the clock for water heater repair, installation, and emergency plumbing.</p>
                <div class="hwh-foot__social">
                    <a href="https://www.facebook.com/hotwaterheroes/" class="hwh-foot__social-link" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/hotwaterheroes/" class="hwh-foot__social-link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                    </a>
                    <a href="https://g.co/hotwaterheroes" class="hwh-foot__social-link" aria-label="Google Reviews" target="_blank" rel="noopener noreferrer">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    </a>
                </div>
                <div class="hwh-foot__rating">
                    <span class="hwh-foot__stars">★★★★★</span>
                    <span>5.0 · 30+ Google Reviews</span>
                </div>
            </div>

            <!-- Services col -->
            <div class="hwh-foot__col">
                <h4 class="hwh-foot__heading">Our Services</h4>
                <ul class="hwh-foot__links">
                    <li><a href="<?php echo esc_url(home_url('/services/water-heater-repair/')); ?>">Water Heater Repair</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/water-heater-installation/')); ?>">Water Heater Installation</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/tankless-water-heaters/')); ?>">Tankless Water Heaters</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/drain-cleaning/')); ?>">Drain Cleaning</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/emergency-plumbing/')); ?>">Emergency Plumbing</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/leak-detection/')); ?>">Leak Detection &amp; Repair</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services/')); ?>">All Services →</a></li>
                </ul>
            </div>

            <!-- Company col -->
            <div class="hwh-foot__col">
                <h4 class="hwh-foot__heading">Company</h4>
                <ul class="hwh-foot__links">
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>">Plumbing Tips Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact col -->
            <div class="hwh-foot__col">
                <h4 class="hwh-foot__heading">Contact Us</h4>
                <div class="hwh-foot__contact">
                    <div class="hwh-foot__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:+18134275862">813-42-PLUMB</a>
                    </div>
                    <div class="hwh-foot__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:joe@hotwaterheroesplumbing.com">joe@hotwaterheroesplumbing.com</a>
                    </div>
                    <div class="hwh-foot__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <a href="https://hotwaterheroesplumbing.com" target="_blank" rel="noopener noreferrer">hotwaterheroesplumbing.com</a>
                    </div>
                    <div class="hwh-foot__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Tampa Bay, FL</span>
                    </div>
                    <div class="hwh-foot__contact-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>Open 24 Hours · 7 Days a Week</span>
                    </div>
                </div>
                <a href="/contact/" class="hwh-btn hwh-btn--red" style="margin-top:1.5rem;font-size:.78rem;">Request Service</a>
            </div>

        </div>
    </div>

    <!-- Bottom bar -->
    <div class="hwh-foot__bottom">
        <div class="hwh-foot__bottom-inner">
            <p class="hwh-foot__copyright">© <?php echo date('Y'); ?> Hot Water Heroes Plumbing. All rights reserved. · Licensed &amp; Insured · Tampa Bay, FL</p>
            <div class="hwh-foot__legal">
                <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
                <a href="<?php echo esc_url(home_url('/cancellation-policy/')); ?>">Cancellation Policy</a>
                <a href="<?php echo esc_url(home_url('/refund-policy/')); ?>">Refund Policy</a>
            </div>
        </div>
    </div>

</footer>

<script>
(function() {
    'use strict';
    var rIC = window.requestIdleCallback || function(cb) { return setTimeout(cb, 1); };
    var header      = document.getElementById('site-header');
    var toggle      = document.getElementById('mobile-toggle');
    var mobileMenu  = document.getElementById('mobile-menu');
    var mobileOver  = document.getElementById('mobile-overlay');
    var mobileClose = document.getElementById('mobile-close');
    var scrollBtn   = document.getElementById('scroll-top');
    var lastScrollY = 0, ticking = false;

    document.body.classList.add('is-loaded');

    // Fix white screen when navigating back — bfcache restores the
    // page with the exit-transition class still applied.
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) document.body.classList.remove('is-leaving');
    });

    // Scroll reveal
    (function() {
        var obs = new IntersectionObserver(function(entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting) { entries[i].target.classList.add('is-visible'); obs.unobserve(entries[i].target); }
            }
        }, { threshold: 0.05, rootMargin: '0px 0px -20px 0px' });
        document.querySelectorAll('.reveal').forEach(function(el) {
            var r = el.getBoundingClientRect();
            if (r.top < window.innerHeight && r.bottom > 0) el.classList.add('is-visible');
            else obs.observe(el);
        });
        setTimeout(function() { document.querySelectorAll('.reveal:not(.is-visible)').forEach(function(el) { el.classList.add('is-visible'); }); }, 1500);
    })();

    // Header scroll
    function onScroll() { lastScrollY = window.scrollY; if (!ticking) { requestAnimationFrame(function() { if(header) header.classList.toggle('is-scrolled', lastScrollY > 50); if(scrollBtn) scrollBtn.classList.toggle('is-visible', lastScrollY > 600); ticking = false; }); ticking = true; } }
    window.addEventListener('scroll', onScroll, { passive: true });
    if (header) header.style.top = '0px';

    // Mobile menu
    function openMenu() { if(!mobileMenu||!toggle) return; mobileMenu.classList.add('is-open'); mobileMenu.setAttribute('aria-hidden','false'); toggle.classList.add('is-active'); toggle.setAttribute('aria-expanded','true'); document.body.style.overflow='hidden'; if(mobileClose) mobileClose.focus(); }
    function closeMenu() { if(!mobileMenu||!toggle) return; mobileMenu.classList.remove('is-open'); mobileMenu.setAttribute('aria-hidden','true'); toggle.classList.remove('is-active'); toggle.setAttribute('aria-expanded','false'); document.body.style.overflow=''; toggle.focus(); }
    if (toggle) toggle.addEventListener('click', openMenu);
    if (mobileOver) mobileOver.addEventListener('click', closeMenu);
    if (mobileClose) mobileClose.addEventListener('click', closeMenu);
    document.addEventListener('keydown', function(e) { if (e.key==='Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) closeMenu(); });
    if (scrollBtn) scrollBtn.addEventListener('click', function() { window.scrollTo({ top: 0, behavior: 'smooth' }); });

    rIC(function() {
        // Page exit transitions
        document.querySelectorAll('a[href]').forEach(function(link) {
            var href = link.getAttribute('href');
            if (href && href.charAt(0)!=='#' && !href.startsWith('tel:') && !href.startsWith('mailto:') && !link.hasAttribute('target') && (href.indexOf(window.location.hostname)!==-1 || href.charAt(0)==='/')) {
                link.addEventListener('click', function(e) {
                    if (e.ctrlKey||e.metaKey||e.shiftKey) return;
                    e.preventDefault(); document.body.classList.add('is-leaving');
                    setTimeout(function() { window.location.href = href; }, 250);
                });
            }
        });
        // Lazy image fade
        document.querySelectorAll('img[loading="lazy"]').forEach(function(img) {
            if (img.complete) img.classList.add('is-loaded');
            else img.addEventListener('load', function() { this.classList.add('is-loaded'); });
        });
        // Smooth anchors (skip /contact/ — handled by ServiceTitan)
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var id = this.getAttribute('href'); if (id==='#') return;
                if (id === '/contact/') return; // ServiceTitan handles this
                var target = document.querySelector(id);
                if (target) { e.preventDefault(); var y = target.getBoundingClientRect().top + window.scrollY - (header ? header.offsetHeight : 0) - 20; window.scrollTo({ top: y, behavior: 'smooth' }); }
            });
        });
        // Floating CTA hide near footer
        var floatingCta = document.getElementById('floating-cta');
        var siteFooter  = document.querySelector('.hwh-foot');
        if (floatingCta && siteFooter) {
            new IntersectionObserver(function(entries) {
                floatingCta.style.opacity       = entries[0].isIntersecting ? '0' : '';
                floatingCta.style.pointerEvents = entries[0].isIntersecting ? 'none' : '';
            }, { threshold: 0.1 }).observe(siteFooter);
        }
        // Contact form
        var contactForm = document.getElementById('contact-form');
        var formSuccess = document.getElementById('form-success');
        if (contactForm && formSuccess) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var btn = contactForm.querySelector('.contact-form__submit');
                var orig = btn ? btn.innerHTML : '';
                if (btn) { btn.innerHTML = 'Sending…'; btn.disabled = true; }
                var data = new FormData(contactForm); data.set('action','hwh_contact_submit');
                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', { method:'POST', body:data, credentials:'same-origin' })
                    .then(function(r){ return r.json(); })
                    .then(function(res){ if(res.success){ contactForm.style.display='none'; formSuccess.classList.add('is-visible'); formSuccess.scrollIntoView({behavior:'smooth',block:'center'}); } else { if(btn){ btn.innerHTML=orig; btn.disabled=false; } alert((res.data&&res.data.message)?res.data.message:'Something went wrong.'); } })
                    .catch(function(){ if(btn){ btn.innerHTML=orig; btn.disabled=false; } alert('Connection error. Please call us at 813-42-PLUMB.'); });
            });
        }
        var phoneInput = document.getElementById('cf-phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                var d = this.value.replace(/\D/g,'');
                if (d.length<=3) this.value = d.length ? '('+d : '';
                else if (d.length<=6) this.value = '('+d.slice(0,3)+') '+d.slice(3);
                else this.value = '('+d.slice(0,3)+') '+d.slice(3,6)+'-'+d.slice(6,10);
            });
        }
    });

    // Cookie banner
    setTimeout(function() { rIC(function() {
        if (!localStorage.getItem('hwh-cookie-consent')) {
            setTimeout(function() {
                var banner = document.createElement('div');
                banner.id = 'cookie-banner'; banner.className = 'cookie-banner';
                banner.setAttribute('role','dialog'); banner.setAttribute('aria-label','Cookie consent');
                banner.innerHTML = '<div class="cookie-banner__inner"><p class="cookie-banner__text"><strong>Cookies</strong> — We use cookies to enhance your experience.</p><div class="cookie-banner__actions"><button class="cookie-banner__btn cookie-banner__btn--accept" id="cookie-accept">Accept</button><button class="cookie-banner__btn cookie-banner__btn--decline" id="cookie-decline">Decline</button></div></div>';
                document.body.appendChild(banner);
                requestAnimationFrame(function() { banner.classList.add('is-visible'); });
                document.getElementById('cookie-accept').addEventListener('click', function() { localStorage.setItem('hwh-cookie-consent','accepted'); banner.classList.remove('is-visible'); setTimeout(function(){ banner.remove(); }, 400); });
                document.getElementById('cookie-decline').addEventListener('click', function() { localStorage.setItem('hwh-cookie-consent','declined'); banner.classList.remove('is-visible'); setTimeout(function(){ banner.remove(); }, 400); });
            }, 5000);
        }
    }); }, 200);

})();
</script>

<?php
$popup_enabled = get_theme_mod('hwh_popup_enabled', false);
$popup_expiry  = get_theme_mod('hwh_popup_expiry', '');
$popup_active  = $popup_enabled;
if ($popup_active && !empty($popup_expiry) && strtotime($popup_expiry) && strtotime($popup_expiry) < time()) $popup_active = false;
if ($popup_active) :
    $p_badge    = esc_html(get_theme_mod('hwh_popup_badge',    'Limited Time'));
    $p_title    = esc_html(get_theme_mod('hwh_popup_title',    '$50 Off Your First Service'));
    $p_text     = esc_html(get_theme_mod('hwh_popup_text',     'Book your first plumbing service and save $50. Available for new customers in Tampa Bay.'));
    $p_code     = esc_html(get_theme_mod('hwh_popup_code',     ''));
    $p_btn_text = esc_html(get_theme_mod('hwh_popup_btn_text', 'Claim Offer Now'));
    $p_btn_url  = esc_url(get_theme_mod('hwh_popup_btn_url',   '/contact/'));
    $p_delay    = absint(get_theme_mod('hwh_popup_delay',      5)) * 1000;
    $p_freq     = absint(get_theme_mod('hwh_popup_frequency',  7));
?>
<div class="deal-popup" id="deal-popup" role="dialog" aria-modal="true" aria-label="Special offer" aria-hidden="true">
    <div class="deal-popup__overlay" id="deal-popup-overlay"></div>
    <div class="deal-popup__modal">
        <button class="deal-popup__close" id="deal-popup-close" aria-label="Close offer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m18 6-12 12"/><path d="m6 6 12 12"/></svg>
        </button>
        <div class="deal-popup__glow" aria-hidden="true"></div>
        <div class="deal-popup__content">
            <span class="deal-popup__badge"><?php echo $p_badge; ?></span>
            <h2 class="deal-popup__title"><?php echo $p_title; ?></h2>
            <p class="deal-popup__text"><?php echo $p_text; ?></p>
            <?php if ($p_code) : ?>
            <div class="deal-popup__code-wrap">
                <span class="deal-popup__code-label">Use Code</span>
                <span class="deal-popup__code"><?php echo $p_code; ?></span>
                <button class="deal-popup__copy" onclick="navigator.clipboard.writeText('<?php echo esc_js($p_code); ?>');this.textContent='✓ Copied!'">Copy</button>
            </div>
            <?php endif; ?>
            <a href="<?php echo $p_btn_url; ?>" class="hwh-btn hwh-btn--red hwh-btn--lg deal-popup__btn"><?php echo $p_btn_text; ?></a>
            <p class="deal-popup__fine">No commitment required · New customers only</p>
        </div>
    </div>
</div>
<script>(function(){
    var KEY='hwh-popup-dismissed',FREQ=<?php echo $p_freq; ?>,DELAY=<?php echo $p_delay; ?>;
    var last=localStorage.getItem(KEY);
    if(last&&(Date.now()-parseInt(last,10))/86400000<FREQ) return;
    var popup=document.getElementById('deal-popup'),overlay=document.getElementById('deal-popup-overlay'),closeBtn=document.getElementById('deal-popup-close');
    function open(){popup.classList.add('is-open');popup.setAttribute('aria-hidden','false');document.body.style.overflow='hidden';}
    function close(){popup.classList.remove('is-open');popup.setAttribute('aria-hidden','true');document.body.style.overflow='';localStorage.setItem(KEY,Date.now());}
    setTimeout(open,DELAY);
    closeBtn.addEventListener('click',close);overlay.addEventListener('click',close);
    document.addEventListener('keydown',function(e){if(e.key==='Escape'&&popup.classList.contains('is-open'))close();});
})();</script>
<?php endif; ?>

<!-- ServiceTitan scheduler widget disabled — re-enable when configured -->


<?php wp_footer(); ?>

</body>
</html>
