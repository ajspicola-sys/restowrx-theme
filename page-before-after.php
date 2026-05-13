<?php
/**
 * Template Name: Before After
 * Hot Water Heroes Plumbing — Before & After Gallery
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="page-hero" aria-label="Before and after gallery">
        <div class="page-hero__inner">
            <span class="section__label">Real Results</span>
            <h1 class="page-hero__title">Before & After</h1>
            <p class="page-hero__desc">See the quality of our work. All photos are from actual Hot Water Heroes plumbing projects across Tampa Bay.</p>
        </div>
    </section>

    <section class="gallery-section">
        <div class="section__inner">

            <!-- Filter tabs -->
            <div class="gallery-filters reveal" role="group" aria-label="Filter by project type">
                <button class="gallery-filter is-active" data-filter="all">All</button>
                <button class="gallery-filter" data-filter="water-heater">Water Heaters</button>
                <button class="gallery-filter" data-filter="pipe-repair">Pipe Repair</button>
                <button class="gallery-filter" data-filter="bathroom">Bathroom</button>
                <button class="gallery-filter" data-filter="drain">Drain Cleaning</button>
            </div>

            <div class="gallery-grid reveal">
                <div class="gallery-card" data-category="water-heater">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Tank Water Heater Replacement</h3>
                        <p class="gallery-card__desc">Removed corroded 15-year-old water heater and installed new 50-gallon energy-efficient unit. Same-day service.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="pipe-repair">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Burst Pipe Emergency Repair</h3>
                        <p class="gallery-card__desc">Repaired a burst copper pipe under the kitchen sink. Minimal drywall damage, completed in under 2 hours.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="bathroom">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Full Bathroom Repiping</h3>
                        <p class="gallery-card__desc">Complete repipe of outdated galvanized pipes to PEX throughout a master bathroom. 1-day turnaround.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="drain">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Main Line Drain Clearing</h3>
                        <p class="gallery-card__desc">Hydro-jetting a severely clogged main sewer line. Camera inspection confirmed full clearance.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="water-heater">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Tankless Water Heater Upgrade</h3>
                        <p class="gallery-card__desc">Replaced an old tank heater with a compact Navien tankless unit. Endless hot water and 40% lower energy bills.</p>
                    </div>
                </div>

                <div class="gallery-card" data-category="pipe-repair">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Before</span>
                            <div class="gallery-card__placeholder">Before Photo</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">After</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">After Photo</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Slab Leak Repair</h3>
                        <p class="gallery-card__desc">Located and repaired a hidden slab leak using electronic detection. Minimal floor disruption.</p>
                    </div>
                </div>
            </div>

            <div class="gallery-disclaimer reveal">
                <p>* All photos are from actual Hot Water Heroes projects. Results may vary based on property conditions.</p>
            </div>
        </div>
    </section>

    <section class="cta-section" aria-label="Request service">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">Need Quality Plumbing Work?</span>
            <h2 class="cta-section__title">Your Home<br>Deserves the Best.</h2>
            <p class="cta-section__text">Call us or book online — we'll dispatch a licensed plumber to your door fast.</p>
            <div class="cta-section__actions">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">Request Service</a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
