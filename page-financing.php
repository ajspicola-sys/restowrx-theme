<?php
/**
 * Template Name: Financing
 * Hot Water Heroes Plumbing — Payment Plans / Cherry Financing
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero page-hero--financing" aria-label="Payment Plans">
        <div class="page-hero__inner">
            <span class="section__label">Flexible Payment Plans</span>
            <h1 class="page-hero__title">Quality Plumbing,<br><em>Affordable Payments</em></h1>
            <p class="page-hero__desc">Don't let cost delay critical repairs. We offer flexible financing options so you can get the plumbing service you need — on your terms.</p>
            <div class="hero__actions" style="justify-content:center;">
                <a href="#cherry-section" class="btn btn--primary btn--lg">View Payment Plans →</a>
                <a href="#request-service" class="btn btn--outline btn--lg">Request Service</a>
            </div>
        </div>
    </section>

    <!-- Cherry Financing Widget -->
    <section class="cherry-section" id="cherry-section" aria-label="Cherry Financing">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Powered by Cherry</span>
                <h2 class="section__title">Simple, Transparent Financing</h2>
                <p class="section__desc">Apply in seconds, get approved instantly, and choose a payment plan that works for your budget. No hidden fees, no surprises.</p>
            </div>

            <!-- Cherry Widget Container -->
            <div class="cherry-widget-wrap reveal">
                <div id="all"></div>
            </div>
        </div>
    </section>

    <!-- Why Finance With Us -->
    <section class="financing-why" aria-label="Why finance with us">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why Finance?</span>
                <h2 class="section__title">Your Repair, Your Pace</h2>
            </div>
            <div class="financing-benefits reveal">
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></div>
                    <h3 class="financing-benefit__title">Instant Approval</h3>
                    <p class="financing-benefit__text">Apply in under 30 seconds and get a decision immediately. No lengthy paperwork or waiting periods.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg></div>
                    <h3 class="financing-benefit__title">0% APR Options</h3>
                    <p class="financing-benefit__text">Qualifying customers can enjoy 0% APR financing on select services. Pay over time with zero interest.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div>
                    <h3 class="financing-benefit__title">Easy Payments</h3>
                    <p class="financing-benefit__text">Manage your payment plan from your phone. Set up autopay and never miss a payment.</p>
                </div>
                <div class="financing-benefit">
                    <div class="financing-benefit__icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
                    <h3 class="financing-benefit__title">No Hidden Fees</h3>
                    <p class="financing-benefit__text">What you see is what you pay. No prepayment penalties, no surprise charges, ever.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Get started">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Ready to Get Started?</span>
            <h2 class="cta-section__title">Book Your Service.<br>We'll Handle the Rest.</h2>
            <p class="cta-section__text">Schedule your service and ask about our financing options. Our team will help you find the perfect plan.</p>
            <div class="cta-section__actions">
                <a href="#request-service" class="btn btn--primary btn--lg">Request Service</a>
                <a href="tel:+18134275862" class="btn btn--outline btn--lg">Call 813-42-PLUMB</a>
            </div>
        </div>
    </section>

</main>

<!-- Cherry Widget Script -->
<script>
(function (w, d, s, o, f, js, fjs) {
    w[o] =
        w[o] ||
        function () {
            (w[o].q = w[o].q || []).push(arguments);
        };
    (js = d.createElement(s)), (fjs = d.getElementsByTagName(s)[0]);
    js.id = o;
    js.src = f;
    js.async = 1;
    fjs.parentNode.insertBefore(js, fjs);
})(window, document, "script", "_hw", "https://files.withcherry.com/widgets/widget.js");
_hw(
    "init",
    {
        debug: false,
        variables: {
            slug: "hot-water-heroes",
            name: "Hot Water Heroes Plumbing",
        },
        styles: {
            primaryColor: "#F22F3A",
            secondaryColor: "#F0EBE3",
            fontFamily: "DM Sans",
        },
    },
    ["all", "hero", "howitworks", "calculator", "testimony", "faq"]
);
</script>

<?php get_footer(); ?>
