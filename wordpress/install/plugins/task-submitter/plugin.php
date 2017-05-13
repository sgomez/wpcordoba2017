<?php
/**
 * Plugin Name: Task Submitter
 *
 * Créditos: https://apppresser.com/wp-api-task-submission/
 */

class widget_submit_task extends WP_Widget {
    public function __construct() {
      parent::__construct(
  			'html_id',
  			__( 'Task submitter', 'text_domain' ),
  			array(
  				'description' => __( 'demo widget', 'text_domain' ),
  				'classname'   => 'widget classname',
  			)
  		);
    }

    public function widget($args, $instance) {

      $content = '<section class="widget widget_task_submitter">';
      $content .= '<h2 class="widget-title">'. __( 'Pending tasks', 'your-text-domain' ) . '</h2>';
      if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
  			ob_start();?>
  			<ul id="tasks-list"></ul>
        <br/>
  			<form id="task-submission-form">
  				<div>
  					<label for="task-submission-title">
  						<?php _e( 'New task', 'your-text-domain' ); ?>
  					</label>
  					<input type="text" name="task-submission-title" id="task-submission-title" required aria-required="true">
  				</div>
  			</form>
        </section>
  			<?php
  			$content .= ob_get_clean();
  		}else{
  			$content .=  sprintf( '<a href="%1s">%2s</a>', esc_url( wp_login_url() ), __( 'Click Here To Login', 'your-text-domain' ) );
  		}
      $content .= '</section>';
      echo $content;
    }
}
// register widget
add_action('widgets_init', create_function('', 'return register_widget("widget_submit_task");'));

/**
 * Setup JavaScript
 */
add_action( 'wp_enqueue_scripts', function() {

	//load script
	wp_enqueue_script( 'my-post-submitter', plugin_dir_url( __FILE__ ) . 'post-submitter.js', array( 'jquery' ) );

	//localize data for script
	wp_localize_script( 'my-post-submitter', 'POST_SUBMITTER', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'current_user_id' => get_current_user_id()
		)
	);

});
