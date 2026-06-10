<?php
$partners = get_option('partners_list', array());
if(empty($partners)) return;

$title = get_option('partners_title', 'Recommended and Endorsed By');
$subtitle = get_option('partners_subtitle', 'We are proud to be recognized by leading travel organizations and platforms.');
?>

<section style="padding: 64px 0; background: #f9fafb;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <h2 style="text-align: center; margin-bottom: 16px; font-size: 32px; font-weight: 700; color: #1a3c2c;"><?php echo esc_html($title); ?></h2>
        <p style="text-align: center; color: #666; max-width: 700px; margin: 0 auto 48px;"><?php echo esc_html($subtitle); ?></p>
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 40px;">
            <?php foreach($partners as $partner): ?>
                <?php if(!empty($partner['img'])): ?>
                    <img src="<?php echo esc_url($partner['img']); ?>" alt="<?php echo esc_attr($partner['name']); ?>" style="height: 60px; object-fit: contain; transition: transform 0.3s;">
                <?php else: ?>
                    <div style="font-size: 14px; font-weight: bold; color: #666;"><?php echo esc_html($partner['name']); ?></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
