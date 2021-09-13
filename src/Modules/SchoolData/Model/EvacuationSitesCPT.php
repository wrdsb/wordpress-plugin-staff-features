<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register custom post type "evacuationSites"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class EvacuationSitesCPT {
    public function __construct($plugin) {
        // Add action to register the post type, if the post type does not already exist
        if (!post_type_exists('evacuationSites')) {
            $plugin->addAction('init', $this, 'registerPostType');
        }
    }

    // Register Custom Post Type
    public function registerPostType() {
        $labels = array(
            'name'                  => _x('Evacuation Sites', 'Post Type General Name', 'wrdsb'),
            'singularName'         => _x('Evacuation Sites', 'Post Type Singular Name', 'wrdsb'),
            'menuName'             => __('Evacuation Sites', 'wrdsb'),
            'name_admin_bar'        => __('Evacuation Sites', 'wrdsb'),
            'archives'              => __('Evacuation Sites', 'wrdsb'),
            'parent_item_colon'     => __('Evacuation Sites:', 'wrdsb'),
            'all_items'             => __('Evacuation Sites', 'wrdsb'),
            'add_new_item'          => __('Add New Evacuation Sites', 'wrdsb'),
            'add_new'               => __('Add New', 'wrdsb'),
            'new_item'              => __('New Evacuation Sites', 'wrdsb'),
            'edit_item'             => __('Edit Evacuation Sites', 'wrdsb'),
            'update_item'           => __('Update Evacuation Sites', 'wrdsb'),
            'view_item'             => __('View Evacuation Sites', 'wrdsb'),
            'search_items'          => __('Search Evacuation Sites', 'wrdsb'),
            'not_found'             => __('Not found', 'wrdsb'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb'),
            'featured_image'        => __('Featured Image', 'wrdsb'),
            'set_featured_image'    => __('Set featured image', 'wrdsb'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb'),
            'insert_into_item'      => __('Insert into Evacuation Sites', 'wrdsb'),
            'uploaded_to_this_item' => __('Uploaded to this Evacuation Sites', 'wrdsb'),
            'items_list'            => __('Evacuation Sites list', 'wrdsb'),
            'items_list_navigation' => __('Evacuation Sites list navigation', 'wrdsb'),
            'filter_items_list'     => __('Filter Evacuation Sites list', 'wrdsb'),
        );
        $args = array(
            'label'               => __('Evacuation Sites', 'wrdsb'),
            'description'         => __('Evacuation Sites', 'wrdsb'),
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
                'slug'       => 'evacuation-sites',
                'with_front' => false,
            ),
        );
        register_post_type('evacuationsites', $args);
    }
}