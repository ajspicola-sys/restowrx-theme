<?php
/**
 * Hot Water Heroes — Services Archive
 * Explicit WP_Query. Clean card rebuild with full-bleed top image.
 */
get_header();
?>

<style>
/* ── Service Archive Card — proper full-bleed image structure ─── */
.svc-archive-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.75rem;
}
.svc-card {
    background: #fff;
    border: 1.5px solid #E5EBF5;
    border-radius: 18px;
    overflow: hidden;           /* clips image to card corners    */
    display: flex;
    flex-direction: column;
    transition: all .35s ease;
    position: relative;
    text-decoration: none;
}
.svc-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #F22F3A, #F0595F);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .35s ease;
    z-index: 1;
}
.svc-card:hover {
    border-color: #F22F3A;
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(0,0,0,.1);
}
.svc-card:hover::before { transform: scaleX(1); }

/* Image — sits flush against all 3 sides at the top */
.svc-card__img {
    width: 100%;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    flex-shrink: 0;
}
.svc-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s ease;
}
.svc-card:hover .svc-card__img img { transform: scale(1.05); }

/* Icon fallback */
.svc-card__icon {
    font-size: 2.5rem;
    padding: 1.75rem 2rem 0;
    line-height: 1;
}

/* Content area */
.svc-card__body {
    padding: 1.5rem 2rem 2rem;
    display: flex;
    flex-direction: column;
    gap: .65rem;
    flex: 1;
}
.svc-card__title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1rem;
    font-weight: 800;
    color: #0F2440;
    line-height: 1.2;
    margin: 0;
}
.svc-card__text {
    font-size: .88rem;
    color: #3D6491;
    line-height: 1.65;
    flex: 1;
    margin: 0;
}
.svc-card__price {
    font-size: .78rem;
    font-weight: 700;
    color: #F22F3A;
    letter-spacing: .04em;
}
.svc-card__link {
    font-size: .82rem;
    font-weight: 700;
    color: #F22F3A;
    text-decoration: none;
    display: inline-block;
    margin-top: .25rem;
    transition: letter-spacing .2s ease;
}
.svc-card:hover .svc-card__link { letter-spacing: .05em; }

@media (max-width: 1024px) {
    .svc-archive-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .svc-archive-grid { grid-template-columns: 1fr; }
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

    <!-- ── Services Grid ─────────────────────────────────────────── -->
    <section class="hwh-services" aria-label="All plumbing services" style="background:#F8F9FB;padding:5rem 0;">
        <div class="hwh-section-inner">

        <?php
        $services_query = new WP_Query([
            'post_type'      => 'service',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ]);

        if ( $services_query->have_posts() ) : ?>

            <div class="svc-archive-grid">
            <?php while ( $services_query->have_posts() ) : $services_query->the_post();
                $icon  = get_post_meta( get_the_ID(), '_service_icon', true ) ?: '';
                $price = get_post_meta( get_the_ID(), '_service_price', true );

                // Excerpt → content body → generic fallback
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
                <article class="svc-card">

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="svc-card__img">
                        <?php the_post_thumbnail( 'large', [
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                            'alt'      => esc_attr( get_the_title() ),
                        ] ); ?>
                    </div>
                    <?php elseif ( $icon ) : ?>
                    <div class="svc-card__icon"><?php echo esc_html( $icon ); ?></div>
                    <?php else : ?>
                    <div class="svc-card__icon">🔧</div>
                    <?php endif; ?>

                    <div class="svc-card__body">
                        <h2 class="svc-card__title"><?php the_title(); ?></h2>
                        <p  class="svc-card__text"><?php echo esc_html( $desc ); ?></p>
                        <?php if ( $price ) : ?>
                        <span class="svc-card__price">From <?php echo esc_html( $price ); ?></span>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="svc-card__link">Learn More →</a>
                    </div>

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
