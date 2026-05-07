<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Outfit', 'sans-serif'],
              serif: ['Playfair Display', 'serif'],
            },
            colors: {
              omni: {
                dark: '<?php echo esc_js(get_theme_mod("omni_primary_color", "#1C2C1F")); ?>',
                light: '<?php echo esc_js(get_theme_mod("omni_light_color", "#EBF4E3")); ?>',
                accent: '<?php echo esc_js(get_theme_mod("omni_accent_color", "#FDB854")); ?>',
                secondary: '<?php echo esc_js(get_theme_mod("omni_secondary_color", "#7A9E7E")); ?>',
                button: '<?php echo esc_js(get_theme_mod("omni_button_color", "#567558")); ?>',
                'button-hover': '<?php echo esc_js(get_theme_mod("omni_button_hover", "#415B45")); ?>',
                'accent-hover': '<?php echo esc_js(get_theme_mod("omni_accent_hover", "#e89e3a")); ?>',
                'text-muted': '<?php echo esc_js(get_theme_mod("omni_text_muted", "#4F6854")); ?>',
                border: '<?php echo esc_js(get_theme_mod("omni_border_color", "#d2e3c9")); ?>',
                'dark-border': '<?php echo esc_js(get_theme_mod("omni_dark_border", "#2C4131")); ?>',
                'dark-hover': '<?php echo esc_js(get_theme_mod("omni_dark_hover", "#2A3E2F")); ?>',
              }
            }
          }
        }
      }
    </script>
    <style>
        /* Base color variables for standard CSS if needed */
        :root {
            --omni-dark: <?php echo esc_attr(get_theme_mod('omni_primary_color', '#1C2C1F')); ?>;
            --omni-light: <?php echo esc_attr(get_theme_mod('omni_light_color', '#EBF4E3')); ?>;
            --omni-accent: <?php echo esc_attr(get_theme_mod('omni_accent_color', '#FDB854')); ?>;
            --omni-secondary: <?php echo esc_attr(get_theme_mod('omni_secondary_color', '#7A9E7E')); ?>;
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
<nav class="md:hidden fixed w-full bg-omni-light/90 backdrop-blur-md z-50 border-b border-omni-border">
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
        <button id="mobile-menu-btn" class="text-omni-text-muted">
          <i data-lucide="menu" class="h-6 w-6 menu-icon"></i>
          <i data-lucide="x" class="h-6 w-6 close-icon hidden"></i>
        </button>
      </div>
    </div>
  </div>
  <div id="mobile-menu-panel" class="hidden bg-omni-light border-b border-omni-border px-4 pt-2 pb-4 space-y-1 shadow-lg absolute w-full">
    <?php
      $current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    ?>
    <a href="<?php echo home_url('/fitur'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'fitur' ? 'text-omni-accent bg-omni-dark/5' : 'text-omni-text-muted hover:text-omni-button'; ?>">Fitur</a>
    <a href="<?php echo home_url('/use-case'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'use-case' ? 'text-omni-accent bg-omni-dark/5' : 'text-omni-text-muted hover:text-omni-button'; ?>">Use Case</a>
    <a href="<?php echo home_url('/analitik'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'analitik' ? 'text-omni-accent bg-omni-dark/5' : 'text-omni-text-muted hover:text-omni-button'; ?>">Analitik Data</a>
    <a href="<?php echo home_url('/harga'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'harga' ? 'text-omni-accent bg-omni-dark/5' : 'text-omni-text-muted hover:text-omni-button'; ?>">Harga</a>
    <a href="<?php echo home_url('/artikel'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'artikel' ? 'text-omni-accent bg-omni-dark/5' : 'text-omni-text-muted hover:text-omni-button'; ?>">Artikel</a>
  </div>
</nav>

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
      <nav class="flex-1 flex justify-center gap-8">
        <?php
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
              echo '<a href="' . home_url('/' . $link['path']) . '" class="group relative text-sm font-medium transition-all duration-300 hover:text-omni-accent hover:-translate-y-0.5 ' . $text_color . '">' . $link['name'] . '<span class="absolute -bottom-2 left-1/2 -translate-x-1/2 h-0.5 bg-omni-accent rounded-full transition-all duration-300 ' . $line_classes . '"></span></a>';
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
