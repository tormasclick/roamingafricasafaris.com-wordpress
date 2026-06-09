<?php
/**
 * RankMath Configuration for Safari CPT
 */

// Add Safari post type to RankMath sitemap
add_filter('rank_math/sitemap/post_type_archive_link', function($link, $post_type) {
    if($post_type === 'safari') {
        return get_post_type_archive_link('safari');
    }
    return $link;
}, 10, 2);

// Ensure RankMath recognizes Safari post type
add_filter('rank_math/sitemap/post_types', function($post_types) {
    $post_types['safari'] = 'safari';
    return $post_types;
});

// Add custom meta box for RankMath on safari CPT
add_filter('rank_math/metabox/post_types', function($post_types) {
    $post_types[] = 'safari';
    return $post_types;
});
