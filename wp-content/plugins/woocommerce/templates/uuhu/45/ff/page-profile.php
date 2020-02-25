<?php
    /**
     * Template Name: Профиль
     */
    if ( ! function_exists( 'wp_handle_upload' ) ) 
        require_once( ABSPATH . 'wp-admin/includes/file.php' );

    global $wpdb, $user_ID, $current_user;
    $user_errors = array();
    $project_errors = array();






    function create_project () {
        global $user_ID, $current_user;

        $errors = array();

        $project_category = $_POST['category'];
        $project_name = $_POST['projectname'];
        $project_description = $_POST['projectdescription'];
        $project_bimx = $_POST['projectbim'];
        $project_confirm = $_POST['confirm'];
        $project_file = $_POST['project-file'];
        $project_file1 = $_POST['project-file1'];
		$projectmanager = $_POST['projectmanager'];
$vtoroi_author = $_POST['vtoroi_author'];



        $project_images = $_FILES;

        if (!$project_name) {
            $errors['title'] = "Введите название проекта";
            return $errors;
        }
        if (!$project_description) {
            $errors['description'] = "Введите описание проекта";
            return $errors;
        }

        if (!$project_category) {
            $errors['category'] = "Выберите категорию";
            return $errors;
        }

        if (!$project_confirm) {
            $errors['confirm'] = "Поставьте галочку";
            return $errors;
        }

        if (empty($project_images)) {
            $errors['file'] = "Отсутствует файл изображения";
            return $errors;
        }

        if (count($project_images) > 6) {
            $errors['file'] = "Изображений должно быть не больше 6";
            return $errors;
        }

        if (!$project_file) {
            $errors['file'] = "Отсутствует файл проекта";
            return $errors;
        }

        $pictures = array();
        foreach ($project_images as $project_image) {
            $attachment_id = upload_user_file($project_image);

            if (!$attachment_id) {
                $errors['file'] = "Не удалось загрузить картинку";
                return $errors;
            }

            $pictures[] = array(
                'картинка' => $attachment_id,
            );
        }        

        // if (!$project_file_id) {
        //     $errors['file'] = "Не удалось загрузить файл проекта";
        //     return $errors;
        // }

        $project_categories = array(4);

        $project_categories[] = intval($project_category);

        $admins = admin_user_ids();
        
        $new = wp_insert_post(array(
            'post_author' => $admins[0],
            'post_title' => wp_strip_all_tags($project_name),
            'post_category' => $project_categories,
            'post_status' => 'publish',
            'post_content' => $project_description,
        ), 1);
    
        if (!is_wp_error($new)) {
            update_field('автор', $user_ID, $new);
            update_field('bimx_модель', wp_strip_all_tags($project_bimx), $new);
            set_post_thumbnail($new, $pictures[0]['картинка']);
            update_field('картинки', $pictures, $new );
            update_field('файл_проекта', $project_file, $new);
			update_field('projectmanager', $projectmanager, $new);
			update_field('vtoroi_author', $vtoroi_author, $new);
			new_project_notification($new);

    
header("Location:#yspeh");


$emailsa = $current_user->user_email;

$mesage_send1 = "Уважаемый/-ая".$current_user->user_firstname." ".$current_user->user_lastname."\n\n";
$mesage_send2 = "Поздравляем! Ваш проект успешно загружен на сайт Bestbim.pro для участия в конкурсе BIM PROJECT!\n\n";
$mesage_send3 = "В ближайшее время мы проверим загруженные файлы и ссылки и сообщим, если в проекте чего-то не хватает.\n\n";
$mesage_send4 = "Не забудьте поделиться проектом со своими друзьями! (добавить ссылку на поделиться)\n\n";
$mesage_send5 = "С лучшими пожеланиями, команда GRAPHISOFT\n\n";
$mesage_send = $mesage_send1.$mesage_send2.$mesage_send3.$mesage_send4.$mesage_send5;

wp_mail($emailsa, 'BIM PROJECT! Поздравляем! Проект успешно загружен', $mesage_send);



        } else {
            // print_r($new->get_error_messages());
            $errors['post_creation'] = "Не удалось опубликовать проект";
        }

        return $errors;
    }

    function update_user() {
        global $wpdb, $user_ID, $current_user;
        $errors = array();
        // Check email address is present and valid  
        $email = esc_sql($_REQUEST['email']);
        if ($current_user->user_email !== $email) {
            if(!is_email( $email )) {   
                $errors['email'] = "Введите валидный email";  
            } elseif( email_exists( $email ) ) {  
                $errors['email'] = "Такой email уже используется";
            }
        }

        // $password = $_POST['password'];
        $first_name = $_POST['username'];
        $userphone = $_POST['phone'];

        $usercity = $_POST['city'];
        $userpost = $_POST['userpost'];
        $useredu = $_POST['edu'];
        $usereduyear = $_POST['eduyear'];
        $userspecialization = $_POST['specialization'];
        $userprojectmanager = $_POST['projectmanager'];
        $uservtoroi_author = $_POST['vtoroi_author'];
		$usersubscribe = $_POST['subscribe'];
		$new_pass = $_POST['new_pass'];
        $usercountry = $_POST['country'];
         $userlinkprofile = $_POST['linkprofile'];
         $usercountry_edu = $_POST['country_edu'];
        $userdata = array(
            'ID' => $user_ID,
            'user_email' => $email,
            'first_name' => $first_name,
        );

        $user_id = wp_update_user($userdata);

        if (!is_wp_error( $user_id ) ) {
            update_user_meta($user_ID, 'phone', $userphone);
            update_user_meta($user_ID, 'city', $usercity);
             update_user_meta($user_ID, 'country', $usercountry);
            update_user_meta($user_ID, 'userpost', $userpost);
            update_user_meta($user_ID, 'edu', $useredu);
            update_user_meta($user_ID, 'eduyear', $usereduyear);
            update_user_meta($user_ID, 'specialization', $userspecialization);
            update_user_meta($user_ID, 'projectmanager', $userprojectmanager);
            update_user_meta($user_ID, 'vtoroi_author', $uservtoroi_author);
			update_user_meta($user_ID, 'subscribe', $usersubscribe);
                update_user_meta($user_ID, 'linkprofile', $userlinkprofile);
    update_user_meta($user_ID, 'country_edu', $usercountry_edu);











			if($new_pass){
				wp_set_password( $new_pass, $user_ID );
			}
        }
        return $errors;
    }

    if (!$user_ID) { 
        wp_redirect(home_url());
    } else {
      
        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $action = $_REQUEST['action'];
            if ($action === 'update') {
                if (wp_verify_nonce($_POST['form_check'], 'user_update_form')) {
                    $user_errors = update_user();
                }
            }

            if ($action === 'create') {
                if (wp_verify_nonce($_POST['form_check'], 'project_create_form')) {
                    $project_errors = create_project();
                }
            }
        }
    }
  get_header();
?>
        <div class="page-content page-content_cabinside">
        <div class="center-wrapper">
            <div class="cabinet-heading">
                <!-- <div class="user-image">
                    <img src="<?php //echo get_avatar_url($user_ID, array(
                        //'size' => 100,
                    //)); ?>">
                </div> -->
                <div class="title main-title">
                    <h3>Личный профиль</h3>
                    <p class="subtitle-cabinet"><?php echo $current_user->first_name ?></p>
                </div>
            </div>
            <section class="cabinside-info">
                <div class="center-wrapper--min">
                    <span class="cabinside-section__heading">Размещение проекта</span>
                    <?php echo get_field('размещение_проекта'); ?>
                </div>
            </section>
            <section class="cabinet-form">
                <div class="center-wrapper--min">
                    <form action="<?php echo add_query_arg('action', 'create'); ?>" method="POST" class="form" id="cabinet-form" enctype="multipart/form-data">

                        <div class="form-group__section">
                        
                            <div class="form-group__wrapper">
                                
                                <label class="form-group__select">
                                    <select name="category" required>
                                        <option disabled selected hidden>Выберите номинацию</option>
                                        <?php
                                            $args = array(
                                                'parent' => 4,
                                                'hide_empty' => 0,
                                            );
                                            $categories = get_categories( $args );
                                            foreach($categories as $category) { ?>
                                                <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </label>

                                <div class="form-group__text form-group__text_center">
                                    <p><?php echo get_field('номинация'); ?></p>
                                </div>

                            </div>

                            <div class="form-group__wrapper">
                                
                                <label class="form-group__input">
                                    <input type="text" name="projectname" placeholder="Укажите название вашего проекта" required>
                                </label>

                                <div class="form-group__text form-group__text_center">
                                    <p><?php echo get_field('название'); ?></p>
                                </div>

                            </div>
















                            <div class="form-group__wrapper">

                                <label class="form-group__textarea">
                                    <textarea required name="projectdescription" placeholder="Укажите описание вашего проекта" rows="5"></textarea>
									<p id="charNum">Осталось символов: 1600</p>
                                </label>

                                <div class="form-group__text form-group__text_center">
                                    <p><?php echo get_field('описание'); ?></p>
                                </div>
								
								<script>
								jQuery(document).ready(function($) {							
									var maxchars = 1600;
									$('.form-group__textarea textarea').keyup(function () {
										var tlength = $(this).val().length;
										$(this).val($(this).val().substring(0, maxchars));
										var tlength = $(this).val().length;
										remain = maxchars - parseInt(tlength);
										$('#charNum').text('Осталось символов: ' + remain);
									});
								});
								</script>

                            </div>

                        </div>

                        <div class="form-group__section">
                            
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__upload">
                                    <span class="form-group__heading">Загрузите графическую часть</span>
                                    <div class="form-group__upload_wrapper">
                                        <span class="form-group__upload_warning">Размер изображения не соответствует требованиям (1000x1400пикс)</span>
                                        <button class="upload-btn image-file-btn" type="button">Загрузить</button>
                                        <input type="file" name="image-file-1" hidden accept=".png,.jpg">
                                        <div class="form-group__upload_pic">
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/google-drive-image.png" alt="Изображение">
                                            <span>Project.png</span>
                                        </div>
                                    </div>
                                    <div class="form-group__upload_wrapper">
                                        <button id="load-more-img" class="upload-btn" type="button">Загрузить eще</button>
                                    </div>
                                    <div class="form-error hidden">
                                        <p>Выберите файл с типом .png или .jpg</p>
                                    </div>
                                </div>

                                <div class="form-group__text">
                                    <?php echo get_field('графическая_часть'); ?>
                                </div>

                            </div>

                        </div>

                        <div class="form-group__section">
                            
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__upload">
                                    <span class="form-group__heading">Загрузите планшеты проекта в PDF</span>
                                    <!-- <div class="form-group__upload_wrapper">
                                        <button id="project-file-btn" class="upload-btn" type="button">Загрузить</button>
                                        <input type="file" name="project-file" hidden id="project-file" accept=".pln,.pla">
                                        <div class="form-group__upload_pic">
                                            <img src="<?php //echo get_template_directory_uri(); ?>/img/save.png" alt="Изображение">
                                            <span>Project.pln</span>
                                        </div>
                                    </div> -->

                                    <label class="form-group__input">
                                        <input type="text" name="project-file" placeholder="Укажите ссылку на облачное хранилище" required>
                                    </label>
                                </div>




                                <div class="form-group__text">
                                    <p>Файлы принимаются в формате *.pdf для печати. Размер 100х140см, ориентация вертикальная, разрешение не менее 300px.</p>
                                </div>

                            </div>

                        </div>





    <div class="form-group__section">
                            
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__upload">
                                    <span class="form-group__heading">Загрузите исходный файл проекта в PLN/PLA</span>
                                    <!-- <div class="form-group__upload_wrapper">
                                        <button id="project-file-btn" class="upload-btn" type="button">Загрузить</button>
                                        <input type="file" name="project-file" hidden id="project-file" accept=".pln,.pla">
                                        <div class="form-group__upload_pic">
                                            <img src="<?php //echo get_template_directory_uri(); ?>/img/save.png" alt="Изображение">
                                            <span>Project.pln</span>
                                        </div>
                                    </div> -->

                                    <label class="form-group__input">
                                        <input type="text" name="project-file1" placeholder="Укажите ссылку на облачное хранилище" required>
                                    </label>
                                </div>




                                <div class="form-group__text">
                                    <p>Файлы принимаются в форматах *.pln или *.pla. Загрузите исходный файл или предоставьте ссылку на файл, размещенный на файлообменнике.</p>
                                </div>

                            </div>

                        </div>





















                        <div class="form-group__section">
                            
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__wrapper_inner">
                                    <span class="form-group__heading">Загрузите дополнительные материалы</span>

                                    <label class="form-group__input">
                                        <input type="text" name="projectbim" placeholder="Ссылка на BIMx-модель или видеоролик">
                                    </label>
                                </div>

                                <div class="form-group__text">
                                    <p><?php echo get_field('доп_материалы'); ?></p>
                                </div>

                            </div>

                        </div>
						
						<div class="form-group__section">
                            
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__wrapper_inner">
                                    <span class="form-group__heading">Ф.И.О. руководителя /-ей проекта</span>

                                    <label class="form-group__input">
                                        <input type="text" name="projectmanager" placeholder="">
                                    </label>
                                </div>

                                <div class="form-group__text">
                                    <p>Если руководителей проекта было несколько, пожалуйста, укажите их через запятую. Пример: Иванова Т.А., Васильева Н.Н</p>
                                </div>

                            </div>

                        </div>








	<div class="form-group__section">
                            
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__wrapper_inner">
                                    <span class="form-group__heading">Ф.И.О. второго автора проекта</span>

                                    <label class="form-group__input">
                                        <input type="text" name="vtoroi_author" placeholder="">
                                    </label>
                                </div>

                                <div class="form-group__text">
                                    <p>Укажите полные ФИО второго автора, если проект был выполнен в соавторстве</p>
                                </div>

                            </div>

                        </div>











                        <div class="form-group__section">
                            <div class="form-error">
                                <p>
                                    <?php
                                        if (!empty($project_errors)) {
                                            foreach ($project_errors as $error) {
                                                echo $error . '<br>';
                                            }
                                        }
                                    ?>
                                </p>
                            </div>

                            <?php wp_nonce_field( 'project_create_form', 'form_check' ); ?>

                            <button type="submit" class="btn btn_nomar btn--bordered">Разместить проект</button>

                            <label class="yellow-checkbox">
                                <input type="checkbox" name="confirm"><span class="custom-checkbox"></span><span><?php echo get_field('ознакомлен'); ?></span>
                            </label>

                        </div>
                    </form>
                    <form action="<?php echo add_query_arg('action', 'update'); ?>" method="POST" class="form" id="cabinet-form2">
                        <div class="form-group__section">
                            
                            <span class="cabinside-section__heading">Личные данные</span>
                            <div class="form-group__wrapper">
                                
                                <div class="form-group__wrapper_left">

                                    <label class="form-group__input">
                                        <input type="text" name="username" placeholder="Петров Александр Юрьевич" value="<?php echo $current_user->first_name; ?>" required>
                                    </label>

                                    <!-- <label class="form-group__select">
                                        <select name="city">
                                            <?php
                                                // $cities = get_field('города');
                                                // $cities_array = explode("\n", $cities);
                                                // $user_city = get_the_author_meta('city', $current_user->ID);
                                            ?>
                                            <option disabled <?php //echo (!$user_city) ? 'selected' : ''; ?> hidden>Выберите город</option>
                                            <?php
                                                // $cities = get_field('города');
                                                // $cities_array = explode("\n", $cities);
                                                // foreach ($cities_array as $city) { ?>
                                                <option value="<?php //echo esc_attr(trim($city)); ?>" <?php //echo ($user_city == trim($city)) ? 'selected' : ''; ?> ><?php //echo esc_attr(trim($city)); ?></option>
                                            <?php //} ?>
                                        </select>
                                    </label> -->
                                    <?php //$country = get_the_author_meta('country', $current_user->ID); ?>
                                 



















                                    <label class="form-group__select">
                                        



 <select class="" id="dhtmlgoodies_country" name="country" onchange="getCityList(this)" style="max-width: 430px;
    width: 100%;
    padding: 14px 20px;
    padding-right: 60px;
    width: 100%;
    height: 100%;
    background: none;
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.375rem;
    border: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    outline: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    cursor: pointer;" required>
                                        
                                        <?php
                                        if(esc_attr(get_the_author_meta('country', $current_user->ID)) == null){
                                        
                                        ?>
                                       <option selected>Выберите страну</option>
                                        
                                        <?php  } else { ?>
                                                <option value="<?php echo esc_attr(get_the_author_meta('country', $current_user->ID)); ?>"><?php echo esc_attr(get_the_author_meta('country', $current_user->ID)); ?></option>
                                        <?php } ?>
                                        
                                        <option value="Россия">Россия</option>
                                <option value="Украина">Украина</option>
                                <option value="Беларусь">Беларусь</option>
                                <option value="Таджикистан">Таджикистан</option>
                                <option value="Армения">Армения</option>
                                <option value="Туркменистан">Туркменистан</option>
                                <option value="Казахстан">Казахстан</option>
                                <option value="Узбекистан">Узбекистан</option>
                                <option value="Грузия">Грузия</option>
                                <option value="Кыргызстан">Кыргызстан</option>
                                <option value="Молдова">Молдова</option>
                                        
                                    </select>







                                    </label>


<script type="text/javascript">
    



 jQuery(document).ready(function() { jQuery("#dhtmlgoodies_city").select2(); 



});








  jQuery(document).ready(function() { jQuery("#dhtmlgoodies_vuz").select2(); 



});





</script>











                                   <label class="form-group__select">
                                        

<select id="dhtmlgoodies_city" name="city">
    
    <?php
                                        if(esc_attr(get_the_author_meta('city', $current_user->ID)) == null){
                                        
                                        ?>
                                      
                                        
                                        <?php  } else { ?>
                                                <option value="<?php echo esc_attr(get_the_author_meta('city', $current_user->ID)); ?>"><?php echo esc_attr(get_the_author_meta('city', $current_user->ID)); ?></option>
                                        <?php } ?>
</select>



  </label>


<input type="text" id="city_baku" value="<?php echo esc_attr(get_the_author_meta('city', $current_user->ID)); ?>" hidden name="city">

<script type="text/javascript">
    

    $( "#dhtmlgoodies_city" ).change(function() {


   $("#city_baku").val($("#dhtmlgoodies_city option:selected").text()) ;
});
</script>







 <label class="form-group__input">
                                        <input title="Мы бы хотели больше рассказать о Ваших успехах сообществу: в случае победы, ссылка на Ваш профиль будет опубликована в отчетных материалах о конкурсе и в группах в социальных сетях." type="text" name="linkprofile" placeholder="Ссылка на Ваш профиль на BEHANCE" value="<?php echo esc_attr(get_the_author_meta('linkprofile', $current_user->ID)); ?>">
                                    </label>





                                    <label class="form-group__input">
                                        <input type="tel" name="phone" placeholder="+7 (950) 587-99-98" value="<?php echo esc_attr(get_the_author_meta('phone', $current_user->ID)); ?>" required>
                                    </label>

                                    <label class="form-group__input">
                                        <input type="email" name="email" placeholder="hello@world.com" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                                    </label>

                                    <label class="form-group__input">
                                        <input type="text" name="userpost" placeholder="Почтовый адрес" value="<?php echo esc_attr(get_the_author_meta('userpost', $current_user->ID)); ?>" required>
                                    </label>

									<label class="yellow-checkbox">
										<input type="checkbox" name="subscribe" value="1" <?php checked( get_the_author_meta('subscribe', $current_user->ID), 1 ); ?> required><span class="custom-checkbox"></span><span>Получать рассылку</span>
									</label>                         
                                    
								
								</div>

                                <div class="form-group__wrapper_right">

                                    <!-- <label class="form-group__select">
                                        <select name="edu">
                                            <?php
                                                // $edu = get_field('вузы');
                                                // $edu_array = explode("\n", $edu);
                                                // $user_edu = get_the_author_meta('edu', $current_user->ID);
                                            ?>
                                            <option disabled <?php //echo (!$user_edu) ? 'selected' : ''; ?> hidden>Выберите ВУЗ</option>
                                            <?php
                                                //foreach ($edu_array as $ed) { ?>
                                                <option value="<?php //echo esc_attr(trim($ed)); ?>" <?php //echo ($user_edu == trim($ed)) ? 'selected' : ''; ?> ><?php //echo esc_attr(trim($ed)); ?></option>
                                            <?php //} ?>
                                        </select>
                                    </label> -->
                                  










     <label class="form-group__select">

 <select class="" id="dhtmlgoodies_country_vuz" name="country_edu" onchange="getVuzList(this)" style="max-width: 430px;
    width: 100%;
    padding: 14px 20px;
    padding-right: 60px;
    width: 100%;
    height: 100%;
    background: none;
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.375rem;
    border: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    outline: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    cursor: pointer;" required>
                                        
                                        <?php
                                        if(esc_attr(get_the_author_meta('country_edu', $current_user->ID)) == null){
                                        
                                        ?>
                                    <option selected>Выберите страну</option>
                                        
                                        <?php  } else { ?>
                                                <option value="<?php echo esc_attr(get_the_author_meta('country_edu', $current_user->ID)); ?>"><?php echo esc_attr(get_the_author_meta('country_edu', $current_user->ID)); ?></option>
                                        <?php } ?>
                                        
                                        <option value="Россия">Россия</option>
                                <option value="Украина">Украина</option>
                                <option value="Беларусь">Беларусь</option>
                                <option value="Таджикистан">Таджикистан</option>
                                <option value="Армения">Армения</option>
                                <option value="Туркменистан">Туркменистан</option>
                                <option value="Казахстан">Казахстан</option>
                                <option value="Азербайджан">Азербайджан</option>
                                <option value="Узбекистан">Узбекистан</option>
                                <option value="Грузия">Грузия</option>
                                <option value="Кыргызстан">Кыргызстан</option>
                                <option value="Молдова">Молдова</option>
                                        
                                    </select>

</label>





















                                   <label class="form-group__select">
                                        

<select id="dhtmlgoodies_vuz" name="edu">
    
    <?php
                                        if(esc_attr(get_the_author_meta('edu', $current_user->ID)) == null){
                                        
                                        ?>
                                      
                                        
                                        <?php  } else { ?>
                                                <option value="<?php echo esc_attr(get_the_author_meta('edu', $current_user->ID)); ?>" selected><?php echo esc_attr(get_the_author_meta('edu', $current_user->ID)); ?></option>
                                        <?php } ?>
</select>



  </label>








<input type="text" id="baku" value="<?php echo esc_attr(get_the_author_meta('edu', $current_user->ID)); ?>" hidden name="edu">
                                   


<script type="text/javascript">
    

    $( "#dhtmlgoodies_vuz" ).change(function() {


   $("#baku").val($("#dhtmlgoodies_vuz option:selected").text()) ;
});
</script>








                                    <label class="form-group__input">
                                        <!-- <select name="eduyear"> -->
                                            <?php
                                                // $years = get_field('год_выпуска');
                                                // $years_array = explode("\n", $years);
                                                // $user_eduyear = get_the_author_meta('eduyear', $current_user->ID);
                                            ?>
                                            <!-- <option disabled <?php //echo (!$user_eduyear) ? 'selected' : ''; ?> hidden>Год выпуска</option> -->
                                            <!-- <?php
                                                // $years = get_field('год_выпуска');
                                                // $years_array = explode("\n", $years);
                                                // foreach ($years_array as $year) { ?>
                                                <option value="<?php //echo esc_attr(trim($year)); ?>" <?php //echo ($user_eduyear == trim($year)) ? 'selected' : ''; ?> ><?php //echo esc_attr(trim($year)); ?></option>
                                            <?php //} ?>
                                        </select> -->

                                        <input type="text" name="eduyear" placeholder="Год выпуска" value="<?php echo esc_attr(get_the_author_meta('eduyear', $current_user->ID)); ?>" required>
                                    </label>

                                    <label class="form-group__select">
                                      
                                   




 <select name="specialization" style="max-width: 430px;
    width: 100%;
    padding: 14px 20px;
    padding-right: 60px;
    width: 100%;
    height: 100%;
    background: none;
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.375rem;
    border: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    outline: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    cursor: pointer;" required>
                                        
                                        <?php
                                        if(esc_attr(get_the_author_meta('specialization', $current_user->ID)) == null){
										
										?>
										<option disabled selected hidden>Выберите специализацию</option>
										
										<?php  } else { ?>
                                                <option value="<?php echo esc_attr(get_the_author_meta('specialization', $current_user->ID)); ?>"><?php echo esc_attr(get_the_author_meta('specialization', $current_user->ID)); ?></option>
                                        <?php } ?>
										
										<option value="Архитектура">Архитектура</option>
										<option value="Дизайн архитектурной среды">Дизайн архитектурной среды</option>
										<option value="Проектирование зданий и сооружений">Проектирование зданий и сооружений</option>
										<option value="Реконструкция и реставрация">Реконструкция и реставрация</option>
										<option value="Урбанизм">Урбанизм</option>
										
                                    </select>















								   </label>

                                    <label class="form-group__input">
                                        <input type="text" name="projectmanager" placeholder="Ф.И.О. руководителя /-ей проекта" value="<?php echo esc_attr(get_the_author_meta('projectmanager', $current_user->ID)); ?>" required>
                                    </label>
									
									<label class="form-group__input">
                                        <input type="text" name="new_pass" placeholder="Новый пароль" value="">
                                    </label>
									
									<a title="Вы можете самостоятельно удалить аккаунт. После удаления аккаунта все загруженные проекты останутся опубликованными - будет удален только Ваш профиль”
" style="color:red;" href="<?php echo home_url() ?>/delete-profile/">Удалить аккаунт</a>

                                </div>

                            </div>

                        </div>

                        <div class="form-group__section">
							<span class="cabinside-section__heading">Сертификат участника</span>
							
							<?php

								$user_certificate = get_field('user_certificate', 'user_'.$user_ID);

								if($user_certificate){
									echo '<p>Поздравляем с завершением конкурса! Загрузите Ваш сертификат участника прямо сейчас. <a style="color:blue;font-weight:bold;" target="_blank" href="'.wp_get_attachment_image_url($user_certificate, 'full').'">Открыть сертификат</a></p>';
								}else{
									echo '<p>После завершения конкурса, здесь Вы сможете найти свой сертификат участника</p>';
								}

							?>
						</div>
						
						<div class="form-group__section">
                            <div class="form-error">
                                <p>
                                    <?php
                                        if (!empty($user_errors)) {
                                            foreach ($user_errors as $error) {
                                                echo $error . '<br>';
                                            }
                                        }
                                    ?>
                                </p>
                            </div>

                            <?php wp_nonce_field( 'user_update_form', 'form_check' ); ?>

                            <button type="submit" class="btn btn_nomar btn--bordered">Обновить данные</button>

                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>
<?php get_footer(); ?>
