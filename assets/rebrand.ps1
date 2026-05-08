
# Hot Water Heroes Rebrand Script
# Avoids inline PHP tags by using [char] encoding for < and >
Set-StrictMode -Off
$root = "c:\Users\ajspi_j\.gemini\antigravity\scratch\Hot-Water-Heroes-theme"

function ApplyReplacements {
    param([string]$FilePath, [array]$Pairs)
    $content = [System.IO.File]::ReadAllText($FilePath, [System.Text.Encoding]::UTF8)
    foreach ($pair in $Pairs) {
        $content = $content.Replace($pair[0], $pair[1])
    }
    [System.IO.File]::WriteAllText($FilePath, $content, [System.Text.Encoding]::UTF8)
    Write-Host "  Done: $([System.IO.Path]::GetFileName($FilePath))"
}

# ── 1. style.css ─────────────────────────────────────────────────────────────
Write-Host "`n[1] style.css"
$cssPath = Join-Path $root 'style.css'
$cssPairs = @(
    @('Theme Name:       Livia Med Spa',    'Theme Name:       Hot Water Heroes'),
    @('Theme URI:        https://liviamedspa.com', 'Theme URI:        https://hotwaterheroesplumbing.com'),
    @('Author:           Livia Med Spa',    'Author:           Hot Water Heroes'),
    @('Author URI:       https://liviamedspa.com', 'Author URI:       https://hotwaterheroesplumbing.com'),
    @('Text Domain:      livia-medspa',     'Text Domain:      hot-water-heroes'),
    @('LIVIA MED SPA - DESIGN TOKEN SYSTEM', 'HOT WATER HEROES - DESIGN TOKEN SYSTEM'),
    @('/* Brand purples */', '/* Brand Red, Navy & White */'),
    @('  --brand:            #AC13F9;', '  --brand:            #F22F3A;'),
    @('  --brand-dark:       #7A0BB8;', '  --brand-dark:       #AF2D37;'),
    @('  --brand-mid:        #9B2FD0;', '  --brand-mid:        #F0595F;'),
    @('  --brand-bright:     #D06AF5;', '  --brand-bright:     #F0595F;'),
    @('  --brand-pink:       #F471D1;', '  --brand-pink:       #F0595F;'),
    @('  --brand-pink-mid:   #C955F0;', '  --brand-pink-mid:   #AF2D37;'),
    @('  --brand-882:        #882BC4;', '  --brand-882:        #AF2D37;'),
    @('  --brand-rgb:        172, 19, 249;', '  --brand-rgb:        242, 47, 58;'),
    @('  --cream-rgb:        250, 248, 245;', '  --cream-rgb:        248, 249, 251;'),
    @('  --dark-rgb:         26, 14, 46;',  '  --dark-rgb:         24, 55, 93;'),
    @('  --ink-rgb:          26, 26, 46;',  '  --ink-rgb:          15, 36, 64;'),
    @('  --bg-cream:         #FAF7F4;', '  --bg-cream:         #F8F9FB;'),
    @('  --bg-alt:           #F5EFE8;', '  --bg-alt:           #EEF2F8;'),
    @('  --bg-warm:          #F0EBE3;', '  --bg-warm:          #E8EEF7;'),
    @('  --bg-lavender:      #F3EEF9;', '  --bg-light-blue:    #E5EBF5;'),
    @('  --bg-lavender-deep: #EDE6F7;', '  --bg-light-blue-deep: #D8E2F0;'),
    @('  --bg-petal:         #E8DFF5;', '  --bg-petal:         #DDEAF8;'),
    @('  --bg-blush:         #FDF9F6;', '  --bg-blush:         #F4F6FA;'),
    @('  --text-dark:        #1A0E2E;', '  --text-dark:        #0F2440;'),
    @('  --text-body:        #4A3B54;', '  --text-body:        #1C3A5E;'),
    @('  --text-mid:         #5A4660;', '  --text-mid:         #2A4F7A;'),
    @('  --text-muted:       #6B5B73;', '  --text-muted:       #3D6491;'),
    @('  --text-subtle:      #8A7B8F;', '  --text-subtle:      #5A7FA8;'),
    @('  --text-faint:       #A899AD;', '  --text-faint:       #7A9CC0;'),
    @('  --text-pale:        #B0A4BA;', '  --text-pale:        #9DB8D6;'),
    @('  --surface-card:     #4A3560;', '  --surface-card:     #18375D;'),
    @('  --surface-ink:      #2A1832;', '  --surface-ink:      #0F2440;'),
    @('  --border-soft:      #E6E0D6;', '  --border-soft:      #D0DAEA;'),
    @('  --border-warm:      #EDE7DF;', '  --border-warm:      #C8D5E6;'),
    # Hardcoded hex in body of CSS
    @('#AC13F9', '#F22F3A'),
    @('#7A0BB8', '#AF2D37'),
    @('#9B2FD0', '#F0595F'),
    @('#D06AF5', '#F0595F'),
    @('#F471D1', '#F0595F'),
    @('#C955F0', '#AF2D37'),
    @('#882BC4', '#AF2D37'),
    @('172, 19, 249', '242, 47, 58'),
    @('#1A0E2E', '#0F2440'),
    @('#FAF7F4', '#F8F9FB'),
    @('#F5EFE8', '#EEF2F8'),
    @('#F0EBE3', '#E8EEF7'),
    @('#4A3B54', '#1C3A5E'),
    @('#5A4660', '#2A4F7A'),
    @('#6B5B73', '#3D6491'),
    @('#8A7B8F', '#5A7FA8'),
    @('#A899AD', '#7A9CC0'),
    @('#B0A4BA', '#9DB8D6'),
    @('#4A3560', '#18375D'),
    @('#2A1832', '#0F2440'),
    @('#E6E0D6', '#D0DAEA'),
    @('#EDE7DF', '#C8D5E6'),
    @('#d4b87a', '#AF2D37'),
    # Fonts
    @("'Cormorant Garamond', Georgia, serif", "'Montserrat', Georgia, serif"),
    @("'Cormorant Garamond', serif",          "'Montserrat', serif"),
    @("'Cormorant Garamond'",                 "'Montserrat'"),
    @("'DM Sans', 'Helvetica Neue', Arial, sans-serif", "'Inter', 'Helvetica Neue', Arial, sans-serif"),
    @("'DM Sans', sans-serif", "'Inter', sans-serif"),
    @("'DM Sans'", "'Inter'")
)
ApplyReplacements -FilePath $cssPath -Pairs $cssPairs

# ── 2. functions.php ─────────────────────────────────────────────────────────
Write-Host "`n[2] functions.php"
$funcPath = Join-Path $root 'functions.php'
$funcPairs = @(
    @('LIVIA Med Spa', 'Hot Water Heroes Plumbing'),
    @('Livia Med Spa', 'Hot Water Heroes Plumbing'),
    @('liviamedspa.com', 'hotwaterheroesplumbing.com'),
    @('support@liviamedspa.com', 'joe@hotwaterheroesplumbing.com'),
    @('+18132302219', '+18135551234'),
    @("'livia-google-fonts'", "'hwh-google-fonts'"),
    @("'livia-style'", "'hwh-style'"),
    @('livia_setup', 'hwh_setup'),
    @('livia_disable_emojis', 'hwh_disable_emojis'),
    @('livia_cleanup_head', 'hwh_cleanup_head'),
    @('livia_disable_oembed', 'hwh_disable_oembed'),
    @('livia_dequeue_block_styles', 'hwh_dequeue_block_styles'),
    @('livia_deregister_jquery', 'hwh_deregister_jquery'),
    @('livia_force_page_templates', 'hwh_force_page_templates'),
    @('livia_enqueue_styles', 'hwh_enqueue_styles'),
    @('livia_async_styles', 'hwh_async_styles'),
    @('livia_resource_hints', 'hwh_resource_hints'),
    @('livia_cached_image_url', 'hwh_cached_image_url'),
    @('livia_script_loader_tag', 'hwh_script_loader_tag'),
    @('livia_schema_markup', 'hwh_schema_markup'),
    @('livia_create_pages', 'hwh_create_pages'),
    @('livia_fix_reading_settings', 'hwh_fix_reading_settings'),
    @('livia_page_slug_exists', 'hwh_page_slug_exists'),
    @('livia_create_privacy_page', 'hwh_create_privacy_page'),
    @('livia_create_cancellation_page', 'hwh_create_cancellation_page'),
    @('livia_create_refund_page', 'hwh_create_refund_page'),
    @('livia_create_beauty_bank_page', 'hwh_create_specials_page'),
    @('livia_create_blog_posts', 'hwh_create_blog_posts'),
    @('livia_create_services', 'hwh_create_services'),
    @("'livia_pages_created_v5'", "'hwh_pages_created_v5'"),
    @("'livia_reading_fixed_v2'", "'hwh_reading_fixed_v2'"),
    @("'livia_privacy_page_created_v1'", "'hwh_privacy_page_created_v1'"),
    @("'livia_cancellation_page_created_v1'", "'hwh_cancellation_page_created_v1'"),
    @("'livia_refund_page_created_v1'", "'hwh_refund_page_created_v1'"),
    @("'livia_beauty_bank_page_created_v1'", "'hwh_specials_page_created_v1'"),
    @("'livia_blog_created_v1'", "'hwh_blog_created_v1'"),
    @("'livia_services_created_v2'", "'hwh_services_created_v2'"),
    @("'livia_popup_enabled'", "'hwh_popup_enabled'"),
    @("'livia_popup_expiry'", "'hwh_popup_expiry'"),
    @("'livia_popup_badge'", "'hwh_popup_badge'"),
    @("'livia_popup_title'", "'hwh_popup_title'"),
    @("'livia_popup_text'", "'hwh_popup_text'"),
    @("'livia_popup_code'", "'hwh_popup_code'"),
    @("'livia_popup_btn_text'", "'hwh_popup_btn_text'"),
    @("'livia_popup_btn_url'", "'hwh_popup_btn_url'"),
    @("'livia_popup_delay'", "'hwh_popup_delay'"),
    @("'livia_popup_frequency'", "'hwh_popup_frequency'"),
    @("'livia_contact_submit'", "'hwh_contact_submit'"),
    @('/livia-img-cache', '/hwh-img-cache'),
    @('LIVIAMedSpa/1.0', 'HotWaterHeroes/1.0'),
    @("'MedicalBusiness', 'MedSpa', 'LocalBusiness'", "'Plumber', 'HomeAndConstructionBusiness', 'LocalBusiness'"),
    @('medicalSpecialty', 'serviceType'),
    @("'Dermatology'", "'Plumbing'"),
    @("'MedicalTherapy'", "'Service'"),
    @("'MedicalProcedure'", "'Service'"),
    @("['MedicalBusiness', 'MedSpa', 'LocalBusiness']", "['Plumber', 'HomeAndConstructionBusiness', 'LocalBusiness']"),
    @('Angela Spicola', 'HWH Master Plumbers'),
    @("'APRN'", "'Master Plumber'"),
    @('Tampa', 'Tampa Bay'),
    @("'beauty-bank'", "'specials'"),
    @("'Beauty Bank Membership'", "'Specials'"),
    @("'Beauty Bank'", "'Specials'"),
    @("'Botox & Neuromodulators'", "'Water Heater Repair'"),
    @("'Dermal Fillers'", "'Water Heater Installation'"),
    @("'RF Microneedling'", "'Tankless Water Heaters'"),
    @("'Laser Skin Resurfacing'", "'Drain Cleaning'"),
    @("'Medical-Grade Facials'", "'Emergency Plumbing'"),
    @("'IV Therapy'", "'Leak Detection'"),
    @("'Kybella'", "'Pipe Repair & Repiping'"),
    @("'Helix CO2 Laser'", "'Sewer & Water Line'"),
    @("'Weight Loss Programs'", "'Plumbing Inspections'"),
    @("'Skincare'", "'Tips & Maintenance'"),
    @("'Injectables'", "'Water Heater Services'"),
    @("'Wellness'", "'Emergency Services'"),
    @("'Treatments'", "'How-To Guides'"),
    @("'Beauty Tips'", "'HWH News'"),
    @("'Skin & Facials'", "'Drain & Pipe Services'"),
    @("'Body & Wellness'", "'Emergency & General'"),
    @('Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
       'Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap'),
    @('dns-prefetch" href="//liviamedspa.com"', 'dns-prefetch" href="//hotwaterheroesplumbing.com"')
)
ApplyReplacements -FilePath $funcPath -Pairs $funcPairs

# ── 3. header.php ─────────────────────────────────────────────────────────────
Write-Host "`n[3] header.php"
$headerPath = Join-Path $root 'header.php'
$headerPairs = @(
    @('LIVIA Med Spa', 'Hot Water Heroes Plumbing'),
    @('Livia Med Spa', 'Hot Water Heroes Plumbing'),
    @('liviamedspa.com', 'hotwaterheroesplumbing.com'),
    @('@liviamedspa', '@hotwaterheroes'),
    @('content="#1A0E2E"', 'content="#0F2440"'),
    @('content="#F0EBE3"', 'content="#E8EEF7"'),
    @("background: #FAF7F4;", "background: #F8F9FB;"),
    @("#AC13F9 0%, #F471D1 100%", "#F22F3A 0%, #F0595F 100%"),
    @("color: #C955F0;", "color: #AF2D37;"),
    @("background: #F5EFE8;", "background: #EEF2F8;"),
    @("'Cormorant Garamond', Georgia, serif", "'Montserrat', Georgia, serif"),
    @("'Cormorant Garamond'", "'Montserrat'"),
    @("'DM Sans'", "'Inter'"),
    @('/memberships/', '/financing/'),
    @('/parties/', '/about/')
)
ApplyReplacements -FilePath $headerPath -Pairs $headerPairs

# ── 4. footer.php ─────────────────────────────────────────────────────────────
Write-Host "`n[4] footer.php"
$footerPath = Join-Path $root 'footer.php'
$footerPairs = @(
    @('LIVIA Med Spa', 'Hot Water Heroes'),
    @('Livia Med Spa', 'Hot Water Heroes'),
    @('liviamedspa.com', 'hotwaterheroesplumbing.com'),
    @("'livia-cookie-consent'", "'hwh-cookie-consent'"),
    @("'livia-popup-dismissed'", "'hwh-popup-dismissed'"),
    @("'livia_popup_enabled'", "'hwh_popup_enabled'"),
    @("'livia_popup_expiry'", "'hwh_popup_expiry'"),
    @("'livia_popup_badge'", "'hwh_popup_badge'"),
    @("'livia_popup_title'", "'hwh_popup_title'"),
    @("'livia_popup_text'", "'hwh_popup_text'"),
    @("'livia_popup_code'", "'hwh_popup_code'"),
    @("'livia_popup_btn_text'", "'hwh_popup_btn_text'"),
    @("'livia_popup_btn_url'", "'hwh_popup_btn_url'"),
    @("'livia_popup_delay'", "'hwh_popup_delay'"),
    @("'livia_popup_frequency'", "'hwh_popup_frequency'"),
    @("livia_contact_submit", "hwh_contact_submit"),
    @("livia_cached_image_url", "hwh_cached_image_url"),
    @('(813) 230-2219', '(813) 555-1234'),
    @('tel:8132302219', 'tel:+18135551234'),
    @('/memberships/', '/financing/'),
    @('/parties/', '/service-areas/'),
    @('/beauty-bank/', '/specials/'),
    @('/before-after/', '/service-areas/'),
    @('/services/botox/', '/services/water-heater-repair/'),
    @('/services/dermal-fillers/', '/services/water-heater-installation/'),
    @('/services/microneedling/', '/services/tankless-water-heaters/'),
    @('/services/chemical-peels/', '/services/drain-cleaning/'),
    @('/services/laser-treatments/', '/services/emergency-plumbing/'),
    @('/services/weight-loss/', '/services/leak-detection/'),
    @('https://www.instagram.com/liviamedspa/', 'https://www.instagram.com/hotwaterheroes/'),
    @('https://www.facebook.com/p/Livia-Med-Spa-61561610168278/', 'https://www.facebook.com/hotwaterheroes/'),
    @('businessId: ''9563faa5-e2e5-4a6a-b5f5-0636ea78b80e'',', '// TODO: Add HWH booking widget ID'),
    @('#book-now', '#request-service')
)
ApplyReplacements -FilePath $footerPath -Pairs $footerPairs

# ── 5. All other PHP files ─────────────────────────────────────────────────────
Write-Host "`n[5] Other PHP files"
$skipFiles = @('functions.php', 'header.php', 'footer.php')
$bulkPairs = @(
    @('LIVIA Med Spa', 'Hot Water Heroes Plumbing'),
    @('Livia Med Spa', 'Hot Water Heroes Plumbing'),
    @('LIVIA', 'HWH'),
    @('livia_', 'hwh_'),
    @('liviamedspa.com', 'hotwaterheroesplumbing.com'),
    @('(813) 230-2219', '(813) 555-1234'),
    @('8132302219', '18135551234'),
    @('#book-now', '#request-service'),
    @('/memberships/', '/financing/'),
    @('/parties/', '/about/'),
    @('/beauty-bank/', '/specials/'),
    @('Angela Spicola, APRN', 'our licensed plumbers'),
    @('Angela Spicola', 'Our Team'),
    @('Book Consultation', 'Request Service'),
    @('book consultation', 'request service')
)

Get-ChildItem -Path $root -Filter '*.php' -File | Where-Object { $skipFiles -notcontains $_.Name } | ForEach-Object {
    ApplyReplacements -FilePath $_.FullName -Pairs $bulkPairs
}

Write-Host "`nRebrand complete!"
