<?php

function ls_featured_category_posts($atts, $content = null, $tag) {

  extract(shortcode_atts(array(
        // meta
        'filter' => '',
        'filter_nav' => 'line-grow',
        'filter_align' => 'center',
        '_id' => 'portfolio-'.rand(),
        'link' => '',
        'class' => '',
        'visibility' => '',
        'orderby' => 'menu_order',
        'order' => '',
        'offset' => '',
        'exclude' => '',
        'number'  => '999',
        'ids' => '',
        'cat' => '',
        'lightbox' => '',
        'lightbox_image_size' => 'original',

        // Layout
        'style' => '',
        'columns' => '4',
        'columns__sm' => '',
        'columns__md' => '',
        'col_spacing' => 'small',
        'type' => 'slider', // slider, row, masonery, grid
        'width' => '',
        'grid' => '1',
        'grid_height' => '600px',
        'grid_height__md' => '500px',
        'grid_height__sm' => '400px',
        'slider_nav_style' => 'reveal',
        'slider_nav_position' => '',
        'slider_nav_color' => '',
        'slider_bullets' => 'false',
        'slider_arrows' => 'true',
        'auto_slide' => 'false',
        'infinitive' => 'true',
        'depth' => '',
        'depth_hover' => '',

         // Box styles
        'animate' => '',
        'text_pos' => '',
        'text_padding' => '',
        'text_bg' => '',
        'text_color' => '',
        'text_hover' => '',
        'text_align' => 'center',
        'text_size' => '',
        'image_size' => 'medium',
        'image_mask' => '',
        'image_width' => '',
        'image_radius' => '',
        'image_height' => '100%',
        'image_hover' => '',
        'image_hover_alt' => '',
        'image_overlay' => '',

        // Deprecated
        'height' => '',
        
        'category' => '',
        'title' => '',
        'post_type' => 'post',
), $atts));

	ob_start();

  if($height && !$image_height) $image_height = $height;

  // Get Default Theme style
  if(!$style) $style = flatsome_option('portfolio_style');

  // Fix old
  if($tag == 'featured_items_slider') $type = 'slider';

  // Fix order
  if($orderby == 'menu_order') $order = 'asc';

  // Set Classes
  $classes_box = array('portfolio-box','box','has-hover');
  $classes_image = array();
  $classes_text = array('box-text');

  // Fix Grid type
  if($type == 'grid'){
    $columns = 0;
    $current_grid = 0;
    $grid = flatsome_get_grid($grid);
    $grid_total = count($grid);
    flatsome_get_grid_height($grid_height, $_id);
  }

  // Set box style
  if($style) $classes_box[] = 'box-'.$style;
  if($style == 'overlay') $classes_box[] = 'dark';
  if($style == 'shade') $classes_box[] = 'dark';
  if($style == 'badge') $classes_box[] = 'hover-dark';
  if($text_pos) $classes_box[] = 'box-text-'.$text_pos;
  if($style == 'overlay' && !$image_overlay) $image_overlay = true;

  // Set image styles
  if($image_hover)  $classes_image[] = 'image-'.$image_hover;
  if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
  if($image_height)  $classes_image[] = 'image-cover';

  // Text classes
  if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
  if($text_align) $classes_text[] = 'text-'.$text_align;
  if($text_size) $classes_text[] = 'is-'.$text_size;
  if($text_color == 'dark') $classes_text[] = 'dark';

  $css_col = array(
    array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
  );

  $css_args_img = array(
    array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
    array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
  );

  $css_image_height = array(
    array( 'attribute' => 'padding-top', 'value' => $image_height),
  );

  $css_args = array(
        array( 'attribute' => 'background-color', 'value' => $text_bg ),
        array( 'attribute' => 'padding', 'value' => $text_padding ),
  );


 if($animate) {$animate = 'data-animate="'.$animate.'"';}


 echo '<div id="' . $_id . '" class="portfolio-element-wrapper has-filtering">';
 
 // Add filter
 if($filter && $filter != 'disabled' && empty($cat) && $type !== 'grid' && $type !== 'slider' && $type !== 'full-slider'){
  // TODO: Get categories for filtering.
  wp_enqueue_script('flatsome-isotope-js');
  ?>
	<div class="container mb-half flex-menu">
  		<h3><?php echo $title;?></h3>
		<ul class="nav nav-<?php echo $filter;?> nav-<?php echo $filter_align ;?> nav-<?php echo $filter_nav;?> nav-uppercase filter-nav">
			<li class="active"><a href="#" data-filter="[data-id]"><?php echo __('All','flatsome'); ?></a></li>
			<?php
			 $tax_terms = get_terms($category, array('parent' => 0));
			 foreach ($tax_terms as $key => $value) {
			 ?><li><a href="#" data-filter="[data-id*='<?php echo $value->name; ?>']"><?php echo $value->name; ?></a></li><?php
			}
		 ?>
		</ul>
	</div>
  <?php
} else if ($filter && $filter != 'disabled' && !empty($cat) && $type !== 'grid' && $type !== 'slider' && $type !== 'full-slider'){
	// TODO: Get categories for filtering.
  wp_enqueue_script('flatsome-isotope-js');
  ?>
  <div class="container mb-half flex-menu">
 	 <h3><?php echo $title;?></h3>
  	<ul class="nav nav-<?php echo $filter;?> nav-<?php echo $filter_align ;?> nav-<?php echo $filter_nav;?> nav-uppercase filter-nav">
    	<li class="active"><a href="#" data-filter="[data-id]"><?php echo __('All','flatsome'); ?></a></li>
    
    <?php
    $cat_ID = get_term_by( 'slug', $cat, $category )->term_id;
     $tax_terms = get_categories(
		array( 
			'taxonomy' => $category,
			'parent' => $cat_ID,)
		);
		
      foreach ($tax_terms as $key => $value) {
         ?><li><a href="#" data-filter="[data-id*='<?php echo $value->name; ?>']"><?php echo $value->name; ?></a></li><?php
      }
    ?>
  </ul>
  </div>
  <?php
	
}
else{
  	echo '<h3>' . $title . '</h3>';
  	$filter = false;
}

// Repeater options
$repeater['id'] = $_id;
$repeater['tag'] = $tag;
$repeater['type'] = $type;
$repeater['style'] = $style;
$repeater['class'] = $class;
$repeater['visibility'] = $visibility;
$repeater['slider_style'] = $slider_nav_style;
$repeater['slider_nav_color'] = $slider_nav_color;
$repeater['slider_nav_position'] = $slider_nav_position;
$repeater['slider_bullets'] = $slider_bullets;
$repeater['auto_slide'] = $auto_slide;
$repeater['row_spacing'] = $col_spacing;
$repeater['row_width'] = $width;
$repeater['columns'] = $columns;
$repeater['columns__sm'] = $columns__sm;
$repeater['columns__md'] = $columns__md;
$repeater['depth'] = $depth;
$repeater['depth_hover'] = $depth_hover;
$repeater['filter'] = $filter;

global $wp_query;

$args = array(
  'post_type' => $post_type,
);

// Exclude

// If custom Ids
if ( isset( $atts['ids'] ) ) {
  $ids = explode( ',', $atts['ids'] );
  $ids = array_map( 'trim', $ids );
  $args['post__in'] = $ids;
  $args['posts_per_page'] = -1;
  $args['orderby'] = 'post__in';
  
} else {
  $args['offset'] = $offset;
  $args['order'] = $order;
  $args['orderby'] = $orderby;
  $args['post_parent'] = 0;
  if($exclude) $args['post__not_in'] = explode( ',', $exclude );
  $args['posts_per_page'] = $number;
  if ( !empty( $atts['cat'] ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => $category,
        'field' => 'slug',
        'terms' => $cat,
      ),
    );
  }
}

$wp_query = new WP_Query( $args );

// Get repeater structure
get_flatsome_repeater_start($repeater);

 ?>
  <?php

        if ( $wp_query->have_posts() ) :

        while ($wp_query->have_posts()) : $wp_query->the_post();
          $link = get_permalink(get_the_ID());

          $has_lightbox = '';
          if($lightbox == 'true'){
            $link = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $lightbox_image_size );
            $link = $link[0];
            $has_lightbox = 'lightbox-gallery';
          }

          $image = get_post_thumbnail_id();
          $classes_col = array('col');

          // Add Columns for Grid style
          if($type == 'grid'){
              if($grid_total > $current_grid) $current_grid++;
              $current = $current_grid-1;

              $classes_col[] = 'grid-col';
              if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];

              if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
              if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];

              // Set image size
              if($grid[$current]['size']) $image_size = $grid[$current]['size'];
          }

          ?>
          <div class="col" data-id="<?php  echo strip_tags( get_the_term_list( get_the_ID(), $category, "",", " ) );?>">
			  <div class="col-inner">
				  <a class="feat-link" href="<?php echo $link; ?>">
					  <div class="featured-post-wrap">
					  		
							<div class="feat-text">
								  <h4><?php the_title(); ?></h4>
								  <p class="uppercase is-xsmall op-6">
									 <?php  echo strip_tags( get_the_term_list( get_the_ID(), $category, "",", " ) );?> | By <?php echo get_the_author_meta('display_name'); ?>
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
          <?php
          endwhile;
          endif;
          wp_reset_query();

  get_flatsome_repeater_end($repeater);
  echo '</div>';

  $args = array(
   'image_width' => array(
      'selector' => '.box-image',
      'property' => 'width',
      'unit' => '%',
    ),
   'text_padding' => array(
      'selector' => '.box-text',
      'property' => 'padding',
    ),
  );
  echo ux_builder_element_style_tag($_id, $args, $atts);

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode("ls_featured_category", "ls_featured_category_posts");



/*=================================================================*/



function ls_flatsome_portfolio_shortcode($atts, $content = null, $tag) {

  extract(shortcode_atts(array(
        // meta
        'filter' => '',
        'filter_nav' => 'line-grow',
        'filter_align' => 'center',
        '_id' => 'portfolio-'.rand(),
        'link' => '',
        'class' => '',
        'visibility' => '',
        'orderby' => 'menu_order',
        'order' => '',
        'offset' => '',
        'exclude' => '',
        'number'  => '999',
        'ids' => '',
        'cat' => '',
        'lightbox' => '',
        'lightbox_image_size' => 'original',

        // Layout
        'style' => '',
        'columns' => '4',
        'columns__sm' => '',
        'columns__md' => '',
        'col_spacing' => 'small',
        'type' => 'slider', // slider, row, masonery, grid
        'width' => '',
        'grid' => '1',
        'grid_height' => '600px',
        'grid_height__md' => '500px',
        'grid_height__sm' => '400px',
        'slider_nav_style' => 'reveal',
        'slider_nav_position' => '',
        'slider_nav_color' => '',
        'slider_bullets' => 'false',
        'slider_arrows' => 'true',
        'auto_slide' => 'false',
        'infinitive' => 'true',
        'depth' => '',
        'depth_hover' => '',

         // Box styles
        'animate' => '',
        'text_pos' => '',
        'text_padding' => '',
        'text_bg' => '',
        'text_color' => '',
        'text_hover' => '',
        'text_align' => 'center',
        'text_size' => '',
        'image_size' => 'medium',
        'image_mask' => '',
        'image_width' => '',
        'image_radius' => '',
        'image_height' => '100%',
        'image_hover' => '',
        'image_hover_alt' => '',
        'image_overlay' => '',

        // Deprecated
        'height' => '',
        'title' => '',
), $atts));

	ob_start();

  if($height && !$image_height) $image_height = $height;

  // Get Default Theme style
  if(!$style) $style = flatsome_option('portfolio_style');

  // Fix old
  if($tag == 'featured_items_slider') $type = 'slider';

  // Fix order
  if($orderby == 'menu_order') $order = 'asc';

  // Set Classes
  $classes_box = array('portfolio-box','box','has-hover');
  $classes_image = array();
  $classes_text = array('box-text');

  // Fix Grid type
  if($type == 'grid'){
    $columns = 0;
    $current_grid = 0;
    $grid = flatsome_get_grid($grid);
    $grid_total = count($grid);
    flatsome_get_grid_height($grid_height, $_id);
  }

  // Set box style
  if($style) $classes_box[] = 'box-'.$style;
  if($style == 'overlay') $classes_box[] = 'dark';
  if($style == 'shade') $classes_box[] = 'dark';
  if($style == 'badge') $classes_box[] = 'hover-dark';
  if($text_pos) $classes_box[] = 'box-text-'.$text_pos;
  if($style == 'overlay' && !$image_overlay) $image_overlay = true;

  // Set image styles
  if($image_hover)  $classes_image[] = 'image-'.$image_hover;
  if($image_hover_alt)  $classes_image[] = 'image-'.$image_hover_alt;
  if($image_height)  $classes_image[] = 'image-cover';

  // Text classes
  if($text_hover) $classes_text[] = 'show-on-hover hover-'.$text_hover;
  if($text_align) $classes_text[] = 'text-'.$text_align;
  if($text_size) $classes_text[] = 'is-'.$text_size;
  if($text_color == 'dark') $classes_text[] = 'dark';

  $css_col = array(
    array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
  );

  $css_args_img = array(
    array( 'attribute' => 'border-radius', 'value' => $image_radius, 'unit' => '%'),
    array( 'attribute' => 'width', 'value' => $image_width, 'unit' => '%' ),
  );

  $css_image_height = array(
    array( 'attribute' => 'padding-top', 'value' => $image_height),
  );

  $css_args = array(
        array( 'attribute' => 'background-color', 'value' => $text_bg ),
        array( 'attribute' => 'padding', 'value' => $text_padding ),
  );


 if($animate) {$animate = 'data-animate="'.$animate.'"';}


 echo '<div id="' . $_id . '" class="portfolio-element-wrapper has-filtering">';

 // Add filter
 if($filter && $filter != 'disabled' && empty($cat) && $type !== 'grid' && $type !== 'slider' && $type !== 'full-slider'){
  // TODO: Get categories for filtering.
  wp_enqueue_script('flatsome-isotope-js');
  ?>
  <div class="container mb-half flex-menu">
  <h3><?php echo $title;?></h3>
  <ul class="nav nav-<?php echo $filter;?> nav-<?php echo $filter_align ;?> nav-<?php echo $filter_nav;?> nav-uppercase filter-nav">
    <li class="active"><a href="#" data-filter="[data-id*='News']"><?php echo __('News','News'); ?></a></li>
    <li><a href="#" data-filter="[data-id*='Team Wide']"><?php echo __('Team Wide','Team Wide'); ?></a></li>
    <li><a href="#" data-filter="[data-id*='Marketing']"><?php echo __('Marketing','Marketing'); ?></a></li>
    <li><a href="#" data-filter="[data-id*='Web']"><?php echo __('Web','Web'); ?></a></li>
	<li><a href="#" data-filter="[data-id*='Sales']"><?php echo __('Sales','Sales'); ?></a></li>
    
  </ul>
  </div>
  <?php
} else{
  $filter = false;
}

// Repeater options
$repeater['id'] = $_id;
$repeater['tag'] = $tag;
$repeater['type'] = $type;
$repeater['style'] = $style;
$repeater['class'] = $class;
$repeater['visibility'] = $visibility;
$repeater['slider_style'] = $slider_nav_style;
$repeater['slider_nav_color'] = $slider_nav_color;
$repeater['slider_nav_position'] = $slider_nav_position;
$repeater['slider_bullets'] = $slider_bullets;
$repeater['auto_slide'] = $auto_slide;
$repeater['row_spacing'] = $col_spacing;
$repeater['row_width'] = $width;
$repeater['columns'] = $columns;
$repeater['columns__sm'] = $columns__sm;
$repeater['columns__md'] = $columns__md;
$repeater['depth'] = $depth;
$repeater['depth_hover'] = $depth_hover;
$repeater['filter'] = $filter;

global $wp_query;
  
$post_query = new WP_Query( array('fields' => 'ids', 'posts_per_page' => $number, 'post_type' => 'post') );
$web_query = new WP_Query( array('fields' => 'ids', 'posts_per_page' => $number,  'post_type' => 'web_docs') );
$internal_query = new WP_Query( array('fields' => 'ids', 'posts_per_page' => $number,  'post_type' => 'team_wide_docs' ) );
$marketing_query = new WP_Query( array('fields' => 'ids', 'posts_per_page' => $number,  'post_type' => 'marketing_docs') );
$sales_query = new WP_Query( array('fields' => 'ids', 'posts_per_page' => $number,  'post_type' => 'sales_docs') );


$ids = array_merge($post_query->posts, $web_query->posts, $internal_query->posts, $marketing_query->posts);
$wp_query = new WP_Query(array('post__in' => $ids, 'post_type' => array('post', 'web_docs', 'team_wide_docs', 'marketing_docs', 'sales_docs',), 'posts_per_page' => -1, 'order' => $order, 'orderby' => $orderby,));



// Get repeater structure
get_flatsome_repeater_start($repeater);

 ?>
  <?php

        if ( $wp_query->have_posts() ) :


        while ($wp_query->have_posts()) : $wp_query->the_post();
        
        	$post_type = get_post_type( get_the_ID());
        	$category = '';
        	$class= 'col';
        	
        	if($post_type == 'web_docs'){
        		$post_type = 'Web';
        		$category = 'web_category';
        		$class .= ' initial-hide';
        	} else if ($post_type == 'marketing_docs'){
        		$post_type = 'Marketing';
        		$category = 'marketing_category';
        		$class .= ' initial-hide';
        	} else if ($post_type == 'team_wide_docs'){
        		$post_type = 'Team Wide';
        		$category = 'team_wide_category';
        		$class .= ' initial-hide';     
			} else if ($post_type == 'sales_docs'){
        		$post_type = 'Sales';
        		$category = 'sales_category';
        		$class .= ' initial-hide';     	
        	} else if ( $post_type == 'post' ){
        		$post_type = 'News';
        		$category = 'category';
        	}
        	
        
          $link = get_permalink(get_the_ID());

          $has_lightbox = '';
          if($lightbox == 'true'){
            $link = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $lightbox_image_size );
            $link = $link[0];
            $has_lightbox = 'lightbox-gallery';
          }

          $image = get_post_thumbnail_id();
          $classes_col = array('col');

          // Add Columns for Grid style
          if($type == 'grid'){
              if($grid_total > $current_grid) $current_grid++;
              $current = $current_grid-1;

              $classes_col[] = 'grid-col';
              if($grid[$current]['height']) $classes_col[] = 'grid-col-'.$grid[$current]['height'];

              if($grid[$current]['span']) $classes_col[] = 'large-'.$grid[$current]['span'];
              if($grid[$current]['md']) $classes_col[] = 'medium-'.$grid[$current]['md'];

              // Set image size
              if($grid[$current]['size']) $image_size = $grid[$current]['size'];
          }

          ?>
          <div class="<?php echo $class; ?>" data-id="<?php echo $post_type; ?>">
			  <div class="col-inner">
				  <a class="feat-link" href="<?php echo $link; ?>">
					  <div class="featured-post-wrap">
					  		
							<div class="feat-text">
								  <h4><?php the_title(); ?></h4>
								  <p class="uppercase is-xsmall op-6">
									 <?php  echo strip_tags( get_the_term_list( get_the_ID(), $category, "",", " ) );?> | By <?php echo get_the_author_meta('display_name'); ?>
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
          <?php
          
          endwhile;
          endif;
          wp_reset_query();

  get_flatsome_repeater_end($repeater);
  echo '</div>';

  $args = array(
   'image_width' => array(
      'selector' => '.box-image',
      'property' => 'width',
      'unit' => '%',
    ),
   'text_padding' => array(
      'selector' => '.box-text',
      'property' => 'padding',
    ),
  );
  echo ux_builder_element_style_tag($_id, $args, $atts);

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode("ls_featured_posts", "ls_flatsome_portfolio_shortcode");




/*=================================================================*/

function ls_get_category_cards($atts) {
	
	extract(shortcode_atts(array(
        'taxonomy' => ''
	), $atts));
	

	$tax_terms = get_terms($taxonomy, array('hide_empty' => false, 'parent' => 0,));
	
  $result = display_terms($taxonomy, $tax_terms);
	return $result;
	
}
add_shortcode("category_cards", "ls_get_category_cards");


/*=================================================================*/



function ls_get_popular($atts) {
	
	extract(shortcode_atts(array(
    'post_type' => '',
    'taxonomy' => '',
    'term_id' => '',
	), $atts));
	
  $return = '';
  $tax_query = '';
  
  if($term_id == ''){
    $tax_query = array(
      array(
        'taxonomy' => $taxonomy,
        'operator' => 'EXISTS',
      ),
    );
  } else {
    $tax_query = array(
      array(
        'taxonomy' => $taxonomy,
        'field'    => 'term_id',
        'terms'    => $term_id,
      ),
    );
  }

  if($post_type && $taxonomy){
    $popularpost = new WP_Query(array(
      'post_type'       =>    $post_type,
      'posts_per_page' => 8,
      'post_status'     =>  'publish',
      'meta_key' => 'wpb_post_views_count',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
      'tax_query'  => $tax_query,
    ));


    if($popularpost->have_posts()){ 
      $post_count = $popularpost->found_posts;
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
    
      while ($popularpost->have_posts() ) : $popularpost->the_post();
      
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

      $return .= '[row]';

      $return .= '[col span__sm="12"]';

      $return .= '<p>There are no posts to be displayed</p>';

      $return .= '[/col]';

      $return .= '[/row]';

    }

    wp_reset_postdata();
  } else {
     $return .= '<p>The posts cannot be retrieved</p>';
  }
	
  return do_shortcode($return);
	
}
add_shortcode("get_popular_posts", "ls_get_popular");