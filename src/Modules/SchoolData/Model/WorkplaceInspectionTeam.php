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
        $plugin->addAction('save_post_workplaceInspectionTeam', $this, 'customMetaSave'); // TODO: prefix with settings_
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

    public function customMetaSave($post_id) {
        // Checks save status
        $is_autosave    = wp_is_post_autosave($post_id);
        $is_revision    = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['wrdsb_nonce']) && wp_verify_nonce($_POST['wrdsb_nonce'], basename(__FILE__))) ? 'true' : 'false';

        // Exits script depending on save status
        if ($is_autosave || $is_revision || ! $is_valid_nonce) {
            return;
        }

        if (isset($_POST['principal_firstname'])) {
            update_post_meta($post_id, 'principal_firstname', sanitize_text_field($_POST['principal_firstname']));
        }
        if (isset($_POST['principal_lastname'])) {
            update_post_meta($post_id, 'principal_lastname', sanitize_text_field($_POST['principal_lastname']));
        }
        if (isset($_POST['principal_affiliation'])) {
            update_post_meta($post_id, 'principal_affiliation', sanitize_text_field($_POST['principal_affiliation']));
        }
        if (isset($_POST['principal_h_s_contact'])) {
            update_post_meta($post_id, 'principal_h_s_contact', sanitize_text_field($_POST['principal_h_s_contact']));
        }

        if (isset($_POST['custodian_firstname'])) {
            update_post_meta($post_id, 'custodian_firstname', sanitize_text_field($_POST['custodian_firstname']));
        }
        if (isset($_POST['custodian_lastname'])) {
            update_post_meta($post_id, 'custodian_lastname', sanitize_text_field($_POST['custodian_lastname']));
        }
        if (isset($_POST['custodian_affiliation'])) {
            update_post_meta($post_id, 'custodian_affiliation', sanitize_text_field($_POST['custodian_affiliation']));
        }
        if (isset($_POST['custodian_h_s_contact'])) {
            update_post_meta($post_id, 'custodian_h_s_contact', sanitize_text_field($_POST['custodian_h_s_contact']));
        }

        if (isset($_POST['staff_member_1_firstname'])) {
            update_post_meta($post_id, 'staff_member_1_firstname', sanitize_text_field($_POST['staff_member_1_firstname']));
        }
        if (isset($_POST['staff_member_1_lastname'])) {
            update_post_meta($post_id, 'staff_member_1_lastname', sanitize_text_field($_POST['staff_member_1_lastname']));
        }
        if (isset($_POST['staff_member_1_affiliation'])) {
            update_post_meta($post_id, 'staff_member_1_affiliation', sanitize_text_field($_POST['staff_member_1_affiliation']));
        }
        if (isset($_POST['staff_member_1_h_s_contact'])) {
            update_post_meta($post_id, 'staff_member_1_h_s_contact', sanitize_text_field($_POST['staff_member_1_h_s_contact']));
        }

        if (isset($_POST['staff_member_2_firstname'])) {
            update_post_meta($post_id, 'staff_member_2_firstname', sanitize_text_field($_POST['staff_member_2_firstname']));
        }
        if (isset($_POST['staff_member_2_lastname'])) {
            update_post_meta($post_id, 'staff_member_2_lastname', sanitize_text_field($_POST['staff_member_2_lastname']));
        }
        if (isset($_POST['staff_member_2_affiliation'])) {
            update_post_meta($post_id, 'staff_member_2_affiliation', sanitize_text_field($_POST['staff_member_2_affiliation']));
        }
        if (isset($_POST['staff_member_2_h_s_contact'])) {
            update_post_meta($post_id, 'staff_member_2_h_s_contact', sanitize_text_field($_POST['staff_member_2_h_s_contact']));
        }

        if (isset($_POST['staff_member_3_firstname'])) {
            update_post_meta($post_id, 'staff_member_3_firstname', sanitize_text_field($_POST['staff_member_3_firstname']));
        }
        if (isset($_POST['staff_member_3_lastname'])) {
            update_post_meta($post_id, 'staff_member_3_lastname', sanitize_text_field($_POST['staff_member_3_lastname']));
        }
        if (isset($_POST['staff_member_3_affiliation'])) {
            update_post_meta($post_id, 'staff_member_3_affiliation', sanitize_text_field($_POST['staff_member_3_affiliation']));
        }
        if (isset($_POST['staff_member_3_h_s_contact'])) {
            update_post_meta($post_id, 'staff_member_3_h_s_contact', sanitize_text_field($_POST['staff_member_3_h_s_contact']));
        }

        if (isset($_POST['staff_member_4_firstname'])) {
            update_post_meta($post_id, 'staff_member_4_firstname', sanitize_text_field($_POST['staff_member_4_firstname']));
        }
        if (isset($_POST['staff_member_4_lastname'])) {
            update_post_meta($post_id, 'staff_member_4_lastname', sanitize_text_field($_POST['staff_member_4_lastname']));
        }
        if (isset($_POST['staff_member_4_affiliation'])) {
            update_post_meta($post_id, 'staff_member_4_affiliation', sanitize_text_field($_POST['staff_member_4_affiliation']));
        }
        if (isset($_POST['staff_member_4_h_s_contact'])) {
            update_post_meta($post_id, 'staff_member_4_h_s_contact', sanitize_text_field($_POST['staff_member_4_h_s_contact']));
        }
    }
}


