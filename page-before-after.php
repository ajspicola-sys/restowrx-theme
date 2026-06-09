<?php
/**
 * Template Name: Before After
 * Restowrx Elite — Before & After Gallery
 */
get_header(); ?>

<main class="site-main" id="main-content" style="background:#050505; color:#ffffff; font-family:var(--font-main, 'Inter', sans-serif); overflow-x:hidden;">

    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="page-hero" aria-label="Before and after gallery">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span>Before &amp; After</span>
            </div>
            <h1 class="page-hero__title">Before &amp; <em>After</em></h1>
            <p class="page-hero__desc">Examine the proven results of property recovery. Real-world highlights from actual water damage, fire soot, mold containment, and storm recovery projects across Tampa Bay.</p>
        </div>
    </section>

    <section class="gallery-section">
        <div class="section__inner">

            <!-- Filter tabs -->
            <div class="gallery-filters reveal" role="group" aria-label="Filter by project type">
                <button class="gallery-filter is-active" data-filter="all">All Case Files</button>
                <button class="gallery-filter" data-filter="water-damage">Water Damage</button>
                <button class="gallery-filter" data-filter="fire-restoration">Fire Restoration</button>
                <button class="gallery-filter" data-filter="mold-containment">Mold Containment</button>
                <button class="gallery-filter" data-filter="storm-impact">Storm Impact</button>
            </div>

            <div class="gallery-grid reveal">
                <!-- Case 1 -->
                <div class="gallery-card" data-category="water-damage">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Inundation</span>
                            <div class="gallery-card__placeholder">Saturated Subfloor Telemetry</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">Stabilized</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">Thermal Dry Out Complete</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">High-Capacity Water Extraction</h3>
                        <p class="gallery-card__desc">Remediated severe flood inundation from hurricane storm surge. Deployed 6 high-capacity extraction pumps, custom containment barriers, and thermal dehumidification mapping.</p>
                    </div>
                </div>

                <!-- Case 2 -->
                <div class="gallery-card" data-category="fire-restoration">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Soot Outbreak</span>
                            <div class="gallery-card__placeholder">Soiled Carbon Residues</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">Deodorized</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">Molecular Deodorization Complete</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Kitchen Fire Soot Deodorization</h3>
                        <p class="gallery-card__desc">Eradicated severe soot residues and carbon scaling from a major kitchen fire outbreak. Executed clinical negative air scrubbing and molecular deodorization.</p>
                    </div>
                </div>

                <!-- Case 3 -->
                <div class="gallery-card" data-category="mold-containment">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Contaminated</span>
                            <div class="gallery-card__placeholder">Toxic Black Spores</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">Remediated</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">HEPA Decontaminated</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Black Mold Bio-Isolation</h3>
                        <p class="gallery-card__desc">Isolated and contained toxic black mold colonizing master suite structural framing. Established strict clinical containment barriers, negative pressure, and HEPA air scrubbing.</p>
                    </div>
                </div>

                <!-- Case 4 -->
                <div class="gallery-card" data-category="storm-impact">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Breached</span>
                            <div class="gallery-card__placeholder">Structural Roof Breach</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">Tarped</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">Emergency Board-Up Complete</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Storm Tarping &amp; Board Up</h3>
                        <p class="gallery-card__desc">Secured structural envelope stability following windward tree impact during tropical storm outbreak. Completed immediate emergency board-up and heavy-duty storm tarping.</p>
                    </div>
                </div>

                <!-- Case 5 -->
                <div class="gallery-card" data-category="water-damage">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Saturated</span>
                            <div class="gallery-card__placeholder">Waterlogged Wall Envelope</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">Dehydrated</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">Bone-Dry Certification</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Structural Frame Thermal Drying</h3>
                        <p class="gallery-card__desc">Dehydrated waterlogged drywall envelopes and structural framing. Telemetry logs mapped complete moisture extraction to safeguard structural load stability.</p>
                    </div>
                </div>

                <!-- Case 6 -->
                <div class="gallery-card" data-category="storm-impact">
                    <div class="gallery-card__images">
                        <div class="gallery-card__before">
                            <span class="gallery-card__label">Flooded</span>
                            <div class="gallery-card__placeholder">Breached Drainage Envelope</div>
                        </div>
                        <div class="gallery-card__after">
                            <span class="gallery-card__label gallery-card__label--after">Secured</span>
                            <div class="gallery-card__placeholder gallery-card__placeholder--after">Diverted &amp; Stabilized</div>
                        </div>
                    </div>
                    <div class="gallery-card__info">
                        <h3 class="gallery-card__title">Storm Flooding Stabilization</h3>
                        <p class="gallery-card__desc">Stabilized commercial property following severe exterior drainage breach. Executed rapid water diversion, sediment extraction, and micro-mitigation drying.</p>
                    </div>
                </div>
            </div>

            <div class="gallery-disclaimer reveal">
                <p>* All case images are forensic logs from actual Restowrx Elite property recovery deployments. Pre-loss reconstruction completed in partnership with Spicola Construction.</p>
            </div>
        </div>
    </section>

    <style>
    .gallery-section {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #050505;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .section__inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
    }
    .gallery-filters {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 50px;
    }
    .gallery-filter {
        background: #0a0a0a;
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #888;
        padding: 8px 20px;
        border-radius: 4px;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .gallery-filter:hover, .gallery-filter.is-active {
        background: rgba(255, 0, 0, 0.08);
        border-color: var(--brand, #ff0000);
        color: white;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 40px;
    }
    .gallery-card {
        background: #0a0a0a;
        border: 1px solid rgba(255, 255, 255, 0.03);
        border-radius: 4px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .gallery-card:hover {
        border-color: var(--brand, #ff0000);
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.6);
    }
    .gallery-card__images {
        display: grid;
        grid-template-columns: 1fr 1fr;
        height: 200px;
        position: relative;
        background: #000;
        border-bottom: 1px solid rgba(255,255,255,0.03);
    }
    .gallery-card__before, .gallery-card__after {
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gallery-card__before {
        border-right: 1px solid rgba(255,255,255,0.03);
    }
    .gallery-card__label {
        position: absolute;
        top: 15px; left: 15px;
        background: rgba(0, 0, 0, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #888;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.6rem;
        padding: 2px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        z-index: 10;
        letter-spacing: 0.5px;
    }
    .gallery-card__label--after {
        color: var(--brand, #ff0000);
        border-color: rgba(255, 0, 0, 0.3);
        background: rgba(18, 3, 3, 0.85);
    }
    .gallery-card__placeholder {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.6rem;
        color: #444;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .gallery-card__placeholder--after {
        color: var(--brand, #ff0000);
        text-shadow: 0 0 10px rgba(255,0,0,0.2);
    }
    .gallery-card__info {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .gallery-card__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        color: white;
        margin: 0 0 12px 0;
        letter-spacing: 1px;
    }
    .gallery-card__desc {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }
    .gallery-disclaimer {
        text-align: center;
        margin-top: 50px;
        font-size: 0.8rem;
        color: #666;
        font-family: var(--font-mono, 'Space Mono', monospace);
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var filters = document.querySelectorAll('.gallery-filter');
        var cards = document.querySelectorAll('.gallery-card');

        filters.forEach(function(filter) {
            filter.addEventListener('click', function() {
                var selectedFilter = this.getAttribute('data-filter');

                // Active class mapping
                filters.forEach(function(f) { f.classList.remove('is-active'); });
                this.classList.add('is-active');

                cards.forEach(function(card) {
                    var cardCategory = card.getAttribute('data-category');
                    if (selectedFilter === 'all' || cardCategory === selectedFilter) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>




</main>

<?php get_footer(); ?>
