<?php
/*
Template name: Page - Left Sidebar
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div  class="page-wrapper page-left-sidebar">
<div class="row">

<div id="content" class="large-9 right col" role="main">
	<div class="page-inner">
		<?php if(get_theme_mod('default_title', 0)){ ?>
			<header class="entry-header">
				<h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		<?php } ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

			<?php if ( comments_open() || '0' != get_comments_number() ){
						comments_template(); } ?>

		<?php endwhile; // end of the loop. ?>
	</div><!-- .page-inner -->
</div><!-- end #content large-9 left -->

<div class="large-3 col col-first">

	<?php ls_get_documentation('marketing_docs', 'marketing_category'); ?>


</div><!-- end sidebar -->

</div><!-- end row -->

</div><!-- end page-right-sidebar container -->

<?php rewind_posts(); ?>
 
<?php while ( have_posts() ) : the_post(); ?>
	<!-- Do stuff... -->

<div class="row">
	<div class="large-12 col pb-0">
		<div class="flex-row flex-has-center next-prev-nav bt bb">
			<div class="flex-col flex-left text-left">
				<?php ls_get_previous('marketing_docs', 'marketing_category'); ?>
			</div>
			<div class="flex-col flex-right text-right">
				<?php ls_get_next('marketing_docs', 'marketing_category'); ?>
			</div>
		</div>
	</div>
</div>

<?php endwhile; ?>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
