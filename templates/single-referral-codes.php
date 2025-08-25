<?php
/**
 * Template Name: Single Referral Code
 * Description: Modern custom template for displaying referral code posts with enhanced UX
 */

get_header(); 

// Get meta fields and current year
$referral_code = get_post_meta( $post->ID, 'referral_code', true );
$referral_link = get_post_meta( $post->ID, 'referral_link', true );
$signup_bonus = get_post_meta( $post->ID, 'signup_bonus', true );
$app_logo = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
$rcp_faqs = get_post_meta( $post->ID, 'rcp_faqs', true );
$categories = get_the_category();
$category_name = !empty($categories) ? $categories[0]->name : 'Referral Program';
$current_year = date('Y');
?>

<main id="primary" class="site-main referral-template">
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <!-- Breadcrumb Navigation -->
            <div class="breadcrumb-container">
                <div class="breadcrumb">
                    <a href="<?php echo home_url(); ?>">Home</a>
                    <span class="breadcrumb-separator">></span>
                    <a href="<?php echo get_post_type_archive_link('referral-codes'); ?>">Referral Codes</a>
                    <span class="breadcrumb-separator">></span>
                    <span class="breadcrumb-current"><?php the_title(); ?> <?php echo ($referral_code) ? 'Referral Code' : 'Refer & Earn Offer'; ?> <?php echo $current_year; ?></span>
                </div>
            </div>
            
            <!-- Hero Section -->
            <div class="referral-hero">
                <div class="referral-hero-content">
                    <div class="referral-hero-card">
                        <?php if ($app_logo): ?>
                            <img src="<?php echo esc_url($app_logo); ?>" alt="<?php the_title(); ?>" class="referral-logo" width="150" height="150">
                        <?php endif; ?>
                        
                        <div class="referral-info">
                            <h1 class="entry-title"><?php the_title(); ?> <?php echo ($referral_code) ? 'Referral Code' : 'Refer & Earn Offer'; ?> <?php echo $current_year; ?></h1>
                            <div class="referral-category">
                                <?php
                                if ( ! empty( $categories ) ) {
                                    foreach ( $categories as $category ) {
                                        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
                                    }
                                }
                                ?>
                            </div>
                            
                            <div class="referral-rating">
                                <div class="rating-item">
                                    <span class="rating-label">🏷️</span>
                                    <span class="rating-value">4.5/5</span>
                                    <span class="stars">★★★★★</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="referral-actions">
                            <?php if ($referral_code): ?>
                                <div class="referral-code-display">
                                    <span><?php echo esc_html($referral_code); ?></span>
                                    <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_code); ?>', this)" aria-label="Copy referral code"></button>
                                </div>
                            <?php elseif ($referral_link): ?>
                                <div class="referral-code-display">
                                    <span>Direct Link</span>
                                    <a href="<?php echo esc_url($referral_link); ?>" target="_blank" rel="noopener" class="open-link-btn" aria-label="Open referral link in new tab"></a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($referral_link): ?>
                                <a href="<?php echo esc_url($referral_link); ?>" target="_blank" class="primary-action-btn" rel="noopener">
                                    Visit <?php the_title(); ?>
                                </a>
                            <?php else: ?>
                                <button class="primary-action-btn" onclick="scrollToSection('referral-details')">
                                    View Details
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- .entry-header -->

        <div class="">
            <!-- Main Content with Sidebar -->
            <div class="container-with-sidebar">
                <div class="main-content">
                    
                    <!-- Referral Details Section with Table -->
                    <?php if ($referral_code || $referral_link || $signup_bonus): ?>
                    <section class="card-section referral-details-section" id="referral-details">
                        <h2 class="section-header"><?php the_title() ?> <?php echo ($referral_code) ? 'Referral Details' : 'Referral Link Details'; ?></h2>
                        <table class="referral-details-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th><?php the_title() ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($referral_code): ?>
                                <tr>
                                    <td>Referral Code</td>
                                    <td><span><?php echo esc_html($referral_code); ?></span></td>
                                </tr>
                                <?php endif; ?>
                                
                                <?php if ($referral_link): ?>
                                <tr>
                                    <td>Referral Link</td>
                                    <td><a href=<?php echo esc_url($referral_link); ?> target="_blank"><?php echo esc_url($referral_link); ?> </a></td>
                                </tr>
                                <?php endif; ?>
                                
                                <?php if ($signup_bonus): ?>
                                <tr>
                                    <td>Signup Bonus</td>
                                    <td><strong style="color: var(--secondary-color);"><?php echo esc_html($signup_bonus); ?></strong></td>
                                </tr>
                                <?php endif; ?>
                                
                                <tr>
                                    <td>Last Updated</td>
                                    <td><?php echo get_the_modified_date('M j, Y'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <?php endif; ?>
                    
                    <!-- Content Section -->
                    <section class="card-section entry-content clearfix">
                        <h2 class="section-header">About <?php the_title(); ?> Referral Program</h2>
                        <div class="content-area">
                            <?php the_content(); ?>
                        </div>
                    </section>
                    
                    <!-- Enhanced Submit Referral Code Section with Two-Line Layout -->
                    <section class="card-section">
                        <div class="referral-submit-section">
                            <h3>Share Your <?php echo ($referral_code) ? 'Referral Code' : 'Referral Link'; ?> </h3>
                            <p>Help the community by sharing your working <?php echo ($referral_code) ? 'referral code' : 'referral link'; ?></p>
                            
                            <form class="submit-form" method="post" action="<?php echo esc_url(get_permalink()); ?>#comments">
                                <?php wp_nonce_field('referral_comment_nonce', 'referral_nonce'); ?>
                                <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                                <input type="hidden" name="comment_parent" value="0">
                                <input type="hidden" name="referral_code_submission" value="1">
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="author">Your Name *</label>
                                        <input type="text" id="author" name="author" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Your Email *</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="user-code">Your <?php echo ($referral_code) ? 'Referral Code' : 'Referral Link'; ?> *</label>
                                        <input type="text" id="user-code" name="user_referral_code" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn">Submit <?php echo ($referral_code) ? 'Code' : 'Link'; ?></button>
                                    </div>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label for="comment">Additional Notes (Optional)</label>
                                    <textarea id="comment" name="comment" rows="3" placeholder="Any special instructions or bonus details..."></textarea>
                                </div>
                            </form>
                        </div>
                    </section>
                    
                    <!-- Referral Codes Tabs -->
                    <section class="tabs-container">
                        <div class="tab-buttons">
                            <button class="tab-btn active" onclick="showTab('user-codes', this)"><?php echo ($referral_code) ? 'User Submitted Codes' : 'User Submitted Referral Links'; ?></button>
                            <button class="tab-btn" onclick="showTab('official-codes', this)"><?php echo ($referral_code) ? 'Official Codes' : 'Official Links'; ?></button>
                        </div>
                        
                        <!-- User Submitted Codes Tab -->
                        <div id="user-codes" class="tab-content active">
                            <div class="user-codes-list">
                                <?php
                                $comments = rcp_get_cached_comments(get_the_ID());
                                
                                if ($comments): ?>
                                    <?php foreach ($comments as $comment): ?>
                                    <div class="user-code-item">
                                        <div class="code-header">
                                            <div class="user-name">Submitted By: <?php echo esc_html($comment->comment_author); ?></div>
                                            <div class="code-date"><?php echo date('M j, Y', strtotime($comment->comment_date)); ?></div>
                                        </div>
                                        
                                        <?php 
                                        $user_referral_code = get_comment_meta($comment->comment_ID, 'user_referral_code', true);
                                        if (!$user_referral_code) {
                                            $comment_text = $comment->comment_content;
                                            preg_match('/(?:Code:|code:)\s*([A-Za-z0-9]+)/i', $comment_text, $matches);
                                            $user_referral_code = isset($matches[1]) ? $matches[1] : '';
                                        }
                                        ?>
                                        
                                        <?php if ($user_referral_code): ?>
                                        <div class="user-referral-display">
                                            <?php if ($referral_code): ?>
                                                <span><strong>Code:</strong> <?php echo esc_html($user_referral_code); ?></span>
                                                <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($user_referral_code); ?>', this)" aria-label="Copy user referral code"></button>
                                            <?php else: ?>
                                                <span><strong>Link:</strong> <a href="<?php echo esc_url($user_referral_code); ?>" target="_blank" rel="noopener"><?php echo esc_html($user_referral_code); ?></a></span>
                                                <a href="<?php echo esc_url($user_referral_code); ?>" target="_blank" rel="noopener" class="open-link-btn" aria-label="Open user referral link in new tab"></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if ($comment->comment_content): ?>
                                        <p class="comment-text"><?php echo wp_kses_post($comment->comment_content); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="empty-state">
                                        <div class="empty-icon">📝</div>
                                        <h4>No codes shared yet</h4>
                                        <p>Be the first to share your referral code with the community!</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Official Codes Tab -->
                        <div id="official-codes" class="tab-content">
                            <div class="user-codes-list">
                                <?php if ($referral_code || $referral_link): ?>
                                <div class="user-code-item official-code">
                                    <div class="code-header">
                                        <div class="user-name">
                                            <span class="crown-icon">👑</span><?php echo ($referral_code) ? 'Official Code' : 'Official Link'; ?>
                                        </div>
                                        <div class="code-date"><?php echo get_the_modified_date('M j, Y'); ?></div>
                                    </div>
                                    
                                    <?php if ($referral_code): ?>
                                    <div class="user-referral-display">
                                        <span><strong>Code:</strong> <?php echo esc_html($referral_code); ?></span>
                                        <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_code); ?>', this)" aria-label="Copy official referral code"></button>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($referral_link): ?>
                                    <div class="user-referral-display" style="margin-top: 8px;">
                                        <span><strong>Link:</strong> <a href="<?php echo esc_url($referral_link); ?>" target="_blank" rel="noopener"><?php echo esc_html($referral_link); ?></a></span>
                                        <a href="<?php echo esc_url($referral_link); ?>" target="_blank" rel="noopener" class="open-link-btn" aria-label="Open official referral link in new tab"></a>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <p class="comment-text">
                                        Official referral <?php echo $referral_code ? 'code' : 'link'; ?> with guaranteed signup bonus and best rates.
                                    </p>
                                </div>
                                <?php else: ?>
                                    <div class="empty-state">
                                        <div class="empty-icon">🏢</div>
                                        <h4>No official codes available</h4>
                                        <p>Check back later for official referral codes.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                    
                    <!-- FAQs Section with Schema -->
                    <section class="card-section faq-section">
                        <h2 class="section-header">Frequently Asked Questions</h2>
                        <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
                            <?php
                            if ( ! empty( $rcp_faqs ) ) {
                                foreach ( $rcp_faqs as $faq ) {
                                    $question = str_replace(
                                        array( '{{post_title}}', '{{referral_code}}' ),
                                        array( get_the_title(), $referral_code ),
                                        $faq['question']
                                    );
                                    $answer = str_replace(
                                        array( '{{post_title}}', '{{referral_code}}', '{{signup_bonus}}', '{{referral_link}}' ),
                                        array( get_the_title(), $referral_code, $signup_bonus, $referral_link ),
                                        $faq['answer']
                                    );
                                    ?>
                                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                        <h3 class="faq-question" itemprop="name"><?php echo esc_html( $question ); ?></h3>
                                        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                            <div itemprop="text">
                                                <p><?php echo wp_kses_post( $answer ); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </section>
                    
                </div>
                
                <!-- WordPress Dynamic Sidebar -->
                <aside class="sidebar">
                    <?php if (is_active_sidebar('referral-sidebar')) : ?>
                        <?php dynamic_sidebar('referral-sidebar'); ?>
                        <!-- Default sidebar content if no widgets are added -->
                        
                    <?php endif; ?>
                </aside>
            </div>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php // You can add footer content here if needed ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->
    <?php endwhile; ?>
</main><!-- #main -->

<?php
// Handle referral code submission
if (isset($_POST['referral_code_submission']) && wp_verify_nonce($_POST['referral_nonce'], 'referral_comment_nonce')) {
    $comment_data = array(
        'comment_post_ID' => intval($_POST['comment_post_ID']),
        'comment_author' => sanitize_text_field($_POST['author']),
        'comment_author_email' => sanitize_email($_POST['email']),
        'comment_content' => sanitize_textarea_field($_POST['comment']),
        'comment_type' => '',
        'comment_parent' => 0,
        'comment_approved' => 0, // Set to pending for moderation
    );
    
    $comment_id = wp_insert_comment($comment_data);
    
    if ($comment_id) {
        // Save the referral code as comment meta
        add_comment_meta($comment_id, 'user_referral_code', sanitize_text_field($_POST['user_referral_code']));
        
        // Redirect to avoid resubmission
        wp_redirect(get_permalink() . '#comments');
        exit;
    }
}


?>

<script defer>
// Optimized JavaScript for better performance
(function() {
    'use strict';
    
    // Copy to clipboard with modern approach
    window.copyToClipboard = function(text, button) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(() => showCopySuccess(button))
                .catch(() => fallbackCopy(text, button));
        } else {
            fallbackCopy(text, button);
        }
    };
    
    function fallbackCopy(text, button) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.cssText = 'position:fixed;left:-999999px;top:-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showCopySuccess(button);
        } catch (err) {
            console.error('Copy failed:', err);
        }
        
        document.body.removeChild(textArea);
    }
    
    function showCopySuccess(button) {
        button.classList.add('copied');
        showToast('Copied to clipboard!', 'success');
        setTimeout(() => button.classList.remove('copied'), 2000);
    }
    
    // Toast notifications
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        requestAnimationFrame(() => toast.classList.add('show'));
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }
    
    // Tab switching
    window.showTab = function(tabId, button) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        document.getElementById(tabId).classList.add('active');
        button.classList.add('active');
    };
    
    // Smooth scroll
    window.scrollToSection = function(sectionId) {
        const element = document.getElementById(sectionId);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };
    
    // Form enhancements
    function initForm() {
        const form = document.querySelector('.submit-form');
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('.submit-btn');
            submitBtn.style.opacity = '0.7';
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                submitBtn.style.opacity = '1';
                submitBtn.textContent = 'Submit Code';
                submitBtn.disabled = false;
            }, 5000);
        });
        
        // Real-time validation
        form.querySelectorAll('input[required], textarea[required]').forEach(input => {
            input.addEventListener('blur', function() {
                this.style.borderColor = !this.value.trim() ? '#ef4444' : 'var(--secondary-color)';
            });
            
            input.addEventListener('input', function() {
                if (this.style.borderColor === 'rgb(239, 68, 68)') {
                    this.style.borderColor = 'var(--border-color)';
                }
            });
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initForm();
        });
    } else {
        initForm();
    }
})();
</script>

<?php get_footer(); ?>
