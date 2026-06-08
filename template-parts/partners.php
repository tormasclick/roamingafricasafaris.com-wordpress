<?php
/**
 * Partners and Trust Badges Section
 */

$partners = array(
    array('name' => 'TripAdvisor', 'icon' => 'fab fa-tripadvisor'),
    array('name' => 'Magical Kenya', 'icon' => 'fas fa-tree'),
    array('name' => 'Tanzania Tourism', 'icon' => 'fas fa-mountain'),
    array('name' => 'SafariBookings', 'icon' => 'fas fa-book'),
    array('name' => 'Kenya Tourism', 'icon' => 'fas fa-lion'),
    array('name' => 'Ecotourism Kenya', 'icon' => 'fas fa-leaf'),
);
?>

<section class="partners-section" style="padding: 60px 0; background: white;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h3 style="font-size: 24px; font-weight: 700; color: #1a3c2c; font-family: 'Ubuntu', sans-serif;">Trusted By Leading Organizations</h3>
        </div>
        
        <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 50px;">
            <?php foreach($partners as $partner): ?>
                <div style="text-align: center; opacity: 0.7; transition: opacity 0.3s;">
                    <i class="<?php echo $partner['icon']; ?>" style="font-size: 48px; color: #298742;"></i>
                    <p style="font-size: 12px; color: #666; margin-top: 10px;"><?php echo $partner['name']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
            <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
                <div>
                    <i class="fas fa-shield-alt" style="color: #298742; margin-right: 8px;"></i>
                    <span style="color: #555;">Licensed & Insured</span>
                </div>
                <div>
                    <i class="fas fa-lock" style="color: #298742; margin-right: 8px;"></i>
                    <span style="color: #555;">Secure Booking</span>
                </div>
                <div>
                    <i class="fas fa-credit-card" style="color: #298742; margin-right: 8px;"></i>
                    <span style="color: #555;">Multiple Payment Options</span>
                </div>
                <div>
                    <i class="fas fa-headset" style="color: #298742; margin-right: 8px;"></i>
                    <span style="color: #555;">24/7 Customer Support</span>
                </div>
            </div>
        </div>
    </div>
</section>
