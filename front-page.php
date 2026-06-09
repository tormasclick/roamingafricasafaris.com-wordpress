<?php
/**
 * Front Page Template
 * Homepage - Modular structure
 */

get_header(); ?>

<!-- Hero Slider Section -->
<?php get_template_part('template-parts/hero-slider'); ?>

<!-- Safari Planner Section -->
<?php get_template_part('template-parts/safari-planner'); ?>

<!-- Why Travel With Us Section -->
<?php get_template_part('template-parts/why-travel-with-us'); ?>

<!-- Best Featured Safari Deals Section -->
<?php get_template_part('template-parts/featured-safaris'); ?>

<!-- Popular Destinations Section -->
<?php get_template_part('template-parts/popular-destinations'); ?>

<!-- Hotels & Safari Lodges Section -->
<?php get_template_part('template-parts/hotels-section'); ?>

<!-- Safari Vehicles Section -->
<?php get_template_part('template-parts/vehicles-section'); ?>

<!-- CTA Section -->
<?php get_template_part('template-parts/cta-section'); ?>

<?php get_footer(); ?>
