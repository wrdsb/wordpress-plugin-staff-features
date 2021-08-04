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
        $plugin->addAction('save_post_emergencyResponseTeam', $this, 'customMetaSave'); // TODO: prefix with settings_
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

    public function customMetaSave($post_id) {
        // Checks save status
        $is_autosave    = wp_is_post_autosave($post_id);
        $is_revision    = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['wrdsb_nonce']) && wp_verify_nonce($_POST['wrdsb_nonce'], basename(__FILE__))) ? 'true' : 'false';

        // Exits script depending on save status
        if ($is_autosave || $is_revision || ! $is_valid_nonce) {
            return;
        }

        if (isset($_POST['firstname1'])) {
            update_post_meta($post_id, 'firstname1', sanitize_text_field($_POST['firstname1']));
        }
        if (isset($_POST['lastname1'])) {
            update_post_meta($post_id, 'lastname1', sanitize_text_field($_POST['lastname1']));
        }
        if (isset($_POST['cprExpiry1'])) {
            update_post_meta($post_id, 'cprExpiry1', sanitize_text_field($_POST['cprExpiry1']));
        }
        if (isset($_POST['firstAidExpiry1'])) {
            update_post_meta($post_id, 'firstAidExpiry1', sanitize_text_field($_POST['firstAidExpiry1']));
        }
        if (isset($_POST['bmsExpiry1'])) {
            update_post_meta($post_id, 'bmsExpiry1', sanitize_text_field($_POST['bmsExpiry1']));
        }

        if (isset($_POST['firstname2'])) {
            update_post_meta($post_id, 'firstname2', sanitize_text_field($_POST['firstname2']));
        }
        if (isset($_POST['lastname2'])) {
            update_post_meta($post_id, 'lastname2', sanitize_text_field($_POST['lastname2']));
        }
        if (isset($_POST['cprExpiry2'])) {
            update_post_meta($post_id, 'cprExpiry2', sanitize_text_field($_POST['cprExpiry2']));
        }
        if (isset($_POST['firstAidExpiry2'])) {
            update_post_meta($post_id, 'firstAidExpiry2', sanitize_text_field($_POST['firstAidExpiry2']));
        }
        if (isset($_POST['bmsExpiry2'])) {
            update_post_meta($post_id, 'bmsExpiry2', sanitize_text_field($_POST['bmsExpiry2']));
        }

        if (isset($_POST['firstname3'])) {
            update_post_meta($post_id, 'firstname3', sanitize_text_field($_POST['firstname3']));
        }
        if (isset($_POST['lastname3'])) {
            update_post_meta($post_id, 'lastname3', sanitize_text_field($_POST['lastname3']));
        }
        if (isset($_POST['cprExpiry3'])) {
            update_post_meta($post_id, 'cprExpiry3', sanitize_text_field($_POST['cprExpiry3']));
        }
        if (isset($_POST['firstAidExpiry3'])) {
            update_post_meta($post_id, 'firstAidExpiry3', sanitize_text_field($_POST['firstAidExpiry3']));
        }
        if (isset($_POST['bmsExpiry3'])) {
            update_post_meta($post_id, 'bmsExpiry3', sanitize_text_field($_POST['bmsExpiry3']));
        }

        if (isset($_POST['firstname4'])) {
            update_post_meta($post_id, 'firstname4', sanitize_text_field($_POST['firstname4']));
        }
        if (isset($_POST['lastname4'])) {
            update_post_meta($post_id, 'lastname4', sanitize_text_field($_POST['lastname4']));
        }
        if (isset($_POST['cprExpiry4'])) {
            update_post_meta($post_id, 'cprExpiry4', sanitize_text_field($_POST['cprExpiry4']));
        }
        if (isset($_POST['firstAidExpiry4'])) {
            update_post_meta($post_id, 'firstAidExpiry4', sanitize_text_field($_POST['firstAidExpiry4']));
        }
        if (isset($_POST['bmsExpiry4'])) {
            update_post_meta($post_id, 'bmsExpiry4', sanitize_text_field($_POST['bmsExpiry4']));
        }

        if (isset($_POST['firstname5'])) {
            update_post_meta($post_id, 'firstname5', sanitize_text_field($_POST['firstname5']));
        }
        if (isset($_POST['lastname5'])) {
            update_post_meta($post_id, 'lastname5', sanitize_text_field($_POST['lastname5']));
        }
        if (isset($_POST['cprExpiry5'])) {
            update_post_meta($post_id, 'cprExpiry5', sanitize_text_field($_POST['cprExpiry5']));
        }
        if (isset($_POST['firstAidExpiry5'])) {
            update_post_meta($post_id, 'firstAidExpiry5', sanitize_text_field($_POST['firstAidExpiry5']));
        }
        if (isset($_POST['bmsExpiry5'])) {
            update_post_meta($post_id, 'bmsExpiry5', sanitize_text_field($_POST['bmsExpiry5']));
        }

        if (isset($_POST['firstname6'])) {
            update_post_meta($post_id, 'firstname6', sanitize_text_field($_POST['firstname6']));
        }
        if (isset($_POST['lastname6'])) {
            update_post_meta($post_id, 'lastname6', sanitize_text_field($_POST['lastname6']));
        }
        if (isset($_POST['cprExpiry6'])) {
            update_post_meta($post_id, 'cprExpiry6', sanitize_text_field($_POST['cprExpiry6']));
        }
        if (isset($_POST['firstAidExpiry6'])) {
            update_post_meta($post_id, 'firstAidExpiry6', sanitize_text_field($_POST['firstAidExpiry6']));
        }
        if (isset($_POST['bmsExpiry6'])) {
            update_post_meta($post_id, 'bmsExpiry6', sanitize_text_field($_POST['bmsExpiry6']));
        }

        if (isset($_POST['firstname7'])) {
            update_post_meta($post_id, 'firstname7', sanitize_text_field($_POST['firstname7']));
        }
        if (isset($_POST['lastname7'])) {
            update_post_meta($post_id, 'lastname7', sanitize_text_field($_POST['lastname7']));
        }
        if (isset($_POST['cprExpiry7'])) {
            update_post_meta($post_id, 'cprExpiry7', sanitize_text_field($_POST['cprExpiry7']));
        }
        if (isset($_POST['firstAidExpiry7'])) {
            update_post_meta($post_id, 'firstAidExpiry7', sanitize_text_field($_POST['firstAidExpiry7']));
        }
        if (isset($_POST['bmsExpiry7'])) {
            update_post_meta($post_id, 'bmsExpiry7', sanitize_text_field($_POST['bmsExpiry7']));
        }

        if (isset($_POST['firstname8'])) {
            update_post_meta($post_id, 'firstname8', sanitize_text_field($_POST['firstname8']));
        }
        if (isset($_POST['lastname8'])) {
            update_post_meta($post_id, 'lastname8', sanitize_text_field($_POST['lastname8']));
        }
        if (isset($_POST['cprExpiry8'])) {
            update_post_meta($post_id, 'cprExpiry8', sanitize_text_field($_POST['cprExpiry8']));
        }
        if (isset($_POST['firstAidExpiry8'])) {
            update_post_meta($post_id, 'firstAidExpiry8', sanitize_text_field($_POST['firstAidExpiry8']));
        }
        if (isset($_POST['bmsExpiry8'])) {
            update_post_meta($post_id, 'bmsExpiry8', sanitize_text_field($_POST['bmsExpiry8']));
        }

        if (isset($_POST['firstname9'])) {
            update_post_meta($post_id, 'firstname9', sanitize_text_field($_POST['firstname9']));
        }
        if (isset($_POST['lastname9'])) {
            update_post_meta($post_id, 'lastname9', sanitize_text_field($_POST['lastname9']));
        }
        if (isset($_POST['cprExpiry9'])) {
            update_post_meta($post_id, 'cprExpiry9', sanitize_text_field($_POST['cprExpiry9']));
        }
        if (isset($_POST['firstAidExpiry9'])) {
            update_post_meta($post_id, 'firstAidExpiry9', sanitize_text_field($_POST['firstAidExpiry9']));
        }
        if (isset($_POST['bmsExpiry9'])) {
            update_post_meta($post_id, 'bmsExpiry9', sanitize_text_field($_POST['bmsExpiry9']));
        }

        if (isset($_POST['firstname10'])) {
            update_post_meta($post_id, 'firstname10', sanitize_text_field($_POST['firstname10']));
        }
        if (isset($_POST['lastname10'])) {
            update_post_meta($post_id, 'lastname10', sanitize_text_field($_POST['lastname10']));
        }
        if (isset($_POST['cprExpiry10'])) {
            update_post_meta($post_id, 'cprExpiry10', sanitize_text_field($_POST['cprExpiry10']));
        }
        if (isset($_POST['firstAidExpiry10'])) {
            update_post_meta($post_id, 'firstAidExpiry10', sanitize_text_field($_POST['firstAidExpiry10']));
        }
        if (isset($_POST['bmsExpiry10'])) {
            update_post_meta($post_id, 'bmsExpiry10', sanitize_text_field($_POST['bmsExpiry10']));
        }

        if (isset($_POST['firstname11'])) {
            update_post_meta($post_id, 'firstname11', sanitize_text_field($_POST['firstname11']));
        }
        if (isset($_POST['lastname11'])) {
            update_post_meta($post_id, 'lastname11', sanitize_text_field($_POST['lastname11']));
        }
        if (isset($_POST['cprExpiry11'])) {
            update_post_meta($post_id, 'cprExpiry11', sanitize_text_field($_POST['cprExpiry11']));
        }
        if (isset($_POST['firstAidExpiry11'])) {
            update_post_meta($post_id, 'firstAidExpiry11', sanitize_text_field($_POST['firstAidExpiry11']));
        }
        if (isset($_POST['bmsExpiry11'])) {
            update_post_meta($post_id, 'bmsExpiry11', sanitize_text_field($_POST['bmsExpiry11']));
        }

        if (isset($_POST['firstname12'])) {
            update_post_meta($post_id, 'firstname12', sanitize_text_field($_POST['firstname12']));
        }
        if (isset($_POST['lastname12'])) {
            update_post_meta($post_id, 'lastname12', sanitize_text_field($_POST['lastname12']));
        }
        if (isset($_POST['cprExpiry12'])) {
            update_post_meta($post_id, 'cprExpiry12', sanitize_text_field($_POST['cprExpiry12']));
        }
        if (isset($_POST['firstAidExpiry12'])) {
            update_post_meta($post_id, 'firstAidExpiry12', sanitize_text_field($_POST['firstAidExpiry12']));
        }
        if (isset($_POST['bmsExpiry12'])) {
            update_post_meta($post_id, 'bmsExpiry12', sanitize_text_field($_POST['bmsExpiry12']));
        }
    }
}