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

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/brand/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/brand/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/brand/favicon/favicon-16x16.png">
    <link rel="manifest" href="/brand/favicon/site.webmanifest">
    <link rel="shortcut icon" href="/brand/favicon/favicon.ico">

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

    <!-- Font Awesome: hanya brand icons yang dipakai (fa-brands saja, jauh lebih kecil) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/brands.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/brands.min.css"></noscript>

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

        /* SVG Glow Animation — pakai stroke-dashoffset agar cahaya berjalan mengitari outline */
        @keyframes svgGlowLine {
            0%   { stroke-dashoffset: 0; }
            100% { stroke-dashoffset: -100; }
        }
        /* Path utama: cahaya emas tipis berjalan */
        .svg-glow-path {
            fill: none;
            stroke: var(--omni-accent);
            stroke-width: 5;
            stroke-linecap: round;
            stroke-dasharray: 8 92;
            animation: svgGlowLine 14s linear infinite;
            opacity: 0.9;
            /* Pakai filter SVG native via id, bukan CSS filter (menghindari kotak) */
        }
        /* Path kedua: cahaya lebih tebal & lebih lambat untuk efek depth */
        .svg-glow-path-wide {
            fill: none;
            stroke: var(--omni-accent);
            stroke-width: 12;
            stroke-linecap: round;
            stroke-dasharray: 5 95;
            animation: svgGlowLine 18s linear infinite reverse;
            opacity: 0.25;
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
<body <?php body_class('min-h-screen bg-omni-secondary flex flex-col font-sans text-slate-900 overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<!-- ===== OMNI LOADING SCREEN ===== -->
<div id="omni-loader" style="
    position: fixed; inset: 0; z-index: 99999;
    background: #0F172A;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 32px;
    transition: opacity 0.6s ease, visibility 0.6s ease;
">
    <!-- Logo SVG Inline (dari brand/logo_dark.svg, warna diubah ke putih) -->
    <div id="omni-loader-logo" style="animation: omniLogoPulse 2s ease-in-out infinite;">
        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="90" height="90" viewBox="0 0 1688.04 1786.91">
            <defs>
                <style>.ldr-fil {fill:#D4AF37;} .ldr-str {fill:#D4AF37;stroke:#D4AF37;stroke-width:6.24;stroke-miterlimit:22.9256;}</style>
                <filter id="ldr-glow">
                    <feGaussianBlur stdDeviation="18" result="coloredBlur"/>
                    <feMerge><feMergeNode in="coloredBlur"/><feMergeNode in="SourceGraphic"/></feMerge>
                </filter>
            </defs>
            <g filter="url(#ldr-glow)">
                <rect class="ldr-fil" y="654.4" width="102.02" height="401.71" rx="51.01" ry="51.01"/>
                <rect class="ldr-fil" x="1592.87" y="689.44" width="95.17" height="374.74" rx="47.58" ry="47.58"/>
                <path class="ldr-fil" d="M77.97 629.15c-2.83,12.56 -15.31,20.46 -27.87,17.63 -12.57,-2.82 -20.47,-15.31 -17.64,-27.87 58.09,-256.53 214.1,-431.42 408.3,-528.28 129.9,-64.79 276.95,-94.5 423.09,-90.22 146.12,4.27 291.38,42.51 417.74,113.61 191.23,107.61 339.44,290.12 382.73,543.74 2.17,12.72 -6.38,24.79 -19.1,26.96 -12.72,2.17 -24.79,-6.38 -26.96,-19.1 -40.68,-238.3 -179.89,-409.77 -359.52,-510.84 -119.85,-67.44 -257.61,-103.71 -396.17,-107.77 -138.55,-4.05 -277.91,24.09 -400.98,85.48 -182.41,90.98 -328.99,255.39 -383.62,496.66z"/>
                <path class="ldr-fil" d="M845.39 135.18c332.4,0 611.91,226.27 693.02,533.17l0.03 -0.06 0.43 1.76c2.8,10.7 5.34,21.51 7.66,32.39 0.23,1.09 0.48,2.16 0.7,3.24l0.69 3.32c77.92,369.43 -77.14,713.53 -367.14,1042.96 -41.9,53.39 -92.64,41.12 -65.09,-6.5 21.01,-64.13 32.23,-140.01 23.74,-239.55l0.01 -0.02c-89.73,40.41 -189.26,62.9 -294.05,62.9 -395.88,0 -716.8,-320.92 -716.8,-716.8 0,-395.88 320.92,-716.81 716.8,-716.81zm325.44 464.86c-153.04,0 -277.09,124.06 -277.09,277.09 0,153.03 124.05,277.09 277.09,277.09 31.6,0 61.96,-5.3 90.26,-15.05 -6.28,24.26 -15.71,48.46 -27.02,73.57 -11.52,26.26 1.83,49.64 28.54,21.42 65.22,-71.83 122.21,-148.59 158.71,-238.47 8.46,-17.84 15.08,-36.73 19.59,-56.42l0.03 -0.1 -0.01 0.01c4.57,-19.95 6.99,-40.72 6.99,-62.05 0,-153.03 -124.06,-277.09 -277.09,-277.09zm-614.86 -187.37c174.18,0 315.37,141.2 315.37,315.37 0,174.18 -141.19,315.37 -315.37,315.37 -35.97,0 -70.52,-6.04 -102.73,-17.13 7.15,27.61 17.88,55.16 30.75,83.74 13.11,29.88 -2.07,56.5 -32.48,24.37 -74.23,-81.75 -139.1,-169.11 -180.64,-271.41 -9.63,-20.31 -17.16,-41.8 -22.3,-64.21l-0.03 -0.11 0.01 0.01c-5.19,-22.71 -7.95,-46.35 -7.95,-70.63 0,-174.17 141.2,-315.37 315.37,-315.37z"/>
                <circle class="ldr-str" cx="388.01" cy="726.69" r="45.65"/>
                <circle class="ldr-str" cx="543.57" cy="726.69" r="45.65"/>
                <circle class="ldr-str" cx="690.68" cy="726.69" r="45.65"/>
                <circle class="ldr-str" cx="1037.64" cy="884.47" r="38.47"/>
                <circle class="ldr-str" cx="1168.73" cy="884.47" r="38.47"/>
                <circle class="ldr-str" cx="1292.69" cy="884.47" r="38.47"/>
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
@keyframes omniLogoPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50%       { transform: scale(1.08); opacity: 0.85; }
}
#omni-loader.omni-loader-hidden {
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
}
body.omni-loading { overflow: hidden; }
</style>

<script>
(function() {
    document.body.classList.add('omni-loading');
    var loader   = document.getElementById('omni-loader');
    var bar      = document.getElementById('omni-loader-bar');
    var maxMs    = 5000;   // Maksimal 5 detik
    var dismissed = false;

    // Use CSS transition instead of requestAnimationFrame for better performance
    setTimeout(function() {
        if (!dismissed) bar.style.transition = 'width ' + maxMs + 'ms linear';
        if (!dismissed) bar.style.width = '100%';
    }, 50);

    function dismissLoader() {
        if (dismissed) return;
        dismissed = true;
        bar.style.transition = 'width 0.3s linear';
        bar.style.width = '100%';
        setTimeout(function() {
            loader.classList.add('omni-loader-hidden');
            document.body.classList.remove('omni-loading');
        }, 300);
    }

    // Dismiss saat DOM + resource utama siap
    window.addEventListener('load', dismissLoader);
    // Fallback: maksimal 5 detik
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
    <a href="<?php echo home_url('/harga'); ?>" class="flex justify-center items-center w-full shadow-md rounded-xl bg-omni-accent hover:bg-omni-accent-hover transition-all p-3 text-white font-bold">
      Masuk / Coba Gratis
    </a>
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
        <div class="group relative flex items-center shadow-lg rounded-full bg-omni-accent p-1 pr-1.5 cursor-pointer overflow-hidden transition-all duration-300 hover:shadow-[0_8px_20px_rgba(253,184,84,0.4)] hover:-translate-y-0.5 active:scale-95">
          <div class="absolute inset-0 w-full h-full pointer-events-none rounded-full overflow-hidden z-0">
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/20 rounded-[40%] transition-all duration-700 ease-in-out group-hover:top-[-20%] group-hover:rotate-90"></div>
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/30 rounded-[45%] transition-all duration-1000 ease-in-out delay-75 group-hover:top-[-20%] group-hover:rotate-[120deg]"></div>
          </div>
          <span class="relative z-10 text-white px-6 py-1.5 font-bold text-sm tracking-wide">Masuk</span>
          <div class="relative z-10 bg-omni-accent-hover text-white p-1.5 rounded-full transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 shadow-sm">
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>

<main class="flex-1 md:pt-32 pt-20 flex flex-col">
