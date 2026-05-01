<?php
/**
 * Template Name: Homepage
 * Hot Water Heroes Plumbing — Front Page
 * Performance-optimized: lazy loading, fetchpriority, semantic HTML
 */
get_header(); ?>

<main class="site-main" id="main-content">

<!-- ── LocalBusiness Structured Data (JSON-LD) ── -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": ["Plumber", "HomeAndConstructionBusiness", "LocalBusiness"],
    "@id": "<?php echo esc_url(home_url('/')); ?>#business",
    "name": "Hot Water Heroes Plumbing",
    "alternateName": "HWH Plumbing",
    "description": "Tampa Bay's trusted plumbing company — expert water heater repair, installation, drain cleaning, leak detection, and 24/7 emergency plumbing services.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18135551234",
    "email": "info@hotwaterheroes.com",
    "currenciesAccepted": "USD",
    "paymentAccepted": "Cash, Credit Card, Check, Financing Available",
    "priceRange": "$$",
    "image": "<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-logo.png",
    "logo": "<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-logo.png",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Tampa",
        "addressRegion": "FL",
        "addressCountry": "US"
    },
    "areaServed": [
        { "@type": "City", "name": "Tampa" },
        { "@type": "City", "name": "St. Petersburg" },
        { "@type": "City", "name": "Clearwater" },
        { "@type": "City", "name": "Brandon" },
        { "@type": "City", "name": "Wesley Chapel" },
        { "@type": "City", "name": "Riverview" },
        { "@type": "City", "name": "Lutz" },
        { "@type": "City", "name": "Land O' Lakes" }
    ],
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
            "opens": "07:00",
            "closes": "18:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Saturday","Sunday"],
            "opens": "00:00",
            "closes": "23:59",
            "description": "24/7 Emergency Service Available"
        }
    ],
    "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Plumbing Services",
        "itemListElement": [
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Water Heater Repair", "areaServed": "Tampa Bay, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Water Heater Installation", "areaServed": "Tampa Bay, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Tankless Water Heaters", "areaServed": "Tampa Bay, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Drain Cleaning", "areaServed": "Tampa Bay, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Emergency Plumbing", "areaServed": "Tampa Bay, FL" } },
            { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Leak Detection & Repair", "areaServed": "Tampa Bay, FL" } }
        ]
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "reviewCount": "120",
        "bestRating": "5",
        "worstRating": "1"
    },
    "sameAs": [
        "https://www.instagram.com/hotwaterheroes/",
        "https://www.facebook.com/hotwaterheroes/"
    ]
}
</script>

    <!-- ═══════════════════════════════════════════════════════════════
         HERO SECTION — v2 (push test: redesigned layout)
         ═══════════════════════════════════════════════════════════════ -->
    <section class="hero" id="hero" aria-label="Hot Water Heroes Plumbing — Tampa Bay's Trusted Plumbers">

        <!-- Bold angular gradient background -->
        <div class="hero__bg-overlay" aria-hidden="true"></div>
        <div class="hero__grid-lines" aria-hidden="true"></div>

        <!-- Floating particles -->
        <div class="hero__particles" aria-hidden="true">
            <span class="hero__particle" style="--x:8%;--y:25%;--delay:0s;--size:3px;"></span>
            <span class="hero__particle" style="--x:88%;--y:18%;--delay:1.2s;--size:2px;"></span>
            <span class="hero__particle" style="--x:72%;--y:65%;--delay:2s;--size:4px;"></span>
            <span class="hero__particle" style="--x:20%;--y:78%;--delay:0.6s;--size:2px;"></span>
            <span class="hero__particle" style="--x:55%;--y:40%;--delay:1.8s;--size:3px;"></span>
            <span class="hero__particle" style="--x:92%;--y:82%;--delay:3s;--size:2px;"></span>
        </div>

        <div class="hero__inner">
            <!-- LEFT: Content -->
            <div class="hero__content">
                <span class="hero__badge">🔧🛡️ Certified Plumbers · Serving Tampa Bay Since Day One</span>

                <h1 class="hero__title">
                    Tampa Bay's<br>
                    <em>Hot Water Experts.</em>
                </h1>

                <div class="hero__divider" aria-hidden="true"></div>

                <p class="hero__subtitle">No cold showers. No waiting around. Hot Water Heroes shows up fast, fixes it right, and backs every job with a satisfaction guarantee — 24 hours a day, 7 days a week.</p>

                <div class="hero__actions">
                    <a href="tel:18135551234" class="btn btn--primary btn--lg">
                        📞 Call (813) 555-1234
                    </a>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline btn--lg">Our Services →</a>
                </div>

                <!-- Trust line -->
                <p class="hero__trust-line" aria-label="Customer trust indicator">
                    ✅ Trusted by <strong>1,200+ Tampa Bay homeowners</strong> · Licensed &amp; Fully Insured
                </p>

                <!-- Stats row -->
                <div class="hero__stats" aria-label="Company highlights">
                    <div class="hero__stat">
                        <span class="hero__stat-num">1,200+</span>
                        <span class="hero__stat-label">Jobs Completed</span>
                    </div>
                    <div class="hero__stat-divider" aria-hidden="true"></div>
                    <div class="hero__stat">
                        <span class="hero__stat-num">24/7</span>
                        <span class="hero__stat-label">Emergency Service</span>
                    </div>
                    <div class="hero__stat-divider" aria-hidden="true"></div>
                    <div class="hero__stat">
                        <span class="hero__stat-num">5★</span>
                        <span class="hero__stat-label">Google Rating</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Visual with floating service badges -->
            <div class="hero__visual" aria-hidden="true">
                <div class="hero__model">
                    <img src="<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-hero-plumber.png"
                         alt="Hot Water Heroes licensed plumber serving Tampa Bay"
                         class="hero__model-img"
                         fetchpriority="high"
                         decoding="async"
                         width="600"
                         height="932">
                </div>

                <!-- Floating service badges -->
                <div class="hero__visual-badge hero__visual-badge--1">
                    <span>🔥</span> Same-Day Water Heater Fix
                </div>
                <div class="hero__visual-badge hero__visual-badge--2">
                    <span>⏱️</span> Avg. Response: 90 Min
                </div>
                <div class="hero__visual-badge hero__visual-badge--3">
                    <span>🛡️</span> Licensed &amp; Insured
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="hero__scroll-indicator" aria-hidden="true">
            <div class="hero__scroll-mouse">
                <div class="hero__scroll-dot"></div>
            </div>
            <span class="hero__scroll-text">Scroll</span>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         TRUST TICKER — scrolling credentials
         ═══════════════════════════════════════════════════════════════ -->
    <section class="trust-ticker" aria-label="Credentials and service highlights">
        <div class="trust-ticker__track">
            <div class="trust-ticker__items">
                <span class="trust-ticker__item">✦ Licensed & Insured</span>
                <span class="trust-ticker__item">✦ 24/7 Emergency Plumbing</span>
                <span class="trust-ticker__item">✦ 120+ Five-Star Reviews</span>
                <span class="trust-ticker__item">✦ Same-Day Water Heater Service</span>
                <span class="trust-ticker__item">✦ Serving All of Tampa Bay</span>
                <span class="trust-ticker__item">✦ Tankless Water Heater Experts</span>
                <span class="trust-ticker__item">✦ Free Estimates Available</span>
                <span class="trust-ticker__item">✦ Financing Available</span>
                <span class="trust-ticker__item">✦ No Hidden Fees</span>
                <!-- Duplicate for seamless loop -->
                <span class="trust-ticker__item">✦ Licensed & Insured</span>
                <span class="trust-ticker__item">✦ 24/7 Emergency Plumbing</span>
                <span class="trust-ticker__item">✦ 120+ Five-Star Reviews</span>
                <span class="trust-ticker__item">✦ Same-Day Water Heater Service</span>
                <span class="trust-ticker__item">✦ Serving All of Tampa Bay</span>
                <span class="trust-ticker__item">✦ Tankless Water Heater Experts</span>
                <span class="trust-ticker__item">✦ Free Estimates Available</span>
                <span class="trust-ticker__item">✦ Financing Available</span>
                <span class="trust-ticker__item">✦ No Hidden Fees</span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         SERVICES CAROUSEL
         ═══════════════════════════════════════════════════════════════ -->
    <section class="services" id="services" aria-label="Our plumbing services">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">What We Do</span>
                <h2 class="section__title">Plumbing Services</h2>
                <p class="section__desc">From water heater emergencies to routine maintenance — we handle it all with speed, skill, and transparency.</p>
            </div>

            <?php
            $services = new WP_Query([
                'post_type'      => 'service',
                'posts_per_page' => 8,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'no_found_rows'  => true,
                'update_post_meta_cache' => true,
                'update_post_term_cache' => false,
            ]);

            $fallback = [
                ['icon' => '🔥', 'title' => 'Water Heater Repair',      'text' => 'Fast diagnosis and repair of all water heater brands. No hot water? We fix it same-day.'],
                ['icon' => '⚡', 'title' => 'Water Heater Installation', 'text' => 'Full installation of tank and tankless water heaters — properly sized and up to code.'],
                ['icon' => '💧', 'title' => 'Tankless Water Heaters',   'text' => 'Go endless hot water with a tankless upgrade. We sell, install, and service all major brands.'],
                ['icon' => '🔩', 'title' => 'Drain Cleaning',           'text' => 'Slow drains or full blockages cleared fast with hydro-jetting and professional snaking.'],
                ['icon' => '🚨', 'title' => 'Emergency Plumbing',       'text' => 'Burst pipe? Major leak? We\'re available 24/7 — nights, weekends, and holidays.'],
                ['icon' => '🔍', 'title' => 'Leak Detection & Repair',  'text' => 'Non-invasive leak detection technology finds hidden leaks before they cause major damage.'],
            ];
            ?>

            <div class="carousel reveal" id="services-carousel" role="region" aria-label="Services carousel" tabindex="0">
                <div class="carousel__track">
                    <?php if ($services->have_posts()) : $i = 0; ?>
                        <?php while ($services->have_posts()) : $services->the_post();
                            $icon  = get_post_meta(get_the_ID(), '_service_icon', true) ?: '🔧';
                            $price = get_post_meta(get_the_ID(), '_service_price', true);
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        ?>
                            <div class="carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>" role="group" aria-label="Slide <?php echo $i + 1; ?>">
                                <div class="carousel-card">
                                    <div class="carousel-card__image">
                                        <?php if ($thumb) : ?>
                                            <img src="<?php echo esc_url($thumb); ?>"
                                                 alt="<?php the_title_attribute(); ?>"
                                                 loading="lazy" decoding="async"
                                                 width="400" height="240">
                                        <?php else : ?>
                                            <div class="carousel-card__placeholder">
                                                <span><?php echo esc_html($icon); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="carousel-card__body">
                                        <div class="carousel-card__icon"><?php echo esc_html($icon); ?></div>
                                        <h3 class="carousel-card__title"><?php the_title(); ?></h3>
                                        <p class="carousel-card__text"><?php echo wp_trim_words(wp_strip_all_tags(get_the_excerpt()), 20); ?></p>
                                        <?php if ($price) : ?>
                                            <span class="carousel-card__price">From <?php echo esc_html($price); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="btn btn--primary btn--sm">Learn More →</a>
                                    </div>
                                </div>
                            </div>
                        <?php $i++; endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ($fallback as $i => $svc) : ?>
                            <div class="carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-index="<?php echo $i; ?>" role="group" aria-label="Slide <?php echo $i + 1; ?>">
                                <div class="carousel-card">
                                    <div class="carousel-card__image">
                                        <div class="carousel-card__placeholder">
                                            <span><?php echo esc_html($svc['icon']); ?></span>
                                        </div>
                                    </div>
                                    <div class="carousel-card__body">
                                        <div class="carousel-card__icon"><?php echo esc_html($svc['icon']); ?></div>
                                        <h3 class="carousel-card__title"><?php echo esc_html($svc['title']); ?></h3>
                                        <p class="carousel-card__text"><?php echo esc_html($svc['text']); ?></p>
                                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--primary btn--sm">Learn More →</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Navigation -->
                <div class="carousel__nav">
                    <button class="carousel__arrow carousel__arrow--prev" aria-label="Previous slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <div class="carousel__dots" id="carousel-dots" role="tablist" aria-label="Slide indicators"></div>
                    <button class="carousel__arrow carousel__arrow--next" aria-label="Next slide">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>
            </div>

            <div style="text-align:center;margin-top:2rem;">
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn--outline">See All Services →</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         HOW IT WORKS — 4-step process (repurposed Journey section)
         ═══════════════════════════════════════════════════════════════ -->
    <section class="journey-section" aria-label="How our service works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">How It Works</span>
                <h2 class="section__title">Service in 4 Simple Steps</h2>
                <p class="section__desc">We make plumbing repairs as painless as possible — fast, transparent, and done right the first time.</p>
            </div>
            <div class="journey-steps reveal">
                <div class="journey-step">
                    <div class="journey-step__number">01</div>
                    <div class="journey-step__icon">📞</div>
                    <h3 class="journey-step__title">Call or Book Online</h3>
                    <p class="journey-step__text">Reach us 24/7 by phone or schedule online. We'll confirm your appointment fast — often same-day.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">02</div>
                    <div class="journey-step__icon">🚚</div>
                    <h3 class="journey-step__title">We Show Up On Time</h3>
                    <p class="journey-step__text">A licensed plumber arrives at your door, fully equipped. We respect your time and your home.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">03</div>
                    <div class="journey-step__icon">🔍</div>
                    <h3 class="journey-step__title">Diagnose & Quote</h3>
                    <p class="journey-step__text">We diagnose the problem and give you a clear, upfront price — no surprise fees, no pressure.</p>
                </div>
                <div class="journey-step">
                    <div class="journey-step__number">04</div>
                    <div class="journey-step__icon">✅</div>
                    <h3 class="journey-step__title">Fixed & Guaranteed</h3>
                    <p class="journey-step__text">We complete the work cleanly and efficiently. Every job is backed by our satisfaction guarantee.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHY HWH — Trust & credibility section
         ═══════════════════════════════════════════════════════════════ -->
    <section class="why-us" aria-label="Why choose Hot Water Heroes Plumbing">
        <div class="section__inner">
            <div class="why-us__grid">
                <div class="why-us__content reveal">
                    <span class="section__label">The HWH Difference</span>
                    <h2 class="section__title">Why Tampa Bay<br>Trusts Us</h2>
                    <p class="section__desc">We built our reputation one job at a time — showing up when others won't, being honest about pricing, and doing work that lasts.</p>
                    <div class="why-us__features">
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">&#x2726;</div>
                            <div>
                                <h4 class="why-us__feature-title">Licensed & Fully Insured</h4>
                                <p class="why-us__feature-text">Every technician is state-licensed, background-checked, and insured for your protection.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">&#x2726;</div>
                            <div>
                                <h4 class="why-us__feature-title">Upfront, Honest Pricing</h4>
                                <p class="why-us__feature-text">You get a clear quote before any work begins. No hidden fees, no upsells — just straight talk.</p>
                            </div>
                        </div>
                        <div class="why-us__feature">
                            <div class="why-us__feature-icon" aria-hidden="true">&#x2726;</div>
                            <div>
                                <h4 class="why-us__feature-title">Water Heater Specialists</h4>
                                <p class="why-us__feature-text">We specialize in water heaters — all brands, all types, including tankless conversions.</p>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn--primary">About Our Team →</a>
                </div>
                <div class="why-us__visual reveal">
                    <div class="why-us__stat-card why-us__stat-card--1">
                        <span class="why-us__stat-number">1,200+</span>
                        <span class="why-us__stat-label">Jobs Completed</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--2">
                        <span class="why-us__stat-number">120+</span>
                        <span class="why-us__stat-label">5-Star Reviews</span>
                    </div>
                    <div class="why-us__stat-card why-us__stat-card--3">
                        <span class="why-us__stat-number">24/7</span>
                        <span class="why-us__stat-label">Available</span>
                    </div>
                    <div class="why-us__image-placeholder">
                        <img src="<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-team-photo.jpg"
                             alt="Hot Water Heroes licensed plumbing team — Tampa Bay"
                             class="why-us__image"
                             loading="lazy"
                             decoding="async"
                             width="600"
                             height="750">
                        <div class="why-us__image-gradient" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         TESTIMONIALS — Split Layout (reused, new content)
         ═══════════════════════════════════════════════════════════════ -->
    <section class="testimonials-split" aria-label="Customer reviews">
        <div class="section__inner">
            <div class="testimonials-split__layout">

                <!-- Left: Image -->
                <div class="testimonials-split__visual reveal">
                    <div class="testimonials-split__img-wrap">
                        <img src="<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-plumber-at-work.jpg"
                             alt="Hot Water Heroes plumber servicing a water heater in Tampa Bay"
                             width="768" height="924"
                             loading="lazy" decoding="async">
                    </div>
                    <!-- Google Rating Badge -->
                    <div class="testimonials-split__badge">
                        <div class="testimonials-split__badge-stars">★★★★★</div>
                        <span class="testimonials-split__badge-text">5.0 on Google · 120+ Reviews</span>
                    </div>
                </div>

                <!-- Right: Reviews -->
                <div class="testimonials-split__content reveal">
                    <span class="section__label">What Customers Say</span>
                    <h2 class="section__title">Real Customers,<br><em>Real Results</em></h2>
                    <p class="section__desc">Don't just take our word for it — here's what Tampa Bay homeowners say after we fix their plumbing problems.</p>

                    <div class="testimonials-split__cards">
                        <article class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"Our water heater went out on a Sunday evening. Hot Water Heroes had someone at our door within 2 hours and replaced the whole unit by 9pm. Unbelievable service — will definitely use them again."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Mike T.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </article>

                        <article class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"Fair pricing, fast timing, and the plumber was super professional. He explained every step and left everything cleaner than he found it. I've been burned by other plumbers before — Hot Water Heroes is the real deal."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Sarah K.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </article>

                        <article class="testimonial-card-v2">
                            <div class="testimonial-card-v2__stars" aria-label="5 out of 5 stars">★★★★★</div>
                            <p class="testimonial-card-v2__text">"Switched to a tankless water heater and couldn't be happier. The install was clean, fast, and they walked me through exactly how it works. Saving money on my electric bill already. 10/10 recommend."</p>
                            <div class="testimonial-card-v2__author">
                                <span class="testimonial-card-v2__name">Dave R.</span>
                                <span class="testimonial-card-v2__via">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Google Review
                                </span>
                            </div>
                        </article>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         SERVICE AREAS — replace supplements/products sections
         ═══════════════════════════════════════════════════════════════ -->
    <section class="product-showcase" aria-label="Service areas we cover">
        <div class="section__inner">
            <div class="product-showcase__layout">
                <div class="product-showcase__content reveal">
                    <span class="section__label">Service Area</span>
                    <h2 class="section__title">Serving All of<br>Tampa Bay</h2>
                    <p class="product-showcase__text">From South Tampa to Wesley Chapel, we cover the entire Tampa Bay metro area. Whether you're in Hillsborough, Pinellas, or Pasco County — we've got you covered.</p>
                    <div class="product-showcase__features">
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">Tampa & South Tampa</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">St. Pete & Clearwater</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">Brandon, Riverview & Lithia</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">Wesley Chapel, Lutz & Land O' Lakes</span>
                        </div>
                        <div class="product-showcase__feature">
                            <span class="product-showcase__feature-icon" aria-hidden="true">&#x25C9;</span>
                            <span class="product-showcase__feature-text">Carrollwood, Westchase & Odessa</span>
                        </div>
                    </div>
                    <div class="product-showcase__actions">
                        <a href="<?php echo esc_url(home_url('/service-areas/')); ?>" class="btn btn--primary btn--lg">View Service Areas</a>
                        <a href="tel:18135551234" class="btn btn--outline-light btn--lg">Call Us Now</a>
                    </div>
                </div>
                <div class="product-showcase__visual reveal">
                    <div class="product-showcase__image-wrapper">
                        <div class="product-showcase__ring" aria-hidden="true"></div>
                        <img src="<?php echo esc_url(home_url('/')); ?>wp-content/uploads/hwh-service-area-map.png"
                             alt="Hot Water Heroes Plumbing service area — Tampa Bay, FL"
                             class="product-showcase__image"
                             loading="lazy"
                             decoding="async"
                             width="400"
                             height="400">
                        <div class="product-showcase__badge product-showcase__badge--1" aria-hidden="true">
                            <span class="product-showcase__badge-icon">&#x2605;</span>
                            <span class="product-showcase__badge-text">Same-Day Available</span>
                        </div>
                        <div class="product-showcase__badge product-showcase__badge--2" aria-hidden="true">
                            <span class="product-showcase__badge-icon">&#x2665;</span>
                            <span class="product-showcase__badge-text">All of Tampa Bay</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         LATEST FROM THE BLOG
         ═══════════════════════════════════════════════════════════════ -->
    <section class="blog-section" aria-label="Latest plumbing tips and news">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Plumbing Tips</span>
                <h2 class="section__title">From the HWH Blog</h2>
                <p class="section__desc">Maintenance tips, how-to guides, and advice from our licensed plumbers to help you avoid costly repairs.</p>
            </div>

            <div class="blog-grid">
                <?php
                $blog_posts = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'no_found_rows'  => true,
                ]);

                if ($blog_posts->have_posts()) :
                    while ($blog_posts->have_posts()) : $blog_posts->the_post();
                        $categories = get_the_category();
                        $cat_name = !empty($categories) ? $categories[0]->name : 'Plumbing';
                ?>
                    <article class="blog-card reveal">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <div class="blog-card__img">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                                <?php else : ?>
                                    <div class="blog-card__img--placeholder">
                                        <span>🔧</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <span class="blog-card__cat"><?php echo esc_html($cat_name); ?></span>
                                    <span class="blog-card__date"><?php echo get_the_date('M j, Y'); ?></span>
                                </div>
                                <h3 class="blog-card__title"><?php the_title(); ?></h3>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                <span class="blog-card__read">Read More →</span>
                            </div>
                        </a>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <!-- Placeholder cards when no posts exist yet -->
                    <article class="blog-card reveal">
                        <div class="blog-card__img">
                            <div class="blog-card__img--placeholder"><span>🔥</span></div>
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__cat">Water Heaters</span>
                                <span class="blog-card__date">Coming Soon</span>
                            </div>
                            <h3 class="blog-card__title">Tank vs. Tankless: Which Water Heater Is Right for You?</h3>
                            <p class="blog-card__excerpt">We break down the pros, cons, and costs of tank and tankless water heaters to help you make the best choice.</p>
                            <span class="blog-card__read">Read More →</span>
                        </div>
                    </article>
                    <article class="blog-card reveal">
                        <div class="blog-card__img">
                            <div class="blog-card__img--placeholder"><span>💧</span></div>
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__cat">Maintenance</span>
                                <span class="blog-card__date">Coming Soon</span>
                            </div>
                            <h3 class="blog-card__title">5 Signs Your Water Heater Is About to Fail</h3>
                            <p class="blog-card__excerpt">Don't get caught with cold water. Spot these warning signs early and save yourself a costly emergency replacement.</p>
                            <span class="blog-card__read">Read More →</span>
                        </div>
                    </article>
                    <article class="blog-card reveal">
                        <div class="blog-card__img">
                            <div class="blog-card__img--placeholder"><span>🚨</span></div>
                        </div>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <span class="blog-card__cat">Emergency Services</span>
                                <span class="blog-card__date">Coming Soon</span>
                            </div>
                            <h3 class="blog-card__title">What to Do When a Pipe Bursts in Your Home</h3>
                            <p class="blog-card__excerpt">Step-by-step guide to minimize damage fast — from shutting off the main to calling your plumber.</p>
                            <span class="blog-card__read">Read More →</span>
                        </div>
                    </article>
                <?php endif; ?>
            </div>

            <div style="text-align:center; margin-top:2.5rem;">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn--outline">View All Posts →</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         CTA SECTION
         ═══════════════════════════════════════════════════════════════ -->
    <section class="cta-section" id="request-service" aria-label="Request plumbing service">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Get Help Today</span>
            <h2 class="cta-section__title">Plumbing Problem?<br>We're On Our Way.</h2>
            <p class="cta-section__text">Don't let a small leak turn into a big headache. Call us now or request service online — we serve all of Tampa Bay including Tampa, St. Pete, Clearwater, Brandon, Wesley Chapel, and more.</p>
            <div class="cta-section__actions">
                <a href="tel:18135551234" class="btn btn--primary btn--lg">📞 Call (813) 555-1234</a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--lg">Request Service Online</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
