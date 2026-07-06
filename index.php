<?php
/**
 * Restowrx Elite Theme — Fallback Template (index.php)
 *
 * The ultimate fallback for any request without a more specific template
 * (tag archives, date/author archives, service_category taxonomy, etc.).
 * It used to load home.php, which rendered the blog page — with the wrong
 * title and wrong posts — for all of those URLs. This version lists the
 * main query's actual results under the correct archive title.
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Archive">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span><?php echo is_archive() ? wp_kses_post( get_the_archive_title() ) : 'Archive'; ?></span>
            </div>
            <h1 class="page-hero__title"><?php echo is_archive() ? wp_kses_post( get_the_archive_title() ) : 'Latest Posts'; ?></h1>
            <?php if ( is_archive() && get_the_archive_description() ) : ?>
                <p class="page-hero__desc"><?php echo wp_kses_post( get_the_archive_description() ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="blog-archive" aria-label="Archive posts">
        <div class="section__inner">

        <?php if ( have_posts() ) : ?>

            <div class="blog-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="blog-card reveal">
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="blog-card__img">
                                    <?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
                                </div>
                            <?php else : ?>
                                <div class="blog-card__img blog-card__img--placeholder" aria-hidden="true">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="blog-card__body">
                                <div class="blog-card__meta">
                                    <time class="blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
                                </div>
                                <h2 class="blog-card__title"><?php the_title(); ?></h2>
                                <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                                <span class="blog-card__read">Read More <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></span>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            $pagination = paginate_links( array(
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
                'type'      => 'list',
            ) );
            if ( $pagination ) : ?>
            <nav class="blog-pagination" aria-label="Pagination">
                <?php echo $pagination; ?>
            </nav>
            <?php endif; ?>

        <?php else : ?>

            <div class="blog-empty reveal">
                <h2 class="blog-empty__title">Nothing Found</h2>
                <p class="blog-empty__text">No content matched this request.</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hwh-btn hwh-btn--red">Return to Command</a>
            </div>

        <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>
