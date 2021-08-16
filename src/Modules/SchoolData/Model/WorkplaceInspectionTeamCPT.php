<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register custom post type "workplaceInspectionTeam"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class WorkplaceInspectionTeamCPT {
    public function __construct($plugin) {
        // Add action to register the post type, if the post type does not already exist
        if (!post_type_exists('workplaceInspectionTeam')) {
            $plugin->addAction('init', $this, 'registerPostType');
        }
    }

    // Register Custom Post Type
    public function registerPostType() {
        $labels = array(
            'name'                  => _x('Workplace Inspection Team', 'Post Type General Name', 'wrdsb'),
            'singular_name'         => _x('Workplace Inspection Team', 'Post Type Singular Name', 'wrdsb'),
            'menu_name'             => __('Workplace Inspection Team', 'wrdsb'),
            'name_admin_bar'        => __('Workplace Inspection Team', 'wrdsb'),
            'archives'              => __('Workplace Inspection Team', 'wrdsb'),
            'parent_item_colon'     => __('Workplace Inspection Team:', 'wrdsb'),
            'all_items'             => __('Workplace Inspection Team', 'wrdsb'),
            'add_new_item'          => __('Add New Workplace Inspection Team', 'wrdsb'),
            'add_new'               => __('Add New', 'wrdsb'),
            'new_item'              => __('New Workplace Inspection Team', 'wrdsb'),
            'edit_item'             => __('Edit Workplace Inspection Team', 'wrdsb'),
            'update_item'           => __('Update Workplace Inspection Team', 'wrdsb'),
            'view_item'             => __('View Workplace Inspection Team', 'wrdsb'),
            'search_items'          => __('Search Workplace Inspection Teams', 'wrdsb'),
            'not_found'             => __('Not found', 'wrdsb'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb'),
            'featured_image'        => __('Featured Image', 'wrdsb'),
            'set_featured_image'    => __('Set featured image', 'wrdsb'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb'),
            'insert_into_item'      => __('Insert into Workplace Inspection Team', 'wrdsb'),
            'uploaded_to_this_item' => __('Uploaded to this Workplace Inspection Team', 'wrdsb'),
            'items_list'            => __('Workplace Inspection Teams list', 'wrdsb'),
            'items_list_navigation' => __('Workplace Inspection Teams list navigation', 'wrdsb'),
            'filter_items_list'     => __('Filter Workplace Inspection Teams list', 'wrdsb'),
        );
        $args = array(
            'label'               => __('Workplace Inspection Team', 'wrdsb'),
            'description'         => __('Workplace Inspection Team', 'wrdsb'),
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
                'slug'       => 'workplace-inspection-team',
                'with_front' => false,
            ),
        );
        register_post_type('workplaceInspectionTeam', $args);
    }
}
