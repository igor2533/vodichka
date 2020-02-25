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

<style>
    span.names {    font-size: 22px;
    font-weight: bold;
    padding-right: 0px;}
form.mega>input {


    width: 52px;
    font-size: 26px;
}

form.mega {
    display: none;
    padding-top: 22px;
}
input.knopochka {
background: green;
    color: white;
    border: solid 2px #5897fb;}
</style>
<?php if( current_user_can('referee')) { ?><style>form#sud1{display: block!important;} </style><?php }  ?>
<?php if( current_user_can('referee2')) { ?><style>form#sud2{display: block!important;} </style><?php }  ?>
<?php if( current_user_can('referee3')) { ?><style>form#sud3{display: block!important;} </style><?php }  ?>
<?php if( current_user_can('referee4')) { ?><style>form#sud4{display: block!important;} </style><?php }  ?>
<?php if( current_user_can('referee5')) { ?><style>form#sud5{display: block!important;} </style><?php }  ?>

<form class="mega" id="sud1" method="post" action="">
    <span class="names">1-й </span>
<input type="number"  maxlength="10"  min="0" max="10" value="<?php echo get_field('оценка_судьи_за_содержание1'); ?>" name="mark1-1<?php echo get_the_ID(); ?>" required>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_за_подачу1'); ?>" name="mark1-2<?php echo get_the_ID(); ?>" required>
<input class="knopochka" type="submit" value="OK" name="send1">
</form>

<form class="mega" id="sud2" method="post" action="">
    <span class="names">2-й </span>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_судьи_за_содержание2'); ?>" name="mark2-1<?php echo get_the_ID(); ?>" required>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_за_подачу2'); ?>" name="mark2-2<?php echo get_the_ID(); ?>" required>
<input class="knopochka" type="submit" value="OK" name="send2">
</form>



<form class="mega" id="sud3" method="post" action="">
    <span class="names">3-й </span>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_судьи_за_содержание3'); ?>" name="mark3-1<?php echo get_the_ID(); ?>" required>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_за_подачу3'); ?>" name="mark3-2<?php echo get_the_ID(); ?>" required>
<input class="knopochka" type="submit" value="OK" name="send3">
</form>



<form class="mega" id="sud5" method="post" action="">
    <span class="names">4-й </span>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_судьи_за_содержание4'); ?>" name="mark4-1<?php echo get_the_ID(); ?>" required>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_за_подачу4'); ?>" name="mark4-2<?php echo get_the_ID(); ?>" required>
<input class="knopochka" type="submit" value="OK" name="send4">
</form>


<form class="mega" id="sud4" method="post" action="">
    <span class="names">5-й </span>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_судьи_за_содержание5'); ?>" name="mark5-1<?php echo get_the_ID(); ?>" required>
<input type="number"  min="0" max="10" value="<?php echo get_field('оценка_за_подачу5'); ?>" name="mark5-2<?php echo get_the_ID(); ?>" required>
<input class="knopochka" type="submit" value="OK" name="send5">
</form>

<script type="text/javascript">
    

</script>

<?php if (isset($_POST['mark1-1'.get_the_ID()]) AND isset($_POST['mark1-2'.get_the_ID()]) AND isset($_POST['send1'])) {
update_field('оценка_судьи_за_содержание1',$_POST['mark1-1'.get_the_ID()], get_the_ID());
update_field('оценка_за_подачу1',$_POST['mark1-2'.get_the_ID()], get_the_ID());
?><script>window.location.href = 'http://mvplan.ru/category/projects/';</script><?php } ?>




<?php if (isset($_POST['mark2-1'.get_the_ID()]) AND isset($_POST['mark2-2'.get_the_ID()]) AND isset($_POST['send2'])) {
update_field('оценка_судьи_за_содержание2',$_POST['mark2-1'.get_the_ID()], get_the_ID());
update_field('оценка_за_подачу2',$_POST['mark2-2'.get_the_ID()], get_the_ID());
?><script>window.location.href = 'http://mvplan.ru/category/projects/';</script><?php } ?>

<?php if (isset($_POST['mark3-1'.get_the_ID()]) AND isset($_POST['mark3-2'.get_the_ID()]) AND isset($_POST['send3'])) {
update_field('оценка_судьи_за_содержание3',$_POST['mark3-1'.get_the_ID()], get_the_ID());
update_field('оценка_за_подачу3',$_POST['mark3-2'.get_the_ID()], get_the_ID());
?><script>window.location.href = 'http://mvplan.ru/category/projects/';</script><?php } ?>


<?php if (isset($_POST['mark4-1'.get_the_ID()]) AND isset($_POST['mark4-2'.get_the_ID()]) AND isset($_POST['send4'])) {
update_field('оценка_судьи_за_содержание4',$_POST['mark4-1'.get_the_ID()], get_the_ID());
update_field('оценка_за_подачу4',$_POST['mark4-2'.get_the_ID()], get_the_ID());
?><script>window.location.href = 'http://mvplan.ru/category/projects/';</script><?php } ?>

<?php if (isset($_POST['mark5-1'.get_the_ID()]) AND isset($_POST['mark5-2'.get_the_ID()]) AND isset($_POST['send5'])) {
update_field('оценка_судьи_за_содержание5',$_POST['mark5-1'.get_the_ID()], get_the_ID());
update_field('оценка_за_подачу5',$_POST['mark5-2'.get_the_ID()], get_the_ID());
?><script>window.location.href = 'http://mvplan.ru/category/projects/';</script><?php } ?>










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