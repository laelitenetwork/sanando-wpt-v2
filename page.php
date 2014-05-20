<?php get_header(); ?>
<div class="container site-content">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<article itemscope="" itemtype="http://schema.org/Article">
				<h1 itemprop="name"><?php the_title(); ?></h1>
				<hr />
				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
			</article>
		</div>
	</div>
</div>
<?php get_footer(); ?>