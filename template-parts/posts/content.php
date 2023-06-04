<div class="entry-content">
	<div class="col-inner">
		<a class="feat-link" href="<?php echo get_the_permalink(); ?>">
		  <div class="featured-post-wrap">
	
				<div class="feat-text">
					  <h4><?php the_title(); ?></h4>
					  <p class="uppercase is-xsmall op-6">
						 <?php  echo strip_tags(get_the_category_list( __( ', ', 'flatsome' ) ));?>
					  </p>
		  
					 <p><?php the_excerpt();?></p>
				</div>
	
	
				<div class="feat-img">
					<?php if( has_post_thumbnail(get_the_ID()) ){ ?>
					<?php echo get_the_post_thumbnail(get_the_ID(), 'large');?>
					<?php } else { ?>
					<div class="no-thumbnail"></div>
					<?php } ?>
				</div>

	
		   </div><!-- .box  -->
		</a>
	</div><!-- .col-inner -->
</div><!-- .col -->