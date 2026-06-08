<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Ubuntu', sans-serif; background: #f5f0e8; }
        .container { max-width: 1280px; margin: 0 auto; padding: 0 16px; }
        .top-bar { background: var(--roaming-primary, #298742); color: white; padding: 8px 0; font-size: 14px; }
        .top-bar a { color: white; text-decoration: none; margin-right: 16px; }
        .top-bar a:hover { color: var(--roaming-accent, #F5A623); }
        .main-header { background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 100; }
        .nav-link { color: #333; text-decoration: none; padding: 8px 16px; border-radius: 999px; font-size: 14px; font-weight: 500; display: inline-block; }
        .nav-link:hover { color: var(--roaming-primary, #298742); background: #f0f0f0; }
        .nav-link-highlight { background: var(--roaming-primary, #298742); color: white; }
        .nav-link-highlight:hover { background: var(--roaming-primary, #298742)cc; }
        .site-logo img { max-height: 60px; width: auto; object-fit: contain; }
        .whatsapp-float { position: fixed; bottom: 20px; right: 20px; background: #25D366; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 30px; z-index: 1000; text-decoration: none; }
        @media (max-width: 1024px) { .desktop-nav { display: none !important; } }
    </style>
</head>
<body <?php body_class(); ?>>

<div class="top-bar">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="tel:<?php echo str_replace(' ', '', get_theme_mod('roaming_phone', '+254722433910')); ?>"><i class="fas fa-phone-alt"></i> <?php echo get_theme_mod('roaming_phone', '+254 722 433 910'); ?></a>
                <a href="tel:<?php echo str_replace(' ', '', get_theme_mod('roaming_phone_secondary', '+254706563764')); ?>"><i class="fas fa-phone-alt"></i> <?php echo get_theme_mod('roaming_phone_secondary', '+254 706 563 764'); ?></a>
                <a href="mailto:<?php echo get_theme_mod('roaming_email', 'info@roamingafricasafaris.com'); ?>"><i class="fas fa-envelope"></i> <?php echo get_theme_mod('roaming_email', 'info@roamingafricasafaris.com'); ?></a>
            </div>
            <a href="/booking" class="booking-btn" style="background: var(--roaming-accent, #F5A623); color: #2D2D2D; padding: 4px 16px; border-radius: 999px; font-weight: bold; font-size: 12px; text-decoration: none;">Make a Booking</a>
        </div>
    </div>
</div>

<header class="main-header">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 80px;">
            <div class="site-logo">
                <?php if(has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <a href="<?php echo home_url(); ?>" style="font-size: 24px; font-weight: bold; color: var(--roaming-primary, #298742); text-decoration: none;">
                        Roaming Africa<br><span style="font-size: 12px; color: #666;">Tours & Safaris</span>
                    </a>
                <?php endif; ?>
            </div>
            <?php echo roaming_render_nav(); ?>
        </div>
    </div>
</header>

<a href="https://wa.me/<?php echo get_theme_mod('roaming_whatsapp', '254722433910'); ?>" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>
