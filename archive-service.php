<?php
/**
 * Hot Water Heroes Plumbing — Services Archive
 * Simple loop: display all published services from the 'service' CPT.
 */
get_header();
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ItemList",
    "name": "Hot Water Heroes Plumbing Services in Tampa, FL",
    "url": "<?php echo esc_url( home_url( '/services/' ) ); ?>",
    "description": "Expert plumbing services including water heaters, drain cleaning, leak repair, and 24/7 emergency plumbing across Tampa Bay.",
    "itemListOrder": "https://schema.org/ItemListOrderAscending"
}
</script>

<main class="site-main" id="main-content">

    <!-- ── Page Hero ────────────────────────────────────────────── -->
    <section class="page-hero" aria-label="Our plumbing services">
        <div class="page-hero__inner">
            <span class="section__label">What We Do</span>
            <h1 class="page-hero__title">Our Plumbing Services</h1>
            <p class="page-hero__desc">Licensed Tampa Bay plumbers ready same-day. Click any service to learn more.</p>
            <div class="hero__actions hero__actions--center">
                <a href="/contact/" class="btn btn--primary btn--lg">Request Service</a>
                <a href="tel:+18134275862" class="btn btn--outline btn--lg">Call 813-42-PLUMB (75862)</a>
            </div>
        </div>
    </section>

    <!-- ── Services Grid ────────────────────────────────────────── -->
    <section class="svc-archive" aria-label="All services">
        <div class="section__inner">

            <?php if ( have_posts() ) : ?>

                <div class="svc-grid" id="svc-grid">
                    <?php while ( have_posts() ) : the_post();
                        $price    = get_post_meta( get_the_ID(), '_service_price', true );
                        $duration = get_post_meta( get_the_ID(), '_service_duration', true );
                        $terms    = get_the_terms( get_the_ID(), 'service_category' );
                        $cat_name = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'Plumbing';
                    ?>
                    <a href="<?php the_permalink(); ?>"
                       class="svc-card reveal"
                       aria-label="<?php the_title_attribute(); ?>"
                       itemscope itemtype="https://schema.org/Service">
                        <meta itemprop="name" content="<?php the_title_attribute(); ?>">

                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="svc-card__thumb">
                            <?php the_post_thumbnail( 'medium_large', [
                                'loading'  => 'lazy',
                                'decoding' => 'async',
                                'itemprop' => 'image',
                            ] ); ?>
                            <div class="svc-card__thumb-overlay"></div>
                        </div>
                        <?php else : ?>
                        <div class="svc-card__icon-wrap" aria-hidden="true">
                            <span class="svc-card__icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                </svg>
                            </span>
                        </div>
                        <?php endif; ?>

                        <div class="svc-card__body">
                            <span class="svc-card__cat"><?php echo esc_html( $cat_name ); ?></span>
                            <h2 class="svc-card__title"><?php the_title(); ?></h2>
                            <p class="svc-card__text"><?php echo wp_trim_words( get_the_excerpt(), 16 ); ?></p>

                            <?php if ( $price || $duration ) : ?>
                            <div class="svc-card__meta">
                                <?php if ( $price ) : ?>
                                <span class="svc-card__price"><?php echo esc_html( $price ); ?></span>
                                <?php endif; ?>
                                <?php if ( $duration ) : ?>
                                <span class="svc-card__duration">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <?php echo esc_html( $duration ); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <span class="svc-card__cta">
                                View Details
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </span>
                        </div>

                        <span class="svc-card__bar" aria-hidden="true"></span>
                    </a>
                    <?php endwhile; ?>
                </div>

            <?php else : ?>
                <div class="svc-empty">
                    <p>No services found. Please check back soon or <a href="/contact/">contact us directly</a>.</p>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── CTA ──────────────────────────────────────────────────── -->
    <section class="svc-cta" aria-label="Emergency plumbing CTA">
        <div class="svc-cta__pulse" aria-hidden="true"></div>
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">Plumbing Emergency?</span>
                <h2 class="svc-cta__title">We're Available<br><em>Right Now.</em></h2>
                <p class="svc-cta__desc">Don't let a burst pipe or overflowing drain turn into a renovation. Our emergency crew is standing by 24 hours a day, 7 days a week.</p>
            </div>
            <div class="svc-cta__actions">
                <a href="tel:+18134275862" class="btn btn--primary btn--lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/></svg>
                    Call 813-42-PLUMB (75862)
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                    Schedule Online
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
