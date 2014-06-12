<?php
/**
 * Template Name: Landing Page
 */
get_header(); 
?>
<div class="container site-content">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<article itemscope="" itemtype="http://schema.org/Article">
			<h1 itemprop="name"><span class="glyphicon glyphicon-bookmark"></span> <?php the_title(); ?></h1>
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
<?php get_footer(); ?>