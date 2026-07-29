

	<?php get_template_part( 'templates/partials/_footer' ); ?>

	<?php wp_footer(); ?>
	<?php // defer lets both scripts download in parallel instead of main.min.js
	      // waiting for modernizr to finish downloading and executing first;
	      // execution order (modernizr before main.min.js) is preserved. ?>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/modernizr-2.7.1.min.js" defer></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.min.js?vers=1.4" defer></script>


</body>
</html>
