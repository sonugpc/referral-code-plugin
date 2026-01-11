<?php
/**
 * Plugin Name:       Referral Code Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Creates a custom post type for referral codes with custom fields and a shortcode.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sonu Gupta
 * Author URI:        https://bigtricks.in/
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
        'rewrite'            => array( 'slug' => 'referral-code' ),
        'capability_type'    => 'post',
        'has_archive'        => 'referral-codes',
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'         => array( 'category', 'store' ),
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

    register_post_meta( 'referral-codes', 'referral_rewards', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ) );

    register_post_meta( 'referral-codes', 'app_name', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ) );

    register_post_meta( 'referral-codes', 'rcp_faqs', array(
        'show_in_rest' => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array(
                    'type' => 'object',
                    'properties' => array(
                        'question' => array(
                            'type' => 'string',
                        ),
                        'answer' => array(
                            'type' => 'string',
                        ),
                    ),
                    'additionalProperties' => true,
                ),
            ),
        ),
        'single'       => true,
        'type'         => 'array',
        'auth_callback' => function() {
            return current_user_can( 'edit_posts' );
        }
    ) );

    register_post_meta( 'referral-codes', 'referral_code_usage_count', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'integer',
        'default'      => 0,
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

function rcp_add_meta_box() {
    add_meta_box(
        'rcp_faq_meta_box',
        'FAQs',
        'rcp_faq_meta_box_callback',
        'referral-codes',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'rcp_add_meta_box' );

function rcp_faq_meta_box_callback( $post ) {
    ?>
    <div id="rcp-faq-editor"></div>
    <?php
}

/**
 * Set default FAQs when a new 'referral-codes' post is created.
 *
 * @param int     $post_id The post ID.
 * @param WP_Post $post    The post object.
 * @param bool    $update  Whether this is an existing post being updated or not.
 */
function rcp_set_default_faqs_on_new_post( $post_id, $post, $update ) {
    // If this is not a new post, or if it's an autosave, or a revision, do nothing.
    if ( $update || wp_is_post_autosave( $post_id ) || wp_is_post_revision( $post_id ) ) {
        return;
    }

    // Only act on our custom post type.
    if ( 'referral-codes' !== $post->post_type ) {
        return;
    }

    // Check if FAQs are already set to prevent overwriting.
    if ( get_post_meta( $post_id, 'rcp_faqs', true ) ) {
        return;
    }

    $app_name = get_post_meta( $post_id, 'app_name', true );
    if ( ! $app_name ) {
        $app_name = $post->post_title;
        if ( empty( $app_name ) || $app_name === 'Auto Draft' ) {
            $app_name = 'the Referral Program';
        }
    }

    $default_faqs = array(
        array(
            'question' => 'What is the {{app_name}} Referral Code?',
            'answer'   => 'The referral code for {{app_name}} is <strong>{{referral_code}}</strong>. When you use this code during signup, you will receive a bonus of <strong>{{signup_bonus}}</strong>. Alternatively, you can use the direct referral link: {{referral_link}}.',
        ),
        array(
            'question' => 'What is the {{app_name}} Referral Link?',
            'answer'   => 'You can use the direct referral link for {{app_name}}: {{referral_link}}.',
        ),
        array(
            'question' => 'What is the Signup Bonus for {{app_name}}?',
            'answer'   => 'You will receive <strong>{{signup_bonus}}</strong> as a signup bonus when you use the referral code or link for {{app_name}}.',
        ),
        array(
            'question' => 'What are the Referral Rewards for {{app_name}}?',
            'answer'   => 'The referral rewards for {{app_name}} include: {{referral_rewards}}.',
        ),
        array(
            'question' => 'How do I use the {{app_name}} Referral Code?',
            'answer'   => 'To use the {{app_name}} referral code, enter <strong>{{referral_code}}</strong> during signup or use the referral link: {{referral_link}}. You will receive {{signup_bonus}} as a bonus.',
        ),
        array(
            'question' => 'When will I receive my {{app_name}} signup bonus?',
            'answer'   => 'Most referral bonuses are processed instantly or within 24-48 hours after meeting the minimum requirements. Check the specific terms and conditions for {{app_name}} for exact timing.',
        ),
        array(
            'question' => 'Can I use multiple referral codes for {{app_name}}?',
            'answer'   => 'No, typically only one referral code can be used per account for {{app_name}}. Make sure to use the best available code during your initial signup.',
        ),
    );

    update_post_meta( $post_id, 'rcp_faqs', $default_faqs );
}
add_action( 'save_post', 'rcp_set_default_faqs_on_new_post', 10, 3 );


/**
 * Shortcode to display a referral code box.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output for the referral code box.
 */
function rcp_referral_code_box_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id'   => null,
        'slug' => null,
    ), $atts, 'referral_code_box' );

    $post = null;
    if ( ! empty( $atts['id'] ) ) {
        $post = get_post( $atts['id'] );
    } elseif ( ! empty( $atts['slug'] ) ) {
        $args = array(
            'name'        => $atts['slug'],
            'post_type'   => 'referral-codes',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $posts = get_posts($args);
        if ( $posts ) {
            $post = $posts[0];
        }
    }

    if ( ! $post ) {
        return '';
    }

    if ( ! $post || $post->post_type !== 'referral-codes' ) {
        return '';
    }

    $referral_code = get_post_meta( $post->ID, 'referral_code', true );
    $referral_link = get_post_meta( $post->ID, 'referral_link', true );
    $signup_bonus = get_post_meta( $post->ID, 'signup_bonus', true );
    $app_logo = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );

    ob_start();
    ?>
    <div class="referral-code-box">
        <div class="referral-code-box-inner">
            <?php if ( $app_logo ) : ?>
            <div class="referral-code-logo">
                <img src="<?php echo esc_url( $app_logo ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?> Logo">
            </div>
            <?php endif; ?>
            
            <div class="referral-code-content">
                <h3 class="referral-code-title"><?php echo esc_html( $post->post_title ); ?></h3>

                <?php
                $categories = get_the_category( $post->ID );
                if ( ! empty( $categories ) ) :
                ?>
                <div class="referral-code-categories">
                    <?php foreach ( $categories as $category ) : ?>
                        <span class="referral-code-category"><?php echo esc_html( $category->name ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $signup_bonus ) ) : ?>
                <div class="referral-code-bonus">
                    <strong><?php esc_html_e( 'Sign-up Bonus:', 'referral-code-plugin' ); ?></strong> 
                    <?php echo esc_html( $signup_bonus ); ?>
                </div>
                <?php endif; ?>
                
                <?php if ( ! empty( $referral_code ) ) : ?>
                <div class="referral-code-display">
                    <strong><?php esc_html_e( 'Referral Code:', 'referral-code-plugin' ); ?></strong>
                    <span class="referral-code-value"><?php echo esc_html( $referral_code ); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ( ! empty( $referral_link ) ) : ?>
                <div class="referral-code-action">
                    <a href="<?php echo esc_url( $referral_link ); ?>" target="_blank" rel="noopener noreferrer" class="referral-code-button">
                        <?php esc_html_e( 'Get the Deal', 'referral-code-plugin' ); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <style>
    .referral-code-box {
        margin: 20px 0;
        border: 1px solid #eee;
        border-radius: 5px;
        overflow: hidden;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .referral-code-box-inner {
        display: flex;
        align-items: flex-start;
        padding: 15px;
    }

    .referral-code-logo {
        margin-right: 20px;
        flex-shrink: 0;
    }

    .referral-code-logo img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .referral-code-content {
        flex-grow: 1;
    }

    .referral-code-title {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .referral-code-categories {
        margin-bottom: 10px;
    }

    .referral-code-category {
        display: inline-block;
        background-color: #f0f0f0;
        color: #666;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 12px;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .referral-code-bonus {
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #374151;
    }

    .referral-code-bonus strong {
        color: #1f2937;
    }

    .referral-code-display {
        margin-bottom: 15px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 3px;
        font-size: 0.9rem;
        color: #1f2937;
    }

    .referral-code-value {
        font-family: monospace;
        margin-left: 5px;
        font-weight: bold;
    }

    .referral-code-action {
        margin-top: 15px;
    }

    .referral-code-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #f0f0f0;
        color: #333;
        text-decoration: none;
        border-radius: 3px;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .referral-code-button:hover {
        background-color: #e5e7eb;
    }

    @media (max-width: 768px) {
        .referral-code-box-inner {
            flex-direction: column;
        }

        .referral-code-logo {
            margin-right: 0;
            margin-bottom: 15px;
        }
    }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'referral_code_box', 'rcp_referral_code_box_shortcode' );

/**
 * Load a custom template for single 'referral-codes' posts.
 *
 * @param string $template The path of the template to include.
 * @return string The path of the template to include.
 */
function rcp_load_single_template( $template ) {
    if ( is_singular( 'referral-codes' ) ) {
        $plugin_template = plugin_dir_path( __FILE__ ) . 'templates/single-referral-codes.php';
        if ( file_exists( $plugin_template ) ) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter( 'single_template', 'rcp_load_single_template' );

/**
 * Load a custom template for 'referral-codes' archive.
 *
 * @param string $template The path of the template to include.
 * @return string The path of the template to include.
 */
function rcp_load_archive_template( $template ) {
    if ( is_post_type_archive( 'referral-codes' ) ) {
        $plugin_template = plugin_dir_path( __FILE__ ) . 'templates/archive-referral-codes.php';
        if ( file_exists( $plugin_template ) ) {
            return $plugin_template;
        }
    }
    return $template;
}
add_filter( 'archive_template', 'rcp_load_archive_template' );

/**
 * Enqueue frontend scripts and styles.
 */
function rcp_enqueue_frontend_assets() {
    // Load main plugin CSS only on plugin pages (single and archive)
    if ( is_singular( 'referral-codes' ) || is_post_type_archive( 'referral-codes' ) ) {
        wp_enqueue_style(
            'referral-code-style',
            plugins_url( 'referral-code-style.css', __FILE__ ),
            array(),
            '1.0.1' // Version bump
        );
    }

    // Load shortcode CSS when shortcodes are present
    global $post;

    // Check if any referral code shortcodes are present or if we're on an archive page
    if ( is_post_type_archive( 'referral-codes' ) ||
         ( is_a( $post, 'WP_Post' ) && (
            has_shortcode( $post->post_content, 'referral_code_box' ) ||
            has_shortcode( $post->post_content, 'referral_code_text' ) ||
            has_shortcode( $post->post_content, 'referral_code_copy' ) ||
            has_shortcode( $post->post_content, 'referral_link_text' ) ||
            has_shortcode( $post->post_content, 'referral_link_copy' ) ||
            has_shortcode( $post->post_content, 'referral_codes_grid' )
         ) ) ) {
        wp_enqueue_style(
            'referral-code-shortcode-style',
            plugins_url( 'referral-code-shortcode.css', __FILE__ ),
            array(),
            '1.0.0'
        );
    }

    // Enqueue archive script for archive pages and pages with grid shortcode
    if ( is_post_type_archive( 'referral-codes' ) ||
         ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'referral_codes_grid' ) ) ) {

        wp_enqueue_script(
            'rcp-archive-script',
            plugins_url( 'js/archive.js', __FILE__ ),
            array( 'jquery' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'js/archive.js' ),
            true
        );

        wp_localize_script( 'rcp-archive-script', 'rcp_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'rcp_enqueue_frontend_assets' );

/**
 * Defer non-critical CSS to prevent render-blocking.
 *
 * @param string $tag    The <link> tag for the enqueued style.
 * @param string $handle The style's handle.
 * @param string $href   The stylesheet's URL.
 * @param string $media  The stylesheet's media type.
 * @return string The modified <link> tag.
 */
/**
 * Defer non-critical CSS and JS to prevent render-blocking.
 */
function rcp_defer_assets( $tag, $handle, $href ) {
    // Defer CSS
    if ( 'referral-code-style' === $handle || 'referral-code-shortcode-style' === $handle ) {
        return '<link rel="preload" href="' . esc_url( $href ) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' .
               '<noscript><link rel="stylesheet" href="' . esc_url( $href ) . '"></noscript>';
    }
    return $tag;
}
add_filter( 'style_loader_tag', 'rcp_defer_assets', 10, 3 );

function rcp_defer_js( $tag, $handle ) {
    // Defer JavaScript
    if ( 'rcp-frontend-script' === $handle ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'rcp_defer_js', 10, 2 );

/**
 * Get cached comments for a post to improve performance.
 *
 * @param int $post_id The ID of the post.
 * @return array The array of comment objects.
 */
function rcp_get_cached_comments( $post_id ) {
    $comments = get_transient( 'rcp_comments_' . $post_id );

    if ( false === $comments ) {
        $comments = get_comments( array(
            'post_id' => $post_id,
            'status'  => 'approve',
            'number'  => 10,
            'order'   => 'DESC',
        ) );
        // Cache the comments for 1 hour.
        set_transient( 'rcp_comments_' . $post_id, $comments, HOUR_IN_SECONDS );
    }

    return $comments;
}

/**
 * Clear the comments cache when a new comment is posted or a comment's status changes.
 */
function rcp_clear_comments_cache( $comment_id ) {
    $comment = get_comment( $comment_id );
    if ( $comment && 'referral-codes' === get_post_type( $comment->comment_post_ID ) ) {
        delete_transient( 'rcp_comments_' . $comment->comment_post_ID );
    }
}
add_action( 'comment_post', 'rcp_clear_comments_cache' );
add_action( 'wp_set_comment_status', 'rcp_clear_comments_cache' );
// Add sidebar registration to functions.php
function register_referral_sidebar() {
    register_sidebar(array(
        'name' => 'Referral Code Sidebar',
        'id' => 'referral-sidebar',
        'description' => 'Widgets in this area will be shown on referral code pages.',
        'before_widget' => '<div class="sidebar-card widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'register_referral_sidebar');

/**
 * Shortcode to display a referral code in plain text.
 *
 * @param array $atts Shortcode attributes.
 * @return string The referral code.
 */
function rcp_referral_code_text_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id'   => null,
        'slug' => null,
    ), $atts, 'referral_code_text' );

    $post = null;
    if ( ! empty( $atts['id'] ) ) {
        $post = get_post( $atts['id'] );
    } elseif ( ! empty( $atts['slug'] ) ) {
        $args = array(
            'name'        => $atts['slug'],
            'post_type'   => 'referral-codes',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $posts = get_posts($args);
        if ( $posts ) {
            $post = $posts[0];
        }
    }

    if ( ! $post ) {
        return '';
    }

    if ( ! $post || $post->post_type !== 'referral-codes' ) {
        return '';
    }

    return esc_html( get_post_meta( $post->ID, 'referral_code', true ) );
}
add_shortcode( 'referral_code_text', 'rcp_referral_code_text_shortcode' );

/**
 * Shortcode to display a referral code with a copy button.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output for the referral code with a copy button.
 */
function rcp_referral_code_copy_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id'   => null,
        'slug' => null,
    ), $atts, 'referral_code_copy' );

    $post = null;
    if ( ! empty( $atts['id'] ) ) {
        $post = get_post( $atts['id'] );
    } elseif ( ! empty( $atts['slug'] ) ) {
        $args = array(
            'name'        => $atts['slug'],
            'post_type'   => 'referral-codes',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $posts = get_posts($args);
        if ( $posts ) {
            $post = $posts[0];
        }
    }

    if ( ! $post ) {
        return '';
    }

    if ( ! $post || $post->post_type !== 'referral-codes' ) {
        return '';
    }

    $referral_code = get_post_meta( $post->ID, 'referral_code', true );

    ob_start();
    ?>
    <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #ccc; padding: 10px; border-radius: 5px; max-width: 300px;">
        <span style="font-family: monospace;"><?php echo esc_html( $referral_code ); ?></span>
        <span class="rcp-copy-icon" data-clipboard-text="<?php echo esc_attr( $referral_code ); ?>" title="Copy to clipboard" style="cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
        </span>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'referral_code_copy', 'rcp_referral_code_copy_shortcode' );

/**
 * Shortcode to display a referral link in plain text.
 *
 * @param array $atts Shortcode attributes.
 * @return string The referral link.
 */
function rcp_referral_link_text_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id'   => null,
        'slug' => null,
    ), $atts, 'referral_link_text' );

    $post = null;
    if ( ! empty( $atts['id'] ) ) {
        $post = get_post( $atts['id'] );
    } elseif ( ! empty( $atts['slug'] ) ) {
        $args = array(
            'name'        => $atts['slug'],
            'post_type'   => 'referral-codes',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $posts = get_posts($args);
        if ( $posts ) {
            $post = $posts[0];
        }
    }

    if ( ! $post ) {
        return '';
    }

    if ( ! $post || $post->post_type !== 'referral-codes' ) {
        return '';
    }

    return esc_url( get_post_meta( $post->ID, 'referral_link', true ) );
}
add_shortcode( 'referral_link_text', 'rcp_referral_link_text_shortcode' );

/**
 * Shortcode to display a referral link with a copy button.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output for the referral link with a copy button.
 */
function rcp_referral_link_copy_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id'   => null,
        'slug' => null,
    ), $atts, 'referral_link_copy' );

    $post = null;
    if ( ! empty( $atts['id'] ) ) {
        $post = get_post( $atts['id'] );
    } elseif ( ! empty( $atts['slug'] ) ) {
        $args = array(
            'name'        => $atts['slug'],
            'post_type'   => 'referral-codes',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $posts = get_posts($args);
        if ( $posts ) {
            $post = $posts[0];
        }
    }

    if ( ! $post ) {
        return '';
    }

    if ( ! $post || $post->post_type !== 'referral-codes' ) {
        return '';
    }

    $referral_link = get_post_meta( $post->ID, 'referral_link', true );

    ob_start();
    ?>
    <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid #ccc; padding: 10px; border-radius: 5px; max-width: 300px;">
        <span style="font-family: monospace;"><?php echo esc_url( $referral_link ); ?></span>
        <span class="rcp-copy-icon" data-clipboard-text="<?php echo esc_attr( $referral_link ); ?>" title="Copy to clipboard" style="cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
        </span>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'referral_link_copy', 'rcp_referral_link_copy_shortcode' );

/**
 * Enqueue frontend scripts and styles for the copy shortcode.
 */
function rcp_enqueue_copy_assets() {
    // Only enqueue if one of the copy shortcodes is present.
    $post = get_post();
    if ( is_a( $post, 'WP_Post' ) && ( has_shortcode( $post->post_content, 'referral_code_copy' ) || has_shortcode( $post->post_content, 'referral_link_copy' ) ) ) {
        wp_enqueue_script(
            'rcp-copy-to-clipboard',
            plugins_url( 'js/copy-to-clipboard.js', __FILE__ ),
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . 'js/copy-to-clipboard.js' ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'rcp_enqueue_copy_assets' );

/**
 * Shortcode to display referral codes grid with AJAX load more.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output for the referral codes grid.
 */
function rcp_referral_codes_grid_shortcode( $atts ) {
    // Enqueue required assets for the grid shortcode
    wp_enqueue_style(
        'referral-code-shortcode-style',
        plugins_url( 'referral-code-shortcode.css', __FILE__ ),
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'rcp-archive-script',
        plugins_url( 'js/archive.js', __FILE__ ),
        array( 'jquery' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'js/archive.js' ),
        true
    );

    wp_localize_script( 'rcp-archive-script', 'rcp_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );

    $atts = shortcode_atts( array(
        'posts_per_page' => 12,
        'loadmore' => 'true',
        'category' => '',
    ), $atts, 'referral_codes_grid' );

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type' => 'referral-codes',
        'post_status' => 'publish',
        'posts_per_page' => intval($atts['posts_per_page']),
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Add category filter if specified
    if (!empty($atts['category'])) {
        if (is_numeric($atts['category'])) {
            $args['cat'] = intval($atts['category']);
        } else {
            $args['category_name'] = sanitize_text_field($atts['category']);
        }
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="bt-referral-grid" data-posts-per-page="' . esc_attr($atts['posts_per_page']) . '" data-loadmore="' . esc_attr($atts['loadmore']) . '" data-category="' . esc_attr($atts['category']) . '">';
        echo '<div class="bt-referral-grid-container">';

        while ($query->have_posts()) {
            $query->the_post();
            rcp_render_referral_card();
        }

        echo '</div>';

        if ($atts['loadmore'] === 'true' && $query->max_num_pages > 1) {
            echo '<div class="bt-load-more-container">';
            echo '<button class="bt-load-more-btn" data-page="1" data-max-pages="' . esc_attr($query->max_num_pages) . '">Load More</button>';
            echo '<div class="bt-loading-spinner" style="display: none;">Loading...</div>';
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo '<div class="bt-no-referrals-found">';
        echo '<p>No referral codes found.</p>';
        echo '</div>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'referral_codes_grid', 'rcp_referral_codes_grid_shortcode' );

/**
 * Render a single referral card.
 */
function rcp_render_referral_card() {
    $referral_data = rcp_get_referral_data(get_the_ID());
    $referral_code = $referral_data['referral_code'];
    $referral_link = $referral_data['referral_link'];
    $signup_bonus = $referral_data['signup_bonus'];
    $app_name = $referral_data['app_name'];
    $usage_count = $referral_data['usage_count'];

    if (!$app_name) {
        $app_name = get_the_title();
    }

    $app_logo = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
    ?>
    <article class="bt-referral-card">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) :
            $first_category = $categories[0];
            $category_name = $first_category->name;
            if (strlen($category_name) > 30) {
                $category_name = substr($category_name, 0, 30) . '...';
            }
        ?>
        <!-- <div class="bt-category-badge">
            <span class="bt-category"><p echo esc_html($category_name); ?></span>
        </div> -->
        <?php endif; ?>
        <div class="bt-referral-header">
            <?php if ($app_logo) : ?>
                <div class="bt-app-logo">
                    <img src="<?php echo esc_url($app_logo); ?>" alt="<?php echo esc_attr($app_name); ?>" loading="lazy">
                </div>
            <?php endif; ?>
            <div class="bt-app-info">
                <h3 class="bt-app-name">
                    <a href="<?php the_permalink(); ?>"><?php echo esc_html($app_name); ?></a> 
                     <span class="bt-code-label">Referral Code</span>

                </h3>
            </div>
        </div>

        <div class="bt-referral-content">
            <?php if ($referral_code) : ?>
                <div class="bt-code-section">
                    <div class="bt-code-container">
                        <span class="bt-code-value"><?php echo esc_html($referral_code); ?></span>
                        <button class="bt-copy-code-btn" onclick="copyReferralCode(this, '<?php echo esc_js($referral_code); ?>')" type="button" aria-label="Copy referral code">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 1H4C2.9 1 2 1.9 2 3V17H4V3H16V1ZM19 5H8C6.9 5 6 5.9 6 7V21C6 22.1 6.9 23 8 23H19C20.1 23 21 22.1 21 21V7C21 5.9 20.1 5 19 5ZM19 21H8V7H19V21Z" fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <?php if ($usage_count > 0): ?>
                    <div class="bt-usage-count">
                        <span class="usage-icon">👥</span>
                        <span class="usage-text"><?php echo rcp_format_usage_count($usage_count); ?> used</span>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="bt-referral-actions">
                <?php if ($referral_link) : ?>
                    <a href="<?php echo esc_url($referral_link); ?>" class="bt-btn bt-btn-primary" target="_blank" rel="noopener">
                        <?php echo $signup_bonus ? 'Get ' . esc_html($signup_bonus) : 'Get Deal'; ?>
                    </a>
                <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="bt-btn bt-btn-secondary">
                        View Details
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </article>
    <?php
}

/**
 * AJAX handler for loading more referral codes.
 */
function rcp_load_more_referral_codes() {
    $page = intval($_POST['page']);
    $posts_per_page = intval($_POST['posts_per_page']);
    $category = sanitize_text_field($_POST['category']);

    $args = array(
        'post_type' => 'referral-codes',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $page + 1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Add category filter if specified
    if (!empty($category)) {
        if (is_numeric($category)) {
            $args['cat'] = intval($category);
        } else {
            $args['category_name'] = $category;
        }
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            rcp_render_referral_card();
        }
        $html = ob_get_clean();

        wp_send_json_success(array(
            'html' => $html,
            'has_more' => ($page + 1) < $query->max_num_pages
        ));
    } else {
        wp_send_json_error('No more posts found');
    }

    wp_die();
}
add_action( 'wp_ajax_load_more_referral_codes', 'rcp_load_more_referral_codes' );
add_action( 'wp_ajax_nopriv_load_more_referral_codes', 'rcp_load_more_referral_codes' );

/**
 * Track page views for main referral codes.
 */
function rcp_track_referral_code_view() {
    if ( is_singular( 'referral-codes' ) ) {
        global $post;
        if ( $post && $post->post_type === 'referral-codes' ) {
            $current_count = (int) get_post_meta( $post->ID, 'referral_code_usage_count', true );
            update_post_meta( $post->ID, 'referral_code_usage_count', $current_count + 1 );
        }
    }
}
add_action( 'wp_head', 'rcp_track_referral_code_view' );

/**
 * AJAX handler for tracking user-submitted code usage.
 */
function rcp_track_user_code_usage() {
    // Verify nonce for security
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'rcp_track_usage' ) ) {
        wp_die( 'Security check failed' );
    }

    $comment_id = intval( $_POST['comment_id'] );
    if ( $comment_id > 0 ) {
        $current_count = (int) get_comment_meta( $comment_id, 'user_code_usage_count', true );
        update_comment_meta( $comment_id, 'user_code_usage_count', $current_count + 1 );

        wp_send_json_success( array(
            'count' => $current_count + 1
        ) );
    }

    wp_die();
}
add_action( 'wp_ajax_track_user_code_usage', 'rcp_track_user_code_usage' );
add_action( 'wp_ajax_nopriv_track_user_code_usage', 'rcp_track_user_code_usage' );

/**
 * Get optimized referral code data to avoid repeated queries.
 *
 * @param int $post_id The post ID.
 * @return array Cached post meta data.
 */
function rcp_get_referral_data( $post_id ) {
    static $cache = array();

    if ( ! isset( $cache[ $post_id ] ) ) {
        $cache[ $post_id ] = array(
            'referral_code' => get_post_meta( $post_id, 'referral_code', true ),
            'referral_link' => get_post_meta( $post_id, 'referral_link', true ),
            'signup_bonus' => get_post_meta( $post_id, 'signup_bonus', true ),
            'referral_rewards' => get_post_meta( $post_id, 'referral_rewards', true ),
            'app_name' => get_post_meta( $post_id, 'app_name', true ),
            'usage_count' => (int) get_post_meta( $post_id, 'referral_code_usage_count', true ),
        );
    }

    return $cache[ $post_id ];
}

/**
 * Format usage count for display.
 *
 * @param int $count The usage count.
 * @return string Formatted count string.
 */
function rcp_format_usage_count( $count ) {
    if ( $count >= 1000000 ) {
        return number_format( $count / 1000000, 1 ) . 'M';
    } elseif ( $count >= 1000 ) {
        return number_format( $count / 1000, 1 ) . 'K';
    }
    return number_format( $count );
}
?>
