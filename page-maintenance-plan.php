<?php
/**
 * Template Name: Maintenance Plan
 * Restowrx Elite — Active Property Defense Plan Page
 */
get_header(); ?>

<main class="site-main" id="main-content" style="background:#050505; color:#ffffff; font-family:var(--font-main, 'Inter', sans-serif); overflow-x:hidden;">

    <!-- Hero -->
    <section class="page-hero" aria-label="Active Property Defense Plan">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span>Defense Plan</span>
            </div>
            <h1 class="page-hero__title">Active Property<br><em>Defense Plan</em></h1>
            <p class="page-hero__desc">The ultimate property protection for your property — pre-incident risk assessment, guaranteed 24/7 priority emergency response, and exclusive member savings on restoration and reconstruction.</p>
            <div class="page-hero__actions" style="margin-top:25px; display:flex; justify-content:center;">
                <a href="/contact/" class="btn btn--primary btn--lg" style="font-family:var(--font-accent); font-size:1.3rem; letter-spacing:1px; padding:10px 30px;">Secure Protection Plan</a>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="maint-plan-section maint-plan-how" aria-label="How the plan works">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Operational Deployment</span>
                <h2 class="section__title">How It Works</h2>
            </div>
            <div class="maint-plan-steps reveal">
                <div class="maint-plan-step">
                    <div class="maint-plan-step__num">01</div>
                    <h3>Authorize Shield</h3>
                    <p>Select your defense level and our dispatch will schedule your first baseline structural risk and moisture telemetry scan immediately.</p>
                </div>
                <div class="maint-plan-step">
                    <div class="maint-plan-step__num">02</div>
                    <h3>Annual Mapping</h3>
                    <p>We deploy operators to execute annual thermal envelope scans, moisture scans, and check structural vulnerabilities.</p>
                </div>
                <div class="maint-plan-step">
                    <div class="maint-plan-step__num">03</div>
                    <h3>Bypass Dispatch Queue</h3>
                    <p>In catastrophic meteorological outbreaks or sudden emergencies, your property secures immediate queue priority bypass.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
    .maint-plan-section {
        padding: clamp(4rem, 6vw, 7rem) 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .maint-plan-how {
        background: #050505;
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
        color: white;
        line-height: 0.95;
    }
    .maint-plan-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin-top: 40px;
    }
    .maint-plan-step {
        background: #0a0a0a;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 40px 30px;
        border-radius: 4px;
        position: relative;
        text-align: center;
    }
    .maint-plan-step__num {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--brand, #ff0000);
        margin-bottom: 20px;
    }
    .maint-plan-step h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }
    .maint-plan-step p {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }
    </style>

    <!-- Benefits -->
    <section class="maint-plan-section maint-plan-benefits" aria-label="Membership benefits">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Shield Privileges</span>
                <h2 class="section__title">Defense Benefits</h2>
            </div>
            <div class="maint-plan-benefit-grid reveal">
                <div class="maint-plan-benefit">
                    <span class="maint-plan-benefit__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg></span>
                    <h3>15% Off All Mitigation</h3>
                    <p>Members save 15% on all emergency water extraction, mold remediation, biohazard cleanup, and structural dryout.</p>
                </div>
                <div class="maint-plan-benefit">
                    <span class="maint-plan-benefit__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
                    <h3>Priority Response</h3>
                    <p>Skip the dispatch queue. Shield members receive absolute priority emergency response dispatch 24/7/365.</p>
                </div>
                <div class="maint-plan-benefit">
                    <span class="maint-plan-benefit__icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></span>
                    <h3>Annual Structural Scan</h3>
                    <p>A comprehensive structural moisture mapping scan every year to expose hidden leaks and wood decay.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
    .maint-plan-benefits {
        background: #0a0a0a;
    }
    .maint-plan-benefit-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        margin-top: 40px;
    }
    .maint-plan-benefit {
        background: #050505;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 40px 30px;
        border-radius: 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: all 0.3s ease;
    }
    .maint-plan-benefit:hover {
        border-color: var(--brand, #ff0000);
    }
    .maint-plan-benefit__icon {
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
    .maint-plan-benefit h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }
    .maint-plan-benefit p {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }
    </style>

    <!-- Policy Details -->
    <section class="maint-plan-section maint-plan-policy" aria-label="Plan details">
        <div class="section__inner">
            <div class="section__header reveal section__header--center">
                <span class="section__label">Shield Guidelines</span>
                <h2 class="section__title">Protection Plan Terms</h2>
            </div>
            <div class="maint-plan-policy-grid reveal">
 
                <div class="maint-plan-policy-card">
                    <div class="maint-plan-policy-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg></div>
                    <h3>Annual Protection</h3>
                    <ul style="list-style:square; padding-left:15px; color:#888; line-height:1.6; font-size:0.9rem;">
                        <li style="margin-bottom:8px;">Plans operate on a **12-month service cycle** from authorization date.</li>
                        <li>Includes one full structural moisture scan and thermal envelope mapping annually.</li>
                    </ul>
                </div>

                <div class="maint-plan-policy-card">
                    <div class="maint-plan-policy-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
                    <h3>Deactivation</h3>
                    <ul style="list-style:square; padding-left:15px; color:#888; line-height:1.6; font-size:0.9rem;">
                        <li style="margin-bottom:8px;">Deactivate your protection shield anytime with **30 days' written notice**.</li>
                        <li>No exit fees, lock-ins, or structural penalties apply.</li>
                    </ul>
                </div>

                <div class="maint-plan-policy-card">
                    <div class="maint-plan-policy-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg></div>
                    <h3>Auto-Shield Status</h3>
                    <ul style="list-style:square; padding-left:15px; color:#888; line-height:1.6; font-size:0.9rem;">
                        <li style="margin-bottom:8px;">Defense shields renew automatically each year to ensure uninterrupted coverage.</li>
                        <li>You'll receive a system reminder **30 days prior to renewal**.</li>
                    </ul>
                </div>

                <div class="maint-plan-policy-card">
                    <div class="maint-plan-policy-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                    <h3>Structure Bound</h3>
                    <ul style="list-style:square; padding-left:15px; color:#888; line-height:1.6; font-size:0.9rem;">
                        <li style="margin-bottom:8px;">Shields are bound to the **property address**, protecting the structural asset.</li>
                        <li>If you sell the property, the defense coverage transfers seamlessly to the new owner.</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <style>
    .maint-plan-policy {
        background: #050505;
    }
    .maint-plan-policy-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }
    .maint-plan-policy-card {
        background: #0a0a0a;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 35px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    .maint-plan-policy-card:hover {
        border-color: var(--brand, #ff0000);
    }
    .maint-plan-policy-card__icon {
        color: var(--brand, #ff0000);
        margin-bottom: 20px;
    }
    .maint-plan-policy-card h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin-bottom: 15px;
        letter-spacing: 1px;
    }
    </style>




</main>

<?php get_footer(); ?>
