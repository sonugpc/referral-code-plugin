<?php
/**
 * Template Name: Archive Referral Codes
 * Description: Custom template for displaying referral code archives with a list-based layout
 */

get_header(); 
?>

<main id="primary" class="site-main referral-archive-template">
    <div class="referral-archive-header">
        <div class="referral-archive-header-content">
            <h1 class="referral-archive-title"><?php post_type_archive_title(); ?></h1>
            <div class="referral-archive-description">
                <?php echo wp_kses_post(get_the_archive_description()); ?>
            </div>
        </div>
    </div>

    <div class="referral-archive-content">
        <div class="referral-list">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('referral-item'); ?>>
                        <div class="referral-item-inner">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="referral-item-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'referral-logo')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="referral-item-content">
                                <h2 class="referral-item-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <?php
                                $signup_bonus = get_post_meta(get_the_ID(), 'signup_bonus', true);
                                if (!empty($signup_bonus)) : 
                                ?>
                                <div class="referral-item-bonus">
                                    <strong><?php esc_html_e('Sign-up Bonus:', 'referral-code-plugin'); ?></strong> 
                                    <?php echo esc_html($signup_bonus); ?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="referral-item-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="referral-item-meta">
                                    <span class="referral-item-date">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) :
                                    ?>
                                    <span class="referral-item-categories">
                                        <?php
                                        $cat_links = array();
                                        foreach ($categories as $category) {
                                            $cat_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                                        }
                                        echo implode(', ', $cat_links);
                                        ?>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="referral-item-action">
                                    <a href="<?php the_permalink(); ?>" class="referral-item-link">
                                        <?php esc_html_e('View Details', 'referral-code-plugin'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
                
                <div class="referral-pagination">
                    <?php the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('&laquo; Previous', 'referral-code-plugin'),
                        'next_text' => __('Next &raquo;', 'referral-code-plugin'),
                    )); ?>
                </div>
            <?php else : ?>
                <div class="no-referrals-found">
                    <p><?php esc_html_e('No referral codes found.', 'referral-code-plugin'); ?></p>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (is_active_sidebar('referral-sidebar')) : ?>
        <aside class="referral-sidebar">
            <?php dynamic_sidebar('referral-sidebar'); ?>
        </aside>
        <?php endif; ?>
    </div>
</main>

<style>
/* Minimal CSS for referral code archive page */
.referral-archive-template {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.referral-archive-header {
    margin-bottom: 30px;
}

.referral-archive-title {
    margin-bottom: 10px;
}

.referral-list {
    display: block;
    width: 100%;
}

.referral-item {
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
}

.referral-item-inner {
    display: flex;
    align-items: flex-start;
}

.referral-item-image {
    margin-right: 20px;
    flex-shrink: 0;
}

.referral-logo {
    width: 80px;
    height: 80px;
    object-fit: cover;
}

.referral-item-content {
    flex-grow: 1;
}

.referral-item-title {
    margin-top: 0;
    margin-bottom: 10px;
}

.referral-item-title a {
    text-decoration: none;
}

.referral-item-bonus {
    margin-bottom: 10px;
}

.referral-item-meta {
    font-size: 0.9em;
    color: #666;
    margin-top: 10px;
}

.referral-item-categories {
    margin-left: 10px;
}

.referral-item-action {
    margin-top: 15px;
}

.referral-item-link {
    display: inline-block;
    padding: 5px 15px;
    background-color: #f0f0f0;
    text-decoration: none;
    border-radius: 3px;
}

.referral-pagination {
    margin-top: 30px;
    text-align: center;
}

@media (max-width: 768px) {
    .referral-item-inner {
        flex-direction: column;
    }
    
    .referral-item-image {
        margin-right: 0;
        margin-bottom: 15px;
    }
}
</style>

<?php get_footer(); ?>
