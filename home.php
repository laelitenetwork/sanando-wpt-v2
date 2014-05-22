<?php get_header(); ?>
<div class="container site-content">
	<?php 
		if( !is_home() || !is_front_page() ) {
			the_breadcrumb();
		}
	?>
	<div class="med-count">
		<hr />
		<p class="lead center">Hemos donado <strong><?php echo get_theme_mod('medicamentos_donados'); ?></strong> medicamentos e insumos a toda Venezuela</p>
		<hr />
	</div>
	<div class="row hidden-xs hidden-sm">
		<p class="center">Vistos en</p>
		<p class="center">
			<span data-picture data-alt="Medios que nos han reseñado" class="jumbopicture">
				<span data-src="http://staticelite.info/sanando/images/medios_996.png"></span>
				<span data-src="http://staticelite.info/sanando/images/medios_760.png" data-media="(min-width: 760px)"></span>
				<span data-src="http://staticelite.info/sanando/images/medios_996.png" data-media="(min-width: 1000px)"></span>
				<!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
				<noscript><img src="http://staticelite.info/sanando/images/medios_996.png"></noscript>
			</span>
		</p>
		<hr />
	</div>
	<div class="row">
		<div class="col-md-4">
			<h2>¿Qué Hacemos?</h2>
			<p>
				Donamos medicamentos e insumos médicos, a cualquier persona residenciada
				en Venezuela de forma gratuita. Los únicos requisitos que pedimos son: copia 
				del documento de identidad del paciente y un récipe médico legal vigente. Solo 
				aceptamos y hacemos donaciones, no vendemos.
			</p>
			<p class="center">
				<a class="btn btn-warning btn-lg" href="#" role="button">Conoce Nuestra Labor »</a>
			</p>
		</div>
		<div class="col-md-4">
			<h2>¿Cómo?</h2>
			<p>
				Obtenemos medicamentos e insumos a través de jornadas de recolección 
				nacionales e internacionales. Contamos con la colaboración de algunos laboratorios
				farmacéuticos privados. Y también de particulares que nos donan medicamentos
				que ya no necesitan.
			</p>
			<p class="center">
				<a class="btn btn-warning btn-lg" href="#" role="button">Únete a Nuestra Causa »</a>
			</p>
		</div>
		<div class="col-md-4">
			<h2>¿Por qué?</h2>
			<p>
				Crisis del sistema de salud, falta de recursos económicos para adquirir medicamentos; 
				escasez de medicamentos e insumos médicos. Todo esto afecta a los ciudadanos de una nación, 
				nuestra misión es ayudar a quienes necesitan curar sus dolencias y no consiguen como.
			</p>
			<p class="center">
				<a class="btn btn-warning btn-lg" href="#" role="button">Aprende más »</a>
			</p>
		</div>
	</div>
</div>
<?php get_footer(); ?>