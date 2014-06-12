<?php
/**
 * Template Name: Blog Home
 */
get_header();
?>
<div class="container site-content">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-lg-6">
				<article itemscope="" itemtype="http://schema.org/Article">
					<h1 itemprop="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<hr />
					<div class="thumbnail">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( 200, 200 ), array( 'class' => 'pull-left' ) ); ?></a>
						<div class="caption">
							<?php the_excerpt(); ?>
							<a class="btn btn-success btn-round" href="<?php the_permalink(); ?>"><span class="glyphicon glyphicon-arrow-right"></span></a>
						</div>
					</div>
				</article>
			</div>
		<?php
			endwhile; // end of the loop. 
		?>
	</div>
	<div class="pages">
		<?php kriesi_pagination(); ?>
	</div>
</div>
<?php get_footer(); ?>