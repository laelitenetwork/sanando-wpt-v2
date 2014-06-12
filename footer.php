		<hr />
		<div class="row center">
			<div class="col-xs-12 col-sm-12">
				<?php echo do_shortcode( '[mc4wp_form]' ); ?>
			</div>
		</div>
		<hr />
		<footer id="footer-main">
			<p>Fundación Sanando &copy; 2012 - <?php echo date('Y'); ?>. RIF. J-403294585. Caracas, Venezuela. <?php if( !empty( 'phone_number' ) ) { echo '<span class="glyphicon glyphicon-phone-alt"></span> '.get_theme_mod( 'phone_number' ); } ?></p>
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
			<p><a href="http://goo.gl/wcdms" title="Hecho en Venezuela por L'Elite" target="_blank"><img src="http://staticelite.info/elitenetwork/images/laelite_32.png" alt="Hecho en Venezuela por L'Elite" title="" rel="tooltip" data-original-title="Hecho en Venezuela por L'Elite"></a></p>
		</footer>
	</div><!-- Wrapper -->
	<?php wp_footer(); ?>
</body>