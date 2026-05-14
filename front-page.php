<?php
/**
 * Template Name: Homepage
 * Spicola Construction — Front Page v1
 */
get_header(); ?>

<main class="site-main" id="main-content">

<!-- ── Structured Data ── -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": ["GeneralContractor", "HomeAndConstructionBusiness", "LocalBusiness"],
    "@id": "<?php echo esc_url(home_url('/')); ?>#business",
    "name": "Spicola Construction",
    "description": "Tampa Bay's trusted general contractor — expert residential and commercial construction, remodeling, roofing, and renovation services.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18137326285",
    "email": "info@spicolaconstruction.com",
    "priceRange": "$$-$$$",
    "address": { "@type": "PostalAddress", "addressLocality": "Tampa", "addressRegion": "FL", "addressCountry": "US" },
    "areaServed": [
        {"@type":"City","name":"Tampa"},{"@type":"City","name":"St. Petersburg"},
        {"@type":"City","name":"Clearwater"},{"@type":"City","name":"Brandon"},
        {"@type":"City","name":"Wesley Chapel"},{"@type":"City","name":"Riverview"}
    ],
    "aggregateRating": {"@type":"AggregateRating","ratingValue":"5","reviewCount":"50","bestRating":"5"},
    "sameAs": ["https://www.facebook.com/spicolaconstruction/","https://www.instagram.com/spicolaconstruction/"]
}
</script>

<!-- ══════════════════════════════════════════════════════
     HERO — Dark navy, bold red, full impact
     ══════════════════════════════════════════════════════ -->
<section class="hwh-hero" id="hero" aria-label="Spicola Construction">
    <div class="hwh-hero__overlay" aria-hidden="true"></div>
    <div class="hwh-hero__grid" aria-hidden="true"></div>

    <div class="hwh-hero__inner">
        <div class="hwh-hero__content">
            <div class="hwh-hero__eyebrow">
                <span class="hwh-hero__dot" aria-hidden="true"></span>
                Licensed General Contractor · Tampa Bay, FL
            </div>

            <h1 class="hwh-hero__title">
                Building Tampa Bay.<br>
                <span class="hwh-hero__title-accent">One Project at a Time.</span>
            </h1>

            <p class="hwh-hero__sub">
                Trusted general contractor serving Tampa Bay for residential &amp; commercial construction, remodeling, roofing, and renovations — quality craftsmanship, on time and on budget.
            </p>

            <div class="hwh-hero__actions">
                <a href="tel:+18137326285" class="hwh-btn hwh-btn--red hwh-btn--lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    (813) 732-6285
                </a>
                <a href="/contact/" class="hwh-btn hwh-btn--ghost hwh-btn--lg">
                    Get a Free Quote →
                </a>
            </div>

            <div class="hwh-hero__trust">
                <div class="hwh-hero__trust-item">✔ Licensed &amp; Insured</div>
                <div class="hwh-hero__trust-item">✔ Free Estimates</div>
                <div class="hwh-hero__trust-item">✔ 5★ Google Rating</div>
                <div class="hwh-hero__trust-item">✔ Family Owned</div>
            </div>
        </div>

        <div class="hwh-hero__visual" aria-hidden="true">
            <div class="hwh-hero__van-wrap">
                <!-- Placeholder — will add real project photo later -->
                <div style="width:680px;height:480px;background:linear-gradient(135deg,#222D3F,#A52A2A);border-radius:16px;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Montserrat',sans-serif;font-size:2rem;font-weight:700;text-align:center;padding:2rem;">
                    🏗️<br>SPICOLA<br>CONSTRUCTION
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     STATS BAR
     ══════════════════════════════════════════════════════ -->
<section class="hwh-stats" aria-label="Company stats">
    <div class="hwh-stats__inner">
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">500+</span>
            <span class="hwh-stat-item__label">Projects Completed</span>
        </div>
        <div class="hwh-stat-item__div" aria-hidden="true"></div>
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">20+</span>
            <span class="hwh-stat-item__label">Years Experience</span>
        </div>
        <div class="hwh-stat-item__div" aria-hidden="true"></div>
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">50+</span>
            <span class="hwh-stat-item__label">5-Star Reviews</span>
        </div>
        <div class="hwh-stat-item__div" aria-hidden="true"></div>
        <div class="hwh-stat-item">
            <span class="hwh-stat-item__num">100%</span>
            <span class="hwh-stat-item__label">Satisfaction Guaranteed</span>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     SERVICES — Clean bold grid
     ══════════════════════════════════════════════════════ -->
<section class="hwh-services" id="services" aria-label="Our construction services">
    <div class="hwh-section-inner">
        <div class="hwh-section-header">
            <span class="hwh-label">Our Expertise</span>
            <h2 class="hwh-section-title">Construction Services<br><em>Built to Last</em></h2>
            <p class="hwh-section-desc">From new builds to full renovations — we deliver quality craftsmanship on every project, on time and on budget.</p>
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
            ['title'=>'New Construction',          'text'=>'Custom residential and commercial builds from the ground up — designed to your vision, built to code.'],
            ['title'=>'Remodeling & Renovations',  'text'=>'Kitchen, bathroom, and whole-home remodels that transform your space with quality materials and craftsmanship.'],
            ['title'=>'Roofing',                   'text'=>'Full roof replacement, repairs, and new installations — protecting your property from Florida weather.'],
            ['title'=>'Commercial Build-Outs',     'text'=>'Tenant improvements, office renovations, and commercial construction tailored to your business needs.'],
            ['title'=>'Additions & Extensions',    'text'=>'Expand your living space with seamlessly integrated additions that match your existing structure.'],
            ['title'=>'Concrete & Foundation',     'text'=>'Driveways, patios, slabs, and foundation work — built strong for Florida\'s unique soil conditions.'],
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
            <h2 class="hwh-section-title hwh-section-title--white">Your Project in 4 Steps</h2>
            <p class="hwh-section-desc hwh-section-desc--muted">We make construction simple — transparent pricing, clear timelines, and quality you can trust.</p>
        </div>
        <div class="hwh-process-steps">
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">01</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                <h3 class="hwh-process-step__title">Free Consultation</h3>
                <p class="hwh-process-step__text">Call us or request a quote online. We schedule a free on-site consultation to understand your vision.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">02</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
                <h3 class="hwh-process-step__title">Design & Planning</h3>
                <p class="hwh-process-step__text">Our team creates a detailed plan with blueprints, materials, and a transparent project estimate.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">03</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                <h3 class="hwh-process-step__title">Build &amp; Execute</h3>
                <p class="hwh-process-step__text">Licensed crews get to work on schedule. We keep you updated with regular progress reports.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">04</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                <h3 class="hwh-process-step__title">Final Walkthrough</h3>
                <p class="hwh-process-step__text">We walk every detail with you to ensure 100% satisfaction. Your project is backed by our quality guarantee.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     WHY CHOOSE US — Light bg, bold trust signals
     ══════════════════════════════════════════════════════ -->
<section class="hwh-why" aria-label="Why choose Spicola Construction">
    <div class="hwh-section-inner">
        <div class="hwh-why__grid">
            <div class="hwh-why__content reveal">
                <span class="hwh-label">The Spicola Difference</span>
                <h2 class="hwh-section-title">Why Tampa Bay<br>Chooses <em>Us</em></h2>
                <p class="hwh-section-desc">We built our reputation one project at a time — delivering quality craftsmanship, honest pricing, and work that stands the test of time.</p>
                <ul class="hwh-why__list">
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>Licensed General Contractor</strong>
                            <p>Fully licensed CGC and insured for residential and commercial projects in Florida.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>Transparent Pricing</strong>
                            <p>Detailed estimates before work begins. No surprises, no change-order games.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>20+ Years Experience</strong>
                            <p>Decades of construction expertise across residential, commercial, and renovation projects.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>On Time, On Budget</strong>
                            <p>We respect your timeline and your investment — no delays, no excuses.</p>
                        </div>
                    </li>
                </ul>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="hwh-btn hwh-btn--red">Meet Our Team →</a>
            </div>
            <div class="hwh-why__stats reveal">
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">500+</span>
                    <span class="hwh-why__stat-lbl">Projects Completed</span>
                </div>
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">50+</span>
                    <span class="hwh-why__stat-lbl">5-Star Reviews</span>
                </div>
                <div class="hwh-why__stat-card hwh-why__stat-card--accent">
                    <span class="hwh-why__stat-num">20+</span>
                    <span class="hwh-why__stat-lbl">Years Experience</span>
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

            <!-- LEFT: Visual -->
            <div class="hwh-reviews-split__visual reveal">
                <div class="hwh-reviews-split__img-wrap">
                    <!-- Placeholder — will add real project photo later -->
                    <div style="width:520px;height:580px;background:linear-gradient(135deg,#222D3F 0%,#A52A2A 100%);border-radius:16px;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Montserrat',sans-serif;font-size:1.5rem;font-weight:700;text-align:center;padding:2rem;">⭐<br>OUR CLIENTS<br>LOVE US</div>
                </div>
                <div class="hwh-reviews-split__badge">
                    <span class="hwh-reviews-split__badge-stars">★★★★★</span>
                    <span class="hwh-reviews-split__badge-text">5.0 on Google — 50+ Reviews</span>
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
                            <p class="hwh-review-card__text">"Spicola Construction did an amazing job on our kitchen remodel. Professional crew, great communication throughout the project, and the finished result exceeded our expectations. Highly recommend them for any construction project in Tampa."</p>
                            <div class="hwh-review-card__author">
                                <strong>Sarah M.</strong>
                                <span>Google Review</span>
                            </div>
                        </article>

                        <article class="hwh-review-card hwh-review-card--stacked">
                            <span class="hwh-review-card__stars" role="img" aria-label="5 stars">★★★★★</span>
                            <p class="hwh-review-card__text">"We hired Spicola for a complete home addition and they delivered on time and on budget. The quality of work is outstanding. Their team was respectful of our property and kept us informed every step of the way."</p>
                            <div class="hwh-review-card__author">
                                <strong>James R.</strong>
                                <span>Google Review</span>
                            </div>
                        </article>

                        <article class="hwh-review-card hwh-review-card--stacked">
                            <span class="hwh-review-card__stars" role="img" aria-label="5 stars">★★★★★</span>
                            <p class="hwh-review-card__text">"Best contractor in the Tampa Bay area. Fair pricing, excellent craftsmanship, and they stand behind their work. We have used them for two projects now and will continue to call them for everything."</p>
                            <div class="hwh-review-card__author">
                                <strong>Mike T.</strong>
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
                <p class="hwh-section-desc">Hillsborough, Pinellas, and Pasco County — if you're in the Tampa Bay area, we've got you covered with quality construction services.</p>
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
                <img src="<?php echo esc_url(home_url('/')); ?>wp-content/uploads/sc-service-area-map.png"
                     alt="Spicola Construction service area map — Tampa Bay FL"
                     loading="lazy" decoding="async" width="500" height="500"
                     class="hwh-areas__map">
                <div class="hwh-areas__badge">
                    <span>Free Estimates</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     FAQ Section — word count + FAQ rich results
     ══════════════════════════════════════════════════════ -->
<section class="hwh-faq" id="faq" aria-label="Frequently asked construction questions">
    <div class="hwh-section-inner">
        <div class="hwh-section-header reveal">
            <span class="hwh-label">Common Questions</span>
            <h2 class="hwh-section-title">Construction <em>FAQs</em></h2>
            <p class="hwh-section-desc">Have questions? Here are the answers Tampa Bay homeowners and business owners ask most.</p>
        </div>
        <div class="hwh-faq__grid reveal" itemscope itemtype="https://schema.org/FAQPage">
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">How long does a typical construction project take?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Project timelines vary based on scope. A kitchen remodel typically takes 4-8 weeks, a bathroom remodel 2-4 weeks, and new construction 4-8 months. During your free consultation, we provide a detailed timeline so you know exactly what to expect.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">Do you provide free estimates?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. Spicola Construction provides free estimates on all projects. We visit your property, discuss your vision, and provide a detailed written estimate with no obligation. We believe in transparent pricing with no hidden fees or surprise charges.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">Are you licensed and insured?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. Spicola Construction is a fully licensed Certified General Contractor (CGC) and carries comprehensive liability insurance and workers compensation. Your property and investment are fully protected on every project.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">What areas do you serve in Tampa Bay?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We serve all of Hillsborough, Pinellas, and Pasco counties. Service areas include Tampa, South Tampa, St. Petersburg, Clearwater, Brandon, Riverview, Wesley Chapel, Carrollwood, Westchase, Lutz, Land O Lakes, Odessa, New Tampa, and Zephyrhills. If you are in Greater Tampa Bay, we have got you covered.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">What types of construction projects do you handle?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We handle residential and commercial projects of all sizes including new construction, home remodeling, kitchen and bathroom renovations, room additions, roofing, concrete work, commercial build-outs, and tenant improvements. No project is too big or too small.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">Do you offer financing?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. We accept cash, all major credit cards, and offer flexible financing options for larger projects. We work with you to find a payment plan that fits your budget so you can get the construction work you need without financial stress.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     CTA — Bold red, full width
     ══════════════════════════════════════════════════════ -->
<section class="hwh-cta" id="request-service" aria-label="Request construction service">
    <div class="hwh-cta__inner reveal">
        <div class="hwh-cta__content">
            <span class="hwh-label hwh-label--white">Start Your Project</span>
            <h2 class="hwh-cta__title">Ready to Build?<br>Let's Talk.</h2>
            <p class="hwh-cta__text">From new construction to renovations, we bring your vision to life. Call now or request a free quote online.</p>
        </div>
        <div class="hwh-cta__actions">
            <a href="tel:+18137326285" class="hwh-btn hwh-btn--white hwh-btn--lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                Call (813) 732-6285
            </a>
            <a href="/contact/" class="hwh-btn hwh-btn--ghost-white hwh-btn--lg">
                Get a Free Quote →
            </a>
        </div>
    </div>
</section>
<section class="hwh-geo" aria-label="About Spicola Construction">
    <div class="hwh-geo__inner">
        <h2 class="hwh-geo__title">Tampa Bay's Trusted General Contractor</h2>
        <div class="hwh-geo__body">
            <p><strong>Spicola Construction</strong> is a licensed and insured general contractor serving the Greater Tampa Bay area, including Hillsborough County, Pinellas County, and Pasco County, Florida. We specialize in new residential construction, home remodeling, kitchen and bathroom renovations, room additions, roofing, concrete and foundation work, commercial build-outs, and tenant improvements.</p>
            <p>Our service area covers Tampa, South Tampa, St. Petersburg, Clearwater, Brandon, Riverview, Wesley Chapel, Carrollwood, Westchase, Lutz, Land O Lakes, Odessa, New Tampa, and Zephyrhills. We are available Monday through Friday 7am to 6pm and Saturday 8am to 4pm for consultations, estimates, and active project work.</p>
            <p>Spicola Construction holds a 5.0-star rating on Google with over 50 verified customer reviews. We offer free estimates on all projects and guarantee transparent pricing before any work begins. Our crews are fully licensed, insured, and committed to quality craftsmanship across Tampa Bay. To reach us, call <a href="tel:+18137326285">(813) 732-6285</a> or <a href="/contact/">request a quote online</a>.</p>
            <p><strong>Services offered:</strong> New Construction &bull; Home Remodeling &bull; Kitchen &amp; Bathroom Renovations &bull; Room Additions &bull; Roofing &bull; Concrete &amp; Foundation &bull; Commercial Build-Outs &bull; Tenant Improvements &bull; Exterior Renovations &bull; Custom Builds</p>
            <p><strong>Service areas:</strong> Tampa &bull; South Tampa &bull; St. Petersburg &bull; Clearwater &bull; Brandon &bull; Riverview &bull; Wesley Chapel &bull; Carrollwood &bull; Westchase &bull; Lutz &bull; Land O Lakes &bull; Odessa &bull; New Tampa &bull; Zephyrhills &bull; Temple Terrace &bull; Valrico &bull; Lithia</p>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
