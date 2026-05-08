<?php
/**
 * Hot Water Heroes Plumbing — Services Archive
 * Full redesign: dark hero, sticky filter bar, premium service cards,
 * stats strip, Why-HWH trust section, emergency CTA.
 */
get_header();

$all_cats = get_terms( [
    'taxonomy'   => 'service_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
] );
?>

<!-- ── Schema: Service Catalog ─────────────────────────────────── -->
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

    <!-- ════════════════════════════════════════════════════════════
         HERO — Split layout: text + animated illustration
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-hero" aria-label="Services overview">

        <!-- Animated background layers -->
        <div class="svc-hero__bg" aria-hidden="true">
            <!-- Diagonal accent stripe -->
            <div class="svc-hero__stripe"></div>
            <!-- Floating water drops -->
            <span class="svc-hero__drop" style="--x:12%; --y:20%; --s:6px; --d:0s;   --dur:14s;"></span>
            <span class="svc-hero__drop" style="--x:85%; --y:35%; --s:4px; --d:3s;   --dur:18s;"></span>
            <span class="svc-hero__drop" style="--x:65%; --y:75%; --s:8px; --d:7s;   --dur:12s;"></span>
            <span class="svc-hero__drop" style="--x:30%; --y:60%; --s:5px; --d:5s;   --dur:16s;"></span>
            <span class="svc-hero__drop" style="--x:50%; --y:15%; --s:3px; --d:10s;  --dur:20s;"></span>
            <span class="svc-hero__drop" style="--x:92%; --y:80%; --s:7px; --d:2s;   --dur:15s;"></span>
        </div>

        <div class="svc-hero__inner">

            <!-- Left: copy -->
            <div class="svc-hero__text">
                <div class="svc-hero__badge">
                    <span class="svc-hero__badge-dot"></span>
                    Available Now — 24/7 Emergency
                </div>

                <h1 class="svc-hero__title">
                    Tampa Bay's<br>
                    <em>Plumbing</em> Experts.
                </h1>

                <p class="svc-hero__desc">From burst pipes to full water-heater installs, our licensed pros arrive fast, fix it right the first time, and clean up when they leave. No guesswork, no surprise bills.</p>

                <div class="svc-hero__actions">
                    <a href="tel:+18134275862" class="btn btn--primary btn--lg">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/></svg>
                        Call 813-42-PLUMB
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                        Request a Quote
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Trust chips -->
                <div class="svc-hero__chips">
                    <span class="svc-hero__chip">Licensed & Insured</span>
                    <span class="svc-hero__chip">Same-Day Service</span>
                    <span class="svc-hero__chip">Upfront Pricing</span>
                </div>
            </div>

            <!-- Right: Heaty mascot + floating stat cards -->
            <div class="svc-hero__visual">

                <!-- Glow backdrop behind Heaty -->
                <div class="svc-hero__mascot-glow" aria-hidden="true"></div>

                <!-- Heaty mascot image -->
                <img
                    src="https://hotwaterheroesplumbing.com/wp-content/uploads/2026/05/Heaty-Normal.png"
                    alt="Heaty — Hot Water Heroes mascot"
                    class="svc-hero__mascot"
                    width="420"
                    height="480"
                    loading="eager"
                    decoding="async"
                >

                <!-- Floating stat cards around Heaty -->
                <div class="svc-hero__float svc-hero__float--1">
                    <strong>4.9★</strong>
                    <span>Google Rating</span>
                </div>
                <div class="svc-hero__float svc-hero__float--2">
                    <strong>5?</strong>
                    <span>Jobs Completed</span>
                </div>
                <div class="svc-hero__float svc-hero__float--3">
                    <strong>&lt;60 min</strong>
                    <span>Avg. Response</span>
                </div>
            </div>

        </div>
    </section>


    <!-- ════════════════════════════════════════════════════════════
         STICKY CATEGORY FILTER
         ════════════════════════════════════════════════════════════ -->
    <?php if ( $all_cats && ! is_wp_error( $all_cats ) ) : ?>
    <section class="svc-filter" aria-label="Filter by service category">
        <div class="svc-filter__inner">
            <div class="svc-filter__bar" role="tablist" aria-label="Service categories">
                <button class="svc-filter__btn is-active"
                        role="tab"
                        aria-selected="true"
                        data-filter="all"
                        id="svc-filter-all">
                    All Services
                </button>
                <?php foreach ( $all_cats as $cat ) : ?>
                <button class="svc-filter__btn"
                        role="tab"
                        aria-selected="false"
                        data-filter="<?php echo esc_attr( $cat->slug ); ?>"
                        id="svc-filter-<?php echo esc_attr( $cat->slug ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ════════════════════════════════════════════════════════════
         SERVICES GRID
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-archive" aria-label="All services">
        <div class="section__inner">

            <!-- Section intro -->
            <div class="svc-archive__header reveal">
                <div class="svc-archive__header-text">
                    <span class="section__label">What We Do</span>
                    <h2 class="section__title">Our Plumbing Services</h2>
                    <p class="section__desc">Click any service to learn more about what's included, pricing, and how fast we can get to you.</p>
                </div>
                <?php
                    global $wp_query;
                    $total = $wp_query->found_posts ?? 0;
                ?>
                <?php if ( $total > 0 ) : ?>
                <div class="svc-archive__count" aria-hidden="true">
                    <strong><?php echo intval( $total ); ?></strong>
                    <span>services available</span>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( have_posts() ) : ?>

                <div class="svc-grid" id="svc-grid">
                    <?php while ( have_posts() ) : the_post();
                        $icon     = get_post_meta( get_the_ID(), '_service_icon', true ) ?: '';
                        $price    = get_post_meta( get_the_ID(), '_service_price', true );
                        $duration = get_post_meta( get_the_ID(), '_service_duration', true );

                        $terms     = get_the_terms( get_the_ID(), 'service_category' );
                        $cat_slugs = '';
                        $cat_name  = 'Plumbing';
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            $cat_slugs = implode( ' ', wp_list_pluck( $terms, 'slug' ) );
                            $cat_name  = $terms[0]->name;
                        }
                    ?>
                    <a href="<?php the_permalink(); ?>"
                       class="svc-card reveal"
                       aria-label="<?php the_title_attribute(); ?>"
                       data-cats="<?php echo esc_attr( $cat_slugs ); ?>"
                       itemscope
                       itemtype="https://schema.org/Service">
                        <meta itemprop="name" content="<?php the_title_attribute(); ?>">

                        <!-- Image or icon fallback -->
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
                            <span class="svc-card__icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
                        </div>
                        <?php endif; ?>

                        <!-- Body -->
                        <div class="svc-card__body">
                            <span class="svc-card__cat"><?php echo esc_html( $cat_name ); ?></span>
                            <h2 class="svc-card__title"><?php the_title(); ?></h2>
                            <p class="svc-card__text"><?php echo wp_trim_words( get_the_excerpt(), 16 ); ?></p>

                            <?php if ( $price || $duration ) : ?>
                            <div class="svc-card__meta">
                                <?php if ( $price ) : ?>
                                <span class="svc-card__price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                    <meta itemprop="priceCurrency" content="USD">
                                    <span itemprop="price"><?php echo esc_html( $price ); ?></span>
                                </span>
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

                        <!-- Animated top bar on hover -->
                        <span class="svc-card__bar" aria-hidden="true"></span>
                    </a>
                    <?php endwhile; ?>
                </div><!-- /.svc-grid -->

                <!-- No-results (shown by JS filter) -->
                <div class="svc-no-results" id="svc-no-results" hidden aria-live="polite">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <p>No services found in that category.</p>
                    <button class="btn btn--outline" onclick="document.getElementById('svc-filter-all').click()">Show All</button>
                </div>

            <?php else : ?>
                <!-- Empty state -->
                <div class="svc-empty">
                    <span class="svc-empty__icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></span>
                    <h2 class="svc-empty__title">Services Coming Soon</h2>
                    <p class="svc-empty__text">We're loading our full service menu. Call us directly and we'll get you sorted.</p>
                    <a href="tel:+18134275862" class="btn btn--primary btn--lg">Call Now</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         STATS STRIP
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-stats" aria-label="Company stats">
        <div class="section__inner svc-stats__inner">
            <div class="svc-stat">
                <strong class="svc-stat__num">5.0<span>?</span></strong>
                <span class="svc-stat__label">Google Rated</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">15<span>+</span></strong>
                <span class="svc-stat__label">Years in Tampa Bay</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">24/7</strong>
                <span class="svc-stat__label">Emergency Response</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">4.9<span>★</span></strong>
                <span class="svc-stat__label">Google Rating</span>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         HOW IT WORKS — Process steps
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-process" aria-label="How it works">
        <div class="section__inner">
            <div class="section__header reveal" style="text-align:center;">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">From Call to Completion<br>in 4 Simple Steps</h2>
            </div>
            <div class="svc-process__steps reveal">
                <div class="svc-process__step">
                    <div class="svc-process__num">1</div>
                    <div class="svc-process__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h3 class="svc-process__title">Call or Book Online</h3>
                    <p class="svc-process__text">Reach us by phone or fill out a quick form. We'll match you with the right technician.</p>
                </div>
                <div class="svc-process__connector" aria-hidden="true"></div>
                <div class="svc-process__step">
                    <div class="svc-process__num">2</div>
                    <div class="svc-process__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3 class="svc-process__title">Fast Dispatch</h3>
                    <p class="svc-process__text">A licensed tech arrives — usually within 60 minutes, with a fully stocked truck.</p>
                </div>
                <div class="svc-process__connector" aria-hidden="true"></div>
                <div class="svc-process__step">
                    <div class="svc-process__num">3</div>
                    <div class="svc-process__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>
                    </div>
                    <h3 class="svc-process__title">Upfront Quote</h3>
                    <p class="svc-process__text">We diagnose the issue and give you the full price before work starts. No surprises.</p>
                </div>
                <div class="svc-process__connector" aria-hidden="true"></div>
                <div class="svc-process__step">
                    <div class="svc-process__num">4</div>
                    <div class="svc-process__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <h3 class="svc-process__title">Done & Guaranteed</h3>
                    <p class="svc-process__text">We complete the job, clean up, and make sure everything is working perfectly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         EMERGENCY CTA BANNER
         ════════════════════════════════════════════════════════════ -->
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
                        Call 813-42-PLUMB
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                        Schedule Online
                    </a>
                </div>
        </div>
    </section>

</main>

<script>
/* ── Service category filter — lightweight, no jQuery ──────────── */
(function () {
    'use strict';
    var bar = document.querySelector('.svc-filter__bar');
    if (!bar) return;

    var cards     = document.querySelectorAll('.svc-card[data-cats]');
    var noResults = document.getElementById('svc-no-results');
    var current   = 'all';

    bar.addEventListener('click', function (e) {
        var btn = e.target.closest('.svc-filter__btn');
        if (!btn) return;

        var filter = btn.dataset.filter;
        if (filter === current) return;
        current = filter;

        bar.querySelectorAll('.svc-filter__btn').forEach(function (b) {
            b.classList.toggle('is-active', b === btn);
            b.setAttribute('aria-selected', b === btn ? 'true' : 'false');
        });

        var visible = 0;
        cards.forEach(function (card) {
            var cats = card.dataset.cats ? card.dataset.cats.split(' ') : [];
            var show = filter === 'all' || cats.indexOf(filter) !== -1;
            card.hidden = !show;
            if (show) visible++;
        });

        if (noResults) noResults.hidden = visible > 0;
    });
}());
</script>

<?php get_footer(); ?>
