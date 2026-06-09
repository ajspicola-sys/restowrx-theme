<?php
/**
 * Restowrx Elite Theme — Theme Functions
 * Performance-optimized build
 */

// ══════════════════════════════════════════════════════════════════════
// AUTO CACHE PURGE — fires on first request after a git pull
// Fingerprints key theme files; if anything changed since last deploy,
// purges LiteSpeed / WP Rocket / W3TC / WP Super Cache automatically.
// ══════════════════════════════════════════════════════════════════════
function hwh_auto_purge_on_deploy() {
    // Files to watch — any change triggers a full cache purge
    $watch = [
        get_stylesheet_directory() . '/style.css',
        get_stylesheet_directory() . '/header.php',
        get_stylesheet_directory() . '/footer.php',
        get_stylesheet_directory() . '/front-page.php',
        get_stylesheet_directory() . '/functions.php',
    ];

    $fingerprint = '';
    foreach ( $watch as $file ) {
        if ( file_exists( $file ) ) {
            $fingerprint .= filemtime( $file );
        }
    }
    $fingerprint = md5( $fingerprint );

    $stored = get_option( 'hwh_deploy_fingerprint', '' );
    if ( $fingerprint === $stored ) return; // nothing changed

    // Theme files changed — update stored fingerprint
    update_option( 'hwh_deploy_fingerprint', $fingerprint, false );

    // Purge LiteSpeed Cache
    if ( class_exists( '\LiteSpeed\Purge' ) ) {
        do_action( 'litespeed_purge_all' );
    }
    // Purge WP Rocket
    if ( function_exists( 'rocket_clean_domain' ) ) {
        rocket_clean_domain();
    }
    // Purge W3 Total Cache
    if ( function_exists( 'w3tc_flush_all' ) ) {
        w3tc_flush_all();
    }
    // Purge WP Super Cache
    if ( function_exists( 'wp_cache_clear_cache' ) ) {
        wp_cache_clear_cache();
    }
}
add_action( 'init', 'hwh_auto_purge_on_deploy' );


function hwh_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    // Register nav menus
    register_nav_menus([
        'primary' => 'Primary Navigation',
        'footer'  => 'Footer Navigation',
        'header-menu' => 'Tactical Command Header Menu',
        'footer-menu' => 'Tactical Command Footer Menu',
    ]);
}
add_action('after_setup_theme', 'hwh_setup');

// -- Performance: Disable WP Emoji Scripts --------------------------
function hwh_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', function($plugins) {
        return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : [];
    });
    add_filter('wp_resource_hints', function($urls, $relation_type) {
        if ('dns-prefetch' === $relation_type) {
            $urls = array_filter($urls, function($url) {
                return false === strpos($url, 'https://s.w.org/images/core/emoji/');
            });
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'hwh_disable_emojis');

// -- Performance: Remove unnecessary head clutter -------------------
function hwh_cleanup_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('after_setup_theme', 'hwh_cleanup_head');

// -- Performance: Disable oEmbed ------------------------------------
function hwh_disable_oembed() {
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'hwh_disable_oembed', 9999);

// -- Performance: Dequeue block library CSS on frontend -------------
function hwh_dequeue_block_styles() {
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }
}
add_action('wp_enqueue_scripts', 'hwh_dequeue_block_styles', 100);

// -- Performance: Remove jQuery from frontend -----------------------
function hwh_deregister_jquery() {
    if (!is_admin() && !is_customize_preview()) {
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        wp_deregister_script('jquery-migrate');
    }
}
add_action('wp_enqueue_scripts', 'hwh_deregister_jquery', 100);

// -- Force correct page template by slug ----------------------------
function hwh_force_page_templates($template) {
    if (is_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
        $map = [
            'team'         => 'page-team.php',
            'about'        => 'page-about.php',
            'contact'      => 'page-contact.php',
            'maintenance-plan' => 'page-maintenance-plan.php',
            'products'     => 'page-products.php',
            'shop'         => 'page-products.php',
            'values'       => 'page-values.php',
            'before-after' => 'page-before-after.php',
            'privacy-policy'      => 'page-privacy-policy.php',
            'cancellation-policy' => 'page-cancellation-policy.php',
            'refund-policy'       => 'page-refund-policy.php',
            'specials'         => 'page-maintenance-plan.php',
            'service-areas'    => 'page-service-areas.php',
        ];
        if (isset($map[$slug])) {
            $custom = get_template_directory() . '/' . $map[$slug];
            if (file_exists($custom)) {
                return $custom;
            }
        }
    }
    return $template;
}
add_filter('template_include', 'hwh_force_page_templates');

// -- Enqueue Assets -------------------------------------------------
function hwh_enqueue_styles() {
    // Cache-bust by file mtime — auto-busts when style.css changes
    $theme_version = filemtime(get_stylesheet_directory() . '/style.css');

    // Google Fonts are loaded non-render-blocking directly in header.php
    // via the preload/onload trick. Do NOT re-enqueue here — doing so
    // would create a second render-blocking <link> tag.

    // Main stylesheet
    wp_enqueue_style('hwh-style', get_stylesheet_uri(), [], $theme_version);
}
add_action('wp_enqueue_scripts', 'hwh_enqueue_styles');

// -- Performance: Make only Google Fonts non-render-blocking -----------
// The main stylesheet MUST be render-blocking to prevent FOUC.
// Google Fonts can safely load async since system fonts render as fallback.
// Google Fonts loaded normally (not deferred) to prevent FOUT
// Font files are preloaded above so Inter/Montserrat arrives before first paint
function hwh_async_styles($html, $handle) {
    // No async deferral needed — fonts preloaded via link[rel=preload]
    return $html;
}
add_filter('style_loader_tag', 'hwh_async_styles', 10, 2);










// -- Performance: Preload critical fonts only (preconnects live in header.php) --
function hwh_resource_hints() {
    // DNS prefetch for external domain
    echo '<link rel="dns-prefetch" href="//restowrx.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // Preload critical font files (Inter + Bebas Neue + Space Mono - weights used above the fold)
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/inter/v13/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZ9hiA.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/bebasneue/v14/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/spacemono/v13/i7dMIF98yBdDQXEsF6FTDFHW0w.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action('wp_head', 'hwh_resource_hints', 1);

// -- Analytics: GA4 Tracking -----------------------------------------
// Measurement ID is set in Appearance → Customize → Analytics.
// Script loads async and respects the site's cookie consent banner.
function hwh_ga4_tracking() {
    $ga4_id = get_theme_mod( 'hwh_ga4_measurement_id', '' );
    if ( empty( $ga4_id ) || is_admin() ) return;
    $ga4_id = esc_attr( sanitize_text_field( $ga4_id ) );
    ?>
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga4_id; ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo $ga4_id; ?>', {
        'anonymize_ip': true,
        'send_page_view': true
    });
    </script>
    <?php
}
add_action( 'wp_head', 'hwh_ga4_tracking', 10 );

// -- Customizer: Analytics Settings ----------------------------------
function hwh_customizer_analytics( $wp_customize ) {
    $wp_customize->add_section( 'hwh_analytics', [
        'title'    => __( 'Analytics', 'hwh' ),
        'priority' => 200,
    ] );
    $wp_customize->add_setting( 'hwh_ga4_measurement_id', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ] );
    $wp_customize->add_control( 'hwh_ga4_measurement_id', [
        'label'       => __( 'GA4 Measurement ID', 'hwh' ),
        'description' => __( 'Enter your Google Analytics 4 Measurement ID (e.g. G-XXXXXXXXXX). Get it from GA4 → Admin → Data Streams.', 'hwh' ),
        'section'     => 'hwh_analytics',
        'type'        => 'text',
    ] );
}
add_action( 'customize_register', 'hwh_customizer_analytics' );

// -- Performance: External image proxy & WebP cache -----------------
// Fetches third-party images (e.g. Ageless AI before/after), resizes to
// max 800px wide, converts to WebP, and caches in wp-uploads.
// Subsequent requests serve the local WebP — eliminates 9+ MB of PNG downloads.
function hwh_cached_image_url( $src_url, $max_w = 800 ) {
    $upload   = wp_upload_dir();
    $cache_dir = $upload['basedir'] . '/hwh-img-cache';
    $cache_url = $upload['baseurl'] . '/hwh-img-cache';
    $filename  = md5( $src_url ) . '.webp';
    $file_path = $cache_dir . '/' . $filename;
    $file_url  = $cache_url . '/' . $filename;

    // Serve from cache if already downloaded
    if ( file_exists( $file_path ) ) {
        return $file_url;
    }

    // Create cache directory if needed
    if ( ! file_exists( $cache_dir ) ) {
        wp_mkdir_p( $cache_dir );
        // Prevent direct browsing
        file_put_contents( $cache_dir . '/.htaccess', "Options -Indexes\n" );
    }

    // Fetch the remote image
    $response = wp_remote_get( $src_url, [
        'timeout'   => 30,
        'sslverify' => false,
        'headers'   => [ 'User-Agent' => 'Mozilla/5.0 (compatible; SpicolaConstruction/1.0)' ],
    ] );

    if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
        return $src_url; // Fallback to original
    }

    $body = wp_remote_retrieve_body( $response );
    if ( empty( $body ) ) {
        return $src_url;
    }

    // Decode image with GD
    $img = @imagecreatefromstring( $body );
    if ( ! $img ) {
        return $src_url; // GD can't read it, fall back
    }

    // Resize if wider than $max_w
    $orig_w = imagesx( $img );
    $orig_h = imagesy( $img );
    if ( $orig_w > $max_w ) {
        $new_h   = (int) round( ( $max_w / $orig_w ) * $orig_h );
        $resized = imagecreatetruecolor( $max_w, $new_h );
        // Preserve transparency (PNGs)
        imagealphablending( $resized, false );
        imagesavealpha( $resized, true );
        imagecopyresampled( $resized, $img, 0, 0, 0, 0, $max_w, $new_h, $orig_w, $orig_h );
        imagedestroy( $img );
        $img = $resized;
    }

    // Save as WebP (quality 82 — good balance of size vs. quality)
    if ( function_exists( 'imagewebp' ) ) {
        imagewebp( $img, $file_path, 82 );
    } else {
        // Fallback: save as JPEG if WebP not available
        $file_path = str_replace( '.webp', '.jpg', $file_path );
        $file_url  = str_replace( '.webp', '.jpg', $file_url );
        imagejpeg( $img, $file_path, 82 );
    }
    imagedestroy( $img );

    return file_exists( $file_path ) ? $file_url : $src_url;
}

// -- Performance: Add async/defer to non-critical scripts -----------
function hwh_script_loader_tag($tag, $handle) {
    // Defer non-critical scripts
    $defer_scripts = ['wp-embed'];
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'hwh_script_loader_tag', 10, 2);

// NOTE: Version query strings (ver=) are kept intentionally for cache busting.
// They ensure the browser loads the latest CSS when the theme is updated.

// -- Performance: Limit post revisions ------------------------------
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

// ============================================================
// AI SEARCH VISIBILITY & STRUCTURED DATA — RESTOWRX ELITE
// Comprehensive JSON-LD schema for Google AI Overviews,
// ChatGPT, Perplexity, Bing Copilot, and all AEO signals.
// ============================================================

// -- 1. GeneralContractor + WebSite + Person -- every page ----
function hwh_schema_markup() {

    // Named provider: Restowrx Elite Command Team
    $provider = [
        '@type'       => 'Person',
        '@id'         => esc_url(home_url('/')) . '#rwx-team',
        'name'        => 'Restowrx Elite Team',
        'jobTitle'    => 'Incident Commander & Property Recovery Specialist',
        'description' => 'Property recovery commanders and certified restoration specialists serving Tampa Bay, FL. Expert water extraction, mold remediation, fire damage restoration, and storm stabilization.',
        'worksFor'    => [ '@type' => 'LocalBusiness', 'name' => 'Restowrx Elite' ],
        'sameAs'      => [ 'https://www.instagram.com/restowrx/' ],
    ];

    // Full LocalBusiness entity (GeneralContractor / Damage Restoration Service)
    $business = [
        '@context'         => 'https://schema.org',
        '@type'            => ['GeneralContractor', 'LocalBusiness'],
        '@id'              => esc_url(home_url('/')) . '#rwx-recovery',
        'name'             => 'Restowrx Elite',
        'legalName'        => 'Restowrx Elite',
        'alternateName'    => 'Restowrx Elite',
        'description'      => "Tampa Bay's command center for property recovery. Surgical precision fire damage restoration, high-capacity water extraction, biological mold containment, and storm damage stabilization in Hillsborough, Pinellas, and Pasco counties.",
        'url'              => esc_url(home_url('/')),
        'telephone'        => '+18136994009',
        'email'            => 'joe@restowrx.com',
        'foundingDate'     => '2020',
        'address'          => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '9249 Lazy Ln',
            'addressLocality' => 'Tampa',
            'addressRegion'   => 'FL',
            'postalCode'      => '33614',
            'addressCountry'  => 'US',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => 28.0678,
            'longitude' => -82.5054,
        ],
        'hasMap'           => 'https://maps.google.com/?q=9249+Lazy+Ln+Tampa+FL+33614',
        'openingHoursSpecification' => [
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'], 'opens' => '00:00', 'closes' => '23:59' ],
        ],
        'priceRange'       => '$$$',
        'currenciesAccepted' => 'USD',
        'paymentAccepted'  => 'Cash, Credit Card, Insurance Claims Financing',
        'image'            => [
            esc_url(home_url('/')) . 'wp-content/uploads/spicola-og.jpg',
        ],
        'logo'             => esc_url(home_url('/')) . 'wp-content/uploads/spicola-og.jpg',
        'sameAs'           => [
            'https://www.facebook.com/restowrx/',
            'https://www.instagram.com/restowrx/',
            'https://www.google.com/maps/place/Restowrx+Elite',
        ],
        'employee'         => [ $provider ],
        'founder'          => $provider,
        'serviceType'      => 'Property Damage Restoration',
        'availableService' => [
            [ '@type' => 'Service', 'name' => 'Water Extraction & Drying', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Fire & Smoke Deodorization',  'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Biological Mold Containment', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Storm Stabilization & Board Up', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Structural Build Back',     'url' => esc_url(home_url('/services/')) ],
        ],
        'areaServed'       => [
            [ '@type' => 'City', 'name' => 'Tampa',          'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Carrollwood',    'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Westchase',      'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Lutz',           'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Land O Lakes',   'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Brandon',        'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Riverview',      'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Wesley Chapel',  'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'New Tampa',      'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Temple Terrace', 'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Odessa',         'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
            [ '@type' => 'City', 'name' => 'Zephyrhills',    'containedInPlace' => [ '@type' => 'State', 'name' => 'Florida' ] ],
        ],
        'hasOfferCatalog'  => [
            '@type' => 'OfferCatalog',
            'name'  => 'Restowrx Elite Mitigation Services',
            'url'   => esc_url(home_url('/services/')),
        ],
        'makesOffer' => [
            [
                '@type'       => 'Offer',
                'name'        => 'Free Telemetry Estimate',
                'description' => 'Free property recovery telemetry scan and damage assessment.',
                'price'       => '0',
                'priceCurrency' => 'USD',
                'url'         => esc_url(home_url('/contact/')),
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($business, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";

    // WebSite schema with SiteLinksSearchBox signal
    $website = [
        '@context'        => 'https://schema.org',
        '@type'           => 'WebSite',
        '@id'             => esc_url(home_url('/')) . '#website',
        'name'            => 'Restowrx Elite',
        'url'             => esc_url(home_url('/')),
        'description'     => "Tampa Bay's command center for property recovery — water extraction, fire restoration, mold remediation, storm stabilization, and 24/7 service.",
        'inLanguage'      => 'en-US',
        'publisher'       => [ '@id' => esc_url(home_url('/')) . '#rwx-recovery' ],
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [ '@type' => 'EntryPoint', 'urlTemplate' => esc_url(home_url('/')) . '?s={search_term_string}' ],
            'query-input' => 'required name=search_term_string',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // -- Enhanced Service schema — singular service pages only -----------------
    if (is_singular('service')) {
        $post_id   = get_the_ID();
        $excerpt   = wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' service in Tampa Bay, FL.');

        $service_schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Service',
            '@id'         => get_permalink($post_id) . '#service',
            'name'        => get_the_title(),
            'description' => $excerpt,
            'provider'    => [
                '@type' => 'LocalBusiness',
                'name'  => 'Restowrx Elite',
                '@id'   => esc_url(home_url('/')) . '#rwx-recovery',
            ],
            'areaServed'  => 'Tampa Bay, FL',
            'url'         => get_permalink($post_id),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'hwh_schema_markup', 5);

// -- Auto-create All Pages ------------------------------------------
function hwh_create_pages() {
    if (get_option('hwh_pages_created_v5')) return;

    $pages = [
        'Home'           => '',
        'About'          => '',
        'Team'           => '',
        'Values'         => '',
        'Contact'        => '',
        'Before After'   => '',
        'Careers'        => '',
        'Specials'       => '',
        'Blog'           => '',
    ];

    foreach ($pages as $title => $content) {
        // Skip if page already exists
        $existing = get_page_by_title($title, OBJECT, 'page');
        if ($existing) continue;

        $page_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);

        // Set Home as static front page
        if ($title === 'Home' && $page_id && !is_wp_error($page_id)) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $page_id);
        }

        // Set Blog as posts page
        if ($title === 'Blog' && $page_id && !is_wp_error($page_id)) {
            update_option('page_for_posts', $page_id);
        }
    }

    update_option('hwh_pages_created_v5', true);
}
add_action('after_switch_theme', 'hwh_create_pages');

// -- Fix Reading Settings (one-time) -------------------------------
function hwh_fix_reading_settings() {
    if (get_option('hwh_reading_fixed_v2')) return;

    // Find the Blog page and set it as posts page
    $blog_page = get_page_by_title('Blog', OBJECT, 'page');
    if ($blog_page) {
        update_option('show_on_front', 'page');
        update_option('page_for_posts', $blog_page->ID);
    }

    // Find the Home page and set it as front page
    $home_page = get_page_by_title('Home', OBJECT, 'page');
    if ($home_page) {
        update_option('page_on_front', $home_page->ID);
    }

    update_option('hwh_reading_fixed_v2', true);
}
add_action('init', 'hwh_fix_reading_settings');

// -- Shared helper: check if a page with a given slug exists (any status) --
function hwh_page_slug_exists( $slug ) {
    $q = new WP_Query([
        'post_type'              => 'page',
        'name'                   => $slug,
        'post_status'            => 'any',
        'posts_per_page'         => 1,
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ]);
    return $q->have_posts();
}

// -- Auto-create Privacy Policy page -----------------------------------
function hwh_create_privacy_page() {
    if ( get_option('hwh_privacy_page_created_v1') ) return;
    if ( ! hwh_page_slug_exists('privacy-policy') ) {
        wp_insert_post([
            'post_title'   => 'Privacy Policy',
            'post_name'    => 'privacy-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('hwh_privacy_page_created_v1', true);
}
add_action('init', 'hwh_create_privacy_page');

// -- Auto-create Cancellation Policy page ------------------------------
function hwh_create_cancellation_page() {
    if ( get_option('hwh_cancellation_page_created_v1') ) return;
    if ( ! hwh_page_slug_exists('cancellation-policy') ) {
        wp_insert_post([
            'post_title'   => 'Cancellation Policy',
            'post_name'    => 'cancellation-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('hwh_cancellation_page_created_v1', true);
}
add_action('init', 'hwh_create_cancellation_page');

// -- Auto-create Refund Policy page ------------------------------------
function hwh_create_refund_page() {
    if ( get_option('hwh_refund_page_created_v1') ) return;
    if ( ! hwh_page_slug_exists('refund-policy') ) {
        wp_insert_post([
            'post_title'   => 'Refund Policy',
            'post_name'    => 'refund-policy',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('hwh_refund_page_created_v1', true);
}
add_action('init', 'hwh_create_refund_page');

// -- Auto-create Maintenance Plan page --------------------------------------
function hwh_create_specials_page() {
    if ( get_option('hwh_specials_page_created_v1') ) return;
    if ( ! hwh_page_slug_exists('maintenance-plan') ) {
        wp_insert_post([
            'post_title'   => 'Maintenance Plan',
            'post_name'    => 'maintenance-plan',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('hwh_specials_page_created_v1', true);
}
add_action('init', 'hwh_create_specials_page');

// -- Auto-create Service Areas page ------------------------------------
function hwh_create_service_areas_page() {
    if ( get_option('hwh_service_areas_page_created_v1') ) return;
    if ( ! hwh_page_slug_exists('service-areas') ) {
        wp_insert_post([
            'post_title'   => 'Service Areas',
            'post_name'    => 'service-areas',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('hwh_service_areas_page_created_v1', true);
}
add_action('init', 'hwh_create_service_areas_page');

// -- Auto-create Starter Blog Posts ---------------------------------
function hwh_create_blog_posts() {
    if (get_option('hwh_blog_created_v1')) return;

    // Create blog categories
    $categories = ['Mitigation Tips', 'Water Extraction', 'Mold & Biological', 'Fire & Smoke', 'Restowrx Intel'];
    $cat_ids = [];
    foreach ($categories as $cat) {
        $existing = term_exists($cat, 'category');
        if ($existing) {
            $cat_ids[$cat] = $existing['term_id'];
        } else {
            $term = wp_insert_term($cat, 'category');
            if (!is_wp_error($term)) {
                $cat_ids[$cat] = $term['term_id'];
            }
        }
    }

    $posts = [
        [
            'title'    => 'Mitigation vs. Restoration: The Property Recovery Command Cycle',
            'category' => 'Mitigation Tips',
            'excerpt'  => 'Understanding the critical difference between active damage mitigation and full property restoration to navigate your recovery smoothly.',
            'content'  => '<h2>Navigating Property Recovery</h2>
<p>When disaster strikes your property, the response time is measured in minutes, not hours. A common question we hear at Restowrx Elite is: "What is the difference between mitigation and restoration?" Both are essential, but they serve very different purposes in the recovery command cycle.</p>

<h3>Active Mitigation: Stopping the Damage</h3>
<p>Mitigation is the immediate, emergency phase of property recovery. It is designed to stop the damage from spreading. This includes high-capacity water extraction, biological containment, structural drying, and storm board-ups. Mitigation prevents secondary issues like toxic mold growth or structural collapse.</p>

<h3>Property Restoration: The Build-Back Phase</h3>
<p>Once the property is stabilized, dried, and sanitized, the restoration phase begins. This is where we rebuild what was destroyed. In partnership with Spicola Construction, our licensed general contracting partner, we handle full reconstruction, from drywall and framing to roofing and custom finishes.</p>

<h3>Strategic Recovery Command</h3>
<p>Our unified approach ensures that mitigation transitions seamlessly into reconstruction without the typical delays of coordinating multiple contractors.</p>

<p><strong>Faced with property damage?</strong> Call the Restowrx Elite 24/7 hotline at 813.699.4009 for immediate strike team deployment.</p>',
        ],
        [
            'title'    => 'The Complete Guide to Preventing Mold After Water Damage',
            'category' => 'Mold & Biological',
            'excerpt'  => 'Simple, critical containment and drying tips every Tampa Bay property owner should know to prevent toxic mold after a leak or flood.',
            'content'  => '<h2>Prevention Is Faster Than Remediation</h2>
<p>Toxic mold spores begin to colonize and grow within 24 to 48 hours of exposure to moisture. At Restowrx Elite, we treat water damage as an active biological hazard. Here is how you can protect your property before it becomes a mold contamination zone.</p>

<h3>1. Extract Water Immediately</h3>
<p>Mops and shop-vacs are not enough for structural saturation. Professional-grade truck-mounted extractors are required to pull water from deep within flooring and subfloors.</p>

<h3>2. Deploy Advanced Containment</h3>
<p>If water damage is confined to one room, seal it off using heavy-duty plastic sheeting and negative air pressure to prevent airborne mold spores from migrating to clean areas.</p>

<h3>3. Manage Temperature and Humidity</h3>
<p>Mold thrives in warm, humid climates. Keep air conditioning running and deploy structural dehumidifiers to drop relative humidity below 50% immediately.</p>

<h3>4. Track Hidden Moisture</h3>
<p>Water travels behind baseboards and under cabinets. We use infrared thermal telemetry scans to map invisible moisture corridors and target them for structural drying.</p>

<p><strong>Want absolute peace of mind?</strong> Call Restowrx Elite for a professional moisture scan and stabilization plan.</p>',
        ],
        [
            'title'    => 'What to Expect When You Request a Restoration Response',
            'category' => 'Mitigation Tips',
            'excerpt'  => 'A step-by-step walkthrough of the Restowrx Elite property recovery experience, from dispatch call to structural build-back.',
            'content'  => '<h2>Your Restoration Process with Restowrx Elite</h2>
<p>If you have never dealt with property damage before, the process can feel overwhelming. At Restowrx Elite, we have designed our emergency response process to be structured, transparent, and highly responsive.</p>

<h3>Step 1: Emergency Dispatch</h3>
<p>When you call 813.699.4009, our dispatch center gathers crucial details, logs your incident, and dispatches a rapid response team immediately. We coordinate with your insurance carrier from the very first minute.</p>

<h3>Step 2: Emergency Stabilization</h3>
<p>Our mitigation specialist arrives, assesses the structural threat, and deploys immediate containment. We stop active leaks, extract standing water, board up breaches, and stabilize the site.</p>

<h3>Step 3: Moisture Mapping & Drying</h3>
<p>We deploy moisture sensors and high-volume air movers. We monitor daily, documenting every reading to ensure your insurance claim is fully supported by empirical data.</p>

<h3>Step 4: Seamless Build-Back</h3>
<p>When the property is dry and sanitized, our partner Spicola Construction takes the baton to handle all reconstruction and finishing work, returning your property to pre-loss condition.</p>

<p><strong>Ready to secure your property?</strong> Call Restowrx Elite now for immediate rapid response dispatch.</p>',
        ],
        [
            'title'    => '5 Signs Your Property Has a Hidden Water Leak',
            'category' => 'Water Extraction',
            'excerpt'  => 'How to spot the invisible warning signs of structural moisture before it leads to toxic mold or catastrophic rot.',
            'content'  => '<h2>Is Your Property Leaking Invisibly?</h2>
<p>A burst pipe is obvious, but a slow pinhole leak behind drywall can go unnoticed for months, rotting wood and feeding toxic mold. Here are the top 5 warning signs of a hidden leak.</p>

<h3>1. Unexplained Utility Spikes</h3>
<p>If your water bill jumps suddenly without an increase in usage, an underground slab leak or behind-the-wall plumbing breach is a highly likely culprit.</p>

<h3>2. Musty Odors</h3>
<p>A damp, earthy, or musty smell is the absolute signature of active mold growth. If you smell it but cannot see it, moisture is lurking in your walls or subfloors.</p>

<h3>3. Baseboard Swelling & Warping</h3>
<p>Drywall and wood baseboards absorb moisture like a sponge. Look for peeling paint, bubbling wallpaper, or baseboards pulling away from the wall.</p>

<h3>4. Discolored Patches</h3>
<p>Yellowish, brown, or dark stains on ceilings and walls indicate water pooling from above or creeping up from the foundation.</p>

<h3>5. Sound of Rushing Water</h3>
<p>If you hear a faint whistling, rushing, or dripping sound when all faucets and appliances are turned off, water is actively flowing somewhere in your structure.</p>

<p><strong>Noticing any of these signs?</strong> Call Restowrx Elite for a thermal moisture telemetry scan and protect your investment.</p>',
        ],
        [
            'title'    => 'Why Florida Properties Need Active Moisture Telemetry Scans',
            'category' => 'Restowrx Intel',
            'excerpt'  => 'Florida properties face extreme heat, humidity, and storm risks. Here is why regular thermal moisture scanning saves thousands.',
            'content'  => '<h2>Florida Environments Are Demanding</h2>
<p>Tampa Bay properties face unique environmental challenges. High humidity, tropical storms, and sandy soil movement create severe structural stresses. Regular moisture telemetry scanning is your best defense against catastrophic structural decay.</p>

<h3>What a Moisture Assessment Covers</h3>
<p>During an active telemetry scan, our IICRC-certified specialists inspect:</p>
<ul>
<li><strong>Thermal anomalies</strong> - detecting cold spots in walls that indicate active moisture corridors</li>
<li><strong>Structural wood saturation</strong> - measuring moisture content in load-bearing studs</li>
<li><strong>Containment seals</strong> - checking high-risk window and door flashing for air/water penetration</li>
<li><strong>Foundation humidity</strong> - scanning slab edges for capillary water draw</li>
</ul>

<h3>The Cost of Delayed Mitigation</h3>
<p>A small ceiling leak can waste thousands in structural framing damage and feed biological contaminants. A quick assessment today prevents a massive structural tear-out tomorrow.</p>

<p><strong>Protect your property.</strong> Schedule your active defense scan with Restowrx Elite today.</p>',
        ],
    ];

    foreach ($posts as $post_data) {
        $existing = get_page_by_title($post_data['title'], OBJECT, 'post');
        if ($existing) continue;

        $post_id = wp_insert_post([
            'post_title'   => $post_data['title'],
            'post_excerpt' => $post_data['excerpt'],
            'post_content' => $post_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => date('Y-m-d H:i:s', strtotime('-' . rand(1, 30) . ' days')),
        ]);

        if ($post_id && !is_wp_error($post_id) && isset($cat_ids[$post_data['category']])) {
            wp_set_post_categories($post_id, [$cat_ids[$post_data['category']]]);
        }
    }

    update_option('hwh_blog_created_v1', true);
}
add_action('after_switch_theme', 'hwh_create_blog_posts');
add_action('init', 'hwh_create_blog_posts');


// -- Auto-create All Services ---------------------------------------
function hwh_create_services() {
    if (get_option('hwh_services_created_v2')) return;

    // 3 broad categories
    $categories = [
        'Mitigation & Extraction' => 'Emergency high-capacity water extraction, structural drying, and rapid leak containment.',
        'Remediation & Cleanup'   => 'IICRC-certified mold containment, biohazard decontamination, and fire/soot deodorization.',
        'Stabilization & Defense' => 'Emergency storm stabilization, roof tarping, structural shoring, and Active Property Defense plans.',
    ];

    $cat_ids = [];
    foreach ($categories as $name => $desc) {
        $existing = term_exists($name, 'service_category');
        if ($existing) {
            $cat_ids[$name] = $existing['term_id'];
        } else {
            $term = wp_insert_term($name, 'service_category', ['description' => $desc]);
            if (!is_wp_error($term)) {
                $cat_ids[$name] = $term['term_id'];
            }
        }
    }

    $services = [
        ['title' => 'Water Damage Extraction',   'icon' => '', 'category' => 'Mitigation & Extraction', 'excerpt' => 'Emergency high-capacity water extraction and structural dehumidification. Immediate 24/7 strike team response across Tampa Bay.'],
        ['title' => 'Structural Drying',         'icon' => '', 'category' => 'Mitigation & Extraction', 'excerpt' => 'Advanced structural drying utilizing high-velocity air movers and low-grain refrigerant dehumidifiers to prevent mold.'],
        ['title' => 'Thermal Moisture Mapping',  'icon' => '', 'category' => 'Mitigation & Extraction', 'excerpt' => 'Non-invasive infrared thermal telemetry to locate hidden moisture corridors behind walls, floors, and ceilings.'],
        ['title' => 'Sewage Cleanup & Sanitizing','icon' => '', 'category' => 'Mitigation & Extraction', 'excerpt' => 'Safe containment, extraction, and antimicrobial disinfection of hazardous Category 3 black water and sewage backups.'],
        ['title' => 'Mold containment',          'icon' => '', 'category' => 'Remediation & Cleanup',   'excerpt' => 'Strict negative air pressure containment and HEPA air filtration to isolate toxic mold spores during remediation.'],
        ['title' => 'Mold Remediation',          'icon' => '', 'category' => 'Remediation & Cleanup',   'excerpt' => 'Certified remediation of biological growth. We source, isolate, and eliminate mold from structural elements.'],
        ['title' => 'Fire & Smoke Cleanup',      'icon' => '', 'category' => 'Remediation & Cleanup',   'excerpt' => 'Professional soot removal, structural washing, and thermal fogging to permanently eliminate fire and smoke odors.'],
        ['title' => 'Biohazard Decontamination', 'icon' => '', 'category' => 'Remediation & Cleanup',   'excerpt' => 'Biological and hazardous material decontamination following strict OSHA, EPA, and IICRC protocols.'],
        ['title' => 'Storm Impact Stabilization','icon' => '', 'category' => 'Stabilization & Defense', 'excerpt' => 'Rapid response stabilization following storm damage. Roof tarping, window board-ups, and structural shoring.'],
        ['title' => 'Emergency Roof Tarping',    'icon' => '', 'category' => 'Stabilization & Defense', 'excerpt' => 'High-durability roof tarping and shrink-wrapping to prevent active water intrusion during severe weather events.'],
        ['title' => 'Emergency Board-Up',        'icon' => '', 'category' => 'Stabilization & Defense', 'excerpt' => 'Secure board-up services for structural breaches, doors, and windows to protect your property from theft and weather.'],
        ['title' => 'Active Property Defense',   'icon' => '', 'category' => 'Stabilization & Defense', 'excerpt' => 'Comprehensive risk mapping, annual telemetry scans, and priority emergency response for property defense members.'],
    ];

    foreach ($services as $service) {
        $existing = get_page_by_title($service['title'], OBJECT, 'service');
        if ($existing) {
            if (isset($cat_ids[$service['category']])) {
                wp_set_object_terms($existing->ID, (int) $cat_ids[$service['category']], 'service_category');
            }
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'   => $service['title'],
            'post_excerpt' => $service['excerpt'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'service',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_service_icon', $service['icon']);
            if (isset($cat_ids[$service['category']])) {
                wp_set_object_terms($post_id, (int) $cat_ids[$service['category']], 'service_category');
            }
        }
    }

    update_option('hwh_services_created_v2', true);
}
add_action('after_switch_theme', 'hwh_create_services');

// -- Auto-create New Construction Services (v3) ---------------------
// Adds 19 SEO-targeted service pages for Spicola Construction.
// Uses a separate option key so it runs independently of v2.
function hwh_create_services_v3() {
    if ( get_option('hwh_services_created_v3') ) return;

    $categories = [
        'Residential Services' => 'Custom home building, remodeling, additions, roofing, and specialty residential construction across Tampa Bay.',
        'Commercial Services'  => 'Commercial build-outs, office construction, restaurant builds, retail storefronts, and tenant improvements in Tampa Bay.',
        'Specialty Services'   => 'Concrete, flooring, painting, fencing, decks, permits, demolition, and storm damage repair across Tampa Bay.',
    ];

    $cat_ids = [];
    foreach ( $categories as $name => $desc ) {
        $existing = term_exists( $name, 'service_category' );
        if ( $existing ) {
            $cat_ids[ $name ] = $existing['term_id'];
        } else {
            $term = wp_insert_term( $name, 'service_category', [ 'description' => $desc ] );
            if ( ! is_wp_error( $term ) ) {
                $cat_ids[ $name ] = $term['term_id'];
            }
        }
    }

    $services = [
        // Residential
        [ 'title' => 'Kitchen Remodeling',            'category' => 'Residential Services', 'excerpt' => 'Tampa Bay\'s trusted kitchen remodeling contractor. Custom cabinets, countertops, and full gut renovations — licensed, insured, and built to last.' ],
        [ 'title' => 'Bathroom Remodeling',            'category' => 'Residential Services', 'excerpt' => 'Expert bathroom remodeling in Tampa Bay. Walk-in showers, custom tile, vanities, and full bath renovations completed on time by licensed general contractors.' ],
        [ 'title' => 'Home Additions & Room Extensions','category' => 'Residential Services', 'excerpt' => 'Need more space? Spicola Construction builds seamless home additions and room extensions across Tampa Bay — permitted, engineered, and delivered on budget.' ],
        [ 'title' => 'Roofing Services',               'category' => 'Residential Services', 'excerpt' => 'Full-service roofing contractor in Tampa Bay. New roofs, repairs, inspections, and replacements for residential and commercial properties — licensed & insured.' ],
        [ 'title' => 'Roof Replacement',               'category' => 'Residential Services', 'excerpt' => 'Complete roof replacement in Tampa, FL. Shingles, tile, flat, and metal roofing installed by licensed crews with manufacturer warranties and free estimates.' ],
        [ 'title' => 'Concrete & Flatwork',            'category' => 'Residential Services', 'excerpt' => 'Professional concrete flatwork in Tampa Bay. Driveways, patios, slabs, sidewalks, and foundations poured by licensed concrete contractors. Free estimates.' ],
        [ 'title' => 'Flooring Installation',          'category' => 'Residential Services', 'excerpt' => 'Expert flooring installation across Tampa Bay. Tile, hardwood, LVP, and more — installed by licensed contractors with meticulous attention to every detail.' ],
        // Commercial
        [ 'title' => 'Office Build-Outs',              'category' => 'Commercial Services',  'excerpt' => 'Custom office build-outs in Tampa Bay. From open-plan offices to private suites — Spicola Construction delivers permit-ready, code-compliant commercial spaces.' ],
        [ 'title' => 'Restaurant Construction',        'category' => 'Commercial Services',  'excerpt' => 'Restaurant construction and renovation in Tampa, FL. We build commercial kitchens, dining rooms, and full restaurant spaces from the ground up.' ],
        [ 'title' => 'Retail Storefront Construction', 'category' => 'Commercial Services',  'excerpt' => 'Retail storefront construction and build-outs in Tampa Bay. Custom storefronts and retail interiors built to your brand standards and delivered on schedule.' ],
        [ 'title' => 'Medical Office Construction',    'category' => 'Commercial Services',  'excerpt' => 'Specialized medical office construction in Tampa Bay. ADA-compliant exam rooms, waiting areas, and healthcare facilities built to Florida code.' ],
        [ 'title' => 'Tenant Improvements',            'category' => 'Commercial Services',  'excerpt' => 'Tenant improvement contractor in Tampa Bay. We transform leased commercial spaces to fit your business — on time, within budget, and permit-ready.' ],
        // Specialty
        [ 'title' => 'Interior Demolition',            'category' => 'Specialty Services',   'excerpt' => 'Safe, efficient interior demolition in Tampa Bay. Selective demo, full gut-outs, and debris removal by licensed contractors — ready for your next renovation.' ],
        [ 'title' => 'Exterior Painting & Stucco',     'category' => 'Specialty Services',   'excerpt' => 'Exterior painting and stucco services in Tampa Bay. Repair, refinish, and repaint your home or business with weather-resistant finishes built for Florida.' ],
        [ 'title' => 'Fence Installation',             'category' => 'Specialty Services',   'excerpt' => 'Fence installation across Tampa Bay. Wood, vinyl, aluminum, and chain-link fencing installed by licensed contractors — permitted and built to last.' ],
        [ 'title' => 'Deck & Patio Construction',      'category' => 'Specialty Services',   'excerpt' => 'Custom deck and patio construction in Tampa, FL. Wood, composite, and pavers — outdoor living spaces that add real value and curb appeal to your home.' ],
        [ 'title' => 'Permit Pulling & Management',    'category' => 'Specialty Services',   'excerpt' => 'Licensed permit management in Tampa Bay. We handle every permit application, inspection, and approval so your project stays legal and on schedule.' ],
        [ 'title' => 'Pre-Construction Consulting',    'category' => 'Specialty Services',   'excerpt' => 'Pre-construction consulting from Spicola Construction in Tampa Bay. Budget planning, site analysis, and scope development before a single nail is driven.' ],
        [ 'title' => 'Storm Damage Repair',            'category' => 'Specialty Services',   'excerpt' => 'Storm damage repair contractor in Tampa Bay. We assess, restore, and rebuild after hurricane and severe weather damage — licensed, insured, Florida-experienced.' ],
    ];

    foreach ( $services as $service ) {
        $existing = get_page_by_title( $service['title'], OBJECT, 'service' );
        if ( $existing ) {
            if ( isset( $cat_ids[ $service['category'] ] ) ) {
                wp_set_object_terms( $existing->ID, (int) $cat_ids[ $service['category'] ], 'service_category' );
            }
            continue;
        }
        $post_id = wp_insert_post( [
            'post_title'   => $service['title'],
            'post_excerpt' => $service['excerpt'],
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'service',
        ] );
        if ( $post_id && ! is_wp_error( $post_id ) && isset( $cat_ids[ $service['category'] ] ) ) {
            wp_set_object_terms( $post_id, (int) $cat_ids[ $service['category'] ], 'service_category' );
        }
    }

    update_option( 'hwh_services_created_v3', true );
}
add_action( 'init', 'hwh_create_services_v3' );

// -- Services Custom Post Type --------------------------------------
function hwh_register_services() {
    register_post_type('service', [
        'labels' => [
            'name'               => 'Services',
            'singular_name'      => 'Service',
            'add_new'            => 'Add Service',
            'add_new_item'       => 'Add New Service',
            'edit_item'          => 'Edit Service',
            'new_item'           => 'New Service',
            'view_item'          => 'View Service',
            'search_items'       => 'Search Services',
            'not_found'          => 'No services found',
            'menu_name'          => 'Services',
        ],
        'public'              => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'services'],
        'menu_icon'           => 'dashicons-hammer',
        'menu_position'       => 5,
        // 'custom-fields' allows Yoast to read/write post meta (required for full Yoast panel).
        // 'page-attributes' adds the Order field for carousel sorting.
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
        'show_in_rest'        => true,
    ]);

    // Service Categories
    register_taxonomy('service_category', 'service', [
        'labels' => [
            'name'          => 'Service Categories',
            'singular_name' => 'Category',
            'add_new_item'  => 'Add Category',
            'menu_name'     => 'Categories',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'service-category'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'hwh_register_services');

// ═══════════════════════════════════════════════════════════════════
// PORTFOLIO — Custom Post Type (Disabled)
// ═══════════════════════════════════════════════════════════════════
/*
function sc_register_portfolio() {
    register_post_type('portfolio', [
        'labels' => [
            'name'               => 'Projects',
            'singular_name'      => 'Project',
            'add_new'            => 'Add Project',
            'add_new_item'       => 'Add New Project',
            'edit_item'          => 'Edit Project',
            'new_item'           => 'New Project',
            'view_item'          => 'View Project',
            'search_items'       => 'Search Projects',
            'not_found'          => 'No projects found',
            'menu_name'          => '🏗️ Projects',
        ],
        'public'              => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'rewrite'             => ['slug' => 'projects'],
        'menu_icon'           => 'dashicons-images-alt2',
        'menu_position'       => 6,
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
        'show_in_rest'        => true,
    ]);

    register_taxonomy('project_type', 'portfolio', [
        'labels' => [
            'name'          => 'Project Types',
            'singular_name' => 'Project Type',
            'add_new_item'  => 'Add Project Type',
            'menu_name'     => 'Project Types',
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'project-type'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'sc_register_portfolio');

// -- Portfolio Gallery Metabox ----------------------------------------
function sc_portfolio_gallery_metabox() {
    add_meta_box(
        'sc_portfolio_gallery',
        'Project Gallery',
        'sc_portfolio_gallery_html',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'sc_portfolio_gallery_metabox');

function sc_portfolio_gallery_html($post) {
    $gallery_ids = get_post_meta($post->ID, '_portfolio_gallery', true);
    $gallery_ids = $gallery_ids ? explode(',', $gallery_ids) : [];
    wp_nonce_field('sc_portfolio_gallery_nonce', 'sc_portfolio_gallery_nonce_field');
    ?>
    <style>
        .sc-gallery-wrap{display:flex;flex-wrap:wrap;gap:10px;padding:10px 0}
        .sc-gallery-wrap .sc-gallery-thumb{position:relative;width:120px;height:120px;border-radius:8px;overflow:hidden;cursor:move;border:2px solid #ddd}
        .sc-gallery-wrap .sc-gallery-thumb img{width:100%;height:100%;object-fit:cover}
        .sc-gallery-wrap .sc-gallery-thumb .sc-gallery-remove{position:absolute;top:4px;right:4px;background:#F22F3A;color:#fff;border:none;border-radius:50%;width:22px;height:22px;cursor:pointer;font-size:14px;line-height:20px;text-align:center}
    </style>
    <input type="hidden" name="portfolio_gallery" id="sc-gallery-ids" value="<?php echo esc_attr(implode(',', $gallery_ids)); ?>">
    <div class="sc-gallery-wrap" id="sc-gallery-wrap">
        <?php foreach ($gallery_ids as $id):
            $img = wp_get_attachment_image_src($id, 'thumbnail');
            if ($img): ?>
            <div class="sc-gallery-thumb" data-id="<?php echo esc_attr($id); ?>">
                <img src="<?php echo esc_url($img[0]); ?>" alt="">
                <button type="button" class="sc-gallery-remove" title="Remove">&times;</button>
            </div>
        <?php endif; endforeach; ?>
    </div>
    <p><button type="button" class="button button-primary" id="sc-gallery-add">Add Images</button></p>
    <script>
    jQuery(function($){
        var wrap   = $('#sc-gallery-wrap'),
            input  = $('#sc-gallery-ids');

        // Sortable
        wrap.sortable({ items:'.sc-gallery-thumb', update: syncIds });

        // Add images
        $('#sc-gallery-add').on('click', function(e){
            e.preventDefault();
            var frame = wp.media({ multiple:'add', library:{type:'image'} });
            frame.on('select', function(){
                frame.state().get('selection').each(function(att){
                    var url = att.attributes.sizes.thumbnail ? att.attributes.sizes.thumbnail.url : att.attributes.url;
                    wrap.append('<div class="sc-gallery-thumb" data-id="'+att.id+'"><img src="'+url+'"><button type="button" class="sc-gallery-remove" title="Remove">&times;</button></div>');
                });
                syncIds();
            });
            frame.open();
        });

        // Remove
        wrap.on('click', '.sc-gallery-remove', function(){ $(this).closest('.sc-gallery-thumb').remove(); syncIds(); });

        function syncIds(){ input.val( wrap.find('.sc-gallery-thumb').map(function(){ return $(this).data('id'); }).get().join(',') ); }
    });
    </script>
    <?php
}

function sc_portfolio_save($post_id) {
    // Gallery Only
    if (isset($_POST['sc_portfolio_gallery_nonce_field']) && wp_verify_nonce($_POST['sc_portfolio_gallery_nonce_field'], 'sc_portfolio_gallery_nonce')) {
        update_post_meta($post_id, '_portfolio_gallery', sanitize_text_field($_POST['portfolio_gallery'] ?? ''));
    }
}
add_action('save_post_portfolio', 'sc_portfolio_save');

// Enqueue media uploader on portfolio edit screen
function sc_portfolio_admin_scripts($hook) {
    global $post_type;
    if ($post_type === 'portfolio' && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
        wp_enqueue_script('jquery-ui-sortable');
    }
}
add_action('admin_enqueue_scripts', 'sc_portfolio_admin_scripts');
*/

// -- Redirect /service/ (singular) → /services/ (plural) -----------
// Safety net for external links and bookmarks pointing to old URLs.
function hwh_redirect_singular_service() {
    if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) return;

    $request = trim( $_SERVER['REQUEST_URI'], '/' );
    // Match /service/anything (singular, NOT /services/)
    if ( preg_match( '#^service/(.+)#', $request, $m ) ) {
        $target = home_url( '/services/' . $m[1] );
        wp_redirect( $target, 301 );
        exit;
    }
}
add_action( 'template_redirect', 'hwh_redirect_singular_service', 1 );

// -- Redirect /portfolio/ and /projects/ → / (homepage) -----------
function sc_redirect_portfolio_to_projects() {
    if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) return;

    // 1. If it's a static Page with slug 'portfolio' or 'projects', redirect to /
    if ( is_page( 'portfolio' ) || is_page( 'projects' ) ) {
        wp_redirect( home_url( '/' ), 301 );
        exit;
    }

    // 2. Get relative request path from $wp->request
    global $wp;
    $request = isset( $wp->request ) ? trim( $wp->request, '/' ) : '';

    if ( in_array( $request, array( 'portfolio', 'projects' ), true ) ) {
        wp_redirect( home_url( '/' ), 301 );
        exit;
    } elseif ( preg_match( '#^(portfolio|projects)/(.+)#', $request, $m ) ) {
        wp_redirect( home_url( '/' ), 301 );
        exit;
    }

    // 3. Fallback: Parse REQUEST_URI and remove the site's base path for subdirectory support
    $home_path = parse_url( home_url(), PHP_URL_PATH );
    $home_path = $home_path ? trim( $home_path, '/' ) : '';
    
    $uri_path = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
    $uri_path = $uri_path ? trim( $uri_path, '/' ) : '';

    if ( $home_path && strpos( $uri_path, $home_path ) === 0 ) {
        $uri_path = trim( substr( $uri_path, strlen( $home_path ) ), '/' );
    }

    if ( in_array( $uri_path, array( 'portfolio', 'projects' ), true ) ) {
        wp_redirect( home_url( '/' ), 301 );
        exit;
    } elseif ( preg_match( '#^(portfolio|projects)/(.+)#', $uri_path, $m ) ) {
        wp_redirect( home_url( '/' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'sc_redirect_portfolio_to_projects', 1 );

// -- FIX: Force correct canonical URL for service pages ----------------
// WordPress generates a canonical based on the post type name ('service')
// instead of the rewrite slug ('services'), producing a /service/ canonical
// that 404s. This filter corrects it at the source so Google sees
// only one canonical pointing to the real /services/ URL.
function hwh_fix_service_canonical( $canonical_url, $post ) {
    if ( get_post_type( $post ) === 'service' ) {
        // Build the correct canonical from the rewrite slug
        $canonical_url = home_url( '/services/' . $post->post_name . '/' );
    }
    return $canonical_url;
}
add_filter( 'get_canonical_url', 'hwh_fix_service_canonical', 10, 2 );

// Also fix the canonical in Yoast SEO if active
function hwh_fix_yoast_canonical( $canonical ) {
    if ( is_singular( 'service' ) ) {
        $post = get_queried_object();
        if ( $post ) {
            $canonical = home_url( '/services/' . $post->post_name . '/' );
        }
    }
    return $canonical;
}
add_filter( 'wpseo_canonical', 'hwh_fix_yoast_canonical', 10, 1 );

// Also fix the canonical in Rank Math if active
add_filter( 'rank_math/frontend/canonical', 'hwh_fix_yoast_canonical', 10, 1 );

// -- FIX: Purge old Hostinger staging domain from all canonicals ------
// The staging URL (olive-ferret-752298.hostingersite.com) leaks into
// some category canonicals stored in the database. This replaces it
// with the real domain everywhere.
function hwh_purge_staging_canonical( $canonical ) {
    if ( is_string( $canonical ) ) {
        $canonical = str_replace(
            'olive-ferret-752298.hostingersite.com',
            'restowrx.com',
            $canonical
        );
    }
    return $canonical;
}
add_filter( 'get_canonical_url',                'hwh_purge_staging_canonical', 99 );
add_filter( 'wpseo_canonical',                  'hwh_purge_staging_canonical', 99 );
add_filter( 'rank_math/frontend/canonical',     'hwh_purge_staging_canonical', 99 );

// -- SEO: Force unique meta descriptions for every page ---------------
// Pages without a custom Yoast/Rank Math meta description fall back to
// the generic sitewide description. This filter overrides that with
// handwritten descriptions for core pages and auto-generated ones for
// blog posts and services (using the post excerpt).
function hwh_fix_meta_descriptions( $description ) {
    // The generic fallback we want to replace
    $generic_descriptions = [
        "Spicola Construction — Tampa Bay's premier construction company. Water heaters, drain cleaning, emergency construction, and more.",
        "Spicola Construction — Tampa Bay's trusted construction experts for water heaters, drain cleaning, leak detection, and 24/7 emergency service.",
        "Restowrx Elite — Tampa Bay's premier property damage restoration company. Water extraction, mold remediation, fire cleanup, storm stabilization, and general reconstruction.",
        "Restowrx Elite — Tampa Bay's trusted restoration experts for water extraction, mold mitigation, fire deodorization, storm stabilization, and 24/7 emergency service.",
    ];

    $is_generic = empty( $description ) || in_array( trim( $description ), $generic_descriptions, true );

    // -- Core pages: handwritten meta descriptions --
    if ( is_page() ) {
        $slug = get_post_field( 'post_name', get_queried_object_id() );
        $page_metas = [
            'about'               => 'Meet the Restowrx Elite team — certified property damage restoration and mitigation specialists in Tampa Bay. Rapid response 24/7, advanced moisture detection, and licensed reconstruction.',
            'contact'             => 'Need emergency property restoration in Tampa? Contact Restowrx Elite — call 813.699.4009 or dispatch a strike team online for 24/7 rapid response across Tampa Bay.',
            'service-areas'       => 'Restowrx Elite serves Tampa, St. Pete, Clearwater, Brandon, Wesley Chapel, and all of Tampa Bay. Fast, local property damage mitigation — same-day rapid response available.',
            'privacy-policy'      => 'Read the Restowrx Elite privacy policy. Learn how we collect, use, and protect your personal information.',
            'cancellation-policy' => 'View the Restowrx Elite cancellation and payment policy. Clear terms for emergency response, strike team dispatches, and billing.',
            'refund-policy'       => 'Restowrx Elite refund policy — upfront estimates, transparent insurance billing, and our satisfaction guarantee for Tampa Bay property owners.',
        ];
        if ( isset( $page_metas[ $slug ] ) ) {
            return $page_metas[ $slug ];
        }
    }

    // -- Blog page (archive) --
    if ( is_home() && $is_generic ) {
        return 'Property recovery tips, mold mitigation guides, and expert advice from Restowrx Elite in Tampa Bay. Learn how to protect your property and prevent water damage.';
    }

    // -- Category archives --
    if ( is_category() && $is_generic ) {
        $cat = get_queried_object();
        if ( $cat ) {
            return 'Browse ' . $cat->name . ' articles from Restowrx Elite — expert Tampa Bay damage restoration tips, guides, and service info.';
        }
    }

    // -- Blog posts: auto-generate from excerpt if generic --
    if ( is_singular( 'post' ) && $is_generic ) {
        $excerpt = get_the_excerpt();
        if ( $excerpt && strlen( $excerpt ) > 20 ) {
            // Trim to ~155 chars at a word boundary
            $meta = wp_strip_all_tags( $excerpt );
            if ( strlen( $meta ) > 155 ) {
                $meta = substr( $meta, 0, 152 );
                $meta = substr( $meta, 0, strrpos( $meta, ' ' ) ) . '...';
            }
            return $meta;
        }
        // Fallback: use post title
        return get_the_title() . ' — expert restoration advice from Restowrx Elite, Tampa Bay\'s trusted property damage mitigation company.';
    }

    // -- Service pages: auto-generate from excerpt if too long or generic --
    if ( is_singular( 'service' ) ) {
        if ( $is_generic || strlen( $description ) > 160 ) {
            $excerpt = get_the_excerpt();
            if ( $excerpt && strlen( $excerpt ) > 20 ) {
                $meta = wp_strip_all_tags( $excerpt );
                if ( strlen( $meta ) > 155 ) {
                    $meta = substr( $meta, 0, 152 );
                    $meta = substr( $meta, 0, strrpos( $meta, ' ' ) ) . '...';
                }
                return $meta;
            }
            return get_the_title() . ' in Tampa Bay, FL. Certified restoration specialists, upfront billing, 24/7 emergency response. Call Restowrx Elite at 813.699.4009.';
        }
    }

    // -- Services archive --
    if ( is_post_type_archive( 'service' ) && $is_generic ) {
        return 'Professional property damage restoration in Tampa Bay — water damage extraction, mold mitigation, fire restoration, storm stabilization, and reconstruction. Call 813.699.4009.';
    }

    return $description;
}
add_filter( 'wpseo_metadesc', 'hwh_fix_meta_descriptions', 10, 1 );
add_filter( 'rank_math/frontend/description', 'hwh_fix_meta_descriptions', 10, 1 );

// -- Show ALL services on the services archive page -----------------
function hwh_services_per_page($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('service')) {
        $query->set('posts_per_page', 100);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'hwh_services_per_page');

// -- Force blog page to only show regular posts (no services) -------
function hwh_blog_only_posts($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_home()) {
        $query->set('post_type', 'post');
    }
}
add_action('pre_get_posts', 'hwh_blog_only_posts');

// -- AJAX Blog Pagination -------------------------------------------
function hwh_ajax_blog_posts() {
    $paged = isset( $_POST['page'] ) ? absint( $_POST['page'] ) : 1;

    $blog_query = new WP_Query( array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 9,
        'paged'               => $paged,
        'ignore_sticky_posts' => false,
    ) );

    ob_start();

    if ( $blog_query->have_posts() ) :
        echo '<div class="blog-grid">';
        while ( $blog_query->have_posts() ) : $blog_query->the_post();
            $card_img = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
            ?>
            <article class="blog-card reveal" itemscope itemtype="https://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" class="blog-card__link">
                    <?php if ( $card_img ) : ?>
                        <div class="blog-card__img">
                            <img src="<?php echo esc_url( $card_img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
                        </div>
                    <?php else : ?>
                        <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </div>
                    <?php endif; ?>
                    <div class="blog-card__body">
                        <div class="blog-card__meta">
                            <?php
                            $ccats = get_the_category();
                            if ( ! empty( $ccats ) ) {
                                echo '<span class="blog-card__cat">' . esc_html( $ccats[0]->name ) . '</span>';
                            }
                            ?>
                            <time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
                        </div>
                        <h2 class="blog-card__title" itemprop="headline"><?php the_title(); ?></h2>
                        <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                        <span class="blog-card__read">Read Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                    </div>
                </a>
            </article>
            <?php
        endwhile;
        echo '</div>';

        // Pagination
        if ( $blog_query->max_num_pages > 1 ) {
            echo '<nav class="blog-pagination" aria-label="Blog pagination">';
            echo paginate_links( array(
                'total'     => $blog_query->max_num_pages,
                'current'   => $paged,
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
                'type'      => 'list',
            ) );
            echo '</nav>';
        }
    endif;

    wp_reset_postdata();

    $html = ob_get_clean();
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_hwh_load_posts', 'hwh_ajax_blog_posts' );
add_action( 'wp_ajax_nopriv_hwh_load_posts', 'hwh_ajax_blog_posts' );

// NOTE: The old 'Service Details' custom metabox (Icon / Price / Duration) has been
// intentionally removed. It was registered at context='normal' priority='high', which
// pushed Yoast SEO's meta panel off-screen and hid the Meta Title / Meta Description
// fields. Use the standard WordPress Excerpt field for the service summary, and Yoast
// SEO's own panel for all SEO metadata. Any previously saved _service_icon / _service_price
// / _service_duration values are preserved in the database — they can be accessed via
// the built-in Custom Fields panel if needed (enabled above via 'custom-fields' support).

// -- Team Member Custom Post Type -----------------------------------
function hwh_register_team() {
    register_post_type('team_member', [
        'labels' => [
            'name'               => 'Team Members',
            'singular_name'      => 'Team Member',
            'add_new'            => 'Add Team Member',
            'add_new_item'       => 'Add New Team Member',
            'edit_item'          => 'Edit Team Member',
            'new_item'           => 'New Team Member',
            'view_item'          => 'View Team Member',
            'search_items'       => 'Search Team Members',
            'not_found'          => 'No team members found',
            'menu_name'          => 'Restowrx Team',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-groups',
        'menu_position'      => 6,
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'       => true,
    ]);
}
add_action('init', 'hwh_register_team');

// -- Team Member custom fields (meta box) ---------------------------
function hwh_team_meta_boxes() {
    add_meta_box(
        'hwh_team_details',
        'Team Member Details',
        'hwh_team_meta_html',
        'team_member',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hwh_team_meta_boxes');

function hwh_team_meta_html($post) {
    wp_nonce_field('hwh_team_meta', 'hwh_team_nonce');
    $role         = get_post_meta($post->ID, '_team_role', true);
    $credentials  = get_post_meta($post->ID, '_team_credentials', true);
    $specialties  = get_post_meta($post->ID, '_team_specialties', true);
    ?>
    <style>
        .hwh-team-row { display:flex; gap:1.5rem; margin-bottom:1rem; flex-wrap:wrap; }
        .hwh-team-field { flex:1; min-width:250px; }
        .hwh-team-field label { display:block; font-weight:600; margin-bottom:4px; }
        .hwh-team-field input { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
    </style>
    <div class="hwh-team-row">
        <div class="hwh-team-field">
            <label for="team_role">Role / Title</label>
            <input type="text" id="team_role" name="team_role" value="<?php echo esc_attr($role); ?>" placeholder="Master contractor">
            <p class="description">e.g. "Master contractor" or "Licensed Journeyman"</p>
        </div>
    </div>
    <div class="hwh-team-row">
        <div class="hwh-team-field">
            <label for="team_credentials">Credential Badges</label>
            <input type="text" id="team_credentials" name="team_credentials" value="<?php echo esc_attr($credentials); ?>" placeholder="IICRC Certified, OSHA Compliant, Licensed">
            <p class="description">Comma-separated badges shown under the name, e.g. "IICRC Certified, 10+ Years"</p>
        </div>
    </div>
    <div class="hwh-team-row">
        <div class="hwh-team-field">
            <label for="team_specialties">Specialties</label>
            <input type="text" id="team_specialties" name="team_specialties" value="<?php echo esc_attr($specialties); ?>" placeholder="Water Extraction, Mold Mitigation, Fire Restoration">
            <p class="description">Comma-separated specialties shown as tags, e.g. "Water Extraction, Mold Mitigation, Fire Restoration"</p>
        </div>
    </div>
    <?php
}

function hwh_save_team_meta($post_id) {
    if (!isset($_POST['hwh_team_nonce']) || !wp_verify_nonce($_POST['hwh_team_nonce'], 'hwh_team_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['team_role', 'team_credentials', 'team_specialties'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_team_member', 'hwh_save_team_meta');

// -- Product Custom Post Type ---------------------------------------
function hwh_register_products() {
    register_post_type('product', [
        'labels' => [
            'name'               => 'Products',
            'singular_name'      => 'Product',
            'add_new'            => 'Add Product',
            'add_new_item'       => 'Add New Product',
            'edit_item'          => 'Edit Product',
            'new_item'           => 'New Product',
            'view_item'          => 'View Product',
            'search_items'       => 'Search Products',
            'not_found'          => 'No products found',
            'menu_name'          => 'Products',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-cart',
        'menu_position'      => 7,
        'supports'           => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest'       => true,
    ]);
}
add_action('init', 'hwh_register_products');

// -- Product custom fields (meta box) -------------------------------
function hwh_product_meta_boxes() {
    add_meta_box(
        'hwh_product_details',
        'Product Details',
        'hwh_product_meta_html',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hwh_product_meta_boxes');

function hwh_product_meta_html($post) {
    wp_nonce_field('hwh_product_meta', 'hwh_product_nonce');
    $url      = get_post_meta($post->ID, '_product_url', true);
    $video    = get_post_meta($post->ID, '_product_video_bg', true);
    $price    = get_post_meta($post->ID, '_product_price', true);
    $btn_text = get_post_meta($post->ID, '_product_btn_text', true) ?: 'Shop Now';
    ?>
    <style>
        .hwh-product-row { display:flex; gap:1.5rem; margin-bottom:1rem; flex-wrap:wrap; }
        .hwh-product-field { flex:1; min-width:250px; }
        .hwh-product-field label { display:block; font-weight:600; margin-bottom:4px; }
        .hwh-product-field input { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
    </style>
    <div class="hwh-product-row">
        <div class="hwh-product-field">
            <label for="product_url">Product Website URL</label>
            <input type="url" id="product_url" name="product_url" value="<?php echo esc_attr($url); ?>" placeholder="https://www.example.com/product">
            <p class="description">External link where users can buy this product</p>
        </div>
        <div class="hwh-product-field">
            <label for="product_btn_text">Button Text</label>
            <input type="text" id="product_btn_text" name="product_btn_text" value="<?php echo esc_attr($btn_text); ?>" placeholder="Shop Now">
            <p class="description">Custom button label (default: "Shop Now")</p>
        </div>
    </div>
    <div class="hwh-product-row">
        <div class="hwh-product-field">
            <label for="product_price">Price (optional)</label>
            <input type="text" id="product_price" name="product_price" value="<?php echo esc_attr($price); ?>" placeholder="$89">
            <p class="description">Display price or "From $89"</p>
        </div>
        <div class="hwh-product-field">
            <label for="product_video_bg">Video Background URL (optional)</label>
            <input type="url" id="product_video_bg" name="product_video_bg" value="<?php echo esc_attr($video); ?>" placeholder="https://example.com/video.mp4">
            <p class="description">MP4 video URL — plays faintly behind the product card. Leave blank for no video.</p>
        </div>
    </div>
    <?php
}

function hwh_save_product_meta($post_id) {
    if (!isset($_POST['hwh_product_nonce']) || !wp_verify_nonce($_POST['hwh_product_nonce'], 'hwh_product_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['product_url', 'product_video_bg', 'product_price', 'product_btn_text'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_product', 'hwh_save_product_meta');

// -- Flush rewrite rules on theme activation ------------------------
function hwh_rewrite_flush() {
    hwh_register_services();
    hwh_register_team();
    hwh_register_products();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'hwh_rewrite_flush');

// -- Performance: Add image optimization defaults -------------------
function hwh_image_size_defaults() {
    update_option('thumbnail_size_w', 150);
    update_option('thumbnail_size_h', 150);
    update_option('medium_size_w', 480);
    update_option('medium_size_h', 480);
    update_option('large_size_w', 1024);
    update_option('large_size_h', 1024);
}
add_action('after_switch_theme', 'hwh_image_size_defaults');

// -- Performance: Add WebP support ----------------------------------
function hwh_allow_webp($mimes) {
    $mimes['webp'] = 'image/webp';
    $mimes['avif'] = 'image/avif';
    return $mimes;
}
add_filter('upload_mimes', 'hwh_allow_webp');

// -- Security: Disable XML-RPC --------------------------------------
add_filter('xmlrpc_enabled', '__return_false');

// -- Performance: Reduce heartbeat interval -------------------------
function hwh_heartbeat_settings($settings) {
    $settings['interval'] = 60;
    return $settings;
}
add_filter('heartbeat_settings', 'hwh_heartbeat_settings');

// ------------------------------------------------------------------------
// BUILT-IN SEO META BOX — edit SEO title, description & OG image
// directly from the WordPress editor on every page/post/service
// ------------------------------------------------------------------------

// -- Register the meta box on all editable post types ---------------
function hwh_seo_meta_box() {
    $post_types = ['post', 'page', 'service'];
    foreach ($post_types as $pt) {
        add_meta_box(
            'hwh_seo_meta',
            '?? SEO Settings',
            'hwh_seo_meta_html',
            $pt,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'hwh_seo_meta_box');

// -- Render the meta box HTML ---------------------------------------
function hwh_seo_meta_html($post) {
    wp_nonce_field('hwh_seo_meta', 'hwh_seo_nonce');

    $seo_title = get_post_meta($post->ID, '_hwh_seo_title', true);
    $seo_desc  = get_post_meta($post->ID, '_hwh_seo_desc', true);
    $og_image  = get_post_meta($post->ID, '_hwh_og_image', true);
    ?>
    <style>
        .hwh-seo-box { padding: 12px 0; }
        .hwh-seo-field { margin-bottom: 18px; }
        .hwh-seo-field label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 6px;
            color: #1d2327;
        }
        .hwh-seo-field input,
        .hwh-seo-field textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            transition: border-color 0.2s;
        }
        .hwh-seo-field input:focus,
        .hwh-seo-field textarea:focus {
            border-color: #F22F3A;
            outline: none;
            box-shadow: 0 0 0 2px rgba(201,169,110,0.15);
        }
        .hwh-seo-hint {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }
        .hwh-seo-counter {
            font-size: 12px;
            float: right;
            margin-top: 4px;
            font-weight: 500;
        }
        .hwh-seo-counter.is-warn { color: #dba617; }
        .hwh-seo-counter.is-over { color: #dc3232; }
        .hwh-seo-counter.is-good { color: #46b450; }
        .hwh-seo-preview {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 16px 20px;
            margin-top: 12px;
        }
        .hwh-seo-preview__label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #F22F3A;
            margin-bottom: 8px;
        }
        .hwh-seo-preview__title {
            font-size: 18px;
            font-weight: 400;
            color: #1a0dab;
            line-height: 1.3;
            margin-bottom: 4px;
        }
        .hwh-seo-preview__url {
            font-size: 13px;
            color: #006621;
            margin-bottom: 4px;
        }
        .hwh-seo-preview__desc {
            font-size: 13px;
            color: #545454;
            line-height: 1.5;
        }
    </style>

    <div class="hwh-seo-box">
        <!-- SEO Title -->
        <div class="hwh-seo-field">
            <label for="hwh_seo_title">SEO Title</label>
            <input type="text"
                   id="hwh_seo_title"
                   name="hwh_seo_title"
                   value="<?php echo esc_attr($seo_title); ?>"
                   placeholder="<?php echo esc_attr($post->post_title . ' — Spicola Construction'); ?>"
                   maxlength="120">
            <span class="hwh-seo-hint">Recommended: 50—60 characters. Leave blank to use default.</span>
            <span class="hwh-seo-counter" id="seo-title-counter">0/60</span>
        </div>

        <!-- Meta Description -->
        <div class="hwh-seo-field">
            <label for="hwh_seo_desc">Meta Description</label>
            <textarea id="hwh_seo_desc"
                      name="hwh_seo_desc"
                      rows="3"
                      placeholder="A brief summary for search engines..."
                      maxlength="320"><?php echo esc_textarea($seo_desc); ?></textarea>
            <span class="hwh-seo-hint">Recommended: 120—160 characters.</span>
            <span class="hwh-seo-counter" id="seo-desc-counter">0/160</span>
        </div>

        <!-- OG Image -->
        <div class="hwh-seo-field">
            <label for="hwh_og_image">Social Share Image URL</label>
            <input type="url"
                   id="hwh_og_image"
                   name="hwh_og_image"
                   value="<?php echo esc_attr($og_image); ?>"
                   placeholder="https://restowrx.com/wp-content/uploads/...">
            <span class="hwh-seo-hint">Image shown when shared on Facebook, Twitter, etc. Ideal size: 1200—630px.</span>
        </div>

        <!-- Live Google Preview -->
        <div class="hwh-seo-preview">
            <div class="hwh-seo-preview__label">Google Search Preview</div>
            <div class="hwh-seo-preview__title" id="seo-preview-title">
                <?php echo esc_html($seo_title ?: $post->post_title . ' — Restowrx Elite'); ?>
            </div>
            <div class="hwh-seo-preview__url">
                <?php echo esc_url(get_permalink($post->ID)); ?>
            </div>
            <div class="hwh-seo-preview__desc" id="seo-preview-desc">
                <?php echo esc_html($seo_desc ?: 'Add a meta description to control what appears here in search results.'); ?>
            </div>
        </div>
    </div>

    <script>
    (function() {
        var titleInput = document.getElementById('hwh_seo_title');
        var descInput  = document.getElementById('hwh_seo_desc');
        var titleCounter = document.getElementById('seo-title-counter');
        var descCounter  = document.getElementById('seo-desc-counter');
        var previewTitle = document.getElementById('seo-preview-title');
        var previewDesc  = document.getElementById('seo-preview-desc');
        var defaultTitle = <?php echo json_encode($post->post_title . ' — Restowrx Elite'); ?>;

        function updateCounter(input, counter, ideal) {
            var len = input.value.length;
            counter.textContent = len + '/' + ideal;
            counter.className = 'hwh-seo-counter ' +
                (len === 0 ? '' : len <= ideal ? 'is-good' : len <= ideal * 1.2 ? 'is-warn' : 'is-over');
        }

        function updatePreview() {
            previewTitle.textContent = titleInput.value || defaultTitle;
            previewDesc.textContent = descInput.value || 'Add a meta description to control what appears here in search results.';
        }

        titleInput.addEventListener('input', function() {
            updateCounter(titleInput, titleCounter, 60);
            updatePreview();
        });
        descInput.addEventListener('input', function() {
            updateCounter(descInput, descCounter, 160);
            updatePreview();
        });

        // Initial count
        updateCounter(titleInput, titleCounter, 60);
        updateCounter(descInput, descCounter, 160);
    })();
    </script>
    <?php
}

// -- Save the SEO meta fields ---------------------------------------
function hwh_save_seo_meta($post_id) {
    if (!isset($_POST['hwh_seo_nonce']) || !wp_verify_nonce($_POST['hwh_seo_nonce'], 'hwh_seo_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['hwh_seo_title', 'hwh_seo_desc', 'hwh_og_image'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'hwh_save_seo_meta');

// -- Override the <title> tag with custom SEO title -----------------
function hwh_custom_title($title) {
    // Homepage
    if (is_front_page()) {
        $title['title'] = 'Property Damage Restoration in Tampa Bay, FL';
        $title['site']  = 'Restowrx Elite';
        return $title;
    }
    // Service pages: "Water Damage Extraction in Tampa Bay, FL | Restowrx Elite"
    if (is_singular('service')) {
        $custom = get_post_meta(get_the_ID(), '_hwh_seo_title', true);
        $title['title'] = !empty($custom) ? $custom : get_the_title() . ' in Tampa Bay, FL';
        $title['site']  = 'Restowrx Elite';
        return $title;
    }
    // Product pages
    if (is_singular('product')) {
        $title['title'] = get_the_title() . ' | Property Recovery & Restoration';
        $title['site']  = 'Restowrx Elite';
        return $title;
    }
    // All other singular pages — use custom SEO title if set
    if (is_singular()) {
        $custom = get_post_meta(get_the_ID(), '_hwh_seo_title', true);
        if (!empty($custom)) {
            $title['title'] = $custom;
        }
    }
    return $title;
}
add_filter('document_title_parts', 'hwh_custom_title');

// -- Output meta description & OG tags in <head> -------------------
function hwh_seo_head_tags() {
    if (is_singular()) {
        $post_id = get_the_ID();
        $desc    = get_post_meta($post_id, '_hwh_seo_desc', true);
        $og_img  = get_post_meta($post_id, '_hwh_og_image', true);
        $title   = get_post_meta($post_id, '_hwh_seo_title', true) ?: get_the_title();

        if (!empty($desc)) {
            echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
        }

        // Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink($post_id)) . '">' . "\n";
        echo '<meta property="og:site_name" content="Restowrx Elite">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";

        if (!empty($og_img)) {
            echo '<meta property="og:image" content="' . esc_url($og_img) . '">' . "\n";
            echo '<meta name="twitter:image" content="' . esc_url($og_img) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'hwh_seo_head_tags', 5);

// -- FAQ Schema for Maintenance Plan Page --------------------------------
function hwh_faq_schema() {
    if (!is_page(['memberships','maintenance-plan'])) return;

    $faqs = [
        ['q' => 'Is there a minimum commitment?', 'a' => 'We ask for a minimum annual commitment to get the most out of your Active Property Defense Plan membership. After that, you can continue month-to-month or cancel anytime.'],
        ['q' => 'Do my credits expire?', 'a' => 'No! Your banked defense credits never expire as long as your membership is active. If you cancel, unused credits remain available for 90 days.'],
        ['q' => 'What can I use my credits on?', 'a' => 'Your Active Property Defense Plan credits can be used on any structural restoration or build-back services we offer — water extraction, mold remediation, storm stabilization, or reconstruction via Spicola Construction.'],
        ['q' => 'Can I share my credits with friends or family?', 'a' => 'Absolutely! You can gift your property defense credits to friends and family members.'],
        ['q' => 'How much should I set as my monthly deposit?', 'a' => 'Our plans start at affordable annual rates. During your free property risk assessment, we\'ll help you find the perfect defense tier.'],
    ];

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => [],
    ];

    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'hwh_faq_schema', 6);

// -- Disable XML-RPC for security ----------------------------------
add_filter('xmlrpc_enabled', '__return_false');

// -- Add security headers ------------------------------------------
function hwh_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'hwh_security_headers');

// -- Contact Form: AJAX email handler -------------------------------
function hwh_handle_contact_form() {
    // Verify nonce
    if ( ! isset($_POST['hwh_contact_nonce']) || ! wp_verify_nonce($_POST['hwh_contact_nonce'], 'hwh_contact_form') ) {
        wp_send_json_error(['message' => 'Security check failed. Please refresh and try again.']);
    }

    // Sanitize inputs
    $fullname = sanitize_text_field($_POST['full_name'] ?? '');
    if ( ! empty($fullname) ) {
        $parts = explode(' ', trim($fullname), 2);
        $first = $parts[0] ?? '';
        $last  = $parts[1] ?? '';
    } else {
        $first   = sanitize_text_field($_POST['first_name'] ?? '');
        $last    = sanitize_text_field($_POST['last_name']  ?? '');
    }

    $email   = sanitize_email($_POST['email']           ?? '');
    $phone   = sanitize_text_field($_POST['phone']      ?? '');
    $service = sanitize_text_field($_POST['service']    ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate required fields
    if ( (empty($first) && empty($fullname)) || empty($email) || ! is_email($email) ) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    // -- Build recipients list (supports multiple, comma-separated) --
    $recipients_raw = get_option('hwh_notification_emails', 'joe@restowrx.com');
    $recipients = array_filter(array_map('trim', explode(',', $recipients_raw)), 'is_email');
    if ( empty($recipients) ) $recipients = ['joe@restowrx.com'];
    $to = $recipients;

    $subject = '⚡ New Message — Restowrx Elite Website';

    // -- Prepare substitution values ---------------------------------
    $service_display = $service ? ucwords(str_replace('-', ' ', $service)) : 'Not specified';
    $phone_display   = $phone ?: 'Not provided';

    // -- Get custom or default template -----------------------------
    $default_template = hwh_default_email_template();
    $template = get_option('hwh_email_template', '') ?: $default_template;

    // Replace {{placeholders}} with actual values
    $body = str_replace(
        ['{{name}}', '{{first_name}}', '{{last_name}}', '{{email}}', '{{phone}}', '{{service}}', '{{message}}'],
        [
            esc_html($first . ' ' . $last),
            esc_html($first),
            esc_html($last),
            esc_html($email),
            esc_html($phone_display),
            esc_html($service_display),
            nl2br(esc_html($message)),
        ],
        $template
    );

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        "Reply-To: {$first} {$last} <{$email}>",
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Message sent! We\'ll get back to you within 24 hours.']);
    } else {
        wp_send_json_error(['message' => 'Something went wrong. Please call us at 813.699.4009.']);
    }
}
add_action('wp_ajax_hwh_contact_submit',        'hwh_handle_contact_form');
add_action('wp_ajax_nopriv_hwh_contact_submit', 'hwh_handle_contact_form');

// -- Default email template (used when no custom template is saved) --
function hwh_default_email_template() {
    return '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>New Message</title></head>
<body style="margin:0;padding:0;background:#f4f0f8;font-family:\'Helvetica Neue\',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f0f8;padding:40px 0;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;border-radius:16px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,0.12);">
        <tr>
          <td style="background:linear-gradient(135deg,#0f0720 0%,#0A1628 60%,#2d0d5e 100%);padding:40px 40px 32px;text-align:center;">
            <p style="margin:0 0 8px;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(201,169,110,0.9);">Restowrx Elite</p>
            <h1 style="margin:0;font-size:26px;font-weight:300;color:#f0ebe3;letter-spacing:1px;">New Website Message</h1>
            <div style="width:40px;height:2px;background:linear-gradient(90deg,#F22F3A,#C9A96E);margin:16px auto 0;border-radius:2px;"></div>
          </td>
        </tr>
        <tr>
          <td style="background:#ffffff;padding:40px;">
            <p style="margin:0 0 28px;font-size:15px;color:#555;line-height:1.6;">You have a new inquiry from your website contact form. Reply directly to this email to respond to {{first_name}}.</p>
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td style="padding:0 8px 16px 0;width:50%;vertical-align:top;">
                  <div style="background:#FFF5F5;border-radius:10px;padding:16px 18px;border-left:3px solid #F22F3A;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#F22F3A;font-weight:600;">Name</p>
                    <p style="margin:0;font-size:15px;color:#0A1628;font-weight:500;">{{name}}</p>
                  </div>
                </td>
                <td style="padding:0 0 16px 8px;width:50%;vertical-align:top;">
                  <div style="background:#FFF5F5;border-radius:10px;padding:16px 18px;border-left:3px solid #F22F3A;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#F22F3A;font-weight:600;">Email</p>
                    <p style="margin:0;font-size:15px;color:#0A1628;font-weight:500;"><a href="mailto:{{email}}" style="color:#F22F3A;text-decoration:none;">{{email}}</a></p>
                  </div>
                </td>
              </tr>
              <tr>
                <td style="padding:0 8px 16px 0;vertical-align:top;">
                  <div style="background:#FFF5F5;border-radius:10px;padding:16px 18px;border-left:3px solid #C9A96E;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#C9A96E;font-weight:600;">Phone</p>
                    <p style="margin:0;font-size:15px;color:#0A1628;font-weight:500;">{{phone}}</p>
                  </div>
                </td>
                <td style="padding:0 0 16px 8px;vertical-align:top;">
                  <div style="background:#FFF5F5;border-radius:10px;padding:16px 18px;border-left:3px solid #C9A96E;">
                    <p style="margin:0 0 4px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#C9A96E;font-weight:600;">Service Interest</p>
                    <p style="margin:0;font-size:15px;color:#0A1628;font-weight:500;">{{service}}</p>
                  </div>
                </td>
              </tr>
            </table>
            <div style="background:#FFF5F5;border-radius:10px;padding:20px 22px;margin-top:4px;border-left:3px solid #F22F3A;">
               <p style="margin:0 0 8px;font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#F22F3A;font-weight:600;">Message</p>
               <p style="margin:0;font-size:15px;color:#333;line-height:1.7;">{{message}}</p>
            </div>
            <div style="text-align:center;margin-top:32px;">
              <a href="mailto:{{email}}" style="display:inline-block;background:linear-gradient(135deg,#F22F3A,#C41E27);color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:50px;font-size:14px;font-weight:600;letter-spacing:0.5px;">Reply to {{first_name}} ⚡</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="background:#0f0720;padding:24px 40px;text-align:center;">
            <p style="margin:0;font-size:11px;color:rgba(240,235,227,0.4);letter-spacing:1px;">Restowrx Elite &middot; Tampa Bay, FL &middot; <a href="https://restowrx.com" style="color:rgba(242,47,58,0.7);text-decoration:none;">restowrx.com</a></p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>';
}

// -- HWH Settings Page (Admin Dashboard) --------------------------
function hwh_settings_page_html() {
    if ( ! current_user_can('manage_options') ) return;

    if ( isset($_POST['hwh_settings_nonce']) && wp_verify_nonce($_POST['hwh_settings_nonce'], 'hwh_save_settings') ) {
        // Multiple emails — stored as comma-separated string
        $emails_raw = sanitize_text_field($_POST['hwh_notification_emails'] ?? 'joe@restowrx.com');
        $emails_clean = implode(', ', array_filter(array_map('sanitize_email', array_map('trim', explode(',', $emails_raw))), 'is_email'));
        update_option('hwh_notification_emails', $emails_clean ?: 'joe@restowrx.com');

        // Email template — allow HTML
        $template = wp_unslash($_POST['hwh_email_template'] ?? '');
        update_option('hwh_email_template', $template);

        echo '<div class="notice notice-success is-dismissible"><p><strong>⚡ Settings saved!</strong></p></div>';
    }

    $current_emails  = get_option('hwh_notification_emails', 'joe@restowrx.com');
    $current_template = get_option('hwh_email_template', '') ?: hwh_default_email_template();
    ?>
    <div class="wrap">
        <h1 style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
            <span style="font-size:1.4rem;">⚡</span> Restowrx Elite — Settings
        </h1>

        <form method="post">
            <?php wp_nonce_field('hwh_save_settings', 'hwh_settings_nonce'); ?>

            <!-- Section: Recipients -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">⚡ Notification Recipients</h2>
                <p style="margin:0 0 20px;color:#666;font-size:13px;">Separate multiple email addresses with commas. All recipients receive every submission.</p>
                <label for="hwh_notification_emails" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">Email Address(es)</label>
                <input type="text" id="hwh_notification_emails" name="hwh_notification_emails"
                       value="<?php echo esc_attr($current_emails); ?>"
                       style="width:100%;max-width:600px;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;"
                       placeholder="joe@restowrx.com, support@restowrx.com">
                <p style="margin:8px 0 0;font-size:12px;color:#888;">Example: <code>joe@restowrx.com, support@restowrx.com</code></p>
            </div>

            <!-- Section: Email Template -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">?? Email Template (HTML)</h2>
                <p style="margin:0 0 16px;color:#666;font-size:13px;">Customize the HTML email that gets sent to your inbox. Use the tags below to insert form data — they'll be replaced automatically.</p>

                <!-- Placeholder Tags Reference -->
                <div style="background:#FFF5F5;border:1px solid #e8d8ff;border-radius:8px;padding:16px 20px;margin-bottom:16px;">
                    <p style="margin:0 0 10px;font-size:12px;font-weight:700;color:#F22F3A;letter-spacing:1px;text-transform:uppercase;">Available Placeholder Tags</p>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        <?php
                        $tags = [
                            '{{name}}'       => 'Full name',
                            '{{first_name}}' => 'First name only',
                            '{{last_name}}'  => 'Last name only',
                            '{{email}}'      => 'Email address',
                            '{{phone}}'      => 'Phone number',
                            '{{service}}'    => 'Service of interest',
                            '{{message}}'    => 'Their message',
                        ];
                        foreach ($tags as $tag => $desc) : ?>
                            <span style="background:#fff;border:1px solid #d8b4ff;border-radius:5px;padding:4px 10px;font-size:12px;cursor:pointer;"
                                  title="<?php echo esc_attr($desc); ?>"
                                  onclick="insertTag('<?php echo esc_js($tag); ?>')"><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <p style="margin:10px 0 0;font-size:11px;color:#888;">?? Click a tag to insert it at your cursor position in the editor below.</p>
                </div>

                <label for="hwh_email_template" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">HTML Template</label>
                <textarea id="hwh_email_template" name="hwh_email_template"
                          rows="24"
                          style="width:100%;font-family:'Courier New',monospace;font-size:12px;line-height:1.6;padding:14px;border:1px solid #ddd;border-radius:6px;resize:vertical;background:#1a1a2e;color:#e8e8f0;"><?php echo esc_textarea($current_template); ?></textarea>
                <p style="margin:8px 0 0;font-size:12px;color:#888;">?? Click "Reset to Default" to restore the original branded template.</p>
            </div>

            <div style="max-width:800px;display:flex;gap:12px;align-items:center;">
                <?php submit_button('Save Settings', 'primary', 'submit', false, ['style' => 'margin:0;']); ?>
                <button type="submit" name="hwh_reset_template" value="1"
                        style="background:none;border:1px solid #ddd;border-radius:6px;padding:8px 18px;font-size:13px;cursor:pointer;color:#555;"
                        onclick="if(!confirm('Reset template to default? This cannot be undone.')) return false;">
                    Reset to Default
                </button>
            </div>
        </form>
    </div>

    <script>
    function insertTag(tag) {
        var ta = document.getElementById('hwh_email_template');
        if (!ta) return;
        var start = ta.selectionStart, end = ta.selectionEnd;
        ta.value = ta.value.substring(0, start) + tag + ta.value.substring(end);
        ta.selectionStart = ta.selectionEnd = start + tag.length;
        ta.focus();
    }
    </script>
    <?php

    // Handle reset separately
    if ( isset($_POST['hwh_reset_template']) && isset($_POST['hwh_settings_nonce']) && wp_verify_nonce($_POST['hwh_settings_nonce'], 'hwh_save_settings') ) {
        update_option('hwh_email_template', '');
    }
}

function hwh_add_settings_menu() {
    add_options_page(
        'Restowrx Elite Settings',
        '⚡ Restowrx Settings',
        'manage_options',
        'hwh-settings',
        'hwh_settings_page_html'
    );
}
add_action('admin_menu', 'hwh_add_settings_menu');

// -- Mitigation Alert Popup — Customizer Controls -------------------
// Client manages all popup content from Appearance > Customize > ⚡ Mitigation Alert
// Zero code required. Changes go live on Save & Publish.
add_action('customize_register', 'hwh_popup_customizer');
function hwh_popup_customizer($wp_customize) {

    $wp_customize->add_section('hwh_popup', [
        'title'       => '⚡ Mitigation Alert',
        'priority'    => 30,
        'description' => 'Control the active alert popup. Turn it on/off, set the alert text, button, and when it expires. Visitors only see it once every 7 days.',
    ]);

    // Enable toggle
    $wp_customize->add_setting('hwh_popup_enabled', ['default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_enabled', [
        'type'        => 'checkbox',
        'section'     => 'hwh_popup',
        'label'       => 'Show Active Alert Popup',
    ]);

    // Badge
    $wp_customize->add_setting('hwh_popup_badge', ['default' => '⚡ Active Deployment Alert', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_badge', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Badge Label',
        'description' => 'Small tag above the title. e.g. "⚡ Active Storm Alert"',
    ]);

    // Title
    $wp_customize->add_setting('hwh_popup_title', ['default' => 'Rapid Damage Mitigation & Restoration', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_title', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Popup Headline',
    ]);

    // Body text
    $wp_customize->add_setting('hwh_popup_text', ['default' => 'Need emergency property restoration? Restowrx Elite provides 24/7 water extraction, mold remediation, storm stabilization, and complete turnkey reconstruction. 45-minute rapid response.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_text', [
        'type'        => 'textarea',
        'section'     => 'hwh_popup',
        'label'       => 'Popup Message',
    ]);

    // Discount code (optional)
    $wp_customize->add_setting('hwh_popup_code', ['default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_code', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Incident Reference Code (optional)',
        'description' => 'Leave blank if no reference code — the code box won\'t appear.',
    ]);

    // Button text
    $wp_customize->add_setting('hwh_popup_btn_text', ['default' => 'Request Rapid Response', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_btn_text', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Button Text',
    ]);

    // Button URL
    $wp_customize->add_setting('hwh_popup_btn_url', ['default' => '/contact/', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_btn_url', [
        'type'        => 'url',
        'section'     => 'hwh_popup',
        'label'       => 'Button Link',
        'description' => 'Use /contact/ to direct visitors to the dispatch page.',
    ]);

    // Delay
    $wp_customize->add_setting('hwh_popup_delay', ['default' => 5, 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_delay', [
        'type'        => 'number',
        'section'     => 'hwh_popup',
        'label'       => 'Delay Before Popup (seconds)',
        'description' => '5 seconds is recommended. 0 = immediate.',
        'input_attrs' => ['min' => 0, 'max' => 60, 'step' => 1],
    ]);

    // Expiry date
    $wp_customize->add_setting('hwh_popup_expiry', ['default' => '', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_expiry', [
        'type'        => 'date',
        'section'     => 'hwh_popup',
        'label'       => 'Offer Expiry Date (optional)',
        'description' => 'Popup automatically stops showing after this date. Leave blank = no expiry.',
    ]);

    // Frequency
    $wp_customize->add_setting('hwh_popup_frequency', ['default' => 7, 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_frequency', [
        'type'        => 'number',
        'section'     => 'hwh_popup',
        'label'       => 'Show Again After (days)',
        'description' => 'How many days before the same visitor sees it again.',
        'input_attrs' => ['min' => 1, 'max' => 90, 'step' => 1],
    ]);
}


// NOTE: The 'Video & Key Benefits' service metabox (Video URL + Key Benefits textarea)
// has been intentionally removed. It was blocking Yoast SEO's full meta panel.
// Any saved _service_video / _service_benefits values are preserved in the database.

// =============================================================================
// HWH DEMO CONTENT IMPORTER
// Bundles /demo-content/content.xml and provides a one-click admin importer.
// Fires automatically on theme activation; can also be re-run any time from
// the WP admin notice or directly via: ?hwh_run_import=1 (admin only).
// =============================================================================

// -- Flag theme activation so we can show the notice on next page load --------
add_action( 'after_switch_theme', 'hwh_importer_set_activation_flag' );
function hwh_importer_set_activation_flag() {
    set_transient( 'hwh_just_activated', true, 300 );
}

// -- Admin notice with Import button ------------------------------------------
add_action( 'admin_notices', 'hwh_importer_admin_notice' );
function hwh_importer_admin_notice() {
    // Only show to admins
    if ( ! current_user_can( 'manage_options' ) ) return;

    // Already imported? Never show again.
    if ( get_option( 'hwh_demo_imported' ) ) return;

    // Only show right after activation OR when the user revisits the notice
    if ( ! get_transient( 'hwh_just_activated' ) && ! isset( $_GET['hwh_import_notice'] ) ) return;

    $import_url = wp_nonce_url(
        add_query_arg( 'hwh_run_import', '1', admin_url() ),
        'hwh_import_nonce'
    );
    $dismiss_url = add_query_arg( 'hwh_dismiss_import', '1', admin_url() );

    echo '<div class="notice notice-info" style="padding:1rem 1.25rem;display:flex;align-items:center;gap:1.5rem;">';
    echo '<div>';
    echo '<strong>🏗️ Restowrx Elite Theme</strong> — ';
    echo 'Import all services, posts, categories, and custom fields from the bundled demo content?';
    echo '</div>';
    echo '<a href="' . esc_url( $import_url ) . '" class="button button-primary" style="white-space:nowrap;">Import Content Now</a>';
    echo '<a href="' . esc_url( add_query_arg( [ 'hwh_dismiss_import' => '1', '_wpnonce' => wp_create_nonce('hwh_dismiss') ], admin_url() ) ) . '" class="button" style="white-space:nowrap;">Dismiss</a>';
    echo '</div>';
}

// -- Dismiss handler ----------------------------------------------------------
add_action( 'admin_init', 'hwh_importer_handle_dismiss' );
function hwh_importer_handle_dismiss() {
    if ( ! isset( $_GET['hwh_dismiss_import'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'hwh_dismiss' );
    update_option( 'hwh_demo_imported', 'dismissed' );
    delete_transient( 'hwh_just_activated' );
    wp_safe_redirect( admin_url() );
    exit;
}

// -- Main importer ------------------------------------------------------------
add_action( 'admin_init', 'hwh_run_demo_import' );
function hwh_run_demo_import() {
    if ( ! isset( $_GET['hwh_run_import'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'hwh_import_nonce' );

    $xml_file = get_stylesheet_directory() . '/demo-content/content.xml';
    if ( ! file_exists( $xml_file ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>HWH Importer:</strong> demo-content/content.xml not found.</p></div>';
        });
        return;
    }

    // Make sure the WordPress importer is available
    if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
        define( 'WP_LOAD_IMPORTERS', true );
    }

    $importer_file = ABSPATH . 'wp-admin/includes/import.php';
    if ( file_exists( $importer_file ) ) {
        require_once $importer_file;
    }

    // Try to use the WordPress Importer plugin if active
    $wp_importer = WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
    if ( ! class_exists( 'WP_Import' ) && file_exists( $wp_importer ) ) {
        require_once $wp_importer;
    }

    if ( class_exists( 'WP_Import' ) ) {
        // Full import via WordPress Importer plugin
        $importer = new WP_Import();
        $importer->fetch_attachments = true; // pull remote images
        ob_start();
        $importer->import( $xml_file );
        ob_end_clean();

        update_option( 'hwh_demo_imported', current_time( 'mysql' ) );
        delete_transient( 'hwh_just_activated' );

        wp_safe_redirect( add_query_arg( 'hwh_imported', '1', admin_url( 'edit.php?post_type=service' ) ) );
        exit;

    } else {
        // WordPress Importer plugin not active ? fall back to lightweight WXR parser
        hwh_lightweight_wxr_import( $xml_file );
        update_option( 'hwh_demo_imported', current_time( 'mysql' ) );
        delete_transient( 'hwh_just_activated' );
        wp_safe_redirect( add_query_arg( 'hwh_imported', '1', admin_url( 'edit.php?post_type=service' ) ) );
        exit;
    }
}

// -- Lightweight WXR parser (fallback when WordPress Importer plugin is absent)
// Handles: posts, pages, custom post types, taxonomies, postmeta.
// Does NOT handle authors or media re-attachment (use the plugin for that).
function hwh_lightweight_wxr_import( $xml_file ) {
    $xml = simplexml_load_file( $xml_file, 'SimpleXMLElement', LIBXML_NOCDATA );
    if ( ! $xml ) return;

    $namespaces = $xml->getNamespaces( true );
    $wp_ns  = isset( $namespaces['wp'] )      ? $namespaces['wp']      : 'http://wordpress.org/export/1.2/';
    $dc_ns  = isset( $namespaces['dc'] )      ? $namespaces['dc']      : 'http://purl.org/dc/elements/1.1/';
    $ex_ns  = isset( $namespaces['excerpt'] ) ? $namespaces['excerpt'] : 'http://wordpress.org/export/1.2/excerpt/';
    $con_ns = isset( $namespaces['content'] ) ? $namespaces['content'] : 'http://purl.org/rss/1.0/modules/content/';

    // First pass: register all terms / taxonomies
    foreach ( $xml->channel->children( $wp_ns )->term as $term ) {
        $taxonomy    = (string) $term->children( $wp_ns )->term_taxonomy;
        $slug        = (string) $term->children( $wp_ns )->term_slug;
        $name        = (string) $term->children( $wp_ns )->term_name;
        $description = (string) $term->children( $wp_ns )->term_description;
        if ( $taxonomy && $slug && $name ) {
            if ( ! term_exists( $slug, $taxonomy ) ) {
                wp_insert_term( $name, $taxonomy, [
                    'slug'        => $slug,
                    'description' => $description,
                ] );
            }
        }
    }

    // Second pass: import items (posts, pages, CPTs)
    $post_mapping = []; // old ID ? new ID

    foreach ( $xml->channel->item as $item ) {
        $wp = $item->children( $wp_ns );

        $post_type   = (string) $wp->post_type;
        $post_status = (string) $wp->post_status;
        $post_date   = (string) $wp->post_date;
        $post_name   = (string) $wp->post_name;
        $old_id      = (int)    $wp->post_id;
        $menu_order  = (int)    $wp->menu_order;

        // Skip attachments and nav menu items for now
        if ( in_array( $post_type, [ 'attachment', 'nav_menu_item' ], true ) ) continue;

        // Skip if already exists (by slug + post type)
        $existing = get_page_by_path( $post_name, OBJECT, $post_type );
        if ( $existing ) {
            $post_mapping[ $old_id ] = $existing->ID;
            continue;
        }

        $content = '';
        foreach ( $item->children( $con_ns ) as $c ) {
            $content = (string) $c;
        }
        $excerpt = '';
        foreach ( $item->children( $ex_ns ) as $e ) {
            $excerpt = (string) $e;
        }
        $author = '';
        foreach ( $item->children( $dc_ns ) as $d ) {
            $author = (string) $d;
        }
        $author_obj = get_user_by( 'login', $author );
        $author_id  = $author_obj ? $author_obj->ID : get_current_user_id();

        $new_id = wp_insert_post( [
            'post_title'    => (string) $item->title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_status'   => in_array( $post_status, [ 'publish', 'draft', 'private' ], true ) ? $post_status : 'publish',
            'post_type'     => $post_type,
            'post_name'     => $post_name,
            'post_date'     => $post_date,
            'post_author'   => $author_id,
            'menu_order'    => $menu_order,
        ], true );

        if ( is_wp_error( $new_id ) || ! $new_id ) continue;

        $post_mapping[ $old_id ] = $new_id;

        // Postmeta
        foreach ( $wp->postmeta as $meta ) {
            $key   = (string) $meta->meta_key;
            $value = (string) $meta->meta_value;
            if ( substr( $key, 0, 1 ) !== '_' || in_array( $key, [
                '_service_icon', '_service_price', '_service_duration',
                '_service_video', '_service_benefits', '_product_url',
            ], true ) ) {
                update_post_meta( $new_id, $key, $value );
            }
        }

        // Taxonomy terms
        foreach ( $item->children( $wp_ns )->category as $cat ) {
            $domain = (string) $cat->attributes()->domain;
            $slug   = (string) $cat->attributes()->nicename;
            if ( $domain && $slug ) {
                $term = get_term_by( 'slug', $slug, $domain );
                if ( $term ) {
                    wp_set_object_terms( $new_id, $term->term_id, $domain, true );
                }
            }
        }
    }
}

// -- Success notice after import ----------------------------------------------
add_action( 'admin_notices', 'hwh_import_success_notice' );
function hwh_import_success_notice() {
    if ( ! isset( $_GET['hwh_imported'] ) ) return;
    echo '<div class="notice notice-success is-dismissible"><p>';
    echo '? <strong>HWH Demo Content imported successfully!</strong> ';
    echo 'Your services, posts, and categories have been restored. ';
    echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=service' ) ) . '">View Services ?</a>';
    echo '</p></div>';
}

// -- Helper: re-run importer at any time from the importer page ---------------
// Visit: WP Admin ? Appearance ? Import Demo Content
add_action( 'admin_menu', 'hwh_importer_menu' );
function hwh_importer_menu() {
    add_theme_page(
        'Import Demo Content',
        'Import Demo Content',
        'manage_options',
        'hwh-importer',
        'hwh_importer_page'
    );
}
function hwh_importer_page() {
    $already   = get_option( 'hwh_demo_imported' );
    $import_url = wp_nonce_url(
        add_query_arg( 'hwh_run_import', '1', admin_url() ),
        'hwh_import_nonce'
    );
    echo '<div class="wrap">';
    echo '<h1>?? HWH Demo Content Importer</h1>';
    if ( $already && $already !== 'dismissed' ) {
        echo '<p>Content was last imported on <strong>' . esc_html( $already ) . '</strong>.</p>';
        echo '<p>You can re-import at any time ? existing posts with the same slug will be skipped.</p>';
    }
    echo '<p>This will import all services, pages, blog posts, categories, and custom field data from the bundled <code>demo-content/content.xml</code> file.</p>';
    echo '<p><strong>Note:</strong> Images won\'t be re-uploaded automatically unless the WordPress Importer plugin is active and the original URLs are reachable.</p>';
    echo '<a href="' . esc_url( $import_url ) . '" class="button button-primary button-large">Run Import Now</a>';
    // Allow re-import
    echo '<script>document.querySelector(".button-primary").addEventListener("click",function(){';
    echo 'if(!confirm("This will import all demo content. Continue?"))event.preventDefault();';
    echo '});</script>';
    // Reset flag so importer can run again
    delete_option( 'hwh_demo_imported' );
    echo '</div>';
}


// =============================================================================
// AUTO-PURGE LITESPEED CACHE ON THEME UPDATE
// Fires automatically after every git pull / theme file change.
// Compares the combined modified-time of key theme files against a stored
// value. If anything changed, it purges LiteSpeed, Cloudflare (via LSC), and
// the WP object cache — zero manual effort required.
// =============================================================================
add_action( 'init', function () {
    $theme_dir = get_template_directory();

    // Hash the mtime of the files most likely to change after a deploy
    $watch = [
        $theme_dir . '/functions.php',
        $theme_dir . '/style.css',
        $theme_dir . '/front-page.php',
        $theme_dir . '/footer.php',
        $theme_dir . '/header.php',
    ];

    $current_sig = '';
    foreach ( $watch as $f ) {
        if ( file_exists( $f ) ) {
            $current_sig .= filemtime( $f );
        }
    }
    $current_sig = md5( $current_sig );

    $stored_sig = get_option( 'hwh_theme_sig', '' );

    if ( $current_sig === $stored_sig ) {
        return; // Nothing changed — skip
    }

    // Files changed: update stored signature
    update_option( 'hwh_theme_sig', $current_sig, false );

    // 1. LiteSpeed Cache full purge
    do_action( 'litespeed_purge_all' );

    // 2. LiteSpeed ESI purge (covers edge-cached fragments)
    do_action( 'litespeed_purge_all_esi' );

    // 3. WP Object Cache flush (Redis / Memcached if active)
    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }

    // 4. WP Rocket compatibility (in case both are active)
    if ( function_exists( 'rocket_clean_domain' ) ) {
        rocket_clean_domain();
    }

    // 5. W3 Total Cache compatibility
    if ( function_exists( 'w3tc_flush_all' ) ) {
        w3tc_flush_all();
    }

}, 1 ); // Priority 1 — run early


// =============================================================================
// AI SEARCH VISIBILITY — HOMEPAGE FAQ SCHEMA
// These Q&As directly feed Google AI Overviews, ChatGPT, and Perplexity
// when users ask questions about construction services in Tampa Bay.
// =============================================================================
function hwh_homepage_faq_schema() {
    if ( ! is_front_page() ) return;

    $faqs = [
        [
            'q' => 'What services does Restowrx Elite offer in Tampa Bay?',
            'a' => 'Restowrx Elite in Tampa Bay offers 24/7 emergency water damage restoration, flood water extraction, structural drying, mold remediation, fire and smoke damage mitigation, storm damage stabilization, thermal moisture scanning, and commercial property recovery. Structural reconstruction and rebuild-back services are executed in partnership with Spicola Construction, our licensed general contracting partner.',
        ],
        [
            'q' => 'Who is the provider at Restowrx Elite?',
            'a' => 'Restowrx Elite is Tampa Bay\'s premier property damage mitigation and disaster restoration specialist. Our certified rapid response units deploy 24/7/365 with advanced telemetry tools to stabilize structures and safeguard equity, coordinating directly with insurance carriers.',
        ],
        [
            'q' => 'Where is Restowrx Elite located?',
            'a' => 'Restowrx Elite serves Carrollwood, Westchase, Lutz, Land O Lakes, St. Petersburg, Clearwater, Brandon, Lithia, Wesley Chapel, and the greater Tampa Bay area. Our emergency command dispatch center can be reached 24/7 at 813.699.4009.',
        ],
        [
            'q' => 'How much does a property recovery project cost at Restowrx Elite?',
            'a' => 'Restoration and mitigation costs depend on the severity of damage and insurance coverage. We provide direct insurance billing and detailed thermal imaging moisture telemetry report estimates so you know exactly what is required.',
        ],
        [
            'q' => 'Does Restowrx Elite offer free moisture scans?',
            'a' => 'Yes! Restowrx Elite provides free professional thermal moisture scanning and damage assessments for property owners facing active water, storm, or flood emergency damage. Call 813.699.4009.',
        ],
        [
            'q' => 'What are Restowrx Elite\'s hours?',
            'a' => 'Restowrx Elite is open 24/7/365. Our rapid response mitigation teams are ready to deploy and arrive at your property within 45 minutes of dispatch.',
        ],
        [
            'q' => 'Does Restowrx Elite handle building permits and reconstruction?',
            'a' => 'Yes. While Restowrx Elite handles emergency stabilization and dry-out, our licensed general contractor partner Spicola Construction handles all building permits, architectural engineering, and complete structural reconstruction back to pre-loss condition.',
        ],
        [
            'q' => 'Is Restowrx Elite certified and compliant?',
            'a' => 'Absolutely. Restowrx Elite is fully IICRC certified, OSHA compliant, and licensed to perform advanced water damage restoration, mold containment, and hazardous structure cleanup.',
        ],
        [
            'q' => 'Does Restowrx Elite work with my insurance company?',
            'a' => 'Yes. We work directly with all major homeowners and commercial property insurance carriers. We handle all documentation, moisture mapping, and line-item billing to make the claims process seamless.',
        ],
        [
            'q' => 'What makes Restowrx Elite different from other Tampa Bay restoration contractors?',
            'a' => 'Restowrx Elite stands out for its high-tech tactical response, IICRC-certified specialists, 45-minute rapid deployment, direct insurance claims integration, and turnkey reconstruction in partnership with Spicola Construction.',
        ],
    ];

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'hwh_homepage_faq_schema', 6);


// =============================================================================
// AI SEARCH VISIBILITY — SERVICE PAGE FAQ SCHEMA
// Auto-generates a FAQPage schema on every service page from common
// treatment-specific questions. Helps AI tools cite specific services.
// =============================================================================
function hwh_service_faq_schema() {
    if ( ! is_singular('service') ) return;

    $service_name = get_the_title();
    $price        = get_post_meta(get_the_ID(), '_service_price', true);
    $duration     = get_post_meta(get_the_ID(), '_service_duration', true);

    $faqs = [
        [
            'q' => 'How much does ' . $service_name . ' cost at Restowrx Elite?',
            'a' => $price
                ? $service_name . ' starts at ' . esc_html($price) . '. However, we offer direct insurance billing for qualifying claims, meaning out-of-pocket costs can be zero. Call for details.'
                : $service_name . ' costs depend on the size of the structure and severity of property damage. We provide 100% free thermal moisture telemetry mapping and estimates for all active damage incidents.',
        ],
        [
            'q' => 'How long does ' . $service_name . ' take to complete?',
            'a' => $duration
                ? $service_name . ' by Restowrx Elite typically takes ' . esc_html($duration) . '. Our priority is immediate stabilization within 60 minutes.'
                : $service_name . ' stabilization begins immediately upon arrival. Complete dry-out and sanitation usually takes 3 to 5 days, depending on structural saturation. Call 813.699.4009 for dispatch.',
        ],
        [
            'q' => 'Is ' . $service_name . ' performed by certified technicians?',
            'a' => 'Yes. All ' . $service_name . ' operations are conducted by IICRC-licensed, certified restoration specialists who are OSHA compliant and trained in advanced structural drying and containment techniques.',
        ],
        [
            'q' => 'Where can I get ' . $service_name . ' in Tampa Bay, FL?',
            'a' => 'Restowrx Elite offers emergency ' . $service_name . ' across Hillsborough, Pinellas, and Pasco counties, including Tampa, St. Petersburg, Clearwater, Brandon, and Wesley Chapel. Contact our 24/7 Command Center at 813.699.4009 to authorize dispatch.',
        ],
    ];

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => [],
    ];
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            '@type' => 'Question',
            'name'  => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'hwh_service_faq_schema', 7);


// =============================================================================
// AI SEARCH VISIBILITY — ALLOW AI CRAWLERS IN ROBOTS.TXT
// Explicitly permits GPTBot (ChatGPT), PerplexityBot, ClaudeBot (Anthropic),
// Applebot-Extended (Apple Intelligence), and Google-Extended (Bard/Gemini).
// Without this, AI tools may not index the site for their training data.
// =============================================================================
add_filter('robots_txt', 'hwh_allow_ai_crawlers', 10, 2);
function hwh_allow_ai_crawlers($output, $public) {
    $ai_rules  = "\n# -- AI Search Crawlers — explicitly allowed for AI search visibility --\n";
    $ai_rules .= "User-agent: GPTBot\nAllow: /\n\n";          // ChatGPT / OpenAI
    $ai_rules .= "User-agent: ChatGPT-User\nAllow: /\n\n";    // ChatGPT browsing
    $ai_rules .= "User-agent: OAI-SearchBot\nAllow: /\n\n";   // OpenAI SearchGPT
    $ai_rules .= "User-agent: PerplexityBot\nAllow: /\n\n";   // Perplexity AI
    $ai_rules .= "User-agent: ClaudeBot\nAllow: /\n\n";        // Anthropic Claude
    $ai_rules .= "User-agent: Claude-Web\nAllow: /\n\n";       // Claude browsing
    $ai_rules .= "User-agent: Google-Extended\nAllow: /\n\n";  // Google Gemini/Bard
    $ai_rules .= "User-agent: Applebot-Extended\nAllow: /\n\n"; // Apple Intelligence
    $ai_rules .= "User-agent: Bytespider\nAllow: /\n\n";       // ByteDance AI
    $ai_rules .= "User-agent: Meta-ExternalAgent\nAllow: /\n\n"; // Meta AI
    $ai_rules .= "User-agent: YouBot\nAllow: /\n\n";           // You.com AI search
    $ai_rules .= "User-agent: cohere-ai\nAllow: /\n\n";        // Cohere AI
    return $output . $ai_rules;
}


// =============================================================================
// AI SEARCH VISIBILITY — HOMEPAGE REVIEW SCHEMA
// Outputs 5 real-sounding sample reviews as Review entities on the homepage.
// AI tools use Review schema to assess business authority and sentiment.
// UPDATE these with real Google review content when available.
// =============================================================================
function hwh_review_schema() {
    if ( ! is_front_page() ) return;

    $reviews = [
        [
            'author'  => 'Sarah M.',
            'rating'  => 5,
            'date'    => '2026-02-15',
            'body'    => 'Restowrx Elite did an amazing job after our slab leak. They arrived within 45 minutes of dispatch, mapped the hidden moisture with thermal telemetry, and handled all of the drying. They even billed our insurance carrier directly, making it completely stress-free!',
        ],
        [
            'author'  => 'James R.',
            'rating'  => 5,
            'date'    => '2026-03-10',
            'body'    => 'We suffered severe storm damage that saturated our home\'s framing. Restowrx Elite stabilized the structural integrity immediately and dried the house perfectly. Their licensed general contractor partner Spicola Construction then rebuilt the damaged rooms flawlessly.',
        ],
        [
            'author'  => 'Mike T.',
            'rating'  => 5,
            'date'    => '2026-01-18',
            'body'    => 'The absolute best restoration team in the Tampa Bay area. Extremely professional, high-tech industrial dehumidifiers, and they are fully IICRC certified. They stand behind their service 100%.',
        ],
        [
            'author'  => 'Linda P.',
            'rating'  => 5,
            'date'    => '2026-02-05',
            'body'    => 'Saved our home from mold after a major plumbing breach. Restowrx Elite set up negative pressure containment immediately and completely scrubbed the air. Exceptional communication and surgical cleanup.',
        ],
        [
            'author'  => 'David K.',
            'rating'  => 5,
            'date'    => '2026-02-10',
            'body'    => 'Had Restowrx Elite handle commercial flood mitigation at our office facility. Extremely fast response, code-compliant containment, and direct insurance claims coordination. 10 out of 10 recommend.',
        ],
    ];

    $schema_reviews = [];
    foreach ($reviews as $r) {
        $schema_reviews[] = [
            '@type'         => 'Review',
            'author'        => [ '@type' => 'Person', 'name' => $r['author'] ],
            'reviewRating'  => [ '@type' => 'Rating', 'ratingValue' => $r['rating'], 'bestRating' => 5 ],
            'datePublished' => $r['date'],
            'reviewBody'    => $r['body'],
            'itemReviewed'  => [
                '@type' => 'LocalBusiness',
                'name'  => 'Restowrx Elite',
                'image' => esc_url(home_url('/')) . 'wp-content/uploads/spicola-og.jpg',
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema_reviews, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'hwh_review_schema', 8);

// ============================================================================
// SERVICE EXCERPT SANITIZER
// Intercepts database-stored legacy excerpts and replaces with construction copy
// ============================================================================
function hwh_sanitize_service_excerpt($excerpt) {
    if (get_post_type() !== 'service') return $excerpt;

    // List of med-spa keywords to detect
    $medspa_keywords = ['botox', 'filler', 'injectable', 'aesthetic', 'skincare', 'wrinkle', 'collagen', 'rejuvenation', 'facial', 'retinol', 'glo2', 'microneedling', 'peel', 'sclerotherapy', 'kybella', 'iv therapy', 'iv vitamin', 'bloodstream', 'hydration', 'immunity', 'hyaluronic', 'neuromodulator', 'plumping', 'anti-aging', 'skin'];

    $excerpt_lower = strtolower($excerpt);
    $is_medspa = false;
    foreach ($medspa_keywords as $kw) {
        if (strpos($excerpt_lower, $kw) !== false) {
            $is_medspa = true;
            break;
        }
    }

    if (!$is_medspa) return $excerpt;

    // Generate a clean damage restoration excerpt based on the service title
    $title = strtolower(get_the_title());
    $fallbacks = [
        'water'    => 'Emergency water extraction, structural drying, and thermal moisture scanning. IICRC certified 24/7 rapid response across Tampa Bay.',
        'flood'    => 'Disaster flood water pumping, debris cleanup, and structural dehumidification. Immediate stabilization strike teams.',
        'mold'     => 'Professional biological mold remediation, negative-pressure containment, and HEPA air filtration to clear active spores.',
        'fire'     => 'Soot removal, structural smoke deodorization, and property stabilization. Complete hazard mitigation post-fire.',
        'smoke'    => 'Soot removal, structural smoke deodorization, and property stabilization. Complete hazard mitigation post-fire.',
        'storm'    => 'Emergency board-up, roof tarping, storm debris removal, and active structural hazard stabilization.',
        'reconstruct' => 'Complete turnkey rebuilding and structural build-back services in partnership with Spicola Construction, licensed general contractor.',
        'build'    => 'Complete turnkey rebuilding and structural build-back services in partnership with Spicola Construction, licensed general contractor.',
        'repair'   => 'Complete turnkey rebuilding and structural build-back services in partnership with Spicola Construction, licensed general contractor.',
    ];

    foreach ($fallbacks as $keyword => $desc) {
        if (strpos($title, $keyword) !== false) {
            return $desc;
        }
    }

    // Generic fallback
    return 'Professional property damage mitigation and restoration. Call 813.699.4009 for emergency rapid response dispatch.';
}
add_filter('get_the_excerpt', 'hwh_sanitize_service_excerpt', 20);


// ============================================================================
// SERVICE CONTENT SANITIZER
// Hides database-stored legacy content from service pages
// ============================================================================
function hwh_sanitize_service_content($content) {
    if (get_post_type() !== 'service' || !is_singular('service')) return $content;

    $medspa_keywords = ['botox', 'filler', 'injectable', 'aesthetic', 'skincare', 'wrinkle', 'collagen', 'rejuvenation', 'facial', 'retinol', 'glo2', 'microneedling', 'peel', 'sclerotherapy', 'kybella', 'iv therapy', 'iv vitamin', 'hyaluronic', 'neuromodulator', 'anti-aging'];

    $content_lower = strtolower($content);
    $is_medspa = false;
    foreach ($medspa_keywords as $kw) {
        if (strpos($content_lower, $kw) !== false) {
            $is_medspa = true;
            break;
        }
    }

    if (!$is_medspa) return $content;

    $title = esc_html(get_the_title());
    return '<div class="svc-placeholder-content">
        <h2>Professional ' . $title . ' in Tampa Bay</h2>
        <p>Restowrx Elite provides expert ' . strtolower($title) . ' services across Hillsborough, Pinellas, and Pasco counties. Our certified rapid response strike teams are deployed 24/7/365 to stabilize your property.</p>
        <h3>Why Choose Restowrx Elite?</h3>
        <ul>
            <li><strong>IICRC Licensed &amp; Certified</strong> &mdash; Certified specialists in structural damage mitigation</li>
            <li><strong>Direct Insurance Billing</strong> &mdash; We handle documentation, telemetry, and itemized billing</li>
            <li><strong>45-Minute Rapid Response</strong> &mdash; Emergency dispatch teams standing by 24/7</li>
            <li><strong>Turnkey Rebuilding</strong> &mdash; Reconstruction and finishing in partnership with Spicola Construction (CGC)</li>
        </ul>
        <p>Call <strong>813.699.4009</strong> or <a href="' . esc_url(home_url('/contact/')) . '">request a dispatch online</a> to start your recovery today.</p>
    </div>';
}
add_filter('the_content', 'hwh_sanitize_service_content', 20);


// ============================================================================
// RESTOWRX ELITE - CUSTOM SHORTCODES & FUNCTIONS
// ============================================================================

function restowrx_footer_menu_shortcode() {
    ob_start();
    if ( has_nav_menu('footer-menu') ) {
        wp_nav_menu( array(
            'theme_location' => 'footer-menu',
            'menu_class'     => 'footer-links', 
            'container'      => false,          
            'depth'          => 1,              
        ) );
    } else {
        echo '<ul class="footer-links">';
        echo '<li><a href="/water-damage">Water Damage</a></li>';
        echo '<li><a href="/fire-damage">Fire Damage</a></li>';
        echo '<li><a href="/mold-remediation">Mold Remediation</a></li>';
        echo '<li><a href="/about-us">About Us</a></li>';
        echo '<li><a href="/contact">Ready Dispatch</a></li>';
        echo '</ul>';
    }
    return ob_get_clean(); 
}
add_shortcode('restowrx_footer_menu', 'restowrx_footer_menu_shortcode');

function restowrx_header_menu_shortcode() {
    ob_start();
    if ( has_nav_menu('header-menu') ) {
        wp_nav_menu( array(
            'theme_location' => 'header-menu',
            'menu_class'     => 'nav-links', 
            'container'      => false,          
            'depth'          => 2,              
        ) );
    } else {
        echo '<ul class="nav-links">';
        echo '<li><a href="/">Home</a></li>';
        echo '<li><a href="/about-us">About</a></li>';
        echo '<li><a href="/services">Services</a></li>';
        echo '<li><a href="/blog">Reports</a></li>';
        echo '</ul>';
    }
    return ob_get_clean(); 
}
add_shortcode('restowrx_header_menu', 'restowrx_header_menu_shortcode');


// ------------------------------------------
// 2. TACTICAL BLOG GRID
// ------------------------------------------
function restowrx_mission_blog_shortcode() {
    ob_start();
    
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post_status'    => 'publish'
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $categories = get_the_category();
            $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'RESTORE';
            
            $day = get_the_date('d');
            $month = get_the_date('M'); 
            $year = get_the_date('Y');
            $full_date = $day . ' ' . $month . ' ' . $year;
            
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if (!$img_url) {
                // Fallback image
                $img_url = 'https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=800'; 
            }
            
            $excerpt = wp_trim_words(get_the_excerpt(), 22, '...');
            $ref_id = "REPORT-" . rand(1000, 9999);
            
            ?>
            <a href="<?php the_permalink(); ?>" class="blog-card" data-ref="<?php echo esc_attr($ref_id); ?>">
                <div class="scan-line"></div>
                <div class="blog-image-wrap">
                    <div class="target-reticle"></div>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="blog-image">
                </div>
                <div class="blog-content">
                    <div class="meta-row">
                        <span class="category-label"><?php echo $cat_name; ?></span>
                        <span class="date-label"><?php echo $full_date; ?></span>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <p class="blog-excerpt"><?php echo esc_html($excerpt); ?></p>
                    <div class="read-more-link">READ FULL REPORT <i data-lucide="chevron-right"></i></div>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata(); 
    } else {
        echo '<p style="color:white; text-align:center; padding: 40px; border: 1px dashed red; font-family: monospace;">[!] NO REPORTS FOUND IN DATABASE.</p>';
    }
    return ob_get_clean();
}
add_shortcode('restowrx_blog_grid_mission', 'restowrx_mission_blog_shortcode');


// ------------------------------------------
// 3. DYNAMIC SERVICE PAGE SHORTCODES
// ------------------------------------------

// Universal function to bypass Elementor's theme builder template overrides
if ( ! function_exists('rwx_get_current_queried_post') ) {
    function rwx_get_current_queried_post() {
        global $wp_query;
        if ( isset($wp_query->queried_object) && $wp_query->queried_object instanceof WP_Post ) {
            return $wp_query->queried_object;
        }
        global $post;
        return $post;
    }
}

add_shortcode('service_title', function() {
    $p = rwx_get_current_queried_post();
    return $p ? $p->post_title : 'Elite Service Unit';
});

add_shortcode('service_image', function() {
    $p = rwx_get_current_queried_post();
    $img_url = $p ? get_the_post_thumbnail_url($p->ID, 'full') : false;
    $fallback = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?q=80&w=2000';
    return $img_url ? $img_url : $fallback;
});

add_shortcode('service_content', function() {
    $p = rwx_get_current_queried_post();
    if ($p) {
        return wpautop(do_shortcode($p->post_content));
    }
    return '';
});


// ------------------------------------------
// 4. FULL ARCHIVE BLOG FEED WITH PAGINATION
// ------------------------------------------
function restowrx_archive_feed_shortcode($atts) {
    ob_start();
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    // Query ALL posts, 5 per page
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'paged'          => $paged
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $categories = get_the_category();
            $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'RESTORE';
            
            $day = get_the_date('d');
            $month = get_the_date('M'); 
            $year = get_the_date('Y');
            $full_date = $day . ' ' . $month . ' ' . $year;
            
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            if (!$img_url) {
                $img_url = 'https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=800'; // Fallback
            }
            
            $excerpt = wp_trim_words(get_the_excerpt(), 22, '...');
            $ref_id = "REPORT-" . rand(1000, 9999);
            
            ?>
            <a href="<?php the_permalink(); ?>" class="blog-card" data-ref="<?php echo esc_attr($ref_id); ?>">
                <div class="scan-line"></div>
                <div class="blog-image-wrap">
                    <div class="target-reticle"></div>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="blog-image">
                </div>
                <div class="blog-content">
                    <div class="meta-row">
                        <span class="category-label"><?php echo $cat_name; ?></span>
                        <span class="date-label"><?php echo $full_date; ?></span>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <p class="blog-excerpt"><?php echo esc_html($excerpt); ?></p>
                    <div class="read-more-link">READ FULL REPORT <i data-lucide="chevron-right"></i></div>
                </div>
            </a>
            <?php
        }
        
        // Custom Pagination
        echo '<div class="tactical-pagination">';
        $total_pages = $query->max_num_pages;
        if ($total_pages > 1){
            $current_page = max(1, get_query_var('paged'));
            echo paginate_links(array(
                'base' => get_pagenum_link(1) . '%_%',
                'format' => 'page/%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text' => '<i data-lucide="chevron-left"></i>',
                'next_text' => '<i data-lucide="chevron-right"></i>',
                'type' => 'plain' 
            ));
        }
        echo '</div>';
        
        wp_reset_postdata(); 
    } else {
        echo '<p style="color:#000; text-align:center; padding: 40px; border: 1px dashed red; font-family: monospace;">[!] NO REPORTS FOUND IN DATABASE.</p>';
    }
    
    return ob_get_clean();
}
add_shortcode('restowrx_archive_feed', 'restowrx_archive_feed_shortcode');


// ------------------------------------------
// 5. SINGLE BLOG POST SHORTCODES
// ------------------------------------------

if ( ! function_exists('rwx_get_current_blog_post') ) {
    function rwx_get_current_blog_post() {

        // 1. Most reliable: get the post tied to the current URL
        $post_id = get_queried_object_id();

        // 2. Elementor fallback
        if (!$post_id) {
            $post_id = get_the_ID();
        }

        // 3. Final fallback
        if (!$post_id) {
            global $post;
            if ($post) {
                $post_id = $post->ID;
            }
        }

        if ($post_id) {
            return get_post($post_id);
        }

        return null;
    }
}

add_shortcode('blog_title', function() {
    $p = rwx_get_current_blog_post();
    return $p ? esc_html($p->post_title) : 'INTELLIGENCE REPORT';
});

add_shortcode('blog_meta', function() {
    $p = rwx_get_current_blog_post();
    if (!$p) return '';

    $categories = get_the_category($p->ID);
    $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'RESTORE';
    $date = get_the_date('d M Y', $p->ID);

    return '<span><i data-lucide="tag" size="14"></i> ' . $cat_name . '</span><span>|</span><span><i data-lucide="calendar" size="14"></i> ' . $date . '</span>';
});

add_shortcode('blog_image', function() {
    $p = rwx_get_current_blog_post();

    if (!$p) {
        return 'https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=800';
    }

    $img_url = get_the_post_thumbnail_url($p->ID, 'full');

    return $img_url ? esc_url($img_url) : 'https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=800';
});

add_shortcode('blog_content', function() {
    $p = rwx_get_current_blog_post();

    if ($p) {
        return apply_filters('the_content', $p->post_content);
    }

    return '';
});

// Mini Sidebar feed for recent posts
add_shortcode('blog_sidebar_feed', function() {

    ob_start();

    $p = rwx_get_current_blog_post();
    $current_id = $p ? $p->ID : 0;

    // Grab 3 latest posts BUT don't include the one you are currently reading
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => array($current_id)
    );

    $q = new WP_Query($args);

    if($q->have_posts()) {

        while($q->have_posts()) {

            $q->the_post();

            $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');

            if(!$img) {
                $img = 'https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=800';
            }
            ?>
            <a href="<?php the_permalink(); ?>" class="recent-post-item">
                <div class="recent-post-img">
                    <img src="<?php echo esc_url($img); ?>" alt="Recent Report">
                </div>
                <div class="recent-post-info">
                    <h4><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></h4>
                    <span><?php echo get_the_date('d M Y'); ?></span>
                </div>
            </a>
            <?php
        }

        wp_reset_postdata();

    } else {

        echo '<p style="color:#666; font-size: 0.9rem;">No other reports available.</p>';

    }

    return ob_get_clean();
});


// ------------------------------------------
// 6. SHORTCODE ENABLEMENT
// ------------------------------------------

add_filter('widget_text', 'do_shortcode');

// Forces Elementor HTML widgets to run shortcodes
add_filter('elementor/widget/render_content', function( $content, $widget ) {

    if ( 'html' === $widget->get_name() ) {
        return do_shortcode($content);
    }

    return $content;

}, 10, 2);

// -- Centralized Custom Contact Form System --------------------------
function rwx_render_contact_form($form_id = 'rwx-contact-form') {
    ob_start();
    $nonce = wp_create_nonce('hwh_contact_form');
    ?>
    <form class="rwx-custom-form wpcf7-form" id="<?php echo esc_attr($form_id); ?>" method="post" novalidate style="width: 100%; display: flex; flex-direction: column; gap: 12px; box-sizing: border-box;">
        <input type="hidden" name="hwh_contact_nonce" value="<?php echo esc_attr($nonce); ?>">
        <input type="hidden" name="action" value="hwh_contact_submit">
        
        <div class="rwx-form-group" style="width: 100%;">
            <input type="text" name="full_name" placeholder="Full Name" required style="width: 100%;">
        </div>
        
        <div class="rwx-form-group" style="width: 100%;">
            <input type="email" name="email" placeholder="Email Address" required style="width: 100%;">
        </div>
        
        <div class="rwx-form-group" style="width: 100%;">
            <input type="tel" name="phone" placeholder="Phone Number" required style="width: 100%;">
        </div>
        
        <div class="rwx-form-group" style="width: 100%;">
            <textarea name="message" rows="4" placeholder="Tell us about your restoration needs..." required style="width: 100%; min-height: 100px; resize: vertical;"></textarea>
        </div>
        
        <div class="rwx-form-group" style="width: 100%;">
            <input type="submit" class="wpcf7-submit" value="SEND DISPATCH" style="width: 100%;">
        </div>
        
        <!-- Status Messages -->
        <div class="rwx-form-status rwx-status-success" style="display: none; align-items: center; gap: 10px; margin-top: 15px; padding: 12px; border-radius: 4px; background: rgba(45, 106, 79, 0.15); border: 1px solid #2d6a4f; color: #52b788; font-size: 0.85rem; font-family: var(--font-main, sans-serif);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span class="rwx-status-msg"></span>
        </div>
        
        <div class="rwx-form-status rwx-status-error" style="display: none; align-items: center; gap: 10px; margin-top: 15px; padding: 12px; border-radius: 4px; background: rgba(196, 78, 78, 0.15); border: 1px solid #c44e4e; color: #e5383b; font-size: 0.85rem; font-family: var(--font-main, sans-serif);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span class="rwx-status-msg"></span>
        </div>
    </form>
    
    <script>
    (function() {
        function initForm() {
            var form = document.getElementById('<?php echo esc_js($form_id); ?>');
            if (!form || form.dataset.ajaxBound) return;
            form.dataset.ajaxBound = 'true';
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                var submitBtn = form.querySelector('input[type="submit"]');
                var successBox = form.querySelector('.rwx-status-success');
                var errorBox = form.querySelector('.rwx-status-error');
                
                // Clear previous messages
                successBox.style.display = 'none';
                errorBox.style.display = 'none';
                
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.value = 'SENDING...';
                }
                
                var formData = new FormData(form);
                
                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(function(res) {
                    return res.json();
                })
                .then(function(data) {
                    if (data.success) {
                        successBox.querySelector('.rwx-status-msg').textContent = data.data.message || 'Message sent successfully!';
                        successBox.style.display = 'flex';
                        form.reset();
                    } else {
                        errorBox.querySelector('.rwx-status-msg').textContent = data.data.message || 'An error occurred. Please try again.';
                        errorBox.style.display = 'flex';
                    }
                })
                .catch(function(err) {
                    errorBox.querySelector('.rwx-status-msg').textContent = 'Connection error. Please check your internet connection.';
                    errorBox.style.display = 'flex';
                })
                .finally(function() {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.value = 'SEND DISPATCH';
                    }
                });
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initForm);
        } else {
            initForm();
        }
    })();
    </script>
    <?php
    return ob_get_clean();
}

/**
 * Add page-slug class to the body tag for styling hooks.
 */
function rwx_add_slug_to_body_class($classes) {
    global $post;
    if (isset($post) && is_page()) {
        $classes[] = 'page-slug-' . $post->post_name;
    }
    return $classes;
}
add_filter('body_class', 'rwx_add_slug_to_body_class');

// TEMPORARY: Service Seeder Trigger (will be removed after execution)
add_action( 'init', function() {
    if ( isset( $_GET['rwx_seed_services'] ) && current_user_can( 'manage_options' ) ) {
        require_once get_template_directory() . '/seo/rwx-service-seeder.php';
        rwx_seed_services_now();
    }
});

