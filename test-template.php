<?php
/*
Template Name: Test Template
*/
get_header(); ?>
<div class="container mx-auto px-4 py-12 text-center">
    <h1 class="text-4xl font-bold text-[#298742]">Theme is Working!</h1>
    <p class="text-xl mt-4">If you can see this, your theme is active.</p>
    <p>Current theme: <?php echo wp_get_theme()->get('Name'); ?></p>
</div>
<?php get_footer(); ?>
