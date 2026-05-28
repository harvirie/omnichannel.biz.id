/**
 * Omni Animations JS — v2.1
 * Swup page transitions (FAST + SMOOTH) + GSAP Parallax.
 *
 * STRATEGY:
 *  - animateHistoryBrowsing: true → back/forward also animated
 *  - LeaveDelay: 120ms (fast out) — server fetch runs in parallel
 *  - Thin gold progress bar for visual feedback during fetch
 *  - Scroll reset BEFORE entering content (no jump)
 *  - GSAP only registered once, triggers rebuilt per page:view
 */

(function () {
    'use strict';

    // ─────────────────────────────────────────────
    // PROGRESS BAR
    // ─────────────────────────────────────────────
    var progressBar = null;
    var progressTimer = null;

    function createProgressBar() {
        if (document.getElementById('omni-page-progress')) return;
        var bar = document.createElement('div');
        bar.id = 'omni-page-progress';
        document.body.appendChild(bar);
        progressBar = bar;
    }

    function progressStart() {
        if (!progressBar) createProgressBar();
        clearTimeout(progressTimer);
        progressBar.style.transition = 'width 0.2s ease, opacity 0.15s ease';
        progressBar.style.width = '0%';
        progressBar.className = 'omni-progress-active';
        // Animate to 75% — will complete when done
        progressTimer = setTimeout(function () {
            progressBar.style.transition = 'width 2s cubic-bezier(0.1,0.4,0.5,1), opacity 0.15s ease';
            progressBar.style.width = '75%';
        }, 20);
    }

    function progressDone() {
        if (!progressBar) return;
        clearTimeout(progressTimer);
        progressBar.className = 'omni-progress-active omni-progress-done';
        progressTimer = setTimeout(function () {
            progressBar.className = '';
            progressBar.style.width = '0%';
        }, 500);
    }

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

        ScrollTrigger.getAll().forEach(function (t) { t.kill(); });

        var container = document.getElementById('swup');
        if (!container) return;

        var isEnabled = container.getAttribute('data-parallax') === 'yes';
        if (!isEnabled) return;

        // Exclude hero-illustration-container images from parallax
        // (parallax on these creates a gap between the SVG curve and the image)
        var images = container.querySelectorAll('img');
        images.forEach(function (img) {
            // Skip hero illustration images — they sit flush against the SVG wave
            if (img.closest('.hero-illustration-container')) return;

            function apply() {
                if (img.clientHeight > 80) {
                    gsap.to(img, {
                        y: -40,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: img,
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: 0.8
                        }
                    });
                }
            }
            if (img.complete && img.naturalHeight > 0) {
                apply();
            } else {
                img.addEventListener('load', apply, { once: true });
            }
        });
    }

    // ─────────────────────────────────────────────
    // RE-INIT THEME UI after Swup navigation
    // ─────────────────────────────────────────────
    function reinitThemeUI() {
        // Lucide Icons — re-render on new DOM
        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        }
        // Scroll to top before content fades in (prevents flash of wrong scroll pos)
        window.scrollTo({ top: 0, behavior: 'instant' });
    }

    // ─────────────────────────────────────────────
    // SWUP INITIALIZATION
    // ─────────────────────────────────────────────
    function initSwup() {
        if (typeof Swup === 'undefined') return;

        var plugins = [];

        if (typeof SwupBodyClassPlugin !== 'undefined') {
            plugins.push(new SwupBodyClassPlugin());
        }

        var swup = new Swup({
            containers: ['#swup'],
            animationSelector: '[class*="transition-"]',
            animateHistoryBrowsing: true,   // smooth back/forward too
            plugins: plugins
        });

        // Show progress bar as soon as navigation starts (link:click)
        swup.hooks.on('link:click', progressStart);

        // Scroll & reinit BEFORE content enters (during leave phase)
        swup.hooks.on('content:replace', function () {
            reinitThemeUI();
        });

        // Init parallax and icons after new page fully visible
        swup.hooks.on('page:view', function () {
            initParallax();
            progressDone();
        });

        // Expose for nav active state script
        window._omniSwup = swup;
    }

    // ─────────────────────────────────────────────
    // BOOT
    // ─────────────────────────────────────────────
    createProgressBar();

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
