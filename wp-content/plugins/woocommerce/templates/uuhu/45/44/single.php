<?php get_header(); ?>
    <div class="page-content">
        <div class="center-wrapper">
        <?php while (have_posts() ) : the_post(); ?>
        <div class="page-content page-content_single">
            <div class="center-wrapper center-wrapper--min">
                <div class="breadcrumbs-wrapper">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item"><a href="<?php echo get_category_link(3); ?>">Новости</a></li>
                        <li class="breadcrumbs__item breadcrumbs__item_arrow">></li>
                        <li class="breadcrumbs__item">Статья</li>
                    </ul>
                </div>
               <div class="title main-title main-title_single">
                   <h3><?php the_title(); ?></h3>
               </div>
               <div class="single-img">
                   <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                   <span class="single-date"><?php the_time('d F Y') ?></span>
               </div>

               <div class="single-content">
                   <?php the_content(); ?>
                   <div class="single-content__socials">
                       <?php echo DISPLAY_ULTIMATE_PLUS(); ?>
                   </div>
               
               </div>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
<?php get_footer(); ?>
