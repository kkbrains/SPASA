<?php session_start(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="<?php bloginfo('template_url'); ?>/favicon.ico" rel="shortcut icon">
<meta name="robots" content="noydir,noodp">
<meta name="format-detection" content="telephone=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css" media="print">@page{size:landscape;}</style>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,400i,700,700i|Krub:700" />
<?php wp_head(); ?>
<?php if(get_field('hide_from_search_engines') == 'yes'): ?>
<meta name="robots" content="noindex" />
<?php endif; ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
	<div class="center">
		<a href="<?php echo esc_url(home_url()); ?>" class="logo"><img src="<?php bloginfo('template_url'); ?>/images/logo.svg" alt="<?php echo get_bloginfo('name'); ?>" class="svg" /></a>
		<a href="#menu">Menu</a>
		<div class="menu" id="menu">
			<ul class="navigation">
				<li><a href="<?php echo esc_url(home_url()); ?>" class="home">Home</a></li>
				<li><a href="<?php echo esc_url(home_url()); ?>/awards/" class="awards">Awards</a></li>
				<?php if(get_field('site_status', options) == '2'): ?>
					<li><a href="<?php echo esc_url(home_url()); ?>/entries/" class="entries">Entries</a></li>
				<?php endif; ?>
				<?php if(get_field('site_status', options) == '4'): ?>
					<li><a href="<?php echo esc_url(home_url()); ?>/winners/" class="winners">Winners</a></li>
				<?php endif; ?>
				<li><a href="<?php echo esc_url(home_url()); ?>/faqs/" class="faqs">FAQs</a></li>
				<li><a href="<?php echo esc_url(home_url()); ?>/contact/" class="contact">Contact</a></li>
			</ul>
			<ul class="account<?php if((get_field('site_status', options) != '1') && (!is_user_logged_in())): ?> closed-registration<?php endif; ?>">
				<?php if(is_user_logged_in()): ?>
					<li><a href="<?php echo esc_url(home_url()); ?>/dashboard/">Account</a></li>
					<li><a href="<?php echo wp_logout_url(); ?>">Log Out</a></li>
				<?php else: ?>
					<?php if(get_field('site_status', options) == '1'): ?>
						<li><a href="<?php echo esc_url(home_url()); ?>/register/">Register</a></li>
					<?php endif; ?>
					<li><a href="<?php echo esc_url(home_url()); ?>/login/">Log In</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</header>
