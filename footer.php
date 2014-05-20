		<hr />
		<div class="row center">
			<div class="col-xs-12 col-sm-12">
				<?php echo do_shortcode( '[mc4wp_form]' ); ?>
			</div>
		</div>
		<hr />
		<footer id="footer-main">
			<p>Fundación Sanando &copy; 2012 - <?php echo date('Y'); ?>. RIF. J-403294585. Caracas, Venezuela.</p>
			<p class="footer-links"><?php
				$menuParameters = array(
					'theme_location'	=> 'footer_links',
					'container'       => false,
					'echo'            => false,
					'items_wrap'      => '%3$s',
					'depth'           => 0,
				);
				echo strip_tags( wp_nav_menu( $menuParameters ), '<a>' );
			?></p>
			<p><a href="http://goo.gl/wcdms" title="Hecho en Venezuela por L'Elite" target="_blank"><img src="http://laelitenetwork.com/promo/laelite_32.png.pagespeed.ce.qKXWQBpONh.png" alt="Hecho en Venezuela por L'Elite" title="" rel="tooltip" data-original-title="Hecho en Venezuela por L'Elite"></a></p>
		</footer>
	</div><!-- Wrapper -->
	<?php wp_footer(); ?>
</body>