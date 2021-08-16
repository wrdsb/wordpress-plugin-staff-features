<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register custom post type "emergencyResponseTeam"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class EmergencyResponseTeamCPT {
    public function __construct($plugin) {
        // Add action to register the post type, if the post type does not already exist
        if (!post_type_exists('emergencyResponseTeam')) {
            $plugin->addAction('init', $this, 'registerPostType');
        }
    }

    // Register Custom Post Type
    public function registerPostType() {
        $labels = array(
            'name'                  => _x('Emergency Response Team', 'Post Type General Name', 'wrdsb'),
            'singular_name'         => _x('Emergency Response Team', 'Post Type Singular Name', 'wrdsb'),
            'menu_name'             => __('Emergency Response Team', 'wrdsb'),
            'name_admin_bar'        => __('Emergency Response Team', 'wrdsb'),
            'archives'              => __('Emergency Response Team', 'wrdsb'),
            'parent_item_colon'     => __('Emergency Response Team:', 'wrdsb'),
            'all_items'             => __('Emergency Response Team', 'wrdsb'),
            'add_new_item'          => __('Add New Emergency Response Team', 'wrdsb'),
            'add_new'               => __('Add New', 'wrdsb'),
            'new_item'              => __('New Emergency Response Team', 'wrdsb'),
            'edit_item'             => __('Edit Emergency Response Team', 'wrdsb'),
            'update_item'           => __('Update Emergency Response Team', 'wrdsb'),
            'view_item'             => __('View Emergency Response Team', 'wrdsb'),
            'search_items'          => __('Search Emergency Response Teams', 'wrdsb'),
            'not_found'             => __('Not found', 'wrdsb'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb'),
            'featured_image'        => __('Featured Image', 'wrdsb'),
            'set_featured_image'    => __('Set featured image', 'wrdsb'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb'),
            'insert_into_item'      => __('Insert into Emergency Response Team', 'wrdsb'),
            'uploaded_to_this_item' => __('Uploaded to this Emergency Response Team', 'wrdsb'),
            'items_list'            => __('Emergency Response Teams list', 'wrdsb'),
            'items_list_navigation' => __('Emergency Response Teams list navigation', 'wrdsb'),
            'filter_items_list'     => __('Filter Emergency Response Teams list', 'wrdsb'),
        );
        $args = array(
            'label'               => __('Emergency Response Team', 'wrdsb'),
            'description'         => __('Emergency Response Team', 'wrdsb'),
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
                'slug'       => 'emergency-response-team',
                'with_front' => false,
            ),
        );
        register_post_type('emergencyResponseTeam', $args);
    }
}