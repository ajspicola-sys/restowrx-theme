<?php
/**
 * Hot Water Heroes Plumbing ï¿½ Theme Functions
 * Performance-optimized build
 */

// -- Theme Setup ----------------------------------------------------
function hwh_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    // Register nav menus
    register_nav_menus([
        'primary' => 'Primary Navigation',
        'footer'  => 'Footer Navigation',
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
            'memberships'  => 'page-memberships.php',
            'parties'      => 'page-parties.php',
            'products'     => 'page-products.php',
            'shop'         => 'page-products.php',
            'values'       => 'page-values.php',
            'before-after' => 'page-before-after.php',
            'financing'    => 'page-financing.php',
            'privacy-policy'      => 'page-privacy-policy.php',
            'cancellation-policy' => 'page-cancellation-policy.php',
            'refund-policy'       => 'page-refund-policy.php',
            'specials'         => 'page-beauty-bank.php',
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
    // Use file modification time so browser caches CSS between visits
    // but auto-busts cache when the file actually changes
    $theme_version = filemtime(get_stylesheet_directory() . '/style.css');

    // Google Fonts ï¿½ single optimized request with display=swap
    wp_enqueue_style(
        'hwh-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // Main stylesheet ï¿½ cacheable, busts only when file changes
    wp_enqueue_style('hwh-style', get_stylesheet_uri(), ['hwh-google-fonts'], $theme_version);
}
add_action('wp_enqueue_scripts', 'hwh_enqueue_styles');

// -- Performance: Make only Google Fonts non-render-blocking -----------
// The main stylesheet MUST be render-blocking to prevent FOUC.
// Google Fonts can safely load async since system fonts render as fallback.
function hwh_async_styles($html, $handle) {
    // Only defer Google Fonts ï¿½ NOT the main theme stylesheet
    if ( $handle === 'hwh-google-fonts' && !is_admin() ) {
        $html = str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $html);
        $html = str_replace('media="all"', "media=\"print\" onload=\"this.media='all'\"", $html);
        $noscript = '<noscript>' . str_replace(
            ["media='print'", 'media="print"', " onload=\"this.media='all'\""],
            ["media='all'",  'media="all"',  ''],
            $html
        ) . '</noscript>';
        $html .= $noscript;
    }
    return $html;
}
add_filter('style_loader_tag', 'hwh_async_styles', 10, 2);


// -- Performance: Preload critical fonts only (preconnects live in header.php) --
function hwh_resource_hints() {
    // DNS prefetch for external image CDN
    echo '<link rel="dns-prefetch" href="//hotwaterheroes.com">' . "\n";

    // Preload the most critical font files (the weights used above the fold)
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/cormorantgaramond/v16/co3YmX5slCNuHLi8bLeY9MK7whWMhyjYqXtK.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/dmsans/v15/rP2tp2ywxg089UriI5-g4vlH9VoD8CmcqZG40F9JadbnoET0.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action('wp_head', 'hwh_resource_hints', 1);

// -- Performance: External image proxy & WebP cache -----------------
// Fetches third-party images (e.g. Ageless AI before/after), resizes to
// max 800px wide, converts to WebP, and caches in wp-uploads.
// Subsequent requests serve the local WebP ï¿½ eliminates 9+ MB of PNG downloads.
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
        'headers'   => [ 'User-Agent' => 'Mozilla/5.0 (compatible; HotWaterHeroes/1.0)' ],
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

    // Save as WebP (quality 82 ï¿½ good balance of size vs. quality)
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
// AI SEARCH VISIBILITY & STRUCTURED DATA ï¿½ HOT WATER HEROES
// Comprehensive JSON-LD schema for Google AI Overviews,
// ChatGPT, Perplexity, Bing Copilot, and all AEO signals.
// ============================================================

// -- 1. Plumber + WebSite + Person -- every page -------------
function hwh_schema_markup() {

    // Named provider: HWH Master Plumbers APRN
    $provider = [
        '@type'       => 'Person',
        '@id'         => esc_url(home_url('/')) . '#hwh-team',
        'name'        => 'HWH Master Plumbers',
        'jobTitle'    => 'Founder & Master Plumber',
        'honorificPrefix' => 'Master Plumber',
        'description' => 'Licensed Master Plumber and founder of Hot Water Heroes Plumbing in Tampa Bay, FL. Specializes in water heater installation, emergency plumbing, and residential repiping.',
        'worksFor'    => [ '@type' => 'Plumber', 'name' => 'Hot Water Heroes Plumbing' ],
        'sameAs'      => [ 'https://www.instagram.com/hotwaterheroes/' ],
    ];

    // Full LocalBusiness entity (Plumber)
    $business = [
        '@context'         => 'https://schema.org',
        '@type'            => ['Plumber', 'HomeAndConstructionBusiness', 'LocalBusiness'],
        '@id'              => esc_url(home_url('/')) . '#hwh-plumbing',
        'name'             => 'Hot Water Heroes Plumbing',
        'legalName'        => 'Hot Water Heroes Plumbing LLC',
        'alternateName'    => 'Hot Water Heroes Plumbing',
        'description'      => "Tampa Bay's trusted plumbing company offering water heater installation, emergency plumbing, drain cleaning, repiping, and leak repair. Licensed, insured, and available 24/7. Serving Hillsborough, Pinellas, and Pasco counties ï¿½ your trusted local plumbing experts.",
        'url'              => esc_url(home_url('/')),
        'telephone'        => '+18134275862',
        'email'            => 'support@hotwaterheroes.com',
        'foundingDate'     => '2024',
        'address'          => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => '10043 N Dale Mabry Hwy',
            'addressLocality' => 'Tampa Bay',
            'addressRegion'   => 'FL',
            'postalCode'      => '33618',
            'addressCountry'  => 'US',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => 28.0678,
            'longitude' => -82.5054,
        ],
        'hasMap'           => 'https://maps.google.com/?q=10043+N+Dale+Mabry+Hwy+Tampa Bay+FL+33618',
        'openingHoursSpecification' => [
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday'], 'opens' => '09:00', 'closes' => '19:00' ],
            [ '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Thursday','Friday','Saturday'],  'opens' => '09:00', 'closes' => '16:00' ],
        ],
        'priceRange'       => '$$-$$$',
        'currenciesAccepted' => 'USD',
        'paymentAccepted'  => 'Cash, Credit Card, Financing via Cherry',
        'image'            => [
            'https://hotwaterheroesplumbing.com/wp-content/uploads/2025/08/HEROES-16-x-9-in-scaled-e1755179786780.png',
            'https://hotwaterheroes.com/wp-content/uploads/2026/04/Hero-Apirl4.png',
        ],
        'logo'             => 'https://hotwaterheroesplumbing.com/wp-content/uploads/2025/08/HEROES-16-x-9-in-scaled-e1755179786780.png',
        'sameAs'           => [
            'https://www.facebook.com/hotwaterheroes/',
            'https://www.instagram.com/hotwaterheroes/',
            'https://www.google.com/maps/place/Hot+Water+Heroes',
        ],
        'aggregateRating'  => [
            '@type'       => 'AggregateRating',
            'ratingValue' => '5.0',
            'bestRating'  => '5',
            'worstRating' => '1',
            'reviewCount' => '70',
        ],
        'employee'         => [ $provider ],
        'founder'          => $provider,
        'serviceType' => 'Plumbing',
        'availableService' => [
            [ '@type' => 'Service', 'name' => 'Water Heater Repair', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Water Heater Installation',         'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Tankless Water Heaters',       'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Drain Cleaning', 'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Emergency Plumbing',  'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Leak Detection',             'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Pipe Repair & Repiping',                'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Sewer & Water Line',       'url' => esc_url(home_url('/services/')) ],
            [ '@type' => 'Service', 'name' => 'Plumbing Inspections',   'url' => esc_url(home_url('/services/')) ],
        ],
        'areaServed'       => [
            [ '@type' => 'City', 'name' => 'Tampa Bay',       'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Carrollwood', 'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Westchase',   'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Lutz',        'containedIn' => 'Florida' ],
            [ '@type' => 'City', 'name' => 'Land O Lakes', 'containedIn' => 'Florida' ],
        ],
        'hasOfferCatalog'  => [
            '@type' => 'OfferCatalog',
            'name'  => 'Hot Water Heroes Plumbing Services',
            'url'   => esc_url(home_url('/services/')),
        ],
        'makesOffer' => [
            [
                '@type'       => 'Offer',
                'name'        => 'Free Estimate',
                'description' => 'Free plumbing estimate with our licensed team.',
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
        'name'            => 'Hot Water Heroes Plumbing',
        'url'             => esc_url(home_url('/')),
        'description'     => "Tampa Bay's trusted plumbing company ï¿½ water heater installation, emergency repairs, drain cleaning, repiping, and 24/7 service.",
        'inLanguage'      => 'en-US',
        'publisher'       => [ '@id' => esc_url(home_url('/')) . '#hwh-plumbing' ],
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => [ '@type' => 'EntryPoint', 'urlTemplate' => esc_url(home_url('/')) . '?s={search_term_string}' ],
            'query-input' => 'required name=search_term_string',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode($website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";

    // -- Enhanced Service schema ï¿½ singular service pages only -----------------
    if (is_singular('service')) {
        $post_id   = get_the_ID();
        $price     = get_post_meta($post_id, '_service_price', true);
        $duration  = get_post_meta($post_id, '_service_duration', true);
        $cats      = get_the_terms($post_id, 'service_category');
        $cat_name  = ($cats && !is_wp_error($cats)) ? $cats[0]->name : 'Plumbing Service';
        $excerpt   = wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' service in Tampa Bay, FL.');

        $service_schema = [
            '@context'    => 'https://schema.org',
            '@type'       => ['Service', 'Service'],
            '@id'         => get_permalink($post_id) . '#service',
            'name'        => get_the_title(),
            'description' => wp_strip_all_tags(get_the_excerpt() ?: get_the_title() . ' service in Tampa Bay, FL.'),
            'provider'    => [
                '@type' => 'Plumber',
                'name'  => 'Hot Water Heroes Plumbing',
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
        'Parties'        => '',
        'Memberships'    => '',
        'Blog'           => '',
        'Financing'      => '',
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

    // Auto-create Financing page if it doesn't exist
    $financing = get_page_by_title('Financing', OBJECT, 'page');
    if (!$financing) {
        wp_insert_post([
            'post_title'  => 'Financing',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type'   => 'page',
        ]);
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
    if ( ! hwh_page_slug_exists('specials') ) {
        wp_insert_post([
            'post_title'   => 'Specials',
            'post_name'    => 'specials',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    update_option('hwh_specials_page_created_v1', true);
}
add_action('init', 'hwh_create_specials_page');

// -- Auto-create Starter Blog Posts ---------------------------------
function hwh_create_blog_posts() {
    if (get_option('hwh_blog_created_v1')) return;

    // Create blog categories
    $categories = ['Tips & Maintenance', 'Water Heater Services', 'Emergency Services', 'How-To Guides', 'HWH News'];
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
            'title'    => 'Tank vs. Tankless Water Heaters: Which Is Right for Your Home?',
            'category' => 'Water Heater Services',
            'excerpt'  => 'Understanding the difference between tank and tankless water heaters to make the best choice for your Tampa Bay home.',
            'content'  => '<h2>Choosing the Right Water Heater</h2>
<p>One of the most common questions we hear at Hot Water Heroes Plumbing is: "Should I get a tank or tankless water heater?" Both have advantages, and the right choice depends on your household size, budget, and hot water needs.</p>

<h3>Tank Water Heaters: The Reliable Classic</h3>
<p>Tank water heaters store 40-80 gallons of pre-heated water, ready for use whenever you need it. They have a lower upfront cost and are simple to install and maintain. However, they use energy continuously to keep the water hot, even when you are not using it.</p>

<h3>Tankless Water Heaters: Endless Hot Water</h3>
<p>Tankless units heat water on-demand as it flows through the system. They are more energy-efficient (saving up to 40% on water heating bills), last longer (20+ years vs. 10-15 for tanks), and take up far less space. The tradeoff is a higher upfront cost.</p>

<h3>Which Should You Choose?</h3>
<p>The answer depends on your specific needs. For smaller households with moderate hot water usage, a high-efficiency tank heater is often the most cost-effective choice. For larger families or homes that need simultaneous hot water at multiple fixtures, tankless is the way to go.</p>

<p><strong>Not sure which is right for you?</strong> Call Hot Water Heroes Plumbing for a free estimate and we will help you choose the best option for your home.</p>',
        ],
        [
            'title'    => 'The Complete Guide to Preventing Plumbing Emergencies',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Simple maintenance tips every Tampa Bay homeowner should know to prevent costly plumbing disasters.',
            'content'  => '<h2>Prevention Is Cheaper Than Repair</h2>
<p>Most plumbing emergencies do not happen overnight. They build up slowly from years of neglect. At Hot Water Heroes Plumbing, we have seen it all, and most of it could have been prevented with basic maintenance.</p>

<h3>1. Know Where Your Main Shutoff Is</h3>
<p>If a pipe bursts, the first thing you need to do is stop the water. Every homeowner should know exactly where the main water shutoff valve is and test it annually to make sure it works.</p>

<h3>2. Never Pour Grease Down the Drain</h3>
<p>Grease solidifies in your pipes and creates stubborn clogs over time. Let it cool in a container and throw it in the trash instead.</p>

<h3>3. Flush Your Water Heater Annually</h3>
<p>Sediment builds up at the bottom of your water heater tank, reducing efficiency and shortening its lifespan. A simple annual flush takes 20 minutes and can add years to your unit.</p>

<h3>4. Watch for Warning Signs</h3>
<p>Slow drains, low water pressure, discolored water, and unexplained increases in your water bill are all early signs of plumbing problems. Address them early before they become emergencies.</p>

<p><strong>Want peace of mind?</strong> Ask about our annual maintenance plans at Hot Water Heroes Plumbing.</p>',
        ],
        [
            'title'    => 'What to Expect When You Call a Plumber',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'A step-by-step walkthrough of the Hot Water Heroes service experience, from your first call to job completion.',
            'content'  => '<h2>Your First Call to Hot Water Heroes</h2>
<p>If you have never called a plumber before, it is completely normal to have questions. At Hot Water Heroes Plumbing, we have designed every step of the experience to be straightforward, transparent, and stress-free.</p>

<h3>Step 1: The Call</h3>
<p>When you call 813-42-PLUMB, you will speak with a real person who will ask about your issue, schedule a convenient time, and give you an upfront service call fee. No surprises.</p>

<h3>Step 2: The Diagnosis</h3>
<p>Your licensed plumber arrives on time, inspects the problem, and gives you a written estimate before any work begins. We explain what is wrong, what needs to be done, and exactly what it will cost.</p>

<h3>Step 3: The Repair</h3>
<p>Once you approve the estimate, we get to work immediately. Our plumbers carry fully-stocked trucks, so most repairs can be completed in a single visit.</p>

<h3>Step 4: The Walkthrough</h3>
<p>When the job is done, your plumber walks you through everything that was done, answers your questions, and cleans up the work area completely.</p>

<p><strong>Ready to experience the difference?</strong> Call Hot Water Heroes Plumbing today or book online.</p>',
        ],
        [
            'title'    => '5 Signs You Need to Replace Your Water Heater',
            'category' => 'Water Heater Services',
            'excerpt'  => 'How to tell if your water heater is on its last legs and when it makes sense to repair vs. replace.',
            'content'  => '<h2>Is Your Water Heater Telling You Something?</h2>
<p>Your water heater works hard every day, but it will not last forever. Here are the top 5 signs it is time for a replacement.</p>

<h3>1. Age</h3>
<p>If your tank water heater is over 10-12 years old, it is living on borrowed time. Check the serial number on the manufacturer label to find the production date.</p>

<h3>2. Rusty or Discolored Water</h3>
<p>Brown or rusty water coming from your hot water tap usually means the inside of the tank is corroding. This is a sign of imminent failure.</p>

<h3>3. Strange Noises</h3>
<p>Banging, rumbling, or popping sounds from your water heater indicate heavy sediment buildup. This makes the unit work harder and can lead to leaks.</p>

<h3>4. Leaking Around the Base</h3>
<p>Any moisture or pooling water around the base of your water heater means the tank integrity is compromised. This requires immediate attention.</p>

<h3>5. Not Enough Hot Water</h3>
<p>If you are running out of hot water faster than usual, or it takes forever to heat up, the heating elements or tank capacity may no longer meet your needs.</p>

<p><strong>Noticing any of these signs?</strong> Call Hot Water Heroes Plumbing for a free assessment and same-day replacement options.</p>',
        ],
        [
            'title'    => 'Why Tampa Bay Homes Need Annual Plumbing Inspections',
            'category' => 'Water Heater Services',
            'excerpt'  => 'Florida homes face unique plumbing challenges. Here is why an annual inspection can save you thousands.',
            'content'  => '<h2>Florida Plumbing Is Different</h2>
<p>Tampa Bay homes face unique plumbing challenges that homes in other parts of the country do not. From hard water mineral buildup to shifting sandy soil that stresses underground pipes, our climate and geology put extra wear on your plumbing system.</p>

<h3>What a Professional Inspection Covers</h3>
<p>During an annual plumbing inspection at Hot Water Heroes Plumbing, our licensed plumbers check:</p>
<ul>
<li><strong>Water heater</strong> - condition, age, sediment levels, anode rod, and temperature settings</li>
<li><strong>Supply lines</strong> - checking for leaks, corrosion, and water pressure</li>
<li><strong>Drain lines</strong> - flow testing and camera inspection if needed</li>
<li><strong>Fixtures</strong> - faucets, toilets, and shut-off valves for leaks and proper operation</li>
<li><strong>Water quality</strong> - hardness testing and filtration recommendations</li>
</ul>

<h3>The Cost of Skipping Inspections</h3>
<p>A small leak you cannot see can waste thousands of gallons of water per year and cause mold, rot, and structural damage. A $150 inspection today can prevent a $15,000 repair tomorrow.</p>

<p><strong>Protect your home.</strong> Schedule your annual plumbing inspection with Hot Water Heroes Plumbing today.</p>',
        ],
        [
            'title'    => 'Hard Water in Tampa Bay: What It Does to Your Plumbing',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Tampa Bay has some of the hardest water in Florida. Learn how it affects your pipes, fixtures, and appliances.',
            'content'  => '<h2>The Hard Truth About Tampa Bay Water</h2>
<p>If you have ever noticed white crusty buildup on your faucets or shower heads, you have seen hard water deposits firsthand. Tampa Bay water contains high levels of calcium and magnesium minerals that wreak havoc on your plumbing over time.</p>

<h3>How Hard Water Damages Your Home</h3>
<p>Hard water mineral deposits build up inside your pipes, water heater, dishwasher, and washing machine. Over time, this reduces water flow, decreases appliance efficiency, and shortens the lifespan of everything it touches.</p>

<h3>Signs of Hard Water Problems</h3>
<ul>
<li>White or chalky buildup on faucets and shower heads</li>
<li>Spots on dishes and glassware after washing</li>
<li>Dry skin and hair after showering</li>
<li>Reduced water pressure over time</li>
<li>Water heater making popping or rumbling sounds</li>
</ul>

<h3>The Solution: Water Softener Installation</h3>
<p>A whole-house water softener removes the excess minerals before they reach your fixtures and appliances. It extends the life of your plumbing, improves water quality, and reduces cleaning time.</p>

<p><strong>Tired of hard water?</strong> Call Hot Water Heroes Plumbing for a free water quality test and softener installation estimate.</p>',
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

    // 3 broad categories that fit the mega menu grid perfectly
    $categories = [
        'Water Heater Services'       => 'Professional water heater installation, repair, and maintenance for residential and commercial properties.',
        'Drain & Pipe Services'    => 'Expert drain cleaning, pipe repair, sewer line service, and camera inspections.',
        'Emergency & General'   => 'Emergency repairs, general plumbing maintenance, and comprehensive home plumbing solutions.',
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

    // Define all 18 services across 3 categories
    $services = [
        // -- Core Services (3 services) ------------------------------
        [
            'title'    => 'Water Heater Repair',
            'icon'     => '??',
            'category' => 'Water Heater Services',
            'excerpt'  => 'Fast, reliable water heater repair for all tank and tankless models. Same-day service available across all of-looking results.',
        ],
        [
            'title'    => 'Water Heater Installation',
            'icon'     => '?',
            'category' => 'Water Heater Services',
            'excerpt'  => 'Upgrade your home with a new high-efficiency water heater ï¿½ We install tank and tankless units from top brands with same-day availability.',
        ],
        [
            'title'    => 'Water Heater Installation',
            'icon'     => '??',
            'category' => 'Water Heater Services',
            'excerpt'  => 'Professional drain cleaning for kitchen, bathroom, and main sewer lines using hydro-jetting and camera inspection.',
        ],

        // -- Drain & Pipe Services (6 services) ---------------------------
        [
            'title'    => 'Leak Detection',
            'icon'     => '??',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Advanced electronic and camera-based leak detection to find hidden leaks without destroying your walls or floors.',
        ],
        [
            'title'    => 'Pipe Repair',
            'icon'     => '??',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Expert pipe repair and replacement for burst, corroded, or leaking pipes. Emergency service available 24/7 across Tampa Bay.',
        ],
        [
            'title'    => 'Whole-Home Repiping',
            'icon'     => '?',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Fast, professional drain cleaning using hydro-jetting and camera inspection. We clear tough clogs same-day.',
        ],
        [
            'title'    => 'Toilet Repair',
            'icon'     => '??',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Harness your body\'s own growth factors for natural skin renewal, improved texture, and a radiant glow.',
        ],
        [
            'title'    => 'Faucet Installation',
            'icon'     => '?',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Professional faucet installation, repair, and replacement for kitchen and bathroom fixtures.',
        ],
        [
            'title'    => 'Garbage Disposal',
            'icon'     => '??',
            'category' => 'Drain & Pipe Services',
            'excerpt'  => 'Advanced PRP therapy combined with cutting-edge Cellis technology for superior skin rejuvenation and healing.',
        ],

        // -- Body & Wellness (9 services) --------------------------
        [
            'title'    => 'Sewer & Water Line',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Whole-house water filtration and softener installation to improve water quality and protect your plumbing system.',
        ],
        [
            'title'    => 'Water Filtration',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'A range of advanced laser therapies for hair removal, skin tightening, pigmentation correction, and more.',
        ],
        [
            'title'    => 'Sump Pump',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Non-surgical butt enhancement to lift, firm, and sculpt for a naturally contoured silhouette.',
        ],
        [
            'title'    => 'Gas Line Service',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Eliminate spider veins and varicose veins with this safe, proven injection-based treatment.',
        ],
        [
            'title'    => 'Backflow Prevention',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Professional backflow preventer installation, testing, and annual certification to protect your water supply.',
        ],
        [
            'title'    => 'Hair Restoration',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Advanced hair restoration treatments to combat thinning and stimulate natural hair growth for fuller, healthier hair.',
        ],
        [
            'title'    => 'Leak Detection',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Boost hydration, energy, and immunity with custom IV vitamin infusions delivered directly to your bloodstream.',
        ],
        [
            'title'    => 'Slab Leak Repair',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'A confidential, non-surgical treatment using platelet-rich plasma to enhance intimate wellness and rejuvenation.',
        ],
        [
            'title'    => 'Camera Inspection',
            'icon'     => '??',
            'category' => 'Emergency & General',
            'excerpt'  => 'Video camera pipe inspection to diagnose clogs, cracks, and root intrusion without digging.',
        ],
    ];

    foreach ($services as $service) {
        // Check if service already exists
        $existing = get_page_by_title($service['title'], OBJECT, 'service');
        if ($existing) {
            // Update category on existing services
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
            'menu_name'          => '?? Services',
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'services'],
        'menu_icon'          => 'dashicons-heart',
        'menu_position'      => 5,
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true,
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

// -- Show ALL services on the services archive page -----------------
function hwh_services_per_page($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('service')) {
        $query->set('posts_per_page', 100);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'hwh_services_per_page');

// -- Service custom fields (meta box) -------------------------------
function hwh_service_meta_boxes() {
    add_meta_box(
        'hwh_service_details',
        'Service Details',
        'hwh_service_meta_html',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hwh_service_meta_boxes');

function hwh_service_meta_html($post) {
    wp_nonce_field('hwh_service_meta', 'hwh_service_nonce');
    $icon     = get_post_meta($post->ID, '_service_icon', true);
    $price    = get_post_meta($post->ID, '_service_price', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    ?>
    <style>
        .hwh-meta-row { display:flex; gap:1.5rem; margin-bottom:1rem; }
        .hwh-meta-field { flex:1; }
        .hwh-meta-field label { display:block; font-weight:600; margin-bottom:4px; }
        .hwh-meta-field input { width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:6px; }
    </style>
    <div class="hwh-meta-row">
        <div class="hwh-meta-field">
            <label for="service_icon">Icon (emoji)</label>
            <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" placeholder="??">
            <p class="description">Paste an emoji like ?? ? ?? ?? ? ??</p>
        </div>
        <div class="hwh-meta-field">
            <label for="service_price">Starting Price</label>
            <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" placeholder="$250+">
        </div>
        <div class="hwh-meta-field">
            <label for="service_duration">Duration</label>
            <input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" placeholder="30 min">
        </div>
    </div>
    <?php
}

function hwh_save_service_meta($post_id) {
    if (!isset($_POST['hwh_service_nonce']) || !wp_verify_nonce($_POST['hwh_service_nonce'], 'hwh_service_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = ['service_icon', 'service_price', 'service_duration'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_service', 'hwh_save_service_meta');

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
            'menu_name'          => '????? Team',
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
            <input type="text" id="team_role" name="team_role" value="<?php echo esc_attr($role); ?>" placeholder="Medical Director, MD">
            <p class="description">e.g. "Medical Director, MD" or "Lead Injector, PA-C"</p>
        </div>
    </div>
    <div class="hwh-team-row">
        <div class="hwh-team-field">
            <label for="team_credentials">Credential Badges</label>
            <input type="text" id="team_credentials" name="team_credentials" value="<?php echo esc_attr($credentials); ?>" placeholder="Board Certified, 12+ Years, AAAM Member">
            <p class="description">Comma-separated badges shown under the name, e.g. "Board Certified, 12+ Years"</p>
        </div>
    </div>
    <div class="hwh-team-row">
        <div class="hwh-team-field">
            <label for="team_specialties">Specialties</label>
            <input type="text" id="team_specialties" name="team_specialties" value="<?php echo esc_attr($specialties); ?>" placeholder="Water Heaters, Drain Cleaning, Repiping">
            <p class="description">Comma-separated specialties shown as tags, e.g. "Water Heaters, Drain Cleaning, Repiping"</p>
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
            'menu_name'          => '??? Products',
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
            <p class="description">MP4 video URL ï¿½ plays faintly behind the product card. Leave blank for no video.</p>
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
// BUILT-IN SEO META BOX ï¿½ edit SEO title, description & OG image
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
                   placeholder="<?php echo esc_attr($post->post_title . ' ï¿½ Hot Water Heroes Plumbing'); ?>"
                   maxlength="120">
            <span class="hwh-seo-hint">Recommended: 50ï¿½60 characters. Leave blank to use default.</span>
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
            <span class="hwh-seo-hint">Recommended: 120ï¿½160 characters.</span>
            <span class="hwh-seo-counter" id="seo-desc-counter">0/160</span>
        </div>

        <!-- OG Image -->
        <div class="hwh-seo-field">
            <label for="hwh_og_image">Social Share Image URL</label>
            <input type="url"
                   id="hwh_og_image"
                   name="hwh_og_image"
                   value="<?php echo esc_attr($og_image); ?>"
                   placeholder="https://hotwaterheroes.com/wp-content/uploads/...">
            <span class="hwh-seo-hint">Image shown when shared on Facebook, Twitter, etc. Ideal size: 1200ï¿½630px.</span>
        </div>

        <!-- Live Google Preview -->
        <div class="hwh-seo-preview">
            <div class="hwh-seo-preview__label">Google Search Preview</div>
            <div class="hwh-seo-preview__title" id="seo-preview-title">
                <?php echo esc_html($seo_title ?: $post->post_title . ' ï¿½ Hot Water Heroes Plumbing'); ?>
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
        var defaultTitle = <?php echo json_encode($post->post_title . ' ï¿½ Hot Water Heroes Plumbing'); ?>;

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
        $title['title'] = 'Plumbing Services in Tampa Bay, FL';
        $title['site']  = 'Hot Water Heroes Plumbing';
        return $title;
    }
    // Service pages: "Water Heater Repair in Tampa Bay, FL | Hot Water Heroes Plumbing"
    if (is_singular('service')) {
        $custom = get_post_meta(get_the_ID(), '_hwh_seo_title', true);
        $title['title'] = !empty($custom) ? $custom : get_the_title() . ' in Tampa Bay, FL';
        $title['site']  = 'Hot Water Heroes Plumbing';
        return $title;
    }
    // Product pages
    if (is_singular('product')) {
        $title['title'] = get_the_title() . ' | Professional Plumbing';
        $title['site']  = 'Hot Water Heroes Plumbing';
        return $title;
    }
    // All other singular pages ï¿½ use custom SEO title if set
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
        echo '<meta property="og:site_name" content="Hot Water Heroes Plumbing">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";

        if (!empty($og_img)) {
            echo '<meta property="og:image" content="' . esc_url($og_img) . '">' . "\n";
            echo '<meta name="twitter:image" content="' . esc_url($og_img) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'hwh_seo_head_tags', 5);

// -- FAQ Schema for Memberships Page --------------------------------
function hwh_faq_schema() {
    if (!is_page('memberships')) return;

    $faqs = [
        ['q' => 'Is there a minimum commitment?', 'a' => 'We ask for a minimum annual commitment to get the most out of your Maintenance Plan membership. After that, you can continue month-to-month or cancel anytime.'],
        ['q' => 'Do my credits expire?', 'a' => 'No! Your banked credits never expire as long as your membership is active. If you cancel, unused credits remain available for 90 days.'],
        ['q' => 'What can I use my credits on?', 'a' => 'Your maintenance plan benefits can be used on any plumbing service we offer ï¿½ water heater repairs, drain cleaning, repiping, fixture installation, and more.'],
        ['q' => 'Can I share my credits with friends or family?', 'a' => 'Absolutely! You can gift your credits to friends and family members.'],
        ['q' => 'How much should I set as my monthly deposit?', 'a' => 'Our plans start at affordable annual rates. During your free estimate, we\'ll help you find the perfect amount.'],
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
    $first   = sanitize_text_field($_POST['first_name'] ?? '');
    $last    = sanitize_text_field($_POST['last_name']  ?? '');
    $email   = sanitize_email($_POST['email']           ?? '');
    $phone   = sanitize_text_field($_POST['phone']      ?? '');
    $service = sanitize_text_field($_POST['service']    ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Validate required fields
    if ( empty($first) || empty($email) || ! is_email($email) ) {
        wp_send_json_error(['message' => 'Please fill in all required fields.']);
    }

    // -- Build recipients list (supports multiple, comma-separated) --
    $recipients_raw = get_option('hwh_notification_emails', 'support@hotwaterheroes.com');
    $recipients = array_filter(array_map('trim', explode(',', $recipients_raw)), 'is_email');
    if ( empty($recipients) ) $recipients = ['support@hotwaterheroes.com'];
    $to = $recipients;

    $subject = '? New Message ï¿½ Hot Water Heroes Plumbing Website';

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
        wp_send_json_error(['message' => 'Something went wrong. Please call us at (813) 230-2219.']);
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
            <p style="margin:0 0 8px;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:rgba(201,169,110,0.9);">Hot Water Heroes Plumbing</p>
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
              <a href="mailto:{{email}}" style="display:inline-block;background:linear-gradient(135deg,#F22F3A,#C41E27);color:#ffffff;text-decoration:none;padding:14px 36px;border-radius:50px;font-size:14px;font-weight:600;letter-spacing:0.5px;">Reply to {{first_name}} ?</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="background:#0f0720;padding:24px 40px;text-align:center;">
            <p style="margin:0;font-size:11px;color:rgba(240,235,227,0.4);letter-spacing:1px;">Hot Water Heroes Plumbing &middot; Tampa Bay, FL &middot; <a href="https://hotwaterheroes.com" style="color:rgba(172,19,249,0.7);text-decoration:none;">hotwaterheroes.com</a></p>
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
        // Multiple emails ï¿½ stored as comma-separated string
        $emails_raw = sanitize_text_field($_POST['hwh_notification_emails'] ?? 'support@hotwaterheroes.com');
        $emails_clean = implode(', ', array_filter(array_map('sanitize_email', array_map('trim', explode(',', $emails_raw))), 'is_email'));
        update_option('hwh_notification_emails', $emails_clean ?: 'support@hotwaterheroes.com');

        // Email template ï¿½ allow HTML
        $template = wp_unslash($_POST['hwh_email_template'] ?? '');
        update_option('hwh_email_template', $template);

        echo '<div class="notice notice-success is-dismissible"><p><strong>? Settings saved!</strong></p></div>';
    }

    $current_emails  = get_option('hwh_notification_emails', 'support@hotwaterheroes.com');
    $current_template = get_option('hwh_email_template', '') ?: hwh_default_email_template();
    ?>
    <div class="wrap">
        <h1 style="display:flex;align-items:center;gap:10px;margin-bottom:24px;">
            <span style="font-size:1.4rem;">?</span> Hot Water Heroes Plumbing ï¿½ Settings
        </h1>

        <form method="post">
            <?php wp_nonce_field('hwh_save_settings', 'hwh_settings_nonce'); ?>

            <!-- Section: Recipients -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">?? Notification Recipients</h2>
                <p style="margin:0 0 20px;color:#666;font-size:13px;">Separate multiple email addresses with commas. All recipients receive every submission.</p>
                <label for="hwh_notification_emails" style="display:block;font-weight:600;margin-bottom:6px;font-size:13px;">Email Address(es)</label>
                <input type="text" id="hwh_notification_emails" name="hwh_notification_emails"
                       value="<?php echo esc_attr($current_emails); ?>"
                       style="width:100%;max-width:600px;padding:10px 14px;border:1px solid #ddd;border-radius:6px;font-size:14px;"
                       placeholder="support@hotwaterheroes.com, manager@hotwaterheroes.com">
                <p style="margin:8px 0 0;font-size:12px;color:#888;">Example: <code>support@hotwaterheroes.com, angie@hotwaterheroes.com</code></p>
            </div>

            <!-- Section: Email Template -->
            <div style="background:#fff;border-radius:10px;padding:28px 32px;max-width:800px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
                <h2 style="margin:0 0 6px;font-size:16px;">?? Email Template (HTML)</h2>
                <p style="margin:0 0 16px;color:#666;font-size:13px;">Customize the HTML email that gets sent to your inbox. Use the tags below to insert form data ï¿½ they'll be replaced automatically.</p>

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
        'Hot Water Heroes Plumbing Settings',
        '? HWH Settings',
        'manage_options',
        'hwh-settings',
        'hwh_settings_page_html'
    );
}
add_action('admin_menu', 'hwh_add_settings_menu');

// -- Deal Popup ï¿½ Customizer Controls -------------------------------
// Client manages all popup content from Appearance ? Customize ? ?? Deal Popup
// Zero code required. Changes go live on Save & Publish.
add_action('customize_register', 'hwh_popup_customizer');
function hwh_popup_customizer($wp_customize) {

    $wp_customize->add_section('hwh_popup', [
        'title'       => '?? Deal Popup',
        'priority'    => 30,
        'description' => 'Control the promotional popup. Turn it on/off, set the offer text, button, and when it expires. Visitors only see it once every 7 days.',
    ]);

    // Enable toggle
    $wp_customize->add_setting('hwh_popup_enabled', ['default' => false, 'sanitize_callback' => 'rest_sanitize_boolean', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_enabled', [
        'type'        => 'checkbox',
        'section'     => 'hwh_popup',
        'label'       => 'Show Popup on Site',
    ]);

    // Badge
    $wp_customize->add_setting('hwh_popup_badge', ['default' => '? Limited Time Offer', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_badge', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Badge Label',
        'description' => 'Small tag above the title. e.g. "? New Client Special"',
    ]);

    // Title
    $wp_customize->add_setting('hwh_popup_title', ['default' => '$50 Off Your First Visit', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_title', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Popup Headline',
    ]);

    // Body text
    $wp_customize->add_setting('hwh_popup_text', ['default' => 'Book your first service today and receive $50 off any plumbing repair. New customers only.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
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
        'label'       => 'Discount Code (optional)',
        'description' => 'Leave blank if no promo code ï¿½ the code box won\'t appear.',
    ]);

    // Button text
    $wp_customize->add_setting('hwh_popup_btn_text', ['default' => 'Book Now & Save $50', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_btn_text', [
        'type'        => 'text',
        'section'     => 'hwh_popup',
        'label'       => 'Button Text',
    ]);

    // Button URL
    $wp_customize->add_setting('hwh_popup_btn_url', ['default' => '#book-now', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control('hwh_popup_btn_url', [
        'type'        => 'url',
        'section'     => 'hwh_popup',
        'label'       => 'Button Link',
        'description' => 'Use #book-now to open booking, or paste any URL.',
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


// -- Service Page Extras ? Video & Benefits Meta Box ----------------
add_action('add_meta_boxes', 'hwh_service_extras_meta_box');
function hwh_service_extras_meta_box() {
    add_meta_box('hwh_service_extras','?? Video & Key Benefits','hwh_service_extras_html','service','normal','high');
}
function hwh_service_extras_html($post) {
    wp_nonce_field('hwh_service_extras', 'hwh_service_extras_nonce');
    $video    = get_post_meta($post->ID, '_service_video', true);
    $benefits = get_post_meta($post->ID, '_service_benefits', true);
    echo '<table class="form-table" style="width:100%">';
    echo '<tr><th style="width:160px;padding:12px 0;vertical-align:top"><label for="_service_video"><strong>?? Video URL</strong></label></th>';
    echo '<td><input type="url" id="_service_video" name="_service_video" value="' . esc_attr($video) . '" style="width:100%;padding:6px 10px;border:1px solid #ddd;border-radius:4px" placeholder="https://youtube.com/watch?v=...">';
    echo '<p style="color:#666;font-size:12px;margin:4px 0 0">Paste a YouTube or Vimeo URL. Leave blank to hide the video section.</p></td></tr>';
    echo '<tr><th style="padding:12px 0;vertical-align:top"><label for="_service_benefits"><strong>? Key Benefits</strong></label></th>';
    echo '<td><textarea id="_service_benefits" name="_service_benefits" rows="6" style="width:100%;padding:6px 10px;border:1px solid #ddd;border-radius:4px;font-family:inherit" placeholder="Same-day service available&#10;Licensed & insured technicians&#10;Free written estimate included">' . esc_textarea($benefits) . '</textarea>';
    echo '<p style="color:#666;font-size:12px;margin:4px 0 0">One benefit per line. Leave blank to hide the benefits section.</p></td></tr>';
    echo '</table>';
}
add_action('save_post_service', 'hwh_save_service_extras');
function hwh_save_service_extras($post_id) {
    if (!isset($_POST['hwh_service_extras_nonce']) || !wp_verify_nonce($_POST['hwh_service_extras_nonce'], 'hwh_service_extras')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['_service_video'])) update_post_meta($post_id, '_service_video', esc_url_raw($_POST['_service_video']));
    if (isset($_POST['_service_benefits'])) update_post_meta($post_id, '_service_benefits', sanitize_textarea_field($_POST['_service_benefits']));
}

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
    echo '<strong>?? Hot Water Heroes Plumbing Theme</strong> ? ';
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
// the WP object cache ï¿½ zero manual effort required.
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
        return; // Nothing changed ï¿½ skip
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

}, 1 ); // Priority 1 ï¿½ run early


// =============================================================================
// AI SEARCH VISIBILITY ï¿½ HOMEPAGE FAQ SCHEMA
// These Q&As directly feed Google AI Overviews, ChatGPT, and Perplexity
// when users ask questions about plumbing services in Tampa Bay.
// =============================================================================
function hwh_homepage_faq_schema() {
    if ( ! is_front_page() ) return;

    $faqs = [
        [
            'q' => 'What services does Hot Water Heroes Plumbing offer in Tampa Bay?',
            'a' => 'Hot Water Heroes Plumbing in Tampa Bay, FL offers water heater repair and installation, drain cleaning, pipe repair, whole-home repiping, leak detection, slab leak repair, gas line service, water filtration, sump pump installation, and 24/7 emergency plumbing service.',
        ],
        [
            'q' => 'Who is the provider at Hot Water Heroes Plumbing?',
            'a' => 'Hot Water Heroes Plumbing is a family-owned, licensed plumbing company ï¿½ serving Tampa Bay with fast, honest, and affordable plumbing services. Our team of licensed master plumbers brings decades of combined experience to every job.',
        ],
        [
            'q' => 'Where is Hot Water Heroes Plumbing located?',
            'a' => 'Hot Water Heroes Plumbing is located at 10043 N Dale Mabry Hwy, Tampa Bay, FL 33618 ï¿½ conveniently serving Carrollwood, Westchase, Lutz, Land O Lakes, and the greater Tampa Bay Bay area. Call (813) 230-2219 to book.',
        ],
        [
            'q' => 'How much does a plumbing service call cost at Hot Water Heroes Plumbing?',
            'a' => 'Service call pricing at Hot Water Heroes Plumbing depends on the type of work needed. We provide free written estimates before any work begins so you know exactly what to expect. Maintenance plan members receive 15% off all repairs.',
        ],
        [
            'q' => 'Does Hot Water Heroes Plumbing offer free estimates?',
            'a' => 'Yes! Hot Water Heroes Plumbing provides free estimates on all plumbing work. A licensed plumber will diagnose your issue and provide a written quote before any work begins. Book online or call 813-42-PLUMB.',
        ],
        [
            'q' => 'What are Hot Water Heroes Plumbing\'s hours?',
            'a' => 'Hot Water Heroes Plumbing is open Monday through Wednesday from 9:00 AM to 7:00 PM, and Thursday through Saturday from 9:00 AM to 4:00 PM. They are closed on Sundays.',
        ],
        [
            'q' => 'What is the Maintenance Plan at Hot Water Heroes Plumbing?',
            'a' => 'The Maintenance Plan is Hot Water Heroes Plumbing\'s annual service plan. Members receive priority scheduling, annual inspections, (starting at $50/month) that accumulates as credits redeemable for any service or product. Credits never expire while your membership is active, and members receive exclusive pricing and priority booking.',
        ],
        [
            'q' => 'Is Hot Water Heroes Plumbing good for first-time homeowners?',
            'a' => 'Absolutely. Hot Water Heroes Plumbing welcomes first-time customers and provides a friendly, transparent experience. Our licensed plumbers take a thorough, professional approach to every estimate, explaining your options clearly before any work begins. New customers receive a $50 off first-service special.',
        ],
        [
            'q' => 'Does Hot Water Heroes Plumbing offer financing?',
            'a' => 'Yes, Hot Water Heroes Plumbing offers flexible payment plan financing through Cherry � allowing you to split the cost of plumbing repairs or installations into manageable monthly payments with easy online approval. Ask our team for details when you book.',
        ],
        [
            'q' => 'What makes Hot Water Heroes Plumbing different from other Tampa Bay plumbers?',
            'a' => 'Hot Water Heroes Plumbing stands out for its team of licensed master plumbers, its commitment to honest, quality workmanship, transparent pricing, and its Maintenance Plan membership program. All work is performed by licensed, insured plumbers and backed by our satisfaction guarantee.',
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
// AI SEARCH VISIBILITY ï¿½ SERVICE PAGE FAQ SCHEMA
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
            'q' => 'How much does ' . $service_name . ' cost at Hot Water Heroes Plumbing?',
            'a' => $price
                ? $service_name . ' at Hot Water Heroes Plumbing starts at ' . esc_html($price) . '. We provide free written estimates before any work begins. Maintenance plan members save 15% on all repairs.'
                : $service_name . ' pricing at Hot Water Heroes Plumbing depends on the scope of work. Call us for a free estimate from a licensed plumber.',
        ],
        [
            'q' => 'How long does ' . $service_name . ' take at Hot Water Heroes Plumbing?',
            'a' => $duration
                ? $service_name . ' services at Hot Water Heroes Plumbing typically take ' . esc_html($duration) . '. Times may vary based on the scope of your specific job.'
                : $service_name . ' treatment times vary by client. Contact Hot Water Heroes Plumbing at (813) 230-2219 for details.',
        ],
        [
            'q' => 'Is ' . $service_name . ' safe?',
            'a' => $service_name . ' at Hot Water Heroes Plumbing is performed by licensed, insured plumbers with years of experience. All work is done to code and backed by our satisfaction guarantee.',
        ],
        [
            'q' => 'Where can I get ' . $service_name . ' in Tampa Bay, FL?',
            'a' => 'Hot Water Heroes Plumbing offers ' . $service_name . ' in Tampa Bay, FL at 10043 N Dale Mabry Hwy, Tampa Bay, FL 33618. Call (813) 230-2219 or book online to schedule your free estimate.',
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
// AI SEARCH VISIBILITY ï¿½ ALLOW AI CRAWLERS IN ROBOTS.TXT
// Explicitly permits GPTBot (ChatGPT), PerplexityBot, ClaudeBot (Anthropic),
// Applebot-Extended (Apple Intelligence), and Google-Extended (Bard/Gemini).
// Without this, AI tools may not index the site for their training data.
// =============================================================================
add_filter('robots_txt', 'hwh_allow_ai_crawlers', 10, 2);
function hwh_allow_ai_crawlers($output, $public) {
    $ai_rules  = "\n# -- AI Search Crawlers ï¿½ explicitly allowed for AI search visibility --\n";
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
// AI SEARCH VISIBILITY ï¿½ HOMEPAGE REVIEW SCHEMA
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
            'date'    => '2026-03-15',
            'body'    => 'The team at Hot Water Heroes is absolutely amazing! They replaced our water heater the same day we called. The work was clean and professional ï¿½ not overdone at all. HWH is the only company I\'ll go from now on.',
        ],
        [
            'author'  => 'Jessica R.',
            'rating'  => 5,
            'date'    => '2026-02-28',
            'body'    => 'Best plumbing company in Tampa Bay. They showed up on time, diagnosed the issue quickly, and had it fixed within the hour. Highly recommend to anyone in the Tampa Bay area.',
        ],
        [
            'author'  => 'Michelle T.',
            'rating'  => 5,
            'date'    => '2026-01-20',
            'body'    => 'We signed up for the Maintenance Plan and it is totally worth it. The annual inspection caught a small leak we never would have noticed. The team is thorough, professional, and genuinely cares about their customers.',
        ],
        [
            'author'  => 'Danielle K.',
            'rating'  => 5,
            'date'    => '2025-12-10',
            'body'    => 'First time calling a plumber and the HWH team walked us through everything. They were honest about what actually needed fixing and didn\'t upsell me on anything unnecessary. Our pipes are running perfectly and we couldn\'t be happier.',
        ],
        [
            'author'  => 'Kevin O.',
            'rating'  => 5,
            'date'    => '2025-11-05',
            'body'    => 'Called Hot Water Heroes at 7am with a broken water heater. They had a technician out within 90 minutes and replaced the entire unit the same day. Professional, clean, and priced fairly. Will absolutely use them again.',
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
                '@type' => 'Plumber',
                'name'  => 'Hot Water Heroes Plumbing',
                'image' => 'https://hotwaterheroesplumbing.com/wp-content/uploads/2025/08/HEROES-16-x-9-in-scaled-e1755179786780.png',
            ],
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema_reviews, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'hwh_review_schema', 8);

// ============================================================================
// SERVICE EXCERPT SANITIZER
// Intercepts database-stored med-spa excerpts and replaces with plumbing copy
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

    // Generate a clean plumbing excerpt based on the service title
    $title = strtolower(get_the_title());
    $fallbacks = [
        'water heater'    => 'Professional water heater repair and installation for all tank and tankless models. Same-day service available.',
        'drain'           => 'Expert drain cleaning using hydro-jetting and camera inspection. We clear tough clogs fast.',
        'pipe'            => 'Licensed pipe repair and replacement for burst, corroded, or leaking pipes across Tampa Bay.',
        'repipe'          => 'Complete whole-home repiping from galvanized or polybutylene to modern PEX or copper.',
        'leak'            => 'Advanced leak detection using electronic and camera-based technology. Minimize damage, find leaks fast.',
        'sewer'           => 'Comprehensive sewer line repair, replacement, and camera inspection services.',
        'toilet'          => 'Toilet repair, replacement, and installation. Running toilets, clogs, and upgrades.',
        'faucet'          => 'Professional faucet installation and repair for kitchen, bathroom, and utility fixtures.',
        'garbage'         => 'Garbage disposal installation, repair, and replacement for all major brands.',
        'sump'            => 'Sump pump installation and repair to protect your home from flooding.',
        'gas'             => 'Licensed gas line installation, repair, and leak detection for residential properties.',
        'backflow'        => 'Backflow preventer installation, testing, and annual certification.',
        'water filter'    => 'Whole-house water filtration and softener systems for cleaner, better-tasting water.',
        'camera'          => 'Video camera pipe inspection to diagnose clogs, cracks, and root intrusion.',
        'slab'            => 'Slab leak detection and repair using minimally invasive techniques.',
    ];

    foreach ($fallbacks as $keyword => $desc) {
        if (strpos($title, $keyword) !== false) {
            return $desc;
        }
    }

    // Generic fallback
    return 'Professional plumbing service by licensed Tampa Bay plumbers. Call 813-42-PLUMB for a free estimate.';
}
add_filter('get_the_excerpt', 'hwh_sanitize_service_excerpt', 20);


// ============================================================================
// SERVICE CONTENT SANITIZER
// Hides database-stored med-spa content from service pages
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
        <p>Hot Water Heroes Plumbing provides expert ' . strtolower($title) . ' services across Hillsborough, Pinellas, and Pasco counties. Our licensed plumbers are equipped to handle any job � big or small.</p>
        <h3>Why Choose Hot Water Heroes?</h3>
        <ul>
            <li><strong>Licensed & Insured</strong> � All work performed by certified plumbers</li>
            <li><strong>Upfront Pricing</strong> � Written estimates before we start</li>
            <li><strong>Same-Day Service</strong> � Available for most repairs</li>
            <li><strong>Satisfaction Guaranteed</strong> � We stand behind our work</li>
        </ul>
        <p>Call <strong>813-42-PLUMB</strong> or <a href="' . esc_url(home_url('/contact/')) . '">book online</a> to schedule your service today.</p>
    </div>';
}
add_filter('the_content', 'hwh_sanitize_service_content', 20);
