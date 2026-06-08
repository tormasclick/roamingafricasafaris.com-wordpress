<?php
function roamingafrica_enqueue_assets() {
    wp_enqueue_style("tailwind", get_template_directory_uri() . "/assets/css/tailwind.css");
    wp_enqueue_style("fontawesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css");
}
add_action("wp_enqueue_scripts", "roamingafrica_enqueue_assets");

function roamingafrica_register_safari_cpt() {
    register_post_type("safari", array(
        "labels" => array("name" => "Safaris", "singular_name" => "Safari"),
        "public" => true,
        "has_archive" => true,
        "supports" => array("title","editor","thumbnail")
    ));
}
add_action("init", "roamingafrica_register_safari_cpt");
?>
