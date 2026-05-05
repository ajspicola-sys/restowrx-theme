<?php
/**
 * Hot Water Heroes Plumbing — 404 Error Page
 * Plumbing theme: broken pipe with teardrop drops, ghost 404, dynamic services.
 */
get_header();

/* ── Pull 4 random published services ──────────────────────────── */
$random_services = new WP_Query( [
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'orderby'        => 'rand',
    'no_found_rows'  => true,   // skip COUNT(*) — we don't need pagination
] );

/* Fallback icon map if a service has no _service_icon meta */
$fallback_icons = [ '🔧', '🔥', '🚿', '🛠️', '💧', '⚙️', '🪠', '🔩' ];
$fi = 0;
?>

<main class="site-main" id="main-content">

    <section class="e404" aria-label="Page not found">

        <!-- Animated background bubbles -->
        <div class="e404__bg" aria-hidden="true">
            <span class="e404__bubble" style="--x:8%;  --size:220px; --delay:0s;   --dur:18s;"></span>
            <span class="e404__bubble" style="--x:78%; --size:300px; --delay:3s;   --dur:22s;"></span>
            <span class="e404__bubble" style="--x:45%; --size:180px; --delay:6s;   --dur:16s;"></span>
            <span class="e404__bubble" style="--x:20%; --size:120px; --delay:9s;   --dur:20s;"></span>
            <span class="e404__bubble" style="--x:88%; --size:150px; --delay:1.5s; --dur:14s;"></span>
        </div>

        <div class="section__inner e404__inner">

            <!-- ── Pipe illustration ───────────────────────────── -->
            <div class="e404__art" aria-hidden="true">

                <!-- Ghost "404" behind the pipe -->
                <div class="e404__number">404</div>

                <svg class="e404__pipe" viewBox="0 0 260 360" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Horizontal pipe body -->
                    <rect x="10" y="100" width="240" height="48" rx="10" fill="#18375D"/>
                    <rect x="10" y="100" width="240" height="14" rx="10" fill="#1E4A7A" opacity=".6"/>
                    <!-- Left cap -->
                    <rect x="0"  y="92"  width="30"  height="64" rx="8" fill="#0F2440"/>
                    <!-- Right cap (broken end) -->
                    <path d="M230 92 h30 a8 8 0 0 1 8 8 v48 a8 8 0 0 1-8 8 h-30 z" fill="#0F2440"/>
                    <!-- Break crack lines -->
                    <path d="M232 95 l14 22 M238 100 l10 30 M244 94 l8 34" stroke="#F22F3A" stroke-width="2.5" stroke-linecap="round" opacity=".9"/>
                    <!-- Pipe shine -->
                    <rect x="14" y="104" width="220" height="6" rx="3" fill="white" opacity=".08"/>
                    <!-- Elbow going down -->
                    <rect x="106" y="145" width="48" height="90" rx="10" fill="#18375D"/>
                    <rect x="106" y="145" width="14" height="90" rx="4" fill="#1E4A7A" opacity=".5"/>
                    <!-- Bottom ring -->
                    <rect x="100" y="225" width="60" height="18" rx="6" fill="#0F2440"/>

                    <!--
                        Teardrop drops — path: circle bottom + pointed top
                        M cx,top  C control points curving to the left...
                        each translated down for the stagger
                    -->
                    <!-- Drop 1 -->
                    <g class="e404__drop e404__drop--1">
                        <path d="M130 248 C122 255 118 265 118 272 C118 281.9 123.4 290 130 290 C136.6 290 142 281.9 142 272 C142 265 138 255 130 248 Z"
                              fill="#F22F3A"/>
                    </g>
                    <!-- Drop 2 -->
                    <g class="e404__drop e404__drop--2">
                        <path d="M130 270 C122 277 118 287 118 294 C118 303.9 123.4 312 130 312 C136.6 312 142 303.9 142 294 C142 287 138 277 130 270 Z"
                              fill="#F22F3A" opacity=".72"/>
                    </g>
                    <!-- Drop 3 -->
                    <g class="e404__drop e404__drop--3">
                        <path d="M130 302 C124 308 121 316 121 322 C121 329.7 125 336 130 336 C135 336 139 329.7 139 322 C139 316 136 308 130 302 Z"
                              fill="#F22F3A" opacity=".5"/>
                    </g>

                    <!-- Floor ripple -->
                    <ellipse cx="130" cy="352" rx="28" ry="5" fill="#F22F3A" opacity=".15"/>
                    <ellipse cx="130" cy="352" rx="17" ry="3" fill="#F22F3A" opacity=".22"/>
                </svg>

            </div><!-- /.e404__art -->

            <!-- ── Text content ────────────────────────────────── -->
            <div class="e404__content">
                <div class="e404__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    We're on it
                </div>

                <h1 class="e404__title">Looks like this pipe burst.</h1>
                <p class="e404__sub">The page you're looking for has gone down the drain. Our crew is on standby — let's get you back to flowing water fast.</p>

                <!-- Primary CTAs -->
                <div class="e404__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg e404__cta-home">
                        Back to Home
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                        Call for Help
                    </a>
                </div>

                <!-- ── Dynamic random services ─────────────────── -->
                <?php if ( $random_services->have_posts() ) : ?>
                <nav class="e404__links" aria-label="Quick service links">
                    <p class="e404__links-label">Jump straight to a service:</p>
                    <div class="e404__links-grid">
                        <?php while ( $random_services->have_posts() ) : $random_services->the_post();
                            $icon = get_post_meta( get_the_ID(), '_service_icon', true );
                            if ( ! $icon ) {
                                $icon = $fallback_icons[ $fi % count( $fallback_icons ) ];
                                $fi++;
                            }
                        ?>
                        <a href="<?php the_permalink(); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></span>
                            <span class="e404__link-name"><?php the_title(); ?></span>
                        </a>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </nav>
                <?php else : ?>
                <!-- Fallback static links when no services exist yet -->
                <nav class="e404__links" aria-label="Quick links">
                    <p class="e404__links-label">Or go somewhere useful:</p>
                    <div class="e404__links-grid">
                        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true">🔧</span>
                            <span class="e404__link-name">All Services</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true">📞</span>
                            <span class="e404__link-name">Contact Us</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true">🏢</span>
                            <span class="e404__link-name">About HWH</span>
                        </a>
                        <a href="tel:+18134275862" class="e404__link-card">
                            <span class="e404__link-icon" aria-hidden="true">📲</span>
                            <span class="e404__link-name">Call Now</span>
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
                            placeholder="Search for a service or topic…"
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
