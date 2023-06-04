<?php
/*
Template name: Page - Full Width
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<!--START VUE APP-->
<div id="app">
	<h1>{{ title }}</h1>
	<p>{{description}}</p>
</div>

<!--MOUNT APP-->
<script>
	const mountedApp = app.mount('#app');
</script>

<div id="content" role="main" class="content-area">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>
		
		<?php endwhile; // end of the loop. ?>
		
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
