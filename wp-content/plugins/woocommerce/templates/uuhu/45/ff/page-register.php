<?php
/**
 * Template Name: Регистрация
 */
  global $wpdb, $user_ID;

  $register_errors = array();

  function register() {
    global $wpdb, $user_ID;
    $errors = array();
      // Check username is present and not already in use  
      $username = esc_sql($_REQUEST['email']);  
      if (strpos($username, ' ') !== false) {   
      $errors['username'] = "Пробелы в имени пользователя не допустимы";  
      }  
      if(empty($username)) {   
      $errors['username'] = "Пожалуйста, введите имя пользователя";  
      } elseif( username_exists( $username ) ) {  
      $errors['username'] = "Пользователь с таким именем уже существует";  
      }  

      // Check email address is present and valid  
      $email = esc_sql($_REQUEST['email']);  
      if(!is_email( $email )) {   
          $errors['email'] = "Введите валидный email";  
      } elseif( email_exists( $email ) ) {  
          $errors['email'] = "Пользователь с таким email уже существует";  
      }  

      // Check password is valid  
      if(preg_match("/.{6,}/", $_POST['password']) === 0) {  
          $errors['password'] = "Длина пароля должна быть не менее 6 символов";  
      }   

      if(count($errors) === 0) {
          $password = $_POST['password'];
          $hod_koncursa = $_POST['hod_koncursa'];
          $archicad = $_POST['archicad'];
            //   $first_name = $_POST['firstname'];
            //   $phone = $_POST['tel'];
            //   $city = $_POST['find-us'];
            $parts = explode("@", $email);
            $first_name = $parts[0];
          $userdata = array(
          'user_login' => $username,
          'user_pass' => $password,
          'user_email' => $email,
          'first_name' => $first_name,
          'archicad' => $archicad,
          'hod_koncursa' => $hod_koncursa
          );
          
          $user_id = wp_insert_user($userdata);

          //$headers = 'From: My Name <myname@mydomain.com>' . "\r\n";
          // $topic = get_option('user_mail_topic');
          //$content = get_option('user_mail_template');
          
          //wp_mail($email, $topic, $content);
          
        //   if (!is_wp_error( $user_id ) ) {
        //       add_user_meta($user_id, 'phone', $phone, true);
        //       add_user_meta($user_id, 'city', $city, true);
        //   }
          
          return $errors;
      }

      return $errors;
  }

  if ($user_ID) { 
    wp_redirect(home_url());
  } else {
      if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if (wp_verify_nonce($_POST['form_check'], 'register_form')) {
            $register_errors = register();
            if (empty($register_errors)) {
                wp_redirect(home_url() . '/login');
            }
        }
      }
  }
  get_header();
?>
        <div class="page-content">
            <div class="center-wrapper">
                <div class="title main-title main-title--cabinet">
                    <h3>Зарегистрироваться или <span class="colored"><a href="/login">Войти</a></span></h3>
                </div>
                <div class="cabinet__hint-text">Для получения доступа к личному профилю <br> необходимо пройти регистрацию</div>
                <section class="cabinet-form">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" onsubmit="return checkForm(this);" class="form">
                        <!-- <div class="input__wrapper">
                            <input type="text" class="input" name="firstname" placeholder="Имя" required>
                        </div>
                        <div class="input__wrapper">
                            <input type="tel" name="tel" class="input" placeholder="Телефон" required>
                        </div>
                        <div class="select__wrapper input__wrapper">
                            <select name="find-us" id="" class="input select" required>
                                <option class="select__placeholder" value="" disabled selected hidden>Город</option>
                                <?php
                                    // $cities = get_field('города');
                                    // $cities_array = explode("\n", $cities);
                                    // foreach ($cities_array as $city) { ?>
                                      <option value="<?php //echo trim($city); ?>"><?php //echo trim($city); ?></option>
                                <?php //} ?>
                            </select>
                        </div> -->
                        <div class="input__wrapper">
                            <input type="email" name="email" class="input" placeholder="Email" required>
                        </div>
                        <div class="input__wrapper">
                            <input type="password" name="password" class="input" placeholder="Пароль" required>
                        </div>
                        

                    <div class="input__wrapper">
                            <input id="posol" type="checkbox" name="hod_koncursa" class="hod_koncursa" style="-webkit-appearance: checkbox;" required><label>Я согласен получать информацию о ходе конкурса</label>
                        </div>



                        <div class="input__wrapper">
                            <input id="posol" type="checkbox" name="archicad" class="archicad" style="-webkit-appearance: checkbox;" required><label>Я хотел бы получать информацию об ARCHICAD и мероприятиях, проводимых GRAPHISOFT и партнерами</label>
                        </div>




                        <div class="form-error">
                            <p>
                                <?php
                                    if (!empty($register_errors)) {
                                        foreach ($register_errors as $error) {
                                            echo $error . '<br>';
                                        }
                                    }
                                ?>
                            </p>
                        </div>
                        <button type="submit" class="btn btn--bordered">Зарегистрироваться</button>
                        <script type="text/javascript">
                          

                       
/*

jQuery("input[type='checkbox']#posol").change(function(){
    var a = jQuery("input[type='checkbox']#posol");
    if(a.length == a.filter(":checked").length){
         jQuery("button.btn.btn--bordered").attr("disabled", false);
    }

else{



         jQuery("button.btn.btn--bordered").attr("disabled", true);
    }


});

*/




               
       

       











                        </script>
                        <?php wp_nonce_field( 'register_form', 'form_check' ); ?>

                        <div class="form__conditions">
                          <p style="color:red;font-weight: bold;">Чтобы продолжить регистрацию необходимо согласиться на подписку. </p>
                            <p>Нажимая на кнопку «Зарегистрироваться», Вы подтверждаете, что ознакомлены и согласны <br> c <strong><a href="<?php echo get_permalink(258); ?>">Положением о конкурсе и Политикой конфиденциальности</a></strong></p>
                        </div>
                    </form>
                </section>
            </div>
        </div>
<?php get_footer(); ?>
