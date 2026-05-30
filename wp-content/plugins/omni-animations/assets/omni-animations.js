/**
 * Omni Animations JS — v4.0.0
 * Swup Page Transitions + GSAP ScrollTrigger Animations (Optimized)
 *
 * v4.0 Changes:
 *  - REMOVED: initParallax() — penyebab scroll jank di mobile
 *  - REMOVED: initLumaDots() — animasi background yang memakan GPU
 *  - REMOVED: splitIntoWords() — expensive DOM manipulation on mobile
 *  - REMOVED: clipPath animations — very expensive on mobile GPU
 *  - REMOVED: filter:blur() from Swup transitions — expensive compositing
 *  - OPTIMIZED: All animations use simple fade+translateY only on mobile
 *  - OPTIMIZED: will-change only set during active animation, not globally
 */

(function () {
    'use strict';

    // ─────────────────────────────────────────────────────────────
    // PROGRESS BAR
    // ─────────────────────────────────────────────────────────────
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
            progressBar.style.transition = 'width 2s cubic-bezier(0.1,0.4,0.5,1)';
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

    // ─────────────────────────────────────────────────────────────
    // GSAP PLUGIN REGISTRATION
    // ─────────────────────────────────────────────────────────────
    var gsapReady = false;

    function ensureGsap() {
        if (gsapReady) return true;
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return false;
        gsap.registerPlugin(ScrollTrigger);
        // Optimasi: batasi ScrollTrigger refresh agar tidak terlalu sering
        ScrollTrigger.config({ limitCallbacks: true });
        gsapReady = true;
        return true;
    }

    // ─────────────────────────────────────────────────────────────
    // SVG SIGNAL PULSE — Lightweight GSAP animation (tidak scroll-based)
    // ─────────────────────────────────────────────────────────────
    var _signalTweens = [];

    function killSignalTweens() {
        _signalTweens.forEach(function (t) { if (t && t.kill) t.kill(); });
        _signalTweens = [];
    }

    function initSvgSignal() {
        if (typeof gsap === 'undefined') return;
        killSignalTweens();

        // Only run on desktop to save mobile CPU
        if (window.innerWidth < 768) return;

        var paths = document.querySelectorAll('.svg-glow-path');
        var widePaths = document.querySelectorAll('.svg-glow-path-wide');

        var DELAYS = [0, 0.8, 1.6, 2.4];

        paths.forEach(function (path, i) {
            var D = DELAYS[i % DELAYS.length];
            gsap.set(path, { strokeDashoffset: 100, opacity: 0 });

            var tl = gsap.timeline({ repeat: -1, delay: D });
            tl.to(path, { strokeDashoffset: 0, opacity: 0.9, duration: 1.6, ease: 'power2.inOut' });
            tl.to(path, { strokeDashoffset: -100, opacity: 0, duration: 1.2, ease: 'power2.in' });
            tl.to(path, { opacity: 0, duration: 2.5, ease: 'none' });

            var breathe = gsap.to(path, {
                opacity: 1, duration: 1.8, ease: 'sine.inOut',
                yoyo: true, repeat: -1, delay: D + 0.8
            });
            _signalTweens.push(tl, breathe);
        });

        widePaths.forEach(function (path, i) {
            var D = DELAYS[i % DELAYS.length] + 0.4;
            gsap.set(path, { strokeDashoffset: 100, opacity: 0 });

            var tl = gsap.timeline({ repeat: -1, delay: D });
            tl.to(path, { strokeDashoffset: 0, opacity: 0.55, duration: 2.0, ease: 'power2.inOut' });
            tl.to(path, { strokeDashoffset: -100, opacity: 0, duration: 1.4, ease: 'power2.in' });
            tl.to(path, { opacity: 0, duration: 2.0, ease: 'none' });

            var breathe = gsap.to(path, {
                opacity: 0.6, duration: 2.2, ease: 'sine.inOut',
                yoyo: true, repeat: -1, delay: D + 1.0
            });
            _signalTweens.push(tl, breathe);
        });
    }

    // ─────────────────────────────────────────────────────────────
    // GSAP ANIMATION HELPERS — Optimized for mobile
    // ─────────────────────────────────────────────────────────────
    var isMobile = window.innerWidth < 768;

    function animateHeading(el, triggerEl, delay) {
        if (!ensureGsap()) return;
        delay = delay || 0;

        if (isMobile) {
            // Mobile: simple fade up, no word splitting, no clip-path
            gsap.fromTo(el,
                { y: 20, opacity: 0 },
                {
                    y: 0, opacity: 1,
                    duration: 0.5,
                    ease: 'power2.out',
                    delay: delay * 0.5,
                    scrollTrigger: {
                        trigger: triggerEl || el,
                        start: 'top 95%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        } else {
            // Desktop: slide up with stagger on words
            var words = el.children.length === 0 && el.textContent.trim().split(/\s+/).length >= 2
                ? wrapWords(el) : null;

            if (words) {
                gsap.fromTo(words,
                    { y: '100%', opacity: 0 },
                    {
                        y: '0%', opacity: 1,
                        duration: 0.6,
                        ease: 'power3.out',
                        stagger: 0.05,
                        delay: delay,
                        scrollTrigger: {
                            trigger: triggerEl || el,
                            start: 'top 88%',
                            toggleActions: 'play none none none'
                        }
                    }
                );
            } else {
                gsap.fromTo(el,
                    { y: 22, opacity: 0 },
                    {
                        y: 0, opacity: 1,
                        duration: 0.7,
                        ease: 'power3.out',
                        delay: delay,
                        scrollTrigger: {
                            trigger: triggerEl || el,
                            start: 'top 88%',
                            toggleActions: 'play none none none'
                        }
                    }
                );
            }
        }
    }

    function wrapWords(el) {
        var text = el.textContent.trim();
        var words = text.split(/\s+/);
        if (words.length < 2) return null;
        el.innerHTML = words.map(function (w) {
            return '<span style="display:inline-block;overflow:hidden;vertical-align:bottom;margin-right:0.22em;">'
                 + '<span class="omni-w" style="display:inline-block;">'
                 + w + '</span></span>';
        }).join('');
        return Array.from(el.querySelectorAll('.omni-w'));
    }

    function animateBadge(el, triggerEl, delay) {
        if (!ensureGsap()) return;
        delay = delay || 0;
        gsap.fromTo(el,
            { x: isMobile ? -15 : -28, opacity: 0, scale: isMobile ? 0.95 : 0.85 },
            {
                x: 0, opacity: 1, scale: 1,
                duration: isMobile ? 0.4 : 0.55,
                ease: isMobile ? 'power2.out' : 'back.out(2)',
                delay: isMobile ? delay * 0.5 : delay,
                scrollTrigger: {
                    trigger: triggerEl || el,
                    start: isMobile ? 'top 95%' : 'top 90%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function animateSubtitle(el, triggerEl, delay) {
        if (!ensureGsap()) return;
        delay = delay || 0;
        // No blur animation — too expensive on mobile, removed on desktop too for consistency
        gsap.fromTo(el,
            { y: isMobile ? 15 : 28, opacity: 0 },
            {
                y: 0, opacity: 1,
                duration: isMobile ? 0.45 : 0.65,
                ease: 'power3.out',
                delay: isMobile ? delay * 0.5 : delay,
                scrollTrigger: {
                    trigger: triggerEl || el,
                    start: isMobile ? 'top 95%' : 'top 90%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function animateListItems(items, triggerEl) {
        if (!items || !items.length || !ensureGsap()) return;
        gsap.fromTo(items,
            { x: isMobile ? -20 : -40, opacity: 0 },
            {
                x: 0, opacity: 1,
                duration: isMobile ? 0.4 : 0.55,
                ease: 'power3.out',
                stagger: isMobile ? 0.04 : 0.08,
                scrollTrigger: {
                    trigger: triggerEl || items[0],
                    start: isMobile ? 'top 95%' : 'top 88%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function animateCards(cards, triggerEl) {
        if (!cards || !cards.length || !ensureGsap()) return;
        gsap.fromTo(cards,
            { y: isMobile ? 25 : 50, opacity: 0, scale: isMobile ? 0.99 : 0.95 },
            {
                y: 0, opacity: 1, scale: 1,
                duration: isMobile ? 0.5 : 0.65,
                ease: isMobile ? 'power2.out' : 'back.out(1.4)',
                stagger: isMobile ? 0.05 : 0.09,
                scrollTrigger: {
                    trigger: triggerEl || cards[0],
                    start: isMobile ? 'top 95%' : 'top 87%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    // ─────────────────────────────────────────────────────────────
    // SECTION TEXT ANIMATIONS
    // ─────────────────────────────────────────────────────────────
    function initSectionTextAnimations() {
        if (!ensureGsap()) return;
        var container = document.getElementById('swup');
        if (!container || container.querySelector('.no-gsap')) return;

        var sections = Array.from(container.querySelectorAll('section, [class*="py-20"], [class*="py-24"], [class*="py-16"]'));
        var seen = new WeakSet();
        sections = sections.filter(function(s) {
            if (seen.has(s)) return false;
            seen.add(s); return true;
        });

        sections.forEach(function (section) {
            var badges = Array.from(section.querySelectorAll(
                '.inline-flex.items-center.gap-2[class*="rounded-full"][class*="font-bold"]:not([data-anim-done])'
            ));
            badges.forEach(function (badge) {
                badge.dataset.animDone = '1';
                animateBadge(badge, section, 0);
            });

            var headings = Array.from(section.querySelectorAll('h1, h2')).filter(function (h) {
                return !h.dataset.animDone;
            });
            headings.forEach(function (h) {
                h.dataset.animDone = '1';
                animateHeading(h, section, badges.length ? 0.1 : 0);
            });

            var subtitles = Array.from(section.querySelectorAll(
                ':is(.text-center, .md\\:w-1\\/2, [class*="max-w-2xl"]) > p:not([data-anim-done]),' +
                'section > div > p:not([data-anim-done])'
            )).filter(function (p) { return !p.dataset.animDone; });
            subtitles.slice(0, 3).forEach(function (p, pi) {
                p.dataset.animDone = '1';
                animateSubtitle(p, section, 0.15 + pi * 0.07);
            });

            var featurePs = Array.from(section.querySelectorAll('.md\\:w-1\\/2 p:not([data-anim-done])'));
            featurePs.slice(0, 2).forEach(function (p) {
                p.dataset.animDone = '1';
                animateSubtitle(p, section, 0.18);
            });

            var listItems = Array.from(section.querySelectorAll('ul > li:not([data-anim-done])'));
            if (listItems.length) {
                listItems.forEach(function (li) { li.dataset.animDone = '1'; });
                animateListItems(listItems, section);
            }

            var gridCards = Array.from(section.querySelectorAll(
                '.grid > div:not([data-anim-done]), .space-y-4 > li:not([data-anim-done])'
            ));
            if (gridCards.length) {
                gridCards.forEach(function (c) { c.dataset.animDone = '1'; });
                animateCards(gridCards, section);
            }

            var darkCards = Array.from(section.querySelectorAll('.bg-omni-dark.rounded-2xl:not([data-anim-done])'));
            if (darkCards.length) {
                darkCards.forEach(function (c) { c.dataset.animDone = '1'; });
                animateCards(darkCards, section);
            }

            // CTA dark section
            var ctaDark = section.querySelector('.bg-omni-dark.rounded-3xl:not([data-anim-done]), .bg-omni-dark.rounded-2xl:not([data-anim-done])');
            if (ctaDark && !ctaDark.dataset.animDone) {
                ctaDark.dataset.animDone = '1';
                var ctaH2 = ctaDark.querySelector('h2:not([data-anim-done])');
                var ctaP = ctaDark.querySelector('p:not([data-anim-done])');
                var ctaBtns = Array.from(ctaDark.querySelectorAll('a:not([data-anim-done])'));
                if (ctaH2 && !ctaH2.dataset.animDone) { ctaH2.dataset.animDone = '1'; animateHeading(ctaH2, ctaDark, 0); }
                if (ctaP && !ctaP.dataset.animDone) { ctaP.dataset.animDone = '1'; animateSubtitle(ctaP, ctaDark, 0.15); }
                if (ctaBtns.length) {
                    ctaBtns.forEach(function (b) { b.dataset.animDone = '1'; });
                    animateCards(ctaBtns, ctaDark);
                }
            }

            var supportItems = Array.from(section.querySelectorAll('.space-y-4 > li:not([data-anim-done])'));
            if (supportItems.length) {
                supportItems.forEach(function (li) { li.dataset.animDone = '1'; });
                animateListItems(supportItems, supportItems[0].closest('section'));
            }

            var chatItems = Array.from(section.querySelectorAll('.space-y-3 > div:not([data-anim-done])'));
            if (chatItems.length) {
                chatItems.forEach(function (d) { d.dataset.animDone = '1'; });
                animateCards(chatItems, chatItems[0].closest('section'));
            }
        });

        // Hero section specific
        var heroBadge = container.querySelector('.pt-40 .inline-flex:not([data-anim-done]), .pt-52 .inline-flex:not([data-anim-done])');
        var heroH1 = container.querySelector('h1:not([data-anim-done])');
        var heroP = container.querySelector('h1 + p:not([data-anim-done]), h1 ~ p:not([data-anim-done])');

        if (heroBadge && !heroBadge.dataset.animDone) {
            heroBadge.dataset.animDone = '1';
            gsap.fromTo(heroBadge,
                { x: isMobile ? -15 : -30, opacity: 0 },
                { x: 0, opacity: 1, duration: isMobile ? 0.4 : 0.6, ease: 'back.out(2)', delay: isMobile ? 0.1 : 0.2 }
            );
        }

        if (heroH1 && !heroH1.dataset.animDone) {
            heroH1.dataset.animDone = '1';
            gsap.fromTo(heroH1,
                { y: isMobile ? 20 : 40, opacity: 0 },
                { y: 0, opacity: 1, duration: isMobile ? 0.5 : 0.9, ease: 'power3.out', delay: isMobile ? 0.15 : 0.3 }
            );
        }

        if (heroP && !heroP.dataset.animDone) {
            heroP.dataset.animDone = '1';
            gsap.fromTo(heroP,
                { y: isMobile ? 15 : 30, opacity: 0 },
                { y: 0, opacity: 1, duration: isMobile ? 0.45 : 0.7, ease: 'power3.out', delay: isMobile ? 0.2 : 0.45 }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // FRONT PAGE HERO (desktop only)
    // ─────────────────────────────────────────────────────────────
    function initFrontPageHero() {
        if (!ensureGsap() || isMobile) return; // Skip entirely on mobile — native render is faster
        var container = document.getElementById('swup');
        if (!container) return;

        var heroSection = container.querySelector('section:first-of-type');
        if (!heroSection) return;

        var heroDesktop = heroSection.querySelector('.hidden.md\\:flex');
        if (!heroDesktop) return;

        var hdLogo  = heroDesktop.querySelector('a[aria-label]');
        var hdH1    = heroDesktop.querySelector('h1');
        var hdSub   = heroDesktop.querySelector('[class*="text-omni-text-muted"]');
        var hdForm  = heroDesktop.querySelector('form');
        var hdBadge = heroDesktop.querySelector('[class*="flex items-center gap"]');

        if (hdLogo)  gsap.fromTo(hdLogo,  { y: -25, opacity: 0 }, { y: 0, opacity: 1, duration: 0.6, ease: 'power3.out', delay: 0.1 });
        if (hdH1 && !hdH1.dataset.animDone)  { hdH1.dataset.animDone = '1'; gsap.fromTo(hdH1, { y: 35, opacity: 0 }, { y: 0, opacity: 1, duration: 0.85, ease: 'back.out(1.3)', delay: 0.2 }); }
        if (hdSub)   gsap.fromTo(hdSub,   { y: 25, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power3.out', delay: 0.38 });
        if (hdForm)  gsap.fromTo(hdForm,  { y: 25, opacity: 0, scale: 0.97 }, { y: 0, opacity: 1, scale: 1, duration: 0.7, ease: 'back.out(1.4)', delay: 0.52 });
        if (hdBadge) gsap.fromTo(hdBadge, { y: 18, opacity: 0 }, { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out', delay: 0.65 });

        var heroVideoCard = heroSection.querySelector('.hidden.md\\:block.absolute');
        if (heroVideoCard) gsap.fromTo(heroVideoCard, { x: 55, opacity: 0, scale: 0.95 }, { x: 0, opacity: 1, scale: 1, duration: 1.0, ease: 'power3.out', delay: 0.3 });
    }

    // ─────────────────────────────────────────────────────────────
    // RE-INIT THEME UI after Swup navigation
    // ─────────────────────────────────────────────────────────────
    function reinitThemeUI() {
        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        }
        window.scrollTo({ top: 0, behavior: 'instant' });
    }

    // ─────────────────────────────────────────────────────────────
    // HEAD STYLE INJECTION — Fix gap pada Swup navigation
    // ─────────────────────────────────────────────────────────────
    var _injectedHeadStyles = [];

    function injectPageHeadStyles(visit) {
        _injectedHeadStyles.forEach(function (el) {
            if (el && el.parentNode) el.parentNode.removeChild(el);
        });
        _injectedHeadStyles = [];

        if (!visit || !visit.to || !visit.to.document) return;
        var headStyles = visit.to.document.querySelectorAll('head > style');
        headStyles.forEach(function (style) {
            var newStyle = document.createElement('style');
            newStyle.textContent = style.textContent;
            newStyle.setAttribute('data-swup-head-injected', 'true');
            document.head.appendChild(newStyle);
            _injectedHeadStyles.push(newStyle);
        });
    }

    function clearAnimDone() {
        document.querySelectorAll('[data-anim-done]').forEach(function (el) {
            delete el.dataset.animDone;
        });
    }

    // ─────────────────────────────────────────────────────────────
    // SWUP INITIALIZATION
    // ─────────────────────────────────────────────────────────────
    function initSwup() {
        if (typeof Swup === 'undefined') return;
        var plugins = [];
        if (typeof SwupBodyClassPlugin !== 'undefined') plugins.push(new SwupBodyClassPlugin());

        var swup = new Swup({
            containers: ['#swup'],
            animationSelector: '[class*="transition-"]',
            animateHistoryBrowsing: true,
            plugins: plugins
        });

        swup.hooks.on('link:click', progressStart);
        swup.hooks.on('content:replace', function (visit) {
            injectPageHeadStyles(visit);
            reinitThemeUI();
            // Refresh isMobile in case orientation changed
            isMobile = window.innerWidth < 768;
        });
        swup.hooks.on('page:view', function () {
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.getAll().forEach(function (t) { t.kill(); });
            }
            clearAnimDone();
            killSignalTweens();
            initFrontPageHero();
            initSectionTextAnimations();
            initSvgSignal();
            progressDone();
        });

        window._omniSwup = swup;
    }

    // ─────────────────────────────────────────────────────────────
    // BOOT
    // ─────────────────────────────────────────────────────────────
    createProgressBar();

    function boot() {
        initSwup();
        initFrontPageHero();
        initSectionTextAnimations();
        initSvgSignal();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

})();
