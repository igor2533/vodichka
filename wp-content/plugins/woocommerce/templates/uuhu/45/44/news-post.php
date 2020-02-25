<a href="<?php the_permalink(); ?>" class="news__item">
    <div class="news__picture">
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
    </div>
    <div class="news__text-block">
        <div class="news__date">
            <span><?php the_time('d F Y') ?></span>
        </div>
        <div class="news__title">
            <h5><?php the_title(); ?></h5>
        </div>
        <div class="text">
            <?php the_excerpt(); ?>
        </div>
    </div>
</a>