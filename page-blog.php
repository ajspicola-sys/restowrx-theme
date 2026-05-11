<?php
/**
 * Hot Water Heroes — Blog Page
 * WordPress auto-loads this template for any Page with the slug "blog".
 * No Settings > Reading configuration required.
 */

get_header();

$paged = get_query_var( 'page' ) ? absint( get_query_var( 'page' ) ) : 1;

$blog_query = new WP_Query( array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'ignore_sticky_posts' => true,
) );

?>

<main class="site-main" id="main-content">

    <!-- ── Blog Hero ── -->
    <section class="blog-hero" aria-label="Blog">
        <div class="blog-hero__bg" aria-hidden="true">
            <div class="blog-hero__orb blog-hero__orb--1"></div>
            <div class="blog-hero__orb blog-hero__orb--2"></div>
        </div>
        <div class="blog-hero__inner">
            <span class="section__label">HWH Blog</span>
            <h1 class="blog-hero__title">Plumbing Tips &amp;<br><em>Expert Insights</em></h1>
            <p class="blog-hero__desc">Helpful guides, maintenance tips, and expert plumbing advice from the Hot Water Heroes team.</p>
        </div>
    </section>

    <!-- ── Category Filter Bar ── -->
    <section class="blog-filters" aria-label="Filter by category">
        <div class="section__inner">
            <div class="blog-filters__bar">

                <a href="<?php echo esc_url( get_permalink() ); ?>"
                   class="blog-filter-btn is-active">All Posts</a>

                <?php
                // Only show plumbing-related categories that have published posts.
                // Filter buttons link to the standard WordPress category archive.
                $service_slugs = array(
                    'water-heaters',
                    'drain-cleaning',
                    'emergency-plumbing',
                    'leak-detection',
                    'repiping',
                    'plumbing-tips',
                    'maintenance',
                    'tankless-water-heaters',
                );

                $filter_cats = get_categories( array(
                    'slug'       => $service_slugs,
                    'hide_empty' => true,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ) );

                foreach ( $filter_cats as $filter_cat ) :
                ?>
                    <a href="<?php echo esc_url( get_category_link( $filter_cat->term_id ) ); ?>"
                       class="blog-filter-btn">
                        <?php echo esc_html( $filter_cat->name ); ?>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- ── Posts ── -->
    <section class="blog-archive" aria-label="Blog posts">
        <div class="section__inner">

            <?php if ( $blog_query->have_posts() ) : ?>

                <?php
                // ── Featured card (first post, page 1 only) ──────────────────
                $showed_featured = false;
                if ( $paged === 1 ) :
                    $blog_query->the_post();
                    $showed_featured = true;
                ?>
                <article class="blog-featured reveal" itemscope itemtype="https://schema.org/BlogPosting">
                    <a href="<?php the_permalink(); ?>"
                       class="blog-featured__link"
                       aria-label="<?php echo esc_attr( 'Read: ' . get_the_title() ); ?>">

                        <div class="blog-featured__img">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', array(
                                    'loading'       => 'eager',
                                    'decoding'      => 'async',
                                    'fetchpriority' => 'high',
                                    'itemprop'      => 'image',
                                ) ); ?>
                            <?php else : ?>
                                <div class="blog-featured__placeholder" aria-hidden="true">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="blog-featured__badge">Featured</div>
                        </div>

                        <div class="blog-featured__body">
                            <div class="blog-card__meta">
                                <?php
                                $post_cats = get_the_category();
                                if ( $post_cats ) :
                                ?>
                                    <span class="blog-card__cat"><?php echo esc_html( $post_cats[0]->name ); ?></span>
                                <?php endif; ?>
                                <time class="blog-card__date"
                                      datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"
                                      itemprop="datePublished">
                                    <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                                </time>
                            </div>
                            <h2 class="blog-featured__title" itemprop="headline"><?php the_title(); ?></h2>
                            <p class="blog-featured__excerpt" itemprop="description">
                                <?php echo wp_trim_words( get_the_excerpt(), 30 ); ?>
                            </p>
                            <div class="blog-featured__footer">
                                <div class="blog-featured__author">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 36, '', get_the_author() ); ?>
                                    <span><?php the_author(); ?></span>
                                </div>
                                <span class="blog-card__read">Read Article
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endif; // end featured ?>


                <!-- ── Post Grid ── -->
                <?php if ( $blog_query->have_posts() ) : ?>
                <div class="blog-grid">
                    <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                        <article class="blog-card reveal" itemscope itemtype="https://schema.org/BlogPosting">
                            <a href="<?php the_permalink(); ?>"
                               class="blog-card__link"
                               aria-label="<?php echo esc_attr( 'Read: ' . get_the_title() ); ?>">

                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="blog-card__img">
                                        <?php the_post_thumbnail( 'medium_large', array(
                                            'loading'  => 'lazy',
                                            'decoding' => 'async',
                                        ) ); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                                    </div>
                                <?php endif; ?>

                                <div class="blog-card__body">
                                    <div class="blog-card__meta">
                                        <?php
                                        $post_cats = get_the_category();
                                        if ( $post_cats ) :
                                        ?>
                                            <span class="blog-card__cat"><?php echo esc_html( $post_cats[0]->name ); ?></span>
                                        <?php endif; ?>
                                        <time class="blog-card__date"
                                              datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                            <?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
                                        </time>
                                    </div>
                                    <h2 class="blog-card__title" itemprop="headline"><?php the_title(); ?></h2>
                                    <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                                    <span class="blog-card__read">Read Article
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php endif; // end grid ?>


                <!-- ── Pagination ── -->
                <?php if ( $blog_query->max_num_pages > 1 ) : ?>
                <nav class="blog-pagination" aria-label="Blog pagination">
                    <?php
                    echo paginate_links( array(
                        'base'      => trailingslashit( get_permalink() ) . '%_%',
                        'format'    => 'page/%#%/',
                        'current'   => $paged,
                        'total'     => $blog_query->max_num_pages,
                        'prev_text' => '&larr; Previous',
                        'next_text' => 'Next &rarr;',
                        'type'      => 'list',
                    ) );
                    ?>
                </nav>
                <?php endif; ?>

            <?php else : ?>

                <!-- ── Empty state ── -->
                <div class="blog-empty reveal">
                    <div class="blog-empty__icon-wrap">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </div>
                    <h2 class="blog-empty__title">Coming Soon</h2>
                    <p class="blog-empty__text">Plumbing tips, maintenance guides, and expert advice — coming soon from the Hot Water Heroes team.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hwh-btn hwh-btn--red">Back to Home</a>
                </div>

            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

        </div>
    </section>


    <!-- ── CTA ── -->
    <section class="cta-section" aria-label="Request service">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Have a Plumbing Issue?</span>
            <h2 class="cta-section__title">Need Help?<br>We're On Our Way.</h2>
            <p class="cta-section__text">Call us or book online — fast, reliable plumbing service across Tampa Bay.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="hwh-btn hwh-btn--red hwh-btn--lg">Request Service</a>
                <a href="tel:+18134275862" class="hwh-btn hwh-btn--ghost hwh-btn--lg">Call 813-42-PLUMB</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
