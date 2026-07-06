<?php
/**
 * Shared client-side fetch-and-swap navigation for the blog listing and
 * category archives. Previously duplicated verbatim in home.php and
 * category.php.
 */
?>
<script>
(function() {
    var mainContent = document.getElementById('main-content');
    if (!mainContent) return;

    mainContent.addEventListener('click', function(e) {
        var filterBtn = e.target.closest('.blog-filter-btn');
        var paginationLink = e.target.closest('.blog-pagination a');
        var link = filterBtn || paginationLink;
        if (!link) return;

        e.preventDefault();
        loadBlogPage(link.href, false);
    });

    function loadBlogPage(url, isPopState) {
        var heroInner = document.querySelector('.blog-hero__inner');
        var filterBar = document.querySelector('.blog-filters__bar');
        var blogArchive = document.querySelector('.blog-archive');

        if (!blogArchive) return;

        if (heroInner) heroInner.style.opacity = '0.3';
        if (filterBar) filterBar.style.opacity = '0.3';
        blogArchive.style.opacity = '0.3';

        var transitionStyle = 'opacity 0.2s ease';
        if (heroInner) heroInner.style.transition = transitionStyle;
        if (filterBar) filterBar.style.transition = transitionStyle;
        blogArchive.style.transition = transitionStyle;

        fetch(url)
            .then(function(response) {
                if (!response.ok) throw new Error('Network error');
                return response.text();
            })
            .then(function(html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, 'text/html');

                var newHeroInner = doc.querySelector('.blog-hero__inner');
                var newFilterBar = doc.querySelector('.blog-filters__bar');
                var newBlogArchive = doc.querySelector('.blog-archive');

                if (heroInner && newHeroInner) heroInner.innerHTML = newHeroInner.innerHTML;
                if (filterBar && newFilterBar) filterBar.innerHTML = newFilterBar.innerHTML;
                if (blogArchive && newBlogArchive) blogArchive.innerHTML = newBlogArchive.innerHTML;

                if (!isPopState) {
                    window.history.pushState(null, '', url);
                }

                if (heroInner) heroInner.style.opacity = '1';
                if (filterBar) filterBar.style.opacity = '1';
                blogArchive.style.opacity = '1';

                var scrollTarget = document.querySelector('.blog-filters');
                if (scrollTarget) {
                    scrollTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

                var cards = document.querySelectorAll('.blog-archive .reveal');
                cards.forEach(function(card) {
                    card.classList.add('is-visible');
                });
            })
            .catch(function(error) {
                console.error('AJAX load failed:', error);
                if (heroInner) heroInner.style.opacity = '1';
                if (filterBar) filterBar.style.opacity = '1';
                blogArchive.style.opacity = '1';
                window.location.href = url;
            });
    }

    if (!window.blogAjaxInitialized) {
        window.addEventListener('popstate', function() {
            loadBlogPage(window.location.href, true);
        });
        window.blogAjaxInitialized = true;
    }
})();
</script>
