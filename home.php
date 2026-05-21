<?php
/**
 * Restowrx Elite — Blog Page (home.php)
 *
 * Uses a dedicated WP_Query to fetch ONLY regular posts.
 * This prevents services or any other CPT from appearing.
 */

get_header();

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$blog_query = new WP_Query( array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 9,
    'paged'               => $paged,
    'ignore_sticky_posts' => false,
) );
?>

<main class="site-main" id="main-content">

    <!-- Blog Hero -->
    <section class="blog-hero" aria-label="Blog">
        <div class="blog-hero__bg" aria-hidden="true">
            <div class="blog-hero__orb blog-hero__orb--1"></div>
            <div class="blog-hero__orb blog-hero__orb--2"></div>
        </div>
        <div class="blog-hero__inner">
            <span class="section__label">RESTOWRX INTEL</span>
            <h1 class="blog-hero__title">Field Intelligence &amp;<br><em>After Action Reports</em></h1>
            <p class="blog-hero__desc">Operational briefs, tactical restoration field reports, and property recovery insights from the Restowrx Elite command team.</p>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="blog-filters" aria-label="Filter by category">
        <div class="section__inner">
            <div class="blog-filters__bar">
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"
                   class="blog-filter-btn is-active">All Posts</a>
                <?php
                $filter_cats = get_categories( array(
                    'hide_empty' => true,
                    'exclude'    => array( 1 ),
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ) );
                foreach ( $filter_cats as $fc ) {
                    echo '<a href="' . esc_url( get_category_link( $fc->term_id ) ) . '" class="blog-filter-btn">' . esc_html( $fc->name ) . '</a>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Posts Section -->
    <section class="blog-archive" aria-label="Blog posts">
        <div class="section__inner">

        <?php if ( $blog_query->have_posts() ) : ?>

            <?php
            // Featured card — first post on page 1
            if ( $paged === 1 ) :
                $blog_query->the_post();
            ?>
            <article class="blog-featured reveal" itemscope itemtype="https://schema.org/BlogPosting">
                <a href="<?php the_permalink(); ?>" class="blog-featured__link">
                    <div class="blog-featured__img">
                        <?php
                        $feat_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( $feat_img ) :
                        ?>
                            <img src="<?php echo esc_url( $feat_img ); ?>"
                                 alt="<?php the_title_attribute(); ?>"
                                 loading="eager" decoding="async" fetchpriority="high" itemprop="image">
                        <?php else : ?>
                            <div class="blog-featured__placeholder" aria-hidden="true">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                            </div>
                        <?php endif; ?>
                        <div class="blog-featured__badge">Featured</div>
                    </div>
                    <div class="blog-featured__body">
                        <div class="blog-card__meta">
                            <?php
                            $fcats = get_the_category();
                            if ( ! empty( $fcats ) ) {
                                echo '<span class="blog-card__cat">' . esc_html( $fcats[0]->name ) . '</span>';
                            }
                            ?>
                            <time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
                        </div>
                        <h2 class="blog-featured__title" itemprop="headline"><?php the_title(); ?></h2>
                        <p class="blog-featured__excerpt" itemprop="description"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
                        <div class="blog-featured__footer">
                            <div class="blog-featured__author">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 36 ); ?>
                                <span><?php the_author(); ?></span>
                            </div>
                            <span class="blog-card__read">Read Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                        </div>
                    </div>
                </a>
            </article>
            <?php endif; ?>

            <!-- Post Grid -->
            <div id="blog-posts-wrap">
            <?php if ( $blog_query->have_posts() ) : ?>
            <div class="blog-grid">
                <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                    <article class="blog-card reveal" itemscope itemtype="https://schema.org/BlogPosting">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
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
            <?php endif; ?>

            <!-- Pagination -->
            <?php if ( $blog_query->max_num_pages > 1 ) : ?>
            <nav class="blog-pagination" aria-label="Blog pagination">
                <?php
                echo paginate_links( array(
                    'total'     => $blog_query->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                    'type'      => 'list',
                ) );
                ?>
            </nav>
            <?php endif; ?>
            </div><!-- #blog-posts-wrap -->

        <?php else : ?>

            <div class="blog-empty reveal">
                <div class="blog-empty__icon-wrap">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <h2 class="blog-empty__title">COMING SOON</h2>
                <p class="blog-empty__text">Property recovery intelligence briefs and tactical restoration manuals coming soon.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hwh-btn hwh-btn--red">Return to Command</a>
            </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section" aria-label="Request service">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">OPERATIONAL RECOVERY NEEDED?</span>
            <h2 class="cta-section__title">INITIATE DISPATCH<br>EMERGENCY RADAR ACTIVE</h2>
            <p class="cta-section__text">Surgical precision. Rapid tactical mobilization. Tampa Bay's property recovery command center is standing by 24/7.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="hwh-btn hwh-btn--red hwh-btn--lg">INITIATE DISPATCH</a>
                <a href="tel:+18137326285" class="hwh-btn hwh-btn--ghost hwh-btn--lg">CALL RADAR: (813) 732-6285</a>
            </div>
        </div>
    </section>

</main>

<script>
(function() {
    var wrap = document.getElementById('blog-posts-wrap');
    if (!wrap) return;

    var ajaxUrl = '<?php echo esc_url( admin_url( "admin-ajax.php" ) ); ?>';

    wrap.addEventListener('click', function(e) {
        // Find the clicked pagination link
        var link = e.target.closest('.blog-pagination a');
        if (!link) return;
        e.preventDefault();

        // Extract page number from the URL
        var url  = new URL(link.href);
        var page = 1;
        // Try /page/N/ format
        var match = url.pathname.match(/\/page\/(\d+)/);
        if (match) {
            page = parseInt(match[1], 10);
        }
        // Try ?paged=N format
        if (url.searchParams.get('paged')) {
            page = parseInt(url.searchParams.get('paged'), 10);
        }

        // Fade out
        wrap.style.opacity = '0.4';
        wrap.style.transition = 'opacity 0.25s ease';

        // Fetch
        var data = new FormData();
        data.append('action', 'hwh_load_posts');
        data.append('page', page);

        fetch(ajaxUrl, { method: 'POST', body: data })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success && res.data.html) {
                    wrap.innerHTML = res.data.html;
                    wrap.style.opacity = '1';

                    // Scroll to top of grid
                    wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });

                    // Trigger reveal animations on new cards
                    var cards = wrap.querySelectorAll('.reveal');
                    cards.forEach(function(card) {
                        card.classList.add('is-visible');
                    });
                }
            })
            .catch(function() {
                wrap.style.opacity = '1';
            });
    });
})();
</script>

<?php get_footer(); ?>

