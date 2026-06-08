<?php
// Mega menu setup with default menu items
function roaming_get_menu_items() {
    return array(
        array('label' => 'Home', 'url' => '/', 'type' => 'link'),
        array(
            'label' => 'Kenya Safaris',
            'url' => '/kenya-safaris',
            'type' => 'dropdown',
            'children' => array(
                array('label' => 'Kenya Safari Tours', 'url' => '/kenya-safaris'),
                array('label' => 'Day Trips', 'url' => '/kenya-safaris/day-trips'),
                array('label' => 'Flying Safaris', 'url' => '/kenya-safaris/fly-in'),
                array('label' => 'Helicopter Tours', 'url' => '/kenya-safaris/helicopter'),
            )
        ),
        array(
            'label' => 'Tanzania Safaris',
            'url' => '/tanzania-safaris',
            'type' => 'dropdown',
            'children' => array(
                array('label' => 'Tanzania Safari Tours', 'url' => '/tanzania-safaris'),
                array('label' => 'Flying Safaris', 'url' => '/tanzania-safaris/fly-in'),
                array('label' => 'Zanzibar Beach', 'url' => '/tanzania-safaris/zanzibar'),
            )
        ),
        array('label' => 'Combo Safaris', 'url' => '/combo-safaris', 'type' => 'link'),
        array('label' => 'Destinations', 'url' => '/destinations', 'type' => 'link'),
        array('label' => 'Hotels & Lodges', 'url' => '/hotels', 'type' => 'link'),
        array('label' => 'Our Vehicles', 'url' => '/our-vehicles', 'type' => 'link'),
        array('label' => 'Contact', 'url' => '/contact', 'type' => 'highlight'),
    );
}

function roaming_render_desktop_nav() {
    $items = roaming_get_menu_items();
    $html = '<nav class="desktop-nav hidden lg:flex items-center gap-1">';
    foreach($items as $item) {
        if($item['type'] == 'highlight') {
            $html .= '<a href="' . $item['url'] . '" class="nav-link nav-link-highlight">' . $item['label'] . '</a>';
        } else {
            $html .= '<a href="' . $item['url'] . '" class="nav-link">' . $item['label'] . '</a>';
        }
    }
    $html .= '</nav>';
    return $html;
}
