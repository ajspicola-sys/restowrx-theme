<?php
/**
 * Template Name: Values
 * Restowrx Elite — Our Mission & Core Values Page
 */
get_header(); ?>

<main class="site-main" id="main-content" style="background:#050505; color:#ffffff; font-family:var(--font-main, 'Inter', sans-serif); overflow-x:hidden;">

    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="page-hero" aria-label="Our Mission">
        <div class="page-hero__bg" aria-hidden="true">
            <div class="page-hero__scanline"></div>
            <div class="page-hero__grid"></div>
        </div>
        <div class="page-hero__inner reveal">
            <span class="section__label">What Drives Us</span>
            <h1 class="page-hero__title">Our Mission</h1>
            <p class="page-hero__desc">To deliver clinical, high-capacity damage mitigation and property recovery with surgical speed and absolute precision across Tampa Bay.</p>
        </div>
    </section>

    <style>
    .page-hero {
        position: relative;
        padding: clamp(140px, 12vw, 180px) 0 clamp(50px, 5vw, 80px) 0;
        background: #000;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 0, 0, 0.15);
        text-align: center;
    }
    .page-hero__bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, rgba(18, 3, 3, 0.4) 0%, #000 100%);
        z-index: 1;
    }
    .page-hero__scanline {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 50%, rgba(255, 0, 0, 0.02) 50%);
        background-size: 100% 4px;
        pointer-events: none;
    }
    .page-hero__grid {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }
    .page-hero__inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
    }
    .page-hero__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.5rem, 6vw, 6rem);
        text-transform: uppercase;
        color: white;
        margin: 0 0 20px 0;
        letter-spacing: 1px;
    }
    .page-hero__desc {
        color: #aaa;
        font-size: clamp(1rem, 1.2vw, 1.25rem);
        line-height: 1.7;
        margin: 0 auto;
        max-width: 650px;
    }
    </style>

    <!-- Mission Statement -->
    <section class="mission-section" aria-label="Our mission statement">
        <div class="section__inner">
            <div class="mission-statement reveal">
                <div class="mission-statement__quote">
                    &ldquo;We believe every property owner deserves an elite recovery team they can trust — a response team that deploys within minutes, maps structural moisture accurately, and coordinates directly with insurance to minimize secondary loss.&rdquo;
                </div>
                <span class="mission-statement__author">— The Restowrx Elite Team</span>
            </div>

            <div class="mission-pillars reveal">
                <div class="mission-pillar">
                    <div class="mission-pillar__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg></div>
                    <h2 class="mission-pillar__title">Clinical Accuracy</h2>
                    <p class="mission-pillar__text">Every deployment is executed by IICRC certified damage restoration specialists using advanced thermal imaging and moisture mapping. We do not guess structural damage.</p>
                </div>
                <div class="mission-pillar">
                    <div class="mission-pillar__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <h2 class="mission-pillar__title">Mitigation Integrity</h2>
                    <p class="mission-pillar__text">We provide detailed restoration logs, transparent digital scans, and direct insurance claims coordination. We document with absolute accuracy to accelerate claim approvals.</p>
                </div>
                <div class="mission-pillar">
                    <div class="mission-pillar__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                    <h2 class="mission-pillar__title">Incident Command</h2>
                    <p class="mission-pillar__text">Your property recovery is our top priority. We operate 24/7/365 active radar, coordinate all phases of mitigation, and maintain direct communications from launch to build-back.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
    .mission-section {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #050505;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .mission-statement {
        text-align: center;
        max-width: 850px;
        margin: 0 auto 80px auto;
        background: rgba(255, 0, 0, 0.03);
        border: 1px solid rgba(255, 0, 0, 0.15);
        padding: 40px;
        border-radius: 4px;
    }
    .mission-statement__quote {
        font-family: var(--font-main, 'Inter', sans-serif);
        font-size: clamp(1.2rem, 2vw, 1.5rem);
        font-weight: 700;
        font-style: italic;
        line-height: 1.5;
        color: white;
        margin-bottom: 25px;
    }
    .mission-statement__author {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.75rem;
        color: var(--brand, #ff0000);
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .mission-pillars {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
    }
    .mission-pillar {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        background: #0a0a0a;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 35px 25px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    .mission-pillar:hover {
        border-color: var(--brand, #ff0000);
        transform: translateY(-5px);
    }
    .mission-pillar__icon {
        color: var(--brand, #ff0000);
        margin-bottom: 25px;
        background: rgba(255, 0, 0, 0.05);
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid rgba(255, 0, 0, 0.2);
    }
    .mission-pillar__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        margin-bottom: 15px;
    }
    .mission-pillar__text {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }
    </style>

    <!-- Values Section -->
    <section class="values-full" aria-label="Our core values">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Our Core Principles</span>
                <h2 class="section__title">Our Core Values</h2>
                <p class="section__subtitle" style="color:#888; max-width:650px; margin:15px auto 0 auto; line-height:1.6;">The principles that guide every rapid response dispatch, every moisture scan, and every property recovery project at Restowrx Elite.</p>
            </div>
            <div class="values-detailed">

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">01</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Zero-Tolerance Containment</h3>
                        <p class="value-detail__text">We believe micro-spores and secondary damage thrive on neglect. Our response teams enforce absolute containment barriers, clinical containment, and negative air scrubbers to guarantee structural safety and prevent clean zones from contamination.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">02</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Clinical Standards</h3>
                        <p class="value-detail__text">Property mitigation is science. We adhere strictly to national restoration standards (IICRC S500 and S520), utilizing advanced industrial thermal imaging and moisture mapping to ensure structural frames are completely dry before reconstruction begins.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">03</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Detailed Accountability</h3>
                        <p class="value-detail__text">We document every deployment with absolute accuracy. From thermal scans to moisture logs, we provide clear digital case files and handle direct insurance coordination to make your recovery stress-free and seamless.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">04</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">45-Minute Rapid Deploy</h3>
                        <p class="value-detail__text">Mitigation delays are catastrophic. Our emergency operators operate 24/7/365 active dispatch, dispatching rapid response specialists within 15 minutes, and securing on-site emergency response within 45 minutes across Tampa Bay.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">05</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Integrated Reconstruction</h3>
                        <p class="value-detail__text">We bridge the gap between mitigation and build-back. Our partnership with Spicola Construction guarantees permit pulling, structural engineering, and high-end general contracting build-back back to pre-loss structural perfection.</p>
                    </div>
                </div>

                <div class="value-detail reveal">
                    <div class="value-detail__number" aria-hidden="true">06</div>
                    <div class="value-detail__content">
                        <h3 class="value-detail__title">Community Shield</h3>
                        <p class="value-detail__text">We protect the community that trusts us. In the aftermath of catastrophic storms or sudden fires, we stand as Tampa Bay's shield, helping families navigate disaster claims, securing structural safety, and defending their properties.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
    .values-full {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #0a0a0a;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .values-detailed {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-top: 50px;
    }
    .value-detail {
        display: flex;
        gap: 25px;
        background: #050505;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 35px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    .value-detail:hover {
        border-color: var(--brand, #ff0000);
        transform: translateY(-3px);
    }
    .value-detail__number {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--brand, #ff0000);
        line-height: 1.2;
    }
    .value-detail__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin: 0 0 12px 0;
        letter-spacing: 1px;
    }
    .value-detail__text {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }
    @media(max-width:800px) {
        .values-detailed {
            grid-template-columns: 1fr;
        }
    }
    </style>




</main>

<?php get_footer(); ?>
