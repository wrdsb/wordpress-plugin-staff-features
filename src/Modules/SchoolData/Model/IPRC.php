<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register custom post type "iprc"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class IPRCCPT {
    public function __construct($plugin) {
        // Add action to register the post type, if the post type does not already exist
        if (!post_type_exists('iprc')) {
            $plugin->addAction('init', $this, 'registerPostType');
        }
        $plugin->addAction('save_post_iprc', $this, 'customMetaSave'); // TODO: prefix with settings_
    }

    // Register Custom Post Type
    public function registerPostType() {
        $labels = array(
            'name'                  => _x('IPRC', 'Post Type General Name', 'wrdsb'),
            'singular_name'         => _x('IPRC', 'Post Type Singular Name', 'wrdsb'),
            'menu_name'             => __('IPRC', 'wrdsb'),
            'name_admin_bar'        => __('IPRC', 'wrdsb'),
            'archives'              => __('IPRC', 'wrdsb'),
            'parent_item_colon'     => __('IPRC:', 'wrdsb'),
            'all_items'             => __('IPRC', 'wrdsb'),
            'add_new_item'          => __('Add New IPRC', 'wrdsb'),
            'add_new'               => __('Add New', 'wrdsb'),
            'new_item'              => __('New IPRC', 'wrdsb'),
            'edit_item'             => __('Edit IPRC', 'wrdsb'),
            'update_item'           => __('Update IPRC', 'wrdsb'),
            'view_item'             => __('View IPRC', 'wrdsb'),
            'search_items'          => __('Search IPRCs', 'wrdsb'),
            'not_found'             => __('Not found', 'wrdsb'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb'),
            'featured_image'        => __('Featured Image', 'wrdsb'),
            'set_featured_image'    => __('Set featured image', 'wrdsb'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb'),
            'insert_into_item'      => __('Insert into IPRC', 'wrdsb'),
            'uploaded_to_this_item' => __('Uploaded to this IPRC', 'wrdsb'),
            'items_list'            => __('IPRCs list', 'wrdsb'),
            'items_list_navigation' => __('IPRCs list navigation', 'wrdsb'),
            'filter_items_list'     => __('Filter IPRCs list', 'wrdsb'),
        );
        $args = array(
            'label'               => __('IPRC', 'wrdsb'),
            'description'         => __('IPRC', 'wrdsb'),
            'labels'              => $labels,
            'supports'            => array(),
            'taxonomies'          => array(),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'menu_position'       => 99,
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => false,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'capability_type'     => 'page',
            'rewrite'             => array(
                'slug'       => 'iprc',
                'with_front' => false,
            ),
        );
        register_post_type('iprc', $args);
    }

    public function customMetaSave($post_id) {
        // Checks save status
        $is_autosave    = wp_is_post_autosave($post_id);
        $is_revision    = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['wrdsb_nonce']) && wp_verify_nonce($_POST['wrdsb_nonce'], basename(__FILE__))) ? 'true' : 'false';

        // Exits script depending on save status
        if ($is_autosave || $is_revision || ! $is_valid_nonce) {
            return;
        }

        if (isset($_POST['principalFirstname'])) {
            update_post_meta($post_id, 'principalFirstname', sanitize_text_field($_POST['principalFirstname']));
        }
        if (isset($_POST['principalLastname'])) {
            update_post_meta($post_id, 'principalLastname', sanitize_text_field($_POST['principalLastname']));
        }

        if (isset($_POST['teacher1Firstname'])) {
            update_post_meta($post_id, 'teacher1Firstname', sanitize_text_field($_POST['teacher1Firstname']));
        }
        if (isset($_POST['teacher1Lastname'])) {
            update_post_meta($post_id, 'teacher1Lastname', sanitize_text_field($_POST['teacher1Lastname']));
        }

        if (isset($_POST['teacher2Firstname'])) {
            update_post_meta($post_id, 'teacher2Firstname', sanitize_text_field($_POST['teacher2Firstname']));
        }
        if (isset($_POST['teacher2Lastname'])) {
            update_post_meta($post_id, 'teacher2Lastname', sanitize_text_field($_POST['teacher2Lastname']));
        }

        if (isset($_POST['teacher3Firstname'])) {
            update_post_meta($post_id, 'teacher3Firstname', sanitize_text_field($_POST['teacher3Firstname']));
        }
        if (isset($_POST['teacher3Lastname'])) {
            update_post_meta($post_id, 'teacher3Lastname', sanitize_text_field($_POST['teacher3Lastname']));
        }

        if (isset($_POST['teacher4Firstname'])) {
            update_post_meta($post_id, 'teacher4Firstname', sanitize_text_field($_POST['teacher4Firstname']));
        }
        if (isset($_POST['teacher4Lastname'])) {
            update_post_meta($post_id, 'teacher4Lastname', sanitize_text_field($_POST['teacher4Lastname']));
        }

        if (isset($_POST['teacher5Firstname'])) {
            update_post_meta($post_id, 'teacher5Firstname', sanitize_text_field($_POST['teacher5Firstname']));
        }
        if (isset($_POST['teacher5Lastname'])) {
            update_post_meta($post_id, 'teacher5Lastname', sanitize_text_field($_POST['teacher5Lastname']));
        }
    }
}