<?php
/**
 * Hot Water Heroes Plumbing — Blog/Archive Template
 * Performance-optimized: lazy loading, semantic HTML, category filters
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Blog Hero -->
    <section class="page-hero page-hero--blog" aria-label="Blog">
        <div class="page-hero__inner">
            <span class="section__label">HWH Blog</span>
            <h1 class="page-hero__title">Plumbing Tips &amp;<br><em>Expert Insights</em></h1>
            <p class="page-hero__desc">Helpful guides, maintenance tips, and the latest plumbing advice from the Hot Water Heroes team.</p>
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
                $blog_cats = get_categories([
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'hide_empty' => true,
                    'number'     => 6,
                    'exclude'    => [1], // Exclude 'Uncategorized'
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

                <?php
                // Featured: first post gets hero treatment
                $post_count = 0;
                ?>
                <div class="blog-grid blog-grid--featured">
                    <?php while (have_posts()) : the_post(); $post_count++; ?>
                        <a href="<?php the_permalink(); ?>"
                           class="blog-card <?php echo $post_count === 1 ? 'blog-card--hero' : ''; ?> reveal"
                           aria-label="Read: <?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog-card__img">
                                    <?php the_post_thumbnail('medium_large', [
                                        'loading'  => $post_count === 1 ? 'eager' : 'lazy',
                                        'decoding' => 'async',
                                        'sizes'    => $post_count === 1
                                            ? '(max-width: 575px) 100vw, 66vw'
                                            : '(max-width: 575px) 100vw, (max-width: 1023px) 50vw, 33vw',
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
                                <p class="blog-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), $post_count === 1 ? 30 : 18); ?></p>
                                <span class="blog-card__read">Read Article →</span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <nav class="blog-pagination" aria-label="Blog pagination">
                    <?php
                    echo paginate_links([
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                        'type'      => 'list',
                    ]);
                    ?>
                </nav>
            <?php else : ?>
                <div class="blog-empty reveal">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    <h2 class="blog-empty__title">Coming Soon</h2>
                    <p class="blog-empty__text">Our blog is launching soon with plumbing tips, maintenance guides, and expert advice from the Hot Water Heroes team.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">Back to Home</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Blog CTA -->
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
