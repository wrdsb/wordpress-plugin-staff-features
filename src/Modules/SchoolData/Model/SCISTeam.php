<?php
namespace WRDSB\Staff\Modules\SchoolData\Model;
use WRDSB\Staff\Modules\WP\WPCore as WPCore;

/**
 * Define and register custom post type "scisTeam"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    Staff Features
 * @subpackage School Data
 */

class SCISTeamCPT {
    public function __construct($plugin) {
        // Add action to register the post type, if the post type does not already exist
        if (!post_type_exists('scisTeam')) {
            $plugin->addAction('init', $this, 'registerPostType');
        }
        $plugin->addAction('save_post_scisTeam', $this, 'customMetaSave'); // TODO: prefix with settings_
    }

    // Register Custom Post Type
    public function registerPostType() {
        $labels = array(
            'name'                  => _x('SCIS Team', 'Post Type General Name', 'wrdsb'),
            'singular_name'         => _x('SCIS Team', 'Post Type Singular Name', 'wrdsb'),
            'menu_name'             => __('SCIS Team', 'wrdsb'),
            'name_admin_bar'        => __('SCIS Team', 'wrdsb'),
            'archives'              => __('SCIS Team', 'wrdsb'),
            'parent_item_colon'     => __('SCIS Team:', 'wrdsb'),
            'all_items'             => __('SCIS Team', 'wrdsb'),
            'add_new_item'          => __('Add New SCIS Team', 'wrdsb'),
            'add_new'               => __('Add New', 'wrdsb'),
            'new_item'              => __('New SCIS Team', 'wrdsb'),
            'edit_item'             => __('Edit SCIS Team', 'wrdsb'),
            'update_item'           => __('Update SCIS Team', 'wrdsb'),
            'view_item'             => __('View SCIS Team', 'wrdsb'),
            'search_items'          => __('Search SCIS Teams', 'wrdsb'),
            'not_found'             => __('Not found', 'wrdsb'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb'),
            'featured_image'        => __('Featured Image', 'wrdsb'),
            'set_featured_image'    => __('Set featured image', 'wrdsb'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb'),
            'insert_into_item'      => __('Insert into SCIS Team', 'wrdsb'),
            'uploaded_to_this_item' => __('Uploaded to this SCIS Team', 'wrdsb'),
            'items_list'            => __('SCIS Teams list', 'wrdsb'),
            'items_list_navigation' => __('SCIS Teams list navigation', 'wrdsb'),
            'filter_items_list'     => __('Filter SCIS Teams list', 'wrdsb'),
        );
        $args = array(
            'label'               => __('SCIS Team', 'wrdsb'),
            'description'         => __('SCIS Team', 'wrdsb'),
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
                'slug'       => 'scis-team',
                'with_front' => false,
            ),
        );
        register_post_type('scisTeam', $args);
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

        if (isset($_POST['administratorFirstname'])) {
            update_post_meta($post_id, 'administratorFirstname', sanitize_text_field($_POST['administratorFirstname']));
        }
        if (isset($_POST['administratorLastname'])) {
            update_post_meta($post_id, 'administratorLastname', sanitize_text_field($_POST['administratorLastname']));
        }
        if (isset($_POST['administratorIELiasion'])) {
            update_post_meta($post_id, 'administratorIELiasion', sanitize_text_field($_POST['administratorIELiasion']));
        }

        if (isset($_POST['teacherFirstname'])) {
            update_post_meta($post_id, 'teacherFirstname', sanitize_text_field($_POST['teacherFirstname']));
        }
        if (isset($_POST['teacherLastname'])) {
            update_post_meta($post_id, 'teacherLastname', sanitize_text_field($_POST['teacherLastname']));
        }
        if (isset($_POST['teacherIELiasion'])) {
            update_post_meta($post_id, 'teacherIELiasion', sanitize_text_field($_POST['teacherIELiasion']));
        }

        if (isset($_POST['paraprofessionalFirstname'])) {
            update_post_meta($post_id, 'paraprofessionalFirstname', sanitize_text_field($_POST['paraprofessionalFirstname']));
        }
        if (isset($_POST['paraprofessionalLastname'])) {
            update_post_meta($post_id, 'paraprofessionalLastname', sanitize_text_field($_POST['paraprofessionalLastname']));
        }
        if (isset($_POST['paraprofessionalIELiasion'])) {
            update_post_meta($post_id, 'paraprofessionalIELiasion', sanitize_text_field($_POST['paraprofessionalIELiasion']));
        }

        if (isset($_POST['parentFirstname'])) {
            update_post_meta($post_id, 'parentFirstname', sanitize_text_field($_POST['parentFirstname']));
        }
        if (isset($_POST['parentLastname'])) {
            update_post_meta($post_id, 'parentLastname', sanitize_text_field($_POST['parentLastname']));
        }
        if (isset($_POST['parentIELiasion'])) {
            update_post_meta($post_id, 'parentIELiasion', sanitize_text_field($_POST['parentIELiasion']));
        }

        if (isset($_POST['communityMemberFirstname'])) {
            update_post_meta($post_id, 'communityMemberFirstname', sanitize_text_field($_POST['communityMemberFirstname']));
        }
        if (isset($_POST['communityMemberLastname'])) {
            update_post_meta($post_id, 'communityMemberLastname', sanitize_text_field($_POST['communityMemberLastname']));
        }
        if (isset($_POST['communityMemberIELiasion'])) {
            update_post_meta($post_id, 'communityMemberIELiasion', sanitize_text_field($_POST['communityMemberIELiasion']));
        }

        if (isset($_POST['student1Firstname'])) {
            update_post_meta($post_id, 'student1Firstname', sanitize_text_field($_POST['student1Firstname']));
        }
        if (isset($_POST['student1Lastname'])) {
            update_post_meta($post_id, 'student1Lastname', sanitize_text_field($_POST['student1Lastname']));
        }
        if (isset($_POST['student1IELiasion'])) {
            update_post_meta($post_id, 'student1IELiasion', sanitize_text_field($_POST['student1IELiasion']));
        }

        if (isset($_POST['student2Firstname'])) {
            update_post_meta($post_id, 'student2Firstname', sanitize_text_field($_POST['student2Firstname']));
        }
        if (isset($_POST['student2Lastname'])) {
            update_post_meta($post_id, 'student2Lastname', sanitize_text_field($_POST['student2Lastname']));
        }
        if (isset($_POST['student2IELiasion'])) {
            update_post_meta($post_id, 'student2IELiasion', sanitize_text_field($_POST['student2IELiasion']));
        }

        if (isset($_POST['optional1Firstname'])) {
            update_post_meta($post_id, 'optional1Firstname', sanitize_text_field($_POST['optional1Firstname']));
        }
        if (isset($_POST['optional1Lastname'])) {
            update_post_meta($post_id, 'optional1Lastname', sanitize_text_field($_POST['optional1Lastname']));
        }
        if (isset($_POST['optional1IELiasion'])) {
            update_post_meta($post_id, 'optional1IELiasion', sanitize_text_field($_POST['optional1IELiasion']));
        }

        if (isset($_POST['optional2Firstname'])) {
            update_post_meta($post_id, 'optional2Firstname', sanitize_text_field($_POST['optional2Firstname']));
        }
        if (isset($_POST['optional2Lastname'])) {
            update_post_meta($post_id, 'optional2Lastname', sanitize_text_field($_POST['optional2Lastname']));
        }
        if (isset($_POST['optional2IELiasion'])) {
            update_post_meta($post_id, 'optional2IELiasion', sanitize_text_field($_POST['optional2IELiasion']));
        }

        if (isset($_POST['optional3Firstname'])) {
            update_post_meta($post_id, 'optional3Firstname', sanitize_text_field($_POST['optional3Firstname']));
        }
        if (isset($_POST['optional3Lastname'])) {
            update_post_meta($post_id, 'optional3Lastname', sanitize_text_field($_POST['optional3Lastname']));
        }
        if (isset($_POST['optional3IELiasion'])) {
            update_post_meta($post_id, 'optional3IELiasion', sanitize_text_field($_POST['optional3IELiasion']));
        }

        if (isset($_POST['optional4Firstname'])) {
            update_post_meta($post_id, 'optional4Firstname', sanitize_text_field($_POST['optional4Firstname']));
        }
        if (isset($_POST['optional4Lastname'])) {
            update_post_meta($post_id, 'optional4Lastname', sanitize_text_field($_POST['optional4Lastname']));
        }
        if (isset($_POST['optional4IELiasion'])) {
            update_post_meta($post_id, 'optional4IELiasion', sanitize_text_field($_POST['optional4IELiasion']));
        }

        if (isset($_POST['optional5Firstname'])) {
            update_post_meta($post_id, 'optional5Firstname', sanitize_text_field($_POST['optional5Firstname']));
        }
        if (isset($_POST['optional5Lastname'])) {
            update_post_meta($post_id, 'optional5Lastname', sanitize_text_field($_POST['optional5Lastname']));
        }
        if (isset($_POST['optional5IELiasion'])) {
            update_post_meta($post_id, 'optional5IELiasion', sanitize_text_field($_POST['optional5IELiasion']));
        }
    }
}