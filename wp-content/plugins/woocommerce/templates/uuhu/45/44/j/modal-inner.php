<?php
$owner = get_field('автор');
// $ava = get_avatar_url($owner['ID'], array(
//     'size' => 100,
// ));


$edu = get_user_meta($owner['ID'], 'edu', true);
$eduyear = get_user_meta($owner['ID'], 'eduyear', true);
$specialization = get_user_meta($owner['ID'], 'specialization', true);
$projectmanager = get_the_author_meta('projectmanager', $owner['ID']);

$new_projectmanager = get_field('projectmanager');

if($new_projectmanager) $projectmanager = $new_projectmanager;

//get_user_meta($owner['ID'], 'projectmanager', true);

$cat = '';
$post_categories = wp_get_post_categories(get_the_ID());
$pictures = get_field('картинки');
$attach = get_attached_media('image', $post );


foreach ($post_categories as $post_category) {
    if ($post_category !== 4 && $post_category !== 8) {
        $cat = get_category($post_category)->name;
    }
}
?>
<div class="modal-project__block">
    <div class="modal-project__slider">
        <div class="flexslider">
            <ul class="slides">
                <?php /*foreach ($pictures as $picture) { ?>
                    <li>
                        <img src="<?php echo $picture['картинка']; ?>" alt="">
                    </li>
                <?php } */?>
				
				<?php foreach($attach as $picture) { ?>
                    <li>
                       <?php echo wp_get_attachment_image($picture->ID, 'large'); ?>
                    </li>					
				<? } ?>
				
            </ul>
			
        </div>
        <div class="modal-project__desc">
            <?php the_content(); ?>
        </div>
    </div>
    <div class="modal-project__text-block">
        <div class="project-gallery__person-name">
            <p></p>
        </div>
        <div class="project-gallery__person-name">
            <p><?php echo $owner['user_firstname']; ?></p>
        </div>
        <div class="project-gallery__project-name">
            <p><?php the_title(); ?></p>
            <div class="modal-project__inline">
                <?php //echo get_simple_likes_button( get_the_ID() ); ?>
                <?php echo wp_post_likes(); ?>
                <div class="projects-social-block">
                    <a href="http://vk.com/share.php?url=<?php the_permalink(); ?>" class="single-social single-social_vk"></a>
                    <a href="http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php the_permalink(); ?>&st.comments=<?php the_permalink(); ?>" class="single-social single-social_odn"></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="single-social single-social_fb"></a>
                </div>
            </div>
        </div>
        <div class="modal-project__info">
            <div class="modal-project__info-block">
                <p class="modal-project__info-text"><strong>Номинация: </strong><?php echo $cat; ?></p>
            </div>
            <div class="modal-project__info-block">
                <p class="modal-project__info-text"><strong>Место учебы: </strong><?php echo $edu; ?></p>
            </div>
            <div class="modal-project__info-block">
                <p class="modal-project__info-text"><strong>Специальность: </strong><?php echo $specialization; ?></p>
            </div>
            <div class="modal-project__info-block">
                <p class="modal-project__info-text"><strong>Год выпуска: </strong><?php echo $eduyear; ?></p>
            </div>
            <div class="modal-project__info-block">
                <p class="modal-project__info-text"><strong>Руководитель: </strong><?php echo ($projectmanager) ? $projectmanager : 'Без руководителя'; ?></p>
                <style>
                    
                    .acf-image-uploader.has-value {
    display: none;
}
.acf-field.acf-field-user {
    display: none;
}

.acf-fields.acf-form-fields.-top>div {
    display: none; 
}


div#sud1 {
    display: block!important;
}


div#sud2 {
    display: block!important;
}
                </style>
         <?php acf_form(); ?>
            </div>
        </div>
    </div>
</div>