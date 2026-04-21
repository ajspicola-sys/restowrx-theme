
# Second-pass cleanup for Hot Water Heroes theme
Set-StrictMode -Off
$root = "c:\Users\ajspi_j\.gemini\antigravity\scratch\Hot-Water-Heroes-theme"

function ReplaceInFile {
    param([string]$Path, [array]$Pairs, [bool]$Regex = $false)
    $content = [System.IO.File]::ReadAllText($Path, [System.Text.Encoding]::UTF8)
    foreach ($pair in $Pairs) {
        if ($Regex) {
            $content = $content -creplace $pair[0], $pair[1]
        } else {
            $content = $content.Replace($pair[0], $pair[1])
        }
    }
    [System.IO.File]::WriteAllText($Path, $content, [System.Text.Encoding]::UTF8)
    Write-Host "  Done: $([System.IO.Path]::GetFileName($Path))"
}

Write-Host "`nSecond pass cleanup..."

# functions.php — all remaining livia_ via regex
$funcPath = Join-Path $root 'functions.php'
$content = [System.IO.File]::ReadAllText($funcPath, [System.Text.Encoding]::UTF8)
$content = $content -creplace 'livia_', 'hwh_'
$content = $content -creplace '\.livia-', '.hwh-'
$content = $content -creplace '"livia-', '"hwh-'
$content = $content.Replace('#livia-med-spa', '#hwh-plumbing')
$content = $content.Replace("'Livia Medical Spa'", "'Hot Water Heroes Plumbing'")
$content = $content.Replace('New-Livia-Logo.png', 'hwh-logo.png')
$content = $content.Replace('https://www.facebook.com/p/Livia-Med-Spa-61561610168278/', 'https://www.facebook.com/hotwaterheroes/')
$content = $content.Replace('https://www.instagram.com/liviamedspa/', 'https://www.instagram.com/hotwaterheroes/')
$content = $content.Replace('https://www.google.com/maps/place/LIVIA+Med+Spa', 'https://www.google.com/maps/place/Hot+Water+Heroes')
[System.IO.File]::WriteAllText($funcPath, $content, [System.Text.Encoding]::UTF8)
Write-Host "  Done: functions.php"

# search.php — text domain
$spath = Join-Path $root 'search.php'
$sc = [System.IO.File]::ReadAllText($spath, [System.Text.Encoding]::UTF8)
$sc = $sc.Replace("'livia'", "'hot-water-heroes'")
[System.IO.File]::WriteAllText($spath, $sc, [System.Text.Encoding]::UTF8)
Write-Host "  Done: search.php"

# page-contact.php — social links
$cpath = Join-Path $root 'page-contact.php'
$cc = [System.IO.File]::ReadAllText($cpath, [System.Text.Encoding]::UTF8)
$cc = $cc.Replace('https://www.instagram.com/liviamedspa/', 'https://www.instagram.com/hotwaterheroes/')
$cc = $cc.Replace('https://www.facebook.com/p/Livia-Med-Spa-61561610168278/', 'https://www.facebook.com/hotwaterheroes/')
[System.IO.File]::WriteAllText($cpath, $cc, [System.Text.Encoding]::UTF8)
Write-Host "  Done: page-contact.php"

# page-financing.php — Cherry slug
$fpath = Join-Path $root 'page-financing.php'
$fc = [System.IO.File]::ReadAllText($fpath, [System.Text.Encoding]::UTF8)
$fc = $fc.Replace('"livia-med-spa"', '"hot-water-heroes"')
[System.IO.File]::WriteAllText($fpath, $fc, [System.Text.Encoding]::UTF8)
Write-Host "  Done: page-financing.php"

# style.css — CSS comment cleanup + class names
$csspath = Join-Path $root 'style.css'
$css = [System.IO.File]::ReadAllText($csspath, [System.Text.Encoding]::UTF8)
$css = $css.Replace('Why People Choose Livia', 'Why People Choose HWH')
$css = $css.Replace('LIVIA Luxe Cards', 'HWH Service Cards')
$css = $css -creplace '\.livia-', '.hwh-'
[System.IO.File]::WriteAllText($csspath, $css, [System.Text.Encoding]::UTF8)
Write-Host "  Done: style.css"

# Count remaining references
Write-Host "`nCounting remaining 'livia' refs in PHP files..."
$count = 0
Get-ChildItem -Path $root -Filter '*.php' | ForEach-Object {
    $text = [System.IO.File]::ReadAllText($_.FullName, [System.Text.Encoding]::UTF8)
    $matches = [regex]::Matches($text, 'livia', 'IgnoreCase')
    $count += $matches.Count
    if ($matches.Count -gt 0) { Write-Host "  $($_.Name): $($matches.Count) refs" }
}
Write-Host "Total: $count remaining refs"
