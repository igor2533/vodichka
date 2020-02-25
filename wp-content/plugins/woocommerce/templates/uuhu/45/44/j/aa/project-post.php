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
        <?php //echo wp_post_likes(); ?>
        <?php

       $sred1 = (get_field('оценка_судьи_за_содержание1')+get_field('оценка_за_подачу1'))/2;  $sred1= str_replace('.',',',$sred1); 
       $sred2 = (get_field('оценка_судьи_за_содержание2')+get_field('оценка_за_подачу2'))/2;  $sred2= str_replace('.',',',$sred2); 
       $sred3 = (get_field('оценка_судьи_за_содержание3')+get_field('оценка_за_подачу3'))/2;  $sred3= str_replace('.',',',$sred3); 
       $sred4 = (get_field('оценка_судьи_за_содержание4')+get_field('оценка_за_подачу4'))/2;  $sred4= str_replace('.',',',$sred4); 
       $sred5 = (get_field('оценка_судьи_за_содержание5')+get_field('оценка_за_подачу5'))/2;  $sred5= str_replace('.',',',$sred5); 
        $obw_sr = ($sred1+$sred2+$sred3+$sred4+$sred5)/5; $obw_sr= str_replace('.',',',$obw_sr);
        $itog =  ($obw_sr +get_field('bim'))/2; $itog= str_replace('.',',',$itog);?>
     <span style="color: #00b000;
    font-weight: bold;
    padding-left: 2px;
    padding-right: 2px;"><?php  echo $itog;  ?></span>

    </div>

    <?php //$postik = get_the_ID(); ?>
<form  action="http://mvplan.ru/category/projects?id=<?php echo get_the_ID(); ?>" method="post">  
<input type="number" value="<?php echo get_field('оценка_судьи_за_содержание1'); ?>" name="pervi<?php echo get_the_ID(); ?>"/>
<input type="submit" name="knopka">
</form>

<?php 
if (isset($_POST['knopka'])) {
 
update_field( 'оценка_судьи_за_содержание1', $_POST['pervi'.get_the_ID()], get_the_ID());
header('location:http://mvplan.ru/category/projects/');
}
?>


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


