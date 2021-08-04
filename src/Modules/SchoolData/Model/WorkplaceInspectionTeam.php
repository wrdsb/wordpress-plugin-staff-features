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

        if (isset($_POST['principalFirstname'])) {
            update_post_meta($post_id, 'principalFirstname', sanitize_text_field($_POST['principalFirstname']));
        }
        if (isset($_POST['principalLastname'])) {
            update_post_meta($post_id, 'principalLastname', sanitize_text_field($_POST['principalLastname']));
        }
        if (isset($_POST['principalAffiliation'])) {
            update_post_meta($post_id, 'principalAffiliation', sanitize_text_field($_POST['principalAffiliation']));
        }
        if (isset($_POST['principalHSContact'])) {
            update_post_meta($post_id, 'principalHSContact', sanitize_text_field($_POST['principalHSContact']));
        }

        if (isset($_POST['custodianFirstname'])) {
            update_post_meta($post_id, 'custodianFirstname', sanitize_text_field($_POST['custodianFirstname']));
        }
        if (isset($_POST['custodianLastname'])) {
            update_post_meta($post_id, 'custodianLastname', sanitize_text_field($_POST['custodianLastname']));
        }
        if (isset($_POST['custodianAffiliation'])) {
            update_post_meta($post_id, 'custodianAffiliation', sanitize_text_field($_POST['custodianAffiliation']));
        }
        if (isset($_POST['custodianHSContact'])) {
            update_post_meta($post_id, 'custodianHSContact', sanitize_text_field($_POST['custodianHSContact']));
        }

        if (isset($_POST['staffMember1Firstname'])) {
            update_post_meta($post_id, 'staffMember1Firstname', sanitize_text_field($_POST['staffMember1Firstname']));
        }
        if (isset($_POST['staffMember1Lastname'])) {
            update_post_meta($post_id, 'staffMember1Lastname', sanitize_text_field($_POST['staffMember1Lastname']));
        }
        if (isset($_POST['staffMember1Affiliation'])) {
            update_post_meta($post_id, 'staffMember1Affiliation', sanitize_text_field($_POST['staffMember1Affiliation']));
        }
        if (isset($_POST['staffMember1HSContact'])) {
            update_post_meta($post_id, 'staffMember1HSContact', sanitize_text_field($_POST['staffMember1HSContact']));
        }

        if (isset($_POST['staffMember2Firstname'])) {
            update_post_meta($post_id, 'staffMember2Firstname', sanitize_text_field($_POST['staffMember2Firstname']));
        }
        if (isset($_POST['staffMember2Lastname'])) {
            update_post_meta($post_id, 'staffMember2Lastname', sanitize_text_field($_POST['staffMember2Lastname']));
        }
        if (isset($_POST['staffMember2Affiliation'])) {
            update_post_meta($post_id, 'staffMember2Affiliation', sanitize_text_field($_POST['staffMember2Affiliation']));
        }
        if (isset($_POST['staffMember2HSContact'])) {
            update_post_meta($post_id, 'staffMember2HSContact', sanitize_text_field($_POST['staffMember2HSContact']));
        }

        if (isset($_POST['staffMember3Firstname'])) {
            update_post_meta($post_id, 'staffMember3Firstname', sanitize_text_field($_POST['staffMember3Firstname']));
        }
        if (isset($_POST['staffMember3Lastname'])) {
            update_post_meta($post_id, 'staffMember3Lastname', sanitize_text_field($_POST['staffMember3Lastname']));
        }
        if (isset($_POST['staffMember3Affiliation'])) {
            update_post_meta($post_id, 'staffMember3Affiliation', sanitize_text_field($_POST['staffMember3Affiliation']));
        }
        if (isset($_POST['staffMember3HSContact'])) {
            update_post_meta($post_id, 'staffMember3HSContact', sanitize_text_field($_POST['staffMember3HSContact']));
        }

        if (isset($_POST['staffMember4Firstname'])) {
            update_post_meta($post_id, 'staffMember4Firstname', sanitize_text_field($_POST['staffMember4Firstname']));
        }
        if (isset($_POST['staffMember4Lastname'])) {
            update_post_meta($post_id, 'staffMember4Lastname', sanitize_text_field($_POST['staffMember4Lastname']));
        }
        if (isset($_POST['staffMember4Affiliation'])) {
            update_post_meta($post_id, 'staffMember4Affiliation', sanitize_text_field($_POST['staffMember4Affiliation']));
        }
        if (isset($_POST['staffMember4HSContact'])) {
            update_post_meta($post_id, 'staffMember4HSContact', sanitize_text_field($_POST['staffMember4HSContact']));
        }
    }
}


