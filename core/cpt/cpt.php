<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Register Custom Post Type
function wp_debug_mi_post_type() {

	$labels       = array(
		'name'                  => _x( 'Post Types', 'Post Type General Name', 'wp-debug' ),
		'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'wp-debug' ),
		'menu_name'             => __( 'Post Types', 'wp-debug' ),
		'name_admin_bar'        => __( 'Post Type', 'wp-debug' ),
		'archives'              => __( 'Item Archives', 'wp-debug' ),
		'attributes'            => __( 'Item Attributes', 'wp-debug' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wp-debug' ),
		'all_items'             => __( 'All Items', 'wp-debug' ),
		'add_new_item'          => __( 'Add New Item', 'wp-debug' ),
		'add_new'               => __( 'Add New', 'wp-debug' ),
		'new_item'              => __( 'New Item', 'wp-debug' ),
		'edit_item'             => __( 'Edit Item', 'wp-debug' ),
		'update_item'           => __( 'Update Item', 'wp-debug' ),
		'view_item'             => __( 'View Item', 'wp-debug' ),
		'view_items'            => __( 'View Items', 'wp-debug' ),
		'search_items'          => __( 'Search Item', 'wp-debug' ),
		'not_found'             => __( 'Not found', 'wp-debug' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wp-debug' ),
		'featured_image'        => __( 'Featured Image', 'wp-debug' ),
		'set_featured_image'    => __( 'Set featured image', 'wp-debug' ),
		'remove_featured_image' => __( 'Remove featured image', 'wp-debug' ),
		'use_featured_image'    => __( 'Use as featured image', 'wp-debug' ),
		'insert_into_item'      => __( 'Insert into item', 'wp-debug' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-debug' ),
		'items_list'            => __( 'Items list', 'wp-debug' ),
		'items_list_navigation' => __( 'Items list navigation', 'wp-debug' ),
		'filter_items_list'     => __( 'Filter items list', 'wp-debug' ),
	);
	$rewrite      = array(
		'slug'       => 'mi-custom',
		'with_front' => true,
		'pages'      => true,
		'feeds'      => true,
	);
	$capabilities = array(
		'edit_post'          => 'edit_cpt',
		'read_post'          => 'read_cpt',
		'delete_post'        => 'delete_cpt',
		'edit_posts'         => 'edit_cpt',
		'edit_others_posts'  => 'edit_others_cpt',
		'publish_posts'      => 'publish_cpt',
		'read_private_posts' => 'read_private_cpt',
	);
	$args         = array(
		'label'               => __( 'Post Type', 'wp-debug' ),
		'description'         => __( 'Post Type Description', 'wp-debug' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'taxonomies'          => array( 'mi_taxonomia' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => false,
		'menu_position'       => 10,
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capabilities'        => $capabilities,
		'rewrite'             => $rewrite,
		'show_in_rest'        => true,
	);
	register_post_type( 'mi_post_type', $args );

}
add_action( 'init', 'wp_debug_mi_post_type', 0 );

// Register Custom Taxonomy.
function mi_taxonomia() {

	$labels = array(
		'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'wp-debug' ),
		'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'wp-debug' ),
		'menu_name'                  => __( 'Taxonomy', 'wp-debug' ),
		'all_items'                  => __( 'All Items', 'wp-debug' ),
		'parent_item'                => __( 'Parent Item', 'wp-debug' ),
		'parent_item_colon'          => __( 'Parent Item:', 'wp-debug' ),
		'new_item_name'              => __( 'New Item Name', 'wp-debug' ),
		'add_new_item'               => __( 'Add New Item', 'wp-debug' ),
		'edit_item'                  => __( 'Edit Item', 'wp-debug' ),
		'update_item'                => __( 'Update Item', 'wp-debug' ),
		'view_item'                  => __( 'View Item', 'wp-debug' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'wp-debug' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'wp-debug' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wp-debug' ),
		'popular_items'              => __( 'Popular Items', 'wp-debug' ),
		'search_items'               => __( 'Search Items', 'wp-debug' ),
		'not_found'                  => __( 'Not Found', 'wp-debug' ),
		'no_terms'                   => __( 'No items', 'wp-debug' ),
		'items_list'                 => __( 'Items list', 'wp-debug' ),
		'items_list_navigation'      => __( 'Items list navigation', 'wp-debug' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'mi_taxonomia', array( 'mi_post_type' ), $args );

}
add_action( 'init', 'mi_taxonomia', 0 );

// filtro para añadir las acciones al listado de entradas (post).
add_filter( 'bulk_actions-edit-mi_post_type', 'wp_debug_anadimos_acciones_bulk' );

function wp_debug_anadimos_acciones_bulk( $bulk_actions ) {
	$bulk_actions['accion_primera_anadida'] = esc_html__( 'Esta es la acción primera', 'wp-debug' );
	$bulk_actions['accion_segunda_anadida'] = esc_html__( 'Esta es la acción segunda', 'wp-debug' );

	return $bulk_actions;
}

// Filto para añadir lo que se debe hacer con las acciones anteriores cuando se seleccionan en el listado de entradas (post).
add_filter( 'handle_bulk_actions-edit-mi_post_type', 'wp_debug_anadimos_actions_handler', 10, 3 );

function wp_debug_anadimos_actions_handler( $redirect_to, $doaction, $post_ids ) {

	// Solo continúa si son las acciones que hemos creado nosotros.
	if ( 'accion_primera_anadida' !== $doaction && 'accion_segunda_anadida' !== $doaction ) {
		return $redirect_to;
	}
	// Si es la acción primera, realizará estas acciones.
	if ( 'accion_primera_anadida' === $doaction ) {
		foreach ( $post_ids as $post_id ) {
			// Aquí lo que quieras que se realice con accion_primera_anadida.
		}

		$redirect_to = add_query_arg( 'accion_primera_anadida', count( $post_ids ), $redirect_to );
		return $redirect_to;

	} elseif ( 'accion_segunda_anadida' === $doaction ) {

		foreach ( $post_ids as $post_id ) {

			// Aquí lo que quieras que se realice con accion_segunda_anadida
		}
		$redirect_to = add_query_arg( 'accion_segunda_anadida', count( $post_ids ), $redirect_to );
		return $redirect_to;
	}
}

/******************************************************/
/*** Para hacer un metabox compatible con Gutenberg */
/*****************************************************/
/*
add_meta_box( 'my-meta-box', 'My Meta Box', 'my_meta_box_callback', null, 'side', 'high',
	array(
		'__back_compat_meta_box' => true,
		)
	);
*/
