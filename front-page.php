<?php
/**
 * Template Name: Homepage
 * Hot Water Heroes Plumbing — Front Page v3 (Bold Redesign)
 */
get_header(); ?>

<main class="site-main" id="main-content">

<!-- ── Structured Data ── -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": ["Plumber", "HomeAndConstructionBusiness", "LocalBusiness"],
    "@id": "<?php echo esc_url(home_url('/')); ?>#business",
    "name": "Hot Water Heroes Plumbing",
    "alternateName": "HWH Plumbing",
    "description": "Tampa Bay's trusted plumbing company — expert water heater repair, installation, drain cleaning, leak detection, and 24/7 emergency plumbing services.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18134275862",
    "email": "joe@hotwaterheroesplumbing.com",
    "priceRange": "$$",
    "image": "<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-logo.png",
    "address": { "@type": "PostalAddress", "addressLocality": "Tampa", "addressRegion": "FL", "addressCountry": "US" },
    "areaServed": [
        {"@type":"City","name":"Tampa"},{"@type":"City","name":"St. Petersburg"},
        {"@type":"City","name":"Clearwater"},{"@type":"City","name":"Brandon"},
        {"@type":"City","name":"Wesley Chapel"},{"@type":"City","name":"Riverview"}
    ],
    "aggregateRating": {"@type":"AggregateRating","ratingValue":"5","reviewCount":"30","bestRating":"5"},
    "sameAs": ["https://www.instagram.com/hotwaterheroes/","https://www.facebook.com/hotwaterheroes/"]
}
</script>

<!-- ══════════════════════════════════════════════════════
     HERO — Dark navy, bold red, full impact
     ══════════════════════════════════════════════════════ -->
<section class="hwh-hero" id="hero" aria-label="Hot Water Heroes Plumbing">
    <div class="hwh-hero__overlay" aria-hidden="true"></div>
    <div class="hwh-hero__grid" aria-hidden="true"></div>

    <div class="hwh-hero__inner">
        <div class="hwh-hero__content">
            <div class="hwh-hero__eyebrow">
                <span class="hwh-hero__dot" aria-hidden="true"></span>
                24/7 Emergency Plumbing · Tampa Bay, FL
            </div>

            <h1 class="hwh-hero__title">
                Your Plumbing Heroes.<br>
                <span class="hwh-hero__title-accent">We Fix It Today.</span>
            </h1>

            <p class="hwh-hero__sub">
                Licensed plumbers on call around the clock. Water heater repair, installation, drain cleaning & emergency plumbing — done right, backed by a satisfaction guarantee.
            </p>

            <div class="hwh-hero__actions">
                <a href="tel:+18134275862" class="hwh-btn hwh-btn--red hwh-btn--lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    813-42-PLUMB — (813) 427-5862
                </a>
                <a href="/contact/" class="hwh-btn hwh-btn--ghost hwh-btn--lg">
                    Book Online →
                </a>
            </div>

            <div class="hwh-hero__trust">
                <div class="hwh-hero__trust-item">✔ Licensed &amp; Insured</div>
                <div class="hwh-hero__trust-item">✔ Same-Day Service</div>
                <div class="hwh-hero__trust-item">✔ 5★ Google Rating</div>
                <div class="hwh-hero__trust-item">✔ No Hidden Fees</div>
            </div>
        </div>

        <div class="hwh-hero__visual" aria-hidden="true">
            <div class="hwh-hero__van-wrap">
                <img src="https://hotwaterheroesplumbing.com/wp-content/uploads/2025/12/HWH-HERO-VAN.png"
                     alt="Hot Water Heroes plumbing service van"
                     width="680" height="480"
                     fetchpriority="high" loading="eager" decoding="async"
                     class="hwh-hero__van">
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     STATS BAR — Red background, bold numbers
     ══════════════════════════════════════════════════════ -->
<section class="hwh-stats" aria-label="Company stats">
    <div class="hwh-stats__inner">
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">300+</span>
            <span class="hwh-stat-item__label">Jobs Completed</span>
        </div>
        <div class="hwh-stat-item__div" aria-hidden="true"></div>
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">30+</span>
            <span class="hwh-stat-item__label">5-Star Reviews</span>
        </div>
        <div class="hwh-stat-item__div" aria-hidden="true"></div>
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">24/7</span>
            <span class="hwh-stat-item__label">Emergency Service</span>
        </div>
        <div class="hwh-stat-item__div" aria-hidden="true"></div>
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">8+</span>
            <span class="hwh-stat-item__label">Cities Covered</span>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     SERVICES — Clean bold grid
     ══════════════════════════════════════════════════════ -->
<section class="hwh-services" id="services" aria-label="Our plumbing services">
    <div class="hwh-section-inner">
        <div class="hwh-section-header">
            <span class="hwh-label">What We Do</span>
            <h2 class="hwh-section-title">Plumbing Services<br><em>Built Around You</em></h2>
            <p class="hwh-section-desc">From water heater emergencies to routine drain cleaning — we handle it all with speed, skill, and upfront pricing.</p>
        </div>

        <?php
        $services = new WP_Query([
            'post_type'      => 'service',
            'posts_per_page' => 6,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ]);
        $fallback = [
            ['title'=>'Water Heater Repair',      'text'=>'Fast diagnosis and repair of all water heater brands and sizes. No hot water? We fix it same-day.'],
            ['title'=>'Water Heater Installation', 'text'=>'Full installation of tank and tankless units — properly sized, up to code, done right the first time.'],
            ['title'=>'Tankless Water Heaters',   'text'=>'Endless hot water with a tankless upgrade. We sell, install, and service all major brands.'],
            ['title'=>'Drain Cleaning',           'text'=>'Slow drains or full blockages cleared with hydro-jetting and professional snaking.'],
            ['title'=>'Emergency Plumbing',       'text'=>'Burst pipe? Major leak? We\'re available 24/7 — nights, weekends, and holidays.'],
            ['title'=>'Leak Detection & Repair',  'text'=>'Non-invasive technology finds hidden leaks before they cause major damage to your home.'],
        ];
        ?>

        <div class="hwh-services-grid">
            <?php if ($services->have_posts()) :
                while ($services->have_posts()) : $services->the_post();
                    $icon  = get_post_meta(get_the_ID(), '_service_icon', true) ?: '';
                    $price = get_post_meta(get_the_ID(), '_service_price', true);
            ?>
                <article class="hwh-service-card reveal">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="hwh-service-card__img">
                        <?php the_post_thumbnail("medium", ["loading" => "lazy", "decoding" => "async"]); ?>
                    </div>
                    <?php elseif ($icon && strlen($icon) > 4) : ?>
                    <div class="hwh-service-card__icon"><?php echo esc_html($icon); ?></div>
                    <?php endif; ?>
                    <h3 class="hwh-service-card__title"><?php the_title(); ?></h3>
                    <p class="hwh-service-card__text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <?php if ($price) : ?>
                        <span class="hwh-service-card__price">From <?php echo esc_html($price); ?></span>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="hwh-service-card__link">Learn More →</a>
                </article>
            <?php endwhile; wp_reset_postdata();
            else :
                foreach ($fallback as $svc) : ?>
                <article class="hwh-service-card reveal">
                    <h3 class="hwh-service-card__title"><?php echo esc_html($svc['title']); ?></h3>
                    <p class="hwh-service-card__text"><?php echo esc_html($svc['text']); ?></p>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="hwh-service-card__link">Learn More →</a>
                </article>
            <?php endforeach; endif; ?>
        </div>

        <div class="hwh-center hwh-center--spaced">
            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="hwh-btn hwh-btn--navy hwh-btn--lg">See All Services →</a>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     HOW IT WORKS — Dark navy, bold numbered steps
     ══════════════════════════════════════════════════════ -->
<section class="hwh-process" aria-label="How our service works">
    <div class="hwh-section-inner">
        <div class="hwh-section-header hwh-section-header--light">
            <span class="hwh-label hwh-label--red">How It Works</span>
            <h2 class="hwh-section-title hwh-section-title--white">Service in 4 Simple Steps</h2>
            <p class="hwh-section-desc hwh-section-desc--muted">We make plumbing repairs painless — fast, transparent, and done right the first time.</p>
        </div>
        <div class="hwh-process-steps">
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">01</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                <h3 class="hwh-process-step__title">Call or Book Online</h3>
                <p class="hwh-process-step__text">Reach us 24/7 by phone or schedule online. We confirm your appointment fast — often same-day.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">02</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
                <h3 class="hwh-process-step__title">We Show Up On Time</h3>
                <p class="hwh-process-step__text">A licensed plumber arrives fully equipped and ready. We respect your time and your home.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">03</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                <h3 class="hwh-process-step__title">Diagnose &amp; Quote</h3>
                <p class="hwh-process-step__text">We find the problem and give you a clear, upfront price. No surprises, no pressure.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">04</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                <h3 class="hwh-process-step__title">Fixed &amp; Guaranteed</h3>
                <p class="hwh-process-step__text">We complete the work cleanly and efficiently. Every job is backed by our satisfaction guarantee.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     WHY CHOOSE US — Light bg, bold trust signals
     ══════════════════════════════════════════════════════ -->
<section class="hwh-why" aria-label="Why choose Hot Water Heroes">
    <div class="hwh-section-inner">
        <div class="hwh-why__grid">
            <div class="hwh-why__content reveal">
                <span class="hwh-label">The HWH Difference</span>
                <h2 class="hwh-section-title">Why Tampa Bay<br>Chooses <em>Us</em></h2>
                <p class="hwh-section-desc">We built our reputation one job at a time — showing up when others won't, being honest about pricing, and doing work that lasts.</p>
                <ul class="hwh-why__list">
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>State-Licensed &amp; Fully Insured</strong>
                            <p>Every technician is background-checked and licensed for your protection.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>Upfront, Honest Pricing</strong>
                            <p>You get a clear quote before any work begins. No hidden fees, ever.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>Water Heater Specialists</strong>
                            <p>All brands, all types — including tankless conversions and full replacements.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>True 24/7 Emergency Response</strong>
                            <p>We actually answer nights, weekends, and holidays — no voicemail runaround.</p>
                        </div>
                    </li>
                </ul>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="hwh-btn hwh-btn--red">Meet Our Team →</a>
            </div>
            <div class="hwh-why__stats reveal">
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">300+</span>
                    <span class="hwh-why__stat-lbl">Jobs Completed</span>
                </div>
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">30+</span>
                    <span class="hwh-why__stat-lbl">5-Star Reviews</span>
                </div>
                <div class="hwh-why__stat-card hwh-why__stat-card--accent">
                    <span class="hwh-why__stat-num">24/7</span>
                    <span class="hwh-why__stat-lbl">Always Available</span>
                </div>
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">100%</span>
                    <span class="hwh-why__stat-lbl">Satisfaction Guaranteed</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     TESTIMONIALS — Split: mascot left, 2-up carousel right
     ══════════════════════════════════════════════════════ -->
<section class="hwh-reviews" aria-label="Customer reviews">
    <div class="hwh-section-inner">
        <div class="hwh-reviews-split">

            <!-- LEFT: Mascot visual -->
            <div class="hwh-reviews-split__visual reveal">
                <div class="hwh-reviews-split__img-wrap">
                    <img src="https://hotwaterheroesplumbing.com/wp-content/uploads/2026/05/Heaty-Phone.png"
                         alt="Heaty the Hot Water Heroes mascot checking reviews on his phone"
                         loading="lazy" decoding="async" width="520" height="580"
                         class="hwh-reviews-split__img">
                </div>
                <div class="hwh-reviews-split__badge">
                    <span class="hwh-reviews-split__badge-stars">★★★★★</span>
                    <span class="hwh-reviews-split__badge-text">5.0 on Google — 30+ Reviews</span>
                </div>
            </div>

            <!-- RIGHT: Carousel (2 visible at a time) -->
            <div class="hwh-reviews-split__cards reveal">
                <div class="hwh-reviews-split__header">
                    <span class="hwh-label hwh-label--red">Real Customers</span>
                    <h2 class="hwh-section-title hwh-section-title--white">What Tampa Bay Says<br><em>About Us</em></h2>
                </div>

                <div class="hwh-rev-carousel" id="reviews-carousel" role="region" aria-label="Customer reviews carousel">
                    <div class="hwh-rev-carousel__track">

                        <article class="hwh-review-card hwh-review-card--stacked">
                            <span class="hwh-review-card__stars" role="img" aria-label="5 stars">★★★★★</span>
                            <p class="hwh-review-card__text">"Hot Water Heroes are amazing. Fantastic communication, great plumbers, super nice and best of all your pricing seems very fair. I'm a realtor in this area for 23 years and I use them for my personal home. Such an awesome job — I highly recommend them."</p>
                            <div class="hwh-review-card__author">
                                <strong>Bridget Breland</strong>
                                <span>Google Review · Local Guide</span>
                            </div>
                        </article>

                        <article class="hwh-review-card hwh-review-card--stacked">
                            <span class="hwh-review-card__stars" role="img" aria-label="5 stars">★★★★★</span>
                            <p class="hwh-review-card__text">"Hot Water Heroes was absolutely outstanding! John was professional, knowledgeable, and showed up right on time. He quickly diagnosed the issue, explained everything clearly, and had it fixed faster than I expected. The pricing was fair and the quality of work was top-notch."</p>
                            <div class="hwh-review-card__author">
                                <strong>Kirby Cummings</strong>
                                <span>Google Review</span>
                            </div>
                        </article>

                        <article class="hwh-review-card hwh-review-card--stacked">
                            <span class="hwh-review-card__stars" role="img" aria-label="5 stars">★★★★★</span>
                            <p class="hwh-review-card__text">"Wow, great service, good pricing, professional and explained everything. Good to see such service and pricing still exist. I will be calling you first for all my plumbing needs. It was a pleasure to have service like this during the holidays. Keep up the good work!"</p>
                            <div class="hwh-review-card__author">
                                <strong>Mark Watklevicz</strong>
                                <span>Google Review</span>
                            </div>
                        </article>



                    </div>

                    <div class="hwh-rev-carousel__controls">
                        <button class="hwh-rev-carousel__btn" id="rev-prev" aria-label="Previous reviews">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <div class="hwh-rev-carousel__dots" id="rev-dots" role="tablist"></div>
                        <button class="hwh-rev-carousel__btn" id="rev-next" aria-label="Next reviews">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
(function(){
    var track   = document.querySelector('.hwh-rev-carousel__track');
    var cards   = track ? Array.from(track.querySelectorAll('.hwh-review-card--stacked')) : [];
    var dotsEl  = document.getElementById('rev-dots');
    var prevBtn = document.getElementById('rev-prev');
    var nextBtn = document.getElementById('rev-next');
    if (!track || cards.length < 2) return;

    var perPage = 2;
    var total   = cards.length;
    var pages   = Math.ceil(total / perPage);
    var current = 0;

    // Build dots
    for (var i = 0; i < pages; i++) {
        var dot = document.createElement('button');
        dot.className = 'hwh-rev-carousel__dot' + (i === 0 ? ' is-active' : '');
        dot.setAttribute('role', 'tab');
        dot.setAttribute('aria-label', 'Page ' + (i + 1));
        (function(idx){ dot.addEventListener('click', function(){ goTo(idx); }); })(i);
        dotsEl.appendChild(dot);
    }

    function goTo(page) {
        current = ((page % pages) + pages) % pages;
        var start = current * perPage;
        cards.forEach(function(c, i) {
            c.style.display = (i >= start && i < start + perPage) ? '' : 'none';
            c.style.opacity = '0';
            c.style.transform = 'translateY(8px)';
            if (i >= start && i < start + perPage) {
                requestAnimationFrame(function(){
                    requestAnimationFrame(function(){
                        c.style.transition = 'opacity .35s ease, transform .35s ease';
                        c.style.opacity = '1';
                        c.style.transform = 'translateY(0)';
                    });
                });
            }
        });
        dotsEl.querySelectorAll('.hwh-rev-carousel__dot').forEach(function(d, i){
            d.classList.toggle('is-active', i === current);
        });
    }

    prevBtn.addEventListener('click', function(){ goTo(current - 1); });
    nextBtn.addEventListener('click', function(){ goTo(current + 1); });
    goTo(0);
})();
</script>


<!-- ══════════════════════════════════════════════════════
     SERVICE AREAS — Light bg, city grid
     ══════════════════════════════════════════════════════ -->
<section class="hwh-areas" aria-label="Service areas">
    <div class="hwh-section-inner">
        <div class="hwh-areas__grid">
            <div class="hwh-areas__content reveal">
                <span class="hwh-label">Where We Work</span>
                <h2 class="hwh-section-title">Serving All of<br><em>Tampa Bay</em></h2>
                <p class="hwh-section-desc">Hillsborough, Pinellas, and Pasco County — if you're in the Tampa Bay area, we've got you covered with fast, reliable plumbing service.</p>
                <div class="hwh-areas__cities">
                    <span class="hwh-areas__city">Tampa &amp; South Tampa</span>
                    <span class="hwh-areas__city">St. Pete &amp; Clearwater</span>
                    <span class="hwh-areas__city">Brandon &amp; Riverview</span>
                    <span class="hwh-areas__city">Wesley Chapel &amp; Lutz</span>
                    <span class="hwh-areas__city">Carrollwood &amp; Westchase</span>
                    <span class="hwh-areas__city">Land O' Lakes &amp; Odessa</span>
                    <span class="hwh-areas__city">Lithia &amp; Valrico</span>
                    <span class="hwh-areas__city">New Tampa &amp; Zephyrhills</span>
                </div>
                <a href="<?php echo esc_url(home_url('/service-areas/')); ?>" class="hwh-btn hwh-btn--navy">View All Areas →</a>
            </div>
            <div class="hwh-areas__visual reveal">
                <img src="<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-service-area-map.png"
                     alt="Hot Water Heroes service area map — Tampa Bay FL"
                     loading="lazy" decoding="async" width="500" height="500"
                     class="hwh-areas__map">
                <div class="hwh-areas__badge">
                    <span>Same-Day Available</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     CTA — Bold red, full width
     ══════════════════════════════════════════════════════ -->
<section class="hwh-cta" id="request-service" aria-label="Request plumbing service">
    <div class="hwh-cta__inner reveal">
        <div class="hwh-cta__content">
            <span class="hwh-label hwh-label--white">Get Help Today</span>
            <h2 class="hwh-cta__title">Plumbing Problem?<br>We're On Our Way.</h2>
            <p class="hwh-cta__text">Don't let a small leak turn into a big headache. Call now or book online — available 24/7 across all of Tampa Bay.</p>
        </div>
        <div class="hwh-cta__actions">
            <a href="tel:+18134275862" class="hwh-btn hwh-btn--white hwh-btn--lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                Call 813-42-PLUMB (75862)
            </a>
            <a href="/contact/" class="hwh-btn hwh-btn--ghost-white hwh-btn--lg">
                Request Service Online →
            </a>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
