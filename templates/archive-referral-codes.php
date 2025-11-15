<?php
/**
 * Template Name: Archive Referral Codes
 * Description: Modern, visually appealing template for displaying referral code archives
 */

get_header();
?>

<main id="primary" class="site-main referral-archive-template">
    <!-- Hero Section -->
    <section class="referral-hero-section">
        <div class="referral-hero-container">
            <div class="referral-hero-content">
                <h1 class="referral-hero-title">
                    Referral Codes & Rewards
                </h1>
                <div class="search-box">
                    <input type="text" id="referral-search" placeholder="Search by app name, category, or bonus..." class="search-input">
                    <button type="button" class="search-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                    <div class="search-results-dropdown" id="search-results-dropdown">
                        <!-- Search results will be populated here -->
                    </div>
                </div>
                <p class="referral-hero-description">
                    <?php echo wp_kses_post(get_the_archive_description() ?: 'Discover exclusive referral codes and bonuses for your favorite apps and services. Save money and earn rewards with our curated collection.'); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="referral-main-content">
        <div class="container">
            <!-- Referral Codes Grid -->
            <div class="referral-codes-section">
                <div id="referral-codes-container">
                    <?php echo do_shortcode('[referral_codes_grid posts_per_page="12" loadmore="true" columns="4"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories Section -->
    <section class="featured-categories-section">
        <div class="container">
            <div class="section-header">
                <h3>Popular Categories</h3>
                <p>Explore codes by category to find exactly what you need</p>
            </div>
            <div class="categories-grid">
                <?php
                // Get all referral code posts
                $referral_posts = get_posts([
                    'post_type' => 'referral-codes',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'fields' => 'ids'
                ]);

                if (!empty($referral_posts)) {
                    // Get categories used by referral code posts
                    $category_counts = [];

                    foreach ($referral_posts as $post_id) {
                        $categories = get_the_category($post_id);
                        foreach ($categories as $category) {
                            if (!isset($category_counts[$category->term_id])) {
                                $category_counts[$category->term_id] = [
                                    'term' => $category,
                                    'count' => 0
                                ];
                            }
                            $category_counts[$category->term_id]['count']++;
                        }
                    }

                    // Sort by count descending and limit to 6
                    usort($category_counts, function($a, $b) {
                        return $b['count'] <=> $a['count'];
                    });

                    $category_counts = array_slice($category_counts, 0, 6);

                    foreach ($category_counts as $category_data) {
                        $category = $category_data['term'];
                        $count = $category_data['count'];
                        $category_link = get_term_link($category);
                        echo '<a href="' . esc_url($category_link) . '" class="category-card">';
                        echo '<div class="category-icon">📱</div>';
                        echo '<h3>' . esc_html($category->name) . '</h3>';
                        echo '<span class="category-count">' . $count . ' codes</span>';
                        echo '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Top Refer & Earn Articles Section -->
    <section class="top-articles-section">
        <div class="container">
            <div class="section-header">
                <h3>Top Refer & Earn Articles</h3>
                <p>Learn more about referral programs and earning opportunities</p>
            </div>
            <div class="articles-grid">
                <?php
                // Fetch 5 posts from refer-and-earn category
                $articles_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 5,
                    'category_name' => 'refer-and-earn',
                    'orderby' => 'date',
                    'order' => 'DESC'
                );

                $articles_query = new WP_Query($articles_args);

                if ($articles_query->have_posts()) {
                    while ($articles_query->have_posts()) {
                        $articles_query->the_post();
                        ?>
                        <article class="article-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="article-image">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <div class="article-content">
                                <h3 class="article-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="article-meta">
                                    <span class="article-date"><?php echo get_the_date(); ?></span>
                                </div>
                                <p class="article-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                                <a href="<?php the_permalink(); ?>" class="article-read-more">Read More</a>
                            </div>
                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>No articles found in the Refer & Earn category.</p>';
                }
                ?>
            </div>
            <div class="articles-section-footer">
                <a href="/category/refer-and-earn" class="show-all-btn">Show All</a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h3>Have a Referral Code to Share?</h3>
                <p>Join our community and help others save money while earning rewards yourself.</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/referal-code/tata-neu')); ?>" class="cta-btn primary">Submit Code</a>
                    <a href="<?php echo esc_url(home_url('https://links.bigtricks.in/whatsapp')); ?>" class="cta-btn secondary">Follow us On Whatsapp</a>
                </div>
            </div>
        </div>
    </section>
</main>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // AJAX Search functionality
    const searchInput = document.getElementById('referral-search');
    const searchResultsDropdown = document.getElementById('search-results-dropdown');
    let searchTimeout;

    // AJAX search function
    function performSearch(query) {
        if (query.length < 2) {
            searchResultsDropdown.classList.remove('show');
            return;
        }

        // Show loading state
        searchResultsDropdown.innerHTML = '<div class="search-no-results">Searching...</div>';
        searchResultsDropdown.classList.add('show');

        // Make AJAX request
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'bt_ajax_search',
                query: query
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                // Filter to only show referral codes
                const referralResults = data.data.filter(result => result.type === "Referral Code");

                if (referralResults.length > 0) {
                    let html = '';
                    referralResults.forEach(result => {
                        html += `
                            <a href="${result.url}" class="search-result-item">
                                <div class="search-result-title">${result.title}</div>
                                <div class="search-result-type">${result.type}</div>
                                <div class="search-result-excerpt">${result.excerpt}</div>
                            </a>
                        `;
                    });
                    searchResultsDropdown.innerHTML = html;
                } else {
                    searchResultsDropdown.innerHTML = '<div class="search-no-results">No referral codes found</div>';
                }
            } else {
                searchResultsDropdown.innerHTML = '<div class="search-no-results">No results found</div>';
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            searchResultsDropdown.innerHTML = '<div class="search-no-results">Search error occurred</div>';
        });
    }

    // Search input event listener with debounce
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        clearTimeout(searchTimeout);

        if (query.length === 0) {
            searchResultsDropdown.classList.remove('show');
            return;
        }

        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300); // 300ms debounce
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResultsDropdown.contains(e.target)) {
            searchResultsDropdown.classList.remove('show');
        }
    });

    // Show dropdown on focus if there's text
    searchInput.addEventListener('focus', function() {
        if (this.value.trim().length >= 2) {
            searchResultsDropdown.classList.add('show');
        }
    });

    // Filter functionality (keeping for any existing filter buttons)
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.bt-referral-card');

            cards.forEach(card => {
                switch(filter) {
                    case 'featured':
                        // You can add a featured class or data attribute to mark featured items
                        card.style.display = card.classList.contains('featured') ? 'block' : 'none';
                        break;
                    case 'newest':
                        // This would require date-based filtering logic
                        card.style.display = 'block'; // Placeholder
                        break;
                    default:
                        card.style.display = 'block';
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>
