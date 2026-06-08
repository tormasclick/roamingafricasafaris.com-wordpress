<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="bg-gray-900 text-white px-8 py-6 flex justify-between items-center">
  <h1 class="text-3xl font-bold"><?php bloginfo('name'); ?></h1>
  <nav class="space-x-8 text-lg">
    <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'flex space-x-8')); ?>
  </nav>
</header>
