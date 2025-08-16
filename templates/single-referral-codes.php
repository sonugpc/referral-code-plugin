<?php
/**
 * Template Name: Single Referral Code
 * Description: Custom template for displaying referral code posts
 */

get_header(); ?>

<style>
/* Custom styles for referral code template */
.referral-template {
    background-color: #ffffff;
    min-height: 100vh;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.referral-hero {
    background: #ffffff;
    padding: 40px 0;
    margin-bottom: 30px;
    border-bottom: 2px solid #2563eb;
}

.referral-hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    color: #1f2937;
}

.referral-hero-inner {
    background: #ffffff;
    border: 2px solid #2563eb;
    border-radius: 12px;
    padding: 30px;
    display: flex;
    align-items: center;
    gap: 30px;
}

.referral-logo {
    width: 120px;
    height: 120px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #2563eb;
}

.referral-info h1 {
    margin: 0 0 10px 0;
    font-size: 2.2rem;
    font-weight: 600;
    color: #1f2937;
}

.referral-category {
    display: inline-block;
    background: #ffffff;
    border: 1px solid #2563eb;
    color: #2563eb;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin: 10px 0;
}

.referral-rating {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 15px;
}

.stars {
    color: #2563eb;
    font-size: 1.1rem;
}

.rating-text {
    font-size: 0.95rem;
    color: #6b7280;
}

.container-with-sidebar {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 30px;
}

.main-content {
    background: #ffffff;
    border: 2px solid #2563eb;
    border-radius: 12px;
    padding: 30px;
}

.referral-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin: 30px 0;
}

.referral-detail-box {
    background: #ffffff;
    border: 2px solid #2563eb;
    color: #1f2937;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
}

.detail-label {
    font-size: 0.85rem;
    color: #6b7280;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

.detail-value {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1f2937;
}

.referral-code-value {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    padding: 12px 15px;
    border-radius: 8px;
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', monospace;
    margin-top: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1rem;
}

.copy-btn {
    background: #ffffff;
    border: 1px solid #2563eb;
    color: #2563eb;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.copy-btn:hover {
    background: #2563eb;
    color: #ffffff;
}

.content-area {
    margin: 30px 0;
    line-height: 1.7;
    color: #374151;
}

.content-area h2 {
    color: #1f2937;
    border-bottom: 2px solid #2563eb;
    padding-bottom: 12px;
    margin-bottom: 24px;
    font-size: 1.5rem;
    font-weight: 600;
}

.sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sidebar-box {
    background: #ffffff;
    border: 2px solid #2563eb;
    border-radius: 12px;
    padding: 24px;
}

.sidebar-box h3 {
    margin: 0 0 16px 0;
    color: #1f2937;
    font-size: 1.2rem;
    font-weight: 600;
}

.user-submission-info {
    background: #ffffff;
    border: 2px solid #2563eb;
}

.submission-stats {
    display: flex;
    justify-content: space-between;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #e5e7eb;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2563eb;
}

.stat-label {
    font-size: 0.8rem;
    color: #6b7280;
    font-weight: 500;
}

.referral-submit-box {
    background: #ffffff;
    border: 2px dashed #2563eb;
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    margin: 40px 0;
}

.referral-submit-box h3 {
    color: #1f2937;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.referral-submit-box p {
    color: #6b7280;
    margin-bottom: 24px;
}

.submit-form {
    display: grid;
    gap: 16px;
    max-width: 500px;
    margin: 0 auto;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    text-align: left;
}

.form-group label {
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

.form-group input,
.form-group textarea {
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.2s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #2563eb;
}

.submit-btn {
    background: #2563eb;
    color: #ffffff;
    border: none;
    padding: 14px 28px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 8px;
}

.submit-btn:hover {
    background: #1d4ed8;
}

.referral-tabs {
    margin: 40px 0;
}

.tab-buttons {
    display: flex;
    gap: 2px;
    margin-bottom: 20px;
    border: 2px solid #2563eb;
    border-radius: 8px;
    overflow: hidden;
}

.tab-btn {
    background: #ffffff;
    border: none;
    padding: 12px 24px;
    cursor: pointer;
    font-weight: 500;
    color: #2563eb;
    transition: all 0.2s ease;
    flex: 1;
    font-size: 0.95rem;
}

.tab-btn:hover {
    background: #eff6ff;
}

.tab-btn.active {
    background: #2563eb;
    color: #ffffff;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.user-submitted-codes {
    display: grid;
    gap: 16px;
}

.user-code-item {
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
}

.user-code-item:hover {
    border-color: #2563eb;
    transition: border-color 0.2s ease;
}

.code-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.user-name {
    font-weight: 600;
    color: #1f2937;
    font-size: 0.95rem;
}

.code-date {
    font-size: 0.85rem;
    color: #6b7280;
}

.user-referral-code {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    padding: 12px;
    border-radius: 8px;
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', monospace;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 12px 0;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .container-with-sidebar {
        grid-template-columns: 1fr;
    }
    
    .referral-hero-inner {
        flex-direction: column;
        text-align: center;
    }
    
    .referral-details-grid {
        grid-template-columns: 1fr;
    }
    
    .referral-info h1 {
        font-size: 1.8rem;
    }
}
</style>

<div class="referral-template">
    <?php while ( have_posts() ) : the_post(); 
        // Get meta fields
        $referral_code = get_post_meta( $post->ID, 'referral_code', true );
        $referral_link = get_post_meta( $post->ID, 'referral_link', true );
        $signup_bonus = get_post_meta( $post->ID, 'signup_bonus', true );
        $app_logo = get_the_post_thumbnail_url( $post->ID, 'thumbnail' );
        
        // Get categories
        $categories = get_the_category();
        $category_name = !empty($categories) ? $categories[0]->name : 'Referral Program';
    ?>
    
    <!-- Hero Section - Full Width -->
    <div class="referral-hero">
        <div class="referral-hero-content">
            <div class="referral-hero-inner">
                <?php if ($app_logo): ?>
                    <img src="<?php echo esc_url($app_logo); ?>" alt="<?php the_title(); ?>" class="referral-logo">
                <?php endif; ?>
                
                <div class="referral-info">
                    <h1><?php the_title(); ?></h1>
                    <div class="referral-category"><?php echo esc_html($category_name); ?></div>
                    <div class="referral-rating">
                        <div class="stars">★★★★★</div>
                        <div class="rating-text">4.5 (1,234 reviews)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content with Sidebar -->
    <div class="container-with-sidebar">
        <main class="main-content">
            <!-- Referral Details Grid -->
            <?php if ($referral_code || $referral_link || $signup_bonus): ?>
            <div class="referral-details-grid">
                <?php if ($referral_code): ?>
                <div class="referral-detail-box">
                    <div class="detail-label">Referral Code</div>
                    <div class="detail-value">
                        <div class="referral-code-value">
                            <span><?php echo esc_html($referral_code); ?></span>
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_code); ?>')">Copy</button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($signup_bonus): ?>
                <div class="referral-detail-box">
                    <div class="detail-label">Signup Bonus</div>
                    <div class="detail-value"><?php echo esc_html($signup_bonus); ?></div>
                </div>
                <?php endif; ?>
                
                <?php if ($referral_link): ?>
                <div class="referral-detail-box">
                    <div class="detail-label">Referral Link</div>
                    <div class="detail-value">
                        <div class="referral-code-value">
                            <span style="font-size: 0.9rem; word-break: break-all;"><?php echo esc_html(substr($referral_link, 0, 30)) . '...'; ?></span>
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_link); ?>')">Copy</button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <!-- Content Area -->
            <div class="content-area">
                <h2>About This Referral Program</h2>
                <?php the_content(); ?>
            </div>
            
            <!-- Referral Code Submission Box -->
            <div class="referral-submit-box">
                <h3>📤 Submit Your Referral Code</h3>
                <p>Help the community by sharing your referral code!</p>
                
                <form class="submit-form" id="referral-submit-form">
                    <div class="form-group">
                        <label for="user-name">Your Name</label>
                        <input type="text" id="user-name" name="user-name" required>
                    </div>
                    <div class="form-group">
                        <label for="user-code">Your Referral Code</label>
                        <input type="text" id="user-code" name="user-code" required>
                    </div>
                    <div class="form-group">
                        <label for="user-message">Additional Details (Optional)</label>
                        <textarea id="user-message" name="user-message" rows="3" placeholder="Any special instructions or notes..."></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit Referral Code</button>
                </form>
            </div>
            
            <!-- Referral Codes Tabs -->
            <div class="referral-tabs">
                <div class="tab-buttons">
                    <button class="tab-btn active" onclick="showTab('user-codes')">User Submitted Codes</button>
                    <button class="tab-btn" onclick="showTab('bigtricks-codes')">BigTricks Codes</button>
                </div>
                
                <!-- User Submitted Codes Tab -->
                <div id="user-codes" class="tab-content active">
                    <div class="user-submitted-codes">
                        <?php
                        // Get comments for this post
                        $comments = get_comments(array(
                            'post_id' => get_the_ID(),
                            'status' => 'approve',
                            'number' => 10
                        ));
                        
                        if ($comments): ?>
                            <?php foreach ($comments as $comment): ?>
                            <div class="user-code-item">
                                <div class="code-header">
                                    <div class="user-name"><?php echo esc_html($comment->comment_author); ?></div>
                                    <div class="code-date"><?php echo date('M j, Y', strtotime($comment->comment_date)); ?></div>
                                </div>
                                
                                <?php 
                                // Extract referral code from comment (assuming it's in the format "Code: XXXXX")
                                $comment_text = $comment->comment_content;
                                preg_match('/(?:Code:|code:)\s*([A-Za-z0-9]+)/i', $comment_text, $matches);
                                $extracted_code = isset($matches[1]) ? $matches[1] : '';
                                ?>
                                
                                <?php if ($extracted_code): ?>
                                <div class="user-referral-code">
                                    <span><strong>Code:</strong> <?php echo esc_html($extracted_code); ?></span>
                                    <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($extracted_code); ?>')">Copy</button>
                                </div>
                                <?php endif; ?>
                                
                                <p><?php echo wp_kses_post($comment_text); ?></p>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="text-align: center; color: #666; padding: 40px;">No user codes submitted yet. Be the first to share!</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- BigTricks Codes Tab -->
                <div id="bigtricks-codes" class="tab-content">
                    <div class="user-submitted-codes">
                        <?php if ($referral_code): ?>
                        <div class="user-code-item">
                            <div class="code-header">
                                <div class="user-name">BigTricks Official</div>
                                <div class="code-date"><?php echo date('M j, Y'); ?></div>
                            </div>
                            <div class="user-referral-code">
                                <span><strong>Code:</strong> <?php echo esc_html($referral_code); ?></span>
                                <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_code); ?>')">Copy</button>
                            </div>
                            <p>Official referral code from BigTricks. Get the best signup bonus!</p>
                        </div>
                        <?php else: ?>
                            <p style="text-align: center; color: #666; padding: 40px;">No BigTricks codes available yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- User Submission Info -->
            <div class="sidebar-box user-submission-info">
                <h3>📊 Community Stats</h3>
                <p>Join thousands of users sharing referral codes!</p>
                <div class="submission-stats">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo wp_count_comments(get_the_ID())->approved; ?></div>
                        <div class="stat-label">Codes Shared</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">4.8</div>
                        <div class="stat-label">Avg Rating</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Info -->
            <div class="sidebar-box">
                <h3>🔥 Quick Info</h3>
                    <ul style="list-style: none; padding: 0;">
                    <li style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #374151; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #2563eb;">✓</span> Instant Activation
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #374151; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #2563eb;">✓</span> No Hidden Fees
                    </li>
                    <li style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #374151; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #2563eb;">✓</span> Bonus Rewards
                    </li>
                    <li style="padding: 10px 0; color: #374151; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #2563eb;">✓</span> Mobile App Available
                    </li>
                </ul>
            </div>
            
            <!-- Related Posts -->
            <div class="sidebar-box">
                <h3>🔗 Related Offers</h3>
                <?php
                $related_posts = get_posts(array(
                    'post_type' => get_post_type(),
                    'numberposts' => 3,
                    'exclude' => array(get_the_ID()),
                    'category__in' => wp_get_post_categories(get_the_ID())
                ));
                
                if ($related_posts): ?>
                    <ul style="list-style: none; padding: 0;">
                        <?php foreach ($related_posts as $related): ?>
                        <li style="margin-bottom: 15px;">
                            <a href="<?php echo get_permalink($related->ID); ?>" style="text-decoration: none; color: #333; font-weight: 500;">
                                <?php echo esc_html($related->post_title); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
    </div>
    
    <?php endwhile; ?>
</div>

<script>
// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target;
        const originalText = btn.textContent;
        btn.textContent = 'Copied!';
        btn.style.background = 'rgba(34, 197, 94, 0.3)';
        
        setTimeout(() => {
            btn.textContent = originalText;
            btn.style.background = 'rgba(255, 255, 255, 0.3)';
        }, 2000);
    });
}

// Tab switching function
function showTab(tabId) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(tab => tab.classList.remove('active'));
    
    // Remove active class from all buttons
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => btn.classList.remove('active'));
    
    // Show selected tab
    document.getElementById(tabId).classList.add('active');
    event.target.classList.add('active');
}

// Handle form submission
document.getElementById('referral-submit-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const userName = formData.get('user-name');
    const userCode = formData.get('user-code');
    const userMessage = formData.get('user-message');
    
    // Create comment content with code format
    const commentContent = `Code: ${userCode}\n\n${userMessage}`;
    
    // Here you would typically submit to WordPress comment system
    // For now, we'll show a success message
    alert('Thank you for submitting your referral code! It will be reviewed and published soon.');
    
    // Reset form
    this.reset();
});
</script>

<?php get_footer(); ?>