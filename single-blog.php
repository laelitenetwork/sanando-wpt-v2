<?php
/**
 * Template Name: Blog Single
 */
get_header(); 
?>
<div class="container site-content">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<div class="col-lg-9">
			<article itemscope="" itemtype="http://schema.org/Article">
				<h1 itemprop="name"><?php the_title(); ?></h1>
				<hr />
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
			</article>
			<div class="pages">
				<?php custom_wp_link_pages(); ?>
			</div>
		</div>
		<div class="col-lg-3">
			<?php dynamic_sidebar('sidebar-blog') ?>
		</div>
	</div>
	<?php if( function_exists( 'single_latest_posts' ) ) { ?>
	<!-- Recomendados -->
	<div class="row">
		<div class="col-lg-12">
			<hr />
			<h3><span class="glyphicon glyphicon-book"></span> <?php echo __('También te puede Interesar', 'sanando'); ?></h3>
			<hr />
			<?php
				$categories = get_the_category(); 
				$mainCategory = $categories[0]->slug;
				$params = array(
					'suppress_filters'	=> 'true',
					'title_only'		=> 'false',
					'auto_excerpt'		=> 'true',
					'category'			=> $mainCategory,
					'custom_post_type'	=> 'blog',
					'random'			=> 'true',
					'display_type'		=> 'block',
					'number_posts'		=> 2,
					'number_per_cat'	=> 2,
					'wrapper_block_css'	=> ''
				);
				single_latest_posts( $params );
			?>
		</div>
	</div>
	<?php } ?>
	<!-- Comentarios -->
	<div class="row">
		<div class="col-lg-12 center">
			<hr />
			<div id="article-comments"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>