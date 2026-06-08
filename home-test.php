<?php get_header(); ?>
<div style="padding: 20px; background: yellow;">
    <h1>TEST MODE - Hero should appear below</h1>
</div>
<?php get_template_part('template-parts/hero-slider'); ?>
<div style="padding: 20px; background: lightgreen;">
    <p>If you see this but not the hero, the hero template is not loading properly.</p>
</div>
<?php get_footer(); ?>
