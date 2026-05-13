<?php
/**
 * Template Name: About
 * Hot Water Heroes Plumbing — About Page
 * Our story, values, and why Tampa trusts us
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="about-hero" aria-label="About Hot Water Heroes Plumbing">
        <div class="about-hero__bg" aria-hidden="true">
            <div class="about-hero__stripe"></div>
        </div>
        <div class="about-hero__inner">
            <div class="about-hero__text">
                <span class="svc-hero__badge">
                    <span class="svc-hero__badge-dot" aria-hidden="true"></span>
                    Serving Tampa Bay Since 2025
                </span>
                <h1 class="about-hero__title">We're Not Just<br><em>Plumbers.</em></h1>
                <p class="about-hero__desc">We're your neighbors, your emergency lifeline at 2 AM, and the team that treats your home like it's our own. Hot Water Heroes was built on one promise: honest work, fair prices, and no surprises.</p>
                <div class="about-hero__actions">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">Get In Touch</a>
                    <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn--outline btn--lg">Our Services</a>
                </div>
            </div>
            <div class="about-hero__visual">
                <div class="about-hero__mascot-glow" aria-hidden="true"></div>
                <img
                    src="https://hotwaterheroesplumbing.com/wp-content/uploads/2026/05/Heaty-Normal.png"
                    alt="Heaty — Hot Water Heroes mascot"
                    class="about-hero__mascot"
                    width="380" height="440"
                    loading="eager" decoding="async"
                >
                <div class="svc-hero__float svc-hero__float--1">
                    <strong>24/7</strong>
                    <span>Emergency Service</span>
                </div>
                <div class="svc-hero__float svc-hero__float--2">
                    <strong>5★</strong>
                    <span>Google Rated</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         OUR STORY
         ════════════════════════════════════════════════════════════ -->
    <section class="about-story" aria-label="Our story">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Our Story</span>
                <h2 class="section__title">From Day One, Built on<br>Doing Things Right</h2>
            </div>
            <div class="about-story__content reveal">
                <div class="about-story__block">
                    <div class="about-story__year">Late 2025</div>
                    <div class="about-story__detail">
                        <h3>The Beginning</h3>
                        <p>Hot Water Heroes launched in late 2025 with a simple mission: give Tampa Bay homeowners honest plumbing service at fair prices. Our founder saw too many families getting overcharged for sloppy work — and decided it was time for something better.</p>
                    </div>
                </div>
                <div class="about-story__block">
                    <div class="about-story__year">2026</div>
                    <div class="about-story__detail">
                        <h3>Growing Fast</h3>
                        <p>Word spread quickly. Within months we earned five-star reviews, expanded our service area across Hillsborough, Pinellas, and Pasco counties, and built a reputation for showing up on time, every time.</p>
                    </div>
                </div>
                <div class="about-story__block">
                    <div class="about-story__year">Today</div>
                    <div class="about-story__detail">
                        <h3>Tampa's Go-To Team</h3>
                        <p>Today we're a full-service plumbing company with 24/7 emergency response, fully stocked trucks, and a growing list of loyal customers. We're just getting started — but our commitment to doing things right hasn't changed one bit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         CORE VALUES
         ════════════════════════════════════════════════════════════ -->
    <section class="about-values" aria-label="Our core values">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">What We Stand For</span>
                <h2 class="section__title">Built on Doing<br>The Right Thing</h2>
            </div>
            <div class="about-values__grid reveal">
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="about-val__num">01</div>
                    <h3 class="about-val__title">Honesty First</h3>
                    <p class="about-val__text">We'll never upsell you on work you don't need. If a $20 part fixes it, that's what we'll recommend — not a $2,000 replacement.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>
                    </div>
                    <div class="about-val__num">02</div>
                    <h3 class="about-val__title">Upfront Pricing</h3>
                    <p class="about-val__text">You'll know exactly what the job costs before we turn a single wrench. No hidden fees, no "while we were in there" surprises.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="about-val__num">03</div>
                    <h3 class="about-val__title">Always On Time</h3>
                    <p class="about-val__text">We respect your time. Our two-hour arrival windows are industry-leading, and we call before we arrive. Most emergencies get a tech within 60 minutes.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="about-val__num">04</div>
                    <h3 class="about-val__title">Clean &amp; Professional</h3>
                    <p class="about-val__text">We treat your home like our own. Drop cloths, boot covers, and a spotless cleanup when we're done. Every single time.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         TRUST STATS
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-stats" aria-label="Company stats">
        <div class="section__inner svc-stats__inner">
            <div class="svc-stat">
                <strong class="svc-stat__num">5.0<span>★</span></strong>
                <span class="svc-stat__label">Google Rating</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">24/7</strong>
                <span class="svc-stat__label">Emergency Response</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">100<span>%</span></strong>
                <span class="svc-stat__label">Licensed &amp; Insured</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">3</strong>
                <span class="svc-stat__label">Companies, One Family</span>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         FAMILY OF COMPANIES
         ════════════════════════════════════════════════════════════ -->
    <section class="about-family" aria-label="Our family of companies">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Stronger Together</span>
                <h2 class="section__title">A Complete Home<br>Recovery Team</h2>
                <p class="section__subtitle section__subtitle--narrow">Our family of companies — Hot Water Heroes Plumbing, RestoWrx, and Spicola Construction — covers every stage of your home's needs. We stop leaks, restore damage, and rebuild better than before, all with the same dedication to quality and care.</p>
            </div>
            <div class="about-family__grid reveal">
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="about-family__name">Hot Water Heroes Plumbing</h3>
                    <p class="about-family__desc">We stop the leak. Emergency plumbing, water heater repair &amp; installation, drain cleaning, and full repiping — fast, honest, and available 24/7.</p>
                    <span class="about-family__tag">Plumbing &amp; Water Heaters</span>
                </article>
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="about-family__name">RestoWrx</h3>
                    <p class="about-family__desc">We restore the damage. Water damage mitigation, mold remediation, fire &amp; smoke restoration — getting your home back to normal, fast.</p>
                    <span class="about-family__tag">Restoration &amp; Mitigation</span>
                </article>
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="6" width="22" height="14" rx="2"/><path d="M1 10h22"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </div>
                    <h3 class="about-family__name">Spicola Construction</h3>
                    <p class="about-family__desc">We rebuild better than before. General contracting, renovations, and structural repairs — from foundation to finish.</p>
                    <span class="about-family__tag">Construction &amp; Renovation</span>
                </article>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         CTA
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-cta" aria-label="Get in touch CTA">
        <div class="svc-cta__pulse" aria-hidden="true"></div>
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">Let's Talk</span>
                <h2 class="svc-cta__title">Ready to Work<br><em>With Us?</em></h2>
                <p class="svc-cta__desc">Whether it's a dripping faucet or a full water heater replacement, we'd love to earn your trust. Give us a call — or book online in under a minute.</p>
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
