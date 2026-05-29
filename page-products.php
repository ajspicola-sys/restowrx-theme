<?php
/**
 * Template Name: Products
 * Restowrx Elite — Products Page (Dynamic)
 * Pulls products from the product custom post type
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Our products">
        <div class="page-hero__inner">
            <span class="section__label">Curated Collection</span>
            <h1 class="page-hero__title">Our Products</h1>
            <p class="page-hero__desc">Professional-grade property recovery products and equipment we trust and deploy.</p>
        </div>
    </section>

    <section class="products-showcase">
        <div class="section__inner">
            <div class="products-grid">

                <?php
                $products = new WP_Query([
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                ]);

                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        $url      = get_post_meta(get_the_ID(), '_product_url', true);
                        $video    = get_post_meta(get_the_ID(), '_product_video_bg', true);
                        $price    = get_post_meta(get_the_ID(), '_product_price', true);
                        $btn_text = get_post_meta(get_the_ID(), '_product_btn_text', true) ?: 'Shop Now';
                        $has_video = !empty($video);
                ?>
                    <article class="product-card reveal<?php echo $has_video ? ' product-card--has-video' : ''; ?>">
                        <?php if ($has_video) : ?>
                            <div class="product-card__video-wrap" aria-hidden="true">
                                <video class="product-card__video" autoplay muted loop playsinline preload="metadata">
                                    <source src="<?php echo esc_url($video); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php endif; ?>

                        <div class="product-card__inner">
                            <div class="product-card__image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                    ]); ?>
                                <?php else : ?>
                                    <div class="product-card__placeholder" aria-hidden="true">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="product-card__content">
                                <h2 class="product-card__name"><?php the_title(); ?></h2>

                                <?php if ($price) : ?>
                                    <span class="product-card__price"><?php echo esc_html($price); ?></span>
                                <?php endif; ?>

                                <?php if (get_the_content()) : ?>
                                    <div class="product-card__desc">
                                        <?php the_content(); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($url) : ?>
                                    <a href="<?php echo esc_url($url); ?>" class="btn btn--primary product-card__btn" target="_blank" rel="noopener noreferrer">
                                        <?php echo esc_html($btn_text); ?>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>

                <?php endwhile; wp_reset_postdata();
                else : ?>
                    <div class="empty-state empty-state--grid-full">
                        <p class="empty-state__text">Products coming soon! Add them in <strong>WordPress Admin → Products</strong>.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Service CTA -->
    <section class="cta-section" aria-label="Book with us">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Expert Telemetry & Guidance</span>
            <h2 class="cta-section__title">Need Help<br>Choosing?</h2>
            <p class="cta-section__text">Our specialists can recommend the right drying, extraction, or containment solutions for your property recovery needs. Call us anytime.</p>
            <div class="cta-section__actions">
                <a href="/contact/" class="btn btn--primary btn--lg">Request Service</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
