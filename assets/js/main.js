document.addEventListener('DOMContentLoaded', function () {

    /* ============================================
       MOBILE NAVIGATION TOGGLE
       ============================================ */
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.querySelector('.site-navigation');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!expanded));
            nav.classList.toggle('active');
        });
    }

    /* ============================================
       HERO CAROUSEL
       EDITORIAL: Manage carousel articles from
       Settings › Homepage Settings in WP Admin.
       (ACF post object fields — no code changes needed)
       ============================================ */
    (function () {
        var carousel = document.querySelector('.hero-carousel');
        if (!carousel) return;

        var slides  = carousel.querySelectorAll('.carousel-slide');
        var dots    = carousel.querySelectorAll('.carousel-dot');
        var prevBtn = carousel.querySelector('.carousel-btn--prev');
        var nextBtn = carousel.querySelector('.carousel-btn--next');
        var total   = slides.length;

        // Nothing to do with a single slide
        if (total <= 1) return;

        var current  = 0;
        var timer    = null;
        var DELAY    = 6000; // ms between auto-advances

        // Remove inactive slides from the tab order on load
        slides.forEach(function (slide, i) {
            if (i !== 0) {
                slide.querySelectorAll('a, button').forEach(function (el) {
                    el.setAttribute('tabindex', '-1');
                });
            }
        });

        function activate(index) {
            // Deactivate current slide: hide from AT and remove from tab order
            slides[current].classList.remove('is-active');
            slides[current].setAttribute('aria-hidden', 'true');
            slides[current].querySelectorAll('a, button').forEach(function (el) {
                el.setAttribute('tabindex', '-1');
            });
            if (dots[current]) {
                dots[current].classList.remove('is-active');
                dots[current].setAttribute('aria-selected', 'false');
            }

            // Wrap index and activate the new slide
            current = (index + total) % total;
            slides[current].classList.add('is-active');
            slides[current].setAttribute('aria-hidden', 'false');
            // Restore focusability for the newly active slide
            slides[current].querySelectorAll('a, button').forEach(function (el) {
                el.removeAttribute('tabindex');
            });
            if (dots[current]) {
                dots[current].classList.add('is-active');
                dots[current].setAttribute('aria-selected', 'true');
            }
        }

        function startAutoplay() {
            timer = setInterval(function () {
                activate(current + 1);
            }, DELAY);
        }

        function stopAutoplay() {
            clearInterval(timer);
            timer = null;
        }

        function restartAutoplay() {
            stopAutoplay();
            startAutoplay();
        }

        // Previous / Next buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                activate(current - 1);
                restartAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                activate(current + 1);
                restartAutoplay();
            });
        }

        // Dot navigation
        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                activate(i);
                restartAutoplay();
            });
        });

        // Pause autoplay while the user hovers or focuses inside the carousel
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('focusin',    stopAutoplay);

        carousel.addEventListener('mouseleave', function () {
            if (!timer) startAutoplay();
        });

        carousel.addEventListener('focusout', function (e) {
            if (!carousel.contains(e.relatedTarget) && !timer) {
                startAutoplay();
            }
        });

        // Left / Right arrow-key support when carousel has focus
        carousel.setAttribute('tabindex', '-1');
        carousel.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') {
                activate(current - 1);
                restartAutoplay();
            } else if (e.key === 'ArrowRight') {
                activate(current + 1);
                restartAutoplay();
            }
        });

        startAutoplay();
    }());

    /* ============================================
       AD CLICK TRACKING
       Fires a GA4 'ad_click' event via gtag() when
       analytics is loaded, or logs to console for
       local testing when gtag is not available.
       ============================================ */
    document.addEventListener('click', function (e) {
        var link = e.target.closest('.js-ad-link');
        if (!link) return;

        var payload = {
            ad_slot:        link.dataset.adSlot  || '',
            ad_title:       link.dataset.adTitle || '',
            ad_destination: link.dataset.adUrl   || link.href
        };

        if (typeof gtag === 'function') {
            gtag('event', 'ad_click', payload);
        } else {
            console.log('[ad_click]', payload);
        }
    });

});
