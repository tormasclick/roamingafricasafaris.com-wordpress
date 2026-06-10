<?php
$company_name = get_option('footer_company_name', 'Roaming Africa Tours and Safaris');
$address = get_option('footer_address', '2nd Floor, Country Arcade, Ngong Road, Nairobi, Kenya – East Africa');
$po_box = get_option('footer_po_box', 'P.O. Box 40-50105, Nairobi, Kenya');
$phone_1 = get_option('footer_phone_1', '+254 722 433 910');
$phone_2 = get_option('footer_phone_2', '+254 706 563 764');
$phone_3 = get_option('footer_phone_3', '+254 723 480 704');
$email_1 = get_option('footer_email_1', 'info@roamingafricasafaris.com');
$email_2 = get_option('footer_email_2', 'reservations@roamingafricasafaris.com');
$payments_text = get_option('footer_payments_text', 'We Accept');
$payment_logos = get_option('footer_payment_logos', array());
$facebook = get_option('footer_facebook', '#');
$twitter = get_option('footer_twitter', '#');
$instagram = get_option('footer_instagram', '#');
$youtube = get_option('footer_youtube', '#');

$kenya_menu = get_option('footer_kenya_menu', array());
$tanzania_menu = get_option('footer_tanzania_menu', array());
$quick_links = get_option('footer_quick_links', array());
$resources = get_option('footer_resources', array());

if(empty($payment_logos)) {
    $payment_logos = array(
        array('name' => 'Visa', 'logo' => 'https://img.icons8.com/color/48/visa.png'),
        array('name' => 'Mastercard', 'logo' => 'https://img.icons8.com/color/48/mastercard.png'),
        array('name' => 'M-Pesa', 'logo' => '')
    );
}
?>

<footer style="background-color: #298742; color: white; padding: 48px 0 0;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 32px;">
            
            <!-- Column 1 - Get In Touch -->
            <div>
                <h3 style="font-size: 16px; margin-bottom: 16px; font-weight: 700;">Get In Touch</h3>
                <address style="font-style: normal; font-size: 12px; opacity: 0.95; margin-bottom: 16px; line-height: 1.6;">
                    <?php echo nl2br(esc_html($address)); ?><br>
                    <?php echo esc_html($po_box); ?>
                </address>
                <ul style="list-style: none; padding: 0; margin: 0 0 16px; font-size: 12px;">
                    <?php if($phone_1): ?><li style="margin-bottom: 6px;"><i class="fas fa-phone-alt" style="width: 20px;"></i> <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $phone_1); ?>" style="color: white; text-decoration: none;"><?php echo esc_html($phone_1); ?></a></li><?php endif; ?>
                    <?php if($phone_2): ?><li style="margin-bottom: 6px;"><i class="fas fa-phone-alt" style="width: 20px;"></i> <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $phone_2); ?>" style="color: white; text-decoration: none;"><?php echo esc_html($phone_2); ?></a></li><?php endif; ?>
                    <?php if($phone_3): ?><li style="margin-bottom: 6px;"><i class="fas fa-phone-alt" style="width: 20px;"></i> <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $phone_3); ?>" style="color: white; text-decoration: none;"><?php echo esc_html($phone_3); ?></a></li><?php endif; ?>
                    <?php if($email_1): ?><li style="margin-bottom: 6px;"><i class="fas fa-envelope" style="width: 20px;"></i> <a href="mailto:<?php echo esc_attr($email_1); ?>" style="color: white; text-decoration: none;"><?php echo esc_html($email_1); ?></a></li><?php endif; ?>
                    <?php if($email_2): ?><li style="margin-bottom: 6px;"><i class="fas fa-envelope" style="width: 20px;"></i> <a href="mailto:<?php echo esc_attr($email_2); ?>" style="color: white; text-decoration: none;"><?php echo esc_html($email_2); ?></a></li><?php endif; ?>
                </ul>
                <div style="display: flex; gap: 12px; margin-bottom: 20px;">
                    <?php if($facebook && $facebook != '#'): ?><a href="<?php echo esc_url($facebook); ?>" target="_blank" style="color: white; opacity: 0.8;"><i class="fab fa-facebook-f" style="font-size: 18px;"></i></a><?php endif; ?>
                    <?php if($twitter && $twitter != '#'): ?><a href="<?php echo esc_url($twitter); ?>" target="_blank" style="color: white; opacity: 0.8;"><i class="fab fa-twitter" style="font-size: 18px;"></i></a><?php endif; ?>
                    <?php if($instagram && $instagram != '#'): ?><a href="<?php echo esc_url($instagram); ?>" target="_blank" style="color: white; opacity: 0.8;"><i class="fab fa-instagram" style="font-size: 18px;"></i></a><?php endif; ?>
                    <?php if($youtube && $youtube != '#'): ?><a href="<?php echo esc_url($youtube); ?>" target="_blank" style="color: white; opacity: 0.8;"><i class="fab fa-youtube" style="font-size: 18px;"></i></a><?php endif; ?>
                </div>
                <div>
                    <h4 style="font-size: 12px; font-weight: 700; margin-bottom: 8px;"><?php echo esc_html($payments_text); ?></h4>
                    <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                        <?php foreach($payment_logos as $logo): ?>
                            <?php if(!empty($logo['logo'])): ?>
                                <img src="<?php echo esc_url($logo['logo']); ?>" alt="<?php echo esc_attr($logo['name']); ?>" style="height: 32px; width: auto; object-fit: contain; background: white; padding: 4px; border-radius: 4px;">
                            <?php else: ?>
                                <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 20px; font-size: 11px;"><?php echo esc_html($logo['name']); ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <?php if(!empty($kenya_menu)): ?>
            <div>
                <h3 style="font-size: 16px; margin-bottom: 16px; font-weight: 700;">Explore Kenya</h3>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 12px;">
                    <?php foreach($kenya_menu as $item): ?>
                        <li style="margin-bottom: 8px;"><a href="<?php echo esc_url($item['href']); ?>" style="color: white; text-decoration: none; opacity: 0.9;"><?php echo esc_html($item['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <?php if(!empty($tanzania_menu)): ?>
            <div>
                <h3 style="font-size: 16px; margin-bottom: 16px; font-weight: 700;">Explore Tanzania</h3>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 12px;">
                    <?php foreach($tanzania_menu as $item): ?>
                        <li style="margin-bottom: 8px;"><a href="<?php echo esc_url($item['href']); ?>" style="color: white; text-decoration: none; opacity: 0.9;"><?php echo esc_html($item['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <?php if(!empty($quick_links)): ?>
            <div>
                <h3 style="font-size: 16px; margin-bottom: 16px; font-weight: 700;">Quick Links</h3>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 12px;">
                    <?php foreach($quick_links as $item): ?>
                        <li style="margin-bottom: 8px;"><a href="<?php echo esc_url($item['href']); ?>" style="color: white; text-decoration: none; opacity: 0.9;"><?php echo esc_html($item['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <?php if(!empty($resources)): ?>
            <div>
                <h3 style="font-size: 16px; margin-bottom: 16px; font-weight: 700;">Resources</h3>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 12px;">
                    <?php foreach($resources as $item): ?>
                        <li style="margin-bottom: 8px;"><a href="<?php echo esc_url($item['href']); ?>" style="color: white; text-decoration: none; opacity: 0.9;"><?php echo esc_html($item['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div style="border-top: 1px solid rgba(255,255,255,0.2); margin-top: 48px; padding: 20px; text-align: center; font-size: 11px; opacity: 0.8;">
        © <?php echo date('Y'); ?> <?php echo esc_html($company_name); ?> | All Rights Reserved
    </div>
</footer>

<style>
@media (max-width: 1024px) {
    footer > div:first-child > div:first-child {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 32px !important;
    }
}
@media (max-width: 640px) {
    footer > div:first-child > div:first-child {
        grid-template-columns: 1fr !important;
    }
}
footer a:hover {
    opacity: 1 !important;
    text-decoration: underline !important;
}
footer .fab:hover, footer .fas:hover {
    transform: translateY(-2px);
}
</style>

<?php wp_footer(); ?>
</body>
</html>
