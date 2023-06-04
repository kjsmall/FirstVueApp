<?php
/*
Template name: Page - Full Width
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>

<div id="content" role="main" class="content-area">
		
	<?php  

		$current_term = get_queried_object();
		$breadcrumbs = '<div class="breadcrumbs">';
		$breadcrumbs .= '<a href="/web-team/">Web Team</a> <img src="/wp-content/uploads/2022/04/arrow-right-solid.svg" class="svg-image breadcrumb-arrows" alt="arrow right"/>  ';
		$breadcrumbs .= get_term_parents_list($current_term->term_id, 'web_category', array('separator' => ' <img src="/wp-content/uploads/2022/04/arrow-right-solid.svg" class="svg-image breadcrumb-arrows" alt="arrow right"/> '));
		$breadcrumbs .= '</div>';

		$return .= '[row style="collapse" h_align="center"]';

		$return .= '[col span__sm="12"]';

		$return .= '[gap height="60px"]';

		$return .= '[title text="' . $current_term->name . '" tag_name="h1" margin_top="25px" margin_bottom="0px"]';
		$return .=  $breadcrumbs;

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
				$return .= '[row]';

				$return .= '[col span__sm="12"]';
				$return .= display_terms('web_category', $subcats);
				$return .= '[/col]';

				$return .= '[/row]';
			}


			$return .= '[row][col span__sm="12"][divider width="100%" margin="1.9em"]';		

			$return .= '<h4 class="mb-0">Most Viewed '.$current_term->name.' Docs</h4>';

			$return .= do_shortcode('[get_popular_posts term_id = '. $current_term->term_id .' post_type = "web_docs" taxonomy = "web_category"]');
			$return .= '[/col][/row]';
		}	
		
		//Display posts
		else if($current_tax_level == 0){
			//masonry
			/*$args = array(
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
				$return .= '[/ux_html]';*/

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

				$post_count = $loop->post_count;
				$column_split = $post_count / 2;
				$i = 0;

				$return .= '[row]';
				$return .= '[col span="6" span__md="12"]';
	
				while ($loop->have_posts() ) : $loop->the_post();
					
					$return .= '<a href= "'. get_permalink(get_the_ID()) . '"  class="post-link"/>';
						$return .= '<div class="post-title">';
							$return .= '<span class="title">'. get_the_title() .'</span>';
							$return .= '<span class="author">By '. get_the_author() .'</span>';
						$return .= '</div>';
						$return .= '<div class="svg-wrap"><img src="/wp-content/uploads/2022/04/arrow-right-solid.svg" class="style-svg" alt="arrow right"/></div>';
					$return .= '</a>';

					$i++;
					
					if($i == $column_split){
						$return .= '[/col]';
						$return .= '[col span="6" span__md="12"]';
					}
					
				endwhile;	

				$return .= '[/col]';

				$return .= '[/row]';	
			
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
