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
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-slate-50 font-sans text-slate-900'); ?>>
<?php wp_body_open(); ?>
