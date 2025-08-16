<?php
/**
 * Template Name: Single Referral Code
 * Description: Modern custom template for displaying referral code posts with enhanced UX
 */

get_header(); ?>

<style>
/* Modern CSS Variables for consistent theming */
:root {
    --primary-hover: #5856eb;
    --primary-light: #e0e7ff;
    --secondary-color: #10b981;
    --background-color: #f8fafc;
    --card-background: #ffffff;
    --border-color: #e2e8f0;
    --text-primary: #0f172a;
    --text-secondary: #64748b;
    --text-muted: #94a3b8;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 24px;
}

/* Base template styles */
.referral-template {
    background-color: var(--background-color);
    min-height: 100vh;
}

/* Breadcrumb styles */
.breadcrumb-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 16px 16px 0 16px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: 24px;
}

.breadcrumb a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: color 0.2s ease;
}

.breadcrumb a:hover {
    color: var(--g-color);
}

.breadcrumb-separator {
    color: var(--text-muted);
    margin: 0 4px;
}

.breadcrumb-current {
    color: var(--text-primary);
    font-weight: 500;
}

/* Hero section with modern design */
.referral-hero {
    padding: 0;
    margin-bottom: 32px;
}

.referral-hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
}

.referral-hero-card {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-xl);
    padding: 32px;
    display: flex;
    align-items: center;
    gap: 32px;
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
}

.referral-hero-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--g-color), var(--secondary-color));
}

.referral-logo {
    width: 120px;
    height: 120px;
    border-radius: var(--radius-lg);
    object-fit: cover;
    border: 2px solid var(--border-color);
    flex-shrink: 0;
    box-shadow: var(--shadow-md);
}

.referral-info {
    flex: 1;
}

.referral-info h1 {
    margin: 0 0 16px 0;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1.2;
    background: linear-gradient(135deg, var(--text-primary), var(--g-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.referral-category {
    display: inline-flex;
    align-items: center;
    background: var(--primary-light);
    color: var(--g-color);
    padding: 8px 16px;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 16px;
    border: 1px solid var(--g-color);
}

.referral-rating {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.rating-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f8fafc;
    padding: 8px 12px;
    border-radius: var(--radius-md);
    border: 1px solid var(--border-color);
}

.rating-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.rating-value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 700;
}

.stars {
    color: #f59e0b;
    font-size: 1rem;
}

.referral-highlights {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.highlight-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.highlight-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.highlight-value {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 700;
}

/* Action buttons section */
.referral-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: stretch;
    min-width: 280px;
}

.primary-action-btn {
    background: linear-gradient(135deg, var(--g-color), var(--primary-hover));
    color: white;
    border: none;
    padding: 16px 32px;
    border-radius: var(--radius-lg);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
}

.primary-action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s;
}

.primary-action-btn:hover::before {
    left: 100%;
}

.primary-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.referral-code-display {
    background: var(--card-background);
    border: 2px solid var(--g-color);
    padding: 16px 20px;
    border-radius: var(--radius-lg);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    gap: 16px;
    position: relative;
    overflow: hidden;
}

.referral-code-display::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, var(--primary-light) 0%, transparent 50%);
    opacity: 0.3;
}

.copy-btn {
    background: var(--g-color);
    color: white;
    border: none;
    padding: 12px;
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 48px;
    min-height: 48px;
    position: relative;
    z-index: 1;
    box-shadow: var(--shadow-sm);
}

.copy-btn:before {
    content: '';
    width: 20px;
    height: 20px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect width='14' height='14' x='8' y='8' rx='2' ry='2'/%3E%3Cpath d='M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2'/%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    transition: all 0.3s ease;
}

.copy-btn:hover {
    background: var(--primary-hover);
    transform: translateY(-1px) scale(1.05);
    box-shadow: var(--shadow-md);
}

.copy-btn.copied {
    background: var(--secondary-color);
}

.copy-btn.copied:before {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m9 12 2 2 4-4'/%3E%3C/svg%3E");
}

/* Main container */
.container-with-sidebar {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 32px;
}

.main-content {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

/* Modern card sections */
.card-section {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    padding: 32px;
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
}

.section-header {
    margin: 0 0 24px 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    position: relative;
    padding-bottom: 16px;
}

.section-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--g-color), var(--secondary-color);
    border-radius: 2px;
}

/* Modern referral details with primary theme */
.referral-details-section {
    border: 2px solid var(--g-color);
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--card-background) 100%);
    position: relative;
}

.referral-details-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--g-color), var(--secondary-color);
}

.referral-details-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
}

.referral-details-table th,
.referral-details-table td {
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.referral-details-table th {
    background: rgba(99, 102, 241, 0.1);
    font-weight: 600;
    color: var(--g-color);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.referral-details-table td {
    color: var(--text-primary);
    font-weight: 500;
}

.referral-details-table tr:last-child th,
.referral-details-table tr:last-child td {
    border-bottom: none;
}

.table-code-display {
    background: var(--card-background);
    border: 1px solid var(--g-color);
    padding: 8px 12px;
    border-radius: var(--radius-sm);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', monospace;
    font-size: 0.875rem;
    font-weight: 600;
}

.table-copy-btn {
    background: var(--g-color);
    color: white;
    border: none;
    padding: 4px 8px;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.table-copy-btn:hover {
    background: var(--primary-hover);
    transform: scale(1.05);
}

/* Modern form styling */
.referral-submit-section {
    background: linear-gradient(135deg, var(--primary-light) 0%, var(--card-background) 100%);
    border: 2px solid var(--g-color);
    border-radius: var(--radius-lg);
    padding: 32px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.referral-submit-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--g-color), var(--secondary-color);
}

.submit-form {
    display: grid;
    gap: 20px;
    max-width: 500px;
    margin: 24px auto 0;
}

.form-group {
    text-align: left;
}

.form-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 16px;
    border: 2px solid var(--border-color);
    border-radius: var(--radius-md);
    font-size: 1rem;
    transition: all 0.3s ease;
    box-sizing: border-box;
    background: var(--card-background);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--g-color);
    box-shadow: 0 0 0 4px var(--primary-light);
    transform: translateY(-1px);
}

.submit-btn {
    background: linear-gradient(135deg, var(--g-color), var(--primary-hover));
    color: white;
    border: none;
    padding: 16px 32px;
    border-radius: var(--radius-md);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-md);
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Modern tabs */
.tabs-container {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
}

.tab-buttons {
    display: flex;
    background: #f8fafc;
    border-bottom: 1px solid var(--border-color);
}

.tab-btn {
    flex: 1;
    background: transparent;
    border: none;
    padding: 20px 24px;
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-secondary);
    transition: all 0.3s ease;
    position: relative;
}

.tab-btn:hover {
    color: var(--text-primary);
    background: #f1f5f9;
}

.tab-btn.active {
    color: var(--g-color);
    background: var(--card-background);
}

.tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--g-color);
}

.tab-content {
    padding: 32px;
    display: none;
}

.tab-content.active {
    display: block;
}

/* User codes styling */
.user-codes-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.user-code-item {
    border: 1px solid var(--border-color);
    border-radius: var(--radius-md);
    padding: 20px;
    background: #f8fafc;
    transition: all 0.3s ease;
}

.user-code-item:hover {
    border-color: var(--g-color);
    box-shadow: var(--shadow-sm);
}

.code-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.user-name {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1rem;
}

.code-date {
    font-size: 0.875rem;
    color: var(--text-muted);
}

.user-referral-display {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    padding: 12px 16px;
    border-radius: var(--radius-md);
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', monospace;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 12px 0;
    font-size: 0.875rem;
}

/* Sidebar styles */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.sidebar-card {
    background: var(--card-background);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-md);
}

.sidebar-card h3 {
    margin: 0 0 20px 0;
    color: var(--text-primary);
    font-size: 1.25rem;
    font-weight: 600;
}

/* Responsive design */
@media (max-width: 768px) {
    .container-with-sidebar {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .referral-hero-card {
        flex-direction: column;
        text-align: center;
        padding: 24px;
        gap: 24px;
    }
    
    .referral-info h1 {
        font-size: 2rem;
    }
    
    .referral-highlights {
        justify-content: center;
        gap: 24px;
    }
    
    .referral-actions {
        width: 100%;
        min-width: auto;
    }
    
    .referral-details-table {
        font-size: 0.875rem;
    }
    
    .referral-details-table th,
    .referral-details-table td {
        padding: 12px 8px;
    }
    
    .tab-buttons {
        flex-direction: column;
    }
    
    .card-section {
        padding: 24px;
    }
}

@media (max-width: 480px) {
    .referral-hero-content,
    .container-with-sidebar {
        padding: 0 12px;
    }
    
    .breadcrumb-container {
        padding: 12px 12px 0 12px;
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
        $current_year = date('Y');
    ?>
    
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
                    <img src="<?php echo esc_url($app_logo); ?>" alt="<?php the_title(); ?>" class="referral-logo">
                <?php endif; ?>
                
                <div class="referral-info">
                    <h1><?php the_title(); ?> Referral Code [currentyear]</h1>
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
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_code); ?>', this)"></button>
                        </div>
                    <?php elseif ($referral_link): ?>
                        <div class="referral-code-display">
                            <span>Direct Link</span>
                            <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_link); ?>', this)"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($referral_link): ?>
                        <a href="<?php echo esc_url($referral_link); ?>" target="_blank" class="primary-action-btn">
                            Visit  <?php echo the_title(); ?>
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
            <div class="card-section referral-details-section" id="referral-details">
                <h2 class="section-header">Referral Details</h2>
                <table class="referral-details-table">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($referral_code): ?>
                        <tr>
                            <td>Referral Code</td>
                            <td>
                                 <span><?php echo esc_html($referral_code); ?></span>
                            </td>
                        </tr>
                        <?php endif; ?>
                        
                        <?php if ($referral_link): ?>
                        <tr>
                            <td>Referral Link</td>
                            <td>
                              <?php echo esc_html($referral_link); ?>
                            </td>
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
            </div>
            <?php endif; ?>
            
            <!-- Content Section -->
            <div class="card-section">
                <h2 class="section-header">About This Referral Program</h2>
                <div class="content-area">
                    <?php the_content(); ?>
                </div>
            </div>
            
            <!-- Enhanced Submit Referral Code Section -->
            <div class="card-section">
                <div class="referral-submit-section">
                    <h3 style="margin: 0 0 8px 0; color: var(--text-primary); font-size: 1.5rem; font-weight: 700;">Share Your Referral Code</h3>
                    <p style="color: var(--text-secondary); font-size: 1rem; margin: 0 0 24px 0;">Help the community by sharing your working referral code</p>
                    
                    <form class="submit-form" method="post" action="<?php echo esc_url(get_permalink()); ?>#comments">
                        <?php wp_nonce_field('referral_comment_nonce', 'referral_nonce'); ?>
                        <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                        <input type="hidden" name="comment_parent" value="0">
                        <input type="hidden" name="referral_code_submission" value="1">
                        
                        <div class="form-group">
                            <label for="author">Your Name *</label>
                            <input type="text" id="author" name="author" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="user-code">Your Referral Code *</label>
                            <input type="text" id="user-code" name="user_referral_code" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Additional Notes (Optional)</label>
                            <textarea id="comment" name="comment" rows="3" placeholder="Any special instructions or bonus details..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Submit Code</button>
                    </form>
                </div>
            </div>
            
            <!-- Referral Codes Tabs -->
            <div class="tabs-container">
                <div class="tab-buttons">
                    <button class="tab-btn active" onclick="showTab('user-codes', this)">User Submitted Codes</button>
                    <button class="tab-btn" onclick="showTab('official-codes', this)">Official Codes</button>
                </div>
                
                <!-- User Submitted Codes Tab -->
                <div id="user-codes" class="tab-content active">
                    <div class="user-codes-list">
                        <?php
                        // Get comments for this post
                        $comments = get_comments(array(
                            'post_id' => get_the_ID(),
                            'status' => 'approve',
                            'number' => 10,
                            'order' => 'DESC'
                        ));
                        
                        if ($comments): ?>
                            <?php foreach ($comments as $comment): ?>
                            <div class="user-code-item">
                                <div class="code-header">
                                    <div class="user-name"><?php echo esc_html($comment->comment_author); ?></div>
                                    <div class="code-date"><?php echo date('M j, Y', strtotime($comment->comment_date)); ?></div>
                                </div>
                                
                                <?php 
                                // Get referral code from comment meta or extract from content
                                $user_referral_code = get_comment_meta($comment->comment_ID, 'user_referral_code', true);
                                
                                if (!$user_referral_code) {
                                    // Try to extract from comment content as fallback
                                    $comment_text = $comment->comment_content;
                                    preg_match('/(?:Code:|code:)\s*([A-Za-z0-9]+)/i', $comment_text, $matches);
                                    $user_referral_code = isset($matches[1]) ? $matches[1] : '';
                                }
                                ?>
                                
                                <?php if ($user_referral_code): ?>
                                <div class="user-referral-display">
                                    <span><strong>Code:</strong> <?php echo esc_html($user_referral_code); ?></span>
                                    <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($user_referral_code); ?>', this)"></button>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($comment->comment_content): ?>
                                <p style="margin: 12px 0 0 0; font-size: 0.875rem; color: var(--text-secondary); line-height: 1.5;">
                                    <?php echo wp_kses_post($comment->comment_content); ?>
                                </p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <div style="font-size: 3rem; margin-bottom: 16px; opacity: 0.3;">📝</div>
                                <h4 style="margin: 0 0 8px 0; color: var(--text-primary);">No codes shared yet</h4>
                                <p style="margin: 0; color: var(--text-secondary);">Be the first to share your referral code with the community!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Official Codes Tab -->
                <div id="official-codes" class="tab-content">
                    <div class="user-codes-list">
                        <?php if ($referral_code || $referral_link): ?>
                        <div class="user-code-item" style="border: 2px solid var(--g-color); background: linear-gradient(135deg, var(--primary-light), var(--card-background));">
                            <div class="code-header">
                                <div class="user-name" style="color: var(--g-color);">
                                    <span style="margin-right: 8px;">👑</span>Official Code
                                </div>
                                <div class="code-date"><?php echo get_the_modified_date('M j, Y'); ?></div>
                            </div>
                            
                            <?php if ($referral_code): ?>
                            <div class="user-referral-display">
                                <span><strong>Code:</strong> <?php echo esc_html($referral_code); ?></span>
                                <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_code); ?>', this)"></button>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($referral_link): ?>
                            <div class="user-referral-display" style="margin-top: 8px;">
                                <span><strong>Link:</strong> <span style="font-size: 0.75rem; opacity: 0.8;">Direct registration</span></span>
                                <button class="copy-btn" onclick="copyToClipboard('<?php echo esc_js($referral_link); ?>', this)"></button>
                            </div>
                            <?php endif; ?>
                            
                            <p style="margin: 12px 0 0 0; font-size: 0.875rem; color: var(--text-secondary);">
                                Official referral <?php echo $referral_code ? 'code' : 'link'; ?> with guaranteed signup bonus and best rates.
                            </p>
                        </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <div style="font-size: 3rem; margin-bottom: 16px; opacity: 0.3;">🏢</div>
                                <h4 style="margin: 0 0 8px 0; color: var(--text-primary);">No official codes available</h4>
                                <p style="margin: 0; color: var(--text-secondary);">Check back later for official referral codes.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </main>
        
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Quick Stats Card -->
            <div class="sidebar-card">
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
            
            <!-- Features Card -->
            <div class="sidebar-card">
                <h3>Key Features</h3>
                <ul class="features-list">
                    <li><span class="check-icon">✓</span> Instant signup bonus</li>
                    <li><span class="check-icon">✓</span> Fast processing</li>
                    <li><span class="check-icon">✓</span> Secure platform</li>
                    <li><span class="check-icon">✓</span> 24/7 customer support</li>
                    <li><span class="check-icon">✓</span> Multiple payment options</li>
                </ul>
            </div>
            
            <!-- Related Programs Card -->
            <div class="sidebar-card">
                <h3>Related Programs</h3>
                <?php
                $related_posts = get_posts(array(
                    'post_type' => get_post_type(),
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
                ));
                
                if ($related_posts): ?>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <?php foreach ($related_posts as $related_post): ?>
                        <a href="<?php echo get_permalink($related_post->ID); ?>" 
                           style="display: flex; align-items: center; gap: 12px; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-sm); text-decoration: none; color: var(--text-primary); transition: all 0.2s ease;">
                            <?php if (get_the_post_thumbnail($related_post->ID, 'thumbnail')): ?>
                                <img src="<?php echo get_the_post_thumbnail_url($related_post->ID, 'thumbnail'); ?>" 
                                     style="width: 40px; height: 40px; border-radius: var(--radius-sm); object-fit: cover;">
                            <?php endif; ?>
                            <div>
                                <div style="font-weight: 600; font-size: 0.875rem; margin-bottom: 4px;">
                                    <?php echo get_the_title($related_post->ID); ?>
                                </div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">
                                    View Details
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
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
?>

<script>
// Enhanced copy to clipboard function with modern feedback
function copyToClipboard(text, button) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(function() {
            showCopySuccess(button);
        }).catch(function(err) {
            fallbackCopyTextToClipboard(text, button);
        });
    } else {
        fallbackCopyTextToClipboard(text, button);
    }
}

function fallbackCopyTextToClipboard(text, button) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showCopySuccess(button);
    } catch (err) {
        console.error('Could not copy text: ', err);
    }
    
    document.body.removeChild(textArea);
}

function showCopySuccess(button) {
    button.classList.add('copied');
    
    // Create and show success toast
    showToast('Copied to clipboard!', 'success');
    
    setTimeout(() => {
        button.classList.remove('copied');
    }, 2000);
}

// Modern toast notification system
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? 'var(--secondary-color)' : 'var(--g-color)'};
        color: white;
        padding: 12px 24px;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-lg);
        z-index: 1000;
        font-weight: 600;
        font-size: 0.875rem;
        animation: slideInRight 0.3s ease, slideOutRight 0.3s ease 2.7s forwards;
    `;
    toast.textContent = message;
    
    // Add animation keyframes if not already added
    if (!document.querySelector('#toast-animations')) {
        const style = document.createElement('style');
        style.id = 'toast-animations';
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
        }
    }, 3000);
}

// Enhanced tab switching with smooth transitions
function showTab(tabId, button) {
    // Hide all tab contents with fade out
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(tab => {
        tab.style.opacity = '0';
        setTimeout(() => {
            tab.classList.remove('active');
        }, 150);
    });
    
    // Remove active class from all buttons
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => btn.classList.remove('active'));
    
    // Show selected tab with fade in
    setTimeout(() => {
        const selectedTab = document.getElementById(tabId);
        selectedTab.classList.add('active');
        setTimeout(() => {
            selectedTab.style.opacity = '1';
        }, 50);
        button.classList.add('active');
    }, 150);
}

// Smooth scroll to section
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.submit-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('.submit-btn');
            submitBtn.style.opacity = '0.7';
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;
            
            // Re-enable button after a delay if form doesn't redirect
            setTimeout(() => {
                submitBtn.style.opacity = '1';
                submitBtn.textContent = 'Submit Code';
                submitBtn.disabled = false;
            }, 5000);
        });
        
        // Add real-time validation feedback
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = 'var(--secondary-color)';
                }
            });
            
            input.addEventListener('input', function() {
                if (this.style.borderColor === 'rgb(239, 68, 68)') {
                    this.style.borderColor = 'var(--border-color)';
                }
            });
        });
    }
    
    // Add hover effects to cards
    const cards = document.querySelectorAll('.user-code-item, .sidebar-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Initialize tab opacity
document.addEventListener('DOMContentLoaded', function() {
    const activeTab = document.querySelector('.tab-content.active');
    if (activeTab) {
        activeTab.style.opacity = '1';
    }
});
</script>

<style>
/* Additional responsive and animation styles */
.tab-content {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.tab-content.active {
    opacity: 1;
}

.user-code-item,
.sidebar-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-muted);
}

.empty-state h4 {
    font-size: 1.125rem;
    font-weight: 600;
}

@media (max-width: 640px) {
    .referral-code-display {
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }
    
    .referral-code-display span {
        word-break: break-all;
    }
    
    .copy-btn {
        width: 100%;
        justify-content: center;
    }
    
    .table-code-display {
        flex-direction: column;
        gap: 8px;
        align-items: stretch;
    }
    
    .table-copy-btn {
        width: 100%;
    }
}
</style>

<?php get_footer(); ?>