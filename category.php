<?php
/*
Template name: Page - Full Width
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div id="content" role="main" class="content-area">
		
	<?php  

		$current_term = get_queried_object();

		$breadcrumbs = '<a href="/web-team/">Web Team</a> > ';
		$breadcrumbs .= get_term_parents_list($current_term->term_id, 'web_category', array('separator' => ' > '));

		$return .= '[row style="collapse"]';

		$return .= '[col span__sm="12"]';

		$return .= '[row_inner]';

		$return .= '[col_inner span__sm="12"]';

		$return .= '[gap height="41px"]';

		$return .= '[section bg="542" bg_size="original" bg_color="#0974b2" dark="true"]';
			$return .= '[row_inner_1 style="collapse" h_align="center"]';
			$return .= '[col_inner_1 span="11" span__sm="12"]';
			$return .= '[title text="' . $current_term->name . '" tag_name="h1" margin_top="25px" margin_bottom="0px"]';
			$return .=  $breadcrumbs;
			$return .= '[/col_inner_1]';
			$return .= '[/row_inner_1]';
		$return .= '[gap height="23px"]';
		$return .= '[/section]';

		$return .= '[/col_inner]';

		$return .= '[/row_inner]';

		$return .= '[/col]';

		$return .= '[/row]';

		$return .= '[section padding="60px"]';

		$current_tax_level = get_term_children($current_term->term_id, 'web_category');	
		$current_tax_level = count($current_tax_level);

		//Parent Pages
		
		if($current_tax_level > 0){

			$termchildren = array(
				'hierarchical' => 1,
				'show_option_none' => '',
				'hide_empty' => 0,
				'parent' => $current_term->term_id,
				'taxonomy' => 'web_category');
			
			$subcats = get_categories($termchildren);	
			
			if(!$subcats){
				$return .= '[row]';

				$return .= '[col span__sm="12"]';

				$return .= '<p>There are no web_docs for ' . $current_term->name . '</p>';

				$return .= '[/col]';

				$return .= '[/row]';

			} else {

				$return.= '<div class="row taxonomy-buttons">';
				
				foreach ($subcats as $key => $value) {
					$term_link = get_term_link( $value );
					$name = $value->name;
					$tax = get_term($value);
					$description = term_description($value->term_taxonomy_id);

					$return .= '<a class="col large-3 medium-6 small-12" href="'. $term_link . '">';
					$return .= '<div class="button-wrap">';
					$return.= '<h3>' . $name . '</h3>';
					$return .= '<p>' . $description . '</p>';
					$return.= '</div>';
					$return.= '</a>';
			
				}

				$return.= '</div>';
			}

			
			$return .= '[gap height="50px"]';

			$return .= '[title style="bold" text="Most Popular Web Team Docs" tag_name="h4"]';

			$return .= do_shortcode('[get_popular_posts term_id = '. $current_term->term_id .' post_type = "web_docs" taxonomy = "web_category"]');
		}	
		
		//Display posts
		else if($current_tax_level == 0){
			
			$args = array(
				'post_type'       =>    'web_docs',
				'post_status'     =>    'publish',
				'posts_pser_page' =>    -1,
				'order'           =>    'ASC',
				'tax_query'       => array(
					array(
						'taxonomy' => 'web_category',
						'field'    => 'term_id',
						'terms'    => $current_term->term_id,
					),
				),
			);

			$loop = new WP_Query( $args );

			if($loop->have_posts()){ 
				$post_count = $loop->found_posts;
				$masonry = '4';
				if($post_count < 3){
					$masonry = '1';
				} else if ($post_count == 3 || $post_count == 4){
					$masonry = '2';
				} else if ($post_count == 5 || $post_count == 6){
					$masonry = '3';
				} 

				$return .= '[ux_html]';
				$return .= '<div class="custom-masonry masonry-' . $masonry . '">';
			
				while ($loop->have_posts() ) : $loop->the_post();
				
					$return .= '<a href="' . get_permalink(get_the_ID()) . '" class="masonry-element">';

					$return .= '[row]';

					$return .= '[col span__sm="12" bg_radius="10" depth="5"]';

					if(get_post_thumbnail_id()){
						$return .= '[ux_image id="'. get_post_thumbnail_id() .'" height="150px"]';
					}
					$return .= '[row_inner]';

					$return .= '[col_inner span__sm="12" padding="23px 30px 0px 30px"]';

					$return .= '<h4>'. get_the_title(). '</h4>';
					$return .= '[ux_text class="uppercase is-xsmall op-6"]';
					$return .= '<h5>'. strip_tags(get_the_term_list(get_the_ID(), "web_category", "",", " )) . ' | By ' . get_the_author() . '</h5>';
					$return .= '[/ux_text]';
					$return .= '<p class="hide-overflow">' . get_the_excerpt() . '</p>';

					$return .= '[/col_inner]';

					$return .= '[/row_inner]';

					$return .= '[/col]';

					$return .= '[/row]';
					
					$return .= '</a>';
				endwhile;

				$return .= '</div>';
				$return .= '[/ux_html]';

			// In case the query is empty
			} else {
		
				$parent = get_term_by( 'id', $current_term->parent, 'web_category' );
				$parent_link = get_permalink();

				$return .= '[row]';

				$return .= '[col span__sm="12" align="center"]';

				$return .= '<p>There are no web_docs for ' . $current_term->name . '</p>';
				$return .= '[gap height="20px"]';

				$return .= '[button text="Return To ' . $parent->name . '" link="/product_type/' . $parent->slug . '"]';


				$return .= '[/col]';

				$return .= '[/row]';

			}

    		wp_reset_postdata();
			
		}

		$return .= '[/section]';	

		echo do_shortcode($return);
	?>
		
</div>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
