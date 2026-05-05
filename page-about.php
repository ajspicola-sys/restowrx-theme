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
                    Serving Tampa Bay Since 2010
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
                    <strong>15+</strong>
                    <span>Years Experience</span>
                </div>
                <div class="svc-hero__float svc-hero__float--2">
                    <strong>2,400+</strong>
                    <span>Happy Customers</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         OUR STORY
         ════════════════════════════════════════════════════════════ -->
    <section class="about-story" aria-label="Our story">
        <div class="section__inner">
            <div class="section__header reveal" style="text-align: center;">
                <span class="section__label">Our Story</span>
                <h2 class="section__title">From One Truck to Tampa's<br>Most Trusted Team</h2>
            </div>
            <div class="about-story__content reveal">
                <div class="about-story__block">
                    <div class="about-story__year">2010</div>
                    <div class="about-story__detail">
                        <h3>The Beginning</h3>
                        <p>Hot Water Heroes started with a single truck, a toolbox, and a commitment to doing things right. Our founder saw too many homeowners getting overcharged for sloppy work — and decided Tampa Bay deserved better.</p>
                    </div>
                </div>
                <div class="about-story__block">
                    <div class="about-story__year">2015</div>
                    <div class="about-story__detail">
                        <h3>Growing Roots</h3>
                        <p>Word spread fast. By 2015 we'd grown to a full crew of licensed technicians, expanded into water heater installations, and earned hundreds of five-star reviews from homeowners across Hillsborough County.</p>
                    </div>
                </div>
                <div class="about-story__block">
                    <div class="about-story__year">Today</div>
                    <div class="about-story__detail">
                        <h3>Tampa's Go-To Team</h3>
                        <p>Today we're a full-service plumbing company with 24/7 emergency response, a fleet of fully stocked trucks, and a 4.9-star Google rating. But we've never forgotten where we started — one job at a time, done right.</p>
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
            <div class="section__header reveal" style="text-align: center;">
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
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="about-val__num">04</div>
                    <h3 class="about-val__title">Guaranteed Work</h3>
                    <p class="about-val__text">Every repair comes with a 1-year labor warranty. If something isn't right, we come back and fix it — no cost, no questions.</p>
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
         CTA
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-cta" aria-label="Get in touch CTA">
        <div class="svc-cta__pulse" aria-hidden="true"></div>
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">🤝 Let's Talk</span>
                <h2 class="svc-cta__title">Ready to Work<br><em>With Us?</em></h2>
                <p class="svc-cta__desc">Whether it's a dripping faucet or a full water heater replacement, we'd love to earn your trust. Give us a call — or book online in under a minute.</p>
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

<?php get_footer(); ?>
