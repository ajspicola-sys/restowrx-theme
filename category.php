<?php
/**
 * Hot Water Heroes — Category Archive Template
 * Shows posts filtered by a specific category.
 * Uses the native WP loop since category archives only contain posts.
 */

get_header();

$current_cat = get_queried_object();
?>

<main class="site-main" id="main-content">

    <!-- Blog Hero -->
    <section class="blog-hero" aria-label="Blog">
        <div class="blog-hero__bg" aria-hidden="true">
            <div class="blog-hero__orb blog-hero__orb--1"></div>
            <div class="blog-hero__orb blog-hero__orb--2"></div>
        </div>
        <div class="blog-hero__inner">
            <span class="section__label">HWH Blog</span>
            <h1 class="blog-hero__title"><?php echo esc_html( $current_cat->name ); ?></h1>
            <?php if ( $current_cat->description ) : ?>
                <p class="blog-hero__desc"><?php echo esc_html( $current_cat->description ); ?></p>
            <?php else : ?>
                <p class="blog-hero__desc">Browse our <?php echo esc_html( strtolower( $current_cat->name ) ); ?> articles and tips.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="blog-filters" aria-label="Filter by category">
        <div class="section__inner">
            <div class="blog-filters__bar">
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"
                   class="blog-filter-btn">All Posts</a>
                <?php
                $filter_cats = get_categories( array(
                    'hide_empty' => true,
                    'exclude'    => array( 1 ),
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ) );
                foreach ( $filter_cats as $fc ) {
                    $is_active = ( $current_cat->term_id === $fc->term_id ) ? ' is-active' : '';
                    echo '<a href="' . esc_url( get_category_link( $fc->term_id ) ) . '" class="blog-filter-btn' . $is_active . '">' . esc_html( $fc->name ) . '</a>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Posts Grid -->
    <section class="blog-archive" aria-label="Blog posts">
        <div class="section__inner">

        <?php if ( have_posts() ) : ?>

            <div class="blog-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="blog-card reveal" itemscope itemtype="https://schema.org/BlogPosting">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link" aria-label="Read: <?php the_title_attribute(); ?>">
                            <?php
                            $card_img = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                            if ( $card_img ) :
                            ?>
                                <div class="blog-card__img">
                                    <img src="<?php echo esc_url( $card_img ); ?>"
                                         alt="<?php the_title_attribute(); ?>"
                                         loading="lazy" decoding="async">
                                </div>
                            <?php else : ?>
                                <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <?php
                                    $ccats = get_the_category();
                                    if ( ! empty( $ccats ) ) {
                                        echo '<span class="blog-card__cat">' . esc_html( $ccats[0]->name ) . '</span>';
                                    }
                                    ?>
                                    <time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
                                </div>
                                <h2 class="blog-card__title" itemprop="headline"><?php the_title(); ?></h2>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                                <span class="blog-card__read">Read Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <?php
            $pagination = paginate_links( array(
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
                'type'      => 'list',
            ) );
            if ( $pagination ) :
            ?>
            <nav class="blog-pagination" aria-label="Blog pagination">
                <?php echo $pagination; ?>
            </nav>
            <?php endif; ?>

        <?php else : ?>

            <div class="blog-empty reveal">
                <div class="blog-empty__icon-wrap">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <h2 class="blog-empty__title">No Posts Yet</h2>
                <p class="blog-empty__text">No articles in this category yet. Check back soon!</p>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="hwh-btn hwh-btn--red">View All Posts</a>
            </div>

        <?php endif; ?>

        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Request service">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Have a Plumbing Issue?</span>
            <h2 class="cta-section__title">Need Help?<br>We're On Our Way.</h2>
            <p class="cta-section__text">Call us or book online &mdash; fast, reliable plumbing service across Tampa Bay.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="hwh-btn hwh-btn--red hwh-btn--lg">Request Service</a>
                <a href="tel:+18134275862" class="hwh-btn hwh-btn--ghost hwh-btn--lg">Call 813-42-PLUMB (75862)</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
