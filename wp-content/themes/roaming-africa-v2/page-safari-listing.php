<?php get_header(); ?>

<main class="container mx-auto px-6 py-12">
  <h1 class="text-3xl font-bold mb-8">Our Safaris</h1>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <?php
    $args = array('post_type' => 'safari', 'posts_per_page' => 9);
    $query = new WP_Query($args);
    if($query->have_posts()):
      while($query->have_posts()): $query->the_post();
        echo '<div class="bg-white shadow-md rounded-lg overflow-hidden">';
        the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']);
        echo '<div class="p-4">';
        the_title('<h2 class="text-xl font-semibold mb-2">','</h2>');
        the_excerpt();
        echo '</div></div>';
      endwhile;
    endif;
    wp_reset_postdata();
    ?>
  </div>
</main>

<?php get_footer(); ?>
