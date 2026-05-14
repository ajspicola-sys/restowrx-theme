<?php
/**
 * Template Name: About
 * Spicola Construction — About Page
 * Our story, values, and why Tampa trusts us
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="about-hero" aria-label="About Spicola Construction">
        <div class="about-hero__bg" aria-hidden="true">
            <div class="about-hero__stripe"></div>
        </div>
        <div class="about-hero__inner">
            <div class="about-hero__text">
                <span class="svc-hero__badge">
                    <span class="svc-hero__badge-dot" aria-hidden="true"></span>
                    Tampa Bay's Trusted General Contractor
                </span>
                <h1 class="about-hero__title">We Don't Just<br><em>Build.</em></h1>
                <p class="about-hero__desc">We build relationships. Spicola Construction was founded on a simple belief: every project — big or small — deserves honest craftsmanship, transparent pricing, and a team that treats your property like their own.</p>
                <div class="about-hero__actions">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">Get a Free Quote</a>
                    <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn--outline btn--lg">Our Services</a>
                </div>
            </div>
            <div class="about-hero__visual">
                <div class="about-hero__mascot-glow" aria-hidden="true"></div>
                <div class="svc-hero__float svc-hero__float--1">
                    <strong>250+</strong>
                    <span>Projects Completed</span>
                </div>
                <div class="svc-hero__float svc-hero__float--2">
                    <strong>15+</strong>
                    <span>Years Experience</span>
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
                <h2 class="section__title">Built from the Ground Up —<br>Just Like Our Projects</h2>
            </div>
            <div class="about-story__body reveal">
                <p>Spicola Construction was born out of a passion for building things right. With over 15 years of hands-on experience in Florida's construction industry, our founder saw an opportunity to create a company that puts quality and integrity above everything else — no shortcuts, no excuses.</p>
                <p>Word travels fast when you do great work. From custom home builds to large-scale commercial renovations, we've grown through referrals and repeat clients. Every project in our portfolio was earned through results — not advertising.</p>
                <p>Today, Spicola Construction is a full-service general contracting firm serving Hillsborough, Pinellas, and Pasco counties. From ground-up new builds to complete interior renovations, we handle every phase of construction with the same dedication to craftsmanship that started it all.</p>
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
                    <h3 class="about-val__title">Quality Over Quantity</h3>
                    <p class="about-val__text">We don't cut corners. Every joint, every finish, every detail is executed to the highest standard — because your building is only as good as the people who built it.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>
                    </div>
                    <div class="about-val__num">02</div>
                    <h3 class="about-val__title">Transparent Pricing</h3>
                    <p class="about-val__text">You'll know exactly what your project costs before we break ground. Detailed estimates, no hidden fees, and no change-order surprises. We quote it, we stick to it.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="about-val__num">03</div>
                    <h3 class="about-val__title">On Time, Every Time</h3>
                    <p class="about-val__text">Construction delays cost money. We set realistic timelines and hold ourselves accountable. When we say we'll be done by a date, we mean it.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="about-val__num">04</div>
                    <h3 class="about-val__title">Clean Jobsites</h3>
                    <p class="about-val__text">A clean site is a safe site. We maintain organized, debris-free work areas throughout every project — because professionalism shows in the details.</p>
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
                <strong class="svc-stat__num">250<span>+</span></strong>
                <span class="svc-stat__label">Projects Completed</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">15<span>+</span></strong>
                <span class="svc-stat__label">Years Experience</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">100<span>%</span></strong>
                <span class="svc-stat__label">Licensed &amp; Insured</span>
            </div>
            <div class="svc-stat__divider" aria-hidden="true"></div>
            <div class="svc-stat">
                <strong class="svc-stat__num">3</strong>
                <span class="svc-stat__label">Counties Served</span>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         WHAT SETS US APART
         ════════════════════════════════════════════════════════════ -->
    <section class="about-family" aria-label="What sets us apart">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Why Spicola</span>
                <h2 class="section__title">What Sets Us<br>Apart</h2>
                <p class="section__subtitle section__subtitle--narrow">We're not a faceless corporation. We're a family-owned construction company that takes pride in every nail, every beam, and every handshake. Here's what makes working with us different.</p>
            </div>
            <div class="about-family__grid reveal">
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="about-family__name">Full-Service General Contracting</h3>
                    <p class="about-family__desc">From permits and blueprints to the final walkthrough — we manage every aspect of your build so you don't have to juggle multiple contractors.</p>
                    <span class="about-family__tag">Commercial &amp; Residential</span>
                </article>
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <h3 class="about-family__name">Built for Florida</h3>
                    <p class="about-family__desc">We understand Florida's unique building codes, hurricane standards, and climate challenges. Every project is engineered to withstand what the Sunshine State throws at it.</p>
                    <span class="about-family__tag">Code-Compliant &amp; Storm-Ready</span>
                </article>
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="about-family__name">Family-Owned Values</h3>
                    <p class="about-family__desc">When you work with Spicola, you work with the owner. We answer our phones, show up when we say we will, and treat every project like our reputation depends on it — because it does.</p>
                    <span class="about-family__tag">Direct Owner Involvement</span>
                </article>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         CERTIFICATIONS & LICENSES
         ════════════════════════════════════════════════════════════ -->
    <section class="about-certs" aria-label="Trusted by these brands">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Trusted By</span>
                <h2 class="section__title">Recognized by Brands<br>That <em>Matter</em></h2>
                <p class="section__subtitle section__subtitle--narrow">We're proud to be recognized and trusted by leading industry networks and directories across Tampa Bay.</p>
            </div>
            <div class="about-certs__grid reveal">
                <div class="about-certs__logo">
                    <img src="https://spicolaconstruction.com/wp-content/uploads/2025/05/TBBN_Logo.png" alt="Tampa Bay Business Network" loading="lazy" decoding="async">
                </div>
                <div class="about-certs__logo">
                    <img src="https://spicolaconstruction.com/wp-content/uploads/2025/05/images-480x104.png" alt="Certification" loading="lazy" decoding="async">
                </div>
                <div class="about-certs__logo">
                    <img src="https://spicolaconstruction.com/wp-content/uploads/2025/05/yellow-pages-logo-vector-760x184.png" alt="Yellow Pages" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Certifications */
    .about-certs{padding:clamp(4rem,6vw,6rem) 0;background:#fff;position:relative}
    .about-certs .section__title{color:var(--brand-navy,#222D3F)}
    .about-certs .section__title em{font-style:normal;color:var(--brand,#C13333)}
    .about-certs .section__subtitle{color:rgba(34,45,63,.6)}
    .about-certs__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:3rem;max-width:900px;margin-left:auto;margin-right:auto}
    .about-certs__logo{background:#f8f7f5;border:1px solid rgba(34,45,63,.08);border-radius:14px;padding:2rem;display:flex;align-items:center;justify-content:center;aspect-ratio:3/2;transition:all .35s ease}
    .about-certs__logo img{max-width:100%;max-height:100%;object-fit:contain}
    .about-certs__logo:hover{border-color:rgba(193,51,51,.2);background:#fff;transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.08)}
    .about-certs__placeholder{font-family:'Montserrat',sans-serif;font-size:.85rem;font-weight:700;color:rgba(34,45,63,.15);text-transform:uppercase;letter-spacing:.15em;border:2px dashed rgba(34,45,63,.08);border-radius:8px;width:100%;height:100%;display:flex;align-items:center;justify-content:center}
    @media(max-width:900px){.about-certs__grid{grid-template-columns:repeat(3,1fr)}}
    @media(max-width:600px){.about-certs__grid{grid-template-columns:repeat(2,1fr);gap:1rem}}
    </style>

    <!-- ════════════════════════════════════════════════════════════
         CTA
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-cta" aria-label="Get in touch CTA">
        <div class="svc-cta__pulse" aria-hidden="true"></div>
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">Let's Build Together</span>
                <h2 class="svc-cta__title">Ready to Start<br><em>Your Project?</em></h2>
                <p class="svc-cta__desc">Whether it's a commercial build-out, a home renovation, or a ground-up new construction — we'd love to earn your trust. Call us today for a free, no-obligation estimate.</p>
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
