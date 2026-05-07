<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-slate-50 font-sans text-slate-900'); ?>>
<?php wp_body_open(); ?>
