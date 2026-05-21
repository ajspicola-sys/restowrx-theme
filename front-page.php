<?php
/**
 * Template Name: Homepage
 * Spicola Construction — Front Page v1
 */
get_header(); ?>

<main class="site-main" id="main-content">

<!-- ── Structured Data ── -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": ["GeneralContractor", "HomeAndConstructionBusiness", "LocalBusiness"],
    "@id": "<?php echo esc_url(home_url('/')); ?>#business",
    "name": "Spicola Construction",
    "description": "Tampa Bay's trusted general contractor — expert residential and commercial construction, remodeling, roofing, and renovation services.",
    "url": "<?php echo esc_url(home_url('/')); ?>",
    "telephone": "+18137326285",
    "email": "info@spicolaconstruction.com",
    "priceRange": "$$-$$$",
    "address": { "@type": "PostalAddress", "addressLocality": "Tampa", "addressRegion": "FL", "addressCountry": "US" },
    "areaServed": [
        {"@type":"City","name":"Tampa"},{"@type":"City","name":"St. Petersburg"},
        {"@type":"City","name":"Clearwater"},{"@type":"City","name":"Brandon"},
        {"@type":"City","name":"Wesley Chapel"},{"@type":"City","name":"Riverview"}
    ],
    "aggregateRating": {"@type":"AggregateRating","ratingValue":"5","reviewCount":"50","bestRating":"5"},
    "sameAs": ["https://www.facebook.com/spicolaconstruction/","https://www.instagram.com/spicolaconstruction/"]
}
</script>

<!-- ══════════════════════════════════════════════════════
     HERO — Full-screen brand hero
     ══════════════════════════════════════════════════════ -->
<section class="sc-hero" id="hero" aria-label="Spicola Construction — Tampa Bay's trusted general contractor">
    <div class="sc-hero__glow"     aria-hidden="true"></div>
    <div class="sc-hero__grid-bg" aria-hidden="true"></div>
    <div class="sc-hero__inner">
        <span class="sc-hero__label">Tampa Bay's Trusted General Contractor</span>
        <h1 class="sc-hero__title">
            Building Tampa Bay's<br>
            <em>Future</em>, One Project<br>
            at a Time.
        </h1>
        <p class="sc-hero__sub">
            Licensed &amp; insured residential and commercial construction,
            remodeling, roofing, and renovation services across
            Hillsborough, Pinellas &amp; Pasco counties.
        </p>
        <div class="sc-hero__actions">
            <a href="tel:+18137326285" class="sc-hero__btn sc-hero__btn--primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                Call (813) 732-6285
            </a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="sc-hero__btn sc-hero__btn--ghost">
                Get a Free Quote →
            </a>
        </div>
        <div class="sc-hero__badges">
            <span class="sc-hero__badge">✔ Licensed CGC</span>
            <span class="sc-hero__badge">✔ Fully Insured</span>
            <span class="sc-hero__badge">✔ 10+ Years Experience</span>
            <span class="sc-hero__badge">✔ Free Estimates</span>
        </div>
    </div>
</section>

<style>
/* ── Hero ── */
.sc-hero{position:relative;min-height:700px;display:flex;align-items:center;justify-content:center;background:radial-gradient(ellipse at 50% 50%,#1a2d45 0%,#0A1628 70%);overflow:hidden;padding:clamp(6rem,10vw,10rem) 0 clamp(4rem,6vw,7rem)}
.sc-hero__glow{position:absolute;inset:0;background:radial-gradient(circle at 50% 40%,rgba(46,143,232,.22) 0%,transparent 60%);pointer-events:none}
.sc-hero__grid-bg{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:60px 60px;pointer-events:none}
.sc-hero__inner{position:relative;z-index:1;max-width:900px;margin:0 auto;padding:0 clamp(1.25rem,1rem + 2vw,3rem);text-align:center}
.sc-hero__label{display:inline-block;font-family:'Montserrat',sans-serif;font-size:.7rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;color:#2E8FE8;margin-bottom:1.5rem;padding-bottom:.6rem;position:relative}
.sc-hero__label::after{content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);height:3px;width:100%;background:linear-gradient(90deg,transparent,#2E8FE8,transparent);border-radius:2px}
.sc-hero__title{font-family:'Montserrat',sans-serif;font-size:clamp(2.6rem,5.5vw,5rem);font-weight:900;color:#fff;line-height:1.1;margin:0 0 1.5rem;letter-spacing:-.02em}
.sc-hero__title em{font-style:normal;color:#2E8FE8}
.sc-hero__sub{font-size:clamp(1rem,1.4vw,1.2rem);color:rgba(255,255,255,.55);line-height:1.75;max-width:620px;margin:0 auto 2.5rem}
.sc-hero__actions{display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;margin-bottom:2.5rem}
.sc-hero__btn{display:inline-flex;align-items:center;gap:.6rem;font-family:'Montserrat',sans-serif;font-size:.95rem;font-weight:700;letter-spacing:.04em;text-decoration:none;padding:.9rem 2rem;border-radius:10px;transition:all .35s ease}
.sc-hero__btn--primary{background:#1A6FBF;color:#fff;border:2px solid #1A6FBF;box-shadow:0 4px 20px rgba(26,111,191,.35)}
.sc-hero__btn--primary:hover{background:#155fa0;border-color:#155fa0;color:#fff;box-shadow:0 8px 32px rgba(26,111,191,.55);transform:translateY(-2px)}
.sc-hero__btn--ghost{background:transparent;color:rgba(255,255,255,.9);border:2px solid rgba(255,255,255,.25)}
.sc-hero__btn--ghost:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.5);color:#fff;transform:translateY(-2px)}
.sc-hero__badges{display:flex;flex-wrap:wrap;justify-content:center;gap:.75rem}
.sc-hero__badge{font-size:.72rem;font-weight:600;color:rgba(255,255,255,.55);background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:30px;padding:.4rem 1rem;letter-spacing:.04em;transition:color .3s,border-color .3s}
.sc-hero__badge:hover{color:rgba(255,255,255,.85);border-color:rgba(255,255,255,.25)}
@media(max-width:600px){.sc-hero__title{font-size:clamp(2.2rem,9vw,3.2rem)}.sc-hero__actions{flex-direction:column;align-items:center}}
</style>

<!-- ══════════════════════════════════════════════════════
     SLIM CTA BAR — White strip above services
     ══════════════════════════════════════════════════════ -->
<section class="sc-hero-slim" aria-label="Quick call to action">
    <div class="sc-hero-slim__inner">
        <p class="sc-hero-slim__text">Ready to start your next project?
            <a href="tel:+18137326285" class="sc-hero-slim__highlight">Give us a call →</a>
        </p>
    </div>
</section>

<style>
.sc-hero-slim{background:#fff;padding:1.5rem 0;border-bottom:1px solid rgba(34,45,63,.06)}
.sc-hero-slim__inner{max-width:1280px;margin:0 auto;padding:0 clamp(1.25rem,1rem + 2vw,3rem);text-align:center}
.sc-hero-slim__text{font-family:'Montserrat',sans-serif;font-size:clamp(1rem,1.2vw,1.15rem);font-weight:600;color:var(--brand-navy,#222D3F);margin:0;letter-spacing:.01em}
.sc-hero-slim__highlight{color:#fff;background:var(--brand,#F22F3A);padding:.45rem 1.2rem;border-radius:8px;text-decoration:none;font-weight:700;margin-left:.5rem;display:inline-block;transition:all .3s ease;box-shadow:0 2px 12px rgba(242,47,58,.25)}
.sc-hero-slim__highlight:hover{background:var(--brand-dark,#AF2D37);color:#fff;box-shadow:0 4px 20px rgba(242,47,58,.45);transform:translateY(-1px)}
</style>

<!-- ══════════════════════════════════════════════════════
     SERVICES — Dark navy, image card carousel
     ══════════════════════════════════════════════════════ -->
<section class="sc-services" id="services" aria-label="Our construction services">
    <div class="sc-services__inner">

        <!-- Section header -->
        <div class="sc-services__header">
            <div class="sc-services__header-left">
                <span class="sc-services__label">WHAT WE DO</span>
                <h2 class="sc-services__title">Built for <em>Commercial</em><br>& <em>Residential</em></h2>
                <p class="sc-services__subtitle">From concept to completion — every project backed by decades of Florida construction experience.</p>
            </div>
            <div class="sc-services__header-right">
                <div class="sc-services__stats">
                    <div class="sc-services__stat">
                        <span class="sc-services__stat-num">250+</span>
                        <span class="sc-services__stat-label">Projects Completed</span>
                    </div>
                    <div class="sc-services__stat">
                        <span class="sc-services__stat-num">10+</span>
                        <span class="sc-services__stat-label">Years Experience</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="sc-services__view-all">Explore All Services <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg></a>
            </div>
        </div>

        <?php
        $services = new WP_Query([
            'post_type'      => 'service',
            'posts_per_page' => 8,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ]);
        $fallback = [
            ['title' => 'Commercial Services',      'desc' => 'Office build-outs, retail spaces, and commercial projects built to your specs.'],
            ['title' => 'Residential',               'desc' => 'Custom homes and residential builds from foundation to finish.'],
            ['title' => 'Hospitality Services',      'desc' => 'Restaurants, hotels, and venues crafted for guest experiences.'],
            ['title' => 'Remodeling & Renovations',  'desc' => 'Kitchen, bath, and whole-home transformations with premium finishes.'],
            ['title' => 'Roofing',                   'desc' => 'New roofs, repairs, and replacements for Florida weather.'],
            ['title' => 'Concrete & Foundation',     'desc' => 'Driveways, patios, slabs, and structural foundations.'],
        ];
        $has_posts = $services->have_posts();
        $card_count = $has_posts ? $services->post_count : count($fallback);
        ?>

        <div class="sc-services__carousel">
            <button class="sc-services__arrow sc-services__arrow--prev" id="svc-prev" aria-label="Previous"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m15 18-6-6 6-6"/></svg></button>
            <div class="sc-services__track-wrap">
                <div class="sc-services__track" id="svc-track">
                    <?php if ($has_posts) :
                        $i = 0; while ($services->have_posts()) : $services->the_post();
                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        $excerpt = wp_trim_words(get_the_excerpt(), 12); ?>
                    <a href="<?php the_permalink(); ?>" class="sc-services__card">
                        <span class="sc-services__card-num"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                        <div class="sc-services__card-img">
                            <?php if ($thumb) : ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
                            <?php else : ?><div class="sc-services__card-placeholder" style="background:linear-gradient(135deg,hsl(<?php echo 215+$i*20;?>,35%,22%) 0%,hsl(<?php echo 215+$i*20;?>,25%,35%) 100%);"></div><?php endif; ?>
                            <div class="sc-services__card-overlay"><span class="sc-services__card-cta">View Service →</span></div>
                        </div>
                        <div class="sc-services__card-body">
                            <h3 class="sc-services__card-title"><?php the_title(); ?> <svg class="sc-services__card-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg></h3>
                            <p class="sc-services__card-desc"><?php echo esc_html($excerpt); ?></p>
                        </div>
                    </a>
                    <?php $i++; endwhile; wp_reset_postdata(); else :
                        foreach ($fallback as $i => $svc) : ?>
                    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="sc-services__card">
                        <span class="sc-services__card-num"><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                        <div class="sc-services__card-img">
                            <div class="sc-services__card-placeholder" style="background:linear-gradient(135deg,hsl(<?php echo 215+$i*20;?>,35%,22%) 0%,hsl(<?php echo 215+$i*20;?>,25%,35%) 100%);"></div>
                            <div class="sc-services__card-overlay"><span class="sc-services__card-cta">View Service →</span></div>
                        </div>
                        <div class="sc-services__card-body">
                            <h3 class="sc-services__card-title"><?php echo esc_html($svc['title']); ?> <svg class="sc-services__card-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg></h3>
                            <p class="sc-services__card-desc"><?php echo esc_html($svc['desc']); ?></p>
                        </div>
                    </a>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <button class="sc-services__arrow sc-services__arrow--next" id="svc-next" aria-label="Next"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg></button>
        </div>

        <div class="sc-services__dots" id="svc-dots">
            <?php for ($d = 0; $d < max(1, $card_count - 2); $d++) : ?>
                <button class="sc-services__dot<?php echo $d === 0 ? ' active' : ''; ?>" data-idx="<?php echo $d; ?>" aria-label="Slide <?php echo $d+1; ?>"></button>
            <?php endfor; ?>
        </div>
    </div>
</section>
<style>
.sc-services{background:radial-gradient(ellipse at 50% 50%,#1a2d45 0%,#0A1628 70%);padding:clamp(4rem,6vw,7rem) 0;position:relative;overflow:hidden}
.sc-services::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 50% 50%,rgba(24,55,93,.4) 0%,transparent 65%);pointer-events:none}
.sc-services::after{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:60px 60px;pointer-events:none}
.sc-services__inner{max-width:1280px;margin:0 auto;padding:0 clamp(1.25rem,1rem + 2vw,3rem);position:relative;z-index:1}
.sc-services__header{display:flex;justify-content:space-between;align-items:flex-start;gap:3rem;margin-bottom:clamp(3rem,5vw,4rem)}
.sc-services__header-left{flex:1;max-width:540px}
.sc-services__header-right{flex:0 0 auto;padding-top:.5rem;display:flex;flex-direction:column;align-items:center;gap:2rem}
.sc-services__label{display:inline-block;font-size:.7rem;font-weight:700;letter-spacing:.25em;text-transform:uppercase;color:var(--brand,#F22F3A);margin-bottom:1rem;padding-bottom:.6rem;position:relative}
.sc-services__label::after{content:'';position:absolute;bottom:0;left:0;height:3px;width:100%;background:linear-gradient(90deg,var(--brand,#F22F3A),rgba(242,47,58,.3));border-radius:2px;animation:sc-label-pulse 2.5s ease-in-out infinite}
@keyframes sc-label-pulse{0%,100%{opacity:1;transform:scaleX(1)}50%{opacity:.6;transform:scaleX(.85)}}
.sc-services__title{font-family:'Montserrat',sans-serif;font-size:clamp(2rem,3vw,3rem);font-weight:800;color:#fff;line-height:1.15;margin:0}
.sc-services__title em{font-style:normal;color:var(--brand,#F22F3A)}
.sc-services__subtitle{color:rgba(255,255,255,.5);font-size:.95rem;line-height:1.7;margin:.75rem 0 0;max-width:420px}
/* Stats row */
.sc-services__stats{display:flex;gap:2.5rem}
.sc-services__stat{display:flex;flex-direction:column;align-items:center}
.sc-services__stat-num{font-family:'Montserrat',sans-serif;font-size:1.8rem;font-weight:800;color:#fff;line-height:1}
.sc-services__stat-label{font-size:.7rem;font-weight:600;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.1em;margin-top:.35rem}
/* CTA button */
.sc-services__view-all{display:inline-flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.9);font-size:.8rem;font-weight:700;text-decoration:none;letter-spacing:.08em;text-transform:uppercase;padding:.75rem 1.75rem;background:transparent;border:2px solid rgba(255,255,255,.2);border-radius:8px;transition:all .35s ease}
.sc-services__view-all:hover{background:#F22F3A;border-color:#F22F3A;color:#fff;box-shadow:0 0 25px rgba(242,47,58,.5),0 0 60px rgba(242,47,58,.2);transform:translateY(-2px);letter-spacing:.1em}
.sc-services__view-all svg{transition:transform .3s}
.sc-services__view-all:hover svg{transform:translateX(3px)}
.sc-services__carousel{position:relative;display:flex;align-items:center;gap:1.25rem}
.sc-services__track-wrap{flex:1;overflow:hidden;padding:2.5rem 0 3rem;margin:-2.5rem 0 -3rem}
.sc-services__track{display:flex;gap:1.5rem;will-change:transform}
.sc-services__track.is-sliding{transition:transform .55s cubic-bezier(.22,1,.36,1)}
.sc-services__arrow{flex-shrink:0;width:48px;height:48px;border-radius:50%;border:2px solid rgba(255,255,255,.2);background:rgba(255,255,255,.04);color:rgba(255,255,255,.7);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .3s ease;backdrop-filter:blur(4px);position:relative;overflow:hidden}
.sc-services__arrow::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,var(--brand,#F22F3A),#F22F3A);opacity:0;transition:opacity .3s ease;border-radius:50%}
.sc-services__arrow:hover{border-color:var(--brand,#F22F3A);color:#fff;transform:scale(1.1);box-shadow:0 6px 20px rgba(242,47,58,.35)}
.sc-services__arrow:hover::before{opacity:1}
.sc-services__arrow svg{position:relative;z-index:1}
.sc-services__card{flex:0 0 calc(33.333% - 1rem);min-width:calc(33.333% - 1rem);text-decoration:none;display:flex;flex-direction:column;border-radius:14px;overflow:hidden;background:#fff;border:1px solid rgba(255,255,255,.06);position:relative;transition:transform .5s cubic-bezier(.22,1,.36,1),box-shadow .5s ease,border-color .3s,opacity .4s ease,filter .4s ease}
.sc-services__card:hover{transform:translateY(-6px) scale(1.02);box-shadow:0 12px 24px rgba(0,0,0,.25);border-color:rgba(242,47,58,.3)}
.sc-services__card-num{position:absolute;top:12px;left:16px;z-index:5;font-family:'Montserrat',sans-serif;font-size:.7rem;font-weight:800;color:#fff;background:var(--brand,#F22F3A);padding:4px 10px;border-radius:6px;letter-spacing:.05em;box-shadow:0 4px 12px rgba(242,47,58,.35);transition:transform .3s ease}
.sc-services__card:hover .sc-services__card-num{transform:translateY(-2px) scale(1.05)}
.sc-services__card.is-center{transform:scale(1.06);box-shadow:0 10px 30px rgba(0,0,0,.3),0 0 40px rgba(242,47,58,.08);border-color:rgba(242,47,58,.25);z-index:2;opacity:1;filter:brightness(1)}
.sc-services__card.is-center:hover{transform:scale(1.08) translateY(-4px);box-shadow:0 14px 32px rgba(0,0,0,.3),0 0 50px rgba(242,47,58,.1)}
.sc-services__card.is-side{opacity:.5;filter:brightness(.65);transform:scale(.93)}
.sc-services__card.is-side:hover{opacity:.8;filter:brightness(.8);transform:scale(.95) translateY(-4px)}
.sc-services__card-img{width:100%;aspect-ratio:3/4;overflow:hidden;position:relative}
.sc-services__card-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s cubic-bezier(.22,1,.36,1)}
.sc-services__card:hover .sc-services__card-img img{transform:scale(1.08)}
.sc-services__card-placeholder{width:100%;height:100%;transition:transform .6s cubic-bezier(.22,1,.36,1)}
.sc-services__card:hover .sc-services__card-placeholder{transform:scale(1.08)}
.sc-services__card-overlay{position:absolute;inset:0;background:linear-gradient(180deg,transparent 30%,rgba(242,47,58,.85) 100%);display:flex;align-items:flex-end;justify-content:center;padding-bottom:1.5rem;opacity:0;transition:opacity .35s ease}
.sc-services__card:hover .sc-services__card-overlay{opacity:1}
.sc-services__card-cta{color:#fff;font-size:.78rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.6rem 1.5rem;background:transparent;border:2px solid rgba(255,255,255,.3);border-radius:8px;transition:all .35s ease}
.sc-services__card:hover .sc-services__card-cta{transform:translateY(-4px);background:#F22F3A;border-color:#F22F3A;box-shadow:0 0 20px rgba(242,47,58,.5),0 0 50px rgba(242,47,58,.2);letter-spacing:.12em}
.sc-services__card-body{padding:1.25rem 1.25rem 1.5rem;background:#fff;border-top:none}
.sc-services__card-title{font-family:'Montserrat',sans-serif;font-size:1rem;font-weight:700;color:var(--brand-navy,#222D3F);margin:0 0 .4rem;line-height:1.3;display:flex;align-items:center;gap:.4rem}
.sc-services__card-arrow{opacity:.3;transition:opacity .3s,transform .3s;flex-shrink:0;stroke:var(--brand-navy,#222D3F)}
.sc-services__card:hover .sc-services__card-arrow{opacity:1;transform:translateX(3px);stroke:var(--brand,#F22F3A)}
.sc-services__card-desc{font-size:.82rem;color:rgba(34,45,63,.55);line-height:1.55;margin:0}
.sc-services__dots{display:flex;justify-content:center;gap:.5rem;margin-top:3.5rem}
.sc-services__dot{width:10px;height:10px;border-radius:50%;border:none;background:rgba(255,255,255,.15);cursor:pointer;transition:all .3s ease;padding:0}
.sc-services__dot:hover{background:rgba(255,255,255,.35)}
.sc-services__dot.active{background:var(--brand,#F22F3A);width:28px;border-radius:5px;box-shadow:0 0 8px rgba(242,47,58,.4)}
@media(max-width:900px){.sc-services__header{flex-direction:column;gap:1.5rem}.sc-services__header-right{align-items:flex-start;flex-direction:row;gap:1.5rem;width:100%}.sc-services__stats{gap:2rem}.sc-services__card{flex:0 0 calc(50% - .75rem);min-width:calc(50% - .75rem)}.sc-services__card-num{font-size:.65rem}}
@media(max-width:600px){.sc-services__card{flex:0 0 88%;min-width:88%}.sc-services__arrow{width:38px;height:38px}.sc-services__card-body{padding:1rem}}
</style>
<script>
(function(){
    var t = document.getElementById('svc-track');
    if (!t) return;
    var orig = Array.from(t.children);
    var n = orig.length;
    if (!n) return;
    var dots = document.querySelectorAll('.sc-services__dot');
    var autoTimer, busy = false;

    function gv() { return innerWidth > 900 ? 3 : innerWidth > 600 ? 2 : 1; }
    var v = gv();

    /* Clone v cards to each end */
    for (var k = 0; k < v; k++) {
        var a = orig[k].cloneNode(true);
        a.setAttribute('aria-hidden','true');
        t.appendChild(a);
    }
    for (var k = v - 1; k >= 0; k--) {
        var b = orig[n - 1 - k].cloneNode(true);
        b.setAttribute('aria-hidden','true');
        t.insertBefore(b, t.firstChild);
    }

    var c = t.children;
    var i = v;

    function w() { return c[0].offsetWidth + (parseFloat(getComputedStyle(t).gap) || 24); }

    function cls() {
        var mid = i + Math.floor(v / 2);
        for (var j = 0; j < c.length; j++) {
            c[j].classList.remove('is-center','is-side');
            if (v >= 3) {
                if (j === mid) c[j].classList.add('is-center');
                else if (j >= i && j < i + v) c[j].classList.add('is-side');
            }
        }
    }

    function pos(anim) {
        if (!anim) t.classList.remove('is-sliding');
        else t.classList.add('is-sliding');
        t.style.transform = 'translateX(-' + (i * w()) + 'px)';
        cls();
        var real = ((i - v) % n + n) % n;
        dots.forEach(function(d, x) { d.classList.toggle('active', x === real); });
    }

    /* Listen for transition end to snap clones */
    t.addEventListener('transitionend', function(e) {
        if (e.target !== t) return;
        if (i >= n + v) { i = v; pos(false); }
        else if (i < v)  { i = n + v - 1; pos(false); }
        busy = false;
    });

    function go(dir) {
        if (busy) return;
        busy = true;
        i += dir;
        pos(true);
    }

    function startAuto() { autoTimer = setInterval(function(){ go(1); }, 4500); }
    function stopAuto() { clearInterval(autoTimer); }

    document.getElementById('svc-prev').onclick = function() { stopAuto(); go(-1); startAuto(); };
    document.getElementById('svc-next').onclick = function() { stopAuto(); go(1); startAuto(); };
    dots.forEach(function(d) {
        d.onclick = function() { stopAuto(); busy = false; i = v + (+this.dataset.idx); pos(true); busy = true; startAuto(); };
    });
    addEventListener('resize', function() { v = gv(); pos(false); });

    pos(false);
    startAuto();

    var sx = 0, df = 0;
    t.addEventListener('touchstart', function(e) { sx = e.touches[0].clientX; stopAuto(); }, {passive:true});
    t.addEventListener('touchmove', function(e) { df = sx - e.touches[0].clientX; }, {passive:true});
    t.addEventListener('touchend', function() { if (Math.abs(df) > 40) go(df > 0 ? 1 : -1); df = 0; startAuto(); });
})();
</script>

<!-- ══════════════════════════════════════════════════════
     WHY CHOOSE US — Light bg, bold trust signals
     ══════════════════════════════════════════════════════ -->
<section class="hwh-why" aria-label="Why choose Spicola Construction">
    <div class="hwh-section-inner">
        <div class="hwh-why__grid">
            <div class="hwh-why__content reveal">
                <span class="hwh-label">The Spicola Difference</span>
                <h2 class="hwh-section-title">Why Tampa Bay<br>Chooses <em>Us</em></h2>
                <p class="hwh-section-desc">We built our reputation one project at a time — delivering quality craftsmanship, honest pricing, and work that stands the test of time.</p>
                <ul class="hwh-why__list">
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>Licensed General Contractor</strong>
                            <p>Fully licensed CGC and insured for residential and commercial projects in Florida.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>Transparent Pricing</strong>
                            <p>Detailed estimates before work begins. No surprises, no change-order games.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>10+ Years Experience</strong>
                            <p>10+ years of construction expertise across residential, commercial, and renovation projects.</p>
                        </div>
                    </li>
                    <li class="hwh-why__item">
                        <span class="hwh-why__check" aria-hidden="true">✔</span>
                        <div>
                            <strong>On Time, On Budget</strong>
                            <p>We respect your timeline and your investment — no delays, no excuses.</p>
                        </div>
                    </li>
                </ul>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="hwh-btn hwh-btn--red">Meet Our Team →</a>
            </div>
            <div class="hwh-why__stats reveal">
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">500+</span>
                    <span class="hwh-why__stat-lbl">Projects Completed</span>
                </div>
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">50+</span>
                    <span class="hwh-why__stat-lbl">5-Star Reviews</span>
                </div>
                <div class="hwh-why__stat-card hwh-why__stat-card--accent">
                    <span class="hwh-why__stat-num">10+</span>
                    <span class="hwh-why__stat-lbl">Years Experience</span>
                </div>
                <div class="hwh-why__stat-card">
                    <span class="hwh-why__stat-num">100%</span>
                    <span class="hwh-why__stat-lbl">Satisfaction Guaranteed</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     RECENT WORKS — Portfolio showcase, gradient bg
     ══════════════════════════════════════════════════════ -->
<?php
$portfolio = new WP_Query([
    'post_type'      => 'portfolio',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
]);
if ($portfolio->have_posts()): ?>
<section class="sc-works" id="recent-works" aria-label="Recent projects">
    <div class="sc-works__glow" aria-hidden="true"></div>
    <div class="sc-works__grid-bg" aria-hidden="true"></div>
    <div class="sc-works__inner">
        <div class="sc-works__header">
            <div>
                <span class="sc-works__label">Our Work</span>
                <h2 class="sc-works__title">Recent <em>Projects</em></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="sc-works__view-all">View All Projects <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m9 18 6-6-6-6"/></svg></a>
        </div>
        <div class="sc-works__grid">
            <?php while ($portfolio->have_posts()): $portfolio->the_post();
                $types = get_the_terms(get_the_ID(), 'project_type');
                $type  = ($types && !is_wp_error($types)) ? $types[0]->name : '';
                $year  = get_post_meta(get_the_ID(), '_portfolio_year', true);
            ?>
            <a href="<?php the_permalink(); ?>" class="sc-works__card reveal">
                <div class="sc-works__card-img">
                    <?php if (has_post_thumbnail()):
                        the_post_thumbnail('medium_large', ['loading' => 'lazy', 'decoding' => 'async']);
                    else: ?>
                        <div class="sc-works__card-placeholder"></div>
                    <?php endif; ?>
                    <div class="sc-works__card-overlay">
                        <span class="sc-works__card-cta">View Project →</span>
                    </div>
                </div>
                <div class="sc-works__card-body">
                    <h3 class="sc-works__card-title"><?php the_title(); ?></h3>
                    <?php if ($type || $year): ?>
                    <span class="sc-works__card-meta">
                        <?php echo esc_html($type); ?><?php if ($type && $year) echo ' · '; ?><?php echo esc_html($year); ?>
                    </span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<style>
.sc-works{background:radial-gradient(ellipse at 50% 50%,#1a2d45 0%,#0A1628 70%);padding:clamp(4rem,6vw,7rem) 0;position:relative;overflow:hidden}
.sc-works__glow{position:absolute;inset:0;background:radial-gradient(circle at 50% 50%,rgba(24,55,93,.4) 0%,transparent 65%);pointer-events:none}
.sc-works__grid-bg{position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:60px 60px;pointer-events:none}
.sc-works__inner{max-width:1280px;margin:0 auto;padding:0 clamp(1.25rem,1rem + 2vw,3rem);position:relative;z-index:1}
.sc-works__header{display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;margin-bottom:clamp(2.5rem,4vw,3.5rem)}
.sc-works__label{display:inline-block;font-family:'Inter',sans-serif;font-size:.72rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:var(--brand,#F22F3A);padding-bottom:.5rem;position:relative}
.sc-works__label::after{content:'';position:absolute;bottom:0;left:0;height:3px;width:100%;background:linear-gradient(90deg,var(--brand,#F22F3A),rgba(242,47,58,.3));border-radius:2px}
.sc-works__title{font-family:'Montserrat',sans-serif;font-size:clamp(2rem,3vw,3rem);font-weight:800;color:#fff;line-height:1.15;margin:.5rem 0 0}
.sc-works__title em{font-style:normal;color:var(--brand,#F22F3A)}
.sc-works__view-all{display:inline-flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.9);font-size:.8rem;font-weight:700;text-decoration:none;letter-spacing:.08em;text-transform:uppercase;padding:.75rem 1.75rem;background:transparent;border:2px solid rgba(255,255,255,.2);border-radius:8px;transition:all .35s ease}
.sc-works__view-all:hover{background:#F22F3A;border-color:#F22F3A;color:#fff;box-shadow:0 0 25px rgba(242,47,58,.5);transform:translateY(-2px)}
/* Grid */
.sc-works__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sc-works__card{text-decoration:none;border-radius:14px;overflow:hidden;background:#fff;transition:transform .5s cubic-bezier(.22,1,.36,1),box-shadow .5s ease}
.sc-works__card:hover{transform:translateY(-6px);box-shadow:0 16px 40px rgba(0,0,0,.3)}
.sc-works__card-img{position:relative;aspect-ratio:16/10;overflow:hidden}
.sc-works__card-img img{width:100%;height:100%;object-fit:cover;transition:transform .6s cubic-bezier(.22,1,.36,1)}
.sc-works__card:hover .sc-works__card-img img{transform:scale(1.06)}
.sc-works__card-placeholder{width:100%;height:100%;background:linear-gradient(135deg,#222D3F,#3D6491)}
.sc-works__card-overlay{position:absolute;inset:0;background:linear-gradient(180deg,transparent 30%,rgba(242,47,58,.8) 100%);display:flex;align-items:flex-end;justify-content:center;padding-bottom:1.5rem;opacity:0;transition:opacity .35s ease}
.sc-works__card:hover .sc-works__card-overlay{opacity:1}
.sc-works__card-cta{color:#fff;font-size:.75rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.5rem 1.25rem;border:2px solid rgba(255,255,255,.3);border-radius:8px;transition:all .3s}
.sc-works__card:hover .sc-works__card-cta{background:#F22F3A;border-color:#F22F3A;box-shadow:0 0 20px rgba(242,47,58,.5)}
.sc-works__card-body{padding:1.25rem 1.25rem 1.5rem}
.sc-works__card-title{font-family:'Montserrat',sans-serif;font-size:1rem;font-weight:700;color:var(--brand-navy,#222D3F);margin:0 0 .3rem;line-height:1.3}
.sc-works__card-meta{font-size:.78rem;color:rgba(34,45,63,.45);font-weight:500}
@media(max-width:900px){.sc-works__grid{grid-template-columns:repeat(2,1fr)}.sc-works__header{flex-direction:column;align-items:flex-start}}
@media(max-width:600px){.sc-works__grid{grid-template-columns:1fr}}
</style>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════════
     HOW IT WORKS — Dark navy, bold numbered steps
     ══════════════════════════════════════════════════════ -->
<section class="hwh-process" aria-label="How our service works">
    <div class="hwh-section-inner">
        <div class="hwh-section-header hwh-section-header--light">
            <span class="hwh-label hwh-label--red">How It Works</span>
            <h2 class="hwh-section-title hwh-section-title--white">Your Project in 4 Steps</h2>
            <p class="hwh-section-desc hwh-section-desc--muted">We make construction simple — transparent pricing, clear timelines, and quality you can trust.</p>
        </div>
        <div class="hwh-process-steps">
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">01</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                <h3 class="hwh-process-step__title">Free Consultation</h3>
                <p class="hwh-process-step__text">Call us or request a quote online. We schedule a free on-site consultation to understand your vision.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">02</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
                <h3 class="hwh-process-step__title">Design & Planning</h3>
                <p class="hwh-process-step__text">Our team creates a detailed plan with blueprints, materials, and a transparent project estimate.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">03</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                <h3 class="hwh-process-step__title">Build &amp; Execute</h3>
                <p class="hwh-process-step__text">Licensed crews get to work on schedule. We keep you updated with regular progress reports.</p>
            </div>
            <div class="hwh-process-connector" aria-hidden="true"></div>
            <div class="hwh-process-step">
                <div class="hwh-process-step__num">04</div>
                <div class="hwh-process-step__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                <h3 class="hwh-process-step__title">Final Walkthrough</h3>
                <p class="hwh-process-step__text">We walk every detail with you to ensure 100% satisfaction. Your project is backed by our quality guarantee.</p>
            </div>
        </div>
    </div>
</section>


<!-- ══════════════════════════════════════════════════════
     FAQ Section — word count + FAQ rich results
     ══════════════════════════════════════════════════════ -->
<section class="hwh-faq" id="faq" aria-label="Frequently asked construction questions">
    <div class="hwh-section-inner">
        <div class="hwh-section-header reveal">
            <span class="hwh-label">Common Questions</span>
            <h2 class="hwh-section-title">Construction <em>FAQs</em></h2>
            <p class="hwh-section-desc">Have questions? Here are the answers Tampa Bay homeowners and business owners ask most.</p>
        </div>
        <div class="hwh-faq__grid reveal" itemscope itemtype="https://schema.org/FAQPage">
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">How long does a typical construction project take?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Project timelines vary based on scope. A kitchen remodel typically takes 4-8 weeks, a bathroom remodel 2-4 weeks, and new construction 4-8 months. During your free consultation, we provide a detailed timeline so you know exactly what to expect.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">Do you provide free estimates?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. Spicola Construction provides free estimates on all projects. We visit your property, discuss your vision, and provide a detailed written estimate with no obligation. We believe in transparent pricing with no hidden fees or surprise charges.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">Are you licensed and insured?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. Spicola Construction is a fully licensed Certified General Contractor (CGC) and carries comprehensive liability insurance and workers compensation. Your property and investment are fully protected on every project.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">What areas do you serve in Tampa Bay?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We serve all of Hillsborough, Pinellas, and Pasco counties. Service areas include Tampa, South Tampa, St. Petersburg, Clearwater, Brandon, Riverview, Wesley Chapel, Carrollwood, Westchase, Lutz, Land O Lakes, Odessa, New Tampa, and Zephyrhills. If you are in Greater Tampa Bay, we have got you covered.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">What types of construction projects do you handle?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">We handle residential and commercial projects of all sizes including new construction, home remodeling, kitchen and bathroom renovations, room additions, roofing, concrete work, commercial build-outs, and tenant improvements. No project is too big or too small.</p>
                </div>
            </div>
            <div class="hwh-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <h3 class="hwh-faq__question" itemprop="name">Do you offer financing?</h3>
                <div class="hwh-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <p itemprop="text">Yes. We accept cash, all major credit cards, and offer flexible financing options for larger projects. We work with you to find a payment plan that fits your budget so you can get the construction work you need without financial stress.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════
     FROM THE BLOG — Fresh content signal for SEO
     ══════════════════════════════════════════════════════ -->
<?php
$blog_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
]);
if ( $blog_query->have_posts() ) : ?>
<section class="sc-blog" aria-label="Latest construction tips and news">
    <div class="hwh-section-inner">
        <div class="hwh-section-header reveal">
            <span class="hwh-label">Construction Tips &amp; News</span>
            <h2 class="hwh-section-title">From <em>The Blog</em></h2>
            <p class="hwh-section-desc">Helpful guides, project spotlights, and construction advice from the Spicola team.</p>
        </div>
        <div class="sc-blog__grid reveal">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
                $cats = get_the_category();
                $cat_name = $cats ? esc_html( $cats[0]->name ) : 'Construction';
            ?>
            <article class="sc-blog__card">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" class="sc-blog__thumb" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail( 'medium', [ 'loading' => 'lazy', 'decoding' => 'async', 'alt' => esc_attr( get_the_title() ) ] ); ?>
                </a>
                <?php endif; ?>
                <div class="sc-blog__body">
                    <span class="sc-blog__cat"><?php echo $cat_name; ?></span>
                    <h3 class="sc-blog__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="sc-blog__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
                    <div class="sc-blog__footer">
                        <time class="sc-blog__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M j, Y'); ?></time>
                        <a href="<?php the_permalink(); ?>" class="sc-blog__read">Read More →</a>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="sc-blog__cta reveal">
            <a href="<?php echo esc_url( home_url('/blog/') ); ?>" class="hwh-btn hwh-btn--outline-navy">View All Articles →</a>
        </div>
    </div>
</section>

<style>
.sc-blog{padding:clamp(4rem,6vw,7rem) 0;background:#F8F8F6}
.sc-blog .hwh-section-title em{color:var(--brand,#F22F3A);font-style:normal}
.sc-blog .hwh-section-desc{color:rgba(34,45,63,.6)}
.sc-blog__grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:clamp(2rem,3vw,3rem)}
.sc-blog__card{background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 2px 16px rgba(0,0,0,.06);display:flex;flex-direction:column;transition:transform .3s ease,box-shadow .3s ease}
.sc-blog__card:hover{transform:translateY(-5px);box-shadow:0 12px 40px rgba(0,0,0,.1)}
.sc-blog__thumb{display:block;aspect-ratio:16/9;overflow:hidden}
.sc-blog__thumb img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.sc-blog__card:hover .sc-blog__thumb img{transform:scale(1.04)}
.sc-blog__body{padding:1.5rem;display:flex;flex-direction:column;flex:1}
.sc-blog__cat{font-family:'Montserrat',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--brand,#F22F3A);background:rgba(242,47,58,.08);border-radius:30px;padding:.3rem .8rem;display:inline-block;margin-bottom:.85rem}
.sc-blog__title{font-family:'Montserrat',sans-serif;font-size:1rem;font-weight:700;color:var(--brand-navy,#222D3F);line-height:1.4;margin:0 0 .75rem}
.sc-blog__title a{color:inherit;text-decoration:none}
.sc-blog__title a:hover{color:var(--brand,#F22F3A)}
.sc-blog__excerpt{font-size:.88rem;line-height:1.7;color:rgba(34,45,63,.65);margin:0 0 1rem;flex:1}
.sc-blog__footer{display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:.75rem;border-top:1px solid rgba(34,45,63,.07)}
.sc-blog__date{font-size:.75rem;color:rgba(34,45,63,.4)}
.sc-blog__read{font-family:'Montserrat',sans-serif;font-size:.75rem;font-weight:700;color:var(--brand,#F22F3A);text-decoration:none;letter-spacing:.03em}
.sc-blog__read:hover{text-decoration:underline}
.sc-blog__cta{text-align:center;margin-top:2.5rem}
.hwh-btn--outline-navy{display:inline-flex;align-items:center;gap:.5rem;font-family:'Montserrat',sans-serif;font-size:.875rem;font-weight:700;letter-spacing:.04em;padding:.85rem 2rem;border-radius:10px;border:2px solid var(--brand-navy,#222D3F);color:var(--brand-navy,#222D3F);background:transparent;text-decoration:none;transition:background .25s ease,color .25s ease}
.hwh-btn--outline-navy:hover{background:var(--brand-navy,#222D3F);color:#fff}
@media(max-width:900px){.sc-blog__grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:580px){.sc-blog__grid{grid-template-columns:1fr}}
</style>

<?php endif; ?>

<!-- ══════════════════════════════════════════════════════
     CTA — Bold red, full width
     ══════════════════════════════════════════════════════ -->
<section class="hwh-cta" id="request-service" aria-label="Request construction service">
    <div class="hwh-cta__inner reveal">
        <div class="hwh-cta__content">
            <span class="hwh-label hwh-label--white">Start Your Project</span>
            <h2 class="hwh-cta__title">Ready to Build?<br>Let's Talk.</h2>
            <p class="hwh-cta__text">From new construction to renovations, we bring your vision to life. Call now or request a free quote online.</p>
        </div>
        <div class="hwh-cta__actions">
            <a href="tel:+18137326285" class="hwh-btn hwh-btn--white hwh-btn--lg">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                Call (813) 732-6285
            </a>
            <a href="/contact/" class="hwh-btn hwh-btn--ghost-white hwh-btn--lg">
                Get a Free Quote →
            </a>
        </div>
    </div>
</section>



</main>

<?php get_footer(); ?>
