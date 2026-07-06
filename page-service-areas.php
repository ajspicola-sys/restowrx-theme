<?php
/**
 * Template Name: Service Areas
 * Restowrx Elite — Service Area Coverage Page
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="page-hero" aria-label="Service areas">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span>Service Areas</span>
            </div>
            <h1 class="page-hero__title">Serving All of<br><em>Tampa Bay</em></h1>
            <p class="page-hero__desc">From South Tampa to Wesley Chapel, we provide fast, certified property damage mitigation and restoration across Hillsborough, Pinellas, and Pasco counties.</p>
        </div>
    </section>

    <!-- Coverage Areas -->
    <section class="party-types" id="coverage-areas">
        <div class="section__inner">

            <div class="section__header reveal">
                <span class="section__label">Coverage Map</span>
                <h2 class="section__title">Areas We Serve</h2>
                <p class="section__desc">We dispatch certified rapid response mitigation teams to all major Tampa Bay communities. If you're in the area, we've got you covered.</p>
            </div>

            <div class="party-block__features party-block__features--spaced">
                <div class="party-feature-card reveal">
                    <div class="party-feature-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                    <h4 class="party-feature-card__title">Hillsborough County</h4>
                    <p class="party-feature-card__text">Tampa, South Tampa, Carrollwood, Westchase, Brandon, Riverview, Lithia, Valrico, New Tampa, Temple Terrace</p>
                </div>
                <div class="party-feature-card reveal">
                    <div class="party-feature-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                    <h4 class="party-feature-card__title">Pinellas County</h4>
                    <p class="party-feature-card__text">St. Petersburg, Clearwater, Largo, Pinellas Park, Dunedin, Safety Harbor, Oldsmar, Palm Harbor</p>
                </div>
                <div class="party-feature-card reveal">
                    <div class="party-feature-card__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                    <h4 class="party-feature-card__title">Pasco County</h4>
                    <p class="party-feature-card__text">Wesley Chapel, Lutz, Land O' Lakes, Odessa, Zephyrhills, New Port Richey, Trinity</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ── Localized Services Directory ────────────────────────────────── -->
    <section class="localized-directory-section" style="background: #0d0101; padding: clamp(60px, 8vw, 100px) 0; border-top: 1px solid rgba(255,0,0,0.1); border-bottom: 1px solid rgba(255,0,0,0.1);">
        <div class="section__inner" style="max-width: 1300px; margin: 0 auto; padding: 0 clamp(20px, 5vw, 40px); box-sizing: border-box;">
            <div class="section__header reveal" style="text-align: center; margin-bottom: 50px;">
                <span class="section__label" style="font-family: var(--font-mono, 'Space Mono', monospace); color: var(--color-red, #F22F3A); font-size: 0.75rem; letter-spacing: 4px; text-transform: uppercase; display: block; margin-bottom: 15px; font-weight: 700;">Local Index</span>
                <h2 class="section__title" style="font-family: var(--font-accent, 'Bebas Neue', sans-serif); font-size: clamp(2.5rem, 5vw, 4.2rem); text-transform: uppercase; margin: 0 0 20px 0; color: #ffffff; line-height: 0.95; letter-spacing: 1px;">Service Area Directories</h2>
                <p class="section__desc" style="color: #888888; max-width: 600px; margin: 0 auto; font-size: 1.05rem; line-height: 1.6;">Direct structural links to our localized emergency mitigation and restoration field offices across the Tampa Bay command zone.</p>
            </div>
            
            <?php
            // Temporarily bypass general exclude filter to retrieve neighborhood landing pages
            remove_filter( 'posts_where', 'rwx_exclude_neighborhood_services', 10 );
            $all_services = get_posts([
                'post_type'      => 'service',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC'
            ]);
            add_filter( 'posts_where', 'rwx_exclude_neighborhood_services', 10, 2 );

            $locations = [
                'tampa'          => 'Tampa (Main)',
                'south-tampa'    => 'South Tampa',
                'brandon'        => 'Brandon',
                'st-petersburg'  => 'St. Petersburg',
                'carrollwood'    => 'Carrollwood',
            ];

            $grouped = [];
            foreach ( $locations as $key => $name ) {
                $grouped[ $key ] = [];
            }

            // NOTE: loop variable must NOT be called $post — that clobbered
            // the global post object for the rest of the template.
            foreach ( $all_services as $svc ) {
                $slug = $svc->post_name;
                $found_loc = 'tampa';
                foreach ( $locations as $loc_key => $loc_name ) {
                    if ( $loc_key === 'tampa' ) continue;
                    $suffix = '-' . $loc_key;
                    if ( substr( $slug, -strlen( $suffix ) ) === $suffix ) {
                        $found_loc = $loc_key;
                        break;
                    }
                }
                $grouped[ $found_loc ][] = $svc;
            }
            ?>

            <div class="directory-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 30px;">
                <?php foreach ( $grouped as $loc_key => $posts ) : 
                    if ( empty( $posts ) ) continue;
                    $loc_title = $locations[ $loc_key ];
                    ?>
                    <div class="directory-col reveal" style="background: rgba(255,255,255,0.01); border: 1px solid rgba(255,255,255,0.04); padding: 25px; border-radius: 6px; box-shadow: 0 4px 25px rgba(0,0,0,0.3); transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(255,0,0,0.25)';" onmouseout="this.style.borderColor='rgba(255,255,255,0.04)';">
                        <h3 style="font-family: var(--font-accent, 'Bebas Neue', sans-serif); font-size: 1.7rem; letter-spacing: 1.5px; color: white; border-bottom: 2px solid var(--color-red, #F22F3A); padding-bottom: 10px; margin-top: 0; margin-bottom: 18px; text-transform: uppercase;"><?php echo esc_html( $loc_title ); ?></h3>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                            <?php foreach ( $posts as $p ) : 
                                $display_title = $p->post_title;
                                $loc_name_raw = $locations[ $loc_key ];
                                if ( $loc_key !== 'tampa' ) {
                                    if ( preg_match( '/' . preg_quote( $loc_name_raw, '/' ) . '$/i', $display_title ) ) {
                                        $display_title = preg_replace( '/' . preg_quote( $loc_name_raw, '/' ) . '$/i', '', $display_title );
                                        $display_title = trim( $display_title, " \t\n\r\0\x0B-_:," );
                                    }
                                }
                                ?>
                                <li>
                                    <?php
                                    // Build the URL from the slug directly. get_permalink() runs the
                                    // rwx_user_geo cookie filter, which rewrote e.g. the "Tampa (Main)"
                                    // column's links to the visitor's cookie location — and made this
                                    // page's HTML vary per visitor, poisoning the page cache.
                                    $svc_url = home_url( '/services/' . $p->post_name . '/' );
                                    ?>
                                    <a href="<?php echo esc_url( $svc_url ); ?>" class="no-transition" data-geo-fixed="1" style="color: #888888; text-decoration: none; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.8px; font-family: var(--font-mono, 'Space Mono', monospace); display: inline-flex; align-items: center; gap: 8px; transition: color 0.2s;" onmouseover="this.style.color='var(--color-red, #F22F3A)';" onmouseout="this.style.color='#888888';">
                                        <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" style="stroke: var(--color-red, #F22F3A);"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        <?php echo esc_html( $display_title ); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Why Choose Us for Your Area -->
    <section class="party-how-it-works">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Why Local Matters</span>
                <h2 class="section__title">The Restowrx Elite Advantage</h2>
            </div>
            <div class="party-steps reveal">
                <div class="party-step">
                    <div class="party-step__number">01</div>
                    <h3 class="party-step__title">Fast Response</h3>
                    <p class="party-step__text">Our local restoration specialists are stationed across Tampa Bay, so we can reach you quickly — often within the hour.</p>
                </div>
                <div class="party-step__arrow">→</div>
                <div class="party-step">
                    <div class="party-step__number">02</div>
                    <h3 class="party-step__title">Local Knowledge</h3>
                    <p class="party-step__text">We know Tampa Bay properties — from older Seminole Heights bungalows to new Wesley Chapel builds. We understand the unique moisture and storm challenges of Florida.</p>
                </div>
                <div class="party-step__arrow">→</div>
                <div class="party-step">
                    <div class="party-step__number">03</div>
                    <h3 class="party-step__title">Community Trusted</h3>
                    <p class="party-step__text">Dozens of 5-star reviews from your neighbors. We're proud to be Tampa Bay's go-to rapid recovery team.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="party-faq">
        <div class="section__inner">
            <div class="section__header reveal">
                <span class="section__label">Questions?</span>
                <h2 class="section__title">Service Area FAQ</h2>
            </div>
            <div class="faq-list reveal">
                <details class="faq-item">
                    <summary class="faq-item__question">Do you service my area?</summary>
                    <div class="faq-item__answer">
                        <p>We serve all of Hillsborough, Pinellas, and Pasco counties. If you're in the greater Tampa Bay area, chances are we can get to you. Call us and we'll confirm.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">How fast can a response team reach me?</summary>
                    <div class="faq-item__answer">
                        <p>For emergencies, we aim to have a rapid response team at your door within 45 minutes. For scheduled inspections or scans, we offer same-day and next-day availability.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Is there an extra charge for distant locations?</summary>
                    <div class="faq-item__answer">
                        <p>No. We charge the same rates across our entire service area. There are no hidden trip fees or mileage charges for any location within our coverage zone.</p>
                    </div>
                </details>
                <details class="faq-item">
                    <summary class="faq-item__question">Do you offer emergency dispatches on weekends?</summary>
                    <div class="faq-item__answer">
                        <p>Yes! Our emergency rapid response service is available 24/7, 365 days a year — including weekends and holidays. Call 813.699.4009 anytime.</p>
                    </div>
                </details>
            </div>
        </div>
    </section>




</main>

<?php get_footer(); ?>
