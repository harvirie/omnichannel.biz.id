<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Resource Hints: Preconnect ke semua CDN eksternal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.tailwindcss.com">

    <!-- Google Fonts: display=swap agar teks langsung tampil -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Swiper CSS: dimuat lebih awal karena dipakai di hero -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"></noscript>

    <!-- Font Awesome: async load via media trick (non-blocking) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous"></noscript>

    <!-- Tailwind CSS: File statis yang dikompilasi lokal (tidak pakai CDN) -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/omni-theme.css">
    <!-- Lucide Icons: defer agar tidak memblokir render -->
    <script src="https://unpkg.com/lucide@latest" defer></script>
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
            filter: url(#glow-filter);
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
            filter: url(#glow-filter);
        }
    </style>
    <?php
    if (is_singular()) {
        $seo_desc = get_post_meta(get_the_ID(), '_omni_seo_desc', true);
        if ($seo_desc) {
            echo '<meta name="description" content="' . esc_attr($seo_desc) . '">' . "\n";
        }
        $seo_title = get_post_meta(get_the_ID(), '_omni_seo_title', true);
        if ($seo_title) {
            // We use a filter to override the document title if custom SEO title is set
            add_filter('pre_get_document_title', function($title) use ($seo_title) {
                return $seo_title;
            }, 99);
        }
    }
    ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-omni-secondary flex flex-col font-sans text-slate-900 overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<!-- Mobile Navbar -->
<nav class="md:hidden fixed top-0 w-full bg-omni-light/90 backdrop-blur-md z-40 border-b border-omni-border">
  <div class="px-4">
    <div class="flex justify-between items-center h-20">
      <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-omni-button-hover p-2 rounded-lg">
            <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-omni-dark"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
      </a>
      <div class="flex items-center">
        <button id="mobile-menu-btn" class="text-omni-text-muted hover:text-omni-accent transition-colors">
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
    <div class="flex items-center gap-2">
      <div class="bg-omni-button-hover p-2 rounded-lg shadow-sm">
        <i data-lucide="headphones" class="h-5 w-5 text-white"></i>
      </div>
      <span class="font-bold text-lg tracking-tight text-omni-dark">Menu Navigasi</span>
    </div>
    <button id="mobile-menu-close" class="text-omni-text-muted hover:text-omni-accent transition-colors bg-white p-2 rounded-full shadow-sm border border-omni-border/50">
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
  <header class="w-full max-w-[1100px] pointer-events-auto transition-all duration-300 bg-omni-dark/95 backdrop-blur-md border border-white/10 shadow-2xl rounded-[2rem]">
    <div class="px-6 h-20 flex justify-between items-center">
      <!-- Logo -->
      <div class="w-1/4">
      <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-omni-button-hover p-2 rounded-xl shadow-sm">
            <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-2xl tracking-tight text-white"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
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
