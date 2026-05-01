<?php
/**
 * Hot Water Heroes — Header Template v2
 * Two-layer: dark top bar + white nav bar
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0F2440">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <?php
    if (is_front_page()) {
        $meta_desc = 'Hot Water Heroes is Tampa Bay\'s trusted plumbing company. Expert water heater repair, installation, drain cleaning, leak detection, and 24/7 emergency plumbing. Call today.';
    } elseif (is_singular('service')) {
        $meta_desc = wp_strip_all_tags(get_the_excerpt()) ?: get_the_title() . ' in Tampa Bay, FL — Hot Water Heroes Plumbing. Licensed, insured, and trusted by homeowners across Tampa Bay.';
    } elseif (is_page()) {
        $meta_desc = wp_strip_all_tags(get_the_excerpt()) ?: 'Hot Water Heroes Plumbing — Tampa Bay\'s trusted plumbing experts for water heaters, drain cleaning, leak detection, and 24/7 emergency service.';
    } else {
        $meta_desc = 'Hot Water Heroes Plumbing — Tampa Bay\'s premier plumbing company. Water heaters, drain cleaning, emergency plumbing, and more.';
    }
    ?>
    <meta name="description" content="<?php echo esc_attr($meta_desc); ?>">
    <link rel="canonical" href="<?php echo esc_url(get_permalink() ?: home_url('/')); ?>">

    <?php
    $og_img    = 'https://hotwaterheroes.com/wp-content/uploads/2026/04/Hero-Apirl4.png';
    $og_title  = is_front_page() ? 'Hot Water Heroes Plumbing | Trusted Plumbers in Tampa Bay, FL' : wp_get_document_title();
    $og_desc   = $meta_desc;
    $og_url    = is_front_page() ? home_url('/') : (get_permalink() ?: home_url('/'));
    $og_type   = (is_front_page() || is_page()) ? 'website' : 'article';
    if (has_post_thumbnail()) {
        $td = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if ($td) $og_img = esc_url($td[0]);
    }
    ?>
    <meta property="og:site_name"   content="Hot Water Heroes Plumbing">
    <meta property="og:type"        content="<?php echo esc_attr($og_type); ?>">
    <meta property="og:url"         content="<?php echo esc_url($og_url); ?>">
    <meta property="og:title"       content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($og_desc); ?>">
    <meta property="og:image"       content="<?php echo esc_url($og_img); ?>">
    <meta name="twitter:card"       content="summary_large_image">
    <meta name="twitter:title"      content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($og_desc); ?>">
    <meta name="twitter:image"      content="<?php echo esc_url($og_img); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php
    $theme_ver = filemtime(get_stylesheet_directory() . '/style.css');
    echo '<link rel="preload" href="' . esc_url(get_stylesheet_uri() . '?ver=' . $theme_ver) . '" as="style">' . "\n";
    ?>

    <?php wp_head(); ?>

    <style id="hwh-critical-css">
        html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
        body { margin: 0; font-family: 'Inter','Helvetica Neue',Arial,sans-serif; background: #F8F9FB; overflow-x: hidden; }
        .site-main { padding-top: 115px; }
        .hwh-header { position: fixed; top: 0; left: 0; right: 0; z-index: 200; }
        .hwh-topbar { background: #0F2440; height: 40px; display: flex; align-items: center; }
        .hwh-topbar__inner { max-width: 1280px; margin: 0 auto; padding: 0 clamp(1.25rem,1rem + 2vw,3rem); display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 1.5rem; }
        .hwh-nav-bar { background: rgba(255,255,255,0.97); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); box-shadow: 0 2px 20px rgba(0,0,0,0.08); padding: 0.85rem 0; transition: padding .3s ease; }
        .hwh-nav-bar__inner { max-width: 1280px; margin: 0 auto; padding: 0 clamp(1.25rem,1rem + 2vw,3rem); display: flex; align-items: center; justify-content: space-between; gap: 2rem; }
        @font-face { font-family: 'Montserrat'; font-display: swap; src: local('Montserrat'); }
        @font-face { font-family: 'Inter'; font-display: swap; src: local('Inter'); }
    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-to-content" href="#main-content">Skip to content</a>

<!-- ═══════════════════════════════════════════
     TWO-LAYER HEADER
     ═══════════════════════════════════════════ -->
<header class="hwh-header" id="site-header" role="banner">

    <!-- ── LAYER 1: Top Info Bar ── -->
    <div class="hwh-topbar" role="complementary" aria-label="Contact information">
        <div class="hwh-topbar__inner">

            <!-- Left: quick info -->
            <div class="hwh-topbar__left">
                <a href="tel:+18134275862" class="hwh-topbar__item hwh-topbar__item--phone">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    813-42-PLUMB
                </a>
                <span class="hwh-topbar__sep" aria-hidden="true">|</span>
                <span class="hwh-topbar__item">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Mon–Fri 7am–6pm &nbsp;·&nbsp; 24/7 Emergency
                </span>
                <span class="hwh-topbar__sep" aria-hidden="true">|</span>
                <span class="hwh-topbar__item hwh-topbar__item--live">
                    <span class="hwh-topbar__dot" aria-hidden="true"></span>
                    Available Now
                </span>
            </div>

            <!-- Right: search + social -->
            <div class="hwh-topbar__right">
                <!-- Mini search -->
                <form class="hwh-topbar__search" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get" aria-label="Site search">
                    <input type="search" name="s" class="hwh-topbar__search-input" placeholder="Search services…" aria-label="Search" value="<?php echo esc_attr(get_search_query()); ?>">
                    <button type="submit" class="hwh-topbar__search-btn" aria-label="Submit search">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    </button>
                </form>
                <!-- Social -->
                <a href="https://www.facebook.com/hotwaterheroes/" class="hwh-topbar__social" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="https://www.instagram.com/hotwaterheroes/" class="hwh-topbar__social" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                </a>
            </div>

        </div>
    </div>

    <!-- ── LAYER 2: Main Nav Bar ── -->
    <div class="hwh-nav-bar">
        <div class="hwh-nav-bar__inner">

            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hwh-nav__logo" aria-label="Hot Water Heroes Plumbing — Home">
                <img src="https://hotwaterheroesplumbing.com/wp-content/uploads/2025/08/HEROES-16-x-9-in-scaled-e1755179786780.png"
                     alt="Hot Water Heroes Plumbing" width="260" height="65"
                     loading="eager" decoding="async" class="hwh-nav__logo-img">
            </a>

            <!-- Desktop nav -->
            <nav class="hwh-nav" aria-label="Main navigation">
                <ul class="hwh-nav__links">
                    <li class="hwh-nav__item<?php if (is_front_page()) echo ' hwh-nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="hwh-nav__link">Home</a>
                    </li>
                    <li class="hwh-nav__item hwh-nav__item--has-drop<?php if (is_post_type_archive('service') || is_singular('service')) echo ' hwh-nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="hwh-nav__link">
                            Services <span class="hwh-nav__arrow" aria-hidden="true">▾</span>
                        </a>
                        <div class="hwh-drop">
                            <div class="hwh-drop__inner">
                                <div class="hwh-drop__col">
                                    <span class="hwh-drop__heading">Water Heaters</span>
                                    <a href="<?php echo esc_url(home_url('/services/water-heater-repair/')); ?>" class="hwh-drop__item">
                                        <span class="hwh-drop__icon">🔥</span>
                                        <span>
                                            <strong>Water Heater Repair</strong>
                                            <em>Same-day diagnosis &amp; fix</em>
                                        </span>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/services/water-heater-installation/')); ?>" class="hwh-drop__item">
                                        <span class="hwh-drop__icon">⚡</span>
                                        <span>
                                            <strong>Water Heater Installation</strong>
                                            <em>All brands, up to code</em>
                                        </span>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/services/tankless-water-heaters/')); ?>" class="hwh-drop__item">
                                        <span class="hwh-drop__icon">💧</span>
                                        <span>
                                            <strong>Tankless Water Heaters</strong>
                                            <em>Endless hot water upgrades</em>
                                        </span>
                                    </a>
                                </div>
                                <div class="hwh-drop__col">
                                    <span class="hwh-drop__heading">Plumbing Services</span>
                                    <a href="<?php echo esc_url(home_url('/services/drain-cleaning/')); ?>" class="hwh-drop__item">
                                        <span class="hwh-drop__icon">🔩</span>
                                        <span>
                                            <strong>Drain Cleaning</strong>
                                            <em>Hydro-jetting &amp; snaking</em>
                                        </span>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/services/emergency-plumbing/')); ?>" class="hwh-drop__item">
                                        <span class="hwh-drop__icon">🚨</span>
                                        <span>
                                            <strong>Emergency Plumbing</strong>
                                            <em>24/7 rapid response</em>
                                        </span>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/services/leak-detection/')); ?>" class="hwh-drop__item">
                                        <span class="hwh-drop__icon">🔍</span>
                                        <span>
                                            <strong>Leak Detection &amp; Repair</strong>
                                            <em>Non-invasive technology</em>
                                        </span>
                                    </a>
                                </div>
                                <div class="hwh-drop__promo">
                                    <span class="hwh-drop__promo-label">⚡ New Customer Deal</span>
                                    <h4 class="hwh-drop__promo-title">$50 Off Your First Service</h4>
                                    <p class="hwh-drop__promo-text">Book any plumbing service and save $50 on your first visit. New customers only.</p>
                                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-drop__promo-btn">Book Now →</a>
                                </div>
                            </div>
                            <div class="hwh-drop__footer">
                                <a href="<?php echo esc_url(home_url('/service-areas/')); ?>" class="hwh-drop__footer-link">📍 Service Areas</a>
                                <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="hwh-drop__footer-link">💳 Financing Available</a>
                                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="hwh-drop__footer-cta">View All Services →</a>
                            </div>
                        </div>
                    </li>
                    <li class="hwh-nav__item<?php if (is_page('about')) echo ' hwh-nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/about/')); ?>" class="hwh-nav__link">About</a>
                    </li>
                    <li class="hwh-nav__item<?php if (is_page('service-areas')) echo ' hwh-nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/service-areas/')); ?>" class="hwh-nav__link">Service Areas</a>
                    </li>
                    <li class="hwh-nav__item<?php if (is_page('financing')) echo ' hwh-nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/financing/')); ?>" class="hwh-nav__link">Financing</a>
                    </li>
                    <li class="hwh-nav__item<?php if (is_page('contact')) echo ' hwh-nav__item--active'; ?>">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-nav__link">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- Actions -->
            <div class="hwh-nav__actions">
                <a href="tel:+18134275862" class="hwh-nav__call" aria-label="Call 813-42-PLUMB">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-btn hwh-btn--red hwh-btn--sm">Book Service</a>
                <button class="hwh-nav__hamburger" id="mobile-toggle" aria-label="Open navigation" aria-expanded="false" aria-controls="mobile-menu">
                    <span class="hamburger"><span class="hamburger__line"></span><span class="hamburger__line"></span><span class="hamburger__line"></span></span>
                </button>
            </div>

        </div>
    </div>

</header>

<!-- ═══════════════════════════════════════════
     MOBILE MENU
     ═══════════════════════════════════════════ -->
<div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Mobile navigation" aria-hidden="true">
    <div class="mobile-menu__overlay" id="mobile-overlay"></div>
    <div class="mobile-menu__drawer">
        <div class="mobile-menu__header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hwh-nav__logo">
                <img src="https://hotwaterheroesplumbing.com/wp-content/uploads/2025/08/HEROES-16-x-9-in-scaled-e1755179786780.png" alt="Hot Water Heroes" width="180" height="45">
            </a>
            <button class="mobile-menu__close" id="mobile-close" aria-label="Close navigation">×</button>
        </div>

        <!-- Mobile search -->
        <form class="hwh-mobile-search" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get" aria-label="Search">
            <input type="search" name="s" placeholder="Search services…" aria-label="Search" value="<?php echo esc_attr(get_search_query()); ?>">
            <button type="submit" aria-label="Search">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            </button>
        </form>

        <nav class="mobile-menu__nav" aria-label="Mobile navigation">
            <ul class="mobile-menu__links">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/')); ?>">All Services</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/water-heater-repair/')); ?>">↳ Water Heater Repair</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/emergency-plumbing/')); ?>">↳ Emergency Plumbing</a></li>
                <li><a href="<?php echo esc_url(home_url('/services/drain-cleaning/')); ?>">↳ Drain Cleaning</a></li>
                <li><a href="<?php echo esc_url(home_url('/about/')); ?>">About Us</a></li>
                <li><a href="<?php echo esc_url(home_url('/service-areas/')); ?>">Service Areas</a></li>
                <li><a href="<?php echo esc_url(home_url('/financing/')); ?>">Financing</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
            </ul>
        </nav>

        <div class="mobile-menu__footer">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-btn hwh-btn--red" style="width:100%;justify-content:center;">Book a Service →</a>
            <a href="tel:+18134275862" class="mobile-menu__contact-item">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                813-42-PLUMB — 24/7 Emergency
            </a>
            <a href="mailto:info@hotwaterheroes.com" class="mobile-menu__contact-item">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                info@hotwaterheroes.com
            </a>
        </div>
    </div>
</div>
