<?php
/**
 * Restowrx Elite — Services Archive Template
 * Premium dark tactical grid, surgical recovery services, explicit WP_Query.
 * SEO: title + meta description managed by Yoast SEO.
 */
get_header();
?>

<style>
    /* Service Archive Page Custom Styling */
    .rwx-services-archive {
        background-color: #ffffff;
        color: #111111;
        font-family: var(--font-main, 'Inter', sans-serif);
        overflow-x: hidden;
    }



    /* --- SERVICES SECTION --- */
    .services-grid-section {
        width: 100%;
        background-color: #ffffff;
        padding: clamp(60px, 8vw, 120px) 0;
        position: relative;
    }

    .grid-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    .service-card {
        background: #0a0a0a !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        padding: 0 !important;
        position: relative;
        display: flex;
        flex-direction: column;
        transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        text-decoration: none;
        color: #ffffff !important;
        overflow: hidden;
        height: 100%;
        box-sizing: border-box;
        border-radius: 8px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .service-card:hover {
        background: #111111 !important;
        transform: translateY(-10px) !important;
        border-color: var(--brand, #ff0000) !important;
        box-shadow: 0 40px 80px rgba(0,0,0,0.8) !important;
    }

    /* Premium Featured Image Top Wrap */
    .card-image-wrap {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: #000;
        border-bottom: 2px solid var(--brand, #ff0000);
    }
    
    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.75;
        transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    }
    
    .service-card:hover .card-img {
        opacity: 1;
        transform: scale(1.08);
    }
    
    .card-info {
        padding: 40px 30px 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        position: relative;
    }

    /* Overlapping Circular Brand Icon */
    .card-icon {
        position: absolute;
        top: -24px;
        left: 30px;
        width: 48px;
        height: 48px;
        background: #0a0a0a !important;
        border: 1px solid var(--brand, #ff0000) !important;
        border-radius: 50% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 20;
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        color: var(--brand, #ff0000) !important;
        margin: 0;
    }
    
    .service-card:hover .card-icon {
        background: var(--brand, #ff0000) !important;
        color: white !important;
        transform: scale(1.1);
        box-shadow: 0 10px 25px rgba(255,0,0,0.3);
    }
    
    .card-icon i, .card-icon svg {
        width: 20px;
        height: 20px;
        display: inline-block;
    }

    /* Floating Corner Numbering */
    .card-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 3.2rem;
        color: rgba(255, 255, 255, 0.25) !important;
        transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        line-height: 1;
        z-index: 10;
    }

    .service-card:hover .card-number {
        color: var(--brand, #ff0000) !important;
        transform: scale(1.05);
    }

    .service-card h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2rem, 3vw, 2.8rem) !important;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
        line-height: 1;
        margin-top: 0;
        color: #ffffff !important;
    }

    .service-card h3 b { display: block; }
    .service-card h3 span { color: var(--brand, #ff0000) !important; }

    .service-card p {
        color: #888888 !important;
        line-height: 1.6;
        margin-bottom: 40px;
        font-size: 0.95rem;
        flex-grow: 1;
        margin-top: 0;
    }

    .card-list {
        list-style: none;
        padding: 0;
        margin-bottom: 40px;
        margin-top: 0;
    }

    .card-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
        font-size: 0.85rem !important;
        color: #aaaaaa !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: var(--font-mono, 'Space Mono', monospace);
    }

    .card-list li i, .card-list li svg {
        color: var(--brand, #ff0000) !important;
        display: flex;
        align-items: center;
        width: 14px;
        height: 14px;
    }

    .card-brief-link {
        display: flex;
        align-items: center;
        gap: 15px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.4rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.3s;
        color: #ffffff !important;
    }

    .service-card:hover .card-brief-link {
        color: var(--brand, #ff0000) !important;
        gap: 25px;
    }

    /* --- THE PROCESS --- */
    .process-section {
        padding: clamp(80px, 12vw, 150px) 0;
        background: #000000;
        position: relative;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .process-header {
        text-align: center;
        margin-bottom: 70px;
    }

    .process-header .section-label {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.75rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .process-header h2 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        line-height: 0.95;
    }

    .process-header h2 em {
        color: transparent;
        -webkit-text-stroke: 1.5px white;
        font-style: normal;
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: clamp(20px, 3vw, 40px);
    }

    .process-step {
        position: relative;
        text-align: center;
    }

    .step-number {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 8rem;
        color: rgba(255, 0, 0, 0.03);
        line-height: 1;
        position: absolute;
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        pointer-events: none;
    }

    .step-content {
        position: relative;
        z-index: 2;
    }

    .step-icon-wrap {
        width: 80px;
        height: 80px;
        background: var(--brand, #ff0000);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
        color: white;
    }

    .step-icon-wrap svg {
        width: 32px;
        height: 32px;
    }

    .step-content h4 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 0 15px 0;
        color: white;
    }

    .step-content p {
        color: #888;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }

    

    /* Responsive Overrides */
    @media (max-width: 1100px) {
        .process-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }
    }

    @media (max-width: 768px) {
        .process-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="site-main rwx-services-archive" id="main-content">

    <!-- ── Page Hero ─────────────────────────────────────────────── -->
    <section class="page-hero" aria-label="Our recovery services">
        <div class="page-hero__inner">
            <div class="rwx-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <svg viewBox="0 0 24 24" width="10" height="10" stroke="currentColor" stroke-width="3" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
                <span>Services</span>
            </div>
            <h1 class="page-hero__title">
                Restoration <em>Specializations</em>
            </h1>
            <p class="page-hero__desc">
                Precision structural property recovery. Our expert rapid response units deploy 24/7/365 to stabilize and mitigate property damage.
            </p>
        </div>
    </section>

    <!-- ── Services Grid ─────────────────────────────────────────── -->
    <section class="services-grid-section" aria-label="Tactical services overview">
        <div class="grid-container">
            <?php
            // Explicit query — not affected by Reading Settings or pre_get_posts
            $services_query = new WP_Query([
                'post_type'      => 'service',
                'post_status'    => 'publish',
                'posts_per_page' => -1,          // retrieve all services
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'no_found_rows'  => true,
            ]);

            if ($services_query->have_posts()): ?>

                <div class="services-grid">
                    <?php 
                    $index = 1;
                    while ($services_query->have_posts()):
                        $services_query->the_post();
                        $title = get_the_title();
                        $price = get_post_meta(get_the_ID(), '_service_price', true);
                        
                        // Smart Title splitting for red brand spans
                        $words = explode(' ', $title, 2);
                        if (count($words) > 1) {
                            $formatted_title = esc_html($words[0]) . ' <span>' . esc_html($words[1]) . '</span>';
                        } else {
                            $formatted_title = '<span>' . esc_html($title) . '</span>';
                        }

                        // Parse excerpt or content fallback
                        $excerpt = get_post_field('post_excerpt', get_the_ID());
                        $content = get_post_field('post_content', get_the_ID());
                        if ($excerpt) {
                            $desc = wp_trim_words($excerpt, 20);
                        } elseif ($content) {
                            $desc = wp_trim_words(strip_shortcodes(wp_strip_all_tags($content)), 20);
                        } else {
                            $desc = 'Strategic recovery operations conducted with technical surgical precision to restore structural safety and property equity.';
                        }

                        // Determine Lucide Icon based on Meta or Title
                        $meta_icon = get_post_meta(get_the_ID(), '_service_icon', true);
                        $has_lucide = false;
                        $lucide_name = '';

                        if ($meta_icon) {
                            if (in_array(strtolower($meta_icon), ['droplets', 'flame', 'shield-alert', 'cloud-lightning', 'hammer', 'zap', 'shield', 'activity'])) {
                                $has_lucide = true;
                                $lucide_name = strtolower($meta_icon);
                            }
                        }

                        if (!$has_lucide) {
                            $title_lower = strtolower($title);
                            if (strpos($title_lower, 'water') !== false || strpos($title_lower, 'flood') !== false || strpos($title_lower, 'extract') !== false) {
                                $lucide_name = 'droplets';
                            } elseif (strpos($title_lower, 'fire') !== false || strpos($title_lower, 'soot') !== false || strpos($title_lower, 'smoke') !== false) {
                                $lucide_name = 'flame';
                            } elseif (strpos($title_lower, 'mold') !== false || strpos($title_lower, 'spore') !== false) {
                                $lucide_name = 'shield-alert';
                            } elseif (strpos($title_lower, 'storm') !== false || strpos($title_lower, 'wind') !== false || strpos($title_lower, 'weather') !== false || strpos($title_lower, 'lightning') !== false) {
                                $lucide_name = 'cloud-lightning';
                            } elseif (strpos($title_lower, 'build') !== false || strpos($title_lower, 'reconstruct') !== false || strpos($title_lower, 'repair') !== false || strpos($title_lower, 'contract') !== false) {
                                $lucide_name = 'hammer';
                            } else {
                                $lucide_name = 'activity';
                            }
                        }

                        // Dynamically map features
                        $features_meta = get_post_meta(get_the_ID(), '_service_features', true);
                        $features = [];
                        if (!empty($features_meta)) {
                            if (is_array($features_meta)) {
                                $features = $features_meta;
                            } else {
                                $features = array_filter(array_map('trim', explode("\n", $features_meta)));
                            }
                        }
                        if (empty($features)) {
                            $title_lower = strtolower($title);
                            if (strpos($title_lower, 'water') !== false || strpos($title_lower, 'flood') !== false || strpos($title_lower, 'extract') !== false) {
                                $features = ['Rapid Extraction', 'Structural Drying', 'Humidity Control'];
                            } elseif (strpos($title_lower, 'fire') !== false || strpos($title_lower, 'soot') !== false || strpos($title_lower, 'smoke') !== false) {
                                $features = ['Char Removal', 'Air Purification', 'Debris Recovery'];
                            } elseif (strpos($title_lower, 'mold') !== false || strpos($title_lower, 'spore') !== false) {
                                $features = ['Containment', 'HEPA Filtration', 'Anti-Microbial'];
                            } elseif (strpos($title_lower, 'storm') !== false || strpos($title_lower, 'wind') !== false || strpos($title_lower, 'weather') !== false || strpos($title_lower, 'lightning') !== false) {
                                $features = ['Board Up', 'Tarping', 'Tree Removal'];
                            } else {
                                $features = ['Surgical Mitigation', 'Direct Insurance Billing', '45-Min Deployment'];
                            }
                        }
                        ?>
                        <?php
                        $thumb_url = rwx_get_service_image_url(get_the_ID());
                        ?>
                        <a href="<?php the_permalink(); ?>" class="service-card reveal">
                            <div class="card-image-wrap">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>" class="card-img">
                                <div class="card-number"><?php echo sprintf('%02d', $index++); ?></div>
                            </div>
                            
                            <div class="card-info">
                                <div class="card-icon"><i data-lucide="<?php echo esc_attr($lucide_name); ?>" size="20"></i></div>
                                <h3><?php echo $formatted_title; ?></h3>
                                <p><?php echo esc_html($desc); ?></p>
                                
                                <ul class="card-list">
                                    <?php foreach (array_slice($features, 0, 3) as $feature): ?>
                                        <li>
                                            <i data-lucide="check-circle" size="14"></i>
                                            <?php echo esc_html($feature); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                
                                <div class="card-brief-link">
                                    Access Briefing 
                                    <i data-lucide="arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>

            <?php else: ?>
                <p style="text-align:center;padding:4rem 0;font-family:var(--font-mono, 'Space Mono', monospace);font-size:1.1rem;color:var(--brand, #ff0000);">
                    NO ACTIVE PROTOCOLS FOUND. <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color:white; text-decoration:underline;">INITIATE MANUAL EMERGENCY DISPATCH.</a>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- ── The Deployment Protocol (Process) ────────────────────────── -->
    <section class="process-section" id="process" aria-label="Deployment steps">
        <div class="grid-container">
            <div class="process-header">
                <span class="section-label">Our Recovery Process</span>
                <h2>Our Proven <em>Restoration Process</em></h2>
            </div>
            
            <div class="process-grid">
                <!-- Step 01 -->
                <div class="process-step">
                    <div class="step-number">01</div>
                    <div class="step-content">
                        <div class="step-icon-wrap">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.68 2.81a2 2 0 0 1-.45 2.11L7.91 9.27a16 16 0 0 0 6.29 6.29l1.45-1.45a2 2 0 0 1 2.11-.45c.91.32 1.85.55 2.81.68A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <h4>01. Dispatch</h4>
                        <p>24/7 Emergency Dispatch gathers details and activates local mitigation specialists within 15 minutes.</p>
                    </div>
                </div>

                <!-- Step 02 -->
                <div class="process-step">
                    <div class="step-number">02</div>
                    <div class="step-content">
                        <div class="step-icon-wrap">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon><line x1="9" y1="3" x2="9" y2="18"></line><line x1="15" y1="6" x2="15" y2="21"></line></svg>
                        </div>
                        <h4>02. Assessment</h4>
                        <p>Rapid deployment on-site within 45 minutes for moisture mapping, hazard appraisal, and structural scanning.</p>
                    </div>
                </div>

                <!-- Step 03 -->
                <div class="process-step">
                    <div class="step-number">03</div>
                    <div class="step-content">
                        <div class="step-icon-wrap">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <h4>03. Mitigation</h4>
                        <p>Execute containment barriers, start thermal water extraction, air filtration, and secure absolute stabilization.</p>
                    </div>
                </div>

                <!-- Step 04 -->
                <div class="process-step">
                    <div class="step-number">04</div>
                    <div class="step-content">
                        <div class="step-icon-wrap">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                        </div>
                        <h4>04. Build Back</h4>
                        <p>Complete turnkey general contracting reconstructive repairs back to absolute pre-loss structural perfection.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

</main>

<?php get_footer(); ?>