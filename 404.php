<?php
/**
 * Hot Water Heroes Plumbing — 404 Error Page
 * Plumbing-themed design: broken pipe, dripping water, rescue CTAs.
 */
get_header(); ?>

<main class="site-main" id="main-content">

    <section class="e404" aria-label="Page not found">

        <!-- Animated background bubbles -->
        <div class="e404__bg" aria-hidden="true">
            <span class="e404__bubble" style="--x:8%;  --size:220px; --delay:0s;   --dur:18s;"></span>
            <span class="e404__bubble" style="--x:78%; --size:300px; --delay:3s;   --dur:22s;"></span>
            <span class="e404__bubble" style="--x:45%; --size:180px; --delay:6s;   --dur:16s;"></span>
            <span class="e404__bubble" style="--x:20%; --size:120px; --delay:9s;   --dur:20s;"></span>
            <span class="e404__bubble" style="--x:88%; --size:150px; --delay:1.5s; --dur:14s;"></span>
        </div>

        <div class="section__inner e404__inner">

            <!-- Pipe illustration -->
            <div class="e404__art" aria-hidden="true">
                <svg class="e404__pipe" viewBox="0 0 260 340" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Horizontal pipe body -->
                    <rect x="10" y="100" width="240" height="48" rx="10" fill="#18375D"/>
                    <rect x="10" y="100" width="240" height="14" rx="10" fill="#1E4A7A" opacity=".6"/>
                    <!-- Left cap -->
                    <rect x="0"  y="92"  width="30"  height="64" rx="8" fill="#0F2440"/>
                    <!-- Right cap (broken end) -->
                    <path d="M230 92 h30 a8 8 0 0 1 8 8 v48 a8 8 0 0 1 -8 8 h-30 z" fill="#0F2440"/>
                    <!-- Break crack lines -->
                    <path d="M232 95 l14 22 M238 100 l10 30 M244 94 l8 34" stroke="#F22F3A" stroke-width="2.5" stroke-linecap="round" opacity=".85"/>
                    <!-- Pipe shine -->
                    <rect x="14" y="104" width="220" height="6" rx="3" fill="white" opacity=".08"/>
                    <!-- Elbow connector going down -->
                    <rect x="106" y="145" width="48" height="90" rx="10" fill="#18375D"/>
                    <rect x="106" y="145" width="14" height="90" rx="4"  fill="#1E4A7A" opacity=".5"/>
                    <!-- Bottom opening ring -->
                    <rect x="100" y="225" width="60" height="18" rx="6" fill="#0F2440"/>
                    <!-- Water drops falling -->
                    <ellipse class="e404__drop e404__drop--1" cx="130" cy="270" rx="7"  ry="10" fill="#F22F3A"/>
                    <ellipse class="e404__drop e404__drop--2" cx="122" cy="295" rx="5"  ry="7.5" fill="#F22F3A" opacity=".7"/>
                    <ellipse class="e404__drop e404__drop--3" cx="138" cy="318" rx="4"  ry="6"   fill="#F22F3A" opacity=".5"/>
                    <!-- Ripple on floor -->
                    <ellipse cx="130" cy="335" rx="28" ry="5" fill="#F22F3A" opacity=".15"/>
                    <ellipse cx="130" cy="335" rx="18" ry="3" fill="#F22F3A" opacity=".2"/>
                </svg>

                <!-- Big 404 number behind the pipe -->
                <div class="e404__number" aria-hidden="true">404</div>
            </div>

            <!-- Text content -->
            <div class="e404__content">
                <div class="e404__badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    We're on it
                </div>

                <h1 class="e404__title">Looks like this pipe burst.</h1>
                <p class="e404__sub">The page you're looking for has gone down the drain. Our crew is on standby — let's get you back to flowing water fast.</p>

                <!-- Primary actions -->
                <div class="e404__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg e404__cta-home">
                        Back to Home
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--outline btn--lg">
                        Call for Help
                    </a>
                </div>

                <!-- Quick service links -->
                <nav class="e404__links" aria-label="Quick links">
                    <p class="e404__links-label">Or jump straight to a service:</p>
                    <div class="e404__links-grid">
                        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon">🔧</span>
                            <span class="e404__link-name">All Services</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/services/water-heaters/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon">🔥</span>
                            <span class="e404__link-name">Water Heaters</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/services/drain-cleaning/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon">🚿</span>
                            <span class="e404__link-name">Drain Cleaning</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="e404__link-card">
                            <span class="e404__link-icon">📞</span>
                            <span class="e404__link-name">Contact Us</span>
                        </a>
                    </div>
                </nav>

                <!-- Search -->
                <div class="e404__search">
                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="e404__search-form">
                        <svg class="e404__search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        <input
                            type="search"
                            name="s"
                            class="e404__search-input"
                            placeholder="Search for a service or topic…"
                            aria-label="Search the site"
                        >
                        <button type="submit" class="btn btn--primary e404__search-btn">Go</button>
                    </form>
                </div>
            </div>

        </div><!-- /.e404__inner -->
    </section>

</main>

<?php get_footer(); ?>
