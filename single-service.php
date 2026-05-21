<?php
/**
 * Restowrx Elite — Single Service Template
 * Hero with featured image, tactical protocol body content, dispatch sidebar, trust stack, related services, CTA.
 * SEO: title + meta description managed by Yoast SEO.
 */
get_header();

$post_id   = get_the_ID();
$has_image = has_post_thumbnail();

// Retrieve post meta values
$price = get_post_meta($post_id, '_service_price', true);
$duration = get_post_meta($post_id, '_service_duration', true);

// Get service category
$categories = get_the_terms($post_id, 'service_category');
$category_name = 'Mitigation & Recovery'; // default fallback
if ($categories && !is_wp_error($categories)) {
    $category_name = $categories[0]->name;
}
?>

<style>
    /* Premium Tactical Style Overrides for Single Service Page */
    .single-service-page {
        background-color: #050505;
        color: #ffffff;
        font-family: var(--font-main, 'Inter', sans-serif);
        overflow-x: hidden;
    }

    /* --- HERO --- */
    .rwx-hero {
        position: relative;
        padding: clamp(140px, 12vw, 220px) 0 clamp(80px, 8vw, 120px) 0;
        background-color: #000000;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 0, 0, 0.2);
    }
    
    .rwx-hero__canvas {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0.18;
        filter: grayscale(1) brightness(0.3);
        z-index: 1;
    }

    .rwx-hero__overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle at 50% 50%, rgba(18, 3, 3, 0.4) 0%, #050505 100%);
        z-index: 2;
    }

    .rwx-hero__scanline {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to bottom, transparent 50%, rgba(255, 0, 0, 0.03) 50%);
        background-size: 100% 4px;
        z-index: 3;
        pointer-events: none;
    }

    .rwx-hero__inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: clamp(40px, 6vw, 80px);
        align-items: center;
    }

    .rwx-breadcrumb {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rwx-breadcrumb a {
        color: #888;
        text-decoration: none;
        transition: color 0.3s;
    }

    .rwx-breadcrumb a:hover {
        color: var(--brand, #ff0000);
    }

    .rwx-eyebrow-label {
        background: var(--brand, #ff0000);
        color: white;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 6px 14px;
        margin-bottom: 25px;
        display: inline-block;
    }

    .rwx-hero__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3.5rem, 6vw, 7.5rem);
        line-height: 0.85;
        margin: 0 0 25px 0;
        text-transform: uppercase;
        letter-spacing: -2px;
    }

    .rwx-hero__title b {
        display: block;
        color: white;
    }

    .rwx-hero__title span {
        display: block;
        color: transparent;
        -webkit-text-stroke: 2px var(--brand, #ff0000);
    }

    .rwx-hero__desc {
        color: #aaa;
        font-size: clamp(1rem, 1.2vw, 1.25rem);
        line-height: 1.7;
        margin: 0 0 35px 0;
        max-width: 650px;
    }

    .rwx-hero__actions {
        display: flex;
        gap: clamp(15px, 2vw, 25px);
        flex-wrap: wrap;
    }

    .rwx-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.3rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        padding: 16px 36px;
        border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
        cursor: pointer;
    }

    .rwx-btn--red {
        background: var(--brand, #ff0000);
        color: white !important;
        border: 1px solid var(--brand, #ff0000);
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
    }

    .rwx-btn--red:hover {
        background: white;
        color: var(--brand, #ff0000) !important;
        border-color: white;
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.6);
        transform: translateY(-2px);
    }

    .rwx-btn--outline {
        background: transparent;
        color: white !important;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .rwx-btn--outline:hover {
        background: rgba(255, 0, 0, 0.1);
        border-color: var(--brand, #ff0000);
        color: white !important;
        transform: translateY(-2px);
    }

    /* Hero Featured Image Column */
    .rwx-hero__img-container {
        position: relative;
        width: 100%;
        height: clamp(300px, 35vw, 450px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        z-index: 5;
    }

    .rwx-hero__img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.85;
    }

    .rwx-hero__img-glow {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to top, rgba(5, 5, 5, 0.9) 0%, transparent 60%);
        pointer-events: none;
    }

    .rwx-hero__img-overlay-lines {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        border: 1px solid rgba(255, 0, 0, 0.2);
        box-shadow: inset 0 0 30px rgba(255, 0, 0, 0.1);
        pointer-events: none;
    }

    /* --- LAYOUT MATRIX --- */
    .rwx-matrix {
        max-width: 1400px;
        margin: clamp(60px, 8vw, 100px) auto;
        padding: 0 clamp(20px, 5vw, 40px);
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 60px;
    }

    /* Left Column Content */
    .rwx-intel {
        background: rgba(10, 10, 10, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: clamp(30px, 5vw, 60px);
        border-radius: 12px;
    }

    .rwx-intel h2 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2.2rem, 3.5vw, 3.2rem);
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 45px 0 25px 0;
        border-bottom: 2px solid var(--brand, #ff0000);
        padding-bottom: 12px;
        display: inline-block;
    }

    .rwx-intel h2:first-of-type {
        margin-top: 0;
    }

    .rwx-intel h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(1.6rem, 2vw, 2.2rem);
        color: white;
        text-transform: uppercase;
        margin: 35px 0 20px 0;
        letter-spacing: 1px;
    }

    /* Paragraph Dropcap & Details */
    .rwx-intel p {
        font-size: clamp(1rem, 1.1vw, 1.15rem);
        line-height: 1.8;
        color: #b5b5b5;
        margin-bottom: 30px;
    }

    .rwx-intel > p:first-of-type::first-letter {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        color: var(--brand, #ff0000);
        font-size: clamp(4rem, 6vw, 6.5rem);
        float: left;
        line-height: 0.8;
        padding-right: 18px;
        padding-top: 6px;
        font-weight: 900;
    }

    .rwx-intel ul, .rwx-intel ol {
        margin-bottom: 35px;
        padding-left: 20px;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #b5b5b5;
    }

    .rwx-intel li {
        margin-bottom: 12px;
    }

    /* Custom tactical square bullet lists */
    .rwx-intel ul {
        list-style: none;
        padding-left: 10px;
    }

    .rwx-intel ul li {
        position: relative;
        padding-left: 25px;
    }

    .rwx-intel ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 10px;
        width: 6px;
        height: 6px;
        border: 1px solid var(--brand, #ff0000);
        background: transparent;
    }

    .rwx-intel img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 40px 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Action Gallery Section */
    .rwx-gallery {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin: 50px 0;
    }

    .rwx-gallery__item {
        position: relative;
        height: 280px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .rwx-gallery__img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(0.5);
        transition: all 0.5s;
    }

    .rwx-gallery__item:hover .rwx-gallery__img {
        filter: grayscale(0) scale(1.05);
    }

    .rwx-gallery__item::before {
        content: 'SCANNING...';
        position: absolute;
        top: 15px; left: 15px;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.65rem;
        color: var(--brand, #ff0000);
        letter-spacing: 2px;
        z-index: 10;
        background: rgba(0,0,0,0.6);
        padding: 4px 8px;
        border-radius: 2px;
    }

    /* --- RIGHT COLUMN SIDEBAR --- */
    .rwx-sidebar {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .rwx-sidebar-sticky {
        position: sticky;
        top: 110px;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .rwx-widget {
        background: #0a0a0a;
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 35px;
        border-radius: 12px;
        position: relative;
    }

    .rwx-widget--dispatch {
        border-top: 6px solid var(--brand, #ff0000);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6);
    }

    .rwx-widget__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .rwx-widget__header h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        margin: 0;
        font-size: 1.8rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: white;
    }

    .rwx-status-dot {
        width: 10px; height: 10px;
        background: var(--brand, #ff0000);
        border-radius: 50%;
        box-shadow: 0 0 15px var(--brand, #ff0000);
        animation: rwx-pulse-dot 1.2s infinite;
    }

    @keyframes rwx-pulse-dot {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.3; transform: scale(0.85); }
        100% { opacity: 1; transform: scale(1); }
    }

    .rwx-widget__radar {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.65rem;
        color: #666;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin: 0 0 25px 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .rwx-widget__radar i {
        color: var(--brand, #ff0000);
    }

    /* Custom sidebar data list */
    .rwx-meta-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding-bottom: 20px;
    }

    .rwx-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
    }

    .rwx-meta-row span:first-child {
        color: #777;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .rwx-meta-row span:last-child {
        color: white;
        font-weight: 600;
    }

    /* Style for the embedded CF7 in Sidebar */
    .rwx-widget--dispatch .wpcf7-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .rwx-widget--dispatch .wpcf7-form p {
        margin: 0;
        padding: 0;
    }

    .rwx-widget--dispatch input[type="text"],
    .rwx-widget--dispatch input[type="tel"],
    .rwx-widget--dispatch input[type="email"],
    .rwx-widget--dispatch select,
    .rwx-widget--dispatch textarea {
        width: 100%;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 14px 16px;
        color: white;
        font-family: var(--font-main, 'Inter', sans-serif);
        font-size: 0.9rem;
        border-radius: 4px;
        outline: none;
        transition: all 0.3s;
    }

    .rwx-widget--dispatch input[type="text"]:focus,
    .rwx-widget--dispatch input[type="tel"]:focus,
    .rwx-widget--dispatch input[type="email"]:focus,
    .rwx-widget--dispatch select:focus,
    .rwx-widget--dispatch textarea:focus {
        border-color: var(--brand, #ff0000);
        background: rgba(255, 0, 0, 0.02);
    }

    .rwx-widget--dispatch input[type="submit"],
    .rwx-widget--dispatch .wpcf7-submit {
        width: 100%;
        background: var(--brand, #ff0000);
        color: white;
        border: none;
        padding: 16px 0;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.5rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        clip-path: polygon(4% 0, 100% 0, 96% 100%, 0 100%);
        transition: all 0.3s;
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
    }

    .rwx-widget--dispatch input[type="submit"]:hover,
    .rwx-widget--dispatch .wpcf7-submit:hover {
        background: white;
        color: var(--brand, #ff0000);
        box-shadow: 0 0 25px rgba(255, 255, 255, 0.5);
    }

    .rwx-widget--dispatch .rwx-widget__call-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.15);
        color: white;
        background: transparent;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.85rem;
        letter-spacing: 1px;
        padding: 12px 0;
        margin-top: 15px;
        text-decoration: none;
        transition: 0.3s;
    }

    .rwx-widget--dispatch .rwx-widget__call-btn:hover {
        border-color: var(--brand, #ff0000);
        background: rgba(255,0,0,0.05);
        color: var(--brand, #ff0000);
    }

    .rwx-widget__fine-print {
        text-align: center;
        font-size: 0.7rem;
        color: #555;
        font-family: var(--font-mono, 'Space Mono', monospace);
        margin: 15px 0 0 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Trust Badge Stack */
    .rwx-trust-stack {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .rwx-cert-badge {
        display: flex;
        align-items: center;
        gap: 20px;
        background: rgba(255,255,255,0.02);
        padding: 20px;
        border-left: 2px solid rgba(255, 0, 0, 0.3);
        border-radius: 0 8px 8px 0;
        border-top: 1px solid rgba(255,255,255,0.02);
        border-right: 1px solid rgba(255,255,255,0.02);
        border-bottom: 1px solid rgba(255,255,255,0.02);
    }

    .rwx-cert-badge i {
        color: var(--brand, #ff0000);
    }

    .rwx-cert-badge div span {
        display: block;
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.25rem;
        letter-spacing: 1px;
        color: white;
        line-height: 1.2;
    }

    .rwx-cert-badge div p {
        margin: 3px 0 0 0;
        font-size: 0.75rem;
        color: #666;
        text-transform: uppercase;
        font-family: var(--font-mono, 'Space Mono', monospace);
    }

    /* --- THE RESTOWRX DIFFERENCE TRUST SECTION --- */
    .rwx-trust {
        background: radial-gradient(circle at 50% 50%, #150202 0%, #050505 100%);
        padding: clamp(60px, 8vw, 100px) 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .rwx-trust__inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
        display: grid;
        grid-template-columns: 0.9fr 1.1fr;
        gap: 60px;
        align-items: center;
    }

    .rwx-trust__left {
        position: relative;
    }

    .rwx-trust__left .section__label {
        color: var(--brand, #ff0000);
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        display: block;
        margin-bottom: 20px;
    }

    .rwx-trust__left h2 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3rem, 5vw, 4.8rem);
        margin: 0 0 25px 0;
        line-height: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .rwx-trust__left h2 em {
        color: transparent;
        -webkit-text-stroke: 1.5px white;
        font-style: normal;
    }

    .rwx-trust__left p {
        color: #aaa;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .rwx-trust__stat {
        display: flex;
        align-items: center;
        gap: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 25px;
    }

    .rwx-trust__stat-stars {
        color: #FFD700;
        font-size: 1.5rem;
        letter-spacing: 2px;
    }

    .rwx-trust__stat-info {
        font-size: 0.9rem;
    }

    .rwx-trust__stat-info strong {
        color: white;
        font-size: 1.2rem;
        display: block;
        margin-bottom: 2px;
    }

    .rwx-trust__stat-info span {
        color: #666;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        font-family: var(--font-mono, 'Space Mono', monospace);
    }

    .rwx-trust__cards {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .rwx-trust-card {
        display: flex;
        gap: 25px;
        background: rgba(15, 15, 15, 0.5);
        border: 1px solid rgba(255,255,255,0.05);
        padding: 30px;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .rwx-trust-card::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 15px; height: 15px;
        background: linear-gradient(135deg, transparent 50%, var(--brand, #ff0000) 50%);
    }

    .rwx-trust-card__icon {
        color: var(--brand, #ff0000);
        flex-shrink: 0;
        background: rgba(255,0,0,0.08);
        width: 60px; height: 60px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,0,0,0.15);
    }

    .rwx-trust-card__body h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.6rem;
        margin: 0 0 10px 0;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: white;
    }

    .rwx-trust-card__body p {
        color: #888;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    .rwx-trust-card__num {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 2.2rem;
        font-weight: 700;
        color: rgba(255,255,255,0.05);
        position: absolute;
        right: 25px;
        bottom: 15px;
        pointer-events: none;
        line-height: 1;
    }

    /* --- RELATED SERVICES --- */
    .rwx-related {
        padding: clamp(60px, 8vw, 100px) 0;
        background: #050505;
    }

    .rwx-related__inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 clamp(20px, 5vw, 40px);
    }

    .rwx-related__header {
        text-align: center;
        margin-bottom: 50px;
    }

    .rwx-related__header .section__label {
        color: var(--brand, #ff0000);
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        display: block;
        margin-bottom: 15px;
    }

    .rwx-related__header h2 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(2.5rem, 4vw, 4.2rem);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }

    .rwx-related__grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
    }

    /* service card */
    .rwx-card {
        background: #0a0a0a;
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        overflow: hidden;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
    }

    .rwx-card:hover {
        border-color: rgba(255, 0, 0, 0.3);
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(255, 0, 0, 0.08);
    }

    .rwx-card__thumb {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .rwx-card__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(0.5);
        transition: all 0.5s;
    }

    .rwx-card:hover .rwx-card__thumb img {
        filter: grayscale(0);
        transform: scale(1.05);
    }

    .rwx-card__icon-fallback {
        width: 100%;
        height: 220px;
        background: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--brand, #ff0000);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .rwx-card__body {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .rwx-card__body h3 {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: 1.8rem;
        color: white;
        margin: 0 0 15px 0;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: color 0.3s;
    }

    .rwx-card:hover .rwx-card__body h3 {
        color: var(--brand, #ff0000);
    }

    .rwx-card__body p {
        color: #777;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0 0 25px 0;
        flex-grow: 1;
    }

    .rwx-card__link {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.75rem;
        color: var(--brand, #ff0000);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        transition: gap 0.3s;
    }

    .rwx-card:hover .rwx-card__link {
        gap: 12px;
    }

    /* --- BOTTOM CTA --- */
    .rwx-cta-block {
        background: radial-gradient(circle at 50% 50%, #200202 0%, #000000 100%);
        padding: clamp(80px, 12vw, 150px) 0;
        text-align: center;
        border-top: 1px solid rgba(255, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .rwx-cta-block__pulse {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(255, 0, 0, 0.12) 0%, transparent 70%);
        transform: translate(-50%, -50%);
        z-index: 1;
        pointer-events: none;
        animation: rwx-pulse-radar 4s infinite linear;
        border-radius: 50%;
    }

    @keyframes rwx-pulse-radar {
        0% { transform: translate(-50%, -50%) scale(0.6); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1.4); opacity: 0; }
    }

    .rwx-cta-block__inner {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 5;
    }

    .rwx-cta-block__eyebrow {
        font-family: var(--font-mono, 'Space Mono', monospace);
        color: var(--brand, #ff0000);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        display: block;
        margin-bottom: 25px;
        font-weight: 700;
    }

    .rwx-cta-block__title {
        font-family: var(--font-accent, 'Bebas Neue', sans-serif);
        font-size: clamp(3rem, 6vw, 5.5rem);
        margin: 0 0 25px 0;
        line-height: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .rwx-cta-block__title em {
        color: transparent;
        -webkit-text-stroke: 1.5px white;
        font-style: normal;
    }

    .rwx-cta-block__desc {
        color: #aaa;
        font-size: 1.15rem;
        line-height: 1.7;
        margin-bottom: 40px;
    }

    .rwx-cta-block__actions {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .rwx-hero__inner {
            grid-template-columns: 1fr;
            text-align: center;
        }
        .rwx-hero__actions {
            justify-content: center;
        }
        .rwx-hero__desc {
            margin-left: auto;
            margin-right: auto;
        }
        .rwx-breadcrumb {
            justify-content: center;
        }
        .rwx-hero__img-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .rwx-matrix {
            grid-template-columns: 1fr;
            gap: 50px;
        }
        .rwx-sidebar-sticky {
            position: relative;
            top: 0;
        }
        .rwx-trust__inner {
            grid-template-columns: 1fr;
            gap: 50px;
        }
    }

    @media (max-width: 768px) {
        .rwx-gallery {
            grid-template-columns: 1fr;
        }
        .rwx-related__grid {
            grid-template-columns: 1fr;
        }
        .rwx-intel {
            padding: 25px;
        }
    }
</style>

<main class="site-main" id="main-content">

    <!-- ═══════════════════════════════════════════════════════
         HERO — Tactical Header with Featured Image Background
         ═══════════════════════════════════════════════════════ -->
    <section class="rwx-hero" aria-label="Service details" itemscope itemtype="https://schema.org/Service">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <meta itemprop="areaServed" content="Tampa Bay, FL">
        <div class="rwx-hero__canvas" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'full')); ?>');"></div>
        <div class="rwx-hero__overlay"></div>
        <div class="rwx-hero__scanline"></div>

        <div class="rwx-hero__inner">
            <div class="reveal">
                <nav class="rwx-breadcrumb" aria-label="Breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="<?php echo esc_url(home_url('/')); ?>" itemprop="item"><span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1">
                    </span>
                    <span>/</span>
                    <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" itemprop="item"><span itemprop="name">Services</span></a>
                        <meta itemprop="position" content="2">
                    </span>
                    <span>/</span>
                    <span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">
                        <span itemprop="name"><?php the_title(); ?></span>
                        <meta itemprop="position" content="3">
                    </span>
                </nav>

                <span class="rwx-eyebrow-label">RESTOWRX PROTOCOL</span>

                <h1 class="rwx-hero__title">
                    <b><?php the_title(); ?></b>
                    <span>TACTICAL RESPONSE</span>
                </h1>

                <?php if (has_excerpt()): ?>
                    <p class="rwx-hero__desc"><?php echo get_the_excerpt(); ?></p>
                <?php else: ?>
                    <p class="rwx-hero__desc">Operating at the peak of recovery science. We deliver surgical-grade property restoration for residential and commercial structures under strict emergency response timelines.</p>
                <?php endif; ?>

                <div class="rwx-hero__actions">
                    <a href="/contact/" class="rwx-btn rwx-btn--red"><i data-lucide="shield-alert" size="20"></i> Activate Response</a>
                    <a href="tel:+18136994009" class="rwx-btn rwx-btn--outline"><i data-lucide="phone-call" size="20"></i> Call 813.699.4009</a>
                </div>
            </div>

            <!-- Featured Image Column -->
            <div class="reveal">
                <div class="rwx-hero__img-container">
                    <?php if ($has_image): ?>
                        <?php the_post_thumbnail('large', [
                            'loading'       => 'eager',
                            'decoding'      => 'async',
                            'fetchpriority' => 'high',
                            'itemprop'      => 'image',
                            'class'         => 'rwx-hero__img',
                        ]); ?>
                    <?php else: ?>
                        <img src="https://images.unsplash.com/photo-1516156008625-3a9d6067fab5?q=80&w=1200" alt="Tactical Recovery" class="rwx-hero__img">
                    <?php endif; ?>
                    <div class="rwx-hero__img-glow"></div>
                    <div class="rwx-hero__img-overlay-lines"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT + STICKY TACTICAL SIDEBAR
         ═══════════════════════════════════════════════════════ -->
    <main class="single-service-page">
    <div class="rwx-matrix">
        
        <!-- LEFT: INTEL (Main content body) -->
        <article class="rwx-intel reveal" itemprop="description">
            <h2>Protocol Briefing</h2>
            <div class="rwx-content-body">
                <?php the_content(); ?>
            </div>
            
            <div class="rwx-gallery">
                <div class="rwx-gallery__item">
                    <img src="https://images.unsplash.com/photo-1581094288338-2314dddb7eed?q=80&w=800" alt="Extraction Scan" class="rwx-gallery__img">
                </div>
                <div class="rwx-gallery__item">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=800" alt="Forensic Drying" class="rwx-gallery__img">
                </div>
            </div>
        </article>

        <!-- RIGHT: SIDEBAR (Sticky Quick Info & Form) -->
        <aside class="rwx-sidebar">
            <div class="rwx-sidebar-sticky">
                
                <!-- Dispatch Box -->
                <div class="rwx-widget rwx-widget--dispatch reveal">
                    <div class="rwx-widget__header">
                        <h3>Tactical Dispatch</h3>
                        <div class="rwx-status-dot"></div>
                    </div>
                    <div class="rwx-widget__radar">
                        <i data-lucide="radio" size="14"></i> 60-MINUTE COMMAND RADAR
                    </div>

                    <div class="rwx-meta-list">
                        <?php if ($price): ?>
                        <div class="rwx-meta-row">
                            <span>Starting At</span>
                            <span><?php echo esc_html($price); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($duration): ?>
                        <div class="rwx-meta-row">
                            <span>Response Spec</span>
                            <span><?php echo esc_html($duration); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="rwx-meta-row">
                            <span>Classification</span>
                            <span><?php echo esc_html($category_name); ?></span>
                        </div>
                    </div>

                    <?php 
                    // Render CF7 inside sidebar
                    echo do_shortcode('[contact-form-7 id="3191cf3" title="Hero Form/ Contact Form"]'); 
                    ?>

                    <a href="tel:+18136994009" class="rwx-widget__call-btn">
                        <i data-lucide="phone" size="14"></i> DIRECT HOTLINE: 813.699.4009
                    </a>
                    <p class="rwx-widget__fine-print">Licensed · Insured · 24/7 Command</p>
                </div>

                <!-- Technical Badges -->
                <div class="rwx-trust-stack reveal">
                    <div class="rwx-cert-badge">
                        <i data-lucide="shield-check" size="36"></i>
                        <div>
                            <span>IICRC CERTIFIED</span>
                            <p>Global standard mitigation</p>
                        </div>
                    </div>
                    <div class="rwx-cert-badge">
                        <i data-lucide="clock" size="36"></i>
                        <div>
                            <span>24/7 RAPID ALERT</span>
                            <p>Immediate tactical deploy</p>
                        </div>
                    </div>
                    <div class="rwx-cert-badge">
                        <i data-lucide="activity" size="36"></i>
                        <div>
                            <span>DIRECT BILLING</span>
                            <p>Direct insurance mitigation</p>
                        </div>
                    </div>
                </div>

            </div>
        </aside>
    </div>

    <!-- ═══════════════════════════════════════════════════════
         THE RESTOWRX DIFFERENCE TRUST SECTION
         ═══════════════════════════════════════════════════════ -->
    <section class="rwx-trust" aria-label="Why choose Restowrx Elite">
        <div class="rwx-trust__inner">
            <div class="rwx-trust__left reveal">
                <span class="section__label">Operational Integrity</span>
                <h2>Why Florida Trusts<br><em>Restowrx Elite</em></h2>
                <p>We operate at the intersection of structural forensic restoration and advanced mitigation technology. Our teams deliver calculated, high-speed recovery actions to return your commercial or residential property to operational status with zero compromises.</p>
                
                <div class="rwx-trust__stat">
                    <span class="rwx-trust__stat-stars">★★★★★</span>
                    <div class="rwx-trust__stat-info">
                        <strong>5.0 out of 5.0</strong>
                        <span>Emergency Dispatch Rating — 35+ Reviews</span>
                    </div>
                </div>
            </div>

            <div class="rwx-trust__cards reveal">
                <!-- Card 1 -->
                <div class="rwx-trust-card">
                    <span class="rwx-trust-card__num">01</span>
                    <div class="rwx-trust-card__icon">
                        <i data-lucide="shield-check" size="28"></i>
                    </div>
                    <div class="rwx-trust-card__body">
                        <h3>Surgical Mitigation</h3>
                        <p>We run state-of-the-art thermal imaging and high-volume moisture sensing arrays to extract water and capture hidden water lines before mold colonizes.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rwx-trust-card">
                    <span class="rwx-trust-card__num">02</span>
                    <div class="rwx-trust-card__icon">
                        <i data-lucide="scale" size="28"></i>
                    </div>
                    <div class="rwx-trust-card__body">
                        <h3>Direct Insurance Billing</h3>
                        <p>We work directly with your insurance provider. Detailed thermal assessments, comprehensive mapping reports, and seamless direct claim processing.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="rwx-trust-card">
                    <span class="rwx-trust-card__num">03</span>
                    <div class="rwx-trust-card__icon">
                        <i data-lucide="zap" size="28"></i>
                    </div>
                    <div class="rwx-trust-card__body">
                        <h3>60-Min Deploy Radius</h3>
                        <p>Our rapid-response tactical units are fully equipped and active 24/7/365. We deploy immediately within the entire Tampa Bay metro area.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         RELATED SERVICES (Dynamic WP_Query)
         ═══════════════════════════════════════════════════════ -->
    <?php
    $related_args = [
        'post_type'      => 'service',
        'posts_per_page' => 3,
        'post__not_in'   => [$post_id],
        'orderby'        => 'rand',
        'no_found_rows'  => true,
    ];
    if ($categories && !is_wp_error($categories)) {
        $related_args['tax_query'] = [[
            'taxonomy' => 'service_category',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck($categories, 'term_id'),
        ]];
    }
    $related = new WP_Query($related_args);

    // Backfill if same-cat returned fewer than 3
    if ($related->post_count < 3 && $related->post_count > 0) {
        $found_ids   = wp_list_pluck($related->posts, 'ID');
        $exclude_ids = array_merge([$post_id], $found_ids);
        $backfill    = new WP_Query([
            'post_type'      => 'service',
            'posts_per_page' => 3 - $related->post_count,
            'post__not_in'   => $exclude_ids,
            'orderby'        => 'rand',
            'no_found_rows'  => true,
        ]);
        if ($backfill->have_posts()) {
            $related->posts      = array_merge($related->posts, $backfill->posts);
            $related->post_count = count($related->posts);
        }
    }
    if ($related->have_posts()): ?>
    <section class="rwx-related" aria-label="Related services">
        <div class="rwx-related__inner">
            <div class="rwx-related__header reveal">
                <span class="section__label">Operational Matrix</span>
                <h2>Complementary Services</h2>
            </div>
            <div class="rwx-related__grid reveal">
                <?php while ($related->have_posts()): $related->the_post();
                    $r_icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: 'shield';
                ?>
                <a href="<?php the_permalink(); ?>" class="rwx-card">
                    <?php if (has_post_thumbnail()): ?>
                    <div class="rwx-card__thumb">
                        <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']); ?>
                    </div>
                    <?php else: ?>
                    <div class="rwx-card__icon-fallback" aria-hidden="true">
                        <i data-lucide="<?php echo esc_attr($r_icon); ?>" size="40"></i>
                    </div>
                    <?php endif; ?>
                    <div class="rwx-card__body">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        <span class="rwx-card__link">Activate Protocol <i data-lucide="arrow-right" size="14"></i></span>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ═══════════════════════════════════════════════════════
         CTA BLOCK
         ═══════════════════════════════════════════════════════ -->
    <section class="rwx-cta-block" aria-label="Book this service">
        <div class="rwx-cta-block__pulse" aria-hidden="true"></div>
        <div class="rwx-cta-block__inner reveal">
            <span class="rwx-cta-block__eyebrow">CRITICAL INCIDENT ALERT</span>
            <h2 class="rwx-cta-block__title">Need Immediate <em><?php the_title(); ?></em>?</h2>
            <p class="rwx-cta-block__desc">Contact the dispatch center immediately. Our rapid response teams deploy within 60 minutes or less with full thermal drying and high-volume stabilization gear.</p>
            <div class="rwx-cta-block__actions">
                <a href="tel:+18136994009" class="rwx-btn rwx-btn--red">
                    <i data-lucide="phone-call" size="20"></i> CALL DISPATCH: 813.699.4009
                </a>
                <a href="/contact/" class="rwx-btn rwx-btn--outline">
                    <i data-lucide="mail" size="20"></i> Request Online Dispatch
                </a>
            </div>
        </div>
    </section>
    </main>

</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<?php get_footer(); ?>
