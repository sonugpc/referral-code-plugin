<?php
/**
 * The template for displaying single Referral Code posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Referral_Code_Plugin
 */

get_header(); ?>

<style>
.rcp-referral-card {
    max-width: 800px;
    margin: 2rem auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #e1e5e9;
}

.rcp-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.rcp-card-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 600;
}

.rcp-card-body {
    padding: 2rem;
}

.rcp-app-info {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.rcp-app-logo {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.rcp-bonus-badge {
    background: #28a745;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 1rem;
}

.rcp-code-section {
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    margin: 1.5rem 0;
    position: relative;
}

.rcp-code-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.rcp-code-value {
    font-family: 'Courier New', monospace;
    font-size: 1.5rem;
    font-weight: bold;
    color: #495057;
    background: white;
    padding: 1rem;
    border-radius: 6px;
    border: 1px solid #ced4da;
    margin-bottom: 1rem;
    user-select: all;
}

.rcp-copy-button {
    background: #007cba;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.rcp-copy-button:hover {
    background: #005a87;
    transform: translateY(-1px);
}

.rcp-copy-button.copied {
    background: #28a745;
}

.rcp-primary-button {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.1rem;
    display: inline-block;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-align: center;
    width: 100%;
    margin-bottom: 1rem;
}

.rcp-primary-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    text-decoration: none;
    color: white;
}

.rcp-share-section {
    border-top: 1px solid #e1e5e9;
    padding-top: 1.5rem;
    margin-top: 2rem;
}

.rcp-share-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.rcp-share-button {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-size: 0.9rem;
    transition: opacity 0.3s ease;
}

.rcp-share-button:hover {
    opacity: 0.8;
    text-decoration: none;
    color: white;
}

.rcp-share-twitter { background: #1da1f2; }
.rcp-share-facebook { background: #3b5998; }
.rcp-share-whatsapp { background: #25d366; }
.rcp-share-telegram { background: #0088cc; }

.rcp-terms {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 1.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 6px;
    border-left: 4px solid #667eea;
}

@media (max-width: 768px) {
    .rcp-referral-card {
        margin: 1rem;
        border-radius: 8px;
    }
    
    .rcp-card-header {
        padding: 1.5rem;
    }
    
    .rcp-card-header h1 {
        font-size: 1.5rem;
    }
    
    .rcp-card-body {
        padding: 1.5rem;
    }
    
    .rcp-app-info {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .rcp-app-logo {
        width: 60px;
        height: 60px;
    }
    
    .rcp-code-value {
        font-size: 1.2rem;
    }
    
    .rcp-share-buttons {
        flex-direction: column;
    }
    
    .rcp-share-button {
        text-align: center;
    }
}

@media (prefers-reduced-motion: reduce) {
    .rcp-primary-button:hover,
    .rcp-copy-button:hover {
        transform: none;
    }
}
</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();

            $referral_code = get_post_meta( get_the_ID(), 'referral_code', true );
            $referral_link = get_post_meta( get_the_ID(), 'referral_link', true );
            $signup_bonus  = get_post_meta( get_the_ID(), 'signup_bonus', true );
            $app_logo      = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            $post_url      = get_permalink();
            $post_title    = get_the_title();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('rcp-referral-card'); ?>>
                <header class="rcp-card-header">
                    <h1><?php echo esc_html( $post_title ); ?></h1>
                </header>

                <div class="rcp-card-body">
                    <?php if ( $app_logo || $signup_bonus ) : ?>
                    <div class="rcp-app-info">
                        <?php if ( $app_logo ) : ?>
                            <img src="<?php echo esc_url( $app_logo ); ?>" 
                                 alt="<?php echo esc_attr( $post_title ); ?> Logo" 
                                 class="rcp-app-logo">
                        <?php endif; ?>
                        
                        <div class="rcp-app-details">
                            <?php if ( ! empty( $signup_bonus ) ) : ?>
                                <div class="rcp-bonus-badge" role="banner" aria-label="<?php esc_attr_e( 'Sign-up bonus amount', 'referral-code-plugin' ); ?>">
                                    🎁 <?php echo esc_html( $signup_bonus ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $referral_link ) ) : ?>
                    <a href="<?php echo esc_url( $referral_link ); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="rcp-primary-button"
                       onclick="rcpTrackClick('<?php echo esc_js( get_the_ID() ); ?>', 'referral_link')"
                       aria-label="<?php esc_attr_e( 'Open referral link in new tab', 'referral-code-plugin' ); ?>">
                        🚀 <?php esc_html_e( 'Get the Deal', 'referral-code-plugin' ); ?>
                    </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $referral_code ) ) : ?>
                    <div class="rcp-code-section" role="region" aria-labelledby="rcp-code-label">
                        <div class="rcp-code-label" id="rcp-code-label">
                            <strong><?php esc_html_e( 'Referral Code:', 'referral-code-plugin' ); ?></strong>
                        </div>
                        <div class="rcp-code-value" id="referral-code-<?php echo esc_attr( get_the_ID() ); ?>" 
                             aria-label="<?php esc_attr_e( 'Referral code, click to select all', 'referral-code-plugin' ); ?>">
                            <?php echo esc_html( $referral_code ); ?>
                        </div>
                        <button class="rcp-copy-button" 
                                onclick="rcpCopyCode('referral-code-<?php echo esc_js( get_the_ID() ); ?>', this)"
                                aria-label="<?php esc_attr_e( 'Copy referral code to clipboard', 'referral-code-plugin' ); ?>">
                            📋 <?php esc_html_e( 'Copy Code', 'referral-code-plugin' ); ?>
                        </button>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content-text">
                        <?php
                        the_content(
                            sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'referral-code-plugin' ),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                get_the_title()
                            )
                        );
                        ?>
                    </div>

                    <div class="rcp-share-section">
                        <p class="has-text-align-center"><strong><?php esc_html_e( 'Share this deal:', 'referral-code-plugin' ); ?></strong></p>
                        <div class="rcp-share-buttons">
                            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $post_title . ' - ' . $signup_bonus ); ?>&url=<?php echo urlencode( $post_url ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="rcp-share-button rcp-share-twitter"
                               onclick="rcpTrackClick('<?php echo esc_js( get_the_ID() ); ?>', 'share_twitter')">
                                Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( $post_url ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="rcp-share-button rcp-share-facebook"
                               onclick="rcpTrackClick('<?php echo esc_js( get_the_ID() ); ?>', 'share_facebook')">
                                Facebook
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode( $post_title . ' - ' . $signup_bonus . ' ' . $post_url ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="rcp-share-button rcp-share-whatsapp"
                               onclick="rcpTrackClick('<?php echo esc_js( get_the_ID() ); ?>', 'share_whatsapp')">
                                WhatsApp
                            </a>
                            <a href="https://t.me/share/url?url=<?php echo urlencode( $post_url ); ?>&text=<?php echo urlencode( $post_title . ' - ' . $signup_bonus ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="rcp-share-button rcp-share-telegram"
                               onclick="rcpTrackClick('<?php echo esc_js( get_the_ID() ); ?>', 'share_telegram')">
                                Telegram
                            </a>
                        </div>
                    </div>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            /* translators: %s: Name of current post */
                            esc_html__( 'Edit %s', 'referral-code-plugin' ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
