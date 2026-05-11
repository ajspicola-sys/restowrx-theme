<?php
/**
 * Hot Water Heroes Plumbing — Blog/Archive Template
 * Premium design: featured hero post, masonry grid, animated cards, newsletter CTA
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Blog Hero -->
    <section class="blog-hero" aria-label="Blog">
        <div class="blog-hero__bg" aria-hidden="true">
            <div class="blog-hero__orb blog-hero__orb--1"></div>
            <div class="blog-hero__orb blog-hero__orb--2"></div>
        </div>
        <div class="blog-hero__inner">
            <span class="section__label">HWH Blog</span>
            <h1 class="blog-hero__title">Plumbing Tips &amp;<br><em>Expert Insights</em></h1>
            <p class="blog-hero__desc">Helpful guides, maintenance tips, and the latest plumbing advice from the Hot Water Heroes team.</p>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="blog-filters" aria-label="Filter by category">
        <div class="section__inner">
            <div class="blog-filters__bar">
                <?php
                $current_cat = get_query_var('cat');
                $blog_url = get_permalink(get_option('page_for_posts'));
                if (!$blog_url) $blog_url = home_url('/blog/');
                ?>
                <a href="<?php echo esc_url($blog_url); ?>"
                   class="blog-filter-btn <?php echo !$current_cat ? 'is-active' : ''; ?>">All Posts</a>
                <?php
                // Only show plumbing service categories that have published posts
                $service_slugs = [
                    'water-heaters',
                    'drain-cleaning',
                    'emergency-plumbing',
                    'leak-detection',
                    'repiping',
                    'plumbing-tips',
                    'maintenance',
                    'tankless-water-heaters',
                ];
                $blog_cats = get_categories([
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => true,
                    'slug'       => $service_slugs,
                ]);
                foreach ($blog_cats as $cat) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                       class="blog-filter-btn <?php echo ($current_cat == $cat->term_id) ? 'is-active' : ''; ?>">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="blog-archive" aria-label="Blog posts">
        <div class="section__inner">
            <?php if (have_posts()) : ?>

                <?php $showed_featured = false; ?>

                <!-- Featured Post (First) -->
                <?php if (!$current_cat && !is_paged() && have_posts()) : the_post(); $showed_featured = true; ?>
                        <article class="blog-featured reveal" itemscope itemtype="https://schema.org/BlogPosting">
                            <a href="<?php the_permalink(); ?>" class="blog-featured__link" aria-label="Read: <?php the_title_attribute(); ?>">
                                <div class="blog-featured__img">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', [
                                            'loading'  => 'eager',
                                            'decoding' => 'async',
                                            'fetchpriority' => 'high',
                                            'sizes'    => '(max-width: 600px) 100vw, 55vw',
                                            'itemprop' => 'image',
                                        ]); ?>
                                    <?php else : ?>
                                        <div class="blog-featured__placeholder" aria-hidden="true">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="blog-featured__badge">Featured</div>
                                </div>
                                <div class="blog-featured__body">
                                    <div class="blog-card__meta">
                                        <?php if (has_category()) : ?>
                                            <span class="blog-card__cat"><?php $cat = get_the_category(); echo esc_html($cat[0]->name); ?></span>
                                        <?php endif; ?>
                                        <time class="blog-card__date" datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date('M j, Y'); ?></time>
                                        <span class="blog-card__read-time"><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 250); ?> min read</span>
                                    </div>
                                    <h2 class="blog-featured__title" itemprop="headline"><?php the_title(); ?></h2>
                                    <p class="blog-featured__excerpt" itemprop="description"><?php echo wp_trim_words(get_the_excerpt(), 35); ?></p>
                                    <div class="blog-featured__footer">
                                        <div class="blog-featured__author">
                                            <?php echo get_avatar(get_the_author_meta('ID'), 36, '', get_the_author(), ['loading' => 'lazy']); ?>
                                            <span><?php the_author(); ?></span>
                                        </div>
                                        <span class="blog-card__read">Read Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>

                <!-- Post Grid -->
                <div class="blog-grid">
                    <?php
                    // Always rewind so grid starts from post 1
                    rewind_posts();
                    $grid_count = 0;
                    while (have_posts()) : the_post();
                        $grid_count++;
                        // Skip post 1 if it was already shown as the featured card
                        if ($showed_featured && $grid_count <= 1) continue;
                    ?>
                        <article class="blog-card reveal" itemscope itemtype="https://schema.org/BlogPosting">
                            <a href="<?php the_permalink(); ?>" class="blog-card__link" aria-label="Read: <?php the_title_attribute(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="blog-card__img">
                                        <?php the_post_thumbnail('medium_large', [
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                            'sizes'    => '(max-width: 575px) 100vw, (max-width: 1023px) 50vw, 33vw',
                                        ]); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-card__body">
                                    <div class="blog-card__meta">
                                        <?php if (has_category()) : ?>
                                            <span class="blog-card__cat"><?php $cat = get_the_category(); echo esc_html($cat[0]->name); ?></span>
                                        <?php endif; ?>
                                        <time class="blog-card__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                                        <span class="blog-card__read-time"><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 250); ?> min read</span>
                                    </div>
                                    <h2 class="blog-card__title"><?php the_title(); ?></h2>
                                    <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                    <span class="blog-card__read">Read Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="blog-pagination" aria-label="Blog pagination">
                    <?php
                    echo paginate_links([
                        'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Previous',
                        'next_text' => 'Next <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>',
                        'type'      => 'list',
                    ]);
                    ?>
                </nav>
            <?php else : ?>
                <div class="blog-empty reveal">
                    <div class="blog-empty__icon-wrap">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <h2 class="blog-empty__title">Coming Soon</h2>
                    <p class="blog-empty__text">Our blog is launching soon with plumbing tips, maintenance guides, and expert advice from the Hot Water Heroes team.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="blog-newsletter" aria-label="Newsletter signup">
        <div class="blog-newsletter__inner reveal">
            <div class="blog-newsletter__content">
                <span class="section__label">Stay Updated</span>
                <h2 class="blog-newsletter__title">Get Plumbing Tips<br><em>In Your Inbox</em></h2>
                <p class="blog-newsletter__desc">Seasonal maintenance reminders, money-saving tips, and exclusive discounts — delivered monthly.</p>
            </div>
            <div class="blog-newsletter__visual" aria-hidden="true">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5" opacity="0.15"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
        </div>
    </section>

    <!-- Service CTA -->
    <section class="cta-section" aria-label="Request service">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Have a Plumbing Issue?</span>
            <h2 class="cta-section__title">Need Help?<br>We're On Our Way.</h2>
            <p class="cta-section__text">Call us or book online — fast, reliable plumbing service across Tampa Bay.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Request Service</a>
                <a href="tel:+18134275862" class="btn btn--outline btn--lg">Call 813-42-PLUMB</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
