<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
    <meta name="author" content="L'Elite de Jose Sayago" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="icon" type="image/x-icon" href="http://staticelite.info/sanando/images/favicon.ico" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <script type="text/javascript">document.createElement( "picture" );</script>
    <?php wp_head(); ?>    
</head>
<body <?php body_class(); ?> id="sanando">
	<div class="wrapper">

		<header role="banner">
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo_45.png" alt="<?php bloginfo('name'); ?>" /></a>
					</div>
					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<?php wp_bootstrap_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</div>
				</div> <!-- end .container -->
			</div> <!-- end .navbar -->
		</header> <!-- end header -->

		<?php if( is_home() || is_front_page() ) { ?>

		<?php if( !empty( get_theme_mod( 'homepage_alert' ) ) ) { ?>
		<hr />
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p class="text-center"><?php echo get_theme_mod( 'homepage_alert' ); ?></p>
		</div>
		<?php } ?>

		<div class="jumbotron">
			<div class="container">
				<span data-picture data-alt="Necesitamos Sede" class="jumbopicture">
					<span data-src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Boceto_2_960.jpg"></span>
					<span data-src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Boceto_2_260.jpg" data-media="(min-width: 300px)"></span>
					<span data-src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Boceto_2_360.jpg" data-media="(min-width: 400px)"></span>
					<span data-src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Boceto_2_760.jpg" data-media="(min-width: 800px)"></span>
					<span data-src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Boceto_2_960.jpg" data-media="(min-width: 1000px)"></span>
					<!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
					<noscript><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Boceto_2_960.jpg" alt="Necesitamos Sede"></noscript>
				</span>
				<p class="quote">
					<em><?php echo get_theme_mod('jumbotron_hpquote'); ?></em>
				</p>
				<a class="btn btn-success btn-lg call-to-action" href="<?php echo get_permalink( get_theme_mod('jumbotron_hpcalltoaction_link') ); ?>"><?php echo get_theme_mod('jumbotron_hpcalltoaction') ?></a>
		    </div>
		</div>

		<?php } ?>