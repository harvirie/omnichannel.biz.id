/**
 * Omni Animations JS — v3.1
 * Swup page transitions + GSAP Parallax + GSAP Scroll Reveal + GSAP SVG Signal Pulse.
 *
 * STRATEGY:
 *  - animateHistoryBrowsing: true → back/forward also animated
 *  - Thin gold progress bar for visual feedback during fetch
 *  - GSAP ScrollTrigger bounce-up reveal on all major sections
 *  - GSAP SVG Signal: dot travels svg path + heartbeat pulse while moving
 *    * Uses pathLength="100" normalization → smooth through all rounded corners
 *    * drop-shadow only (NO blur) → no boxy artifact at corners
 *    * Two layers: core dot (white-gold) + wide aura (gold) — offset in time
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
    // GSAP PLUGIN REGISTRATION
    // ─────────────────────────────────────────────
    var gsapReady = false;

    function ensureGsap() {
        if (gsapReady) return true;
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return false;
        gsap.registerPlugin(ScrollTrigger);
        gsapReady = true;
        return true;
    }

    // ─────────────────────────────────────────────
    // SVG SIGNAL PULSE (GSAP)
    // ─────────────────────────────────────────────
    var _signalTweens = [];

    function killSignalTweens() {
        _signalTweens.forEach(function (t) { if (t && t.kill) t.kill(); });
        _signalTweens = [];
    }

    function initSvgSignal() {
        if (typeof gsap === 'undefined') return;
        killSignalTweens();

        var corePaths = Array.from(document.querySelectorAll('.svg-glow-path'));
        var auraPaths = Array.from(document.querySelectorAll('.svg-glow-path-wide'));

        if (!corePaths.length && !auraPaths.length) return;

        // ── CORE DOT (white-gold, sharp, fast) ──────────────────────
        corePaths.forEach(function (path, i) {
            var TRAVEL  = 9;      // seconds for full loop
            var DELAY   = i * 0.18; // stagger if multiple paths

            // Set initial state
            gsap.set(path, { attr: { strokeDashoffset: 100 }, opacity: 0 });

            // Travel timeline: 100 → 0 on strokeDashoffset, loop forever
            var travel = gsap.timeline({ repeat: -1, delay: DELAY });
            travel.fromTo(
                path,
                { attr: { strokeDashoffset: 100 }, opacity: 0 },
                {
                    attr: { strokeDashoffset: 0 },
                    opacity: 1,
                    duration: TRAVEL,
                    ease: 'none'   // linear travel
                }
            );
            // Brief fade-out at end of each loop before restart
            travel.to(path, { opacity: 0, duration: 0.4, ease: 'power2.in' }, TRAVEL - 0.4);
            _signalTweens.push(travel);

            // Heartbeat pulse on opacity — runs independently on top
            // Only starts after initial fade-in (~0.3s into travel)
            var pulse = gsap.to(path, {
                keyframes: [
                    { opacity: 1,    duration: 0.15, ease: 'power3.out' },  // spike up
                    { opacity: 0.45, duration: 0.25, ease: 'power2.in'  },  // drop
                    { opacity: 0.95, duration: 0.15, ease: 'power3.out' },  // second spike
                    { opacity: 0.5,  duration: 0.45, ease: 'power1.out' },  // settle
                ],
                repeat: -1,
                repeatDelay: 0.3,   // pause between heartbeats
                delay: DELAY + 0.5  // start after path fades in
            });
            _signalTweens.push(pulse);

            // Stroke-width breathe pulse (subtle)
            var widthPulse = gsap.to(path, {
                attr: { strokeWidth: 3.2 },
                duration: 0.5,
                ease: 'sine.inOut',
                yoyo: true,
                repeat: -1,
                delay: DELAY + 0.5
            });
            _signalTweens.push(widthPulse);
        });

        // ── AURA (gold, wider, softer — offset behind core) ──────────
        auraPaths.forEach(function (path, i) {
            var TRAVEL     = 9;
            var AURA_DELAY = i * 0.18 + 0.08; // slightly behind core dot

            gsap.set(path, { attr: { strokeDashoffset: 100 }, opacity: 0 });

            var travel = gsap.timeline({ repeat: -1, delay: AURA_DELAY });
            travel.fromTo(
                path,
                { attr: { strokeDashoffset: 100 }, opacity: 0 },
                {
                    attr: { strokeDashoffset: 0 },
                    opacity: 0.75,
                    duration: TRAVEL,
                    ease: 'none'
                }
            );
            travel.to(path, { opacity: 0, duration: 0.5, ease: 'power2.in' }, TRAVEL - 0.5);
            _signalTweens.push(travel);

            // Aura pulse — slower, more ethereal
            var pulse = gsap.to(path, {
                keyframes: [
                    { opacity: 0.75, duration: 0.2, ease: 'power2.out' },
                    { opacity: 0.2,  duration: 0.3, ease: 'power2.in'  },
                    { opacity: 0.7,  duration: 0.2, ease: 'power2.out' },
                    { opacity: 0.3,  duration: 0.5, ease: 'sine.out'   },
                ],
                repeat: -1,
                repeatDelay: 0.4,
                delay: AURA_DELAY + 0.5
            });
            _signalTweens.push(pulse);

            // Aura stroke-width pulse (wider range for visible breathing)
            var widthPulse = gsap.to(path, {
                attr: { strokeWidth: 9 },
                duration: 0.55,
                ease: 'sine.inOut',
                yoyo: true,
                repeat: -1,
                delay: AURA_DELAY + 0.5
            });
            _signalTweens.push(widthPulse);
        });
    }

    // ─────────────────────────────────────────────
    // PARALLAX (images)
    // ─────────────────────────────────────────────
    function initParallax() {
        if (!ensureGsap()) return;

        ScrollTrigger.getAll().forEach(function (t) { t.kill(); });

        var container = document.getElementById('swup');
        if (!container) return;

        var isEnabled = container.getAttribute('data-parallax') === 'yes';
        if (!isEnabled) return;

        var images = container.querySelectorAll('img');
        images.forEach(function (img) {
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
    // GSAP SCROLL REVEAL — BOUNCE UP
    // ─────────────────────────────────────────────
    function revealOne(el, delay, yFrom, duration, ease) {
        yFrom    = yFrom    || 55;
        duration = duration || 0.85;
        ease     = ease     || 'back.out(1.6)';
        delay    = delay    || 0;

        gsap.fromTo(el,
            { y: yFrom, opacity: 0, scale: 0.97 },
            {
                y: 0, opacity: 1, scale: 1,
                duration: duration,
                ease: ease,
                delay: delay,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 90%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function revealGroup(els, triggerEl, stagger, yFrom, duration, ease, startPos) {
        if (!els || !els.length) return;
        yFrom    = yFrom    || 60;
        duration = duration || 0.8;
        ease     = ease     || 'back.out(1.7)';
        stagger  = stagger  || 0.12;
        startPos = startPos || 'top 88%';

        gsap.fromTo(els,
            { y: yFrom, opacity: 0, scale: 0.96 },
            {
                y: 0, opacity: 1, scale: 1,
                duration: duration,
                ease: ease,
                stagger: { each: stagger, from: 'start' },
                scrollTrigger: {
                    trigger: triggerEl || els[0],
                    start: startPos,
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function revealSplit(headingEl, subtitleEl, restEls, sectionEl) {
        if (headingEl) {
            gsap.fromTo(headingEl,
                { y: 50, opacity: 0 },
                {
                    y: 0, opacity: 1,
                    duration: 0.9,
                    ease: 'back.out(1.5)',
                    scrollTrigger: {
                        trigger: sectionEl || headingEl,
                        start: 'top 88%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        }
        if (subtitleEl) {
            gsap.fromTo(subtitleEl,
                { y: 35, opacity: 0 },
                {
                    y: 0, opacity: 1,
                    duration: 0.8,
                    ease: 'power3.out',
                    delay: 0.15,
                    scrollTrigger: {
                        trigger: sectionEl || subtitleEl,
                        start: 'top 88%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        }
        if (restEls && restEls.length) {
            gsap.fromTo(restEls,
                { y: 40, opacity: 0, scale: 0.97 },
                {
                    y: 0, opacity: 1, scale: 1,
                    duration: 0.75,
                    ease: 'back.out(1.4)',
                    delay: 0.28,
                    stagger: 0.1,
                    scrollTrigger: {
                        trigger: sectionEl || restEls[0],
                        start: 'top 88%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        }
    }

    function initScrollReveal() {
        if (!ensureGsap()) return;

        var container = document.getElementById('swup');
        if (!container) return;

        /* ── 1. HERO SECTION ── */
        var heroSection = container.querySelector('section:first-of-type');
        if (heroSection) {
            var heroDesktop = heroSection.querySelector('.hidden.md\\:flex');
            if (heroDesktop) {
                var hdLogo  = heroDesktop.querySelector('a[aria-label]');
                var hdH1    = heroDesktop.querySelector('h1');
                var hdSub   = heroDesktop.querySelector('[class*="text-omni-text-muted"]');
                var hdForm  = heroDesktop.querySelector('form');
                var hdBadge = heroDesktop.querySelector('[class*="flex items-center gap"]');

                if (hdLogo)  gsap.fromTo(hdLogo,  { y: -30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power3.out', delay: 0.1 });
                if (hdH1)    gsap.fromTo(hdH1,    { y: 40,  opacity: 0 }, { y: 0, opacity: 1, duration: 1.0, ease: 'back.out(1.4)', delay: 0.2 });
                if (hdSub)   gsap.fromTo(hdSub,   { y: 30,  opacity: 0 }, { y: 0, opacity: 1, duration: 0.8, ease: 'power3.out', delay: 0.38 });
                if (hdForm)  gsap.fromTo(hdForm,  { y: 30,  opacity: 0, scale: 0.97 }, { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'back.out(1.5)', delay: 0.52 });
                if (hdBadge) gsap.fromTo(hdBadge, { y: 20,  opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power2.out', delay: 0.68 });
            }

            var heroVideoCard = heroSection.querySelector('.hidden.md\\:block.absolute');
            if (heroVideoCard) {
                gsap.fromTo(heroVideoCard,
                    { x: 60, opacity: 0, scale: 0.95 },
                    { x: 0,  opacity: 1, scale: 1,   duration: 1.1, ease: 'power3.out', delay: 0.3 }
                );
            }

            var heroBottomCards = heroSection.querySelectorAll('div.relative.z-20.w-\\[300vw\\]');
            heroBottomCards.forEach(function(card) {
                gsap.fromTo(card,
                    { y: 50, opacity: 0 },
                    { y: 0,  opacity: 1, duration: 0.9, ease: 'back.out(1.3)', delay: 0.5 }
                );
            });
        }

        /* ── 2. CTA SECTION ── */
        var ctaSection = container.querySelector('section.py-20');
        if (ctaSection) {
            var ctaH2   = ctaSection.querySelector('h2');
            var ctaSub  = ctaSection.querySelector('[class*="text-omni-light"]');
            var ctaBtns = Array.from(ctaSection.querySelectorAll('[class*="flex flex-col"] a, [class*="flex-col"] a, [class*="flex-row"] a'));
            revealSplit(ctaH2, ctaSub, ctaBtns, ctaSection);

            var blobs = ctaSection.querySelectorAll('div.absolute[class*="blur"]');
            blobs.forEach(function(blob, i) {
                gsap.fromTo(blob,
                    { scale: 0, opacity: 0 },
                    { scale: 1, opacity: 1, duration: 1.4, ease: 'power2.out', delay: i * 0.2,
                      scrollTrigger: { trigger: ctaSection, start: 'top 92%', toggleActions: 'play none none none' }
                    }
                );
            });
        }

        /* ── 3. CUSTOMERS SECTION ── */
        var custSection = container.querySelector('section.py-24');
        if (custSection) {
            var custH2    = custSection.querySelector('h2');
            var custSub   = custSection.querySelector('[class*="text-omni-text-muted"]');
            var custCards = Array.from(custSection.querySelectorAll('.swiper-slide'));
            revealSplit(custH2, custSub, null, custSection);
            if (custCards.length) {
                var firstSet = custCards.slice(0, Math.ceil(custCards.length / 2));
                revealGroup(firstSet, custSection, 0.1, 65, 0.85, 'back.out(1.6)', 'top 85%');
            }
            var navBtns = Array.from(custSection.querySelectorAll('.swiper-button-prev, .swiper-button-next'));
            if (navBtns.length) revealGroup(navBtns, custSection, 0.15, 20, 0.6, 'power2.out', 'top 75%');
        }

        /* ── 4. SEO CONTENT SECTION ── */
        var seoSection = container.querySelector('section.py-16');
        if (seoSection) {
            var seoH2   = seoSection.querySelector('h2');
            var seoParas = Array.from(seoSection.querySelectorAll('p'));
            if (seoH2)         revealOne(seoH2, 0, 45, 0.85, 'back.out(1.4)');
            if (seoParas.length) revealGroup(seoParas, seoSection, 0.14, 40, 0.75, 'power3.out', 'top 88%');
        }
    }

    // ─────────────────────────────────────────────
    // RE-INIT THEME UI after Swup navigation
    // ─────────────────────────────────────────────
    function reinitThemeUI() {
        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        }
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
            animateHistoryBrowsing: true,
            plugins: plugins
        });

        swup.hooks.on('link:click', progressStart);

        swup.hooks.on('content:replace', function () {
            reinitThemeUI();
        });

        swup.hooks.on('page:view', function () {
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.getAll().forEach(function (t) { t.kill(); });
            }
            killSignalTweens();
            initParallax();
            initScrollReveal();
            initSvgSignal();
            progressDone();
        });

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
            initScrollReveal();
            initSvgSignal();
        });
    } else {
        initSwup();
        initParallax();
        initScrollReveal();
        initSvgSignal();
    }

})();
