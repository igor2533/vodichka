<?php
global $user_ID;
?>
<div class="project-gallery__item" data-id="<?php the_ID(); ?>">
    <div class="project-gallery__img"><img src="<?php echo get_the_post_thumbnail_url(NULL, 'large' ); ?>" alt=""></div>

<?php //echo wp_get_attachment_image(get_post_thumbnail_id());?>
    <div class="project-gallery__person-name">
        <p><?php echo get_field('автор')['user_firstname']; ?></p>
    </div>
    <div class="project-gallery__project-name">
        <p><?php the_title(); ?></p>
        <?php // echo get_simple_likes_button( get_the_ID() ); ?>
        <?php echo wp_post_likes(); ?>
    </div>
    <?php
        $owner_id = get_field('автор')['ID'];
        $view = $_GET['view'];
        if ($user_ID && $user_ID === $owner_id && $view === 'my-projects') { ?>
            <form action="<?php echo add_query_arg('action', 'delete'); ?>" method="POST">
                <input type="hidden" name="id" value="<?php the_ID(); ?>">
                <input type="hidden" name="owner" value="<?php echo $user_ID; ?>">
                <?php wp_nonce_field( 'delete_form', 'form_check' ); ?>
                <button class="btn delete-btn" type="submit">Удалить проект</button>
            </form>
          
    <?php } ?>
</div>