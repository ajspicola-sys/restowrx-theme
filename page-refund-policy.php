<?php
/**
 * Restowrx Elite — Refund Policy Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Refund Policy">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span>Refund Policy</span>
            </div>
            <h1 class="page-hero__title">Refund <em>Policy</em></h1>
            <p class="page-hero__desc">Please review our policy regarding refunds and service cancellations.</p>
        </div>
    </section>

    <section class="legal-page">
        <div class="legal-page__inner">

            <div class="legal-page__intro cancellation-notice">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p><strong>ALL COMPLETED SERVICE CHARGES ARE FINAL.</strong></p>
            </div>

            <div class="legal-page__body">

                <section id="services">
                    <h2>Mitigation & Restoration Services</h2>
                    <p>At Restowrx Elite, we strive to ensure every property owner receives quality workmanship. Before services are performed, we provide clear scope details and coordinate directly with your insurance carrier so you can make informed decisions.</p>

                    <div class="refund-policy-cards">
                        <div class="refund-policy-card">
                            <div class="refund-policy-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
                            <h3>No Refunds on Completed Work</h3>
                            <p>Once property mitigation or restoration services are completed, charges are <strong>non-refundable</strong>.</p>
                        </div>
                        <div class="refund-policy-card refund-policy-card--positive">
                            <div class="refund-policy-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <h3>Satisfaction Guarantee</h3>
                            <p>If you're not satisfied with our work, contact us within <strong>30 days</strong> and we'll send a recovery specialist back to address the issue at <strong>no additional charge</strong>.</p>
                        </div>
                    </div>
                </section>

                <section id="estimates">
                    <h2>Estimates & Pricing</h2>
                    <p>All estimates are provided in writing before work begins. If additional work is discovered during a job, we will <strong>always get your approval</strong> before proceeding with any charges beyond the original estimate.</p>
                    <p>Diagnostic and inspection fees are <strong>non-refundable</strong> regardless of whether you proceed with the recommended repair.</p>
                </section>

                <section id="commitment">
                    <h2>Our Commitment</h2>
                    <p>This policy is designed to ensure transparency and fairness while upholding the highest standard of workmanship for all our customers.</p>
                    <p>If you have any questions about our refund policy or a recent service, our team is always here to help.</p>
                    <div class="legal-cta">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Speak With Our Team</a>
                    </div>
                </section>

            </div><!-- .legal-page__body -->
        </div><!-- .legal-page__inner -->
    </section>

</main>

<?php get_footer(); ?>
