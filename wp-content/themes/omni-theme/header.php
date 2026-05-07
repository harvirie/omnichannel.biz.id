<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              omni: {
                dark: '<?php echo esc_js(get_theme_mod("omni_primary_color", "#1C2C1F")); ?>',
                light: '<?php echo esc_js(get_theme_mod("omni_light_color", "#EBF4E3")); ?>',
                accent: '<?php echo esc_js(get_theme_mod("omni_accent_color", "#FDB854")); ?>',
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
        }
        
        /* Hide scrollbar utility */
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-[#7A9E7E] flex flex-col font-sans text-slate-900'); ?>>
<?php wp_body_open(); ?>

<!-- Mobile Navbar -->
<nav class="md:hidden fixed w-full bg-[#EBF4E3]/90 backdrop-blur-md z-50 border-b border-[#d2e3c9]">
  <div class="px-4">
    <div class="flex justify-between items-center h-20">
      <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-[#415B45] p-2 rounded-lg">
            <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-[#1C2C1F]"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
      </a>
      <div class="flex items-center">
        <button id="mobile-menu-btn" class="text-[#4F6854]">
          <i data-lucide="menu" class="h-6 w-6 menu-icon"></i>
          <i data-lucide="x" class="h-6 w-6 close-icon hidden"></i>
        </button>
      </div>
    </div>
  </div>
  <div id="mobile-menu-panel" class="hidden bg-[#EBF4E3] border-b border-[#d2e3c9] px-4 pt-2 pb-4 space-y-1 shadow-lg absolute w-full">
    <?php
      $current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    ?>
    <a href="<?php echo home_url('/fitur'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'fitur' ? 'text-[#FDB854] bg-[#1C2C1F]/5' : 'text-[#4F6854] hover:text-[#567558]'; ?>">Fitur</a>
    <a href="<?php echo home_url('/use-case'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'use-case' ? 'text-[#FDB854] bg-[#1C2C1F]/5' : 'text-[#4F6854] hover:text-[#567558]'; ?>">Use Case</a>
    <a href="<?php echo home_url('/analitik'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'analitik' ? 'text-[#FDB854] bg-[#1C2C1F]/5' : 'text-[#4F6854] hover:text-[#567558]'; ?>">Analitik Data</a>
    <a href="<?php echo home_url('/harga'); ?>" class="block px-3 py-2 rounded-md font-medium <?php echo $current_path == 'harga' ? 'text-[#FDB854] bg-[#1C2C1F]/5' : 'text-[#4F6854] hover:text-[#567558]'; ?>">Harga</a>
  </div>
</nav>

<!-- Desktop & Tablet Header Wrapper (Floating Rounded Square) -->
<div class="hidden md:flex fixed top-6 left-0 w-full z-50 justify-center pointer-events-none px-4">
  <header class="w-full max-w-[1100px] pointer-events-auto transition-all duration-300 bg-[#1C2C1F]/95 backdrop-blur-md border border-white/10 shadow-2xl rounded-[2rem]">
    <div class="px-6 h-20 flex justify-between items-center">
      <!-- Logo -->
      <div class="w-1/4">
      <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-[#415B45] p-2 rounded-xl shadow-sm">
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
          ];
          foreach ($links as $link) {
              $is_active = ($current_path === $link['path']);
              $text_color = $is_active ? 'text-[#FDB854]' : 'text-white';
              $line_classes = $is_active ? 'w-full opacity-100' : 'w-1 opacity-0 group-hover:opacity-100 group-hover:w-full';
              echo '<a href="' . home_url('/' . $link['path']) . '" class="group relative text-sm font-medium transition-all duration-300 hover:text-[#FDB854] hover:-translate-y-0.5 ' . $text_color . '">' . $link['name'] . '<span class="absolute -bottom-2 left-1/2 -translate-x-1/2 h-0.5 bg-[#FDB854] rounded-full transition-all duration-300 ' . $line_classes . '"></span></a>';
          }
        ?>
      </nav>

      <!-- Sign In Button -->
      <div class="w-1/4 flex justify-end">
        <div class="group relative flex items-center shadow-lg rounded-full bg-[#FDB854] p-1 pr-1.5 cursor-pointer overflow-hidden transition-all duration-300 hover:shadow-[0_8px_20px_rgba(253,184,84,0.4)] hover:-translate-y-0.5 active:scale-95">
          <div class="absolute inset-0 w-full h-full pointer-events-none rounded-full overflow-hidden z-0">
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/20 rounded-[40%] transition-all duration-700 ease-in-out group-hover:top-[-20%] group-hover:rotate-90"></div>
            <div class="absolute top-[120%] left-[-50%] w-[200%] h-[200%] bg-white/30 rounded-[45%] transition-all duration-1000 ease-in-out delay-75 group-hover:top-[-20%] group-hover:rotate-[120deg]"></div>
          </div>
          <span class="relative z-10 text-white px-6 py-1.5 font-bold text-sm tracking-wide">Masuk</span>
          <div class="relative z-10 bg-[#e89e3a] text-white p-1.5 rounded-full transition-all duration-300 group-hover:rotate-45 group-hover:scale-110 shadow-sm">
            <i data-lucide="arrow-right" class="h-4 w-4"></i>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>

<main class="flex-1 md:pt-32 pt-20 flex flex-col">
