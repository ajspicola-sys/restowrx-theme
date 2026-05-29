<?php
/**
 * Template Name: Team
 * Restowrx Elite — Meet Our Restoration Specialists
 * Pulls team members from the team_member custom post type
 */
get_header(); ?>

<main class="site-main" id="main-content" style="background:#050505; color:#ffffff; font-family:var(--font-main, 'Inter', sans-serif); overflow-x:hidden;">

    <!-- ════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════ -->
    <section class="page-hero" aria-label="Our team">
        <div class="page-hero__bg" aria-hidden="true">
            <div class="page-hero__scanline"></div>
            <div class="page-hero__grid"></div>
        </div>
        <div class="page-hero__inner reveal">
            <span class="section__label">Restoration Specialists</span>
            <h1 class="page-hero__title">Meet the Team</h1>
            <p class="page-hero__desc">IICRC certified damage restoration specialists and rapid recovery experts dedicated to absolute pre-loss precision.</p>
        </div>
    </section>

    <style>
    .page-hero {
        position: relative;
        padding: clamp(140px, 12vw, 180px) 0 clamp(50px, 5vw, 80px) 0;
        background: #000;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 0, 0, 0.15);
        text-align: center;
    }
    .page-hero__bg {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, rgba(18, 3, 3, 0.4) 0%, #000 100%);
        z-index: 1;
    }
    .page-hero__scanline {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 50%, rgba(255, 0, 0, 0.02) 50%);
        background-size: 100% 4px;
        pointer-events: none;
    }
    .page-hero__grid {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(to right, rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
    }
    .page-hero__inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
    }
    .page-hero__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.5rem, 6vw, 6rem);
        text-transform: uppercase;
        color: white;
        margin: 0 0 20px 0;
        letter-spacing: 1px;
    }
    .page-hero__desc {
        color: #aaa;
        font-size: clamp(1rem, 1.2vw, 1.25rem);
        line-height: 1.7;
        margin: 0 auto;
        max-width: 650px;
    }
    </style>

    <section class="team-full">
        <div class="section__inner">
            <div class="team-full__grid">

                <?php
                $team = new WP_Query([
                    'post_type'      => 'team_member',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                ]);

                $count = 0;
                if ($team->have_posts()) :
                    while ($team->have_posts()) : $team->the_post();
                        $role        = get_post_meta(get_the_ID(), '_team_role', true);
                        $credentials = get_post_meta(get_the_ID(), '_team_credentials', true);
                        $specialties = get_post_meta(get_the_ID(), '_team_specialties', true);
                        $count++;
                        $reverse = ($count % 2 === 0) ? ' team-member--reverse' : '';

                        // Get initials for placeholder
                        $name_parts = explode(' ', get_the_title());
                        $initials = '';
                        foreach ($name_parts as $part) {
                            $clean = preg_replace('/[^A-Za-z]/', '', $part);
                            if ($clean) $initials .= strtoupper($clean[0]);
                        }
                        $initials = substr($initials, 0, 2);
                ?>
                    <article class="team-member<?php echo $reverse; ?> reveal">
                        <div class="team-member__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', [
                                    'loading'  => $count <= 2 ? 'eager' : 'lazy',
                                    'decoding' => 'async',
                                ]); ?>
                            <?php else : ?>
                                <div class="team-card__placeholder team-card__placeholder--lg" aria-hidden="true"><?php echo esc_html($initials); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="team-member__info">
                            <h2 class="team-member__name"><?php the_title(); ?></h2>
                            <?php if ($role) : ?>
                                <span class="team-member__role"><?php echo esc_html($role); ?></span>
                            <?php endif; ?>

                            <?php if ($credentials) :
                                $badges = array_map('trim', explode(',', $credentials));
                            ?>
                                <div class="team-member__credentials">
                                    <?php foreach ($badges as $badge) : ?>
                                        <span class="team-member__badge"><?php echo esc_html($badge); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (get_the_content()) : ?>
                                <div class="team-member__bio">
                                    <?php the_content(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($specialties) :
                                $specs = array_map('trim', explode(',', $specialties));
                            ?>
                                <div class="team-member__specialties">
                                    <?php foreach ($specs as $spec) : ?>
                                        <span class="team-member__specialty"><?php echo esc_html($spec); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>

                <?php endwhile; wp_reset_postdata();
                else : ?>
                    <div class="empty-state">
                        <p class="empty-state__text">Incident commanders coming soon! Add them in <strong>WordPress Admin → Team</strong>.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <style>
    .team-full {
        padding: clamp(4rem, 6vw, 7rem) 0;
        background: #050505;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    .section__inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 1rem + 2vw, 3rem);
    }
    .team-full__grid {
        display: flex;
        flex-direction: column;
        gap: 60px;
    }
    .team-member {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        align-items: center;
        background: #0a0a0a;
        border: 1px solid rgba(255,255,255,0.03);
        padding: 40px;
        border-radius: 4px;
        transition: border-color 0.3s ease;
    }
    .team-member:hover {
        border-color: var(--brand, #ff0000);
    }
    .team-member--reverse {
        grid-template-columns: 1.5fr 1fr;
    }
    .team-member--reverse .team-member__image {
        order: 2;
    }
    .team-member--reverse .team-member__info {
        order: 1;
    }
    .team-member__image {
        width: 100%;
        aspect-ratio: 1/1;
        overflow: hidden;
        border-radius: 4px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        background: #000;
    }
    .team-member__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .team-card__placeholder {
        width: 100%; height: 100%;
        background: radial-gradient(circle, #200202 0%, #000000 100%);
        color: var(--brand, #ff0000);
        display: flex; align-items: center; justify-content: center;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 5rem;
    }
    .team-member__name {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 2.5rem;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 0 10px 0;
        line-height: 1;
    }
    .team-member__role {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .team-member__credentials {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }
    .team-member__badge {
        font-size: 0.65rem;
        font-family: var(--font-mono, 'Space Mono', monospace);
        background: rgba(255, 0, 0, 0.08);
        border: 1px solid rgba(255, 0, 0, 0.2);
        color: var(--brand, #ff0000);
        padding: 4px 10px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .team-member__bio {
        color: #aaa;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 25px;
    }
    .team-member__specialties {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .team-member__specialty {
        font-size: 0.75rem;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #888;
        padding: 4px 12px;
        border-radius: 4px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    @media (max-width: 900px) {
        .team-member, .team-member--reverse {
            grid-template-columns: 1fr;
            padding: 30px;
        }
        .team-member--reverse .team-member__image {
            order: 1;
        }
        .team-member--reverse .team-member__info {
            order: 2;
        }
    }
    </style>

    <section class="cta-section" aria-label="Book with us">
        <div class="cta-section__inner reveal">
            <span class="cta-section__label">24/7 Rapid Response</span>
            <h2 class="cta-section__title">Ready to Begin?<br>Request Emergency Service</h2>
            <p class="cta-section__text" style="color:#aaa;">Coordinate insurance claims. We'll dispatch a specialized mitigation response team to your property immediately.</p>
            <div class="cta-section__actions">
                <a href="/contact/" class="btn btn--primary btn--lg" style="font-family:var(--font-accent); font-size:1.3rem; letter-spacing:1px; padding:10px 30px;">Request Service</a>
            </div>
        </div>
    </section>

    <style>
    .cta-section {
        position: relative;
        background: radial-gradient(circle at 50% 50%, #200202 0%, #000 100%);
        padding: clamp(60px, 10vw, 120px) 0;
        text-align: center;
        border-top: 1px solid rgba(255,0,0,0.2);
    }
    .cta-section__inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
    }
    .cta-section__label {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.8rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .cta-section__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        line-height: 0.95;
        margin: 0 0 15px 0;
    }
    .cta-section__text {
        margin-bottom: 30px;
        line-height: 1.6;
    }
    .cta-section__actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    </style>

</main>

<?php get_footer(); ?>
