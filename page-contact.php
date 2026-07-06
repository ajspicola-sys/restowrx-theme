<?php
/**
 * Template Name: Contact
 * Restowrx Elite — Contact Page
 * Performance-optimized with form validation
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Page Hero -->
    <section class="page-hero" aria-label="Contact us">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span>Contact</span>
            </div>
            <h1 class="page-hero__title">Contact Us</h1>
            <p class="page-hero__desc">We'd love to hear from you. Reach out to schedule a service or ask any questions.</p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-section" aria-label="Contact form and information">
        <div class="section__inner">
            <div class="contact-grid">

                <!-- Contact Form -->
                <div class="contact-form-wrap reveal">
                    <h2 class="contact-form__title">Send a Message</h2>
                    <p class="contact-form__subtitle">Fill out the form below and we'll get back to you within 24 hours.</p>
                    <form class="contact-form" id="contact-form" method="post" novalidate>
                        <?php wp_nonce_field('hwh_contact_form', 'hwh_contact_nonce'); ?>
                        <div class="contact-form__row">
                            <div class="form-group">
                                <label for="cf-first" class="form-label">First Name</label>
                                <input type="text" id="cf-first" name="first_name" class="form-input" placeholder="Jane" required autocomplete="given-name">
                            </div>
                            <div class="form-group">
                                <label for="cf-last" class="form-label">Last Name</label>
                                <input type="text" id="cf-last" name="last_name" class="form-input" placeholder="Doe" required autocomplete="family-name">
                            </div>
                        </div>
                        <div class="contact-form__row">
                            <div class="form-group">
                                <label for="cf-email" class="form-label">Email</label>
                                <input type="email" id="cf-email" name="email" class="form-input" placeholder="jane@example.com" required autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="cf-phone" class="form-label">Phone</label>
                                <input type="tel" id="cf-phone" name="phone" class="form-input" placeholder="(813) 000-0000" autocomplete="tel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cf-service" class="form-label">Service of Interest</label>
                            <select id="cf-service" name="service" class="form-input form-select">
                                <option value="">Select a service...</option>
                                <?php
                                $svc_query = new WP_Query([
                                    'post_type'      => 'service',
                                    'posts_per_page' => -1,
                                    'orderby'        => 'title',
                                    'order'          => 'ASC',
                                    'no_found_rows'  => true,
                                ]);
                                if ($svc_query->have_posts()) :
                                    while ($svc_query->have_posts()) : $svc_query->the_post(); ?>
                                        <option value="<?php echo esc_attr(sanitize_title(get_the_title())); ?>"><?php the_title(); ?></option>
                                    <?php endwhile; wp_reset_postdata();
                                endif; ?>
                                <option value="other">Other / General Inquiry</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cf-message" class="form-label">Message</label>
                            <textarea id="cf-message" name="message" class="form-input form-textarea" rows="5" placeholder="Tell us about your property damage mitigation or restoration needs..."></textarea>
                        </div>
                        <input type="hidden" name="action" value="hwh_contact_submit">
                        <!-- Honeypot: hidden from humans, bots fill it and get silently dropped -->
                        <div style="position:absolute; left:-9999px;" aria-hidden="true">
                            <label>Website<input type="text" name="hwh_website" tabindex="-1" autocomplete="off"></label>
                        </div>
                        <button type="submit" class="btn btn--primary btn--lg contact-form__submit">
                            Send Message
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </form>

                    <!-- Form success state -->
                    <div class="contact-form__success" id="form-success">
                        <div class="contact-form__success-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <h3 class="contact-form__success-title">Message Sent!</h3>
                        <p class="contact-form__success-text">Thank you for reaching out. Our team will get back to you within 24 hours.</p>
                    </div>
                </div>

                <!-- Contact Info Sidebar -->
                <aside class="contact-sidebar reveal" aria-label="Contact information">
                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <h3 class="contact-card__title">Phone</h3>
                        <a href="tel:+18136994009" class="contact-card__text">813.699.4009</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <h3 class="contact-card__title">Email</h3>
                        <a href="mailto:joe@restowrx.com" class="contact-card__text">joe@restowrx.com</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <h3 class="contact-card__title">Location</h3>
                        <p class="contact-card__text">9249 Lazy Ln<br>Tampa, FL 33614</p>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card__icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <h3 class="contact-card__title">Hours</h3>
                        <div class="contact-card__hours"><div class="contact-card__hour-row"><span>Every Day</span><span>Open 24 Hours</span></div><div class="contact-card__hour-row"><span>Emergency Line</span><span>813.699.4009</span></div></div>
                    </div>

                    <!-- Social Links -->
                    <div class="contact-social">
                        <span class="contact-social__label">Follow Us</span>
                        <div class="contact-social__links">
                            <a href="https://www.instagram.com/restowrx/" class="footer__social-link" aria-label="Follow us on Instagram" target="_blank" rel="noopener noreferrer">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
                            </a>
                            <a href="https://www.facebook.com/restowrx/" class="footer__social-link" aria-label="Follow us on Facebook" target="_blank" rel="noopener noreferrer">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="contact-map" aria-label="Our location">
        <div class="contact-map__wrap reveal">
            <iframe
                src="https://www.google.com/maps?q=9249+Lazy+Ln,+Tampa,+FL+33614&output=embed"
                width="100%"
                height="400"
                style="border:0;border-radius:16px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Restowrx Elite - 9249 Lazy Ln, Tampa, FL 33614">
            </iframe>
        </div>
    </section>




</main>

<script>
(function() {
    // AJAX submit for the main contact form. Without this the form posted
    // back to the page URL and every submission was silently lost.
    function init() {
        var form = document.getElementById('contact-form');
        if (!form || form.dataset.ajaxBound) return;
        form.dataset.ajaxBound = 'true';

        var successBox = document.getElementById('form-success');
        var submitBtn  = form.querySelector('.contact-form__submit');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Native validation (form has novalidate, so trigger it manually)
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            var originalHtml = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending...';
            }

            fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.success) {
                    form.style.display = 'none';
                    if (successBox) successBox.classList.add('is-visible');
                } else {
                    alert((data.data && data.data.message) || 'Something went wrong. Please call us at 813.699.4009.');
                }
            })
            .catch(function() {
                alert('Connection error. Please try again or call 813.699.4009.');
            })
            .finally(function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                }
            });
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>

<?php get_footer(); ?>
