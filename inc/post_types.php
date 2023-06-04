<?php
// Add custom Theme Functions here



function lemonade_create_post_types() {

	//web documentation post type

	$web_labels = array(
		'name'                => 'Web Documentation',
		'singular_name'       => 'Web Documentation',
		'add_new'             => 'Add Web Documentation',
		'all_items'           => 'All Web Documentation',
		'add_new_item'        => 'Add New Web Documentation',
		'edit_item'           => 'Edit Web Documentation',
		'new_item'	          => 'New Web Documentation',
		'view_item'           => 'View Web Documentation',
		'search_items'        => 'Search Web Documentation',
		'not_found'           => 'No Web Documentation found',
		'not_found_in_trash'  => 'No Web Documentation found in Trash',
		'parent_item_colon'   => 'Parent Web Documentation:',
		'menu_name'           => 'Web Docs',
		'update_item'         => 'Update Web Documentation',	
	);

	$web_args = array(
		'label'               => 'Web Documentation',
		'description'         => 'Web Documentation post type',
		'labels'              => $web_labels,
		'public'              => true,
		'has_archive'         => false,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => true,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor', 'author'),
		'taxonomies'		  => array('web_category'),
		'menu_position'       => 6,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'can_export'          => true,
		'show_in_rest'		  => true,	
		'menu_icon' => 'dashicons-clipboard',
	);

	register_post_type( 'web_docs', $web_args );
	
	
	
	//marketing documentation post type
	
	$marketing_labels = array(
		'name'                => 'Marketing Documentation',
		'singular_name'       => 'Marketing Documentation',
		'add_new'             => 'Add Marketing Documentation',
		'all_items'           => 'All Marketing Documentation',
		'add_new_item'        => 'Add New Marketing Documentation',
		'edit_item'           => 'Edit Marketing Documentation',
		'new_item'	          => 'New Marketing Documentation',
		'view_item'           => 'View Marketing Documentation',
		'search_items'        => 'Search Marketing Documentation',
		'not_found'           => 'No Marketing Documentation found',
		'not_found_in_trash'  => 'No Marketing Documentation found in Trash',
		'parent_item_colon'   => 'Parent Marketing Documentation:',
		'menu_name'           => 'Marketing Docs',
		'update_item'         => 'Update Marketing Documentation',	
	);

	$marketing_args = array(
		'label'               => 'Marketing Documentation',
		'description'         => 'Marketing Documentation post type',
		'labels'              => $marketing_labels,
		'public'              => true,
		'has_archive'         => false,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => true,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor', 'author'),
		'taxonomies'		  => array('marketing_category'),
		'menu_position'       => 7,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'can_export'          => true,
		'show_in_rest'		  => true,	
		'menu_icon' => 'dashicons-clipboard',
	);

	register_post_type( 'marketing_docs', $marketing_args );
	
	
	//team-wide documentation post type
	
	$team_wide_labels = array(
		'name'                => 'Team-Wide Documentation',
		'singular_name'       => 'Team-Wide Documentation',
		'add_new'             => 'Add Team-Wide Documentation',
		'all_items'           => 'All Team-Wide Documentation',
		'add_new_item'        => 'Add New Team-Wide Documentation',
		'edit_item'           => 'Edit Team-Wide Documentation',
		'new_item'	          => 'New Team-Wide Documentation',
		'view_item'           => 'View Team-Wide Documentation',
		'search_items'        => 'Search Team-Wide Documentation',
		'not_found'           => 'No Team-Wide Documentation found',
		'not_found_in_trash'  => 'No Team-Wide Documentation found in Trash',
		'parent_item_colon'   => 'Parent Team-Wide Documentation:',
		'menu_name'           => 'Team-Wide Docs',
		'update_item'         => 'Update Team-Wide Documentation',	
	);

	$team_wide_args = array(
		'label'               => 'Team-Wide Documentation',
		'description'         => 'Team-Wide Documentation post type',
		'labels'              => $team_wide_labels,
		'public'              => true,
		'has_archive'         => false,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => true,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor', 'author'),
		'taxonomies'		  => array('team_wide_category'),
		'menu_position'       => 8,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'can_export'          => true,
		'show_in_rest'		  => true,	
		'menu_icon' => 'dashicons-clipboard',
	);

	register_post_type( 'team_wide_docs', $team_wide_args );

	//sales documentation post type
	
	$sales_labels = array(
		'name'                => 'Sales Documentation',
		'singular_name'       => 'Sales Documentation',
		'add_new'             => 'Add Sales Documentation',
		'all_items'           => 'All Sales Documentation',
		'add_new_item'        => 'Add New Sales Documentation',
		'edit_item'           => 'Edit Sales Documentation',
		'new_item'	          => 'New Sales Documentation',
		'view_item'           => 'View Sales Documentation',
		'search_items'        => 'Search Sales Documentation',
		'not_found'           => 'No Sales Documentation found',
		'not_found_in_trash'  => 'No Sales Documentation found in Trash',
		'parent_item_colon'   => 'Parent Sales Documentation:',
		'menu_name'           => 'Sales Docs',
		'update_item'         => 'Update Sales Documentation',	
	);

	$sales_args = array(
		'label'               => 'Sales Documentation',
		'description'         => 'Sales Documentation post type',
		'labels'              => $sales_labels,
		'public'              => true,
		'has_archive'         => false,
		'publicly_queryable'  => true,
		'query_var' 	      => true,
		'rewrite'			  => true,
		'capability_type'	  => 'post',	
		'hierarchical'        => true,	
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor', 'author'),
		'taxonomies'		  => array('sales_category'),
		'menu_position'       => 8,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'can_export'          => true,
		'show_in_rest'		  => true,	
		'menu_icon' => 'dashicons-clipboard',
	);

	register_post_type( 'sales_docs', $sales_args );
	
}
add_action( 'init', 'lemonade_create_post_types', 0 );



function create_taxonomies() {
	
	// Add new taxonomy for web documentation post type
	$web_labels = array(
		'name'              => _x( 'Web Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Web Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Web Categories', 'textdomain' ),
		'all_items'         => __( 'All Web Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Web Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Web Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Web Category', 'textdomain' ),
		'update_item'       => __( 'Update Web Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Web Category', 'textdomain' ),
		'new_item_name'     => __( 'New Web Category Name', 'textdomain' ),
		'menu_name'         => __( 'Web Category', 'textdomain' ),
	);

	$web_args = array(
		'hierarchical'      => true,
		'labels'            => $web_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'web_category' ),
		'show_in_rest' => true
	);

	register_taxonomy( 'web_category', array( 'web_docs' ), $web_args );
	
	
	// Add new taxonomy for marketing documentation post type
	$marketing_labels = array(
		'name'              => _x( 'Marketing Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Marketing Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Marketing Categories', 'textdomain' ),
		'all_items'         => __( 'All Marketing Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Marketing Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Marketing Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Marketing Category', 'textdomain' ),
		'update_item'       => __( 'Update Marketing Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Marketing Category', 'textdomain' ),
		'new_item_name'     => __( 'New Marketing Category Name', 'textdomain' ),
		'menu_name'         => __( 'Marketing Category', 'textdomain' ),
	);

	$marketing_args = array(
		'hierarchical'      => true,
		'labels'            => $marketing_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'marketing_category' ),
		'show_in_rest' => true
	);

	register_taxonomy( 'marketing_category', array( 'marketing_docs' ), $marketing_args );
	
	// Add new taxonomy for Team-Wide documentation post type
	$team_wide_labels = array(
		'name'              => _x( 'Team-Wide Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Team-Wide Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Team-Wide Categories', 'textdomain' ),
		'all_items'         => __( 'All Team-Wide Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Team-Wide Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Team-Wide Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Team-Wide Category', 'textdomain' ),
		'update_item'       => __( 'Update Team-Wide Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Team-Wide Category', 'textdomain' ),
		'new_item_name'     => __( 'New Team-Wide Category Name', 'textdomain' ),
		'menu_name'         => __( 'Team-Wide Category', 'textdomain' ),
	);

	$team_wide_args = array(
		'hierarchical'      => true,
		'labels'            => $team_wide_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'team_wide_category' ),
		'show_in_rest' => true
	);

	register_taxonomy( 'team_wide_category', array( 'team_wide_docs' ), $team_wide_args );

	// Add new taxonomy for Sales documentation post type
	$sales_labels = array(
		'name'              => _x( 'Sales Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Sales Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Sales Categories', 'textdomain' ),
		'all_items'         => __( 'All Sales Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Sales Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Sales Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Sales Category', 'textdomain' ),
		'update_item'       => __( 'Update Sales Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Sales Category', 'textdomain' ),
		'new_item_name'     => __( 'New Sales Category Name', 'textdomain' ),
		'menu_name'         => __( 'Sales Category', 'textdomain' ),
	);

	$sales_args = array(
		'hierarchical'      => true,
		'labels'            => $sales_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sales_category' ),
		'show_in_rest' => true
	);

	register_taxonomy( 'sales_category', array( 'sales_docs' ), $sales_args );

}
add_action( 'init', 'create_taxonomies', 0 );



//add builder to post types
add_action( 'init', function () {
	add_ux_builder_post_type( 'web_docs' );
	add_ux_builder_post_type( 'marketing_docs' );
	add_ux_builder_post_type( 'team_wide_docs' );
	add_ux_builder_post_type( 'internal_docs' );
	add_ux_builder_post_type( 'sales_docs' );
} );




