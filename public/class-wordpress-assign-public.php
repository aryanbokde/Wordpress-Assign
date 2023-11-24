<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/aryanbokde
 * @since      1.0.0
 *
 * @package    Wordpress_Assign
 * @subpackage Wordpress_Assign/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordpress_Assign
 * @subpackage Wordpress_Assign/public
 * @author     Rakesh <aryanbokde@gmail.com>
 */
class Wordpress_Assign_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Assign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Assign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-assign-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Assign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Assign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-assign-public.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script('jquery');
		wp_enqueue_script('custom-scripts', plugin_dir_url( __FILE__ ) . 'js/custom-scripts.js', array('jquery'), time(), true);
		// Localize the script with the appropriate data
		wp_localize_script('custom-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	}

	//Create shortcode for display form
	public function wap_shortcode_generate_event(){
		add_shortcode( "event_form", array($this, 'wap_event_form') );
	}

	

	public function wap_event_form(){

		ob_start(); ?>
		<form id="event-submission-form">
			<p>
				<label for="event-title">Event Title:</label>
				<input type="text" id="event-title" name="event_title" required>
			</p>
			<p>
				<label for="event-content">Event Content:</label>
				<textarea id="event-content" name="event_content" required></textarea>
			</p>
			<p>Select Category</p>
			<p>
				<label>
					<input type="checkbox" name="category[]" value="Socials">
					Socials
				</label>

				<label>
					<input type="checkbox" name="category[]" value="Sports">
					Sports
				</label>

				<label>
					<input type="checkbox" name="category[]" value="Worlds">
					Worlds
				</label>
			</p>
			<p>
				<label for="event-image">Featured Image:</label>
				<input type="file" id="event-image" name="event_image" accept="image/*">
			</p>
			<p>
				<label for="event-date">Event Date:</label>
				<input type="date" id="event-date" name="event_date" />
			</p>
			<p>
				<label for="event-start-date">Event Start Time:</label>
				<input type="time" id="event-start-date" name="event_start_time" />
			</p>
			<p>
				<label for="event-end-date">Event End Time:</label>
				<input type="time" id="event-end-date" name="event_end_time" />
			</p>
			<p>
				<label for="event-price">Event Price:</label>
				<input type="number" id="event-price" name="event_price" />
			</p>
			<input type="submit" value="Submit Event">
		</form>
		<div id="response-message"></div>
		<?php
		return ob_get_clean();

	}


	public function wap_submit_event() {

		$title = sanitize_text_field($_POST['event_title']);
		$content = wp_kses_post($_POST['event_content']);
		$term_names = isset($_POST['category']) ? $_POST['category'] : array();
		$event_image = $_FILES['event_image'];
		$event_date = $_POST['event_date'];
		$event_start_date = $_POST['event_start_time'];
		$event_end_date = $_POST['event_end_time'];
		$event_price = $_POST['event_price'];
	
		$post_data = array(
			'post_title' => $title,
			'post_content' => $content,
			'post_type' => 'event',
			'post_status' => 'publish',
		);
	
		$post_id = wp_insert_post($post_data);
	
		if (!is_wp_error( $post_id )) {
			// Check if terms already exist and add them if not
			foreach ($term_names as $term_name) {
				$term_exists = term_exists($term_name, 'event_category');
	
				if (!$term_exists) {
					$term_id = wp_insert_term($term_name, 'event_category')['term_id'];
					wp_set_object_terms($post_id, $term_id, 'event_category', true);
				} else {
					// wp_set_object_terms($post_id, $term_exists['term_id'], 'event_category', true);
					wp_set_object_terms($post_id, $term_name, 'event_category', true);
				}
			}
		}
	
		if (!is_wp_error( $post_id )) {
			$event_image = $_FILES['event_image'];
	
			if ($event_image) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
				require_once ABSPATH . 'wp-admin/includes/file.php';
				require_once ABSPATH . 'wp-admin/includes/media.php';
	
				$attachment_id = media_handle_upload('event_image', $post_id);
	
				if (!is_wp_error($attachment_id)) {
					set_post_thumbnail($post_id, $attachment_id);
				}
			}
	
			// Update custom field (replace 'your_custom_field' with your actual custom field key)
			update_post_meta($post_id, '_event_date', $event_date);
			update_post_meta($post_id, '_event_start_time', $event_start_date);
			update_post_meta($post_id, '_event_end_time', $event_end_date);
			update_post_meta($post_id, '_event_price', $event_price);
	
			echo json_encode(array('status' => 'success', 'message' => 'Event created successfully!'));
	
		}else {
			echo json_encode(array('status' => 'error', 'message' => 'Error creating event. Please try again.'));
		}
		
		wp_die(); // Don't forget to include this to end the AJAX request
	}
	
	

}
