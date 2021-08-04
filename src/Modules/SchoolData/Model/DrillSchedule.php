<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register custom post type "DrillSchedule"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class DrillScheduleCPT {
    public function __construct($plugin) {
        // Add action to register the post type, if the post type does not already exist
        if (!post_type_exists('drillSchedule')) {
            $plugin->addAction('init', $this, 'registerPostType');
        }
        $plugin->addAction('save_post_drillSchedule', $this, 'customMetaSave'); // TODO: prefix with settings_
    }

    // Register Custom Post Type
    public function registerPostType() {
        $labels = array(
            'name'                  => _x('Drill Schedule', 'Post Type General Name', 'wrdsb'),
            'singular_name'         => _x('Drill Schedule', 'Post Type Singular Name', 'wrdsb'),
            'menu_name'             => __('Drill Schedule', 'wrdsb'),
            'name_admin_bar'        => __('Drill Schedule', 'wrdsb'),
            'archives'              => __('Drill Schedule', 'wrdsb'),
            'parent_item_colon'     => __('Drill Schedule:', 'wrdsb'),
            'all_items'             => __('Drill Schedule', 'wrdsb'),
            'add_new_item'          => __('Add New Drill Schedule', 'wrdsb'),
            'add_new'               => __('Add New', 'wrdsb'),
            'new_item'              => __('New Drill Schedule', 'wrdsb'),
            'edit_item'             => __('Edit Drill Schedule', 'wrdsb'),
            'update_item'           => __('Update Drill Schedule', 'wrdsb'),
            'view_item'             => __('View Drill Schedule', 'wrdsb'),
            'search_items'          => __('Search Drill Schedules', 'wrdsb'),
            'not_found'             => __('Not found', 'wrdsb'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb'),
            'featured_image'        => __('Featured Image', 'wrdsb'),
            'set_featured_image'    => __('Set featured image', 'wrdsb'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb'),
            'insert_into_item'      => __('Insert into drill schedule', 'wrdsb'),
            'uploaded_to_this_item' => __('Uploaded to this drill schedule', 'wrdsb'),
            'items_list'            => __('Drill Schedules list', 'wrdsb'),
            'items_list_navigation' => __('Drill Schedules list navigation', 'wrdsb'),
            'filter_items_list'     => __('Filter Drill Schedules list', 'wrdsb'),
        );
        $args = array(
            'label'               => __('Drill Schedule', 'wrdsb'),
            'description'         => __('Drill Schedule', 'wrdsb'),
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
                'slug'       => 'drill-schedules',
                'with_front' => false,
            ),
        );
        register_post_type('drillSchedule', $args);
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

        if (isset($_POST['fire_drill_1_date'])) {
            update_post_meta($post_id, 'fire_drill_1_date', sanitize_text_field($_POST['fire_drill_1_date']));
        }
        if (isset($_POST['fire_drill_1_time'])) {
            update_post_meta($post_id, 'fire_drill_1_time', sanitize_text_field($_POST['fire_drill_1_time']));
        }
        if (isset($_POST['fire_drill_2_date'])) {
            update_post_meta($post_id, 'fire_drill_2_date', sanitize_text_field($_POST['fire_drill_2_date']));
        }
        if (isset($_POST['fire_drill_2_time'])) {
            update_post_meta($post_id, 'fire_drill_2_time', sanitize_text_field($_POST['fire_drill_2_time']));
        }
        if (isset($_POST['fire_drill_3_date'])) {
            update_post_meta($post_id, 'fire_drill_3_date', sanitize_text_field($_POST['fire_drill_3_date']));
        }
        if (isset($_POST['fire_drill_3_time'])) {
            update_post_meta($post_id, 'fire_drill_3_time', sanitize_text_field($_POST['fire_drill_3_time']));
        }
        if (isset($_POST['fire_drill_4_date'])) {
            update_post_meta($post_id, 'fire_drill_4_date', sanitize_text_field($_POST['fire_drill_4_date']));
        }
        if (isset($_POST['fire_drill_4_time'])) {
            update_post_meta($post_id, 'fire_drill_4_time', sanitize_text_field($_POST['fire_drill_4_time']));
        }
        if (isset($_POST['fire_drill_5_date'])) {
            update_post_meta($post_id, 'fire_drill_5_date', sanitize_text_field($_POST['fire_drill_5_date']));
        }
        if (isset($_POST['fire_drill_5_time'])) {
            update_post_meta($post_id, 'fire_drill_5_time', sanitize_text_field($_POST['fire_drill_5_time']));
        }
        if (isset($_POST['bomb_drill_1_date'])) {
            update_post_meta($post_id, 'bomb_drill_1_date', sanitize_text_field($_POST['bomb_drill_1_date']));
        }
        if (isset($_POST['bomb_drill_1_time'])) {
            update_post_meta($post_id, 'bomb_drill_1_time', sanitize_text_field($_POST['bomb_drill_1_time']));
        }
    }
}