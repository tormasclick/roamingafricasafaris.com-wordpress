<?php
/**
 * Dynamic Logo Template with Customizer Support
 */
$logo_alignment = get_theme_mod('roaming_logo_alignment', 'left');
?>
<div class="site-logo" style="text-align: <?php echo $logo_alignment; ?>;">
    <a href="<?php echo home_url(); ?>" class="flex-shrink-0 inline-block">
        <?php if(has_custom_logo()): ?>
            <?php the_custom_logo(); ?>
        <?php else: ?>
            <div class="text-2xl font-heading font-bold" style="color: hsl(135, 53%, 35%);">Roaming Africa</div>
            <div class="text-xs" style="color: hsl(var(--muted-foreground));">Tours & Safaris</div>
        <?php endif; ?>
    </a>
</div>
