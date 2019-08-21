<?php
namespace WRDSB\Staff\Modules\ContentCollections\Model;

/**
 * Define and register custom post type "ContentCollection"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/ContentCollections
 * @author     WRDSB <website@wrdsb.ca>
 */

class ContentCollection
{
    // Register Custom Post Type
    public static function registerPostType()
    {
        $labels = array(
            'name'                  => _x('Collections', 'Post Type General Name', 'wrdsb-staff'),
            'singular_name'         => _x('Collection', 'Post Type Singular Name', 'wrdsb-staff'),
            'menu_name'             => __('Collections', 'wrdsb-staff'),
            'name_admin_bar'        => __('Collection', 'wrdsb-staff'),
            'archives'              => __('Collections', 'wrdsb-staff'),
            'parent_item_colon'     => __('Parent Collection:', 'wrdsb-staff'),
            'all_items'             => __('All Collections', 'wrdsb-staff'),
            'add_new_item'          => __('Add New Collection', 'wrdsb-staff'),
            'add_new'               => __('Add New', 'wrdsb-staff'),
            'new_item'              => __('New Collection', 'wrdsb-staff'),
            'edit_item'             => __('Edit Collection', 'wrdsb-staff'),
            'update_item'           => __('Update Collection', 'wrdsb-staff'),
            'view_item'             => __('View Collection', 'wrdsb-staff'),
            'search_items'          => __('Search Collections', 'wrdsb-staff'),
            'not_found'             => __('Not found', 'wrdsb-staff'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb-staff'),
            'featured_image'        => __('Featured Image', 'wrdsb-staff'),
            'set_featured_image'    => __('Set featured image', 'wrdsb-staff'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb-staff'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb-staff'),
            'insert_into_item'      => __('Insert into Collection', 'wrdsb-staff'),
            'uploaded_to_this_item' => __('Uploaded to this Collection', 'wrdsb-staff'),
            'items_list'            => __('Collections list', 'wrdsb-staff'),
            'items_list_navigation' => __('Collections list navigation', 'wrdsb-staff'),
            'filter_items_list'     => __('Filter Collection list', 'wrdsb-staff'),
        );
        $args = array(
            'label'               => __('Collection', 'wrdsb-staff'),
            'description'         => __('Collection', 'wrdsb-staff'),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'taxonomies'          => array(),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'rewrite'             => array(
                'slug'       => 'collections',
                'with_front' => false,
            ),
        );
        register_post_type('content_collection', $args);
    }
}
