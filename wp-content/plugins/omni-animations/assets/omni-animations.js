/**
 * Omni Animations JS — v3.3.2
 * Swup + GSAP ScrollTrigger + GSAP SVG Signal Pulse + GSAP Text Animations.
 *
 * NEW v3.3:
 *  - initSectionTextAnimations(): animasi text premium untuk semua section
 *      * Badge pills: slide dari kiri dengan scale bounce
 *      * h1/h2 headings: clip-path curtain reveal kiri→kanan + slide up
 *      * Subtitle/paragraf: fade up dengan blur micro-transition
 *      * List items: stagger slide dari kiri
 *      * Feature cards: stagger bounce dari bawah
 *  - initSvgSignal() v2: opacity lebih tinggi, breathe lebih dramatis
 *    agar gold pulse benar-benar terlihat di atas SVG
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
        gsapReady = true;
        return true;
    }

    // ─────────────────────────────────────────────────────────────
    // SVG SIGNAL PULSE — GSAP v3.3
    // ─────────────────────────────────────────────────────────────
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

        var TRAVEL = 10; // detik untuk satu loop penuh

        /* ── AURA (lebar, emas, di bawah core) ── */
        auraPaths.forEach(function (path, i) {
            var D = i * 0.2 + 0.05;
            gsap.set(path, { strokeDashoffset: 100, opacity: 0 });

            var tl = gsap.timeline({ repeat: -1, delay: D });
            tl.fromTo(path,
                { strokeDashoffset: 100, opacity: 0 },
                { strokeDashoffset: 0, opacity: 1, duration: TRAVEL, ease: 'none' }
            );
            tl.to(path, { opacity: 0, duration: 0.5, ease: 'power3.in' }, TRAVEL - 0.5);
            _signalTweens.push(tl);

            // Heartbeat denyut aura
            var pulse = gsap.to(path, {
                keyframes: [
                    { opacity: 1,    duration: 0.15, ease: 'power3.out' },
                    { opacity: 0.3,  duration: 0.22, ease: 'power3.in'  },
                    { opacity: 0.9,  duration: 0.15, ease: 'power3.out' },
                    { opacity: 0.4,  duration: 0.48, ease: 'sine.out'   },
                ],
                repeat: -1, repeatDelay: 0.35, delay: D + 0.7
            });
            _signalTweens.push(pulse);

            // Stroke breathe: 12px ↔ 20px
            var breathe = gsap.to(path, {
                strokeWidth: 20,
                duration: 0.6, ease: 'sine.inOut', yoyo: true,
                repeat: -1, delay: D + 0.7
            });
            _signalTweens.push(breathe);
        });

        /* ── CORE DOT (emas terang, tajam, di atas) ── */
        corePaths.forEach(function (path, i) {
            var D = i * 0.2;
            gsap.set(path, { strokeDashoffset: 100, opacity: 0 });

            var tl = gsap.timeline({ repeat: -1, delay: D });
            tl.fromTo(path,
                { strokeDashoffset: 100, opacity: 0 },
                { strokeDashoffset: 0, opacity: 1, duration: TRAVEL, ease: 'none' }
            );
            tl.to(path, { opacity: 0, duration: 0.4, ease: 'power3.in' }, TRAVEL - 0.4);
            _signalTweens.push(tl);

            // Detak jantung (dua spike per siklus)
            var pulse = gsap.to(path, {
                keyframes: [
                    { opacity: 1,    duration: 0.10, ease: 'power3.out' },
                    { opacity: 0.35, duration: 0.18, ease: 'power3.in'  },
                    { opacity: 0.95, duration: 0.10, ease: 'power3.out' },
                    { opacity: 0.45, duration: 0.42, ease: 'power1.out' },
                ],
                repeat: -1, repeatDelay: 0.25, delay: D + 0.5
            });
            _signalTweens.push(pulse);

            // Stroke breathe: 5px ↔ 8px
            var breathe = gsap.to(path, {
                strokeWidth: 8,
                duration: 0.5, ease: 'sine.inOut', yoyo: true,
                repeat: -1, delay: D + 0.5
            });
            _signalTweens.push(breathe);
        });
    }

    // ─────────────────────────────────────────────────────────────
    // GSAP TEXT ANIMATIONS PREMIUM — Semua Section
    // ─────────────────────────────────────────────────────────────

    /**
     * Wrap setiap kata dalam span dengan overflow:hidden wrapper,
     * hanya untuk elemen yang TIDAK mengandung tag HTML di dalamnya.
     * Return array span .omni-w, atau null jika elemen punya child elements.
     */
    function splitIntoWords(el) {
        // Jika ada child elements (span, strong, br, dll) → jangan split
        if (el.children.length > 0) return null;
        var text = el.textContent.trim();
        var words = text.split(/\s+/);
        if (words.length < 2) return null;

        el.innerHTML = words.map(function (w) {
            return '<span style="display:inline-block;overflow:hidden;vertical-align:bottom;margin-right:0.22em;">'
                 + '<span class="omni-w" style="display:inline-block;will-change:transform,opacity;">'
                 + w + '</span></span>';
        }).join('');
        return Array.from(el.querySelectorAll('.omni-w'));
    }

    function animateHeading(el, triggerEl, delay) {
        delay = delay || 0;
        var wordSpans = splitIntoWords(el);

        if (wordSpans) {
            // Word-by-word slide up dari bawah wrapper (clip effect)
            gsap.fromTo(wordSpans,
                { y: '105%', opacity: 0 },
                {
                    y: '0%', opacity: 1,
                    duration: 0.65,
                    ease: 'power3.out',
                    stagger: 0.06,
                    delay: delay,
                    scrollTrigger: {
                        trigger: triggerEl || el,
                        start: 'top 88%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        } else {
            // Elemen punya HTML → clip-path curtain kiri ke kanan + slide up
            gsap.fromTo(el,
                { clipPath: 'inset(0 100% 0 0 round 2px)', y: 22, opacity: 0.6 },
                {
                    clipPath: 'inset(0 0% 0 0 round 2px)',
                    y: 0, opacity: 1,
                    duration: 0.90,
                    ease: 'power4.out',
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

    function animateBadge(el, triggerEl, delay) {
        delay = delay || 0;
        gsap.fromTo(el,
            { x: -28, opacity: 0, scale: 0.85 },
            {
                x: 0, opacity: 1, scale: 1,
                duration: 0.55,
                ease: 'back.out(2)',
                delay: delay,
                scrollTrigger: {
                    trigger: triggerEl || el,
                    start: 'top 90%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function animateSubtitle(el, triggerEl, delay) {
        delay = delay || 0;
        gsap.fromTo(el,
            { y: 28, opacity: 0, filter: 'blur(4px)' },
            {
                y: 0, opacity: 1, filter: 'blur(0px)',
                duration: 0.75,
                ease: 'power3.out',
                delay: delay,
                scrollTrigger: {
                    trigger: triggerEl || el,
                    start: 'top 90%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function animateListItems(items, triggerEl) {
        if (!items || !items.length) return;
        gsap.fromTo(items,
            { x: -40, opacity: 0 },
            {
                x: 0, opacity: 1,
                duration: 0.55,
                ease: 'power3.out',
                stagger: 0.09,
                scrollTrigger: {
                    trigger: triggerEl || items[0],
                    start: 'top 88%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    function animateCards(cards, triggerEl) {
        if (!cards || !cards.length) return;
        gsap.fromTo(cards,
            { y: 55, opacity: 0, scale: 0.95 },
            {
                y: 0, opacity: 1, scale: 1,
                duration: 0.72,
                ease: 'back.out(1.5)',
                stagger: 0.11,
                scrollTrigger: {
                    trigger: triggerEl || cards[0],
                    start: 'top 87%',
                    toggleActions: 'play none none none'
                }
            }
        );
    }

    /**
     * Main text animation init — bekerja di semua halaman.
     * Scan semua section dan terapkan animasi kontekstual.
     */
    function initSectionTextAnimations() {
        if (!ensureGsap()) return;
        var container = document.getElementById('swup');
        if (!container) return;

        // ── Setiap section block diproses satu per satu ──────────
        var sections = Array.from(container.querySelectorAll('section, [class*="py-20"], [class*="py-24"], [class*="py-16"]'));

        // Deduplicate (avoid animating same element twice)
        var seen = new WeakSet();
        sections = sections.filter(function(s) {
            if (seen.has(s)) return false;
            seen.add(s); return true;
        });

        sections.forEach(function (section) {
            // Badge pill (inline-flex dengan icon + text, rounded-full)
            var badges = Array.from(section.querySelectorAll(
                '.inline-flex.items-center.gap-2[class*="rounded-full"][class*="font-bold"]:not([data-anim-done])'
            ));
            badges.forEach(function (badge) {
                badge.dataset.animDone = '1';
                animateBadge(badge, section, 0);
            });

            // Heading (h1, h2) — section level saja (bukan di dalam card kecil)
            var headings = Array.from(section.querySelectorAll('h1, h2')).filter(function (h) {
                return !h.dataset.animDone;
            });
            headings.forEach(function (h, hi) {
                h.dataset.animDone = '1';
                animateHeading(h, section, badges.length ? 0.12 : 0);
            });

            // h4 di dalam cards — cukup bounce up (tidak word-split)
            var h4s = Array.from(section.querySelectorAll('h4:not([data-anim-done])'));
            // h4 dihandle by animateCards bersama parentnya

            // Subtitle / deskripsi (p langsung di bawah h2 atau di text-center)
            var subtitles = Array.from(section.querySelectorAll(
                ':is(.text-center, .md\\:w-1\\/2, [class*="max-w-2xl"]) > p:not([data-anim-done]),' +
                'section > div > p:not([data-anim-done])'
            )).filter(function (p) { return !p.dataset.animDone; });
            subtitles.slice(0, 3).forEach(function (p, pi) {
                p.dataset.animDone = '1';
                animateSubtitle(p, section, 0.18 + pi * 0.08);
            });

            // Feature description paragraphs di md:w-1/2 (section 2-col)
            var featurePs = Array.from(section.querySelectorAll(
                '.md\\:w-1\\/2 p:not([data-anim-done])'
            ));
            featurePs.slice(0, 2).forEach(function (p) {
                p.dataset.animDone = '1';
                animateSubtitle(p, section, 0.22);
            });

            // List items (li dalam ul)
            var listItems = Array.from(section.querySelectorAll(
                'ul > li:not([data-anim-done])'
            ));
            if (listItems.length) {
                listItems.forEach(function (li) { li.dataset.animDone = '1'; });
                animateListItems(listItems, section);
            }

            // Feature cards di grid (div.grid > div, rounded card)
            var gridCards = Array.from(section.querySelectorAll(
                '.grid > div:not([data-anim-done]), .space-y-4 > li:not([data-anim-done])'
            ));
            if (gridCards.length) {
                gridCards.forEach(function (c) { c.dataset.animDone = '1'; });
                animateCards(gridCards, section);
            }

            // Dark card rows (flex items di support section, dsb)
            var darkCards = Array.from(section.querySelectorAll(
                '.bg-omni-dark.rounded-2xl:not([data-anim-done])'
            ));
            if (darkCards.length) {
                darkCards.forEach(function (c) { c.dataset.animDone = '1'; });
                animateCards(darkCards, section);
            }
        });

        // ── Hero section khusus (fitur page & front page) ────────
        var heroBadge = container.querySelector(
            '.pt-40 .inline-flex:not([data-anim-done]), .pt-52 .inline-flex:not([data-anim-done])'
        );
        var heroH1    = container.querySelector('h1:not([data-anim-done])');
        var heroP     = container.querySelector(
            'h1 + p:not([data-anim-done]), h1 ~ p:not([data-anim-done])'
        );

        if (heroBadge && !heroBadge.dataset.animDone) {
            heroBadge.dataset.animDone = '1';
            gsap.fromTo(heroBadge,
                { y: -20, opacity: 0, scale: 0.9 },
                { y: 0, opacity: 1, scale: 1, duration: 0.6, ease: 'back.out(2)', delay: 0.1 }
            );
        }
        if (heroH1 && !heroH1.dataset.animDone) {
            heroH1.dataset.animDone = '1';
            var heroWords = splitIntoWords(heroH1);
            if (heroWords) {
                gsap.fromTo(heroWords,
                    { y: '110%', opacity: 0 },
                    { y: '0%', opacity: 1, duration: 0.7, ease: 'power4.out', stagger: 0.05, delay: 0.22 }
                );
            } else {
                gsap.fromTo(heroH1,
                    { clipPath: 'inset(0 100% 0 0 round 2px)', y: 20 },
                    { clipPath: 'inset(0 0% 0 0 round 2px)', y: 0, duration: 1.0, ease: 'power4.out', delay: 0.22 }
                );
            }
        }
        if (heroP && !heroP.dataset.animDone) {
            heroP.dataset.animDone = '1';
            gsap.fromTo(heroP,
                { y: 30, opacity: 0, filter: 'blur(5px)' },
                { y: 0, opacity: 1, filter: 'blur(0px)', duration: 0.8, ease: 'power3.out', delay: 0.45 }
            );
        }

        // ── CTA dark section (Siap Memilih Paket...) ─────────────
        var ctaDark = container.querySelector('section.bg-omni-dark, .py-20.bg-omni-dark');
        if (ctaDark) {
            var ctaH2 = ctaDark.querySelector('h2:not([data-anim-done])');
            var ctaP  = ctaDark.querySelector('p:not([data-anim-done])');
            var ctaBtns = Array.from(ctaDark.querySelectorAll('a:not([data-anim-done])'));
            if (ctaH2 && !ctaH2.dataset.animDone) {
                ctaH2.dataset.animDone = '1';
                animateHeading(ctaH2, ctaDark, 0);
            }
            if (ctaP && !ctaP.dataset.animDone) {
                ctaP.dataset.animDone = '1';
                animateSubtitle(ctaP, ctaDark, 0.2);
            }
            if (ctaBtns.length) {
                ctaBtns.forEach(function (b) { b.dataset.animDone = '1'; });
                gsap.fromTo(ctaBtns,
                    { y: 30, opacity: 0, scale: 0.95 },
                    {
                        y: 0, opacity: 1, scale: 1,
                        duration: 0.65, ease: 'back.out(1.6)',
                        stagger: 0.1, delay: 0.3,
                        scrollTrigger: { trigger: ctaDark, start: 'top 88%', toggleActions: 'play none none none' }
                    }
                );
            }
        }

        // ── Support list (li dengan icon box di section 5) ────────
        var supportItems = Array.from(container.querySelectorAll(
            '.space-y-4 > li:not([data-anim-done])'
        ));
        if (supportItems.length) {
            supportItems.forEach(function (li) { li.dataset.animDone = '1'; });
            animateListItems(supportItems, supportItems[0].closest('section'));
        }

        // ── Chatbot demo card items ───────────────────────────────
        var chatItems = Array.from(container.querySelectorAll(
            '.space-y-3 > div:not([data-anim-done])'
        ));
        if (chatItems.length) {
            chatItems.forEach(function (d) { d.dataset.animDone = '1'; });
            animateCards(chatItems, chatItems[0].closest('section'));
        }
    }

    // ─────────────────────────────────────────────────────────────
    // PARALLAX
    // ─────────────────────────────────────────────────────────────
    function initParallax() {
        if (!ensureGsap()) return;
        ScrollTrigger.getAll().forEach(function (t) { t.kill(); });

        var container = document.getElementById('swup');
        if (!container || container.getAttribute('data-parallax') !== 'yes') return;

        Array.from(container.querySelectorAll('img')).forEach(function (img) {
            if (img.closest('.hero-illustration-container')) return;
            function apply() {
                if (img.clientHeight > 80) {
                    gsap.to(img, {
                        y: -40, ease: 'none',
                        scrollTrigger: { trigger: img, start: 'top bottom', end: 'bottom top', scrub: 0.8 }
                    });
                }
            }
            img.complete && img.naturalHeight > 0 ? apply() : img.addEventListener('load', apply, { once: true });
        });
    }

    // ─────────────────────────────────────────────────────────────
    // LEGACY HERO SCROLL REVEAL (front-page.php spesifik)
    // ─────────────────────────────────────────────────────────────
    function initFrontPageHero() {
        if (!ensureGsap()) return;
        var container = document.getElementById('swup');
        if (!container) return;

        // Hanya jalankan di front-page (bukan fitur/harga)
        var heroSection = container.querySelector('section:first-of-type');
        if (!heroSection) return;

        var heroDesktop = heroSection.querySelector('.hidden.md\\:flex');
        if (!heroDesktop) return;

        var hdLogo  = heroDesktop.querySelector('a[aria-label]');
        var hdH1    = heroDesktop.querySelector('h1');
        var hdSub   = heroDesktop.querySelector('[class*="text-omni-text-muted"]');
        var hdForm  = heroDesktop.querySelector('form');
        var hdBadge = heroDesktop.querySelector('[class*="flex items-center gap"]');

        if (hdLogo)  gsap.fromTo(hdLogo,  { y: -30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power3.out', delay: 0.1 });
        if (hdH1 && !hdH1.dataset.animDone) {
            hdH1.dataset.animDone = '1';
            gsap.fromTo(hdH1, { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 1.0, ease: 'back.out(1.4)', delay: 0.2 });
        }
        if (hdSub)   gsap.fromTo(hdSub,   { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 0.8, ease: 'power3.out', delay: 0.38 });
        if (hdForm)  gsap.fromTo(hdForm,  { y: 30, opacity: 0, scale: 0.97 }, { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'back.out(1.5)', delay: 0.52 });
        if (hdBadge) gsap.fromTo(hdBadge, { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power2.out', delay: 0.68 });

        var heroVideoCard = heroSection.querySelector('.hidden.md\\:block.absolute');
        if (heroVideoCard) gsap.fromTo(heroVideoCard, { x: 60, opacity: 0, scale: 0.95 }, { x: 0, opacity: 1, scale: 1, duration: 1.1, ease: 'power3.out', delay: 0.3 });
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
    //
    // Swup hanya replace innerHTML #swup — inline <style> di <head>
    // (dari wp_head action) TIDAK ikut terupdate. Fungsi ini:
    //  1. Ambil semua <style> dari head halaman yang baru di-fetch
    //  2. Inject ke <head> dokumen saat ini
    //  3. Hapus injected styles dari navigasi sebelumnya
    // ─────────────────────────────────────────────────────────────
    var _injectedHeadStyles = [];

    function injectPageHeadStyles(visit) {
        // 1. Hapus style yang di-inject dari navigasi sebelumnya
        _injectedHeadStyles.forEach(function (el) {
            if (el && el.parentNode) el.parentNode.removeChild(el);
        });
        _injectedHeadStyles = [];

        // 2. Inject styles dari halaman baru (via Swup visit.to.document)
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

    // Clean up data-anim-done markers dari Swup sebelumnya
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
        // content:replace: inject head styles DULU, kemudian reinit UI
        // Ini fix utama untuk gap yang terjadi karena wp_head CSS tidak
        // diupdate oleh Swup (Swup hanya replace #swup innerHTML)
        swup.hooks.on('content:replace', function (visit) {
            injectPageHeadStyles(visit);
            reinitThemeUI();
        });
        swup.hooks.on('page:view', function () {
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.getAll().forEach(function (t) { t.kill(); });
            }
            clearAnimDone();
            killSignalTweens();
            initParallax();
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

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

    function boot() {
        initSwup();
        initParallax();
        initFrontPageHero();
        initSectionTextAnimations();
        initSvgSignal();
    }

})();
