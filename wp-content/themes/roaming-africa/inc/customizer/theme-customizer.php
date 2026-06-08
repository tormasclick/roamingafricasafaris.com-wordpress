<?php
/**
 * Complete Theme Customizer
 */

function roaming_theme_customizer($wp_customize) {
    
    // ========== LOGO SETTINGS ==========
    $wp_customize->add_section('roaming_logo_section', array(
        'title' => __('Logo Settings', 'roaming-africa'),
        'priority' => 20,
    ));
    
    // Logo Width
    $wp_customize->add_setting('roaming_logo_width', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_logo_width', array(
        'label' => __('Logo Width (px)', 'roaming-africa'),
        'section' => 'roaming_logo_section',
        'type' => 'number',
        'input_attrs' => array('min' => 50, 'max' => 300, 'step' => 5),
    ));
    
    // Logo Height
    $wp_customize->add_setting('roaming_logo_height', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_logo_height', array(
        'label' => __('Logo Height (px)', 'roaming-africa'),
        'section' => 'roaming_logo_section',
        'type' => 'number',
        'input_attrs' => array('min' => 40, 'max' => 120, 'step' => 5),
    ));
    
    // Logo Alignment
    $wp_customize->add_setting('roaming_logo_alignment', array(
        'default' => 'left',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('roaming_logo_alignment', array(
        'label' => __('Logo Alignment', 'roaming-africa'),
        'section' => 'roaming_logo_section',
        'type' => 'radio',
        'choices' => array('left' => 'Left', 'center' => 'Center'),
    ));
    
    // ========== COLOR SETTINGS ==========
    $wp_customize->add_section('roaming_colors', array(
        'title' => __('Theme Colors', 'roaming-africa'),
        'priority' => 30,
    ));
    
    // Primary Color (Green)
    $wp_customize->add_setting('roaming_primary_color', array(
        'default' => '#298742',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'roaming_primary_color', array(
        'label' => __('Primary Color (Green)', 'roaming-africa'),
        'section' => 'roaming_colors',
        'settings' => 'roaming_primary_color',
    )));
    
    // Accent Color (Gold)
    $wp_customize->add_setting('roaming_accent_color', array(
        'default' => '#F5A623',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'roaming_accent_color', array(
        'label' => __('Accent Color (Gold)', 'roaming-africa'),
        'section' => 'roaming_colors',
        'settings' => 'roaming_accent_color',
    )));
    
    // ========== CONTACT SETTINGS ==========
    $wp_customize->add_section('roaming_contact', array(
        'title' => __('Contact Info', 'roaming-africa'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('roaming_phone', array('default' => '+254 722 433 910', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('roaming_phone', array('label' => 'Phone Number', 'section' => 'roaming_contact', 'type' => 'text'));
    
    $wp_customize->add_setting('roaming_phone_secondary', array('default' => '+254 706 563 764', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('roaming_phone_secondary', array('label' => 'Secondary Phone', 'section' => 'roaming_contact', 'type' => 'text'));
    
    $wp_customize->add_setting('roaming_email', array('default' => 'info@roamingafricasafaris.com', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('roaming_email', array('label' => 'Email', 'section' => 'roaming_contact', 'type' => 'email'));
    
    $wp_customize->add_setting('roaming_whatsapp', array('default' => '254722433910', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('roaming_whatsapp', array('label' => 'WhatsApp Number', 'section' => 'roaming_contact', 'type' => 'text'));
    
    // ========== SOCIAL SETTINGS ==========
    $wp_customize->add_section('roaming_social', array(
        'title' => __('Social Media', 'roaming-africa'),
        'priority' => 50,
    ));
    
    $socials = ['facebook', 'twitter', 'instagram', 'youtube'];
    foreach($socials as $social) {
        $wp_customize->add_setting("roaming_{$social}", array('default' => '#', 'sanitize_callback' => 'esc_url_raw'));
        $wp_customize->add_control("roaming_{$social}", array('label' => ucfirst($social) . ' URL', 'section' => 'roaming_social', 'type' => 'url'));
    }
}
add_action('customize_register', 'roaming_theme_customizer');

// Apply dynamic styles
function roaming_customizer_css() {
    $primary = get_theme_mod('roaming_primary_color', '#298742');
    $accent = get_theme_mod('roaming_accent_color', '#F5A623');
    $logo_width = get_theme_mod('roaming_logo_width');
    $logo_height = get_theme_mod('roaming_logo_height');
    $logo_align = get_theme_mod('roaming_logo_alignment', 'left');
    ?>
    <style>
        :root {
            --roaming-primary: <?php echo $primary; ?>;
            --roaming-accent: <?php echo $accent; ?>;
        }
        .top-bar { background: <?php echo $primary; ?>; }
        .nav-link-highlight { background: <?php echo $primary; ?>; }
        .nav-link-highlight:hover { background: <?php echo $primary; ?>cc; }
        .booking-btn { background: <?php echo $accent; ?>; }
        .site-logo { text-align: <?php echo $logo_align; ?>; }
        <?php if($logo_width): ?>
        .site-logo img { width: <?php echo $logo_width; ?>px !important; }
        <?php endif; ?>
        <?php if($logo_height): ?>
        .site-logo img { height: <?php echo $logo_height; ?>px !important; }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'roaming_customizer_css');
