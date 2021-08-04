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

        if (isset($_POST['firstname_1'])) {
            update_post_meta($post_id, 'firstname_1', sanitize_text_field($_POST['firstname_1']));
        }
        if (isset($_POST['lastname_1'])) {
            update_post_meta($post_id, 'lastname_1', sanitize_text_field($_POST['lastname_1']));
        }
        if (isset($_POST['cpr_expiry_1'])) {
            update_post_meta($post_id, 'cpr_expiry_1', sanitize_text_field($_POST['cpr_expiry_1']));
        }
        if (isset($_POST['first_aid_expiry_1'])) {
            update_post_meta($post_id, 'first_aid_expiry_1', sanitize_text_field($_POST['first_aid_expiry_1']));
        }
        if (isset($_POST['bms_expiry_1'])) {
            update_post_meta($post_id, 'bms_expiry_1', sanitize_text_field($_POST['bms_expiry_1']));
        }

        if (isset($_POST['firstname_2'])) {
            update_post_meta($post_id, 'firstname_2', sanitize_text_field($_POST['firstname_2']));
        }
        if (isset($_POST['lastname_2'])) {
            update_post_meta($post_id, 'lastname_2', sanitize_text_field($_POST['lastname_2']));
        }
        if (isset($_POST['cpr_expiry_2'])) {
            update_post_meta($post_id, 'cpr_expiry_2', sanitize_text_field($_POST['cpr_expiry_2']));
        }
        if (isset($_POST['first_aid_expiry_2'])) {
            update_post_meta($post_id, 'first_aid_expiry_2', sanitize_text_field($_POST['first_aid_expiry_2']));
        }
        if (isset($_POST['bms_expiry_2'])) {
            update_post_meta($post_id, 'bms_expiry_2', sanitize_text_field($_POST['bms_expiry_2']));
        }

        if (isset($_POST['firstname_3'])) {
            update_post_meta($post_id, 'firstname_3', sanitize_text_field($_POST['firstname_3']));
        }
        if (isset($_POST['lastname_3'])) {
            update_post_meta($post_id, 'lastname_3', sanitize_text_field($_POST['lastname_3']));
        }
        if (isset($_POST['cpr_expiry_3'])) {
            update_post_meta($post_id, 'cpr_expiry_3', sanitize_text_field($_POST['cpr_expiry_3']));
        }
        if (isset($_POST['first_aid_expiry_3'])) {
            update_post_meta($post_id, 'first_aid_expiry_3', sanitize_text_field($_POST['first_aid_expiry_3']));
        }
        if (isset($_POST['bms_expiry_3'])) {
            update_post_meta($post_id, 'bms_expiry_3', sanitize_text_field($_POST['bms_expiry_3']));
        }

        if (isset($_POST['firstname_4'])) {
            update_post_meta($post_id, 'firstname_4', sanitize_text_field($_POST['firstname_4']));
        }
        if (isset($_POST['lastname_4'])) {
            update_post_meta($post_id, 'lastname_4', sanitize_text_field($_POST['lastname_4']));
        }
        if (isset($_POST['cpr_expiry_4'])) {
            update_post_meta($post_id, 'cpr_expiry_4', sanitize_text_field($_POST['cpr_expiry_4']));
        }
        if (isset($_POST['first_aid_expiry_4'])) {
            update_post_meta($post_id, 'first_aid_expiry_4', sanitize_text_field($_POST['first_aid_expiry_4']));
        }
        if (isset($_POST['bms_expiry_4'])) {
            update_post_meta($post_id, 'bms_expiry_4', sanitize_text_field($_POST['bms_expiry_4']));
        }

        if (isset($_POST['firstname_5'])) {
            update_post_meta($post_id, 'firstname_5', sanitize_text_field($_POST['firstname_5']));
        }
        if (isset($_POST['lastname_5'])) {
            update_post_meta($post_id, 'lastname_5', sanitize_text_field($_POST['lastname_5']));
        }
        if (isset($_POST['cpr_expiry_5'])) {
            update_post_meta($post_id, 'cpr_expiry_5', sanitize_text_field($_POST['cpr_expiry_5']));
        }
        if (isset($_POST['first_aid_expiry_5'])) {
            update_post_meta($post_id, 'first_aid_expiry_5', sanitize_text_field($_POST['first_aid_expiry_5']));
        }
        if (isset($_POST['bms_expiry_5'])) {
            update_post_meta($post_id, 'bms_expiry_5', sanitize_text_field($_POST['bms_expiry_5']));
        }

        if (isset($_POST['firstname_6'])) {
            update_post_meta($post_id, 'firstname_6', sanitize_text_field($_POST['firstname_6']));
        }
        if (isset($_POST['lastname_6'])) {
            update_post_meta($post_id, 'lastname_6', sanitize_text_field($_POST['lastname_6']));
        }
        if (isset($_POST['cpr_expiry_6'])) {
            update_post_meta($post_id, 'cpr_expiry_6', sanitize_text_field($_POST['cpr_expiry_6']));
        }
        if (isset($_POST['first_aid_expiry_6'])) {
            update_post_meta($post_id, 'first_aid_expiry_6', sanitize_text_field($_POST['first_aid_expiry_6']));
        }
        if (isset($_POST['bms_expiry_6'])) {
            update_post_meta($post_id, 'bms_expiry_6', sanitize_text_field($_POST['bms_expiry_6']));
        }

        if (isset($_POST['firstname_7'])) {
            update_post_meta($post_id, 'firstname_7', sanitize_text_field($_POST['firstname_7']));
        }
        if (isset($_POST['lastname_7'])) {
            update_post_meta($post_id, 'lastname_7', sanitize_text_field($_POST['lastname_7']));
        }
        if (isset($_POST['cpr_expiry_7'])) {
            update_post_meta($post_id, 'cpr_expiry_7', sanitize_text_field($_POST['cpr_expiry_7']));
        }
        if (isset($_POST['first_aid_expiry_7'])) {
            update_post_meta($post_id, 'first_aid_expiry_7', sanitize_text_field($_POST['first_aid_expiry_7']));
        }
        if (isset($_POST['bms_expiry_7'])) {
            update_post_meta($post_id, 'bms_expiry_7', sanitize_text_field($_POST['bms_expiry_7']));
        }

        if (isset($_POST['firstname_8'])) {
            update_post_meta($post_id, 'firstname_8', sanitize_text_field($_POST['firstname_8']));
        }
        if (isset($_POST['lastname_8'])) {
            update_post_meta($post_id, 'lastname_8', sanitize_text_field($_POST['lastname_8']));
        }
        if (isset($_POST['cpr_expiry_8'])) {
            update_post_meta($post_id, 'cpr_expiry_8', sanitize_text_field($_POST['cpr_expiry_8']));
        }
        if (isset($_POST['first_aid_expiry_8'])) {
            update_post_meta($post_id, 'first_aid_expiry_8', sanitize_text_field($_POST['first_aid_expiry_8']));
        }
        if (isset($_POST['bms_expiry_8'])) {
            update_post_meta($post_id, 'bms_expiry_8', sanitize_text_field($_POST['bms_expiry_8']));
        }

        if (isset($_POST['firstname_9'])) {
            update_post_meta($post_id, 'firstname_9', sanitize_text_field($_POST['firstname_9']));
        }
        if (isset($_POST['lastname_9'])) {
            update_post_meta($post_id, 'lastname_9', sanitize_text_field($_POST['lastname_9']));
        }
        if (isset($_POST['cpr_expiry_9'])) {
            update_post_meta($post_id, 'cpr_expiry_9', sanitize_text_field($_POST['cpr_expiry_9']));
        }
        if (isset($_POST['first_aid_expiry_9'])) {
            update_post_meta($post_id, 'first_aid_expiry_9', sanitize_text_field($_POST['first_aid_expiry_9']));
        }
        if (isset($_POST['bms_expiry_9'])) {
            update_post_meta($post_id, 'bms_expiry_9', sanitize_text_field($_POST['bms_expiry_9']));
        }

        if (isset($_POST['firstname_10'])) {
            update_post_meta($post_id, 'firstname_10', sanitize_text_field($_POST['firstname_10']));
        }
        if (isset($_POST['lastname_10'])) {
            update_post_meta($post_id, 'lastname_10', sanitize_text_field($_POST['lastname_10']));
        }
        if (isset($_POST['cpr_expiry_10'])) {
            update_post_meta($post_id, 'cpr_expiry_10', sanitize_text_field($_POST['cpr_expiry_10']));
        }
        if (isset($_POST['first_aid_expiry_10'])) {
            update_post_meta($post_id, 'first_aid_expiry_10', sanitize_text_field($_POST['first_aid_expiry_10']));
        }
        if (isset($_POST['bms_expiry_10'])) {
            update_post_meta($post_id, 'bms_expiry_10', sanitize_text_field($_POST['bms_expiry_10']));
        }

        if (isset($_POST['firstname_11'])) {
            update_post_meta($post_id, 'firstname_11', sanitize_text_field($_POST['firstname_11']));
        }
        if (isset($_POST['lastname_11'])) {
            update_post_meta($post_id, 'lastname_11', sanitize_text_field($_POST['lastname_11']));
        }
        if (isset($_POST['cpr_expiry_11'])) {
            update_post_meta($post_id, 'cpr_expiry_11', sanitize_text_field($_POST['cpr_expiry_11']));
        }
        if (isset($_POST['first_aid_expiry_11'])) {
            update_post_meta($post_id, 'first_aid_expiry_11', sanitize_text_field($_POST['first_aid_expiry_11']));
        }
        if (isset($_POST['bms_expiry_11'])) {
            update_post_meta($post_id, 'bms_expiry_11', sanitize_text_field($_POST['bms_expiry_11']));
        }

        if (isset($_POST['firstname_12'])) {
            update_post_meta($post_id, 'firstname_12', sanitize_text_field($_POST['firstname_12']));
        }
        if (isset($_POST['lastname_12'])) {
            update_post_meta($post_id, 'lastname_12', sanitize_text_field($_POST['lastname_12']));
        }
        if (isset($_POST['cpr_expiry_12'])) {
            update_post_meta($post_id, 'cpr_expiry_12', sanitize_text_field($_POST['cpr_expiry_12']));
        }
        if (isset($_POST['first_aid_expiry_12'])) {
            update_post_meta($post_id, 'first_aid_expiry_12', sanitize_text_field($_POST['first_aid_expiry_12']));
        }
        if (isset($_POST['bms_expiry_12'])) {
            update_post_meta($post_id, 'bms_expiry_12', sanitize_text_field($_POST['bms_expiry_12']));
        }
    }
}