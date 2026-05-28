<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Resource Hints: Preconnect ke CDN aktif saja -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://res.cloudinary.com" crossorigin>

    <!-- Favicon (Base64 inline to bypass hosting JS challenge) -->
    <?php
    $favicon_path = get_template_directory() . '/assets/img/favicon.ico';
    if (file_exists($favicon_path)) {
        $base64 = base64_encode(file_get_contents($favicon_path));
        $data_uri = 'data:image/x-icon;base64,' . $base64;
        echo '<link rel="icon" type="image/x-icon" href="' . $data_uri . '">' . "\n";
        echo '<link rel="shortcut icon" type="image/x-icon" href="' . $data_uri . '">' . "\n";
    }
    ?>

    <?php if ( is_front_page() || is_page('fitur') ) : ?>
    <!-- Google tag (gtag.js) - Deferred -->
    <script>
    function loadGTM() {
        if (window.gtmLoaded) return;
        window.gtmLoaded = true;
        var script = document.createElement('script');
        script.async = true;
        script.src = "https://www.googletagmanager.com/gtag/js?id=AW-18148308364";
        document.head.appendChild(script);

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-18148308364');
    }
    ['mousemove', 'click', 'keydown', 'touchstart', 'wheel'].forEach(e => document.addEventListener(e, loadGTM, {once: true, passive: true}));
    setTimeout(loadGTM, 5000); // Fallback
    </script>
    <?php endif; ?>
    <!-- Google Fonts: hanya weight yang benar-benar dipakai -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Swiper CSS: hanya dimuat jika dipakai, via jsDelivr cepat -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>

    <!-- Font Awesome: hanya brand icons yang dipakai -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/fontawesome.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/brands.min.css" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/brands.min.css">
    </noscript>

    <!-- Tailwind CSS: File statis yang dikompilasi lokal (tidak pakai CDN) -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/omni-theme.css?v=<?php echo filemtime(get_template_directory() . '/assets/omni-theme.css'); ?>">
    <!-- Lucide Icons: jsDelivr lebih cepat & reliable vs unpkg -->
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js" defer></script>
    <style>
        /* Base color variables for standard CSS if needed */
        :root {
            --omni-dark: <?php echo esc_attr(get_theme_mod('omni_primary_color_v2', '#0F172A')); ?>;
            --omni-light: <?php echo esc_attr(get_theme_mod('omni_light_color_v2', '#F8FAFC')); ?>;
            --omni-accent: <?php echo esc_attr(get_theme_mod('omni_accent_color_v2', '#D4AF37')); ?>;
            --omni-secondary: <?php echo esc_attr(get_theme_mod('omni_secondary_color_v2', '#CBD5E1')); ?>;
        }
        
        /* Hide scrollbar utility */
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* ── SVG Signal Pulse — dikontrol sepenuhnya oleh GSAP ─── */
        /* Hanya definisi stroke dasar — opacity & dashoffset diset GSAP via inline style */
        .svg-glow-path {
            fill: none;
            stroke: #FFFDE8;
            stroke-width: 2.5px;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 1.5 98.5;  /* titik kecil per 100 pathLength unit */
            /* stroke-dashoffset: GSAP sets this via inline style */
            /* opacity: GSAP sets this via inline style */
            /* NO vector-effect: non-scaling-stroke — interferes with SVG filter */
            /* NO CSS filter — using SVG <filter> element directly on path */
            will-change: stroke-dashoffset, opacity;
        }
        .svg-glow-path-wide {
            fill: none;
            stroke: #D4AF37;
            stroke-width: 7px;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 4.5 95.5;  /* ekor lebih panjang */
            /* stroke-dashoffset: GSAP sets this via inline style */
            /* opacity: GSAP sets this via inline style */
            will-change: stroke-dashoffset, opacity;
        }
        /* SVG containers yang pakai glow: harus overflow visible */
        svg:has(.svg-glow-path) {
            overflow: visible !important;
        }

        /* Prevent Swiper FOUC (Flash of Unstyled Content) */
        .swiper:not(.swiper-initialized) {
            overflow: hidden;
        }
        .swiper:not(.swiper-initialized) .swiper-wrapper {
            display: flex;
        }
        .customers-swiper:not(.swiper-initialized) .swiper-slide {
            width: 100%;
            flex-shrink: 0;
            box-sizing: border-box;
            padding-right: 20px; /* spaceBetween simulate */
        }
        @media (min-width: 640px) {
            .customers-swiper:not(.swiper-initialized) .swiper-slide { width: 50%; }
        }
        @media (min-width: 1024px) {
            .customers-swiper:not(.swiper-initialized) .swiper-slide { width: 33.333%; padding-right: 30px; }
        }
        @media (min-width: 1280px) {
            .customers-swiper:not(.swiper-initialized) .swiper-slide { width: 25%; }
        }
        .integration-swiper:not(.swiper-initialized) .swiper-slide {
            width: 50%;
            flex-shrink: 0;
            box-sizing: border-box;
            padding-right: 12px; /* simulate spaceBetween */
        }
    </style>
    <?php
    if (is_singular() || is_front_page()) {
        $seo_desc = get_post_meta(get_the_ID(), '_omni_seo_desc', true);
        if (!$seo_desc && is_front_page()) {
            $front_id = get_option('page_on_front');
            $seo_desc = get_post_meta($front_id, '_omni_seo_desc', true);
            if (!$seo_desc) {
                $seo_desc = "Tingkatkan layanan pelanggan Anda dengan OmniServe, Aplikasi Omnichannel dan Software Call Center terintegrasi WhatsApp API, Instagram, dan Email. Coba gratis sekarang!";
            }
        }
        if ($seo_desc) {
            echo '<meta name="description" content="' . esc_attr($seo_desc) . '">' . "\n";
            echo '<meta property="og:description" content="' . esc_attr($seo_desc) . '">' . "\n";
            echo '<meta name="twitter:description" content="' . esc_attr($seo_desc) . '">' . "\n";
        }
        
        $seo_title = get_post_meta(get_the_ID(), '_omni_seo_title', true);
        if (!$seo_title && is_front_page()) {
            $front_id = get_option('page_on_front');
            $seo_title = get_post_meta($front_id, '_omni_seo_title', true);
            if (!$seo_title) {
                $seo_title = "Aplikasi Omnichannel & Software Call Center Terbaik | OmniServe";
            }
        }
        if ($seo_title) {
            add_filter('pre_get_document_title', function($title) use ($seo_title) {
                return $seo_title;
            }, 99);
            echo '<meta property="og:title" content="' . esc_attr($seo_title) . '">' . "\n";
            echo '<meta name="twitter:title" content="' . esc_attr($seo_title) . '">' . "\n";
        }

        // Canonical URL
        $current_url = home_url(add_query_arg(array(), $wp->request));
        echo '<link rel="canonical" href="' . esc_url($current_url) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($current_url) . '">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        
        // Twitter Card
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        
        // Default OG Image
        $og_image = 'https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_wh_ysccoa.svg';
        echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";

        // JSON-LD Schema
        ?>
        <script type="application/ld+json">
        [
          {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "<?php echo esc_js($seo_title ? $seo_title : get_bloginfo('name')); ?>",
            "operatingSystem": "Web",
            "applicationCategory": "BusinessApplication",
            "url": "<?php echo esc_url($current_url); ?>",
            "description": "<?php echo esc_js($seo_desc); ?>",
            "publisher": {
              "@type": "Organization",
              "name": "Kabayan Group",
              "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url($og_image); ?>"
              }
            }
          },
          {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "OmniServe",
            "image": "<?php echo esc_url($og_image); ?>",
            "@id": "<?php echo esc_url($current_url); ?>",
            "url": "<?php echo esc_url($current_url); ?>",
            "telephone": "+6281283835553",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Pusat Bisnis Jakarta",
              "addressLocality": "Jakarta",
              "postalCode": "10000",
              "addressCountry": "ID"
            },
            "sameAs": [
              "https://facebook.com/omniserve",
              "https://twitter.com/omniserve",
              "https://instagram.com/omniserve",
              "https://linkedin.com/company/omniserve",
              "https://youtube.com/@omniserve"
            ]
          }
        ]
        </script>
        <?php
    }
    ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen ' . (is_front_page() ? 'bg-omni-secondary' : 'bg-white') . ' flex flex-col font-sans text-slate-900 overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<!-- ===== OMNI LOADING SCREEN ===== -->
<div id="omni-loader" style="
    position: fixed; inset: 0; z-index: 99999;
    background: #0F172A;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 32px;
    transition: opacity 0.6s ease, visibility 0.6s ease;
">
    <!-- Logo SVG Inline — New animated SVG (bando CW, face CCW) -->
    <div id="omni-loader-logo">
        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="90" height="90" viewBox="0 0 224.5 230.9"
             style="overflow:visible;">
            <defs>
                <style>
                    .ldr-gold    { fill: #D4AF37; }
                    .ldr-gold-eo { fill: #D4AF37; fill-rule: evenodd; }
                    .ldr-gold-rule { fill: #D4AF37; fill-rule: nonzero; }
                    #ldr-bando { transform-origin: 112.25px 115.45px; animation: ldrBandoSpin 6s linear infinite; }
                    #ldr-face  { transform-origin: 112.25px 115.45px; animation: ldrFaceSpin  6s linear infinite; }
                    @keyframes ldrBandoSpin { from { transform: rotate(0deg);    } to { transform: rotate(360deg);  } }
                    @keyframes ldrFaceSpin  { from { transform: rotate(0deg);    } to { transform: rotate(-360deg); } }
                </style>
                <filter id="ldr-glow2">
                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                    <feMerge><feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
            </defs>
            <g filter="url(#ldr-glow2)">
                <!-- Ears (static) -->
                <rect class="ldr-gold" y="87.03" width="13.57" height="53.43" rx="6.78" ry="6.78"/>
                <rect class="ldr-gold" x="211.84" y="91.69" width="12.66" height="49.84" rx="6.33" ry="6.33"/>
                <!-- Bando spins CW -->
                <path id="ldr-bando" class="ldr-gold-rule" d="M10.37 83.67c-0.38,1.67 -2.04,2.72 -3.71,2.35 -1.67,-0.38 -2.72,-2.04 -2.34,-3.71 7.72,-34.12 28.47,-57.37 54.3,-70.26 17.27,-8.61 36.83,-12.56 56.27,-12 19.43,0.57 38.75,5.66 55.55,15.11 25.44,14.32 45.15,38.59 50.9,72.32 0.29,1.69 -0.84,3.29 -2.54,3.58 -1.69,0.29 -3.29,-0.85 -3.58,-2.54 -5.41,-31.69 -23.93,-54.49 -47.81,-67.94 -15.94,-8.96 -34.27,-13.79 -52.69,-14.33 -18.43,-0.54 -36.96,3.21 -53.33,11.37 -24.26,12.1 -43.75,33.97 -51.02,66.05z"/>
                <!-- Face spins CCW -->
                <g id="ldr-face">
                    <path class="ldr-gold" d="M51.6 90.57c3.36,0 6.07,2.72 6.07,6.08 0,3.35 -2.71,6.07 -6.07,6.07 -3.35,0 -6.07,-2.72 -6.07,-6.07 0,-3.36 2.72,-6.08 6.07,-6.08z"/>
                    <path class="ldr-gold" d="M72.29 90.57c3.36,0 6.07,2.72 6.07,6.08 0,3.35 -2.71,6.07 -6.07,6.07 -3.35,0 -6.07,-2.72 -6.07,-6.07 0,-3.36 2.72,-6.08 6.07,-6.08z"/>
                    <path class="ldr-gold" d="M91.86 90.57c3.35,0 6.07,2.72 6.07,6.08 0,3.35 -2.72,6.07 -6.07,6.07 -3.36,0 -6.08,-2.72 -6.08,-6.07 0,-3.36 2.72,-6.08 6.08,-6.08z"/>
                    <path class="ldr-gold" d="M138 112.51c2.83,0 5.12,2.29 5.12,5.12 0,2.82 -2.29,5.11 -5.12,5.11 -2.83,0 -5.12,-2.29 -5.12,-5.11 0,-2.83 2.29,-5.12 5.12,-5.12z"/>
                    <path class="ldr-gold" d="M155.43 112.51c2.83,0 5.12,2.29 5.12,5.12 0,2.82 -2.29,5.11 -5.12,5.11 -2.82,0 -5.11,-2.29 -5.11,-5.11 0,-2.83 2.29,-5.12 5.11,-5.12z"/>
                    <path class="ldr-gold" d="M171.92 112.51c2.83,0 5.12,2.29 5.12,5.12 0,2.82 -2.29,5.11 -5.12,5.11 -2.83,0 -5.12,-2.29 -5.12,-5.11 0,-2.83 2.29,-5.12 5.12,-5.12z"/>
                    <path class="ldr-gold-eo" d="M108.84 20.47c42.35,0 77.96,28.82 88.29,67.93l0.01 -0.01 0.05 0.22c0.36,1.37 0.68,2.74 0.98,4.13 0.03,0.14 0.06,0.27 0.09,0.41l0.08 0.42c9.93,47.07 -9.82,90.91 -46.77,132.88 -5.34,6.8 -11.8,5.24 -8.29,-0.83 2.67,-8.17 4.1,-17.83 3.02,-30.52l0 0c-11.43,5.15 -24.11,8.02 -37.46,8.02 -50.44,0 -91.32,-40.89 -91.32,-91.33 0,-50.44 40.88,-91.32 91.32,-91.32zm41.46 59.22c-19.5,0 -35.3,15.81 -35.3,35.3 0,19.5 15.8,35.31 35.3,35.31 4.03,0 7.9,-0.68 11.5,-1.92 -0.8,3.09 -2,6.17 -3.44,9.37 -1.47,3.35 0.23,6.33 3.64,2.73 8.3,-9.15 15.57,-18.93 20.22,-30.38 1.07,-2.27 1.92,-4.68 2.49,-7.19l0.01 -0.01 -0.01 0c0.59,-2.54 0.89,-5.19 0.89,-7.91 0,-19.49 -15.8,-35.3 -35.3,-35.3zm-78.33 -23.87c22.19,0 40.18,17.99 40.18,40.18 0,22.19 -17.99,40.18 -40.18,40.18 -4.59,0 -8.99,-0.77 -13.09,-2.18 0.91,3.51 2.28,7.02 3.92,10.67 1.67,3.8 -0.27,7.19 -4.14,3.1 -9.46,-10.41 -17.72,-21.55 -23.02,-34.58 -1.22,-2.59 -2.18,-5.32 -2.84,-8.18l0 -0.01 0 0c-0.66,-2.9 -1.01,-5.91 -1.01,-9 0,-22.19 17.99,-40.18 40.18,-40.18z"/>
                </g>
            </g>
        </svg>
    </div>

    <!-- Brand Name -->
    <div style="text-align:center;">
        <div style="color:#D4AF37; font-family:'Outfit',sans-serif; font-size:13px; letter-spacing:0.25em; text-transform:uppercase; font-weight:600; opacity:0.8;">OmniServe</div>
    </div>

    <!-- Progress Bar Container -->
    <div style="width: 200px; height: 2px; background: rgba(255,255,255,0.1); border-radius: 999px; overflow: hidden;">
        <div id="omni-loader-bar" style="
            height: 100%; width: 0%; background: linear-gradient(90deg, #D4AF37, #F5D978);
            border-radius: 999px;
            transition: width 0.1s linear;
            box-shadow: 0 0 8px rgba(212,175,55,0.8);
        "></div>
    </div>
</div>

<style>
#omni-loader-logo {
    animation: omniLogoPulse 3s ease-in-out infinite;
}
@keyframes omniLogoPulse {
    0%, 100% { filter: drop-shadow(0 0 8px rgba(212,175,55,0.5)); }
    50%       { filter: drop-shadow(0 0 22px rgba(212,175,55,0.95)); }
}
#omni-loader.omni-loader-hidden {
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
}
body.omni-loading { overflow: hidden; }
</style>

<script data-swup-ignore-script>
(function() {
    document.body.classList.add('omni-loading');
    var loader   = document.getElementById('omni-loader');
    var bar      = document.getElementById('omni-loader-bar');
    var maxMs    = 1500;   // Maksimal 1.5 detik
    var dismissed = false;

    setTimeout(function() {
        if (!dismissed) bar.style.transition = 'width ' + maxMs + 'ms linear';
        if (!dismissed) bar.style.width = '100%';
    }, 50);

    function dismissLoader() {
        if (dismissed) return;
        dismissed = true;
        bar.style.transition = 'width 0.3s ease';
        bar.style.width = '100%';
        setTimeout(function() {
            loader.classList.add('omni-loader-hidden');
            document.body.classList.remove('omni-loading');
        }, 250);
    }

    window.addEventListener('load', dismissLoader);
    // Dismiss lebih cepat saat DOMContentLoaded juga
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(dismissLoader, 200);
    });
    setTimeout(dismissLoader, maxMs);
})();
</script>
<!-- ===== END OMNI LOADING SCREEN ===== -->


<!-- Mobile Navbar -->
<nav class="md:hidden fixed top-0 w-full z-40 border-b border-white/10 shadow-md" style="background-color: #0F172A; will-change: transform;">
  <div class="px-4">
    <div class="flex justify-between items-center h-20">
      <a href="<?php echo home_url('/'); ?>" aria-label="Beranda OmniServe" class="flex items-center">
        <!-- Logo full untuk latar gelap (mobile navbar) -->
        <img src="https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_wh_ysccoa.svg"
             alt="<?php echo esc_attr(get_bloginfo('name') ?: 'OmniServe Logo'); ?>"
             class="w-auto object-contain"
             style="height: 32px;"
             loading="eager">
      </a>
      <div class="flex items-center">
        <button id="mobile-menu-btn" aria-label="Buka Menu" class="text-omni-text-muted hover:text-omni-accent transition-colors">
          <i data-lucide="menu" class="h-6 w-6 menu-icon"></i>
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-omni-dark/60 backdrop-blur-sm z-[60] opacity-0 pointer-events-none transition-opacity duration-300"></div>

<!-- Mobile Menu Drawer (Side Panel) -->
<div id="mobile-menu-drawer" class="fixed top-0 left-0 h-full w-[80%] max-w-sm bg-omni-light z-[70] shadow-2xl transform -translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] flex flex-col">
  <div class="px-6 h-20 flex items-center justify-between border-b border-omni-border/50 shrink-0">
    <div class="flex items-center">
      <!-- Logo full untuk latar terang (mobile drawer) -->
      <a href="<?php echo home_url('/'); ?>" aria-label="Beranda OmniServe">
        <img src="https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_dark_ymby0d.svg"
             alt="<?php echo esc_attr(get_bloginfo('name') ?: 'OmniServe Logo'); ?>"
             class="h-8 w-auto object-contain"
             loading="eager">
      </a>
    </div>
    <button id="mobile-menu-close" aria-label="Tutup Menu" class="text-omni-text-muted hover:text-omni-accent transition-colors bg-white p-2 rounded-full shadow-sm border border-omni-border/50">
      <i data-lucide="x" class="h-4 w-4"></i>
    </button>
  </div>
  
  <div class="p-6 flex-1 overflow-y-auto space-y-2">
    <?php
    if (has_nav_menu('mobile')) {
        wp_nav_menu([
            'theme_location' => 'mobile',
            'container'      => false,
            'items_wrap'     => '%3$s', // Remove ul wrapper
            'walker'         => new Omni_Mobile_Nav_Walker(),
            'fallback_cb'    => false,
        ]);
    } else {
        // Fallback if no menu assigned
        $current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $links = [
            ['path' => 'fitur', 'name' => 'Fitur', 'icon' => 'layers'],
            ['path' => 'use-case', 'name' => 'Use Case', 'icon' => 'briefcase'],
            ['path' => 'analitik', 'name' => 'Analitik Data', 'icon' => 'bar-chart-2'],
            ['path' => 'harga', 'name' => 'Harga', 'icon' => 'credit-card'],
            ['path' => 'artikel', 'name' => 'Artikel', 'icon' => 'file-text'],
        ];
        foreach ($links as $link) {
            // Skip if View Switch plugin marks this path as hidden
            if ( function_exists('omni_vsw_path_is_hidden') && omni_vsw_path_is_hidden($link['path']) ) continue;
            $is_active = ($current_path === $link['path']);
            $class = $is_active ? 'text-omni-accent bg-omni-dark/5 shadow-inner' : 'text-omni-text-muted hover:text-omni-button hover:bg-omni-dark/5 hover:translate-x-1';
            echo '<a href="' . home_url('/' . $link['path']) . '" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-300 ' . $class . '">';
            echo '<i data-lucide="' . $link['icon'] . '" class="h-5 w-5 opacity-70"></i>';
            echo '<span>' . $link['name'] . '</span>';
            echo '</a>';
        }
    }
    ?>
  </div>
  
  <div class="p-6 border-t border-omni-border/50 shrink-0 bg-white/50">
    <?php if ( is_user_logged_in() ) : ?>
    <a href="<?php echo esc_url( admin_url('admin.php?page=omni-hardening') ); ?>" class="flex justify-center items-center w-full shadow-md rounded-xl bg-omni-accent hover:bg-omni-accent-hover transition-all p-3 text-white font-bold">
      Dashboard
    </a>
    <?php else : ?>
    <a href="<?php echo esc_url( wp_login_url( admin_url('admin.php?page=omni-hardening') ) ); ?>" class="flex justify-center items-center w-full shadow-md rounded-xl bg-omni-accent hover:bg-omni-accent-hover transition-all p-3 text-white font-bold">
      Masuk
    </a>
    <?php endif; ?>
  </div>
</div>

<!-- Desktop & Tablet Header Wrapper (Floating Rounded Square) -->
<div class="hidden md:flex fixed top-6 left-0 w-full z-50 justify-center pointer-events-none px-4">
  <header class="w-full max-w-[1100px] pointer-events-auto transition-shadow duration-300 border border-white/10 shadow-2xl rounded-[2rem]" style="background-color: #0F172A; will-change: transform;">
    <div class="px-6 h-20 flex justify-between items-center">
      <!-- Logo -->
      <div class="w-1/4">
        <a href="<?php echo home_url('/'); ?>" aria-label="Beranda OmniServe" class="flex items-center">
          <!-- Logo full untuk latar gelap (desktop header) -->
          <img src="https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_wh_ysccoa.svg"
               alt="<?php echo esc_attr(get_bloginfo('name') ?: 'OmniServe Logo'); ?>"
               class="h-10 w-auto object-contain"
               loading="eager">
        </a>
      </div>

      <!-- Desktop Navigation -->
      <nav class="flex-1 flex justify-center items-center">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex gap-8 m-0 p-0 list-none',
                'walker'         => new Omni_Desktop_Nav_Walker(),
                'fallback_cb'    => false,
            ]);
        } else {
            // Fallback
            $current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            echo '<ul class="flex gap-8 m-0 p-0 list-none">';
            $links = [
                ['path' => 'fitur', 'name' => 'Fitur'],
                ['path' => 'use-case', 'name' => 'Use Case'],
                ['path' => 'analitik', 'name' => 'Analitik Data'],
                ['path' => 'harga', 'name' => 'Harga'],
                ['path' => 'artikel', 'name' => 'Artikel'],
            ];
            foreach ($links as $link) {
                // Skip if View Switch plugin marks this path as hidden
                if ( function_exists('omni_vsw_path_is_hidden') && omni_vsw_path_is_hidden($link['path']) ) continue;
                $is_active = ($current_path === $link['path']);
                $text_color = $is_active ? 'text-omni-accent' : 'text-white';
                $line_classes = $is_active ? 'w-full opacity-100' : 'w-1 opacity-0 group-hover:opacity-100 group-hover:w-full';
                echo '<li class="flex items-center"><a href="' . home_url('/' . $link['path']) . '" class="group relative text-sm font-medium transition-all duration-300 hover:text-omni-accent hover:-translate-y-0.5 ' . $text_color . '">' . $link['name'] . '<span class="absolute -bottom-2 left-1/2 -translate-x-1/2 h-0.5 bg-omni-accent rounded-full transition-all duration-300 ' . $line_classes . '"></span></a></li>';
            }
            echo '</ul>';
        }
        ?>
      </nav>

      <!-- Sign In Button -->
      <div class="w-1/4 flex justify-end">
        <?php if ( is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( admin_url('admin.php?page=omni-hardening') ); ?>" class="group relative flex items-center shadow-lg rounded-full bg-omni-accent p-1 pr-1.5 cursor-pointer overflow-hidden transition-all duration-300 hover:shadow-[0_8px_20px_rgba(253,184,84,0.4)] hover:-translate-y-0.5 active:scale-95">
          <div class="absolute inset-0 w-full h-full pointer-events-none rounded-full overflow-hidden z-0">
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/20 rounded-[40%] transition-all duration-700 ease-in-out group-hover:top-[-20%] group-hover:rotate-90"></div>
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/30 rounded-[45%] transition-all duration-1000 ease-in-out delay-75 group-hover:top-[-20%] group-hover:rotate-[120deg]"></div>
          </div>
          <span class="relative z-10 text-white px-6 py-1.5 font-bold text-sm tracking-wide">Dashboard</span>
          <div class="relative z-10 bg-omni-accent-hover text-white p-1.5 rounded-full transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 shadow-sm">
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
          </div>
        </a>
        <?php else : ?>
        <a href="<?php echo esc_url( wp_login_url( admin_url('admin.php?page=omni-hardening') ) ); ?>" class="group relative flex items-center shadow-lg rounded-full bg-omni-accent p-1 pr-1.5 cursor-pointer overflow-hidden transition-all duration-300 hover:shadow-[0_8px_20px_rgba(253,184,84,0.4)] hover:-translate-y-0.5 active:scale-95">
          <div class="absolute inset-0 w-full h-full pointer-events-none rounded-full overflow-hidden z-0">
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/20 rounded-[40%] transition-all duration-700 ease-in-out group-hover:top-[-20%] group-hover:rotate-90"></div>
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/30 rounded-[45%] transition-all duration-1000 ease-in-out delay-75 group-hover:top-[-20%] group-hover:rotate-[120deg]"></div>
          </div>
          <span class="relative z-10 text-white px-6 py-1.5 font-bold text-sm tracking-wide">Masuk</span>
          <div class="relative z-10 bg-omni-accent-hover text-white p-1.5 rounded-full transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 shadow-sm">
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
          </div>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </header>
</div>

<?php 
  // Fetch animation settings from post meta
  $transition_class = 'transition-fade'; // default
  $parallax_data = 'no';
  
  if (is_singular()) {
      $enable_trans = get_post_meta(get_the_ID(), '_omni_enable_transitions', true);
      $trans_type = get_post_meta(get_the_ID(), '_omni_transition_type', true);
      $enable_parallax = get_post_meta(get_the_ID(), '_omni_enable_parallax', true);
      
      if ($enable_trans === 'yes' && !empty($trans_type) && $trans_type !== 'none') {
          $transition_class = 'transition-' . $trans_type;
      }
      
      if ($enable_parallax === 'yes') {
          $parallax_data = 'yes';
      }
  }
?>
<!-- ===== OMNI NAV ACTIVE STATE + CLICK RIPPLE (outside #swup so never re-rendered) ===== -->
<script data-swup-ignore-script>
(function() {
    /* ── Update active nav item based on current URL ─────────────── */
    function updateActiveNav() {
        var currentPath = window.location.pathname.replace(/^\/|\/$/, '');
        var isHome = (currentPath === '' || currentPath === '/');

        document.querySelectorAll('header nav a').forEach(function(link) {
            var href = link.getAttribute('href') || '';
            var linkPath = href.replace(/https?:\/\/[^/]+/, '').replace(/^\/|\/$/, '');
            var isActive = isHome
                ? (linkPath === '' || linkPath === 'home')
                : (linkPath !== '' && currentPath.startsWith(linkPath));

            link.classList.remove('text-omni-accent');
            link.classList.add('text-white');
            var indicator = link.querySelector('span');
            if (indicator) {
                indicator.classList.remove('w-full', 'opacity-100');
                indicator.classList.add('w-1', 'opacity-0');
            }

            if (isActive) {
                link.classList.add('text-omni-accent');
                link.classList.remove('text-white');
                if (indicator) {
                    indicator.classList.add('w-full', 'opacity-100');
                    indicator.classList.remove('w-1', 'opacity-0');
                }
            }
        });
    }

    /* ── Ripple click effect on nav links ─────────────────────────── */
    function addRippleToNavLinks() {
        document.querySelectorAll('header nav a').forEach(function(link) {
            if (link.dataset.rippleReady) return;
            link.dataset.rippleReady = '1';
            link.style.position = 'relative';
            link.style.overflow = 'hidden';
            link.addEventListener('click', function(e) {
                var rect = link.getBoundingClientRect();
                var ripple = document.createElement('span');
                var size = Math.max(rect.width, rect.height) * 2.5;
                ripple.style.cssText = [
                    'position:absolute',
                    'border-radius:50%',
                    'pointer-events:none',
                    'background:rgba(212,175,55,0.3)',
                    'width:' + size + 'px',
                    'height:' + size + 'px',
                    'left:' + (e.clientX - rect.left - size/2) + 'px',
                    'top:' + (e.clientY - rect.top - size/2) + 'px',
                    'transform:scale(0)',
                    'animation:omniNavRipple 0.6s cubic-bezier(0.4,0,0.2,1) forwards',
                    'z-index:99'
                ].join(';');
                link.appendChild(ripple);
                setTimeout(function() { ripple.remove(); }, 700);
            });
        });
    }

    /* ── Inject keyframe once ─────────────────────────────────────── */
    if (!document.getElementById('omni-ripple-style')) {
        var s = document.createElement('style');
        s.id = 'omni-ripple-style';
        s.textContent = '@keyframes omniNavRipple{from{transform:scale(0);opacity:1}to{transform:scale(1);opacity:0}}';
        document.head.appendChild(s);
    }

    function boot() {
        updateActiveNav();
        addRippleToNavLinks();
    }

    /* ── Initial run ─────────────────────────────────────────────── */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }

    /* ── Hook into Swup after it initializes ─────────────────────── */
    var checkSwup = setInterval(function() {
        if (window._omniSwup) {
            clearInterval(checkSwup);
            window._omniSwup.hooks.on('page:view', updateActiveNav);
        }
    }, 150);
    setTimeout(function() { clearInterval(checkSwup); }, 8000);
})();
</script>
<!-- ===== END OMNI NAV ACTIVE STATE ===== -->
<main id="swup" class="flex-1 md:pt-32 pt-20 flex flex-col <?php echo esc_attr($transition_class); ?>" data-parallax="<?php echo esc_attr($parallax_data); ?>">
