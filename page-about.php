<?php
/**
 * Template Name: About
 * Restowrx Elite — About Page
 * Our story, values, and why Tampa Bay trusts us
 */
get_header(); ?>

<main class="site-main" id="main-content" style="background:#050505; color:#ffffff; font-family:var(--font-main, 'Inter', sans-serif); overflow-x:hidden;">

    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="about-hero" aria-label="About Restowrx Elite">
        <div class="about-hero__bg" aria-hidden="true">
            <div class="about-hero__scanline"></div>
            <div class="about-hero__grid"></div>
        </div>
        <div class="about-hero__inner">
            <div class="about-hero__text">
                <span class="svc-hero__badge">
                    <span class="svc-hero__badge-dot" aria-hidden="true"></span>
                    Tampa Bay's Property Recovery Center
                </span>
                <h1 class="about-hero__title">We Don't Just<br><em>Restore.</em></h1>
                <p class="about-hero__desc">We restore certainty. Restowrx Elite was founded on a simple belief: when disaster strikes, you deserve rapid response speed, clinical mitigation excellence, and a professional team that treats your property like their own.</p>
                <div class="about-hero__actions">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--lg">Request Service</a>
                    <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn--outline btn--lg">Our Specializations</a>
                </div>
            </div>
            <div class="about-hero__visual">
                <div class="about-hero__mascot-glow" aria-hidden="true"></div>
                <div class="svc-hero__float svc-hero__float--1">
                    <strong>250+</strong>
                    <span>Deployments Completed</span>
                </div>
                <div class="svc-hero__float svc-hero__float--2">
                    <strong>45 MIN</strong>
                    <span>Avg. Response Time</span>
                </div>
            </div>
        </div>
    </section>

    <style>
    .about-hero {
        position: relative;
        padding: clamp(140px, 12vw, 200px) 0 clamp(60px, 6vw, 100px) 0;
        background: #000;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 0, 0, 0.15);
    }
    .about-hero__bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 70% 50%, rgba(18, 3, 3, 0.5) 0%, #000 100%);
        z-index: 1;
    }
    .about-hero__scanline {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 50%, rgba(255, 0, 0, 0.02) 50%);
        background-size: 100% 4px;
        pointer-events: none;
    }
    .about-hero__grid {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }
    .about-hero__inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 40px;
        align-items: center;
    }
    .about-hero__text {
        max-width: 650px;
    }
    .svc-hero__badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 0, 0, 0.1);
        border: 1px solid rgba(255, 0, 0, 0.25);
        color: var(--brand, #ff0000);
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 4px;
        margin-bottom: 25px;
    }
    .svc-hero__badge-dot {
        width: 6px;
        height: 6px;
        background: var(--brand, #ff0000);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--brand, #ff0000);
    }
    .about-hero__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.5rem, 6vw, 6rem);
        line-height: 0.9;
        margin: 0 0 25px 0;
        text-transform: uppercase;
        color: white;
    }
    .about-hero__title em {
        font-style: normal;
    }
    .about-hero__desc {
        color: #aaa;
        font-size: 1.15rem;
        line-height: 1.7;
        margin-bottom: 35px;
    }
    .about-hero__actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .about-hero__visual {
        position: relative;
        height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .about-hero__mascot-glow {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,0,0,0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 6s infinite ease-in-out;
    }
    @keyframes pulseGlow {
        0%, 100% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.15); opacity: 1; }
    }
    .svc-hero__float {
        position: absolute;
        background: rgba(10, 10, 10, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 25px;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 160px;
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
    }
    .svc-hero__float--1 {
        top: 20%; left: 10%;
        border-left: 3px solid var(--brand, #ff0000);
    }
    .svc-hero__float--2 {
        bottom: 20%; right: 10%;
        border-left: 3px solid var(--brand, #ff0000);
    }
    .svc-hero__float strong {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 2.8rem;
        color: var(--brand, #ff0000);
        line-height: 1;
        margin-bottom: 5px;
    }
    .svc-hero__float span {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.65rem;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    @media(max-width:991px) {
        .about-hero__inner {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 20px;
        }
        .about-hero__actions {
            justify-content: center;
        }
        .about-hero__visual {
            height: 250px;
        }
    }
    </style>

    <!-- ════════════════════════════════════════════════════════════
         OUR STORY
         ════════════════════════════════════════════════════════════ -->
    <!-- ════════════════════════════════════════════════════════════
         OUR STORY (LIGHT THEME)
         ════════════════════════════════════════════════════════════ -->
    <section class="about-story about-story--light" aria-label="Our story">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Our Background</span>
                <h2 class="section__title">Established Property Restoration Experts —<br>Built for Ultimate Mitigation</h2>
            </div>
            <div class="about-story__layout reveal">
                <div class="about-story__right">
                    <p>Restowrx Elite was born out of a strategic necessity in Florida's catastrophic recovery sector. Guided by the vision of providing an unparalleled, immediate response, our founders established a property restoration center that operates with surgical precision and clinical technology.</p>
                    <p>When sudden disaster strikes—be it catastrophic water intrusion, fire and smoke, or hazardous biological mold—word travels fast when you restore properties to absolute pre-loss perfection. Every case study in our log represents structural integrity preserved and property equity saved.</p>
                    <p>To deliver a complete turnkey recovery, Restowrx Elite integrates directly with our licensed general contractor sister company, <strong>Spicola Construction</strong>. From the moment our emergency extraction response teams stabilize your site to the final structural build-back, you receive a seamless, zero-compromise restoration experience.</p>
                </div>
                <div class="about-story__left">
                    <div class="about-story__accent-bar" aria-hidden="true"></div>
                    <div class="about-story__chips">
                        <span class="about-story__chip">Est. 2020</span>
                        <span class="about-story__chip">Tampa Bay, FL</span>
                        <span class="about-story__chip">24/7 Dispatch Center</span>
                    </div>
                    <blockquote class="about-story__quote">
                        &ldquo;Absolute pre-loss perfection — no shortcuts, no compromises, operating at the apex.&rdquo;
                    </blockquote>
                    <div class="about-story__stat-row">
                        <div class="about-story__stat">
                            <strong>45 MIN</strong>
                            <span>Avg Response</span>
                        </div>
                        <div class="about-story__stat">
                            <strong>250+</strong>
                            <span>Deployments</span>
                        </div>
                        <div class="about-story__stat">
                            <strong>3</strong>
                            <span>Counties Served</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    .section__inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
    }
    .section__header--center {
        text-align: center;
        margin-bottom: 50px;
    }
    .section__label {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.75rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 10px;
        font-weight: 700;
    }
    .section__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2.5rem, 4vw, 4.5rem);
        text-transform: uppercase;
        line-height: 0.95;
        color: white;
    }
    .about-story {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #050505;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    /* Elegant Light Theme Overrides */
    .about-story--light {
        background: #ffffff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }
    .about-story--light .section__title {
        color: #111111;
    }
    .about-story--light .about-story__right p {
        color: #333333;
    }
    .about-story--light .about-story__left {
        background: #f8f9fa;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }
    .about-story--light .about-story__quote {
        color: #111111;
    }
    .about-story--light .about-story__stat-row {
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }
    .about-story--light .about-story__stat span {
        color: #555555;
    }

    .about-story__layout {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: clamp(3rem, 5vw, 6rem);
        margin-top: clamp(2.5rem, 4vw, 4rem);
        align-items: start;
    }
    .about-story__left {
        position: relative;
        padding-left: 1.75rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 30px;
        border-radius: 4px;
    }
    .about-story__accent-bar {
        position: absolute;
        left: 0; top: 0; bottom: 0; width: 4px;
        background: linear-gradient(180deg, var(--brand,#ff0000) 0%, rgba(255, 0, 0, 0.1) 100%);
    }
    .about-story__chips {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-bottom: 1.75rem;
    }
    .about-story__chip {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: .65rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--brand,#ff0000);
        background: rgba(255, 0, 0, 0.05);
        border: 1px solid rgba(255, 0, 0, 0.2);
        border-radius: 4px;
        padding: .35rem .9rem;
    }
    .about-story__quote {
        font-family: var(--font-main, 'Inter', sans-serif);
        font-size: 1.15rem;
        font-weight: 700;
        font-style: italic;
        color: white;
        line-height: 1.5;
        margin: 0 0 2rem;
        border: none;
        padding: 0;
    }
    .about-story__stat-row {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 20px;
    }
    .about-story__stat {
        display: flex;
        flex-direction: column;
    }
    .about-story__stat strong {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 2.2rem;
        color: var(--brand,#ff0000);
        line-height: 1;
    }
    .about-story__stat span {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: .6rem;
        font-weight: 600;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: .3rem;
    }
    .about-story__right p {
        font-size: 1.05rem;
        line-height: 1.85;
        color: #ccc;
        margin: 0 0 1.5rem;
    }
    .about-story__right p:last-child {
        margin-bottom: 0;
    }
    @media(max-width:800px) {
        .about-story__layout {
            grid-template-columns: 1fr;
        }
        .about-story__left {
            margin-bottom: 2.5rem;
        }
    }
    </style>

    <!-- ════════════════════════════════════════════════════════════
         CORE VALUES
         ════════════════════════════════════════════════════════════ -->
    <section class="about-values" aria-label="Our core values">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Our Core Principles</span>
                <h2 class="section__title">Built on Absolute<br>Execution &amp; Integrity</h2>
            </div>
            <div class="about-values__grid reveal">
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="about-val__num">01</div>
                    <h3 class="about-val__title">Rapid Response &amp; Deploy</h3>
                    <p class="about-val__text">Time dictates property survival. We mobilize response teams within 15 minutes and deploy on-site within 45 minutes to execute emergency stabilization.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="about-val__num">02</div>
                    <h3 class="about-val__title">Moisture Assessment &amp; Mapping</h3>
                    <p class="about-val__text">We do not guess. We map structural moisture paths with industrial thermal cameras and digital thermal imaging to expose every drop of hidden damage.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="about-val__num">03</div>
                    <h3 class="about-val__title">Insurance Claims Integration</h3>
                    <p class="about-val__text">We speak the language of insurance providers. We document case files with forensic precision, supporting direct insurance billing to minimize your out-of-pocket stress.</p>
                </article>
                <article class="about-val">
                    <div class="about-val__icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div class="about-val__num">04</div>
                    <h3 class="about-val__title">Clinical Containment Control</h3>
                    <p class="about-val__text">Safety is absolute. We establish strict biological isolation, clinical containment barriers, and negative-pressure HEPA air scrubbing to ensure complete micro-spore containment.</p>
                </article>
            </div>
        </div>
    </section>

    <style>
    .about-values {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #0a0a0a;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .about-values__grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    .about-val {
        background: #050505;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 40px 30px;
        position: relative;
        transition: all 0.3s ease;
        border-radius: 4px;
    }
    .about-val:hover {
        border-color: var(--brand, #ff0000);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.6);
    }
    .about-val__icon {
        color: var(--brand, #ff0000);
        margin-bottom: 25px;
    }
    .about-val__num {
        position: absolute;
        top: 30px; right: 30px;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.8rem;
        color: var(--brand, #ff0000);
        opacity: 0.3;
        font-weight: 700;
    }
    .about-val__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }
    .about-val__text {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    </style>

    <!-- ════════════════════════════════════════════════════════════
         WHAT SETS US APART
         ════════════════════════════════════════════════════════════ -->
    <!-- ════════════════════════════════════════════════════════════
         WHAT SETS US APART (LIGHT THEME)
         ════════════════════════════════════════════════════════════ -->
    <section class="about-family about-family--light" aria-label="What sets us apart">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Our Professional Edge</span>
                <h2 class="section__title">Expert Property Recovery</h2>
                <p class="section__subtitle section__subtitle--narrow" style="max-width:700px; margin:20px auto 0 auto; line-height:1.6;">We are not a bloated generalist corporation. We are a specialized property restoration team operating under strict containment protocols. Here is what separates our expert team from general contractors.</p>
            </div>
            <div class="about-family__grid reveal">
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    </div>
                    <h3 class="about-family__name">IICRC Certified Response Teams</h3>
                    <p class="about-family__desc">Our specialists hold certified credentials in advanced structural drying, fire mitigation, and mold containment. We execute to pure professional standards.</p>
                    <span class="about-family__tag">Zero Contamination Policy</span>
                </article>
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div class="about-family__badge-accent" aria-hidden="true"></div>
                    <h3 class="about-family__name">Structural Build-Back Integration</h3>
                    <p class="about-family__desc">Once mitigation is stabilized, our partnership with Spicola Construction guarantees seamless reconstruction, permit management, and code-ready structural build-back.</p>
                    <span class="about-family__tag">Partnered General Contractor</span>
                </article>
                <article class="about-family__card">
                    <div class="about-family__icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="about-family__name">Forensic Documentation</h3>
                    <p class="about-family__desc">We collect digital telemetry, thermal images, and comprehensive humidity mapping, compiling airtight case files to secure rapid insurance authorization.</p>
                    <span class="about-family__tag">Direct Insurance Billing</span>
                </article>
            </div>
        </div>
    </section>

    <style>
    .about-family {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #050505;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    /* Elegant Light Theme Overrides */
    .about-family--light {
        background: #ffffff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }
    .about-family--light .section__title {
        color: #111111;
    }
    .about-family--light .section__subtitle {
        color: #555555 !important;
    }
    .about-family--light .about-family__card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.03);
    }
    .about-family--light .about-family__card:hover {
        border-color: var(--brand, #ff0000);
        box-shadow: 0 15px 35px rgba(255, 0, 0, 0.08);
    }
    .about-family--light .about-family__name {
        color: #111111;
    }
    .about-family--light .about-family__desc {
        color: #555555;
    }

    .about-family__grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }
    .about-family__card {
        background: #0a0a0a;
        border: 1px solid rgba(255,255,255,0.05);
        padding: 40px 30px;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        position: relative;
        transition: all 0.3s ease;
    }
    .about-family__card:hover {
        border-color: var(--brand, #ff0000);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.6);
    }
    .about-family__icon {
        color: var(--brand, #ff0000);
        margin-bottom: 25px;
    }
    .about-family__name {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }
    .about-family__desc {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 25px;
        flex-grow: 1;
    }
    .about-family__tag {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.65rem;
        color: var(--brand, #ff0000);
        text-transform: uppercase;
        letter-spacing: 1px;
        background: rgba(255, 0, 0, 0.05);
        border: 1px solid rgba(255, 0, 0, 0.2);
        padding: 4px 10px;
        border-radius: 4px;
        align-self: flex-start;
    }
    </style>

    <!-- ════════════════════════════════════════════════════════════
         CTA
         ════════════════════════════════════════════════════════════ -->
    <section class="svc-cta" aria-label="Incident request CTA">
        <div class="svc-cta__pulse" aria-hidden="true"></div>
        <div class="svc-cta__inner reveal">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">24/7 Rapid Response</span>
                <h2 class="svc-cta__title">Structural Loss?<br><em>Request Restoration Services</em></h2>
                <p class="svc-cta__desc" style="color:#aaa;">Do not let structural property damage dictate terms. Contact our emergency dispatch center for immediate insurance claim coordination and mitigation support.</p>
            </div>
            <div class="svc-cta__actions">
                <a href="tel:+18136994009" class="btn btn--primary btn--lg" style="font-family:var(--font-accent); font-size:1.3rem; letter-spacing:1px; padding:10px 30px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" style="margin-right:8px; vertical-align:-3px;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"/></svg>
                    Dispatch: 813.699.4009
                </a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg" style="font-family:var(--font-accent); font-size:1.3rem; letter-spacing:1px; padding:10px 30px; border-color:rgba(255,255,255,0.2);">
                    Request Free Estimate
                </a>
            </div>
        </div>
    </section>

    <style>
    .svc-cta {
        position: relative;
        background: radial-gradient(circle at 50% 50%, #200202 0%, #000 100%);
        padding: clamp(60px, 10vw, 120px) 0;
        border-top: 1px solid rgba(255,0,0,0.2);
        overflow: hidden;
    }
    .svc-cta__pulse {
        position: absolute;
        top: 50%; left: 50%; width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(255,0,0,0.08) 0%, transparent 70%);
        transform: translate(-50%, -50%);
        animation: pulseScale 4s infinite linear;
        border-radius: 50%;
    }
    @keyframes pulseScale {
        0% { transform: translate(-50%, -50%) scale(0.7); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1.3); opacity: 0; }
    }
    .svc-cta__inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 40px;
        position: relative;
        z-index: 10;
    }
    .svc-cta__eyebrow {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.8rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .svc-cta__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        line-height: 0.95;
        margin: 0 0 15px 0;
    }
    .svc-cta__title em {
        color: transparent;
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.7);
        font-style: normal;
    }
    .svc-cta__actions {
        display: flex;
        gap: 15px;
        flex-shrink: 0;
        flex-wrap: wrap;
    }
    @media (max-width: 900px) {
        .svc-cta__inner {
            flex-direction: column;
            text-align: center;
        }
        .svc-cta__actions {
            justify-content: center;
        }
    }
    </style>

</main>

<?php get_footer(); ?>
