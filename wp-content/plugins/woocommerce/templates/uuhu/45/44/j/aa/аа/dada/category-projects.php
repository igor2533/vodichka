<?php

//Скрываем части страницы для аякса
$hide_template = false;
if( $_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'get_projects_posts') {
	$hide_template = true;

}

if(!$hide_template)
	get_header();

global $user_ID;
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $action = $_REQUEST['action'];
	

    if($_REQUEST['get_vars']) { 
		foreach($_REQUEST['get_vars'] as $key=>$val) { 
			$_GET[$key] = $val;
		}
	}
    if ($action === 'delete') {
        if (wp_verify_nonce($_POST['form_check'], 'delete_form')) {
            $id = $_POST['id'];
            $owner_id = $_POST['owner'];
            
            if ($id && $owner_id) {
                $true_owner_id = get_field('автор', $id)['ID'];
                if ($owner_id == $true_owner_id) {
                    wp_delete_post($id, false);
                }
            }
        }
    }
}
?>

<?if(!$hide_template) { ?>
        <div class="page-content">
            <div class="center-wrapper">
                <div class="title main-title main-title--projects">
                    <?php
                    $view = $_GET['view'];

                    if ($view === 'my-projects') {
                    ?>
                        <h3><span class="colored"><a href="<?php echo home_url( $wp->request ); ?>">Проекты</a></span> / Мои проекты</h3>
                    <?php } else { ?>
                        <h3>Проекты <?php echo ($user_ID) ? ' / <span class="colored"><a href="' . add_query_arg('view', 'my-projects', home_url( $wp->request )) . '">Мои проекты</a></span>' : '' ?></h3>
                    <?php } ?>
                </div>
                <section class="projects-filters">
                    <div class="filter-buttons">
                        <div class="filter-buttons__mobile">
                            <div class="filter-buttons__icon">
                                <svg viewBox="0 0 32 40" x="0px" y="0px">
                                <g><g fill="#000000"><path d="M27,6.12601749 C28.7252272,6.57006028 30,8.13616057 30,10 C30,11.8638394 28.7252272,13.4299397 27,13.8739825 L27,27.9967004 C27,28.5508075 26.5561352,29 26,29 C25.4477153,29 25,28.5487213 25,27.9967004 L25,13.8739825 C23.2747728,13.4299397 22,11.8638394 22,10 C22,8.13616057 23.2747728,6.57006028 25,6.12601749 L25,4.00329963 C25,3.44919255 25.4438648,3 26,3 C26.5522847,3 27,3.45127869 27,4.00329963 L27,6.12601749 Z M15,25.8739825 C13.2747728,25.4299397 12,23.8638394 12,22 C12,20.1361606 13.2747728,18.5700603 15,18.1260175 L15,4.00329963 C15,3.44919255 15.4438648,3 16,3 C16.5522847,3 17,3.45127869 17,4.00329963 L17,18.1260175 C18.7252272,18.5700603 20,20.1361606 20,22 C20,23.8638394 18.7252272,25.4299397 17,25.8739825 L17,27.9967004 C17,28.5508075 16.5561352,29 16,29 C15.4477153,29 15,28.5487213 15,27.9967004 L15,25.8739825 Z M7,6.12601749 C8.72522721,6.57006028 10,8.13616057 10,10 C10,11.8638394 8.72522721,13.4299397 7,13.8739825 L7,27.9967004 C7,28.5508075 6.55613518,29 6,29 C5.44771525,29 5,28.5487213 5,27.9967004 L5,13.8739825 C3.27477279,13.4299397 2,11.8638394 2,10 C2,8.13616057 3.27477279,6.57006028 5,6.12601749 L5,4.00329963 C5,3.44919255 5.44386482,3 6,3 C6.55228475,3 7,3.45127869 7,4.00329963 L7,6.12601749 Z M6,12 C7.1045695,12 8,11.1045695 8,10 C8,8.8954305 7.1045695,8 6,8 C4.8954305,8 4,8.8954305 4,10 C4,11.1045695 4.8954305,12 6,12 Z M16,20 C14.8954305,20 14,20.8954305 14,22 C14,23.1045695 14.8954305,24 16,24 C17.1045695,24 18,23.1045695 18,22 C18,20.8954305 17.1045695,20 16,20 Z M26,12 C27.1045695,12 28,11.1045695 28,10 C28,8.8954305 27.1045695,8 26,8 C24.8954305,8 24,8.8954305 24,10 C24,11.1045695 24.8954305,12 26,12 Z" transform="translate(16.000000, 16.000000) rotate(-270.000000) translate(-16.000000, -16.000000) "/></g></g>
                                </svg>
                            </div>
                            <div class="filter-buttons__text">Фильтр</div>
                        </div>
                        <!-- <div class="filter-buttons__archive">
                            <div class="filter-buttons__icon"><svg x="0px" y="0px" viewBox="0 0 512 512"> <g><path d="M312.461,332.734H199.539c-8.511,0-15.434,6.923-15.434,15.434v34.634c0,8.511,6.923,15.435,15.434,15.435h112.923c8.511,0,15.435-6.923,15.435-15.435v-34.634C327.895,339.658,320.972,332.734,312.461,332.734z M308.051,378.393H203.948v-25.814h104.103V378.393z"/></g>
                       <g><path d="M506.976,246.958l0.159-0.08L432.73,99.774c-6.015-11.89-18.025-19.275-31.346-19.275h-14.141V66.824c0-5.48-4.442-9.922-9.922-9.922H134.68c-5.48,0-9.922,4.442-9.922,9.922v13.675h-14.141c-13.321,0-25.331,7.385-31.346,19.275L4.865,246.878l0.159,0.08C1.837,252.207,0,258.363,0,264.939v155.409c0,19.162,15.59,34.751,34.752,34.751h442.497c19.162,0,34.751-15.59,34.751-34.751V264.939C512,258.363,510.163,252.207,506.976,246.958z M387.242,102.548h14.141c4.959,0,9.43,2.751,11.671,7.179l60.93,120.462h-41.431v-37.066c0-5.48-4.442-9.922-9.922-9.922h-12.275v-53.227c0-5.48-4.442-9.922-9.922-9.922h-13.192V102.548z M412.71,203.044v27.144h-52.359c-8.984,0-17.174,5.293-20.865,13.482l-14.296,31.71c-0.136,0.299-0.435,0.493-0.764,0.493H187.575c-0.329,0-0.628-0.194-0.764-0.494l-14.295-31.708c-3.692-8.19-11.882-13.483-20.866-13.483H99.291v-27.144H412.71z M144.602,76.746h222.796v43.305H144.602V76.746zM390.512,139.895v43.305H121.488v-43.305H390.512z M98.946,109.727c2.24-4.429,6.712-7.179,11.671-7.179h14.141v17.503h-13.192c-5.48,0-9.922,4.442-9.922,9.922v53.227H89.369c-5.48,0-9.922,4.442-9.922,9.922v37.066H38.016L98.946,109.727z M477.249,433.049H34.752c-7.004,0-12.703-5.699-12.703-12.701V264.939c0-7.003,5.698-12.701,12.703-12.701H151.65c0.328,0,0.629,0.194,0.765,0.495l14.295,31.708c3.692,8.19,11.881,13.481,20.865,13.481h136.85c8.984,0,17.174-5.292,20.865-13.48l14.296-31.709v-0.001c0.136-0.3,0.435-0.494,0.764-0.494h116.898c7.004,0,12.701,5.699,12.701,12.701v155.409h0.001C489.951,427.352,484.253,433.049,477.249,433.049z"/></g>
                       </svg>
                            </div>
                            <a class="filter-buttons__text" href="/category/archive"><span>Архив проектов</span></a>
                        </div> -->
                    </div>
                    <div class="filter-board">
                        <div class="filter__block">
                            <div class="filter filter--select">
                                <div class="filter__name"><span>Номинация</span></div>
                                <div class="filter__items">
                                    <?php
                                        global $wp;
                                    ?>
                                    <a class="filter__item" href="<?php echo home_url( $wp->request ); ?>"><span>Все</span></a>
                                    <?php
                                        $args = array(
                                            'parent' => 4,
                                            'hide_empty' => 0,
                                        );
                                        $categories = get_categories( $args );
                                        foreach($categories as $category) { ?>
                                            <a class="filter__item" href="<?php echo add_query_arg('category', $category->term_id); ?>"><span><?php echo $category->name; ?></span></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="filter filter--select">
                                <div class="filter__name"><span>Год</span></div>
                                <div class="filter__items">
                                    <?php
                                        $args = array(
                                            'type'            => 'yearly',
                                            'limit'           => 20,
                                            'format'          => 'postbypost',
                                            'show_post_count' => false,
                                            'echo'            => 0,
                                            'post_type'       => 'post',
                                        );
                                        $out = wp_get_archives($args);
                                        $out = str_replace('</a>', '\n', $out);
                                        $arr = explode('\n', $out);
                                        ?>
										 <a class="filter__item" href="<?php echo add_query_arg('y', 'all'); ?>"><span>Все</span></a>
										<?php
										foreach($arr as $year) {
                                            $year = substr($year, -4);
                                            if (!empty($year)) {
                                        ?>
                                            <a class="filter__item" href="<?php echo add_query_arg('y', $year); ?>"><span><?php echo $year; ?></span></a>
										<?php   }
                                        } ?>
                                </div>
                            </div>
                        </div>
                        
						<?php
						$sort = $_GET['sort'];
						$order = $_GET['order'];
						$order = ($order == 'desc') ?  'desc' : 'asc';
						$order_change = ($order == 'desc') ?  'asc' : 'desc';
						$class_sort_date = ($sort =='date') ? 'order-'.$order : '';
						$class_sort_likes = ($sort =='likes') ? 'order-'.$order : '';
						?>
						
						<div class="filter__block">
                            <p class="filter__text">Сортировать по:</p>
                            <a class="filter filter--sort <?php echo  $class_sort_date;?>" href="<?php echo add_query_arg(array('sort'=>'date', 'order'=>$order_change)); ?>">
                                <span>Дате загрузки</span>
                            </a>
                            <a class="filter filter--sort <?php echo  $class_sort_likes;?>" href="<?php echo add_query_arg(array('sort'=>'likes', 'order'=>$order_change)); ?>">
                                <span>По оценкам</span>
                            </a>
                        </div>
                    </div>

                </section>

            </div>
            <div class="center-wrapper center-wrapper--min">








                <section class="project-gallery">
<? } ?>
                    <?php
                        global $user_ID;
                        $args = array();

                        $category = $_GET['category'];
                        $sort = $_GET['sort'];
						$order = $_GET['order'];
                        if($order ==null){$order = 'desc';}
						$order = ($order == 'desc') ?  'desc' : 'asc';
                        $year = $_GET['y'];
                        $year = $_GET['y'];
                        $view = $_GET['view'];

                        $cats = array(4);
                        if ($category) {
                            $cats[] = intval($category);
                        }

                        $orderby = $sort ?  $sort : 'date';

                        if ($sort === 'likes') {
                             if( current_user_can('referee')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee2')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee3')) {   $args['tag'] = 'принят'; } 
if( current_user_can('referee4')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee5')) {  $args['tag'] = 'принят'; } 

                            $orderby = 'meta_value_num';
                            $args['meta_key'] = '_post_like_count';
                        }

                        if ($view === 'my-projects') {
                          if( current_user_can('referee')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee2')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee3')) {   $args['tag'] = 'принят'; } 
if( current_user_can('referee4')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee5')) {  $args['tag'] = 'принят'; } 

                            $args['meta_query'] = array(
                                array(
                                    'key' => 'автор',
                                    'value'  => $user_ID,
                                )
                            );
                        }

                        if ($year) {
                            if($year != 'all'){


 if( current_user_can('referee')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee2')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee3')) {   $args['tag'] = 'принят'; } 
if( current_user_can('referee4')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee5')) {  $args['tag'] = 'принят'; } 



                               
								$args['date_query'] = array(
									array(
										'year'  => $year
									),
								);
							}				
                        }else{
							$args['date_query'] = array(
                                array(
                                    'year'  => date("Y")
                                ),
                            );
						}

                        $args['category__and'] = $cats;
                      if( current_user_can('referee')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee2')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee3')) {   $args['tag'] = 'принят'; } 
if( current_user_can('referee4')) {  $args['tag'] = 'принят'; } 
if( current_user_can('referee5')) {  $args['tag'] = 'принят'; } 

                        $args['category__not_in'] = 8;
                        $args['posts_per_page'] = 16;
                        $args['orderby'] = $orderby;
                        //$args['order'] = 'DESC';
						$args['order'] = strtoupper($order);					
						//print_r($args);
						$pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
						
						$args['paged'] = $pageNum;
                      

                        $wp_query = new WP_Query($args);

                        if ( $wp_query->have_posts() ){
							while ( $wp_query->have_posts() ) : $wp_query->the_post();
								get_template_part('inc/project-post');
							endwhile;
						}else{
							echo '<p style="margin: 0 auto;">Проектов за '.date("Y").' год еще нет, чтобы посмотреть проекты за прошлые годы – выберите нужный год в фильтре.</p>';
						}
						 ?>
						
<?if(!$hide_template && $wp_query->have_posts()) { ?>						
                </section>
                <div class="project-gallery__btn">
                    <a id="load-more-projects" href="#" class="btn btn--bordered btn--col-2">Показать еще</a>
                </div>

            </div>

            <?php get_template_part('inc/modal'); ?>
        </div>
<? } ?>
<?php 
if(!$hide_template)
	get_footer(); 
?>