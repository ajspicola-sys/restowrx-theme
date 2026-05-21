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

    <?php
    $theme_ver = filemtime(get_stylesheet_directory() . '/style.css');
    echo '<link rel="preload" href="' . esc_url(get_stylesheet_uri() . '?ver=' . $theme_ver) . '" as="style">' . "\n";
    ?>

    <?php wp_head(); ?>

    <style id="rwx-critical-css">
        html { 
            scroll-behavior: smooth; 
            scroll-padding-top: clamp(80px, 10vw, 110px); 
            -webkit-font-smoothing: antialiased; 
        }
        body { 
            margin: 0; 
            font-family: 'Inter', sans-serif; 
            background: #000000; 
            color: #ffffff;
            overflow-x: hidden; 
        }
        .site-main { 
            padding-top: 95px; /* Height of the header */
        }
        @media (max-width: 1024px) {
            .site-main {
                padding-top: 90px;
            }
        }

        .rwx-header-master {
            --color-red: #ff0000;
            --color-maroon: #120303;
            --color-black: #000000;
            --font-main: 'Inter', sans-serif;
            --font-accent: 'Bebas Neue', sans-serif;
            --font-mono: 'Space Mono', monospace;            width: 100%; position: fixed;
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
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
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
        .social-icon {
            width: 24px; height: 24px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .social-icon svg, .social-icon i { width: 10px; height: 10px; color: #ffffff !important; }
        .social-icon:hover { border-color: var(--color-red); background: var(--color-red); transform: translateY(-1px); }
        .social-icon:hover svg, .social-icon:hover i { color: #ffffff !important; }

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
            display: flex; gap: 25px;
            position: absolute; left: 50%; transform: translateX(-50%);
        }
        .nav-links li { position: relative; padding: 12px 0; }
        .nav-links a {
            color: #111111 !important;
            text-decoration: none;
            font-family: var(--font-main);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.74rem;
            letter-spacing: 1.2px;
            position: relative;
            padding: 6px 0;
            transition: color 0.3s ease;
        }
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--color-red);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-links a:hover, .nav-links li:hover > a, .nav-links li.current-menu-item > a {
            color: var(--color-red) !important;
        }
        .nav-links a:hover::after, .nav-links li:hover > a::after, .nav-links li.current-menu-item > a::after {
            transform: scaleX(1);
            transform-origin: left;
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
            color: #111111 !important;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: none;
            transition: color 0.2s ease;
        }
        .nav-links .sub-menu a::after { display: none; }
        .nav-links .sub-menu a:hover {
            color: var(--color-red) !important;
            background: rgba(0,0,0,0.02);
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

        /* Mobile Menu Toggle button */
        .menu-toggle { 
            display: none; 
            color: #111111; 
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
        .mobile-menu__links a:hover {
            color: var(--color-red);
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

<a class="skip-to-content" href="#main-content" style="position: absolute; top: -100px; left: 0; background: #ff0000; color: white; padding: 10px; z-index: 999999; transition: top 0.2s; font-family: monospace; font-size: 0.8rem; text-decoration: none;" onfocus="this.style.top='0'" onblur="this.style.top='-100px'">Skip to content</a>

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
                <span><i data-lucide="map-pin"></i> TAMPA BAY COMMAND</span>
            </div>
            <div class="top-right">
                <a href="https://www.instagram.com/restowrx/" class="social-icon" aria-label="Instagram" target="_blank" rel="noopener noreferrer"><i data-lucide="instagram"></i></a>
                <a href="https://www.facebook.com/restowrx/" class="social-icon" aria-label="Facebook" target="_blank" rel="noopener noreferrer"><i data-lucide="facebook"></i></a>
            </div>
        </div>
    </div>

    <!-- MAIN NAV BAR -->
    <div class="rwx-nav-bar">
        <div class="nav-bar-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="rwx-logo" aria-label="Restowrx Elite — Home"<?php if (is_front_page()) echo ' aria-current="page"'; ?>>
                <img src="https://restowrx.com/wp-content/uploads/2025/04/GetAttachmentThumbnail.png" alt="Restowrx Elite Logo" width="200" height="32" loading="eager" decoding="async">
            </a>

            <nav class="nav-container" aria-label="Main Navigation">
                <?php
                if ( has_nav_menu('header-menu') ) {
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu',
                        'menu_class'     => 'nav-links', 
                        'container'      => false,          
                        'depth'          => 2,              
                    ) );
                } else {
                    echo '<ul class="nav-links">';
                    echo '<li class="current-menu-item"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/services/')) . '">Services</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/blog/')) . '">Reports</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
                    echo '</ul>';
                }
                ?>

                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cta-btn-header">
                    <i data-lucide="zap"></i>
                    INITIATE DISPATCH
                </a>

                <button class="menu-toggle" id="mobile-toggle" aria-label="Open mobile navigation" aria-expanded="false" aria-controls="mobile-menu" style="background: none; border: none; color: #111111;">
                    <i data-lucide="menu"></i>
                </button>
            </nav>
        </div>
    </div>
</header>

<!-- ═══════════════════════════════════════════
     TACTICAL MOBILE MENU DRAWER
     ═══════════════════════════════════════════ -->
<div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Mobile Navigation" aria-hidden="true">
    <div class="mobile-menu__overlay" id="mobile-overlay"></div>
    <div class="mobile-menu__drawer">
        <div class="mobile-menu__header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-menu__logo">
                <img src="https://restowrx.com/wp-content/uploads/2025/04/GetAttachmentThumbnail.png" alt="Restowrx Elite Logo" width="150" height="24">
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
                echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                echo '<li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
                echo '<li><a href="' . esc_url(home_url('/services/')) . '">Services</a></li>';
                echo '<li><a href="' . esc_url(home_url('/blog/')) . '">Reports</a></li>';
                echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
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

<main id="main-content" class="site-main" role="main">
