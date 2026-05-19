<?php
/**
 * Spicola Construction — Single Service Template
 * Hero with featured image, body content, trust section, related services, CTA.
 * SEO: title + meta description managed by Yoast SEO.
 */
get_header();

$post_id   = get_the_ID();
$has_image = has_post_thumbnail();
?>

<main class="site-main" id="main-content">

    <!-- ═══════════════════════════════════════════════════════
         HERO — 2-column when featured image exists
         ═══════════════════════════════════════════════════════ -->
    <section class="service-hero<?php echo !$has_image ? ' service-hero--no-image' : ''; ?>"
             aria-label="Service details"
             itemscope itemtype="https://schema.org/Service">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <meta itemprop="areaServed" content="Tampa Bay, FL">
        <span class="service-hero__glow" aria-hidden="true"></span>

        <div class="service-hero__inner">

            <!-- Left: text content -->
            <div class="service-hero__content reveal">

                <nav class="breadcrumbs breadcrumbs--hero" aria-label="Breadcrumb"
                     itemscope itemtype="https://schema.org/BreadcrumbList">
                    <ol class="breadcrumbs__list">
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item"><span itemprop="name">Home</span></a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a href="<?php echo esc_url(home_url('/services/')); ?>" itemprop="item"><span itemprop="name">Services</span></a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                        <li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">
                            <span itemprop="name"><?php the_title(); ?></span>
                            <meta itemprop="position" content="3">
                        </li>
                    </ol>
                </nav>

                <span class="section__label service-hero__cat">Construction Service</span>

                <h1 class="service-hero__title">
                    <?php the_title(); ?><br>
                    <em class="service-hero__location">in Tampa Bay, FL</em>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="service-hero__desc"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>

                <div class="service-hero__actions">
                    <a href="/contact/" class="btn btn--primary btn--lg">Get a Free Quote</a>
                    <a href="tel:+18137326285" class="btn btn--outline btn--lg">Call (813) 732-6285</a>
                </div>
            </div>

            <!-- Right: featured image -->
            <?php if ($has_image): ?>
            <div class="service-hero__image reveal" aria-hidden="true">
                <?php the_post_thumbnail('large', [
                    'loading'       => 'eager',
                    'decoding'      => 'async',
                    'fetchpriority' => 'high',
                    'itemprop'      => 'image',
                    'class'         => 'service-hero__img',
                ]); ?>
                <span class="service-hero__img-glow"></span>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT + STICKY SIDEBAR
         ═══════════════════════════════════════════════════════ -->
    <section class="service-body" aria-label="Service information">
        <div class="section__inner">
            <div class="service-body__layout">

                <!-- Main WP editor content -->
                <div class="service-body__main service-content__body reveal" itemprop="description">
                    <?php the_content(); ?>
                </div>

                <!-- Sticky quick-info & booking sidebar -->
                <aside class="service-body__sidebar reveal" aria-label="Quick booking">
                    <div class="service-sidebar">
                        <h2 class="service-sidebar__title"><?php the_title(); ?></h2>

                        <?php if ($price): ?>
                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Starting At</span>
                            <span class="service-sidebar__value"><?php echo esc_html($price); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($duration): ?>
                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Typical Timeline</span>
                            <span class="service-sidebar__value"><?php echo esc_html($duration); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="service-sidebar__row">
                            <span class="service-sidebar__label">Category</span>
                            <span class="service-sidebar__value"><?php echo esc_html($category_name); ?></span>
                        </div>

                        <div class="service-sidebar__divider"></div>

                        <a href="/contact/" class="btn btn--primary service-sidebar__book">Get a Free Quote</a>
                        <a href="tel:+18137326285" class="service-sidebar__call">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            (813) 732-6285
                        </a>
                        <p class="service-sidebar__fine">Free estimates · Licensed &amp; insured</p>
                    </div>
                </aside>

            </div>
        </div>
    </section>



    <!-- ═══════════════════════════════════════════════════════
         WHY CHOOSE SPICOLA (Static trust section)
         ═══════════════════════════════════════════════════════ -->
    <section class="svc-trust" aria-label="Why choose Spicola Construction">
        <div class="svc-trust__inner">
            <div class="svc-trust__left reveal">
                <span class="section__label section__label--light">The Spicola Difference</span>
                <h2 class="svc-trust__heading">Why Tampa<br><em>Trusts Us</em></h2>
                <p class="svc-trust__desc">We've built our reputation one project at a time — quality craftsmanship, transparent pricing, and results that speak for themselves. That's why Tampa Bay trusts Spicola Construction.</p>
                <div class="svc-trust__stat">
                    <span class="svc-trust__stat-stars">★★★★★</span>
                    <div>
                        <strong>5.0 / 5.0</strong>
                        <span>Google Rating — 50+ Reviews</span>
                    </div>
                </div>
            </div>
            <div class="svc-trust__right reveal">
                <div class="svc-trust__card">
                    <div class="svc-trust__card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="svc-trust__card-body">
                        <strong class="svc-trust__card-num">100%</strong>
                        <h3>Licensed &amp; Insured</h3>
                        <p>Fully licensed general contractor with comprehensive liability coverage. Your project is always protected.</p>
                    </div>
                </div>
                <div class="svc-trust__card">
                    <div class="svc-trust__card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>
                    </div>
                    <div class="svc-trust__card-body">
                        <strong class="svc-trust__card-num">$0</strong>
                        <h3>Hidden Fees</h3>
                        <p>You approve the price in writing before we break ground. Detailed estimates, no change-order surprises.</p>
                    </div>
                </div>
                <div class="svc-trust__card">
                    <div class="svc-trust__card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="svc-trust__card-body">
                        <strong class="svc-trust__card-num">15<span>+</span></strong>
                        <h3>Years Experience</h3>
                        <p>Over 15 years of hands-on construction experience across Tampa Bay. We know Florida building inside and out.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         RELATED SERVICES (Dynamic)
         ═══════════════════════════════════════════════════════ -->
    <?php
    $related_args = [
        'post_type'      => 'service',
        'posts_per_page' => 3,
        'post__not_in'   => [$post_id],
        'orderby'        => 'rand',
        'no_found_rows'  => true,
    ];
    if ($categories && !is_wp_error($categories)) {
        $related_args['tax_query'] = [[
            'taxonomy' => 'service_category',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck($categories, 'term_id'),
        ]];
    }
    $related = new WP_Query($related_args);

    // Backfill if same-cat returned fewer than 3
    if ($related->post_count < 3 && $related->post_count > 0) {
        $found_ids   = wp_list_pluck($related->posts, 'ID');
        $exclude_ids = array_merge([$post_id], $found_ids);
        $backfill    = new WP_Query([
            'post_type'      => 'service',
            'posts_per_page' => 3 - $related->post_count,
            'post__not_in'   => $exclude_ids,
            'orderby'        => 'rand',
            'no_found_rows'  => true,
        ]);
        if ($backfill->have_posts()) {
            $related->posts      = array_merge($related->posts, $backfill->posts);
            $related->post_count = count($related->posts);
        }
    }
    if ($related->have_posts()): ?>
    <section class="related-services" aria-label="Related services">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">More Services</span>
                <h2 class="section__title">Other Services You May Need</h2>
            </div>
            <div class="related-services__grid reveal">
                <?php while ($related->have_posts()): $related->the_post();
                    $r_icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '';
                ?>
                <a href="<?php the_permalink(); ?>" class="service-card">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="service-card__thumb">
                        <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                    </div>
                    <?php else: ?>
                    <div class="service-card__icon" aria-hidden="true"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                    <?php endif; ?>
                    <h3 class="service-card__title"><?php the_title(); ?></h3>
                    <p class="service-card__text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    <span class="service-card__link">Learn More →</span>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         CTA
         ═══════════════════════════════════════════════════════ -->
    <section class="svc-cta" aria-label="Book this service">
        <div class="svc-cta__pulse" aria-hidden="true"></div>
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">Ready to Get Started?</span>
                <h2 class="svc-cta__title">Need <em><?php the_title(); ?></em>?</h2>
                <p class="svc-cta__desc">Call us or request a quote online — we'll provide a free estimate with transparent, upfront pricing before any work begins.</p>
            </div>
            <div class="svc-cta__actions">
                <a href="tel:+18137326285" class="btn btn--primary btn--lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/></svg>
                    Call (813) 732-6285
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                    Get a Free Quote
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
