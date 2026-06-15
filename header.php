<?php
/**
 * Restowrx Elite Theme — Header Template
 * Premium tactical theme header with scroll locks recovery
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#120303">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <?php
    $og_img   = 'https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=1200';
    $og_title = is_front_page() ? 'Restowrx Elite | Command Center for Property Recovery' : wp_get_document_title();
    $og_desc  = '';
    if ( function_exists('YoastSEO') ) {
        $yoast_meta = YoastSEO()->meta->for_current_page();
        $og_desc    = $yoast_meta ? $yoast_meta->description : '';
    }
    if ( empty( $og_desc ) ) {
        $og_desc = is_singular() ? wp_strip_all_tags( get_the_excerpt() ) : 'Tampa Bay\'s command center for property recovery. Surgical precision. Elite response. 24/7 active radar.';
    }
    $og_url  = is_singular() ? get_permalink() : ( is_front_page() ? home_url('/') : ( is_archive() ? get_term_link( get_queried_object() ) : home_url('/') ) );
    $og_url  = is_wp_error( $og_url ) ? home_url('/') : $og_url;
    $og_type = 'website';
    if ( has_post_thumbnail() ) {
        $td = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        if ( $td ) $og_img = esc_url( $td[0] );
    }
    ?>
    <meta property="og:locale"       content="en_US">
    <meta property="og:site_name"   content="Restowrx Elite">
    <meta property="og:type"        content="<?php echo esc_attr($og_type); ?>">
    <meta property="og:url"         content="<?php echo esc_url($og_url); ?>">
    <meta property="og:title"       content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($og_desc); ?>">
    <meta property="og:image"       content="<?php echo esc_url($og_img); ?>">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"    content="Restowrx Elite - Tactical Command">
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($og_desc); ?>">
    <meta name="twitter:image"       content="<?php echo esc_url($og_img); ?>">

    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800;900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <?php
    $theme_ver = filemtime(get_stylesheet_directory() . '/style.css');
    echo '<link rel="preload" href="' . esc_url(get_stylesheet_uri() . '?ver=' . $theme_ver) . '" as="style">' . "\n";
    ?>

    <?php wp_head(); ?>

    <style id="rwx-critical-css">
        :root {
            --font-main: 'Inter', sans-serif;
            --font-accent: 'Bebas Neue', sans-serif;
            --font-mono: 'Space Mono', monospace;
            --color-red: #F22F3A;
        }
        html { 
            scroll-behavior: smooth; 
            scroll-padding-top: clamp(80px, 10vw, 110px); 
            -webkit-font-smoothing: antialiased; 
        }
        body { 
            margin: 0; 
            font-family: var(--font-main); 
            background: #000000; 
            color: #ffffff;
            overflow-x: hidden; 
        }
        .site-main { 
            padding-top: 0 !important; 
        }

        .rwx-header-master {
            --color-red: #F22F3A;
            --color-maroon: #120303;
            --color-black: #000000;
            width: 100%; position: fixed;
            top: 0; left: 0;
            z-index: 100000;
            background: transparent;
            transition: all 0.3s ease;
        }

        /* --- TWO-TONE SPICOLA STYLE BACKGROUNDS --- */
        .rwx-top-bar, .rwx-nav-bar {
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .rwx-top-bar {
            background: #060606;
            padding: 6px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            min-height: 30px;
        }

        .rwx-nav-bar {
            background: #ffffff;
            padding: 10px 0;
            min-height: 55px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        .top-bar-inner, .nav-bar-inner {
            width: 1300px;
            max-width: 95%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* --- TOP BAR ELEMENTS --- */
        .top-left { display: flex; gap: 20px; align-items: center; }
        .top-left span { 
            display: flex; align-items: center; gap: 6px; 
            color: rgba(255, 255, 255, 0.85) !important; font-family: var(--font-mono); font-size: 0.68rem; font-weight: 500;
            letter-spacing: 0.8px;
        }
        .top-left svg, .top-left i { color: var(--color-red) !important; opacity: 0.9; width: 12px; height: 12px; }

        .top-right { display: flex; gap: 10px; align-items: center; }
        .header-license {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.85) !important;
            font-family: var(--font-mono);
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.03);
            padding: 4px 8px;
            border-radius: 4px;
        }
        .header-license i, .header-license svg {
            color: var(--color-red) !important;
            width: 12px;
            height: 12px;
        }

        /* --- DYNAMIC LOCATION SELECTOR --- */
        .rwx-location-selector {
            display: flex;
            align-items: center;
            position: relative;
            margin-right: 5px;
        }
        .rwx-location-selector select {
            background: #111111;
            color: rgba(255, 255, 255, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 4px;
            padding: 3px 25px 3px 10px;
            font-family: var(--font-mono, 'Space Mono', monospace);
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            outline: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23F22F3A' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'></polyline></svg>");
            background-repeat: no-repeat;
            background-position: right 8px center;
            height: 24px;
        }
        .rwx-location-selector select:hover {
            border-color: #F22F3A;
            color: #ffffff !important;
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            .rwx-top-bar .top-left span:nth-child(2),
            .rwx-top-bar .top-left span:nth-child(3) {
                display: none !important;
            }
            .rwx-location-selector {
                margin-right: 0;
            }
            .header-license {
                font-size: 0.6rem;
                padding: 2px 6px;
                gap: 4px;
            }
        }

        /* --- NAV BAR ELEMENTS --- */
        .rwx-logo {
            height: 22px;
            display: flex; align-items: center;
            flex: 0 0 auto;
            transition: transform 0.3s ease;
        }
        .rwx-logo:hover {
            transform: scale(1.02);
        }
        .rwx-logo img { height: 100%; width: auto; object-fit: contain; }

        .nav-container { 
            display: flex; align-items: center; justify-content: space-between;
            flex: 1; margin-left: 40px;
        }
        
        .nav-links {
            list-style: none; padding: 0; margin: 0;
            display: flex; gap: 6px;
            position: absolute; left: 50%; transform: translateX(-50%);
        }
        .nav-links li { position: relative; padding: 12px 0; }
        .nav-links a {
            color: #0f2440 !important;
            text-decoration: none;
            font-family: var(--font-main);
            font-weight: 500;
            text-transform: none;
            font-size: 0.83rem;
            letter-spacing: normal;
            position: relative;
            padding: 8px 16px;
            border-radius: 9999px;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
        }
        .nav-links a:hover, .nav-links li:hover > a {
            color: #F22F3A !important;
            background: rgba(242, 47, 58, 0.06);
        }
        .nav-links li.current-menu-item > a {
            color: #F22F3A !important;
        }
        .nav-links li.current-menu-item > a::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #F22F3A;
        }

        /* Sub-menus unified to White Glass */
        .nav-links .sub-menu {
            position: absolute;
            top: 100%; left: 50%; transform: translateX(-50%);
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-top: 3px solid var(--color-red);
            min-width: 200px;
            display: none;
            list-style: none; padding: 10px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 0;
            z-index: 1000;
            border-radius: 4px;
        }
        .nav-links li:hover > .sub-menu { display: block; }
        .nav-links .sub-menu li { padding: 0; }
        .nav-links .sub-menu a {
            display: block;
            padding: 8px 20px;
            color: #0f2440 !important;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: none;
            transition: color 0.2s ease;
            border-radius: 0;
        }
        .nav-links .sub-menu a::after { display: none !important; }
        .nav-links .sub-menu a:hover,
        .nav-links .sub-menu li:hover > a {
            color: #F22F3A !important;
            background: rgba(0,0,0,0.02) !important;
            border-radius: 0 !important;
        }

        .cta-btn-header {
            margin-left: auto;
            background: linear-gradient(135deg, var(--color-red) 0%, #990000 100%);
            color: white !important;
            text-decoration: none;
            font-family: var(--font-accent);
            font-size: 1.15rem;
            padding: 8px 24px;
            letter-spacing: 1px;
            border-radius: 4px;
            display: flex; align-items: center; gap: 8px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 0, 0, 0.3);
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-transform: uppercase;
        }
        .cta-btn-header svg, .cta-btn-header i {
            width: 14px;
            height: 14px;
            stroke: currentColor !important;
            fill: none !important;
            display: inline-block;
        }
        .cta-btn-header::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: 0.5s;
        }
        .cta-btn-header:hover::before {
            left: 100%;
        }
        .cta-btn-header:hover {
            background: #111111 !important;
            color: #ffffff !important;
            border-color: #111111;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px) scale(1.02);
        }
        .cta-btn-header + .cta-btn-header {
            margin-left: 12px;
        }
        @media (max-width: 1300px) and (min-width: 1025px) {
            .nav-links {
                position: static;
                transform: none;
                margin-left: 20px;
            }
            .cta-btn-header {
                font-size: 0.95rem;
                padding: 6px 16px;
            }
        }

        /* Mobile Menu Toggle button */
        .menu-toggle { 
            display: none; 
            color: #0f2440; 
            cursor: pointer; 
            font-size: 1.5rem;
            display: none;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .nav-links, .cta-btn-header { display: none !important; }
            .menu-toggle { display: flex; }
            .top-left span:last-child { display: none; }
        }

        /* --- TACTICAL MOBILE MENU DRAWER --- */
        .mobile-menu {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 200000;
            opacity: 0; pointer-events: none;
            transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .mobile-menu.is-open {
            opacity: 1; pointer-events: auto;
        }
        .mobile-menu__overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
        }
        .mobile-menu__drawer {
            position: absolute;
            top: 0; right: -320px; width: 320px; height: 100%;
            background: var(--color-maroon);
            border-left: 2px solid var(--color-red);
            box-shadow: -10px 0 30px rgba(0,0,0,0.8);
            display: flex; flex-direction: column;
            transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            padding: 30px 24px;
            box-sizing: border-box;
        }
        .mobile-menu.is-open .mobile-menu__drawer {
            right: 0;
        }
        .mobile-menu__header {
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .mobile-menu__logo img {
            height: 28px; width: auto;
            filter: brightness(0) invert(1);
        }
        .mobile-menu__close {
            background: none; border: none; color: white;
            font-size: 2.2rem; cursor: pointer; line-height: 1;
            padding: 0; margin-top: -5px;
            transition: color 0.2s;
        }
        .mobile-menu__close:hover {
            color: var(--color-red);
        }
        .mobile-menu__nav {
            flex: 1; overflow-y: auto;
        }
        .mobile-menu__links {
            list-style: none; padding: 0; margin: 0;
            display: flex; flex-direction: column; gap: 20px;
        }
        .mobile-menu__links a {
            color: white; text-decoration: none;
            font-family: var(--font-accent);
            font-size: 1.8rem; letter-spacing: 1px;
            text-transform: uppercase;
            display: block;
            transition: color 0.2s;
        }
        .mobile-menu__links a:hover, .mobile-menu__links li.current-menu-item > a {
            color: var(--color-red) !important;
            padding-left: 8px;
        }
        .mobile-menu__footer {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-top: 20px;
            display: flex; flex-direction: column; gap: 15px;
        }
        .mobile-menu__contact-item {
            display: flex; align-items: center; gap: 10px;
            color: #888; text-decoration: none;
            font-family: var(--font-mono); font-size: 0.8rem;
        }
        .mobile-menu__contact-item svg, .mobile-menu__contact-item i {
            color: var(--color-red); width: 14px; height: 14px;
        }
        .mobile-menu__cta {
            background: var(--color-red); color: white;
            font-family: var(--font-accent); text-align: center;
            font-size: 1.4rem; padding: 10px; border-radius: 4px;
            text-decoration: none; text-transform: uppercase;
            letter-spacing: 1px; transition: transform 0.2s;
        }
        .mobile-menu__cta:hover {
            transform: scale(1.03);
        }
    </style>

    <!-- ═══ Tier A: Head Guard (Instant Document Sanitization) ═══════════════
         Prevents cached scroll-locks from freezing the page during HTML parse.
         ═══════════════════════════════════════════════════════════════════ -->
    <script data-no-optimize="1" data-no-defer="1" data-cfasync="false" class="no-defer">
    (function(){
        var doc = document.documentElement;
        if (doc) {
            doc.style.setProperty('overflow', '', 'important');
            doc.style.setProperty('overflow-y', '', 'important');
            doc.classList.remove('fouc-guard');
            doc.classList.remove('has-scroll-lock');
        }
        window.addEventListener('pageshow', function(e) {
            var body = document.body;
            if (body) {
                body.classList.remove('is-leaving');
                body.classList.remove('has-scroll-lock');
                body.style.setProperty('overflow', '', 'important');
                body.style.setProperty('overflow-y', '', 'important');
            }
            if (doc) {
                doc.classList.remove('has-scroll-lock');
                doc.style.setProperty('overflow', '', 'important');
                doc.style.setProperty('overflow-y', '', 'important');
            }
        });
    }());
    </script>
</head>

<body <?php body_class(); ?>>
    <!-- ═══ Tier B: Body Open Guard (Instant Viewport Sanitization) ══════════ -->
    <script data-no-optimize="1" data-no-defer="1" data-cfasync="false" class="no-defer">
    (function(){
        var body = document.body;
        if (body) {
            body.classList.remove('has-scroll-lock');
            body.classList.remove('modal-open');
            body.classList.remove('is-leaving');
            body.style.setProperty('overflow', '', 'important');
            body.style.setProperty('overflow-y', '', 'important');
        }
    }());
    </script>

<a class="skip-to-content" href="#main-content" style="position: absolute; top: -100px; left: 0; background: #F22F3A; color: white; padding: 10px; z-index: 999999; transition: top 0.2s; font-family: monospace; font-size: 0.8rem; text-decoration: none;" onfocus="this.style.top='0'" onblur="this.style.top='-100px'">Skip to content</a>

<!-- ═══════════════════════════════════════════
     TACTICAL COMMAND HEADER
     ═══════════════════════════════════════════ -->
<header class="rwx-header-master" id="site-header" role="banner">
    <!-- TOP BAR -->
    <div class="rwx-top-bar" role="complementary" aria-label="Command Stats">
        <div class="top-bar-inner">
            <div class="top-left">
                <span><i data-lucide="shield"></i> ELITE STATUS: ACTIVE</span>
                <span><i data-lucide="clock"></i> 45 MIN RESPONSE</span>
                <span id="rwx-top-bar-location"><i data-lucide="map-pin"></i> TAMPA BAY COMMAND</span>
            </div>
            <div class="top-right">
                <div class="rwx-location-selector">
                    <select id="rwx-location-dropdown" aria-label="Select Dispatch Location">
                        <option value="tampa">Tampa (Main)</option>
                        <option value="south-tampa">South Tampa</option>
                        <option value="brandon">Brandon</option>
                        <option value="st-petersburg">St. Petersburg</option>
                        <option value="carrollwood">Carrollwood</option>
                    </select>
                </div>
                <span class="header-license"><i data-lucide="shield-check"></i> CBC-1268070</span>
            </div>

        </div>
    </div>

    <!-- MAIN NAV BAR -->
    <div class="rwx-nav-bar">
        <div class="nav-bar-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="rwx-logo" aria-label="Restowrx Elite — Home"<?php if (is_front_page()) echo ' aria-current="page"'; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/restowrx-logo.png" alt="Restowrx Elite Logo" width="200" height="32" loading="eager" decoding="async">
            </a>

            <nav class="nav-container" aria-label="Main Navigation">
                <?php
                $rwx_home_class = is_front_page() ? 'current-menu-item' : '';
                $rwx_about_class = is_page('about') ? 'current-menu-item' : '';
                $rwx_services_class = (is_post_type_archive('service') || is_singular('service') || is_page('services') || is_page('service-areas')) ? 'current-menu-item' : '';
                $rwx_blog_class = (is_home() || is_singular('post') || is_category() || is_tag()) ? 'current-menu-item' : '';
                $rwx_contact_class = is_page('contact') ? 'current-menu-item' : '';

                if ( has_nav_menu('header-menu') ) {
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu',
                        'menu_class'     => 'nav-links', 
                        'container'      => false,          
                        'depth'          => 2,              
                    ) );
                } else {
                    echo '<ul class="nav-links">';
                    echo '<li class="' . $rwx_home_class . '"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li class="' . $rwx_about_class . '"><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
                    echo '<li class="' . $rwx_services_class . '"><a href="' . esc_url(home_url('/services/')) . '">Services</a></li>';
                    echo '<li class="' . $rwx_blog_class . '"><a href="' . esc_url(home_url('/blog/')) . '">Reports</a></li>';
                    echo '<li class="' . $rwx_contact_class . '"><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
                    echo '</ul>';
                }
                ?>

                <a href="tel:+18136994009" class="cta-btn-header">
                    <i data-lucide="phone"></i>
                    813.699.4009
                </a>

                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cta-btn-header">
                    <i data-lucide="zap"></i>
                    INITIATE DISPATCH
                </a>

                <button class="menu-toggle" id="mobile-toggle" aria-label="Open mobile navigation" aria-expanded="false" aria-controls="mobile-menu" style="background: none; border: none; color: #0f2440;">
                    <i data-lucide="menu"></i>
                </button>
            </nav>
        </div>
    </div>
</header>

<!-- rw-geolocation-script -->
<script>
(function() {
    const geoMapping = {
        'brandon': { name: 'Brandon' },
        'st-petersburg': { name: 'St. Petersburg' },
        'south-tampa': { name: 'South Tampa' },
        'carrollwood': { name: 'Carrollwood' },
        'tampa': { name: 'Tampa (Main)' }
    };

    // 1. Identify location from URL (always overrides lookup)
    const path = window.location.pathname;
    let urlLocation = null;
    for (const key of Object.keys(geoMapping)) {
        if (key === 'tampa') continue;
        if (path.includes('-' + key)) {
            urlLocation = key;
            break;
        }
    }

    // Initialize DOM variables
    const dropdown = document.getElementById('rwx-location-dropdown');
    const locationDisplay = document.getElementById('rwx-top-bar-location');

    function updateServiceLinks(locationKey) {
        if (!locationKey) return;
        const suffixes = ['-brandon', '-st-petersburg', '-south-tampa', '-carrollwood'];
        const loc = geoMapping[locationKey];
        if (!loc) return;
        
        // Find links matching either the plural /services/ or singular /service/ path
        const links = document.querySelectorAll('a[href*="/services/"], a[href*="/service/"]');
        
        console.log('Restowrx Geo: Scanning links. Found:', links.length, 'for location:', locationKey);
        
        links.forEach(link => {
            let href = link.getAttribute('href');
            if (!href) return;
            
            try {
                let urlObj;
                if (href.startsWith('/') || href.startsWith('.') || !href.includes('://')) {
                    urlObj = new URL(href, window.location.origin);
                } else {
                    urlObj = new URL(href);
                }
                
                let pathVal = urlObj.pathname;
                // Match /services/slug/ or /service/slug/ where slug does not contain a slash
                const serviceMatch = pathVal.match(/\/(services?)\/([^\/]+)\/?$/);
                if (serviceMatch && serviceMatch[2] !== 'services' && serviceMatch[2] !== 'service') {
                    let matchedPostType = serviceMatch[1]; // 'services' or 'service'
                    let slug = serviceMatch[2];
                    let baseSlug = slug;
                    
                    // Strip any existing location suffix from the slug
                    for (const suffix of suffixes) {
                        if (baseSlug.endsWith(suffix)) {
                            baseSlug = baseSlug.slice(0, -suffix.length);
                            break;
                        }
                    }
                    
                    // Re-apply the selected location suffix (unless it's 'tampa')
                    let newSlug = baseSlug;
                    if (locationKey !== 'tampa') {
                        newSlug = baseSlug + '-' + locationKey;
                    }
                    
                    // Maintain base prefix (e.g. subdirectories if any) and normalize to '/services/'
                    const idx = pathVal.indexOf('/' + matchedPostType + '/');
                    const pathPrefix = pathVal.substring(0, idx) + '/services/';
                    urlObj.pathname = pathPrefix + newSlug + '/';
                    
                    let newHref;
                    if (href.startsWith('/') && !href.startsWith('//')) {
                        newHref = urlObj.pathname + urlObj.search + urlObj.hash;
                    } else {
                        newHref = urlObj.toString();
                    }
                    
                    console.log('Restowrx Geo: Rewriting link:', href, '->', newHref);
                    link.setAttribute('href', newHref);

                    // --- Dynamic Visual Title Update inside Service Cards ---
                    if (link.classList.contains('service-card')) {
                        const titleEl = link.querySelector('h3');
                        if (titleEl) {
                            if (!titleEl.dataset.originalHtml) {
                                titleEl.dataset.originalHtml = titleEl.innerHTML;
                            }
                            
                            let originalHtml = titleEl.dataset.originalHtml;
                            if (locationKey === 'tampa') {
                                titleEl.innerHTML = originalHtml;
                            } else {
                                // Append the location name inside bold tags or span tags if present
                                if (originalHtml.includes('</span>')) {
                                    titleEl.innerHTML = originalHtml.replace('</span>', ' ' + loc.name + '</span>');
                                } else if (originalHtml.includes('</b>')) {
                                    titleEl.innerHTML = originalHtml.replace('</b>', ' ' + loc.name + '</b>');
                                } else {
                                    titleEl.innerHTML = originalHtml + ' ' + loc.name;
                                }
                            }
                        }
                    }
                }
            } catch (e) {
                console.error('Restowrx Geo: Error rewriting link:', href, e);
            }
        });

        // --- Dynamic Section Headings & Hero Text Updates ---
        const heroTitle = document.querySelector('.page-hero__title');
        if (heroTitle) {
            if (!heroTitle.dataset.originalHtml) {
                heroTitle.dataset.originalHtml = heroTitle.innerHTML;
            }
            let originalHtml = heroTitle.dataset.originalHtml;
            if (locationKey === 'tampa') {
                heroTitle.innerHTML = originalHtml;
            } else {
                heroTitle.innerHTML = originalHtml + ' in ' + loc.name;
            }
        }

        const heroDesc = document.querySelector('.page-hero__desc');
        if (heroDesc) {
            if (!heroDesc.dataset.originalHtml) {
                heroDesc.dataset.originalHtml = heroDesc.innerHTML;
            }
            let originalHtml = heroDesc.dataset.originalHtml;
            if (locationKey === 'tampa') {
                heroDesc.innerHTML = originalHtml;
            } else {
                // Incorporate the location name into the descriptions
                heroDesc.innerHTML = originalHtml.replace('Precision structural', 'Precision structural ' + loc.name);
            }
        }

        const sectionH2 = document.querySelector('.services-grid-section h2');
        if (sectionH2) {
            if (!sectionH2.dataset.originalHtml) {
                sectionH2.dataset.originalHtml = sectionH2.innerHTML;
            }
            let originalHtml = sectionH2.dataset.originalHtml;
            if (locationKey === 'tampa') {
                sectionH2.innerHTML = originalHtml;
            } else {
                sectionH2.innerHTML = originalHtml + ' IN ' + loc.name.toUpperCase();
            }
        }
    }

    function updateUI(locationKey) {
        if (!geoMapping[locationKey]) return;
        const loc = geoMapping[locationKey];
        
        // Update select value
        if (dropdown) {
            dropdown.value = locationKey;
        }
        
        // Set geo cookie for PHP server-side handling
        document.cookie = "rwx_user_geo=" + encodeURIComponent(locationKey) + "; path=/; max-age=" + (30 * 24 * 60 * 60) + "; SameSite=Lax";
        
        // Update top bar text
        if (locationDisplay) {
            if (locationKey === 'tampa') {
                locationDisplay.innerHTML = '<i data-lucide="map-pin"></i> TAMPA BAY COMMAND';
            } else {
                locationDisplay.innerHTML = `<i data-lucide="map-pin"></i> ${loc.name.toUpperCase()} DISPATCH`;
            }
            // Re-render Lucide icon
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        // Dynamically rewrite service links on load
        updateServiceLinks(locationKey);
    }

    // If we are on a specific location page, cache it and update UI
    if (urlLocation) {
        localStorage.setItem('rwx_user_geo', urlLocation);
        updateUI(urlLocation);
        return; // Don't run background lookup
    }

    // 2. Read from localStorage cache
    let cachedGeo = localStorage.getItem('rwx_user_geo');
    const cacheTime = localStorage.getItem('rwx_user_geo_time');
    const now = new Date().getTime();

    // Cache valid for 30 days
    const isCacheValid = cachedGeo && cacheTime && (now - parseInt(cacheTime) < 30 * 24 * 60 * 60 * 1000);

    if (isCacheValid) {
        updateUI(cachedGeo);
    } else {
        // 3. Silently fetch IP Geolocation in the background (using HTTPS-friendly ipapi.co)
        fetch('https://ipapi.co/json/')
            .then(res => res.json())
            .then(data => {
                let detected = 'tampa'; // default fallback
                const city = (data.city || '').toLowerCase();
                const zip = (data.postal || '').trim();

                // South Tampa ZIP Codes
                const southTampaZips = ['33629', '33611', '33606', '33609', '33616', '33621'];

                if (city.includes('brandon')) {
                    detected = 'brandon';
                } else if (city.includes('petersburg') || city.includes('st. pete') || city.includes('petersburg')) {
                    detected = 'st-petersburg';
                } else if (city.includes('carrollwood')) {
                    detected = 'carrollwood';
                } else if (city.includes('tampa')) {
                    if (southTampaZips.includes(zip)) {
                        detected = 'south-tampa';
                    } else {
                        detected = 'tampa';
                    }
                }

                localStorage.setItem('rwx_user_geo', detected);
                localStorage.setItem('rwx_user_geo_time', now.toString());
                
                updateUI(detected);
            })
            .catch(err => {
                // On error or blocked API, default to tampa
                localStorage.setItem('rwx_user_geo', 'tampa');
                localStorage.setItem('rwx_user_geo_time', now.toString());
                updateUI('tampa');
            });
    }

    // 5. Handle manual dropdown changes with premium transition animation and in-place updating
    if (dropdown) {
        dropdown.addEventListener('change', function() {
            const selected = this.value;
            localStorage.setItem('rwx_user_geo', selected);
            localStorage.setItem('rwx_user_geo_time', new Date().getTime().toString());
            document.cookie = "rwx_user_geo=" + encodeURIComponent(selected) + "; path=/; max-age=" + (30 * 24 * 60 * 60) + "; SameSite=Lax";
            
            let redirectUrl = null; // default to null (means update in place, no redirect needed)
            const origin = window.location.origin;
            const suffixes = ['-brandon', '-st-petersburg', '-south-tampa', '-carrollwood'];
            
            // Check if we are on a single service page
            const serviceMatch = path.match(/\/services\/([^\/]+)\/?$/);
            if (serviceMatch && serviceMatch[1] !== 'services') {
                let currentSlug = serviceMatch[1];
                let baseSlug = currentSlug;
                
                // Strip existing location suffix to get the base service name
                for (const suffix of suffixes) {
                    if (baseSlug.endsWith(suffix)) {
                        baseSlug = baseSlug.slice(0, -suffix.length);
                        break;
                    }
                }
                
                // Determine origin + base path
                const idx = path.indexOf('/services/');
                const pathPrefix = path.substring(0, idx) + '/services/';
                
                // Redirect to the same service page under the new location
                if (selected === 'tampa') {
                    redirectUrl = origin + pathPrefix + baseSlug + '/';
                } else {
                    redirectUrl = origin + pathPrefix + baseSlug + '-' + selected + '/';
                }
            }
            
            // Trigger a premium fade/float out transition before navigating or updating
            const mainContent = document.getElementById('main-content');
            if (mainContent) {
                mainContent.classList.add('rwx-fade-out');
                setTimeout(function() {
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    } else {
                        // In-place update for general pages (like home page, contact page, etc.)
                        updateUI(selected);
                        setTimeout(function() {
                            mainContent.classList.remove('rwx-fade-out');
                        }, 50);
                    }
                }, 300); // matches the CSS transition-out duration
            } else {
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                } else {
                    updateUI(selected);
                }
            }
        });
    }

    // 6. Rewrite links when the DOM is fully parsed
    function initGeoAndLinks() {
        document.querySelectorAll('a').forEach(function(link) {
            var text = link.textContent.trim().toLowerCase();
            var href = link.getAttribute('href');
            if (text === 'services' && (!href || href === '#' || href === '')) {
                link.setAttribute('href', '<?php echo esc_url(home_url("/services/")); ?>');
            }
        });

        const currentGeo = localStorage.getItem('rwx_user_geo') || 'tampa';
        updateServiceLinks(currentGeo);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGeoAndLinks);
    } else {
        initGeoAndLinks();
    }
})();
</script>


<!-- ═══════════════════════════════════════════
     TACTICAL MOBILE MENU DRAWER
     ═══════════════════════════════════════════ -->
<div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Mobile Navigation" aria-hidden="true">
    <div class="mobile-menu__overlay" id="mobile-overlay"></div>
    <div class="mobile-menu__drawer">
        <div class="mobile-menu__header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-menu__logo">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/restowrx-logo.png" alt="Restowrx Elite Logo" width="150" height="24">
            </a>
            <button class="mobile-menu__close" id="mobile-close" aria-label="Close navigation">&times;</button>
        </div>

        <nav class="mobile-menu__nav" aria-label="Mobile menu links">
            <?php
            if ( has_nav_menu('header-menu') ) {
                wp_nav_menu( array(
                    'theme_location' => 'header-menu',
                    'menu_class'     => 'mobile-menu__links', 
                    'container'      => false,          
                    'depth'          => 1,              
                ) );
            } else {
                echo '<ul class="mobile-menu__links">';
                echo '<li class="' . $rwx_home_class . '"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                echo '<li class="' . $rwx_about_class . '"><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
                echo '<li class="' . $rwx_services_class . '"><a href="' . esc_url(home_url('/services/')) . '">Services</a></li>';
                echo '<li class="' . $rwx_blog_class . '"><a href="' . esc_url(home_url('/blog/')) . '">Reports</a></li>';
                echo '<li class="' . $rwx_contact_class . '"><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
                echo '</ul>';
            }
            ?>
        </nav>

        <div class="mobile-menu__footer">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="mobile-menu__cta">
                <i data-lucide="zap" style="vertical-align: middle; margin-right: 4px;"></i> INITIATE DISPATCH
            </a>
            <a href="tel:+18136994009" class="mobile-menu__contact-item">
                <i data-lucide="phone"></i> 813.699.4009
            </a>
            <a href="mailto:joe@restowrx.com" class="mobile-menu__contact-item">
                <i data-lucide="mail"></i> joe@restowrx.com
            </a>
        </div>
    </div>
</div>


