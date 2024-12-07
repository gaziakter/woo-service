<?php
/*
Plugin Name: Woo Service
Description: A plugin to manage services via WooCommerce.
Version: 1.0
Author: Gazi Akter 
Author URI: https://gaziakter.com
Plugin URI: https://gaziakter.com/plugin/woo-service
Text Domain: woo-service
Domain Path: /languages
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WooServicePlugin {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        add_action( 'init', array( $this, 'register_service_post_type' ) );
    }

    /**
     * Add the custom admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            'Woo Service',                // Page title
            'Woo Service',                // Menu title
            'manage_options',             // Capability
            'woo-service',                // Menu slug
            array( $this, 'admin_page' ), // Callback function
            'dashicons-schedule',          // Icon
            20                             // Position
        );
    }

    /**
     * Admin page content callback
     */
    public function admin_page() {
        ?>
<div class="wrap">
    <h1>Welcome to Woo Service</h1>
    <p>Manage your services here.</p>
</div>
<?php
    }

    /**
     * Register the "Service" custom post type
     */
    public function register_service_post_type() {
        $labels = array(
            'name'               => 'Services',
            'singular_name'      => 'Service',
            'menu_name'          => 'Services',
            'name_admin_bar'     => 'Service',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Service',
            'new_item'           => 'New Service',
            'edit_item'          => 'Edit Service',
            'view_item'          => 'View Service',
            'all_items'          => 'All Services',
            'search_items'       => 'Search Services',
            'not_found'          => 'No services found.',
            'not_found_in_trash' => 'No services found in Trash.',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'woo-service', // Display under Woo Service menu
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'service' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        );

        register_post_type( 'service', $args );
    }

}

// Initialize the plugin
new WooServicePlugin();
?>