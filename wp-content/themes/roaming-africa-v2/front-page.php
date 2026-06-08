<?php get_header(); ?>

<main>
  <!-- Hero Section -->
  <section class="relative bg-cover bg-center h-[600px]" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="text-center text-white">
        <h1 class="text-6xl font-extrabold mb-4">Roaming Africa Safaris</h1>
        <p class="text-2xl mb-6">Experience the Great Migration & Beyond</p>
        <a href="/booking" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-8 py-4 rounded-lg">Book Your Safari</a>
      </div>
    </div>
  </section>

  <!-- Featured Safaris -->
  <section class="container mx-auto px-6 py-12">
    <h2 class="text-4xl font-bold mb-8 text-center">Featured Safaris</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php
      $args = array('post_type' => 'safari', 'posts_per_page' => 6);
      $query = new WP_Query($args);
      if($query->have_posts()):
        while($query->have_posts()): $query->the_post();
          echo '<div class="bg-white shadow-lg rounded-lg overflow-hidden">';
          the_post_thumbnail('large', ['class' => 'w-full h-64 object-cover']);
          echo '<div class="p-6">';
          the_title('<h3 class="text-2xl font-semibold mb-3">','</h3>');
          the_excerpt();
          echo '<a href="' . get_permalink() . '" class="text-yellow-600 font-bold mt-4 inline-block">Read More</a>';
          echo '</div></div>';
        endwhile;
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
