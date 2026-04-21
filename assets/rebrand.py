#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""Hot Water Heroes Theme Rebrand Script"""
import os, re

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

def patch(path, replacements):
    with open(path, 'r', encoding='utf-8', errors='replace') as f:
        content = f.read()
    for old, new in replacements:
        content = content.replace(old, new)
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f"  Patched: {os.path.basename(path)}")

def patch_re(path, replacements):
    with open(path, 'r', encoding='utf-8', errors='replace') as f:
        content = f.read()
    for pattern, new in replacements:
        content = re.sub(pattern, new, content)
    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)

# ── 1. style.css ─────────────────────────────────────────────────────────────
print("\n[1/5] Patching style.css...")
css_path = os.path.join(ROOT, 'style.css')

css_replacements = [
    # Theme header
    ('Theme Name:       Livia Med Spa',    'Theme Name:       Hot Water Heroes'),
    ('Theme URI:        https://liviamedspa.com', 'Theme URI:        https://hotwaterheroes.com'),
    ('Author:           Livia Med Spa',    'Author:           Hot Water Heroes'),
    ('Author URI:       https://liviamedspa.com', 'Author URI:       https://hotwaterheroes.com'),
    ('Text Domain:      livia-medspa',     'Text Domain:      hot-water-heroes'),
    ('LIVIA MED SPA - DESIGN TOKEN SYSTEM', 'HOT WATER HEROES - DESIGN TOKEN SYSTEM'),
    # Root block — brand colors
    ('/* Brand purples */', '/* Brand Red & Navy */'),
    ('  --brand:            #AC13F9;', '  --brand:            #F22F3A;'),
    ('  --brand-dark:       #7A0BB8;', '  --brand-dark:       #AF2D37;'),
    ('  --brand-mid:        #9B2FD0;', '  --brand-mid:        #F0595F;'),
    ('  --brand-bright:     #D06AF5;', '  --brand-bright:     #F0595F;'),
    ('  --brand-pink:       #F471D1;', '  --brand-pink:       #F0595F;'),
    ('  --brand-pink-mid:   #C955F0;', '  --brand-pink-mid:   #AF2D37;'),
    ('  --brand-882:        #882BC4;', '  --brand-882:        #AF2D37;'),
    ('  --brand-rgb:        172, 19, 249;', '  --brand-rgb:        242, 47, 58;'),
    ('  --cream-rgb:        250, 248, 245;', '  --cream-rgb:        248, 249, 251;'),
    ('  --dark-rgb:         26, 14, 46;',  '  --dark-rgb:         24, 55, 93;'),
    ('  --ink-rgb:          26, 26, 46;',  '  --ink-rgb:          15, 36, 64;'),
    ('  --bg-cream:         #FAF7F4;', '  --bg-cream:         #F8F9FB;'),
    ('  --bg-alt:           #F5EFE8;', '  --bg-alt:           #EEF2F8;'),
    ('  --bg-warm:          #F0EBE3;', '  --bg-warm:          #E8EEF7;'),
    ('  --bg-lavender:      #F3EEF9;', '  --bg-light-blue:    #E5EBF5;'),
    ('  --bg-lavender-deep: #EDE6F7;', '  --bg-light-blue-deep: #D8E2F0;'),
    ('  --bg-petal:         #E8DFF5;', '  --bg-petal:         #DDEAF8;'),
    ('  --bg-blush:         #FDF9F6;', '  --bg-blush:         #F4F6FA;'),
    ('  --text-dark:        #1A0E2E;', '  --text-dark:        #0F2440;'),
    ('  --text-body:        #4A3B54;', '  --text-body:        #1C3A5E;'),
    ('  --text-mid:         #5A4660;', '  --text-mid:         #2A4F7A;'),
    ('  --text-muted:       #6B5B73;', '  --text-muted:       #3D6491;'),
    ('  --text-subtle:      #8A7B8F;', '  --text-subtle:      #5A7FA8;'),
    ('  --text-faint:       #A899AD;', '  --text-faint:       #7A9CC0;'),
    ('  --text-pale:        #B0A4BA;', '  --text-pale:        #9DB8D6;'),
    ('  --surface-card:     #4A3560;', '  --surface-card:     #18375D;'),
    ('  --surface-ink:      #2A1832;', '  --surface-ink:      #0F2440;'),
    ('  --border-soft:      #E6E0D6;', '  --border-soft:      #D0DAEA;'),
    ('  --border-warm:      #EDE7DF;', '  --border-warm:      #C8D5E6;'),
    # Hardcoded color instances
    ('#AC13F9', '#F22F3A'),
    ('#7A0BB8', '#AF2D37'),
    ('#9B2FD0', '#F0595F'),
    ('#D06AF5', '#F0595F'),
    ('#F471D1', '#F0595F'),
    ('#C955F0', '#AF2D37'),
    ('#882BC4', '#AF2D37'),
    ('172, 19, 249', '242, 47, 58'),
    ('#1A0E2E', '#0F2440'),
    ('#FAF7F4', '#F8F9FB'),
    ('#F5EFE8', '#EEF2F8'),
    ('#F0EBE3', '#E8EEF7'),
    ('#4A3B54', '#1C3A5E'),
    ('#5A4660', '#2A4F7A'),
    ('#6B5B73', '#3D6491'),
    ('#8A7B8F', '#5A7FA8'),
    ('#A899AD', '#7A9CC0'),
    ('#B0A4BA', '#9DB8D6'),
    ('#4A3560', '#18375D'),
    ('#2A1832', '#0F2440'),
    ('#E6E0D6', '#D0DAEA'),
    ('#EDE7DF', '#C8D5E6'),
    ('#d4b87a', '#AF2D37'),
    # Fonts
    ("'Cormorant Garamond', Georgia, serif", "'Montserrat', Georgia, serif"),
    ("'Cormorant Garamond', serif",          "'Montserrat', serif"),
    ("'Cormorant Garamond'",                 "'Montserrat'"),
    ("'DM Sans', 'Helvetica Neue', Arial, sans-serif", "'Inter', 'Helvetica Neue', Arial, sans-serif"),
    ("'DM Sans', sans-serif",                          "'Inter', sans-serif"),
    ("'DM Sans'",                                      "'Inter'"),
]
patch(css_path, css_replacements)

# ── 2. functions.php ─────────────────────────────────────────────────────────
print("\n[2/5] Patching functions.php...")
func_path = os.path.join(ROOT, 'functions.php')

func_replacements = [
    # Comment header
    ('LIVIA Med Spa \u2014 Theme Functions', 'Hot Water Heroes \u2014 Theme Functions'),
    # Google Fonts
    (
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap'
    ),
    # Enqueue handles
    ("'livia-google-fonts'", "'hwh-google-fonts'"),
    ("'livia-style'",        "'hwh-style'"),
    # Function/option/hook prefixes
    ('livia_setup',             'hwh_setup'),
    ('livia_disable_emojis',    'hwh_disable_emojis'),
    ('livia_cleanup_head',      'hwh_cleanup_head'),
    ('livia_disable_oembed',    'hwh_disable_oembed'),
    ('livia_dequeue_block_styles', 'hwh_dequeue_block_styles'),
    ('livia_deregister_jquery', 'hwh_deregister_jquery'),
    ('livia_force_page_templates', 'hwh_force_page_templates'),
    ('livia_enqueue_styles',    'hwh_enqueue_styles'),
    ('livia_async_styles',      'hwh_async_styles'),
    ('livia_resource_hints',    'hwh_resource_hints'),
    ('livia_cached_image_url',  'hwh_cached_image_url'),
    ('livia_script_loader_tag', 'hwh_script_loader_tag'),
    ('livia_schema_markup',     'hwh_schema_markup'),
    ('livia_create_pages',      'hwh_create_pages'),
    ('livia_fix_reading_settings', 'hwh_fix_reading_settings'),
    ('livia_page_slug_exists',  'hwh_page_slug_exists'),
    ('livia_create_privacy_page', 'hwh_create_privacy_page'),
    ('livia_create_cancellation_page', 'hwh_create_cancellation_page'),
    ('livia_create_refund_page', 'hwh_create_refund_page'),
    ('livia_create_beauty_bank_page', 'hwh_create_specials_page'),
    ('livia_create_blog_posts', 'hwh_create_blog_posts'),
    ('livia_create_services',   'hwh_create_services'),
    # Options
    ("'livia_pages_created_v5'",         "'hwh_pages_created_v5'"),
    ("'livia_reading_fixed_v2'",         "'hwh_reading_fixed_v2'"),
    ("'livia_privacy_page_created_v1'",  "'hwh_privacy_page_created_v1'"),
    ("'livia_cancellation_page_created_v1'", "'hwh_cancellation_page_created_v1'"),
    ("'livia_refund_page_created_v1'",   "'hwh_refund_page_created_v1'"),
    ("'livia_beauty_bank_page_created_v1'", "'hwh_specials_page_created_v1'"),
    ("'livia_blog_created_v1'",          "'hwh_blog_created_v1'"),
    ("'livia_services_created_v2'",      "'hwh_services_created_v2'"),
    # Popup theme mods
    ("'livia_popup_enabled'",  "'hwh_popup_enabled'"),
    ("'livia_popup_expiry'",   "'hwh_popup_expiry'"),
    ("'livia_popup_badge'",    "'hwh_popup_badge'"),
    ("'livia_popup_title'",    "'hwh_popup_title'"),
    ("'livia_popup_text'",     "'hwh_popup_text'"),
    ("'livia_popup_code'",     "'hwh_popup_code'"),
    ("'livia_popup_btn_text'", "'hwh_popup_btn_text'"),
    ("'livia_popup_btn_url'",  "'hwh_popup_btn_url'"),
    ("'livia_popup_delay'",    "'hwh_popup_delay'"),
    ("'livia_popup_frequency'", "'hwh_popup_frequency'"),
    # AJAX action
    ("'livia_contact_submit'", "'hwh_contact_submit'"),
    # Image cache dir
    ('/livia-img-cache', '/hwh-img-cache'),
    # Agent header
    ("'User-Agent' => 'Mozilla/5.0 (compatible; LIVIAMedSpa/1.0)'",
     "'User-Agent' => 'Mozilla/5.0 (compatible; HotWaterHeroes/1.0)'"),
    # Business info
    ('LIVIA Med Spa', 'Hot Water Heroes Plumbing'),
    ('Livia Med Spa', 'Hot Water Heroes Plumbing'),
    ('liviamedspa.com', 'hotwaterheroes.com'),
    ('support@liviamedspa.com', 'info@hotwaterheroes.com'),
    ('+18132302219', '+18135551234'),
    # Schema types
    ("'MedicalBusiness', 'MedSpa', 'LocalBusiness'", "'Plumber', 'HomeAndConstructionBusiness', 'LocalBusiness'"),
    ("['MedicalBusiness', 'MedSpa', 'LocalBusiness']", "['Plumber', 'HomeAndConstructionBusiness', 'LocalBusiness']"),
    ('[\'MedicalBusiness\', \'MedSpa\', \'LocalBusiness\']', '[\'Plumber\', \'HomeAndConstructionBusiness\', \'LocalBusiness\']'),
    ("'MedicalBusiness'", "'Plumber'"),
    ("'MedSpa'", "'HomeAndConstructionBusiness'"),
    ("'MedicalTherapy'", "'Service'"),
    ("'MedicalProcedure'", "'Service'"),
    ("'Service', 'MedicalProcedure'", "'Service'"),
    ("medicalSpecialty", "serviceType"),
    ("'Dermatology'", "'Plumbing'"),
    # Provider
    ('Angela Spicola', 'HWH Master Plumbers'),
    ('Angela', 'HWH Team'),
    ("'APRN'", "'Master Plumber'"),
    ('APRN', 'Master Plumber'),
    # Location
    ('Tampa, FL', 'Tampa, FL'),
    # Page slug: beauty-bank -> specials
    ("'beauty-bank'", "'specials'"),
    ("'Beauty Bank Membership'", "'Specials'"),
    ("'Beauty Bank'", "'Specials'"),
    # Services (spa -> plumbing)
    ("'Botox & Neuromodulators'", "'Water Heater Repair'"),
    ("'Dermal Fillers'",         "'Water Heater Installation'"),
    ("'RF Microneedling'",       "'Tankless Water Heaters'"),
    ("'Laser Skin Resurfacing'", "'Drain Cleaning'"),
    ("'Medical-Grade Facials'",  "'Emergency Plumbing'"),
    ("'IV Therapy'",             "'Leak Detection'"),
    ("'Kybella'",                "'Pipe Repair & Repiping'"),
    ("'Helix CO2 Laser'",        "'Sewer & Water Line'"),
    ("'Weight Loss Programs'",   "'Plumbing Inspections'"),
    # Blog categories
    ("'Skincare'",    "'Tips & Maintenance'"),
    ("'Injectables'", "'Water Heaters'"),
    ("'Wellness'",    "'Emergency Services'"),
    ("'Treatments'",  "'How-To Guides'"),
    ("'Beauty Tips'", "'HWH News'"),
    # Service categories
    ("'Injectables'",     "'Water Heater Services'"),
    ("'Skin & Facials'",  "'Drain & Pipe Services'"),
    ("'Body & Wellness'", "'Emergency & General'"),
    # DNS prefetch
    ('dns-prefetch" href="//liviamedspa.com"', 'dns-prefetch" href="//hotwaterheroes.com"'),
    # Fonts preload (Cormorant + DM Sans -> remove, Google Fonts will load)
    ("'livia-google-fonts'", "'hwh-google-fonts'"),
]
patch(func_path, func_replacements)

# ── 3. header.php ─────────────────────────────────────────────────────────────
print("\n[3/5] Patching header.php...")
header_path = os.path.join(ROOT, 'header.php')

header_replacements = [
    # File comment
    ('LIVIA Med Spa \u2014 Header Template', 'Hot Water Heroes \u2014 Header Template'),
    # Meta tags
    ('LIVIA Med Spa', 'Hot Water Heroes Plumbing'),
    ('Livia Med Spa', 'Hot Water Heroes Plumbing'),
    ("content=\"#1A0E2E\"", "content=\"#0F2440\""),
    ("content=\"#F0EBE3\"", "content=\"#E8EEF7\""),
    ('liviamedspa.com', 'hotwaterheroes.com'),
    ('@liviamedspa', '@hotwaterheroes'),
    ("Tampa's premier medical spa offering Botox", "Tampa Bay's trusted plumbing experts offering"),
    ("Tampa's premier boutique medical spa", "Tampa Bay's trusted plumbing company"),
    # Logo
    ('https://liviamedspa.com/wp-content/uploads/2026/03/New-Livia-Logo.png',
     'https://hotwaterheroes.com/wp-content/uploads/hwh-logo.png'),
    ('alt="LIVIA Med Spa"', 'alt="Hot Water Heroes Plumbing"'),
    ('alt="Hot Water Heroes Plumbing" class="site-logo__img" width="160"', 
     'alt="Hot Water Heroes Plumbing" class="site-logo__img" width="180"'),
    # aria-labels
    ('aria-label="Hot Water Heroes Plumbing \u2014 Home"', 'aria-label="Hot Water Heroes \u2014 Home"'),
    # Critical CSS inline fonts
    ("'Cormorant Garamond', Georgia, serif", "'Montserrat', Georgia, serif"),
    ("'Cormorant Garamond'", "'Montserrat'"),
    ("'DM Sans'", "'Inter'"),
    ("background: #FAF7F4;", "background: #F8F9FB;"),
    ("background: linear-gradient(135deg, #AC13F9 0%, #F471D1 100%);",
     "background: linear-gradient(135deg, #F22F3A 0%, #F0595F 100%);"),
    ("color: #C955F0;", "color: #AF2D37;"),
    ("background: #F5EFE8;", "background: #EEF2F8;"),
    # Nav: update menu items for plumbing
    ('New Client Special', 'Free Estimate Available'),
    ('$50 Off Your First Visit', 'Get a Free Estimate'),
    ("Experience Tampa's most advanced aesthetic", "Tampa Bay's trusted licensed plumbers"),
    ('treatments with a personalized consultation.', 'available 24/7 for emergencies.'),
    ('/memberships/', '/financing/'),
    ('>Memberships<', '>Financing<'),
    ('/parties/', '/about/'),
    ('>Parties<', '>About<'),
    # Google Fonts preconnect already in place; URL will be loaded from functions.php
]
patch(header_path, header_replacements)

# ── 4. footer.php ─────────────────────────────────────────────────────────────
print("\n[4/5] Patching footer.php...")
footer_path = os.path.join(ROOT, 'footer.php')

footer_replacements = [
    # Comment
    ('LIVIA Med Spa \u2014 Footer Template', 'Hot Water Heroes \u2014 Footer Template'),
    ('LIVIA Med Spa', 'Hot Water Heroes'),
    ('Livia Med Spa', 'Hot Water Heroes'),
    ('liviamedspa.com', 'hotwaterheroes.com'),
    # JS keys
    ("'livia-cookie-consent'", "'hwh-cookie-consent'"),
    ("'livia-popup-dismissed'", "'hwh-popup-dismissed'"),
    ('livia_contact_submit', 'hwh_contact_submit'),
    ('livia_popup_enabled', 'hwh_popup_enabled'),
    ('livia_popup_expiry', 'hwh_popup_expiry'),
    ('livia_popup_badge', 'hwh_popup_badge'),
    ('livia_popup_title', 'hwh_popup_title'),
    ('livia_popup_text', 'hwh_popup_text'),
    ('livia_popup_code', 'hwh_popup_code'),
    ('livia_popup_btn_text', 'hwh_popup_btn_text'),
    ('livia_popup_btn_url', 'hwh_popup_btn_url'),
    ('livia_popup_delay', 'hwh_popup_delay'),
    ('livia_popup_frequency', 'hwh_popup_frequency'),
    # livia_ function calls in inline JS
    ('livia_cached_image_url', 'hwh_cached_image_url'),
    # Client portal section
    ('Click. Book. <em>Glow.</em>', 'Click. Book. <em>Fixed.</em>'),
    ('Access the LIVIA Med Spa Client Portal to easily manage your appointments, view your vouchers and memberships, and share referral links with friends. Enjoy a seamless, secure experience that puts all your spa benefits and perks right at your fingertips.',
     "Access the Hot Water Heroes booking portal to easily manage your service appointments, get quotes, track technician status, and view your service history. Convenient, secure, and available 24/7."),
    ('View vouchers &amp; memberships', 'Track service history &amp; invoices'),
    ('Share referral links &amp; earn rewards', 'Refer a neighbor, earn discounts'),
    ('Secure, HIPAA-compliant access', 'Secure 24/7 online access'),
    ('Manage your appointments 24/7', 'Book service calls 24/7'),
    ('alt="LIVIA Med Spa Client Portal on Phone"', 'alt="Hot Water Heroes Booking App"'),
    # Client portal image
    ('https://liviamedspa.com/wp-content/uploads/2026/02/Phone-mockup-1-scaled-e1770923706701-768x979.png',
     'https://hotwaterheroes.com/wp-content/uploads/hwh-app-mockup.png'),
    # Footer logo
    ('https://liviamedspa.com/wp-content/uploads/2026/03/Livia-Logo-White.png',
     'https://hotwaterheroes.com/wp-content/uploads/hwh-logo-white.png'),
    # Brand text
    ("Tampa's premier destination for advanced aesthetics, proudly serving South Tampa, Hyde Park, Westchase, Brandon, and St. Petersburg.",
     "Tampa Bay's trusted plumbing experts. Serving Tampa, St. Pete, Clearwater, Brandon, Wesley Chapel & surrounding areas."),
    # Social links
    ('https://www.instagram.com/liviamedspa/', 'https://www.instagram.com/hotwaterheroes/'),
    ('https://www.facebook.com/p/Livia-Med-Spa-61561610168278/', 'https://www.facebook.com/hotwaterheroes/'),
    # Footer nav
    ('Popular Treatments', 'Our Services'),
    ('>Before &amp; After<', '>Service Areas<'),
    ('/before-after/', '/service-areas/'),
    ('>Memberships<', '>Financing<'),
    ('/memberships/', '/financing/'),
    ('>Parties<', '>Service Areas<'),
    ('/parties/', '/service-areas/'),
    ('>Beauty Bank<', '>Specials<'),
    ('/beauty-bank/', '/specials/'),
    # Service links
    ('/services/botox/', '/services/water-heater-repair/'),
    ('/services/dermal-fillers/', '/services/water-heater-installation/'),
    ('/services/microneedling/', '/services/tankless-water-heaters/'),
    ('/services/chemical-peels/', '/services/drain-cleaning/'),
    ('/services/laser-treatments/', '/services/emergency-plumbing/'),
    ('/services/weight-loss/', '/services/leak-detection/'),
    ('>Botox<', '>Water Heater Repair<'),
    ('>Dermal Fillers<', '>Water Heater Installation<'),
    ('>Microneedling<', '>Tankless Water Heaters<'),
    ('>Chemical Peels<', '>Drain Cleaning<'),
    ('>Laser Treatments<', '>Emergency Plumbing<'),
    ('>Weight Loss<', '>Leak Detection<'),
    # Contact
    ('10043 N Dale Mabry Hwy, Tampa, FL 33618', 'Tampa Bay Area, FL'),
    ('tel:8132302219', 'tel:+18135551234'),
    ('(813) 230-2219', '(813) 555-1234'),
    ('Mon\u2013Wed: 9am\u20137pm \u00a0|\u00a0 Thu\u2013Sat: 9am\u20134pm',
     'Mon\u2013Fri: 7am\u20136pm \u00a0|\u00a0 24/7 Emergency Service'),
    ('Connection error. Please call us at (813) 230-2219.', 'Connection error. Please call us at (813) 555-1234.'),
    # Newsletter
    ('Stay in the Glow \u2728', 'Stay in the Know \U0001f527'),
    ('Get exclusive offers, beauty tips, and early access to new treatments.',
     'Get plumbing tips, seasonal maintenance reminders, and exclusive service discounts.'),
    # Copyright / legal
    ('LIVIA Med Spa. All rights reserved.', 'Hot Water Heroes Plumbing. All rights reserved.'),
    ('/cancellation-policy/', '/terms-of-service/'),
    ('>Cancellation Policy<', '>Terms of Service<'),
    ('/refund-policy/', '/warranty/'),
    ('>Refund Policy<', '>Warranty Policy<'),
    # Social proof
    ("'Sarah M.','Jessica L.','Emily R.','Amanda K.','Lauren B.','Michelle T.','Brittany S.','Courtney H.','Taylor N.','Kayla D.','Madison F.','Rachel W.','Stephanie V.','Megan C.','Olivia P.','Ashley R.','Natalie G.','Danielle M.'",
     "'John M.','Mike T.','Dave R.','Chris K.','Tom B.','Robert H.','Steve N.','Kevin D.','Mark F.','Brian W.','Jason V.','Paul C.','Larry P.','Gary R.','Ryan G.','Scott M.'"),
    ("'Botox','Dermal Fillers','Chemical Peel','Microneedling','IV Therapy','Laser Treatment','Lip Filler','Skincare Consultation','RF Microneedling','Helix CO2 Laser'",
     "'Water Heater Repair','Water Heater Install','Drain Cleaning','Tankless Upgrade','Emergency Call','Leak Repair','Pipe Repair','Sewer Line Service','Plumbing Inspection','Maintenance Plan'"),
    # Booking CTA
    ('Book Consultation', 'Request Service'),
    ('#book-now', '#request-service'),
    ('href="#book-now"', 'href="#request-service"'),
    # Boulevard widget comment
    ("businessId: '9563faa5-e2e5-4a6a-b5f5-0636ea78b80e',",
     "// TODO: Add HWH booking widget ID here"),
    # Ageless AI section - mark as TODO
    ('ageless.ai', 'hotwaterheroes.com'),
    ('Ageless AI', 'HWH Preview'),
    ('livia_cached_image_url', 'hwh_cached_image_url'),
    # livia function refs still in footer JS (contact form action)
    ("data.set('action', 'livia_contact_submit')", "data.set('action', 'hwh_contact_submit')"),
]
patch(footer_path, footer_replacements)

# ── 5. All other PHP files ─────────────────────────────────────────────────────
print("\n[5/5] Bulk-patching remaining PHP files...")
skip = {'functions.php', 'header.php', 'footer.php'}

bulk = [
    ('LIVIA Med Spa', 'Hot Water Heroes Plumbing'),
    ('Livia Med Spa', 'Hot Water Heroes Plumbing'),
    ('LIVIA', 'HWH'),
    ('livia_', 'hwh_'),
    ('liviamedspa.com', 'hotwaterheroes.com'),
    ('(813) 230-2219', '(813) 555-1234'),
    ('8132302219', '18135551234'),
    ('Angela Spicola, APRN', 'our licensed plumbers'),
    ('Angela Spicola', 'Our Team'),
    ("Tampa's premier medical spa", "Tampa Bay's trusted plumbing experts"),
    ("Tampa's premier", "Tampa Bay's leading"),
    ("Tampa's most trusted medical professionals", "Tampa Bay's most trusted plumbers"),
    ('Book Consultation', 'Request Service'),
    ('book consultation', 'request service'),
    ('#book-now', '#request-service'),
    ('href="#book-now"', 'href="#request-service"'),
    ('/memberships/', '/financing/'),
    ('/parties/', '/about/'),
    ('/beauty-bank/', '/specials/'),
    ('/products/', '/services/'),
    ('Memberships', 'Financing'),
    ('aesthetic treatment', 'plumbing service'),
    ('Aesthetic treatment', 'Plumbing service'),
    ('beauty-bank', 'specials'),
]

for fname in os.listdir(ROOT):
    if not fname.endswith('.php'):
        continue
    if fname in skip:
        continue
    fpath = os.path.join(ROOT, fname)
    patch(fpath, bulk)

print("\nAll done! Hot Water Heroes rebrand complete.")
