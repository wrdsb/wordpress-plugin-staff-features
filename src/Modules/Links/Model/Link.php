<?php
namespace WRDSB\Staff\Modules\Links\Model;

/**
 * Define and register custom post type "Link"
 * *
 * @link       https://www.wrdsb.ca
 * @since      1.0.0
 *
 * @package    WRDSB_Staff
 * @subpackage WRDSB_Staff/Links
 * @author     WRDSB <website@wrdsb.ca>
 */

class Link
{
    public static function init()
    {

    }

    // Register Custom Post Type
    public static function registerPostType()
    {
        $labels = array(
            'name'                  => _x('Links', 'Post Type General Name', 'wrdsb-staff'),
            'singular_name'         => _x('Link', 'Post Type Singular Name', 'wrdsb-staff'),
            'menu_name'             => __('Links', 'wrdsb-staff'),
            'name_admin_bar'        => __('Link', 'wrdsb-staff'),
            'archives'              => __('Links', 'wrdsb-staff'),
            'parent_item_colon'     => __('Parent Link:', 'wrdsb-staff'),
            'all_items'             => __('All Links', 'wrdsb-staff'),
            'add_new_item'          => __('Add New Link', 'wrdsb-staff'),
            'add_new'               => __('Add New', 'wrdsb-staff'),
            'new_item'              => __('New Link', 'wrdsb-staff'),
            'edit_item'             => __('Edit Link', 'wrdsb-staff'),
            'update_item'           => __('Update Link', 'wrdsb-staff'),
            'view_item'             => __('View Link', 'wrdsb-staff'),
            'search_items'          => __('Search Links', 'wrdsb-staff'),
            'not_found'             => __('Not found', 'wrdsb-staff'),
            'not_found_in_trash'    => __('Not found in Trash', 'wrdsb-staff'),
            'featured_image'        => __('Featured Image', 'wrdsb-staff'),
            'set_featured_image'    => __('Set featured image', 'wrdsb-staff'),
            'remove_featured_image' => __('Remove featured image', 'wrdsb-staff'),
            'use_featured_image'    => __('Use as featured image', 'wrdsb-staff'),
            'insert_into_item'      => __('Insert into Link', 'wrdsb-staff'),
            'uploaded_to_this_item' => __('Uploaded to this Link', 'wrdsb-staff'),
            'items_list'            => __('Links list', 'wrdsb-staff'),
            'items_list_navigation' => __('Links list navigation', 'wrdsb-staff'),
            'filter_items_list'     => __('Filter Link list', 'wrdsb-staff'),
        );
        $args = array(
            'label'               => __('Link', 'wrdsb-staff'),
            'description'         => __('Link', 'wrdsb-staff'),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'taxonomies'          => array( 'category', 'post_tag' ),
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
                'slug'       => 'links',
                'with_front' => false,
            ),
        );
        register_post_type('rich_link', $args);
    }

    public static function registerMetaBoxes($meta_boxes)
    {
        $prefix = 'richlinks_';

        $meta_boxes[] = array(
            'id' => 'richlinks_settings',
            'title' => esc_html__('Link Settings', 'default'),
            'post_types' => array('rich_link'),
            'context' => 'after_title',
            'priority' => 'default',
            'autosave' => 'true',
            'fields' => array(
                array(
                    'id' => $prefix . 'url',
                    'name' => esc_html__('Link URL', 'default'),
                    'type' => 'text',
                    'desc' => esc_html__('', 'default'),
                    'placeholder' => 'https://www.wrdsb.ca/',
                    'size' => 50,
                ),
                array(
                    'id' => $prefix . 'short_title',
                    'name' => esc_html__('Short Title', 'default'),
                    'type' => 'text',
                    'desc' => esc_html__('A short label used in menus, etc.', 'default'),
                    'placeholder' => 'Very Brief',
                    'size' => 30,
                ),
                array(
                    'id' => $prefix . 'type',
                    'name' => esc_html__('Link Type', 'default'),
                    'type' => 'select',
                    'options' => array(
                        'wrdsb' => 'WRDSB Website',
                        'gdrive' => 'WRDSB G Suite (Drive, Docs, Sheets, etc.)',
                        'gov' => 'Government / Ministry document',
                        'image' => 'Image',
                        'video' => 'Video',
                        'audio' => 'Audio',
                        'file' => 'Downloadable File (PDF. XLS, etc.)',

                    ),
                ),
            )
        );

        return $meta_boxes;
    }
}
