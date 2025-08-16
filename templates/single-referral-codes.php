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
$categories = get_the_category();
$category_name = !empty($categories) ? $categories[0]->name : 'Referral Program';
$current_year = date('Y');
?>

<div class="referral-template">
    <?php while ( have_posts() ) : the_post(); ?>
    
    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb-container">
        <div class="breadcrumb">
            <a href="<?php echo home_url(); ?>">Home</a>
            <span class="breadcrumb-separator">></span>
            <a href="<?php echo get_post_type_archive_link('referral_code'); ?>">Referral Codes</a>
            <span class="breadcrumb-separator">></span>
            <span class="breadcrumb-current"><?php the_title(); ?> Referral Code <?php echo $current_year; ?></span>
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
                    <h1><?php the_title(); ?> Referral Code <?php echo $current_year; ?></h1>
                    <div class="referral-category"><?php echo esc_html($category_name); ?></div>
                    
                    <div class="referral-rating">
                        <div class="rating-item">
                            <span class="rating-label">🏷️</span>
                            <span class="rating-value">4.5/5</span>
                            <span class="stars">★★★★★</span>
                        </div>
                    </div>
                    
                    <div class="referral-highlights">
                        <?php if ($signup_bonus): ?>
                        <div class="highlight-item">
                            <div class="highlight-label">Signup Bonus</div>
                            <div class="highlight-value"><?php echo esc_html($signup_bonus); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($referral_code): ?>
                        <div class="highlight-item">
                            <div class="highlight-label">Referral Code</div>
                            <div class="highlight-value"><?php echo esc_html($referral_code); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="highlight-item">
                            <div class="highlight-label">Processing Time</div>
                            <div class="highlight-value">Instant</div>
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
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_link); ?>', this)" aria-label="Copy referral link"></button>
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
    
    <!-- Main Content with Sidebar -->
    <div class="container-with-sidebar">
        <main class="main-content">
            
            <!-- Referral Details Section with Table -->
            <?php if ($referral_code || $referral_link || $signup_bonus): ?>
            <section class="card-section referral-details-section" id="referral-details">
                <h2 class="section-header"><?php the_title() ?> Referral Details</h2>
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
            <section class="card-section">
                <h2 class="section-header">About This Referral Program</h2>
                <div class="content-area">
                    <?php the_content(); ?>
                </div>
            </section>
            
            <!-- Enhanced Submit Referral Code Section with Two-Line Layout -->
            <section class="card-section">
                <div class="referral-submit-section">
                    <h3>Share Your Referral Code <?php echo $current_year; ?></h3>
                    <p>Help the community by sharing your working referral code</p>
                    
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
                                <label for="user-code">Your Referral Code *</label>
                                <input type="text" id="user-code" name="user_referral_code" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="submit-btn">Submit Code</button>
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
                    <button class="tab-btn active" onclick="showTab('user-codes', this)">User Submitted Codes</button>
                    <button class="tab-btn" onclick="showTab('official-codes', this)">Official Codes</button>
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
                                    <span><strong>Code:</strong> <?php echo esc_html($user_referral_code); ?></span>
                                    <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($user_referral_code); ?>', this)" aria-label="Copy user referral code"></button>
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
                                    <span class="crown-icon">👑</span>Official Code
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
                                <span><strong>Link:</strong> <span class="link-description">Direct registration</span></span>
                                <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_link); ?>', this)" aria-label="Copy official referral link"></button>
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
                    
                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 class="faq-question" itemprop="name">How do I use the <?php the_title(); ?> referral code?</h3>
                        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div itemprop="text">
                                <p>Copy the referral code and enter it during the signup process on <?php the_title(); ?>. The bonus will be credited to your account after completing the required actions.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 class="faq-question" itemprop="name">When will I receive my signup bonus?</h3>
                        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div itemprop="text">
                                <p>Most referral bonuses are processed instantly or within 24-48 hours after meeting the minimum requirements. Check the specific terms and conditions for exact timing.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 class="faq-question" itemprop="name">Can I use multiple referral codes?</h3>
                        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div itemprop="text">
                                <p>No, typically only one referral code can be used per account. Make sure to use the best available code during your initial signup.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 class="faq-question" itemprop="name">Are these referral codes safe to use?</h3>
                        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div itemprop="text">
                                <p>Yes, all referral codes are legitimate promotional offers from <?php the_title(); ?>. Using referral codes is a standard practice and helps both new and existing users benefit from bonuses.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 class="faq-question" itemprop="name">What should I do if my referral code doesn't work?</h3>
                        <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <div itemprop="text">
                                <p>If a referral code doesn't work, try another code from our list or contact <?php the_title(); ?> customer support for assistance. Codes may expire or have usage limits.</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>
            
        </main>
        
        <!-- WordPress Dynamic Sidebar -->
        <aside class="sidebar">
            <?php if (is_active_sidebar('referral-sidebar')) : ?>
                <?php dynamic_sidebar('referral-sidebar'); ?>
            <?php else : ?>
                <!-- Default sidebar content if no widgets are added -->
                <div class="sidebar-card default-sidebar">
                    <h3>Quick Stats</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">4.5</span>
                            <span class="stat-label">Rating</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo wp_count_comments(get_the_ID())->approved; ?></span>
                            <span class="stat-label">Codes</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24h</span>
                            <span class="stat-label">Support</span>
                        </div>
                    </div>
                </div>
                
                <div class="sidebar-card default-sidebar">
                    <h3>Key Features</h3>
                    <ul class="features-list">
                        <li><span class="check-icon">✓</span> Instant signup bonus</li>
                        <li><span class="check-icon">✓</span> Fast processing</li>
                        <li><span class="check-icon">✓</span> Secure platform</li>
                        <li><span class="check-icon">✓</span> 24/7 customer support</li>
                        <li><span class="check-icon">✓</span> Multiple payment options</li>
                    </ul>
                </div>
            <?php endif; ?>
        </aside>
    </div>
    
    <?php endwhile; ?>
</div>

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
    
    // FAQ toggle functionality
    function initFAQs() {
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentNode;
                const answer = faqItem.querySelector('.faq-answer');
                const isOpen = faqItem.classList.contains('open');
                
                // Close all other FAQs
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('open');
                });
                
                if (!isOpen) {
                    faqItem.classList.add('open');
                }
            });
        });
    }
    
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
            initFAQs();
            initForm();
        });
    } else {
        initFAQs();
        initForm();
    }
})();
</script>

<?php get_footer(); ?>
