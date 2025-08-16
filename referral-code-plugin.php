<?php
/**
 * Plugin Name:       Referral Code Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Creates a custom post type for referral codes with custom fields and a shortcode.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sonu Sourav
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       referral-code-plugin
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register the 'referral-codes' custom post type.
 */
function rcp_register_post_type() {
    $labels = array(
        'name'                  => _x( 'Referral Codes', 'Post type general name', 'referral-code-plugin' ),
        'singular_name'         => _x( 'Referral Code', 'Post type singular name', 'referral-code-plugin' ),
        'menu_name'             => _x( 'Referral Codes', 'Admin Menu text', 'referral-code-plugin' ),
        'name_admin_bar'        => _x( 'Referral Code', 'Add New on Toolbar', 'referral-code-plugin' ),
        'add_new'               => __( 'Add New', 'referral-code-plugin' ),
        'add_new_item'          => __( 'Add New Referral Code', 'referral-code-plugin' ),
        'new_item'              => __( 'New Referral Code', 'referral-code-plugin' ),
        'edit_item'             => __( 'Edit Referral Code', 'referral-code-plugin' ),
        'view_item'             => __( 'View Referral Code', 'referral-code-plugin' ),
        'all_items'             => __( 'All Referral Codes', 'referral-code-plugin' ),
        'search_items'          => __( 'Search Referral Codes', 'referral-code-plugin' ),
        'parent_item_colon'     => __( 'Parent Referral Codes:', 'referral-code-plugin' ),
        'not_found'             => __( 'No referral codes found.', 'referral-code-plugin' ),
        'not_found_in_trash'    => __( 'No referral codes found in Trash.', 'referral-code-plugin' ),
        'featured_image'        => _x( 'App Logo', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'referral-code-plugin' ),
        'set_featured_image'    => _x( 'Set app logo', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'referral-code-plugin' ),
        'remove_featured_image' => _x( 'Remove app logo', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'referral-code-plugin' ),
        'use_featured_image'    => _x( 'Use as app logo', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'referral-code-plugin' ),
        'archives'              => _x( 'Referral code archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'referral-code-plugin' ),
        'insert_into_item'      => _x( 'Insert into referral code', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'referral-code-plugin' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this referral code', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'referral-code-plugin' ),
        'filter_items_list'     => _x( 'Filter referral codes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'referral-code-plugin' ),
        'items_list_navigation' => _x( 'Referral codes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'referral-code-plugin' ),
        'items_list'            => _x( 'Referral codes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'referral-code-plugin' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'referral-codes' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'show_in_rest'       => true, // This enables the REST API
    );

    register_post_type( 'referral-codes', $args );
}
add_action( 'init', 'rcp_register_post_type' );

/**
 * Register meta fields for the 'referral-codes' post type.
 */
function rcp_register_meta_fields() {
    register_post_meta( 'referral-codes', 'referral_code', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ) );

    register_post_meta( 'referral-codes', 'referral_link', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ) );

    register_post_meta( 'referral-codes', 'signup_bonus', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ) );
}
add_action( 'init', 'rcp_register_meta_fields' );

/**
 * Enqueue block editor assets.
 */
function rcp_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'rcp-editor-script',
        plugins_url( 'js/editor.js', __FILE__ ),
        array( 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data', 'wp-i18n' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'js/editor.js' ),
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'rcp_enqueue_block_editor_assets' );


/**
 * Shortcode to display a referral code box.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output for the referral code box.
 */
function rcp_referral_code_box_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => null,
    ), $atts, 'referral_code_box' );

    if ( ! $atts['id'] ) {
        return '';
    }

    $post = get_post( $atts['id'] );

    if ( ! $post || $post->post_type !== 'referral-codes' ) {
        return '';
    }

    $referral_code = get_post_meta( $post->ID, 'referral_code', true );
    $referral_link = get_post_meta( $post->ID, 'referral_link', true );
    $signup_bonus = get_post_meta( $post->ID, 'signup_bonus', true );
    $app_logo = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );

    ob_start();
    ?>
    <div class="wp-block-media-text alignwide is-stacked-on-mobile">
        <figure class="wp-block-media-text__media">
            <img src="<?php echo esc_url( $app_logo ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?> Logo">
        </figure>
        <div class="wp-block-media-text__content">
            <h3 class="wp-block-heading"><?php echo esc_html( $post->post_title ); ?></h3>
            <?php if ( ! empty( $signup_bonus ) ) : ?>
                <p><strong><?php esc_html_e( 'Sign-up Bonus:', 'referral-code-plugin' ); ?></strong> <?php echo esc_html( $signup_bonus ); ?></p>
            <?php endif; ?>
            <div class="wp-block-columns">
                <div class="wp-block-column">
                    <div class="wp-block-buttons is-content-justification-center">
                        <div class="wp-block-button">
                            <a class="wp-block-button__link" href="<?php echo esc_url( $referral_link ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get the Deal', 'referral-code-plugin' ); ?></a>
                        </div>
                    </div>
                </div>
                <div class="wp-block-column">
                     <p class="has-text-align-center"><strong><?php esc_html_e( 'Referral Code:', 'referral-code-plugin' ); ?></strong></p>
                     <p class="has-text-align-center has-background has-text-white-color" style="padding:10px;"><?php echo esc_html( $referral_code ); ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'referral_code_box', 'rcp_referral_code_box_shortcode' );
?>
