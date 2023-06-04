<?php
/*
Template name: Taxonomy
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div  class="page-wrapper page-left-sidebar">

<div id="content"  role="main">
	<div class="page-inner">
		<?php if ( have_posts() ) { 
			
			$cat = get_queried_object();
			$tax = $cat->taxonomy;
			$post_type = get_taxonomy($tax)->object_type[0];
			
			$shortcode = '[ls_featured_category post_type="'. $post_type .' " title="'. $cat->name . '" category="'. $tax . '" cat="'.  $cat->slug .'" style="overlay" filter="false" filter_align="right" type="masonry" orderby="date" order="asc" columns="1" ]';
			
			echo do_shortcode ($shortcode);
		
		} else {?>
			<div class="row">
				<div class="quick-steps">
					<h3>There are no posts yet!</h3>
				</div>
			</div>
		<?php } ?>
		
	</div><!-- .page-inner -->
</div><!-- end #content large-9 left -->


</div><!-- end page-right-sidebar container -->

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
