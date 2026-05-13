<?php
/**
 * Hot Water Heroes — Services Archive
 * Uses an explicit WP_Query (same as homepage) so it
 * is never affected by Reading Settings or pre_get_posts.
 */
get_header();
?>

<style>
/* Services archive — full-width card images */
.hwh-services .hwh-service-card__img {
    margin: -2.2rem -2rem 1rem -2rem;
    border-radius: 18px 18px 0 0;
    aspect-ratio: 16 / 9;
}
.hwh-services .hwh-service-card__img img {
    border-radius: 0;
}
</style>

<main class="site-main" id="main-content">

    <!-- ── Page Hero ─────────────────────────────────────────────── -->
    <section class="hwh-hero hwh-hero--inner" aria-label="Our plumbing services">
        <div class="hwh-hero__overlay" aria-hidden="true"></div>
        <div class="hwh-hero__grid"    aria-hidden="true"></div>
        <div class="hwh-section-inner" style="position:relative;z-index:2;text-align:center;padding-top:2rem;padding-bottom:2rem;">
            <span class="hwh-label hwh-label--white">What We Do</span>
            <h1 class="hwh-section-title hwh-section-title--white" style="margin-bottom:1rem;">
                All Plumbing Services<br><em>Tampa Bay Trusts</em>
            </h1>
            <p class="hwh-section-desc hwh-section-desc--muted">
                Licensed plumbers ready same-day — water heaters, drains, leaks, and 24/7 emergencies.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:2rem;">
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="hwh-btn hwh-btn--red hwh-btn--lg">Request Service</a>
                <a href="tel:+18134275862" class="hwh-btn hwh-btn--ghost hwh-btn--lg">Call 813-42-PLUMB (75862)</a>
            </div>
        </div>
    </section>

    <!-- ── Services Grid — explicit WP_Query, same as homepage ───── -->
    <section class="hwh-services" aria-label="All plumbing services" style="padding-top:5rem;padding-bottom:5rem;">
        <div class="hwh-section-inner">

        <?php
        // Explicit query — not affected by Reading Settings or pre_get_posts
        $services_query = new WP_Query([
            'post_type'      => 'service',
            'post_status'    => 'publish',
            'posts_per_page' => -1,          // all services
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ]);

        if ( $services_query->have_posts() ) : ?>

            <div class="hwh-services-grid">
            <?php while ( $services_query->have_posts() ) : $services_query->the_post();
                $icon  = get_post_meta( get_the_ID(), '_service_icon', true ) ?: '';
                $price = get_post_meta( get_the_ID(), '_service_price', true );

                // Excerpt → content → generic fallback (never blank)
                $excerpt = get_post_field( 'post_excerpt', get_the_ID() );
                $content = get_post_field( 'post_content',  get_the_ID() );
                if ( $excerpt ) {
                    $desc = wp_trim_words( $excerpt, 20 );
                } elseif ( $content ) {
                    $desc = wp_trim_words( strip_shortcodes( wp_strip_all_tags( $content ) ), 20 );
                } else {
                    $desc = 'Expert plumbing service from Tampa Bay\'s trusted team. Licensed, insured, and available 24/7.';
                }
            ?>
                <article class="hwh-service-card reveal">

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="hwh-service-card__img">
                        <?php the_post_thumbnail( 'medium', [
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                            'alt'      => esc_attr( get_the_title() ),
                        ] ); ?>
                    </div>
                    <?php elseif ( $icon ) : ?>
                    <div class="hwh-service-card__icon"><?php echo esc_html( $icon ); ?></div>
                    <?php else : ?>
                    <div class="hwh-service-card__icon">🔧</div>
                    <?php endif; ?>

                    <h2 class="hwh-service-card__title"><?php the_title(); ?></h2>
                    <p  class="hwh-service-card__text"><?php echo esc_html( $desc ); ?></p>

                    <?php if ( $price ) : ?>
                    <span class="hwh-service-card__price">From <?php echo esc_html( $price ); ?></span>
                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="hwh-service-card__link">Learn More →</a>

                </article>
            <?php endwhile;
            wp_reset_postdata(); ?>
            </div>

        <?php else : ?>
            <p style="text-align:center;padding:4rem 0;font-size:1.1rem;color:#3D6491;">
                No services found. <a href="<?php echo esc_url( home_url('/contact/') ); ?>">Contact us directly.</a>
            </p>
        <?php endif; ?>

        </div>
    </section>

    <!-- ── Bottom CTA ────────────────────────────────────────────── -->
    <section class="hwh-cta" aria-label="Emergency plumbing CTA">
        <div class="hwh-cta__inner">
            <div>
                <h2 class="hwh-cta__title">Plumbing Emergency?<br>
                    <span style="opacity:.85;font-size:.85em;">We're Available Right Now.</span>
                </h2>
                <p class="hwh-cta__text">
                    Don't let a burst pipe or overflowing drain turn into a renovation.
                    Our emergency crew is standing by 24 hours a day, 7 days a week.
                </p>
            </div>
            <div class="hwh-cta__actions">
                <a href="tel:+18134275862" class="hwh-btn hwh-btn--white hwh-btn--lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    Call 813-42-PLUMB (75862)
                </a>
                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="hwh-btn hwh-btn--ghost-white hwh-btn--lg">
                    Schedule Online
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
