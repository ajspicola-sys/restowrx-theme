<?php
/**
 * Spicola Construction — 404 Error Page
 * Construction theme: blueprint grid, hard hat, dynamic services.
 */
get_header();

/* ── Pull 4 random published services ──────────────────────────── */
$random_services = new WP_Query( [
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'rand',
    'no_found_rows'  => true,
] );
?>

<main class="site-main" id="main-content">

    <section class="e404" aria-label="Page not found">

        <!-- Animated background elements -->
        <div class="e404__bg" aria-hidden="true">
            <span class="e404__bubble" style="--x:8%;  --size:220px; --delay:0s;   --dur:18s;"></span>
            <span class="e404__bubble" style="--x:78%; --size:300px; --delay:3s;   --dur:22s;"></span>
            <span class="e404__bubble" style="--x:45%; --size:180px; --delay:6s;   --dur:16s;"></span>
            <span class="e404__bubble" style="--x:20%; --size:120px; --delay:9s;   --dur:20s;"></span>
            <span class="e404__bubble" style="--x:88%; --size:150px; --delay:1.5s; --dur:14s;"></span>
        </div>

        <div class="section__inner e404__inner">

            <!-- ── Construction illustration ─────────────────── -->
            <div class="e404__art" aria-hidden="true">
                <div class="e404__number">404</div>

                <svg class="e404__crane" viewBox="0 0 280 360" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Base platform -->
                    <rect x="80" y="300" width="120" height="20" rx="4" fill="#0F2440"/>
                    <rect x="80" y="300" width="120" height="6" rx="3" fill="#1E4A7A" opacity=".4"/>
                    <!-- Vertical beam -->
                    <rect x="130" y="80" width="20" height="224" fill="#18375D"/>
                    <rect x="130" y="80" width="6" height="224" fill="#1E4A7A" opacity=".5"/>
                    <!-- Cross braces -->
                    <line x1="130" y1="120" x2="150" y2="160" stroke="#0F2440" stroke-width="3"/>
                    <line x1="150" y1="120" x2="130" y2="160" stroke="#0F2440" stroke-width="3"/>
                    <line x1="130" y1="180" x2="150" y2="220" stroke="#0F2440" stroke-width="3"/>
                    <line x1="150" y1="180" x2="130" y2="220" stroke="#0F2440" stroke-width="3"/>
                    <line x1="130" y1="240" x2="150" y2="280" stroke="#0F2440" stroke-width="3"/>
                    <line x1="150" y1="240" x2="130" y2="280" stroke="#0F2440" stroke-width="3"/>
                    <!-- Horizontal boom -->
                    <rect x="40" y="74" width="200" height="14" rx="4" fill="#18375D"/>
                    <rect x="40" y="74" width="200" height="5" rx="2" fill="#1E4A7A" opacity=".5"/>
                    <!-- Cabin -->
                    <rect x="120" y="86" width="40" height="32" rx="4" fill="#0F2440"/>
                    <rect x="126" y="92" width="28" height="14" rx="2" fill="#1E4A7A" opacity=".3"/>
                    <!-- Cable -->
                    <line x1="60" y1="88" x2="60" y2="240" stroke="#C13333" stroke-width="2" stroke-dasharray="6 4"/>
                    <!-- Hook -->
                    <circle cx="60" cy="248" r="10" stroke="#C13333" stroke-width="3" fill="none"/>
                    <line x1="60" y1="238" x2="60" y2="244" stroke="#C13333" stroke-width="3"/>
                    <!-- Hard hat on hook -->
                    <g class="e404__hat">
                        <ellipse cx="60" cy="272" rx="22" ry="8" fill="#E8A817"/>
                        <path d="M42 272 C42 256 78 256 78 272" fill="#F5C518"/>
                        <rect x="38" y="268" width="44" height="6" rx="3" fill="#E8A817"/>
                    </g>
                    <!-- Warning stripes on base -->
                    <g opacity=".6">
                        <rect x="82" y="304" width="8" height="12" fill="#F5C518"/>
                        <rect x="98" y="304" width="8" height="12" fill="#F5C518"/>
                        <rect x="114" y="304" width="8" height="12" fill="#F5C518"/>
                        <rect x="130" y="304" width="8" height="12" fill="#F5C518"/>
                        <rect x="146" y="304" width="8" height="12" fill="#F5C518"/>
                        <rect x="162" y="304" width="8" height="12" fill="#F5C518"/>
                        <rect x="178" y="304" width="8" height="12" fill="#F5C518"/>
                    </g>
                    <!-- Counter-weight -->
                    <rect x="210" y="88" width="24" height="24" rx="3" fill="#0F2440"/>
                    <rect x="210" y="88" width="24" height="8" rx="3" fill="#C13333" opacity=".5"/>
                </svg>

            </div><!-- /.e404__art -->

            <!-- ── Text content ────────────────────────────────── -->
            <div class="e404__content">
                <div class="e404__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Under Construction
                </div>

                <h1 class="e404__title">This page is still<br>under construction.</h1>
                <p class="e404__sub">The page you're looking for doesn't exist — or it's been moved. Don't worry, our crew can get you back on track.</p>

                <!-- Primary CTAs -->
                <div class="e404__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg e404__cta-home">
                        Back to Home
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                        Get a Quote
                    </a>
                </div>

                <!-- ── Dynamic random services ─────────────────── -->
                <?php if ( $random_services->have_posts() ) : ?>
                <nav class="e404__links" aria-label="Quick service links">
                    <p class="e404__links-label">Jump straight to a service:</p>
                    <div class="e404__links-grid">
                        <?php while ( $random_services->have_posts() ) : $random_services->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
                            <span class="e404__link-name"><?php the_title(); ?></span>
                        </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </nav>
                <?php else : ?>
                <!-- Fallback static links when no services exist yet -->
                <nav class="e404__links" aria-label="Quick links">
                    <p class="e404__links-label">Or check out these pages:</p>
                    <div class="e404__links-grid">
                        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
                            <span class="e404__link-name">All Services</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
                            <span class="e404__link-name">Contact Us</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></span>
                            <span class="e404__link-name">About Us</span>
                        </a>
                        <a href="tel:+18137326285" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                            <span class="e404__link-name">Call (813) 732-6285</span>
                        </a>
                    </div>
                </nav>
                <?php endif; ?>

                <!-- Search -->
                <div class="e404__search">
                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="e404__search-form">
                        <svg class="e404__search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        <input
                            type="search"
                            name="s"
                            class="e404__search-input"
                            placeholder="Search for a service or project…"
                            aria-label="Search the site"
                        >
                        <button type="submit" class="btn btn--primary e404__search-btn">Go</button>
                    </form>
                </div>

            </div><!-- /.e404__content -->

        </div><!-- /.e404__inner -->
    </section>

</main>

<?php get_footer(); ?>
