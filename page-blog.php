/**
 * Template Name: Blog Home
 */
<?php get_header(); ?>
<div class="container site-content">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<article itemscope="" itemtype="http://schema.org/Article">
			<h1 itemprop="name"><?php the_title(); ?></h1>
			<hr />
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; // end of the loop. ?>
		</article>
	</div>
</div>
<?php get_footer(); ?>