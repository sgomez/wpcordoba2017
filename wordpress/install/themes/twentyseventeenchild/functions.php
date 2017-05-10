<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_action( 'init', 'my_task_cpt' );
function my_task_cpt() {
  $labels = array(
    'name'               => _x( 'Tasks', 'post type general name', 'twentyseventeen' ),
    'singular_name'      => _x( 'Task', 'post type singular name', 'twentyseventeen' ),
    'menu_name'          => _x( 'Tasks', 'admin menu', 'twentyseventeen' ),
    'name_admin_bar'     => _x( 'Task', 'add new on admin bar', 'twentyseventeen' ),
    'add_new'            => _x( 'Add New', 'task', 'twentyseventeen' ),
    'add_new_item'       => __( 'Add New Task', 'twentyseventeen' ),
    'new_item'           => __( 'New Task', 'twentyseventeen' ),
    'edit_item'          => __( 'Edit Task', 'twentyseventeen' ),
    'view_item'          => __( 'View Task', 'twentyseventeen' ),
    'all_items'          => __( 'All Tasks', 'twentyseventeen' ),
    'search_items'       => __( 'Search Tasks', 'twentyseventeen' ),
    'parent_item_colon'  => __( 'Parent Tasks:', 'twentyseventeen' ),
    'not_found'          => __( 'No tasks found.', 'twentyseventeen' ),
    'not_found_in_trash' => __( 'No tasks found in Trash.', 'twentyseventeen' )
  );

  $args = array(
    'labels'             => $labels,
    'description'        => __( 'Description.', 'twentyseventeen' ),
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'task' ),
    'capability_type'    => 'post',
    'has_complete'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'show_in_rest'       => true,
    'rest_base'          => 'tasks',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'supports'           => array( 'title' ),
  );

  register_post_type( 'task', $args );

  register_post_status( 'todo', array(
  		/* WordPress built in arguments. */
  		'label'                       => __( 'Todo', 'twentyseventeen' ),
  		'label_count'                 => _n_noop( 'Todo <span class="count">(%s)</span>', 'Todos <span class="count">(%s)</span>', 'twentyseventeen' ),
  		'public'                      => true,
  		'show_in_admin_all_list'      => true,
  		'show_in_admin_status_list'   => true,

  		/* WP Statuses specific arguments. */
  		'post_type'                   => array( 'task' ), // Only for posts!
  		'show_in_metabox_dropdown'    => true,
  		'show_in_inline_dropdown'     => true,
  		'show_in_press_this_dropdown' => true,
  		'labels'                      => array(
  			'metabox_dropdown' => __( 'Todo',        'twentyseventeen' ),
  			'inline_dropdown'  => __( 'Todo',        'twentyseventeen' ),
  		),
  		'dashicon'                    => 'dashicons-no',
	) );

  register_post_status( 'completed', array(
  		/* WordPress built in arguments. */
  		'label'                       => __( 'Completed', 'twentyseventeen' ),
  		'label_count'                 => _n_noop( 'Completed <span class="count">(%s)</span>', 'Completed <span class="count">(%s)</span>', 'twentyseventeen' ),
  		'public'                      => true,
  		'show_in_admin_all_list'      => true,
  		'show_in_admin_status_list'   => true,

  		/* WP Statuses specific arguments. */
  		'post_type'                   => array( 'task' ), // Only for posts!
  		'show_in_metabox_dropdown'    => true,
  		'show_in_inline_dropdown'     => true,
  		'show_in_press_this_dropdown' => true,
  		'labels'                      => array(
  			'metabox_dropdown' => __( 'Completed',        'twentyseventeen' ),
  			'inline_dropdown'  => __( 'Completed',        'twentyseventeen' ),
  		),
  		'dashicon'                    => 'dashicons-yes',
	) );

}

function my_restrict_statuses_for_tasks( $post_types = array(), $status_name = '' ) {
	// All other statuses (eg: Publish, Private...) won't be applied to tasks
	return array_diff( $post_types, array( 'task' ) );
}
add_filter( 'wp_statuses_get_registered_post_types', 'my_restrict_statuses_for_tasks', 10, 2 );

function my_insert_using_custom_status( $data = array(), $postarr = array() ) {
	if ( empty( $postarr['publish'] ) ) {
		return $data;
	}
	if ( 'task' !== $data['post_type'] ) {
		return $data;
	}
	if ( ! empty( $postarr['_wp_statuses_status'] ) && in_array( $postarr['_wp_statuses_status'], array(
		'completed',
		'todo',
	), true ) ) {
		$data['post_status'] = sanitize_key( $postarr['_wp_statuses_status'] );
	// Default status for the task Post Type is todo.
	} else {
		$data['post_status'] = 'todo';
	}
	return $data;
}
add_filter( 'wp_insert_post_data', 'my_insert_using_custom_status', 10, 2 );


add_filter( 'allowed_http_origin', '__return_true' );
