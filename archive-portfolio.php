<?php
/**
 * Spicola Construction — Projects Archive
 * Dynamically queries the portfolio post type and displays them in a premium grid.
 */
get_header();
?>

<style>
/* Projects Archive Specific Styling */
.sc-projects-archive {
    padding: clamp(4rem, 6vw, 7rem) 0;
    background: #F8F8F6; /* Clean background to make project cards pop */
    position: relative;
}

.sc-projects-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
}

/* Grid Layout */
.sc-projects-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-top: 1rem;
}

.sc-projects-card {
    text-decoration: none;
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 1px solid rgba(34, 45, 63, 0.08);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    transition: transform .5s cubic-bezier(.22, 1, .36, 1), box-shadow .5s ease, border-color .3s;
    display: flex;
    flex-direction: column;
}

.sc-projects-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    border-color: rgba(193, 51, 51, 0.2);
}

.sc-projects-card-img {
    position: relative;
    aspect-ratio: 16 / 10;
    overflow: hidden;
    background: #222D3F;
}

.sc-projects-card-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .6s cubic-bezier(.22, 1, .36, 1);
}

.sc-projects-card:hover .sc-projects-card-img img {
    transform: scale(1.08);
}

.sc-projects-card-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #1a2d45 0%, #0A1628 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.sc-projects-card-placeholder svg {
    width: 48px;
    height: 48px;
    stroke: rgba(255, 255, 255, 0.15);
}

/* Card Hover Accent Overlay */
.sc-projects-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(10, 22, 40, 0) 30%, rgba(193, 51, 51, 0.9) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 1.5rem;
    opacity: 0;
    transition: opacity .35s ease;
}

.sc-projects-card:hover .sc-projects-card-overlay {
    opacity: 1;
}

.sc-projects-card-cta {
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: .6rem 1.5rem;
    border: 2px solid rgba(255, 255, 255, 0.4);
    border-radius: 8px;
    background: rgba(10, 22, 40, 0.2);
    backdrop-filter: blur(4px);
    transition: all .3s;
}

.sc-projects-card:hover .sc-projects-card-cta {
    background: #C13333;
    border-color: #C13333;
    box-shadow: 0 4px 15px rgba(193, 51, 51, 0.4);
    transform: translateY(-2px);
}

.sc-projects-card-body {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sc-projects-card-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--brand-navy, #222D3F);
    margin: 0 0 .5rem;
    line-height: 1.3;
    transition: color .3s;
}

.sc-projects-card:hover .sc-projects-card-title {
    color: var(--brand, #C13333);
}

.sc-projects-card-desc {
    font-size: .88rem;
    color: rgba(34, 45, 63, 0.65);
    line-height: 1.6;
    margin: 0 0 1rem;
}

.sc-projects-card-link {
    font-family: 'Montserrat', sans-serif;
    font-size: .8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
    color: var(--brand-navy, #222D3F);
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    transition: color .3s, transform .3s;
    margin-top: auto;
}

.sc-projects-card-link svg {
    transition: transform .3s;
}

.sc-projects-card:hover .sc-projects-card-link {
    color: var(--brand, #C13333);
}

.sc-projects-card:hover .sc-projects-card-link svg {
    transform: translateX(4px);
}

/* Responsive Rules */
@media(max-width: 992px) {
    .sc-projects-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
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
    <section class="hwh-hero hwh-hero--inner" aria-label="Our construction projects">
        <div class="hwh-hero__overlay" aria-hidden="true"></div>
        <div class="hwh-hero__grid" aria-hidden="true"></div>
        <div class="hwh-section-inner" style="position:relative;z-index:2;text-align:center;padding-top:2rem;padding-bottom:2rem;">
            <span class="hwh-label hwh-label--white">Our Work</span>
            <h1 class="hwh-section-title hwh-section-title--white" style="margin-bottom:1rem;">
                Completed Construction Projects<br><em>Crafted with Excellence</em>
            </h1>
            <p class="hwh-section-desc hwh-section-desc--muted">
                Explore our gallery of residential and commercial work across Tampa Bay. From custom builds to renovations, we let our work speak for itself.
            </p>
            <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;margin-top:2rem;">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-btn hwh-btn--red hwh-btn--lg">Start Your Project</a>
                <a href="tel:+18137326285" class="hwh-btn hwh-btn--ghost hwh-btn--lg">Call (813) 732-6285</a>
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
                            $desc = 'Explore the full image gallery and before & after highlights for this project.';
                        }
                    ?>
                        <article class="sc-projects-card reveal">
                            <a href="<?php the_permalink(); ?>" class="sc-projects-card-img" aria-label="<?php the_title_attribute(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                        'alt'      => esc_attr(get_the_title()),
                                    ]); ?>
                                <?php else: ?>
                                    <div class="sc-projects-card-placeholder">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="sc-projects-card-overlay">
                                    <span class="sc-projects-card-cta">View Gallery →</span>
                                </div>
                            </a>

                            <div class="sc-projects-card-body">
                                <div>
                                    <h2 class="sc-projects-card-title"><?php the_title(); ?></h2>
                                    <p class="sc-projects-card-desc"><?php echo esc_html($desc); ?></p>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="sc-projects-card-link" aria-label="View project details: <?php the_title_attribute(); ?>">
                                    View Gallery 
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M5 12h14M12 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

            <?php else: ?>
                <p style="text-align:center;padding:5rem 0;font-size:1.15rem;color:rgba(34, 45, 63, 0.6);">
                    No projects found. <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color:var(--brand,#C13333);font-weight:700;">Contact us</a> to start yours!
                </p>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Bottom CTA ── -->
    <section class="hwh-cta" aria-label="Start your project call to action">
        <div class="hwh-cta__inner">
            <div>
                <h2 class="hwh-cta__title">Ready to Build<br>
                    <span style="opacity:.85;font-size:.85em;">Your Dream Space?</span>
                </h2>
                <p class="hwh-cta__text">
                    From new builds to custom renovations, our team is ready to bring your vision to life. Get a free, upfront estimate with transparent pricing.
                </p>
            </div>
            <div class="hwh-cta__actions">
                <a href="tel:+18137326285" class="hwh-btn hwh-btn--white hwh-btn--lg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z" />
                    </svg>
                    Call (813) 732-6285
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="hwh-btn hwh-btn--ghost-white hwh-btn--lg">
                    Get a Free Quote
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
