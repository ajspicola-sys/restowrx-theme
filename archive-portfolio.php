<?php
/**
 * Restowrx Elite — Case Files & Deployments Archive
 * Dynamically queries the portfolio post type and displays them in a premium dark tactical grid.
 */
get_header();
?>

<style>
/* Case Files Archive Specific Styling - Tactical Dark Mode */
.sc-projects-archive {
    padding: clamp(4rem, 6vw, 7rem) 0;
    background: #050505; /* Deep tactical black background */
    position: relative;
    border-top: 1px solid rgba(255, 0, 0, 0.15);
}

.sc-projects-archive::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: 
        linear-gradient(to right, rgba(255,255,255,0.01) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,0.01) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
}

.sc-projects-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
    position: relative;
    z-index: 10;
}

/* Grid Layout */
.sc-projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2.5rem;
    margin-top: 1rem;
}

.sc-projects-card {
    text-decoration: none;
    border-radius: 4px;
    overflow: hidden;
    background: #0a0a0a;
    border: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    transition: transform .5s cubic-bezier(.22, 1, .36, 1), box-shadow .5s ease, border-color .3s;
    display: flex;
    flex-direction: column;
    transform-style: preserve-3d;
    perspective: 1000px;
    box-sizing: border-box;
}

.sc-projects-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.8);
    border-color: var(--brand, #ff0000);
}

.sc-projects-card-img {
    position: relative;
    aspect-ratio: 16 / 10;
    overflow: hidden;
    background: #000;
    transform-style: preserve-3d;
}

.sc-projects-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s cubic-bezier(.22, 1, .36, 1);
    filter: grayscale(0.2) brightness(0.9);
}

.sc-projects-card:hover .sc-projects-card-img img {
    transform: scale(1.08);
    filter: grayscale(0) brightness(1);
}

.sc-projects-card-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #120303 0%, #000000 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sc-projects-card-placeholder svg {
    width: 48px;
    height: 48px;
    stroke: rgba(255, 0, 0, 0.3);
}

/* Card Hover Accent Overlay - Restowrx Tactical Red */
.sc-projects-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 30%, rgba(255, 0, 0, 0.85) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 1.5rem;
    opacity: 0;
    visibility: hidden;
    transition: opacity .35s ease, visibility .35s ease;
    transform-style: preserve-3d;
}

.sc-projects-card:hover .sc-projects-card-overlay {
    opacity: 1;
    visibility: visible;
}

.sc-projects-card-cta {
    color: #fff;
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: 1.25rem;
    font-weight: 400;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: .5rem 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.4);
    border-radius: 4px;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(4px);
    transition: all .3s, transform .5s cubic-bezier(.22, 1, .36, 1);
    transform: translateZ(45px);
}

.sc-projects-card:hover .sc-projects-card-cta {
    background: var(--brand, #ff0000);
    border-color: var(--brand, #ff0000);
    box-shadow: 0 4px 15px rgba(255, 0, 0, 0.4);
    transform: translateY(-2px) translateZ(45px);
}

.sc-projects-card-body {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transform-style: preserve-3d;
    background: #0a0a0a;
}

.sc-projects-card-title {
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: 1.8rem;
    font-weight: 400;
    letter-spacing: 1px;
    color: #ffffff;
    margin: 0 0 .5rem;
    line-height: 1.2;
    transition: color .3s, transform .5s cubic-bezier(.22, 1, .36, 1);
    transform: translateZ(30px);
    text-transform: uppercase;
}

.sc-projects-card:hover .sc-projects-card-title {
    color: var(--brand, #ff0000);
}

.sc-projects-card-desc {
    font-size: .88rem;
    color: #888888;
    line-height: 1.6;
    margin: 0 0 1.25rem;
    transition: transform .5s cubic-bezier(.22, 1, .36, 1);
    transform: translateZ(20px);
}

.sc-projects-card-link {
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: 1.2rem;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #ffffff;
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    transition: color .3s, transform .5s cubic-bezier(.22, 1, .36, 1);
    margin-top: auto;
    transform: translateZ(35px);
}

.sc-projects-card-link svg {
    transition: transform .3s;
    width: 14px;
    height: 14px;
}

.sc-projects-card:hover .sc-projects-card-link {
    color: var(--brand, #ff0000);
}

.sc-projects-card:hover .sc-projects-card-link svg {
    transform: translateX(4px);
}

/* Page Hero Overrides for Restowrx Aesthetic */
.hwh-hero--inner {
    position: relative;
    padding: clamp(140px, 12vw, 200px) 0 clamp(60px, 6vw, 100px) 0;
    background-color: #000000;
    overflow: hidden;
    border-bottom: 1px solid rgba(255, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.hwh-hero__overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, rgba(18, 3, 3, 0.4) 0%, #050505 100%);
    z-index: 2;
}

.hwh-hero__grid {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(to right, rgba(255,0,0,0.02) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,0,0,0.02) 1px, transparent 1px);
    background-size: 50px 50px;
    z-index: 1;
}

.hwh-label {
    font-family: var(--font-mono, 'Space Mono', monospace);
    color: var(--brand, #ff0000);
    font-size: 0.75rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    display: block;
    margin-bottom: 15px;
    font-weight: 700;
}

.hwh-section-title--white {
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: clamp(3rem, 6vw, 5.5rem);
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    line-height: 0.95;
    margin: 0 0 20px 0;
}

.hwh-section-title--white em {
    color: transparent;
    -webkit-text-stroke: 1px rgba(255, 255, 255, 0.7);
    font-style: normal;
}

.hwh-section-desc--muted {
    color: #aaa;
    font-size: clamp(0.95rem, 1.2vw, 1.15rem);
    line-height: 1.7;
    margin: 0 auto;
    max-width: 700px;
}

/* Premium Tactical Buttons */
.hwh-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.6rem 1.8rem;
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: 1.3rem;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.hwh-btn--red {
    background: linear-gradient(135deg, var(--brand, #ff0000) 0%, #990000 100%);
    color: white !important;
    border: 1px solid rgba(255,0,0,0.3);
    box-shadow: 0 4px 15px rgba(255, 0, 0, 0.2);
}

.hwh-btn--red:hover {
    background: #111111 !important;
    border-color: #111111;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}

.hwh-btn--ghost {
    background: transparent;
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hwh-btn--ghost:hover {
    border-color: var(--brand, #ff0000);
    color: var(--brand, #ff0000) !important;
    background: rgba(255, 0, 0, 0.05);
    transform: translateY(-2px);
}

/* Bottom CTA block */
.hwh-cta {
    background: radial-gradient(circle at 50% 50%, #200202 0%, #000000 100%);
    padding: clamp(60px, 8vw, 100px) 0;
    border-top: 1px solid rgba(255, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
}

.hwh-cta__inner {
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

.hwh-cta__title {
    font-family: var(--font-accent, 'Bebas Neue', sans-serif);
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    line-height: 0.95;
    margin: 0 0 15px 0;
}

.hwh-cta__text {
    color: #888;
    max-width: 600px;
    line-height: 1.6;
    margin: 0;
}

.hwh-cta__actions {
    display: flex;
    gap: 15px;
    flex-shrink: 0;
    flex-wrap: wrap;
}

.hwh-btn--white {
    background: #ffffff;
    color: #000000 !important;
    font-weight: 500;
}

.hwh-btn--white:hover {
    background: var(--brand, #ff0000);
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255,0,0,0.3);
}

.hwh-btn--ghost-white {
    background: transparent;
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.hwh-btn--ghost-white:hover {
    border-color: var(--brand, #ff0000);
    color: var(--brand, #ff0000) !important;
    background: rgba(255, 0, 0, 0.05);
    transform: translateY(-2px);
}

/* Responsive Rules */
@media(max-width: 992px) {
    .sc-projects-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    .hwh-cta__inner {
        flex-direction: column;
        text-align: center;
    }
}

@media(max-width: 600px) {
    .sc-projects-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    .sc-projects-archive {
        padding: 3rem 0;
    }
}
</style>

<main class="site-main" id="main-content">

    <!-- ── Page Hero ── -->
    <section class="hwh-hero hwh-hero--inner" aria-label="Our recovery deployments">
        <div class="hwh-hero__overlay" aria-hidden="true"></div>
        <div class="hwh-hero__grid" aria-hidden="true"></div>
        <div class="hwh-section-inner" style="position:relative;z-index:2;text-align:center;padding-top:2rem;padding-bottom:2rem;">
            <span class="hwh-label">Completed Projects</span>
            <h1 class="hwh-section-title--white" style="margin-bottom:1rem;">
                Property Recovery Projects<br><em>Completed Restoration Profiles</em>
            </h1>
            <p class="hwh-section-desc--muted">
                Explore our completed damage mitigation profiles across Tampa Bay. High-grade restoration standards. Zero compromise.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:2.5rem;">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-btn hwh-btn--red">Request Service</a>
                <a href="tel:+18136994009" class="hwh-btn hwh-btn--ghost">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" style="margin-right:5px; vertical-align:-3px;">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Call 813.699.4009
                </a>
            </div>
        </div>
    </section>

    <!-- ── Projects Grid ── -->
    <section class="sc-projects-archive" aria-label="Projects showcase">
        <div class="sc-projects-inner">

            <?php
            // Custom WP_Query to display all published portfolio projects
            $projects_query = new WP_Query([
                'post_type'      => 'portfolio',
                'post_status'    => 'publish',
                'posts_per_page' => -1, // Pull all projects dynamically
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            ]);

            if ($projects_query->have_posts()): ?>

                <div class="sc-projects-grid">
                    <?php while ($projects_query->have_posts()): $projects_query->the_post();
                        $excerpt = get_post_field('post_excerpt', get_the_ID());
                        $content = get_post_field('post_content', get_the_ID());
                        
                        if ($excerpt) {
                            $desc = wp_trim_words($excerpt, 15);
                        } elseif ($content) {
                            $desc = wp_trim_words(strip_shortcodes(wp_strip_all_tags($content)), 15);
                        } else {
                            $desc = 'Explore the full image gallery and damage mitigation highlights for this restoration project.';
                        }
                    ?>
                        <a href="<?php the_permalink(); ?>" class="sc-projects-card reveal">
                            <div class="sc-projects-card-img">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                        'alt'      => esc_attr(get_the_title()),
                                    ]); ?>
                                <?php else: ?>
                                    <div class="sc-projects-card-placeholder">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="sc-projects-card-overlay" aria-hidden="true">
                                    <span class="sc-projects-card-cta">View Project →</span>
                                </div>
                            </div>

                            <div class="sc-projects-card-body">
                                <div>
                                    <h2 class="sc-projects-card-title"><?php the_title(); ?></h2>
                                    <p class="sc-projects-card-desc"><?php echo esc_html($desc); ?></p>
                                </div>
                                <span class="sc-projects-card-link">
                                    View Project 
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

            <?php else: ?>
                <p style="text-align:center;padding:5rem 0;font-size:1.15rem;color:#888888;font-family:var(--font-mono, 'Space Mono', monospace);">
                    NO ARCHIVES FOUND. <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color:var(--brand,#ff0000);font-weight:700;">CONTACT DISPATCH</a> TO REQUEST SERVICE!
                </p>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Bottom CTA ── -->
    <section class="hwh-cta" aria-label="Mitigation request call to action">
        <div class="hwh-cta__inner">
            <div>
                <h2 class="hwh-cta__title">Catastrophic Loss?<br>
                    <span style="opacity:.85;font-size:.85em;color:var(--brand, #ff0000);">Request Emergency Response</span>
                </h2>
                <p class="hwh-cta__text">
                    Do not let structural damage dictate the terms. Our team stands ready to coordinate insurance claims and deploy local recovery assets immediately.
                </p>
            </div>
            <div class="hwh-cta__actions">
                <a href="tel:+18136994009" class="hwh-btn hwh-btn--white">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" style="margin-right:5px; vertical-align:-3px;">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Dispatch: 813.699.4009
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-btn hwh-btn--ghost-white">
                    Get Free Scan
                </a>
            </div>
        </div>
    </section>

</main>

<script>
(function() {
    // 3D Mouse Tilt Interactive Parallax Effect for Case File Cards
    var cards = document.querySelectorAll('.sc-projects-card');
    
    // Check if the user is on a device supporting hover interactions
    if (window.matchMedia('(hover: hover)').matches) {
        cards.forEach(function(card) {
            card.addEventListener('mousemove', function(e) {
                var rect = card.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var y = e.clientY - rect.top;
                
                var centerX = rect.width / 2;
                var centerY = rect.height / 2;
                
                // Tilt rotation of maximum 8 degrees
                var rotateX = -(y - centerY) / centerY * 8;
                var rotateY = (x - centerX) / centerX * 8;
                
                card.style.transition = 'transform 0.08s ease, box-shadow 0.3s ease, border-color 0.3s ease';
                card.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px) scale3d(1.02, 1.02, 1.02)';
                card.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.7)';
                card.style.borderColor = 'rgba(255, 0, 0, 0.35)';
            });
            
            card.addEventListener('mouseleave', function() {
                card.style.transition = 'transform 0.5s cubic-bezier(.25, 1, 0.5, 1), box-shadow 0.5s ease, border-color 0.3s ease';
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0) scale3d(1, 1, 1)';
                card.style.boxShadow = '';
                card.style.borderColor = '';
            });
        });
    }
})();
</script>

<?php get_footer(); ?>
