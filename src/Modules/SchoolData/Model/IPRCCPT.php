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
}