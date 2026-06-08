<?php
/**
 * Dynamic Navigation Renderer
 * Renders menu items stored in WordPress options
 */

function roaming_render_desktop_nav() {
    $menu_items = roaming_get_menu_items();
    if(empty($menu_items)) return;
    
    ob_start();
    ?>
    <nav class="desktop-nav hidden lg:flex items-center gap-1">
        <?php foreach($menu_items as $item): ?>
            <?php if($item['type'] == 'link'): ?>
                <div class="nav-item">
                    <a href="<?php echo esc_url($item['url']); ?>" class="nav-link"><?php echo esc_html($item['label']); ?></a>
                </div>
            <?php elseif($item['type'] == 'dropdown' && isset($item['children'])): ?>
                <div class="nav-item">
                    <a href="<?php echo esc_url($item['url']); ?>" class="nav-link"><?php echo esc_html($item['label']); ?> <i class="fas fa-chevron-down w-3.5 h-3.5"></i></a>
                    <div class="dropdown-menu">
                        <?php foreach($item['children'] as $child): ?>
                            <a href="<?php echo esc_url($child['url']); ?>" class="dropdown-item"><?php echo esc_html($child['label']); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif($item['type'] == 'mega' && isset($item['mega_columns'])): ?>
                <div class="nav-item">
                    <a href="<?php echo esc_url($item['url']); ?>" class="nav-link"><?php echo esc_html($item['label']); ?> <i class="fas fa-chevron-down"></i></a>
                    <div class="mega-menu mega-<?php echo count($item['mega_columns']); ?>cols">
                        <?php foreach($item['mega_columns'] as $column): ?>
                            <div>
                                <p class="mega-title"><?php echo esc_html($column['title']); ?></p>
                                <ul>
                                    <?php foreach($column['items'] as $child): ?>
                                        <li><a href="<?php echo esc_url($child['url']); ?>" class="mega-link"><?php echo esc_html($child['label']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif($item['type'] == 'highlight'): ?>
                <div class="nav-item">
                    <a href="<?php echo esc_url($item['url']); ?>" class="nav-link nav-link-highlight"><?php echo esc_html($item['label']); ?></a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>
    <?php
    return ob_get_clean();
}

function roaming_render_mobile_nav() {
    $menu_items = roaming_get_menu_items();
    if(empty($menu_items)) return;
    
    ob_start();
    ?>
    <div class="mobile-menu" id="mobileMenu">
        <div class="p-4 border-b flex justify-between items-center" style="border-color: hsl(var(--border));">
            <div class="text-xl font-heading font-bold" style="color: hsl(135, 53%, 35%);">Menu</div>
            <button id="closeMobileMenu" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div class="p-4">
            <?php foreach($menu_items as $item): ?>
                <?php if($item['type'] == 'link'): ?>
                    <a href="<?php echo esc_url($item['url']); ?>" class="block py-3 font-medium border-b" style="border-color: hsl(var(--border));"><?php echo esc_html($item['label']); ?></a>
                <?php elseif($item['type'] == 'dropdown' && isset($item['children'])): ?>
                    <div class="py-2 border-b" style="border-color: hsl(var(--border));">
                        <div class="flex justify-between items-center cursor-pointer mobile-dropdown-toggle">
                            <span class="font-medium"><?php echo esc_html($item['label']); ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="mobile-submenu hidden pl-4 mt-2 space-y-2">
                            <?php foreach($item['children'] as $child): ?>
                                <a href="<?php echo esc_url($child['url']); ?>" class="block py-1 text-sm" style="color: hsl(var(--muted-foreground));"><?php echo esc_html($child['label']); ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php elseif($item['type'] == 'mega'): ?>
                    <a href="<?php echo esc_url($item['url']); ?>" class="block py-3 font-medium border-b" style="border-color: hsl(var(--border));"><?php echo esc_html($item['label']); ?></a>
                <?php elseif($item['type'] == 'highlight'): ?>
                    <a href="<?php echo esc_url($item['url']); ?>" class="block py-3 font-medium"><?php echo esc_html($item['label']); ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="p-4 border-t" style="border-color: hsl(var(--border));">
            <a href="/booking" class="booking-btn block text-center py-3 rounded-full font-heading font-bold">Make a Booking</a>
            <a href="https://wa.me/<?php echo get_theme_mod('roaming_whatsapp', '254722433910'); ?>" target="_blank" class="block text-center bg-[#25D366] text-white py-3 rounded-full font-bold mt-3">WhatsApp Us</a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
