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
        $plugin->addAction('save_post_evacuationSites', $this, 'customMetaSave'); // TODO: prefix with settings_
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
        register_post_type('evacuationSites', $args);
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

        if (isset($_POST['site1Name'])) {
            update_post_meta($post_id, 'site1Name', sanitize_text_field($_POST['site1Name']));
        }
        if (isset($_POST['site1Address'])) {
            update_post_meta($post_id, 'site1Address', sanitize_text_field($_POST['site1Address']));
        }
        if (isset($_POST['site1City'])) {
            update_post_meta($post_id, 'site1City', sanitize_text_field($_POST['site1City']));
        }
        if (isset($_POST['site1PostalCode'])) {
            update_post_meta($post_id, 'site1PostalCode', sanitize_text_field($_POST['site1PostalCode']));
        }
        if (isset($_POST['site1Firstname'])) {
            update_post_meta($post_id, 'site1Firstname', sanitize_text_field($_POST['site1Firstname']));
        }
        if (isset($_POST['site1Lastname'])) {
            update_post_meta($post_id, 'site1Lastname', sanitize_text_field($_POST['site1Lastname']));
        }
        if (isset($_POST['site1Phone'])) {
            update_post_meta($post_id, 'site1Phone', sanitize_text_field($_POST['site1Phone']));
        }
        if (isset($_POST['site1HoursStart'])) {
            update_post_meta($post_id, 'site1HoursStart', sanitize_text_field($_POST['site1HoursStart']));
        }
        if (isset($_POST['site1HoursEnd'])) {
            update_post_meta($post_id, 'site1HoursEnd', sanitize_text_field($_POST['site1HoursEnd']));
        }

        if (isset($_POST['site2Name'])) {
            update_post_meta($post_id, 'site2Name', sanitize_text_field($_POST['site2Name']));
        }
        if (isset($_POST['site2Address'])) {
            update_post_meta($post_id, 'site2Address', sanitize_text_field($_POST['site2Address']));
        }
        if (isset($_POST['site2City'])) {
            update_post_meta($post_id, 'site2City', sanitize_text_field($_POST['site2City']));
        }
        if (isset($_POST['site2PostalCode'])) {
            update_post_meta($post_id, 'site2PostalCode', sanitize_text_field($_POST['site2PostalCode']));
        }
        if (isset($_POST['site2Firstname'])) {
            update_post_meta($post_id, 'site2Firstname', sanitize_text_field($_POST['site2Firstname']));
        }
        if (isset($_POST['site2Lastname'])) {
            update_post_meta($post_id, 'site2Lastname', sanitize_text_field($_POST['site2Lastname']));
        }
        if (isset($_POST['site2Phone'])) {
            update_post_meta($post_id, 'site2Phone', sanitize_text_field($_POST['site2Phone']));
        }
        if (isset($_POST['site2HoursStart'])) {
            update_post_meta($post_id, 'site2HoursStart', sanitize_text_field($_POST['site2HoursStart']));
        }
        if (isset($_POST['site2HoursEnd'])) {
            update_post_meta($post_id, 'site2HoursEnd', sanitize_text_field($_POST['site2HoursEnd']));
        }

        if (isset($_POST['site3Name'])) {
            update_post_meta($post_id, 'site3Name', sanitize_text_field($_POST['site3Name']));
        }
        if (isset($_POST['site3Address'])) {
            update_post_meta($post_id, 'site3Address', sanitize_text_field($_POST['site3Address']));
        }
        if (isset($_POST['site3City'])) {
            update_post_meta($post_id, 'site3City', sanitize_text_field($_POST['site3City']));
        }
        if (isset($_POST['site3PostalCode'])) {
            update_post_meta($post_id, 'site3PostalCode', sanitize_text_field($_POST['site3PostalCode']));
        }
        if (isset($_POST['site3Firstname'])) {
            update_post_meta($post_id, 'site3Firstname', sanitize_text_field($_POST['site3Firstname']));
        }
        if (isset($_POST['site3Lastname'])) {
            update_post_meta($post_id, 'site3Lastname', sanitize_text_field($_POST['site3Lastname']));
        }
        if (isset($_POST['site3Phone'])) {
            update_post_meta($post_id, 'site3Phone', sanitize_text_field($_POST['site3Phone']));
        }
        if (isset($_POST['site3HoursStart'])) {
            update_post_meta($post_id, 'site3HoursStart', sanitize_text_field($_POST['site3HoursStart']));
        }
        if (isset($_POST['site3HoursEnd'])) {
            update_post_meta($post_id, 'site3HoursEnd', sanitize_text_field($_POST['site3HoursEnd']));
        }

        if (isset($_POST['site4Name'])) {
            update_post_meta($post_id, 'site4Name', sanitize_text_field($_POST['site4Name']));
        }
        if (isset($_POST['site4Address'])) {
            update_post_meta($post_id, 'site4Address', sanitize_text_field($_POST['site4Address']));
        }
        if (isset($_POST['site4City'])) {
            update_post_meta($post_id, 'site4City', sanitize_text_field($_POST['site4City']));
        }
        if (isset($_POST['site4PostalCode'])) {
            update_post_meta($post_id, 'site4PostalCode', sanitize_text_field($_POST['site4PostalCode']));
        }
        if (isset($_POST['site4Firstname'])) {
            update_post_meta($post_id, 'site4Firstname', sanitize_text_field($_POST['site4Firstname']));
        }
        if (isset($_POST['site4Lastname'])) {
            update_post_meta($post_id, 'site4Lastname', sanitize_text_field($_POST['site4Lastname']));
        }
        if (isset($_POST['site4Phone'])) {
            update_post_meta($post_id, 'site4Phone', sanitize_text_field($_POST['site4Phone']));
        }
        if (isset($_POST['site4HoursStart'])) {
            update_post_meta($post_id, 'site4HoursStart', sanitize_text_field($_POST['site4HoursStart']));
        }
        if (isset($_POST['site4HoursEnd'])) {
            update_post_meta($post_id, 'site4HoursEnd', sanitize_text_field($_POST['site4HoursEnd']));
        }
    }
}