<?php
/**
 * The template for displaying single Referral Code posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Referral_Code_Plugin
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();

            $referral_code = get_post_meta( get_the_ID(), 'referral_code', true );
            $referral_link = get_post_meta( get_the_ID(), 'referral_link', true );
            $signup_bonus  = get_post_meta( get_the_ID(), 'signup_bonus', true );
            $app_logo      = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <div class="wp-block-media-text alignwide is-stacked-on-mobile">
                        <?php if ( $app_logo ) : ?>
                        <figure class="wp-block-media-text__media">
                            <img src="<?php echo esc_url( $app_logo ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?> Logo">
                        </figure>
                        <?php endif; ?>
                        <div class="wp-block-media-text__content">
                            
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
