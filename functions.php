<?php
// Add custom Theme Functions here

/**
 * Bypass Force Login to allow for exceptions.
 *
 * @param bool $bypass Whether to disable Force Login. Default false.
 * @param string $visited_url The visited URL.
 * @return bool
 */
function my_forcelogin_bypass( $bypass, $visited_url ) {
  // Allow all single posts
  if ( is_single() ) {
    // $bypass = true;
  }

  // Allow these absolute URLs
  $allowed = array(
    home_url( '/web_docs/beta-site-checklist/' ),
  );
  if ( ! $bypass ) {
    $bypass = in_array( $visited_url, $allowed );
  }

  return $bypass;
}
add_filter( 'v_forcelogin_bypass', 'my_forcelogin_bypass', 10, 2 );



require_once( __DIR__ . '/inc/post_types.php');
require_once( __DIR__ . '/inc/shortcodes.php');


add_action( 'wp_enqueue_scripts', 'my_themes_scripts_styles' );
function my_themes_scripts_styles() {
        // vueJS integration
        wp_register_script('vue-js', 'https://unpkg.com/vue@3/dist/vue.global.js', null, null);
        wp_enqueue_script('vue-js'); 

  	  	wp_register_script( 'vue-main', get_stylesheet_directory_uri() . '/assets/js/main.js', null , true );
          wp_enqueue_script('vue-main');

		wp_enqueue_script( 'lemonade-stand', get_stylesheet_directory_uri() . '/assets/js/lemonade-stand.js', array(
			'jquery',
			'hoverIntent',
		), true );

}


/* function to get side bar menu on post type pages */
function ls_get_documentation(string $post_type, string $category) {
	global $post;
	$result = '';
	
	
	/* get all children - for pages with children */
	if($post->post_parent == 0){
		
		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => -1,
			'post_parent'       => $post->ID,
			'order'             => 'ASC',
    	);
		
		$parent = new WP_Query ($args);
		wp_reset_query();  
	
		if (($parent->have_posts())){               
		
			$result = '<span class="widget-title">'.$post->post_title.'</span>';
			$result .= '<div class="is-divider small"></div>';
			
			$result .= '<ul class="side-menu">';
				$result .= '<li class="active">';
				$result .= '<a href="'.get_permalink().'">'.get_the_title().'</a></li>';
				
				while ( $parent->have_posts() ) : $parent->the_post();
					$result .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
				endwhile;
				
			$result .= '</ul>';
		}

		/* for pages without children - get all posts of same category */
		else{
			$custom_terms = wp_get_post_terms($post->ID, $category);	

	
			foreach($custom_terms as $custom_term) {
				wp_reset_query();
				$args = array(
					'post_type' => $post_type,
					'tax_query' => array(
						array(
							'taxonomy' => $category,
							'field' => 'slug',
							'terms' => $custom_term,
						),
					),
					'order' => 'ASC',
				);

				$loop = new WP_Query($args);
				if($loop->have_posts()) {
					$current_ID = $post->ID;

					$result .= '<span class="widget-title">'.$custom_term->name.'</span>';
					$result .= '<div class="is-divider small"></div>';

					$result .= '<ul class="side-menu">';

					while($loop->have_posts()) : $loop->the_post();
						if(get_the_ID() == $current_ID){
							$result .= '<li class="active">';
						} else {
							$result .= '<li>';
						}
					$result .= '<a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		
					endwhile;

					$result .= '</ul>';
				}
			}
	
		}
	}
	
	/* for child page - get all children and parent */
	else if($post->post_parent != 0){
		$parent = wp_get_post_parent_id($post->ID);
		
		$result = '<span class="widget-title">'.get_the_title($parent).'</span>';
			$result .= '<div class="is-divider small"></div>';
			
			
		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => -1,
			'post_parent'       => $parent,
			'order'             => 'ASC',
		);
	
		$loop = new WP_Query ($args);    
		
		wp_reset_query();                  
		
		$result .= '<ul class="side-menu">';
			$result .= '<li><a href="'.get_permalink($parent).'">'.get_the_title($parent).'</a></li>';
			$current_ID = $post->ID;
			
			while ( $loop->have_posts() ) : $loop->the_post();
			
				if(get_the_ID() == $current_ID){
							$result .= '<li class="active">';
						} else {
							$result .= '<li>';
						}
				$result .= '<a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			endwhile;
			
		$result .= '</ul>';
	}
	
	echo $result;
}



/* get previous post */

function ls_get_previous( $post_type, $cat ){
	global $post;
	
	/* check if needs to get previous post of parent or previous post of category */
	/* for top level pages */
	if($post->post_parent == 0){


		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => -1,
			'post_parent'       => $post->ID,
			'order'             => 'ASC',
		);
	
		$children = new WP_Query ($args);    
		
		wp_reset_query();           
		
		/* if this is the parent page then don't return anything */
		if (($children->have_posts())){       
			return;
		}


		/* if there are no children get the previous post */
		else{
			$prev_post = get_previous_post(true,'', $cat);

			$return = '';

			if ( is_a( $prev_post , 'WP_Post' ) ) {

				$return .= '<a title="'.get_the_title( $prev_post->ID ).'" class="next-link plain" href="'. get_the_permalink( $prev_post->ID ).'">';
				$return .= get_flatsome_icon('icon-angle-left');
				$return .= get_the_title($prev_post->ID);
				$return .= '</a>';

			}
		}
	}


	/* for child posts get previous child */
	else{
	
		$parentID = wp_get_post_parent_id($post->ID);
		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => -1,
			'post_parent'       => $parentID,
			'order'             => 'ASC',
		);
	
		$pagelist = new WP_Query ($args);    
		
		$pages = array();
		while ( $pagelist->have_posts() ) : $pagelist->the_post();			
			 $pages[] += get_the_ID();
		endwhile;
		
		wp_reset_query();
		
		$current = array_search($post->ID, $pages);
		$prevID = $pages[$current-1];
		
		/* not first page */
		if($prevID){
			$return .= '<a title="'.get_the_title( $prevID ).'" class="next-link plain" href="'. get_the_permalink( $prevID ).'">';
			$return .= get_flatsome_icon('icon-angle-left');
			$return .= get_the_title($prevID);
			$return .= '</a>';
		}
		/* first page, get parent as previous */
		else{
			$return .= '<a title="'.get_the_title( $parentID ).'" class="next-link plain" href="'. get_the_permalink( $parentID ).'">';
			$return .= get_flatsome_icon('icon-angle-left');
			$return .= get_the_title($parentID);
			$return .= '</a>';
		}
	}
	
	
	echo $return;
}


/* get next post */

function ls_get_next( $post_type, $cat ){
	global $post;
	
	/* check if needs to get previous post of parent or previous post of category */
	/* for top level page get first child */
	if($post->post_parent == 0){


		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => -1,
			'post_parent'       => $post->ID,
			'order'             => 'ASC',
    	);
		
		$children = new WP_Query ($args);
		wp_reset_query();  
		
		/* if this is the parent page then don't return anything */
		if (($children->have_posts())){  
				$return .= '<a title="'.get_the_title( $children->posts[0]->ID ).'" class="next-link plain" href="'. get_the_permalink( $children->posts[0]->ID ).'">';
				$return .= get_the_title($children->posts[0]->ID);
				$return .= get_flatsome_icon('icon-angle-right');
				$return .= '</a>';
		}


		/* if there are no children get the previous post */
		else{
			$next_post = get_next_post(true,'', $cat);

			$return = '';

			if ( is_a( $next_post , 'WP_Post' ) ) {

				$return .= '<a title="'.get_the_title( $next_post->ID ).'" class="next-link plain" href="'. get_the_permalink( $next_post->ID ).'">';
				$return .= get_the_title($next_post->ID);
				$return .= get_flatsome_icon('icon-angle-right');
				$return .= '</a>';

			}
		}
	}


	/* for child posts get previous child */
	else{
	
		$parentID = wp_get_post_parent_id($post->ID);
		$args = array(
			'post_type'         => $post_type,
			'posts_per_page'    => -1,
			'post_parent'       => $parentID,
			'order'             => 'ASC',
		);
	
		$pagelist = new WP_Query ($args);    
		
		$pages = array();
		while ( $pagelist->have_posts() ) : $pagelist->the_post();			
			 $pages[] += get_the_ID();
		endwhile;
		
		wp_reset_query();
		
		$current = array_search($post->ID, $pages);
		$nextID = $pages[$current+1];
		
		/* not last page */
		if($nextID){
			$return .= '<a title="'.get_the_title( $nextID ).'" class="next-link plain" href="'. get_the_permalink( $nextID ).'">';
			$return .= get_the_title($nextID);
			$return .= get_flatsome_icon('icon-angle-right');
			$return .= '</a>';
		}
	}
	
	
	echo $return;
}



function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



function sheet_value_shortcode($atts) {
    $API = 'AIzaSyAr4cOmCab48711aUK3wYIP4ypW0DqcuCI';
    $google_spreadsheet_ID = '1w4gn9pQmxjmkoCAx-11dUoGjAIHGWCcjd-n9fE7Ym2c';
    $api_key = esc_attr( $API);

	$earned_location = $atts['earned_location'];
    $pending_location = $atts['pending_location'];

    $get_cell = new WP_Http();
    $cell_url = "https://sheets.googleapis.com/v4/spreadsheets/$google_spreadsheet_ID/values/$earned_location?&key=$api_key";	
    $cell_response = $get_cell -> get( $cell_url);
    $json_body = json_decode($cell_response['body'],true);	
    $earned = $json_body['values'][0][0];
    $earned_num = filter_var($earned, FILTER_SANITIZE_NUMBER_INT);
    
    $cell_url = "https://sheets.googleapis.com/v4/spreadsheets/$google_spreadsheet_ID/values/$pending_location?&key=$api_key";	
    $cell_response = $get_cell -> get( $cell_url);
    $json_body = json_decode($cell_response['body'],true);	
    $pending = $json_body['values'][0][0];
    $pending_num = filter_var($pending, FILTER_SANITIZE_NUMBER_INT);
    
    
    $percent = ceil(($earned_num / $pending_num) * 100);
    
    $return ='';
    
    $return .= '<p class="nag">NAG Earned: <b>'.$earned.'</b></p>'; 
    $return .= '<div class="nag-bar">';
    $return .= '<div class="earned-amount" style="width: '.$percent.'%"></div>';
    $return .= '</div>';
    $return .= '<p class="small">Pending NAG per team member: '.$pending.'</p>'; 
    
    
    
    
    return $return;
}
add_shortcode('get_sheet_value', 'sheet_value_shortcode');


/* Add Filter by Category to Web Custom Post Type */
add_action( 'restrict_manage_posts', function ( $post_type, $which ) {
    if ( 'top' === $which && 'web_docs' === $post_type ) {
        $taxonomy = 'web_category';
        $tax = get_taxonomy( $taxonomy );            // get the taxonomy object/data
        $cat = filter_input( INPUT_GET, $taxonomy ); // get the selected category slug

        echo '<label class="screen-reader-text" for="web_category">Filter by ' .
            esc_html( $tax->labels->singular_name ) . '</label>';

        wp_dropdown_categories( [
            'show_option_all' => $tax->labels->all_items,
            'hide_empty'      => 0, // include categories that have no posts
            'hierarchical'    => $tax->hierarchical,
            'show_count'      => 0, // don't show the category's posts count
            'orderby'         => 'name',
            'selected'        => $cat,
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'value_field'     => 'slug',
        ] );
    }
}, 10, 2 );


include_once __DIR__ . '/theme-includes/theme-functions.php';


add_action( 'pre_get_posts', 'my_view_filter' );
function my_view_filter($query){
    if ( 
        !is_admin() && 
        $query->is_main_query() && 
        ( $query->is_home() || $query->is_archive() || $query->is_search() )
    ) {
        if (isset($_REQUEST['orderby'])) {
            $order = $_REQUEST['orderby'];
        }
        if ( $order === 'views') {
            $query->set('meta_key', 'post_views_count');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'DESC');
        }
    }
}

//Post View Count

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

//-----------------------------

function display_terms($taxonomy, $tax_terms){

	$result = '<div class="row row-small taxonomy-buttons">';

	$last = count($tax_terms);
	$i = 0;


	foreach ($tax_terms as $term){
		$result .= '<div class="col large-3 medium-6 small-12">';

			if($i == 0){
				$result .= '<img src="/wp-content/uploads/2022/04/squirt-1.svg" alt="" class="corner-squirt"/>';
			}

			$result .= '<a href="/'. $taxonomy . '/'. $term->slug . '" class="taxonomy-button">';
			  $result .= '<div class="button-wrap">';
					$image = get_field('category_image', $term);
					$ext = pathinfo( $image['url'], PATHINFO_EXTENSION );
				
					if($image){
						if ( $ext == 'svg' ){
						$result .= '<div class="icon-wrap"><img src="'. esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) .'" class = "style-svg" /></div>';
						} else {
						$result .= '<div class="icon-wrap"><img src="'. esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) .'" /></div>';
						}
					}
			
					$result .= '<h3>' . $term->name . '</h3>';
					$result .= '<p>' . term_description($term) . '</p>';
				$result .= '</div>';
			$result .= '</a>';
		
		$i++;
		if($i == $last){
			$result .= '<img alt="" src="/wp-content/uploads/2022/04/corner-graphic.svg" class="corner-graphic"/>';
		}

		$result .= '</div>';
	  }
	  
	  $result .= '</div>';
	  
	  return $result;
  }