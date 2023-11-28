<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/aryanbokde
 * @since      1.0.0
 *
 * @package    Wordpress_Assign
 * @subpackage Wordpress_Assign/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Assign
 * @subpackage Wordpress_Assign/admin
 * @author     Rakesh <aryanbokde@gmail.com>
 */
class Wordpress_Assign_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-assign-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-assign-admin.js', array( 'jquery' ), $this->version, false );

	}

	//Resposible to custom post type
	public function wap_custom_post_type_event() {
		// Check if the custom post type is already registered
			if (!post_type_exists('event')) {
				//Create custom post type Events
				$labels = array(
					'name'                  => _x( 'Events', 'Post type general name', 'textdomain' ),
					// 'register_meta_box_cb' => 'global_notice_meta_box',
					'singular_name'         => _x( 'Event', 'Post type singular name', 'textdomain' ),
					'menu_name'             => _x( 'Events', 'Admin Menu text', 'textdomain' ),
					'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'textdomain' ),
					'add_new'               => __( 'Add New', 'textdomain' ),
					'add_new_item'          => __( 'Add New Event', 'textdomain' ),
					'new_item'              => __( 'New Event', 'textdomain' ),
					'edit_item'             => __( 'Edit Event', 'textdomain' ),
					'view_item'             => __( 'View Event', 'textdomain' ),
					'all_items'             => __( 'All Events', 'textdomain' ),
					'search_items'          => __( 'Search Events', 'textdomain' ),
					'parent_item_colon'     => __( 'Parent Events:', 'textdomain' ),
					'not_found'             => __( 'No Events found.', 'textdomain' ),
					'not_found_in_trash'    => __( 'No Events found in Trash.', 'textdomain' ),
					'featured_image'        => _x( 'Event Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
					'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
					'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
					'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
					'archives'              => _x( 'Event archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
					'insert_into_item'      => _x( 'Insert into Event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
					'uploaded_to_this_item' => _x( 'Uploaded to this Event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
					'filter_items_list'     => _x( 'Filter Events list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
					'items_list_navigation' => _x( 'Events list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
					'items_list'            => _x( 'Events list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
				);
			
				$args = array(
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'rewrite'            => array( 'slug' => 'author' ),
					'capability_type'    => 'post',
					'has_archive'        => false,
					'hierarchical'       => false,
					'menu_position'      => null,
					'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
					'taxonomies'   		 => array( 'event_category')
					
				);
		
				register_post_type( 'event', $args );
	
				//Create custom post type Taxonomy Authors
				$taxonomy_labels1 = array(
					'name'              => _x( 'Event Categories', 'taxonomy general name', 'textdomain' ),
					'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'textdomain' ),
					'search_items'      => __( 'Search Event Categories', 'textdomain' ),
					'all_items'         => __( 'All Event Categories', 'textdomain' ),
					'parent_item'       => __( 'Parent Event Category', 'textdomain' ),
					'parent_item_colon' => __( 'Parent Event Category:', 'textdomain' ),
					'edit_item'         => __( 'Edit Event Category', 'textdomain' ),
					'update_item'       => __( 'Update Event Category', 'textdomain' ),
					'add_new_item'      => __( 'Add New Event Category', 'textdomain' ),
					'new_item_name'     => __( 'New Event Category ', 'textdomain' ),
					'menu_name'         => __( 'Event Categories', 'textdomain' ),
				);
	
				$taxonomy_args1 = array(
					'labels'                     => $taxonomy_labels1,
					'hierarchical'               => true,
					'public'                     => true,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
				);
	
				register_taxonomy( 'event_category', array( 'event' ), $taxonomy_args1 );
	
				
			}     
	   
			flush_rewrite_rules();
	} 
	
	//Create custom post type event custom field
	public function wap_add_event_custom_fields() {
		add_meta_box(
			'event_custom_fields',    // Unique ID
			'Event Details',          // Box title
			array($this, 'wap_render_event_custom_fields'), // Callback function to render the fields
			'event',                 // Custom post type
			'normal',               // Context (normal, advanced, side)
			'default'               // Priority (default, core, high, low)
		);
	}
	
	//Create callback function to display custom fields
	public function wap_render_event_custom_fields($post) {
		// Retrieve existing values from the database
		$event_date = get_post_meta($post->ID, '_event_date', true);
		$event_start_time = get_post_meta($post->ID, '_event_start_time', true);
		$event_end_time = get_post_meta($post->ID, '_event_end_time', true);
		$event_price = get_post_meta($post->ID, '_event_price', true);

		// Output field HTML
		?>
		<div id="postcustomstuff">
			<table id="newmeta">
				<tbody>
					<tr>
						<td id="newmetaleft" class="left">
							<b><label for="event_date">Date of event</label></b>
						</td>
						<td>
							<input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" />
						</td>
					</tr>
					<tr>
						<td id="newmetaleft" class="left">
							<b><label for="event_start_time">Start Time</label></b>
						</td>
						<td>
							<input type="time" id="event_start_time" name="event_start_time" value="<?php echo esc_attr($event_start_time); ?>" />
						</td>
					</tr>
					<tr>
						<td id="newmetaleft" class="left">
							<b><label for="event_end_time">End Time</label></b>
						</td>
						<td>
							<input type="time" id="event_end_time" name="event_end_time" value="<?php echo esc_attr($event_end_time); ?>" />
						</td>
					</tr>
					<tr>
						<td id="newmetaleft" class="left">
							<b><label for="event_price">Price</label></b>
						</td>
						<td>
							<input type="text" id="event_price" name="event_price" value="<?php echo esc_attr($event_price); ?>" />
						</td>
					</tr>                
				</tbody>
			</table>
		</div>		
		<?php
	}

	//Save custom field value to database
	public function wap_save_event_custom_fields($post_id) {
		// Save custom field data
		if (array_key_exists('event_date', $_POST)) {
			update_post_meta($post_id, '_event_date', $_POST['event_date']);
		}
		if (array_key_exists('event_start_time', $_POST)) {
			update_post_meta($post_id, '_event_start_time', $_POST['event_start_time']);
		}
		if (array_key_exists('event_start_time', $_POST)) {
			update_post_meta($post_id, '_event_start_time', $_POST['event_start_time']);
		}
		if (array_key_exists('event_end_time', $_POST)) {
			update_post_meta($post_id, '_event_end_time', $_POST['event_end_time']);
		}
		if (array_key_exists('event_price', $_POST)) {
			update_post_meta($post_id, '_event_price', $_POST['event_price']);
		}
	}

	// Add admin menu item
	public function wap_event_settings_menu() {
		add_menu_page(
			'Event Settings',
			'Event Settings',
			'manage_options',
			'wap-event-settings',
			array($this, 'wap_event_settings_page'),
			'dashicons-admin-generic', // Use Dashicons
			25 // Change as needed
		);
	}
	
	// Callback function to display the settings page
	public function wap_event_settings_page() {
		?>
		<div class="wrap">
			<h2>Event Settings</h2>
			<p>Please use this shortcode for search books.</p>
			<p><code>[event_form]</code></p>
		</div>
		<?php
	}


}
