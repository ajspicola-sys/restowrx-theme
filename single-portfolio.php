<?php
/**
 * Spicola Construction — Single Portfolio Project
 * Hero with featured image, project details, image gallery with lightbox.
 */
get_header();

$post_id     = get_the_ID();
$location    = get_post_meta($post_id, '_portfolio_location', true);
$duration    = get_post_meta($post_id, '_portfolio_duration', true);
$year        = get_post_meta($post_id, '_portfolio_year', true);
$gallery_ids = get_post_meta($post_id, '_portfolio_gallery', true);
$gallery     = $gallery_ids ? array_filter(explode(',', $gallery_ids)) : [];
$types       = get_the_terms($post_id, 'project_type');
$type_name   = ($types && !is_wp_error($types)) ? $types[0]->name : 'Project';
$has_image   = has_post_thumbnail();
?>

<main class="site-main" id="main-content">

    <!-- Hero -->
    <section class="pf-hero" aria-label="Project details">
        <?php if ($has_image): ?>
        <div class="pf-hero__bg">
            <?php the_post_thumbnail('full', ['class' => 'pf-hero__bg-img', 'loading' => 'eager']); ?>
            <div class="pf-hero__overlay"></div>
        </div>
        <?php else: ?>
        <div class="pf-hero__bg" style="background:radial-gradient(ellipse at 50% 50%,#1a2d45 0%,#0A1628 70%)"></div>
        <?php endif; ?>

        <div class="pf-hero__inner">
            <nav class="breadcrumbs breadcrumbs--hero" aria-label="Breadcrumb">
                <ol class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                    <li class="breadcrumbs__item"><a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>">Projects</a></li>
                    <li class="breadcrumbs__sep" aria-hidden="true">›</li>
                    <li class="breadcrumbs__item breadcrumbs__item--current" aria-current="page"><?php the_title(); ?></li>
                </ol>
            </nav>
            <span class="section__label section__label--light"><?php echo esc_html($type_name); ?></span>
            <h1 class="pf-hero__title"><?php the_title(); ?></h1>
            <?php if ($location || $year || $duration): ?>
            <div class="pf-hero__meta">
                <?php if ($location): ?><span>📍 <?php echo esc_html($location); ?></span><?php endif; ?>
                <?php if ($year): ?><span>📅 <?php echo esc_html($year); ?></span><?php endif; ?>
                <?php if ($duration): ?><span>⏱ <?php echo esc_html($duration); ?></span><?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Content -->
    <?php if (get_the_content()): ?>
    <section class="pf-content" aria-label="Project description">
        <div class="section__inner">
            <div class="pf-content__body">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Gallery -->
    <?php if (!empty($gallery)): ?>
    <section class="pf-gallery" aria-label="Project photos">
        <div class="section__inner">
            <div class="section__header">
                <span class="section__label">Project Gallery</span>
                <h2 class="section__title">Before, During &amp; After</h2>
            </div>
            <div class="pf-gallery__grid">
                <?php foreach ($gallery as $i => $img_id):
                    $full = wp_get_attachment_image_src($img_id, 'large');
                    $alt  = get_post_meta($img_id, '_wp_attachment_image_alt', true) ?: get_the_title();
                    if (!$full) continue;
                ?>
                <a href="<?php echo esc_url($full[0]); ?>" class="pf-gallery__item" data-lightbox="gallery" data-index="<?php echo $i; ?>">
                    <?php echo wp_get_attachment_image($img_id, 'medium', false, [
                        'class'    => 'pf-gallery__img',
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                        'alt'      => $alt,
                    ]); ?>
                    <div class="pf-gallery__hover">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Lightbox -->
    <div class="pf-lightbox" id="pf-lightbox" role="dialog" aria-label="Image viewer" hidden>
        <button class="pf-lightbox__close" aria-label="Close">&times;</button>
        <button class="pf-lightbox__prev" aria-label="Previous">‹</button>
        <button class="pf-lightbox__next" aria-label="Next">›</button>
        <img class="pf-lightbox__img" id="pf-lightbox-img" src="" alt="">
    </div>

    <!-- CTA -->
    <section class="svc-cta" aria-label="Start your project">
        <div class="svc-cta__inner">
            <div class="svc-cta__text">
                <span class="svc-cta__eyebrow">Like What You See?</span>
                <h2 class="svc-cta__title">Let's Build <em>Yours</em></h2>
                <p class="svc-cta__desc">Every project starts with a conversation. Call us or request a free quote — no obligation, just honest answers.</p>
            </div>
            <div class="svc-cta__actions">
                <a href="tel:+18137326285" class="btn btn--primary btn--lg">Call (813) 732-6285</a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--lg">Get a Free Quote</a>
            </div>
        </div>
    </section>

</main>

<style>
/* Hero */
.pf-hero{position:relative;min-height:50vh;display:flex;align-items:flex-end;padding:0 0 4rem;overflow:hidden}
.pf-hero__bg{position:absolute;inset:0}
.pf-hero__bg-img{width:100%;height:100%;object-fit:cover}
.pf-hero__overlay{position:absolute;inset:0;background:linear-gradient(180deg,rgba(10,22,40,.3) 0%,rgba(10,22,40,.85) 100%)}
.pf-hero__inner{position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:0 clamp(1.25rem,1rem + 2vw,3rem);width:100%}
.pf-hero__title{font-family:'Montserrat',sans-serif;font-size:clamp(2.2rem,4vw,4rem);font-weight:800;color:#fff;margin:.75rem 0 1rem;line-height:1.1}
.pf-hero__meta{display:flex;flex-wrap:wrap;gap:1.5rem;color:rgba(255,255,255,.7);font-size:.9rem;font-weight:500}

/* Content */
.pf-content{padding:clamp(3rem,5vw,5rem) 0}
.pf-content__body{max-width:780px;margin:0 auto;font-size:1.05rem;line-height:1.8;color:#333}
.pf-content__body h2,.pf-content__body h3{font-family:'Montserrat',sans-serif;color:var(--brand-navy,#222D3F);margin:2rem 0 .75rem}

/* Gallery Grid */
.pf-gallery{padding:0 0 clamp(4rem,6vw,6rem);background:#f8f9fa}
.pf-gallery__grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;margin-top:2.5rem}
.pf-gallery__item{position:relative;aspect-ratio:4/3;border-radius:12px;overflow:hidden;cursor:pointer;display:block}
.pf-gallery__img{width:100%;height:100%;object-fit:cover;transition:transform .5s cubic-bezier(.22,1,.36,1)}
.pf-gallery__item:hover .pf-gallery__img{transform:scale(1.06)}
.pf-gallery__hover{position:absolute;inset:0;background:rgba(10,22,40,.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .3s ease}
.pf-gallery__item:hover .pf-gallery__hover{opacity:1}

/* Lightbox */
.pf-lightbox{position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.92);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px)}
.pf-lightbox[hidden]{display:none}
.pf-lightbox__img{max-width:90vw;max-height:85vh;object-fit:contain;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5)}
.pf-lightbox__close{position:absolute;top:1.5rem;right:1.5rem;background:none;border:none;color:#fff;font-size:2.5rem;cursor:pointer;z-index:2;width:48px;height:48px;display:flex;align-items:center;justify-content:center;transition:transform .2s}
.pf-lightbox__close:hover{transform:scale(1.2)}
.pf-lightbox__prev,.pf-lightbox__next{position:absolute;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.1);border:2px solid rgba(255,255,255,.2);color:#fff;font-size:2rem;cursor:pointer;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:all .3s;backdrop-filter:blur(4px)}
.pf-lightbox__prev{left:1.5rem}
.pf-lightbox__next{right:1.5rem}
.pf-lightbox__prev:hover,.pf-lightbox__next:hover{background:var(--brand,#C13333);border-color:var(--brand,#C13333)}
@media(max-width:600px){.pf-gallery__grid{grid-template-columns:repeat(2,1fr);gap:.5rem}.pf-hero{min-height:40vh}}
</style>

<script>
(function(){
    var lb    = document.getElementById('pf-lightbox');
    var img   = document.getElementById('pf-lightbox-img');
    var items = document.querySelectorAll('.pf-gallery__item[data-lightbox]');
    var urls  = []; var cur = 0;

    items.forEach(function(el, i){ urls.push(el.href); el.addEventListener('click', function(e){ e.preventDefault(); cur = i; open(); }); });

    function open(){ lb.hidden = false; img.src = urls[cur]; document.body.style.overflow = 'hidden'; }
    function close(){ lb.hidden = true; img.src = ''; document.body.style.overflow = ''; }
    function prev(){ cur = (cur - 1 + urls.length) % urls.length; img.src = urls[cur]; }
    function next(){ cur = (cur + 1) % urls.length; img.src = urls[cur]; }

    lb.querySelector('.pf-lightbox__close').addEventListener('click', close);
    lb.querySelector('.pf-lightbox__prev').addEventListener('click', prev);
    lb.querySelector('.pf-lightbox__next').addEventListener('click', next);
    lb.addEventListener('click', function(e){ if (e.target === lb) close(); });
    document.addEventListener('keydown', function(e){
        if (lb.hidden) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowLeft') prev();
        if (e.key === 'ArrowRight') next();
    });
})();
</script>

<?php get_footer(); ?>
