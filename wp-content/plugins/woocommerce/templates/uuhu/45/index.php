<?php get_header(); ?>

  <!-- site-main - START -->
  <main class="site-main">
    <div class="container">
      <?php
        while ( have_posts() ) : the_post();
      ?>
        <?php the_content(); ?>
      <?php
        endwhile;
      ?>
    </div>
  </main>
  <!-- site-main - END -->

<?php get_footer(); ?>