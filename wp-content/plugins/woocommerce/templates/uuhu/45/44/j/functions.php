<?php

// require_once( __DIR__ . '/includes/pagination.php');
require_once( __DIR__ . '/includes/menus.php');
// require_once( __DIR__ . '/includes/breadcrumbs.php');
require_once( __DIR__ . '/includes/theme-setup.php');
require_once( __DIR__ . '/includes/ajax.php');
// require_once( __DIR__ . '/includes/likes.php');
require_once( __DIR__ . '/includes/theme-settings.php');

require_once( __DIR__ . '/includes/email-verification-signup.php');
require_once( __DIR__ . '/includes/new-project-notification.php');

if ( !is_admin() ) wp_deregister_script('jquery');





$result = add_role( 'referee', __(
  
'Referee' ),
  
array(
  
'read' => true, // true allows this capability
'edit_posts' => true, // Allows user to edit their own posts
'edit_pages' => false, // Allows user to edit pages
'edit_others_posts' => true, // Allows user to edit others posts not just their own
'create_posts' => false, // Allows user to create new posts
'manage_categories' => false, // Allows user to manage post categories
'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
'edit_themes' => false, // false denies this capability. User can’t edit your theme
'install_plugins' => false, // User cant add new plugins
'update_plugin' => false, // User can’t update any plugins
'update_core' => false // user cant perform core updates
  
)
  
);









$result = add_role( 'referee2', __(
  
'Referee2' ),
  
array(
  
'read' => true, // true allows this capability
'edit_posts' => true, // Allows user to edit their own posts
'edit_pages' => false, // Allows user to edit pages
'edit_others_posts' => true, // Allows user to edit others posts not just their own
'create_posts' => false, // Allows user to create new posts
'manage_categories' => false, // Allows user to manage post categories
'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
'edit_themes' => false, // false denies this capability. User can’t edit your theme
'install_plugins' => false, // User cant add new plugins
'update_plugin' => false, // User can’t update any plugins
'update_core' => false // user cant perform core updates
)
  
);


function admin_user_ids(){
  //Grab wp DB
  global $wpdb;
  //Get all users in the DB
  $wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users ORDER BY ID");

  //Blank array
  $adminArray = array();
  //Loop through all users
  foreach ( $wp_user_search as $userid ) {
      //Current user ID we are looping through
      $curID = $userid->ID;
      //Grab the user info of current ID
      $curuser = get_userdata($curID);
      //Current user level
      $user_level = $curuser->user_level;
      //Only look for admins
      if($user_level >= 8){//levels 8, 9 and 10 are admin
          //Push user ID into array
          $adminArray[] = $curID;
      }
  }
  return $adminArray;
}

function upload_user_file( $file = array() ) {
  
  require_once( ABSPATH . 'wp-admin/includes/admin.php' );

  $file_return = wp_handle_upload( $file, array('test_form' => false ) );

  if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
    return false;
  } else {

    $filename = $file_return['file'];

    $attachment = array(
      'post_mime_type' => $file_return['type'],
      'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
      'post_content' => '',
      'post_status' => 'inherit',
      'guid' => $file_return['url']
    );

    $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
    wp_update_attachment_metadata( $attachment_id, $attachment_data );

    if( 0 < intval( $attachment_id ) ) {
      return $attachment_id;
    }
  }

  return false;
}

// function cc_mime_types($mimes) {
//   $mimes['pln'] = 'image/pln';
//   $mimes['pla'] = 'image/pla';
//   return $mimes;
// }
// add_filter('upload_mimes', 'cc_mime_types');

function custom_user_profile_fields($profileuser) {
?>
  <table class="form-table">
    <tr>
      <th>
        <label for="phone">Номер телефона</label>
      </th>
      <td>
        <input type="text" name="phone" id="phone" value="<?php echo esc_attr(get_the_author_meta('phone', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th>
        <label for="city">Город</label>
      </th>
      <td>
        <input type="text" name="city" id="city" value="<?php echo esc_attr(get_the_author_meta('city', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th>
        <label for="userpost">Почтовый адрес</label>
      </th>
      <td>
        <input type="text" name="userpost" id="userpost" value="<?php echo esc_attr(get_the_author_meta('userpost', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th>
        <label for="edu">ВУЗ</label>
      </th>
      <td>
        <input type="text" name="edu" id="edu" value="<?php echo esc_attr(get_the_author_meta('edu', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th>
        <label for="eduyear">Год выпуска</label>
      </th>
      <td>
        <input type="text" name="eduyear" id="eduyear" value="<?php echo esc_attr(get_the_author_meta('eduyear', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th>
        <label for="specialization">Специализация</label>
      </th>
      <td>
        <input type="text" name="specialization" id="specialization" value="<?php echo esc_attr(get_the_author_meta('specialization', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>
    <tr>
      <th>
        <label for="projectmanager">Руководитель</label>
      </th>
      <td>
        <input type="text" name="projectmanager" id="projectmanager" value="<?php echo esc_attr(get_the_author_meta('projectmanager', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>


 <tr>
      <th>
        <label for="archicad">Согласие на рассылку ARCHICAD</label>
      </th>
      <td>
        <input type="text" name="archicad" id="archicad" value="<?php echo esc_attr(get_the_author_meta('archicad', $profileuser->ID)); ?>" class="regular-text" />
      </td>
    </tr>







  </table>
<?php
}
add_action('show_user_profile', 'custom_user_profile_fields', 10, 1);
add_action('edit_user_profile', 'custom_user_profile_fields', 10, 1);

function update_extra_profile_fields($user_id) {
  if ( current_user_can('edit_user', $user_id) ) {
    update_user_meta($user_id, 'phone', $_POST['phone']);
    update_user_meta($user_id, 'city', $_POST['city']);
  }
}
add_action('edit_user_profile_update', 'update_extra_profile_fields');

function add_help_menu() {
    add_menu_page(
        'Оценки', // имя в меню
        'Оценки', // title страницы
        'manage_options', // уровень доступа
        'referee', // slug страницы
        'render_refe_page', // функция, отображающая собственно страницу
        'dashicons-editor-help', // иконка
        '10' // позиция в меню
    );
}
add_action('admin_menu', 'add_help_menu');

function render_refe_page() {
   include 'statistika.php';
}


function custom_get_post_author_email($atts){
  $value = '';
  if(get_the_author_meta( 'user_email' )) {
    $value = get_the_author_meta( 'user_email' );
  }
  return $value;
}
add_shortcode(CUSTOM_POST_AUTHOR_EMAIL, custom_get_post_author_email);







