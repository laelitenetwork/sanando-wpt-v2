<?php
/**
 * Template Name: Jornadas de Recolección
 */
get_header(); 
?>
<div class="container site-content">
	<?php the_breadcrumb(); ?>
	<div class="jumbotron">
		<div class="container">
			<span data-picture data-alt="Jornadas de Recoleccion a Beneficio de Sanando" class="jumbopicture">
				<span data-src="http://staticelite.info/sanando/images/campanas/Donaciones_1140.jpg"></span>
				<span data-src="http://staticelite.info/sanando/images/campanas/Donaciones_260.jpg" data-media="(min-width: 300px)"></span>
				<span data-src="http://staticelite.info/sanando/images/campanas/Donaciones_360.jpg" data-media="(min-width: 400px)"></span>
				<span data-src="http://staticelite.info/sanando/images/campanas/Donaciones_760.jpg" data-media="(min-width: 800px)"></span>
				<span data-src="http://staticelite.info/sanando/images/campanas/Donaciones_960.jpg" data-media="(min-width: 1000px)"></span>
				<span data-src="http://staticelite.info/sanando/images/campanas/Donaciones_1140.jpg" data-media="(min-width: 1100px)"></span>
				<!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
				<noscript><img src="http://staticelite.info/sanando/images/campanas/Donaciones_960.jpg" alt="Jornadas de Recolección a Beneficio de Sanando"></noscript>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<hr />
			<article itemscope="" itemtype="http://schema.org/Article">
				<h1 itemprop="name"><span class="glyphicon glyphicon-gift"></span> <?php the_title(); ?></h1>
				<hr />
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						remove_filter( 'the_content', 'wpautop' );
						the_content();
						add_filter( 'the_content', 'wpautop' );
					?>

				<?php endwhile; // end of the loop. ?>
			</article>
		</div>
	</div>
</div>
<?php get_footer(); ?>