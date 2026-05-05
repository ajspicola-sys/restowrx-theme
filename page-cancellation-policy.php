<?php
/**
 * Hot Water Heroes Plumbing — Cancellation & Financial Policy Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Cancellation & Financial Policy">
        <div class="page-hero__inner">
            <span class="section__label">Legal</span>
            <h1 class="page-hero__title">Cancellation &amp; Financial Policy</h1>
            <p class="page-hero__desc">Please read our policies carefully before booking your service appointment.</p>
        </div>
    </section>

    <section class="legal-page">
        <div class="legal-page__inner">

            <div class="legal-page__intro cancellation-notice">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p><strong>PLEASE NOTE: ALL COMPLETED SERVICE CHARGES ARE FINAL.</strong></p>
            </div>

            <div class="legal-page__body">

                <section id="payment-methods">
                    <h2>Payment Methods</h2>
                    <p>We accept <strong>Cash, AMEX, Visa, MasterCard, and Checks</strong>. A valid credit card may be required to schedule a service appointment. Payment is due upon completion of work.</p>
                    <p>All cards on file are processed through a <strong>secure electronic system</strong> that ensures encryption and the highest level of protection.</p>
                </section>

                <section id="cancellation-policy">
                    <h2>Cancellation &amp; No-Show Policy</h2>
                    <p>To provide the best service for all customers, we enforce the following cancellation policy:</p>

                    <div class="cancellation-grid">
                        <div class="cancellation-card cancellation-card--warn">
                            <div class="cancellation-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                            <div class="cancellation-card__body">
                                <h3>Cancellations within 24 hours</h3>
                                <p>A <strong>service call fee</strong> may be charged to cover scheduling and dispatch costs.</p>
                            </div>
                        </div>
                        <div class="cancellation-card cancellation-card--danger">
                            <div class="cancellation-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></div>
                            <div class="cancellation-card__body">
                                <h3>No-Shows</h3>
                                <p>If our plumber arrives and no one is home, a <strong>trip charge</strong> will apply.</p>
                            </div>
                        </div>
                        <div class="cancellation-card cancellation-card--info">
                            <div class="cancellation-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg></div>
                            <div class="cancellation-card__body">
                                <h3>Rescheduling</h3>
                                <p>We're happy to <strong>reschedule your appointment</strong> at no charge if you provide at least 24 hours notice.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="estimates">
                    <h2>Estimates & Pricing</h2>
                    <p>All estimates are provided before work begins. If additional repairs are discovered during a job, we will <strong>always get your approval</strong> before proceeding with any charges beyond the original estimate.</p>
                </section>

                <section id="exceptions">
                    <h2>Exceptions</h2>
                    <p>We understand that emergencies happen. Exceptions to cancellation fees include:</p>
                    <ul>
                        <li>Medical or family emergencies</li>
                        <li>Severe weather events</li>
                    </ul>
                    <p>You will not be penalized in these situations.</p>
                </section>

                <section id="declined-payments">
                    <h2>Declined Payments</h2>
                    <p>If your credit card payment is declined, the balance must be paid in full before booking another appointment. Unresolved balances may be sent to collections if not resolved within <strong>30 days</strong>.</p>
                </section>

                <section id="additional-provisions">
                    <h2>Additional Provisions</h2>
                    <ol>
                        <li>If any portion of this Agreement is deemed invalid, the remaining terms shall remain in full effect.</li>
                        <li>Should a lawsuit be filed to collect fees or enforce this Agreement, the prevailing party will be entitled to reasonable costs and attorney's fees.</li>
                        <li>This Financial Policy and Agreement is the <strong>entire agreement</strong> between parties and supersedes all prior agreements, written or oral. Any changes must be made in writing and signed by all parties.</li>
                    </ol>
                </section>

                <section id="acknowledgement">
                    <h2>Acknowledgement</h2>
                    <p>We are committed to serving you with the highest quality workmanship at a fair price. If you have questions regarding these policies, please reach out at any time.</p>
                    <blockquote class="legal-quote">
                        <strong>I have read and understand this Financial Policy and Agreement.</strong><br><br>
                        I authorize <strong>Hot Water Heroes Plumbing</strong> to charge my credit card for no-show appointments, late cancellation fees, and outstanding service balances.
                    </blockquote>
                    <div style="margin-top:2rem;text-align:center;">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary">Questions? Contact Us</a>
                    </div>
                </section>

            </div><!-- .legal-page__body -->
        </div><!-- .legal-page__inner -->
    </section>

</main>

<?php get_footer(); ?>
