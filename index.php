<?php
/**
 * Hot Water Heroes — Fallback Template (index.php)
 *
 * WordPress requires index.php. In our hierarchy front-page.php handles
 * the homepage and home.php handles the blog posts page, so this file
 * simply loads home.php as a safe default for any unmatched template.
 */

get_template_part( 'home' );
