/**
 * Omni Animations JS — v2.0
 * Swup page transitions + GSAP Parallax.
 *
 * STRATEGY:
 *  - SwupScriptsPlugin is NOT used (caused blinking & re-triggered loading screen)
 *  - We handle all re-inits via swup hooks (page:view)
 *  - Parallax reads data-parallax attribute from #swup on each page:view
 */

(function () {
    'use strict';

    // ─────────────────────────────────────────────
    // PARALLAX
    // ─────────────────────────────────────────────
    var gsapReady = false;

    function initParallax() {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

        if (!gsapReady) {
            gsap.registerPlugin(ScrollTrigger);
            gsapReady = true;
        }

        // Kill old triggers first
        ScrollTrigger.getAll().forEach(function (t) { t.kill(); });

        var container = document.getElementById('swup');
        if (!container) return;

        var isEnabled = container.getAttribute('data-parallax') === 'yes';
        if (!isEnabled) return;

        var images = container.querySelectorAll('img');
        images.forEach(function (img) {
            function apply() {
                if (img.clientHeight > 80) {
                    gsap.to(img, {
                        y: -50,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: img,
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: 1
                        }
                    });
                }
            }
            if (img.complete && img.naturalHeight > 0) {
                apply();
            } else {
                img.addEventListener('load', apply);
            }
        });
    }

    // ─────────────────────────────────────────────
    // RE-INIT THEME UI after Swup navigation
    // ─────────────────────────────────────────────
    function reinitThemeUI() {
        // Lucide Icons
        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        }

        // Swiper instances — re-init all swipers found in new page
        if (typeof Swiper !== 'undefined') {
            document.querySelectorAll('.swiper:not(.swiper-initialized)').forEach(function (el) {
                // Swiper will auto-init based on data attributes if needed
                // For manually configured ones, dispatch a custom event
            });
        }

        // Scroll to top on page change
        window.scrollTo(0, 0);
    }

    // ─────────────────────────────────────────────
    // SWUP INITIALIZATION
    // ─────────────────────────────────────────────
    function initSwup() {
        if (typeof Swup === 'undefined') return;

        var plugins = [];

        // Body class plugin (updates body classes so bg colors update)
        if (typeof SwupBodyClassPlugin !== 'undefined') {
            plugins.push(new SwupBodyClassPlugin());
        }

        var swup = new Swup({
            containers: ['#swup'],
            animationSelector: '[class*="transition-"]',
            plugins: plugins
        });

        // After new page content is rendered and animated in
        swup.hooks.on('page:view', function () {
            reinitThemeUI();
            initParallax();
        });

        // Store on window so other scripts can reference if needed
        window._omniSwup = swup;
    }

    // ─────────────────────────────────────────────
    // BOOT
    // ─────────────────────────────────────────────
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initSwup();
            initParallax();
        });
    } else {
        initSwup();
        initParallax();
    }

})();
