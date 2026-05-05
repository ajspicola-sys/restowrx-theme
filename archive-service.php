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
                    <span class="svc-hero__chip">✅ Licensed & Insured</span>
                    <span class="svc-hero__chip">⚡ Same-Day Service</span>
                    <span class="svc-hero__chip">🛡️ 1-Year Warranty</span>
                </div>
            </div>

            <!-- Right: illustration + floating stat cards -->
            <div class="svc-hero__visual">

                <!-- Big wrench / pipe SVG illustration -->
                <svg class="svc-hero__illus" viewBox="0 0 400 420" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <!-- Background glow circle -->
                    <circle cx="200" cy="210" r="170" fill="url(#hero-glow)" opacity=".6"/>
                    <defs>
                        <radialGradient id="hero-glow" cx="50%" cy="50%">
                            <stop offset="0%"   stop-color="#F22F3A" stop-opacity=".18"/>
                            <stop offset="100%" stop-color="#18375D" stop-opacity="0"/>
                        </radialGradient>
                    </defs>

                    <!-- Pipe cross: horizontal -->
                    <rect x="40" y="180" width="320" height="55" rx="12" fill="#1E4A7A"/>
                    <rect x="40" y="180" width="320" height="16" rx="8"  fill="#2A5F96" opacity=".5"/>
                    <!-- Pipe: left cap -->
                    <rect x="28" y="172" width="32" height="71" rx="8" fill="#18375D"/>
                    <!-- Pipe: right cap -->
                    <rect x="340" y="172" width="32" height="71" rx="8" fill="#18375D"/>
                    <!-- Pipe cross: vertical -->
                    <rect x="175" y="60" width="55" height="310" rx="12" fill="#1E4A7A"/>
                    <rect x="175" y="60" width="16" height="310" rx="8"  fill="#2A5F96" opacity=".4"/>
                    <!-- Junction circle -->
                    <circle cx="202" cy="207" r="38" fill="#18375D" stroke="#0F2440" stroke-width="4"/>
                    <circle cx="202" cy="207" r="22" fill="#0F2440"/>
                    <circle cx="202" cy="207" r="10" fill="#F22F3A" opacity=".7"/>

                    <!-- Wrench (rotated around center) -->
                    <g class="svc-hero__wrench">
                        <!-- Handle -->
                        <rect x="186" y="230" width="32" height="145" rx="8" fill="#F22F3A"/>
                        <rect x="190" y="230" width="8" height="145" rx="4" fill="#FF6B74" opacity=".35"/>
                        <!-- Head jaw -->
                        <path d="M186 230 l-18-28 a14 14 0 0 1 0-20 l18-10 l32 0 l18 10 a14 14 0 0 1 0 20 l-18 28 z" fill="#AF2D37"/>
                        <!-- Head opening -->
                        <rect x="194" y="175" width="16" height="45" rx="4" fill="#0F2440"/>
                        <!-- Jaw detail lines -->
                        <line x1="185" y1="195" x2="175" y2="188" stroke="#0F2440" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="219" y1="195" x2="229" y2="188" stroke="#0F2440" stroke-width="2.5" stroke-linecap="round"/>
                    </g>

                    <!-- Valve wheel (top of vertical pipe) -->
                    <g class="svc-hero__valve">
                        <circle cx="202" cy="60" r="24" fill="none" stroke="#F22F3A" stroke-width="5"/>
                        <circle cx="202" cy="60" r="8" fill="#AF2D37"/>
                        <line x1="178" y1="60" x2="226" y2="60" stroke="#F22F3A" stroke-width="5" stroke-linecap="round"/>
                        <line x1="202" y1="36" x2="202" y2="84" stroke="#F22F3A" stroke-width="5" stroke-linecap="round"/>
                    </g>

                    <!-- Small water drips from junction -->
                    <circle class="svc-hero__drip svc-hero__drip--1" cx="230" cy="220" r="4" fill="#4DA8FF" opacity=".6"/>
                    <circle class="svc-hero__drip svc-hero__drip--2" cx="175" cy="225" r="3" fill="#4DA8FF" opacity=".5"/>
                    <circle class="svc-hero__drip svc-hero__drip--3" cx="215" cy="235" r="3.5" fill="#4DA8FF" opacity=".45"/>
                </svg>

                <!-- Floating stat cards -->
                <div class="svc-hero__float svc-hero__float--1">
                    <strong>4.9★</strong>
                    <span>Google Rating</span>
                </div>
                <div class="svc-hero__float svc-hero__float--2">
                    <strong>2,400+</strong>
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
            <?php if ( have_posts() ) : ?>

                <div class="svc-grid" id="svc-grid">
                    <?php while ( have_posts() ) : the_post();
                        $icon     = get_post_meta( get_the_ID(), '_service_icon', true ) ?: '🔧';
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
                            <span class="svc-card__icon"><?php echo esc_html( $icon ); ?></span>
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
                    <span class="svc-empty__icon">🚧</span>
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
                <strong class="svc-stat__num">2,400<span>+</span></strong>
                <span class="svc-stat__label">Happy Customers</span>
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
         WHY HWH
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-why" aria-label="Why choose Hot Water Heroes">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why HWH</span>
                <h2 class="section__title">Tampa's Most Trusted Plumbers</h2>
                <p class="section__desc">We don't just fix the leak — we fix the source, explain every step, and stand behind our work.</p>
            </div>
            <div class="svc-why__grid reveal">

                <div class="svc-why__card">
                    <div class="svc-why__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="svc-why__title">Licensed &amp; Fully Insured</h3>
                    <p class="svc-why__text">Every technician is state-licensed, background-checked, and covered by full liability insurance so your home is always protected.</p>
                </div>

                <div class="svc-why__card">
                    <div class="svc-why__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3 class="svc-why__title">Same-Day Availability</h3>
                    <p class="svc-why__text">We keep trucks stocked and technicians dispatched daily. Most calls are answered and on-site within 60 minutes — no waiting days for an appointment.</p>
                </div>

                <div class="svc-why__card">
                    <div class="svc-why__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>
                    </div>
                    <h3 class="svc-why__title">Upfront, Flat-Rate Pricing</h3>
                    <p class="svc-why__text">You'll know the full price before any work begins — no surprise invoices, no hourly guesswork. What we quote is what you pay.</p>
                </div>

                <div class="svc-why__card">
                    <div class="svc-why__icon" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <h3 class="svc-why__title">1-Year Labor Warranty</h3>
                    <p class="svc-why__text">Every repair and installation is backed by a 12-month labor warranty. If anything goes wrong, we come back and make it right — at no cost.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         EMERGENCY CTA BANNER
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-cta" aria-label="Emergency plumbing CTA">
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">🚨 Plumbing Emergency?</span>
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
