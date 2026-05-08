
# Pass 3 — targeted cleanup of remaining Livia refs
Set-StrictMode -Off
$root = "c:\Users\ajspi_j\.gemini\antigravity\scratch\Hot-Water-Heroes-theme"

# ── header.php ───────────────────────────────────────────────────────────────
$p = Join-Path $root 'header.php'
$c = [System.IO.File]::ReadAllText($p,[System.Text.Encoding]::UTF8)
$c = $c.Replace('id="livia-critical-css"', 'id="hwh-critical-css"')
$c = $c.Replace('New-Livia-Logo.png', 'hwh-logo.png')
$c = $c.Replace('About LIVIA', 'About HWH')
[System.IO.File]::WriteAllText($p,$c,[System.Text.Encoding]::UTF8)
Write-Host "header.php done"

# ── footer.php ────────────────────────────────────────────────────────────────
$p = Join-Path $root 'footer.php'
$c = [System.IO.File]::ReadAllText($p,[System.Text.Encoding]::UTF8)
$c = $c.Replace('https://blvd.app/@liviamedspa/login', 'https://hotwaterheroesplumbing.com/book/')
$c = $c.Replace('Livia-Logo-White.png', 'hwh-logo-white.png')
# social proof names - Olivia P remains; overwrite the whole array
$c = $c.Replace("'Sarah M.','Jessica L.','Emily R.','Amanda K.','Lauren B.','Michelle T.','Brittany S.','Courtney H.','Taylor N.','Kayla D.','Madison F.','Rachel W.','Stephanie V.','Megan C.','Olivia P.','Ashley R.','Natalie G.','Danielle M.'",
    "'John M.','Mike T.','Dave R.','Chris K.','Tom B.','Robert H.','Steve N.','Kevin D.','Mark F.','Brian W.','Jason V.','Paul C.','Larry P.','Gary R.','Ryan G.','Scott M.'")
[System.IO.File]::WriteAllText($p,$c,[System.Text.Encoding]::UTF8)
Write-Host "footer.php done"

# ── front-page.php ────────────────────────────────────────────────────────────
$p = Join-Path $root 'front-page.php'
$c = [System.IO.File]::ReadAllText($p,[System.Text.Encoding]::UTF8)
$c = $c.Replace('Livia-Logo-White.png', 'hwh-logo-white.png')
$c = $c.Replace('https://www.instagram.com/liviamedspa/', 'https://www.instagram.com/hotwaterheroes/')
$c = $c.Replace('https://www.facebook.com/p/Livia-Med-Spa-61561610168278/', 'https://www.facebook.com/hotwaterheroes/')
$c = $c.Replace('https://ageless.ai/a/liviamedspa/transformation?utm_source=website&utm_medium=website', '#request-service')
$c = $c.Replace('https://us.fullscript.com/welcome/liviamedspa', '#request-service')
$c = $c.Replace('Livia-visual-3-1-e1770845322806-768x924.png', 'hwh-team-photo.png')
[System.IO.File]::WriteAllText($p,$c,[System.Text.Encoding]::UTF8)
Write-Host "front-page.php done"

# ── functions.php — targeted leftovers ────────────────────────────────────────
$p = Join-Path $root 'functions.php'
$c = [System.IO.File]::ReadAllText($p,[System.Text.Encoding]::UTF8)
$c = $c.Replace('livia-seo-counter', 'hwh-seo-counter')
$c = $c.Replace('LIVIA Settings', 'HWH Settings')
$c = $c.Replace("'livia-settings'", "'hwh-settings'")
$c = $c.Replace('LIVIA DEMO CONTENT IMPORTER', 'HWH DEMO CONTENT IMPORTER')
$c = $c.Replace('LIVIA Importer:', 'HWH Importer:')
$c = $c.Replace('LIVIA Demo Content', 'HWH Demo Content')
$c = $c.Replace("'livia-importer'", "'hwh-importer'")
$c = $c.Replace('LIVIA is the only place', 'HWH is the only company')
$c = $c.Replace('treatment at LIVIA ', 'service at HWH ')
$c = $c.Replace('LIVIA MED SPA', 'HOT WATER HEROES')
$c = $c.Replace('LIVIA Med Spa', 'Hot Water Heroes Plumbing')
$c = $c.Replace("'LIVIA Med Spa'", "'Hot Water Heroes Plumbing'")
$c = $c.Replace('New-Livia-Logo.png', 'hwh-logo.png')
[System.IO.File]::WriteAllText($p,$c,[System.Text.Encoding]::UTF8)
Write-Host "functions.php done"

# ── assets/deploy.php ──────────────────────────────────────────────────────────
$p = Join-Path $root 'assets\deploy.php'
$c = [System.IO.File]::ReadAllText($p,[System.Text.Encoding]::UTF8)
$c = $c.Replace('Livia Med Spa', 'Hot Water Heroes')
$c = $c.Replace('liviamedspa.com', 'hotwaterheroesplumbing.com')
$c = $c.Replace('LiviaGitDeploy2026', 'HWHGitDeploy2026')
$c = $c.Replace('livia-medspa-theme', 'hot-water-heroes-theme')
[System.IO.File]::WriteAllText($p,$c,[System.Text.Encoding]::UTF8)
Write-Host "deploy.php done"

# Final count
Write-Host "`nFinal check..."
$total = 0
Get-ChildItem -Path $root -Filter '*.php' -Recurse | Where-Object { $_.Name -notlike 'rebrand*' } | ForEach-Object {
    $text = [System.IO.File]::ReadAllText($_.FullName,[System.Text.Encoding]::UTF8)
    $m = [regex]::Matches($text,'livia','IgnoreCase')
    if ($m.Count -gt 0) {
        $total += $m.Count
        Write-Host "  $($_.Name): $($m.Count)"
    }
}
Write-Host "Total remaining: $total"
