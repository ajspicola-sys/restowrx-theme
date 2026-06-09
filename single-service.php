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

    /* Left Column Content - High-end glassmorphism */
    .rwx-intel {
        background: rgba(10, 10, 10, 0.65);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: clamp(30px, 5vw, 60px);
        border-radius: 12px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        position: relative;
    }

    .rwx-intel::before {
        content: '';
        position: absolute;
        top: 0; left: 40px; right: 40px; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 0, 0, 0.3), transparent);
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
        content: 'ACTIVE SYSTEM...';
        position: absolute;
        top: 15px; left: 15px;
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 0.65rem;
        color: var(--brand, #ff0000);
        letter-spacing: 2px;
        z-index: 10;
        background: rgba(0,0,0,0.65);
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
        background: rgba(10, 10, 10, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 35px;
        border-radius: 12px;
        position: relative;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
    }

    .rwx-widget--dispatch {
        border-top: 6px solid var(--brand, #ff0000);
        box-shadow: 0 25px 55px rgba(0, 0, 0, 0.7);
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
        color: #999; /* Brightened from #666 to #999 for contrast */
        font-weight: 700;
        letter-spacing: 1.5px;
        margin: 0 0 25px 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .rwx-widget__radar i, .rwx-widget__radar svg {
        color: var(--brand, #ff0000) !important;
        width: 12px;
        height: 12px;
        display: inline-block;
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
        align-items: center;
        width: 100%;
        font-size: 0.9rem;
    }

    .rwx-meta-divider {
        flex-grow: 1;
        border-bottom: 1px dotted rgba(255, 255, 255, 0.18);
        margin: 0 10px;
        position: relative;
        top: -2px;
    }

    .rwx-meta-row span:first-child {
        color: #888;
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
        background: rgba(255, 0, 0, 0.04);
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.15);
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
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
    }

    .rwx-widget--dispatch input[type="submit"]:hover,
    .rwx-widget--dispatch .wpcf7-submit:hover {
        background: #111111 !important;
        color: white !important;
        border: 1px solid var(--brand, #ff0000) !important;
        box-shadow: 0 0 25px rgba(255, 0, 0, 0.6);
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

    .rwx-widget--dispatch .rwx-widget__call-btn i,
    .rwx-widget--dispatch .rwx-widget__call-btn svg {
        width: 14px;
        height: 14px;
        display: inline-block;
        color: currentColor;
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
        background: rgba(10, 10, 10, 0.6);
        backdrop-filter: blur(8px);
        padding: 20px;
        border-left: 3px solid rgba(255, 0, 0, 0.4);
        border-radius: 0 8px 8px 0;
        border-top: 1px solid rgba(255,255,255,0.04);
        border-right: 1px solid rgba(255,255,255,0.04);
        border-bottom: 1px solid rgba(255,255,255,0.04);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .rwx-cert-badge:hover {
        background: rgba(25, 10, 10, 0.5);
        border-left-color: var(--brand, #ff0000);
        border-top-color: rgba(255, 0, 0, 0.15);
        border-right-color: rgba(255, 0, 0, 0.15);
        border-bottom-color: rgba(255, 0, 0, 0.15);
        box-shadow: 0 15px 35px rgba(255, 0, 0, 0.05);
        transform: translateX(4px);
    }

    .rwx-cert-badge i, .rwx-cert-badge svg {
        color: var(--brand, #ff0000);
        width: 32px;
        height: 32px;
        display: inline-block;
        flex-shrink: 0;
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
        color: #999; /* Brightened from #666 to #999 for contrast */
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
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .rwx-trust-card:hover {
        border-color: rgba(255, 0, 0, 0.25);
        background: rgba(25, 15, 15, 0.6);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 0, 0, 0.05);
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
        background: rgba(255,0,0,0.05);
        width: 60px; height: 60px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,0,0,0.15);
        transition: all 0.3s ease;
    }

    .rwx-trust-card:hover .rwx-trust-card__icon {
        background: rgba(255, 0, 0, 0.15);
        border-color: var(--brand, #ff0000);
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.3);
    }

    .rwx-trust-card__icon i, .rwx-trust-card__icon svg {
        width: 24px;
        height: 24px;
        color: var(--brand, #ff0000) !important;
        display: inline-block;
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
        color: #999;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    .rwx-trust-card__num {
        font-family: var(--font-mono, 'Space Mono', monospace);
        font-size: 2.2rem;
        font-weight: 700;
        color: rgba(255,255,255,0.03);
        position: absolute;
        right: 25px;
        bottom: 15px;
        pointer-events: none;
        line-height: 1;
        transition: all 0.3s ease;
    }

    .rwx-trust-card:hover .rwx-trust-card__num {
        color: rgba(255, 0, 0, 0.08);
        transform: scale(1.1) translateY(-5px);
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
        background: rgba(10, 10, 10, 0.65);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 8px;
        overflow: hidden;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    .rwx-card:hover {
        border-color: rgba(255, 0, 0, 0.3);
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(255, 0, 0, 0.12);
        background: rgba(18, 10, 10, 0.7);
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
    <section class="page-hero" aria-label="Service details" itemscope itemtype="https://schema.org/Service">
        <meta itemprop="name" content="<?php the_title_attribute(); ?>">
        <meta itemprop="areaServed" content="Tampa Bay, FL">
        <div class="page-hero__inner">
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

            <h1 class="page-hero__title">
                <?php the_title(); ?><br><em>Emergency Restoration</em>
            </h1>

            <?php if (has_excerpt()): ?>
                <p class="page-hero__desc"><?php echo get_the_excerpt(); ?></p>
            <?php else: ?>
                <p class="page-hero__desc">Operating at the peak of recovery science. We deliver high-grade property restoration for residential and commercial structures under strict emergency response timelines.</p>
            <?php endif; ?>

            <div class="page-hero__actions" style="margin-top: 25px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="/contact/" class="btn btn--primary btn--lg" style="font-family: var(--font-accent); font-size: 1.2rem; letter-spacing: 1px; padding: 10px 25px;"><i data-lucide="shield-alert" size="18"></i> Activate Response</a>
                <a href="tel:+18136994009" class="btn btn--outline btn--lg" style="font-family: var(--font-accent); font-size: 1.2rem; letter-spacing: 1px; padding: 10px 25px;"><i data-lucide="phone-call" size="18"></i> Call 813.699.4009</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════
         CONTENT + STICKY SIDEBAR
         ═══════════════════════════════════════════════════════ -->
    <div class="single-service-page">
    <div class="rwx-matrix">
        
        <!-- LEFT: SERVICE OVERVIEW (Main content body) -->
        <article class="rwx-intel reveal" itemprop="description">
            <div class="rwx-content-body">
                <?php the_content(); ?>
            </div>
            
            <div class="rwx-gallery">
                <div class="rwx-gallery__item">
                    <img src="https://images.unsplash.com/photo-1581094288338-2314dddb7eed?q=80&w=800" alt="Extraction Scan" class="rwx-gallery__img">
                </div>
                <div class="rwx-gallery__item">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=800" alt="Drying Array" class="rwx-gallery__img">
                </div>
            </div>
        </article>

        <!-- RIGHT: SIDEBAR (Sticky Quick Info & Form) -->
        <aside class="rwx-sidebar">
            <div class="rwx-sidebar-sticky">
                
                <!-- Dispatch Box -->
                <div class="rwx-widget rwx-widget--dispatch reveal">
                    <div class="rwx-widget__header">
                        <h3>Emergency Dispatch</h3>
                        <div class="rwx-status-dot"></div>
                    </div>
                    <div class="rwx-widget__radar">
                        <i data-lucide="radio" size="14"></i> 60-MINUTE EMERGENCY DISPATCH
                    </div>

                    <div class="rwx-meta-list">
                        <?php if ($price): ?>
                        <div class="rwx-meta-row">
                            <span>Starting At</span>
                            <span class="rwx-meta-divider"></span>
                            <span><?php echo esc_html($price); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($duration): ?>
                        <div class="rwx-meta-row">
                            <span>Response Time</span>
                            <span class="rwx-meta-divider"></span>
                            <span><?php echo esc_html($duration); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="rwx-meta-row">
                            <span>Classification</span>
                            <span class="rwx-meta-divider"></span>
                            <span><?php echo esc_html($category_name); ?></span>
                        </div>
                    </div>

                    <?php 
                    // Render Custom Sidebar Form
                    echo rwx_render_contact_form('rwx-sidebar-contact'); 
                    ?>

                    <a href="tel:+18136994009" class="rwx-widget__call-btn">
                        <i data-lucide="phone" size="14"></i> DIRECT HOTLINE: 813.699.4009
                    </a>
                    <p class="rwx-widget__fine-print">Licensed · Insured · 24/7 Dispatch</p>
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
                            <p>Immediate emergency response</p>
                        </div>
                    </div>
                    <div class="rwx-cert-badge">
                        <i data-lucide="activity" size="36"></i>
                        <div>
                            <span>DIRECT BILLING</span>
                            <p>Direct insurance coordination</p>
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
                <span class="section__label">Why Florida Trusts Us</span>
                <h2>Why Florida Trusts<br><em>Restowrx Elite</em></h2>
                <p>We operate at the intersection of high-grade restoration standards and advanced mitigation technology. Our teams deliver highly responsive restoration services to return your commercial or residential property to operational status with zero compromises.</p>
                
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
                        <h3>Advanced Mitigation</h3>
                        <p>We run state-of-the-art thermal imaging and high-volume moisture sensing arrays to extract water and detect hidden moisture before mold colonizes.</p>
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
                        <h3>60-Minute Response Area</h3>
                        <p>Our rapid-response mitigation teams are fully equipped and active 24/7/365. We deploy immediately within the entire Tampa Bay metro area.</p>
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
                <span class="section__label">Restowrx Services</span>
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
                        <span class="rwx-card__link">View Details <i data-lucide="arrow-right" size="14"></i></span>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    </div>

</main>



<?php get_footer(); ?>
