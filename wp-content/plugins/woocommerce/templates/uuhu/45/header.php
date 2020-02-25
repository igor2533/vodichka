<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="yandex-verification" content="eb99a762e60d6388" />
<meta name="google-site-verification" content="LAAoMr4lwN7g73FzHPOPz9LI8gfN9hnqoD6USb4uKfA" />
<meta property="og:url" content="https://afisha.mail.ru/cinema/news/48375/"/>
<meta property="og:image"content="https://pic.afisha.mail.ru/share/article
/48375/?20170413114841.1"/>
<meta property="og:image:width" content="1200"/>
<meta property="og:image:height" content="630"/>


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php typical_title(); // выводи тайтл, функция лежит в function.php ?></title>
<style>.modal-project__desc {
    overflow-y: scroll;
    height: 600px;
}</style>
<?php wp_deregister_script('jquery'); ?>
  <?php wp_head(); ?>
  <script type="text/javascript" src="http://mvplan.ru/wp-content/themes/bimproject/js/ajax.js"></script>

<script type="text/javascript" src="http://mvplan.ru/wp-content/themes/bimproject/js/chained.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</head>







<body <?php body_class(); ?>>
    <header class="header <?php echo (is_front_page()) ? 'header--index' : ''; ?>">
        <div class="center-wrapper">
            <div class="header__wrapper">
                <div class="logo__wrapper <?php echo (is_front_page()) ? 'logo__wrapper--index' : ''; ?>">
                    <a href="/">
                        <img src="http://bestbim.pro/wp-content/uploads/2019/05/logo.png" alt="" class="logo">
                    </a>
                </div>
                <div class="burger">
                    <div class="burger__line"></div>
                    <div class="burger__line"></div>
                    <div class="burger__line"></div>
                </div>
                <div class="mobile-nav-wrapper">
                   <div class="close"><span>x</span></div>
                    <nav class="nav">
                        <div class="nav__wrapper">
                            <?php wp_nav_menu(array(
                            'container' => '',
                            'theme_location' => 'menu',
                            'menu_class' => 'nav__list',
                            'depth' => 0,
                            'walker' => new MainMenuWalker(),
                            )); ?>
                        </div>
                    </nav>
                    <?php
                    global $user_ID;
                    if ($user_ID) {
                        $user = wp_get_current_user(); ?>
                        <div class="sign-in sign-in__btn--logined">
                            <a class="btn sign-in__btn sign-in__btn--logined" href="/profile"><span class="sign-in__btn-text"><?php echo explode(' ',trim($user->user_firstname))[0]; ?></span></a>
                            <a href="<?php echo wp_logout_url( home_url() ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/sign-in.png" alt="" class="sign-in__img"></a>
                        </div>
                    <?php } else { ?>
                        <div class="sign-in">
                            <a class="btn sign-in__btn" href="/login"><img src="<?php echo get_template_directory_uri(); ?>/img/sign-in.png" alt="" class="sign-in__img">Войти</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (is_front_page()) { ?>
            <div class="header-title__wrapper">
                <?php
                    $banner = get_field('баннер');
                ?>
                <div class="header-title">
                    <div class="title">
                        <h1><?php echo $banner['заголовок']; ?></h1>
                    </div>
                    <div class="header-title__text">
                        <?php echo $banner['текст']; ?>
                        
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </header>
    <main class="content">