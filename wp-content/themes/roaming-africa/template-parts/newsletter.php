<?php
/**
 * Newsletter & CTA Section
 */
?>

<section class="newsletter-section" style="padding: 80px 0; background: #F5A623;">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 36px; font-weight: 700; color: #2D2D2D; margin-bottom: 16px; font-family: 'Ubuntu', sans-serif;">
            Ready for Your Safari Adventure?
        </h2>
        <p style="font-size: 18px; color: rgba(45,45,45,0.8); margin-bottom: 30px; font-family: 'Ubuntu', sans-serif;">
            Contact us today to start planning your dream African safari
        </p>
        
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="/contact" style="display: inline-block; background: #298742; color: white; padding: 14px 36px; border-radius: 40px; font-weight: bold; text-decoration: none; transition: all 0.3s ease;">
                Get in Touch <i class="fas fa-phone-alt" style="margin-left: 8px;"></i>
            </a>
            <a href="https://wa.me/254722433910" target="_blank" style="display: inline-block; background: white; color: #298742; padding: 14px 36px; border-radius: 40px; font-weight: bold; text-decoration: none; transition: all 0.3s ease;">
                <i class="fab fa-whatsapp" style="margin-right: 8px;"></i> WhatsApp Us
            </a>
        </div>
        
        <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid rgba(45,45,45,0.2);">
            <p style="font-size: 14px; color: rgba(45,45,45,0.7);">
                Or subscribe to our newsletter for exclusive deals
            </p>
            <form style="display: flex; max-width: 500px; margin: 20px auto 0; gap: 10px; flex-wrap: wrap;">
                <input type="email" placeholder="Your email address" style="flex: 1; padding: 12px 20px; border: none; border-radius: 40px; font-family: 'Ubuntu', sans-serif;">
                <button type="submit" style="background: #298742; color: white; padding: 12px 28px; border: none; border-radius: 40px; font-weight: bold; cursor: pointer;">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<style>
    .newsletter-section button:hover, .newsletter-section a:hover {
        transform: translateY(-2px);
        filter: brightness(1.05);
    }
</style>
