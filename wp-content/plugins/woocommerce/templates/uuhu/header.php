<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Подключение шрифтов -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:700&display=swap&subset=cyrillic" rel="stylesheet">

	<link rel="stylesheet/less" href="<?=get_template_directory_uri();?>/static/styles/main.less">
	<script src="<?=get_template_directory_uri();?>/static/js/less.min.js"></script>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="header">
		<div class="wrap">
			<a href="<?=get_site_url();?>" class="header-logo">
				<img src="<?=get_field('logotip','options');?>"
				     alt="">
			</a>
			<div class="header-flex">
				<div class="header-label">Собственное производство <br>
					гренок премиум класса</div>
				<div class="header-item">
					<a href="tel:<?=get_field('nomer_telefona','options');?>" class="header-item-ttl"><img
							src="<?=get_template_directory_uri();?>/static/imgs/call-answer.png"
					                                  alt=""><?=get_field('nomer_telefona','options');?></a>
					<a class="header-item-label  open_popup" data-popup-id="zvonok">
						Закажите <span>обратный звонок</span>
					</a>
				</div>

				<div class="header-item">
					<a href="mailto:<?=get_field('email','options');?>" class="header-item-ttl"><img
							src="<?=get_template_directory_uri();?>/static/imgs/envelope.png"
					                                  alt=""><?=get_field('email','options');?></a>
					<a class="header-item-label">
						Ждем ваших сообщений
					</a>
				</div>

				<div class="header-item">
			<?php
			if (class_exists('WooCommerce' )){
			global $woocommerce; ?>
					<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
					   class="header-item-ttl"><img
							src="<?=get_template_directory_uri();?>/static/imgs/basket.png"
							alt="">Ваша корзина (<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</a>
		  <?php
	  }
	  ?>
					<a href="<?=get_site_url();?>/account/edit-account/" class="header-item-label">
						Войти в <span>личный кабинет</span>
					</a>
				</div>


			</div>
		</div>
		<div class="header-line"></div>
		<div class="wrap">
			<div class="header-flex">
		  <?php wp_nav_menu( [ 'menu' => 'primary',
			  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',

		  ] ); ?>
				<div class="header-search   open_popup" data-popup-id="search">
					<img src="<?=get_template_directory_uri();?>/static/imgs/search.png"
					     alt="">
				</div>
				<div class="header-burger  open_popup" data-popup-id="burger">
					<div class="burger-item"></div>
					<div class="burger-item"></div>
					<div class="burger-item"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal popup_block" id="zvonok">
		<div class="dark close_popup_icon"></div>
		<form class="modal-body">
			<div class="standart-ttl">
				Оставить заявку
			</div>
			<input type="text" placeholder="Ваше имя" name="name">
			<input type="text" placeholder="Ваш номер телефона" name="tel">
			<div class="standart-btn-flex" style="justify-content: center"><button class="standart-btn">Отправить заявку</button></div>

		</form>
	</div>

	<div class="modal popup_block" id="podpis">
		<div class="dark close_popup_icon"></div>
		<form class="modal-body">
			<div class="standart-ttl">
				Подписаться на рассылку
			</div>
			<input type="text" placeholder="Email" name="email">
			<div class="standart-btn-flex" style="justify-content: center"><button class="standart-btn">Подписаться</button></div>

		</form>
	</div>
	<div class="modal popup_block" id="burger" >
		<div class="dark close_popup_icon"></div>
		<div class="burger-menu">
			<div class="header-logo"><img
					src="<?=get_template_directory_uri();?>/static/imgs/header-logo.png"
			                              alt=""></div>

		<?php wp_nav_menu( [ 'menu' => 'primary',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',

		] ); ?>

		</div>
	</div>

	<div class="modal popup_block" id="search">
		<div class="dark close_popup_icon"></div>
		<form class="modal-body">
			<div class="standart-ttl">Введите поисковой запрос</div>
			<input type="text" placeholder="Поисковой запрос" name="search">
			<div class="standart-btn-flex" style="justify-content: center"><button class="standart-btn">Найти</button></div>


		</form>
	</div>
