=== Referral Code Plugin ===
Contributors: sonusourav
Tags: referral code, custom post type, shortcode, gutenberg, rest api, affiliate
Requires at least: 5.2
Tested up to: 6.0
Stable tag: 1.5.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A powerful and easy-to-use plugin for managing and displaying referral codes on your WordPress website.

== Description ==

This plugin provides a complete solution for affiliate marketers and bloggers who want to share referral codes. It creates a dedicated "Referral Codes" custom post type, allowing you to organize and display your codes with ease.

**Key Features:**

*   **Dedicated Custom Post Type:** Manage all your referral codes in one place with a 'Referral Codes' section in the WordPress admin.
*   **Custom Fields for Details:**
    *   **App Name:** The name of the application/service.
    *   **Referral Code:** The actual code to be shared.
    *   **Referral Link:** The URL for users to click.
    *   **Sign-up Bonus:** Highlight the incentive for users.
    *   **Referral Rewards:** Detail the rewards for the referrer.
*   **Dynamic FAQ Generation:** Automatically generates comprehensive FAQs using app name and referral details, with templated variables for dynamic content.
*   **Gutenberg Integration:** A seamless editing experience with a custom panel in the Gutenberg editor for managing referral details. No complex meta boxes.
*   **REST API Enabled:** All referral code data, including custom meta fields, is exposed through the WordPress REST API for headless or custom applications.
*   **Flexible Shortcodes:** Use various shortcodes to display referral codes in different formats anywhere on your site.
*   **Single Post Template:** Includes a custom template for a clean, consistent look on single referral code pages with sidebar support.
*   **Performance Optimized:** Deferred CSS/JS loading, comment caching, and efficient asset management for excellent Google PageSpeed scores.
*   **Developer Friendly:** Built with standard WordPress functions and hooks, making it easy to customize and extend.

== Installation ==

1.  Download the plugin zip file.
2.  In your WordPress admin, go to `Plugins > Add New > Upload Plugin`.
3.  Choose the downloaded zip file and click `Install Now`.
4.  Activate the plugin through the 'Plugins' menu in WordPress.
5.  A "Referral Codes" menu will now appear in your WordPress admin.

== Frequently Asked Questions ==

= How do I use the shortcodes? =

The plugin provides multiple shortcodes for displaying referral codes in various formats. You can use either the post ID or the post slug to specify which referral code to display.

**1. Referral Code Box:**
`[referral_code_box id="123"]`
or
`[referral_code_box slug="your-post-slug"]`

This will generate a responsive box with the App Logo, Title, Sign-up Bonus, Referral Code, and a link.

**2. Plain Text Referral Code:**
`[referral_code_text id="123"]`
or
`[referral_code_text slug="your-post-slug"]`

**3. Referral Code with Copy Button:**
`[referral_code_copy id="123"]`
or
`[referral_code_copy slug="your-post-slug"]`

**4. Plain Text Referral Link:**
`[referral_link_text id="123"]`
or
`[referral_link_text slug="your-post-slug"]`

**5. Referral Link with Copy Button:**
`[referral_link_copy id="123"]`
or
`[referral_link_copy slug="your-post-slug"]`

**6. Referral Codes Grid (Archive):**
`[referral_codes_grid posts_per_page="12" loadmore="true" category="slug" columns="3"]`

This creates a responsive grid of referral code cards with AJAX load more functionality.

**Parameters:**
* `posts_per_page`: Number of posts to display initially (default: 12)
* `loadmore`: Enable/disable the load more button ("true" or "false", default: "true")
* `category`: Filter by category ID or slug (default: empty for all categories)
* `columns`: CSS Grid columns reference (default: 3)

**Examples:**
```
[referral_codes_grid]
[referral_codes_grid posts_per_page="8" loadmore="false"]
[referral_codes_grid category="mobile-apps"]
[referral_codes_grid posts_per_page="6" category="finance" loadmore="true"]
```

= How are the custom fields stored? =

The custom fields are stored as post meta data with the following keys:
*   `app_name`
*   `referral_code`
*   `referral_link`
*   `signup_bonus`
*   `referral_rewards`

= How does the FAQ system work? =

The plugin automatically generates comprehensive FAQs for each referral code post using templated variables. The FAQs are stored in the `rcp_faqs` meta field and use the following variables for dynamic content:

*   `{{app_name}}` - The application/service name
*   `{{referral_code}}` - The referral code
*   `{{referral_link}}` - The referral URL
*   `{{signup_bonus}}` - The signup bonus details
*   `{{referral_rewards}}` - The referral rewards information

The FAQ generation prioritizes the app_name meta field over the post title and avoids using "Auto Draft" in the content.

= What sidebar is used on single referral code posts? =

Single referral code posts use the 'referral-sidebar' which is registered by the plugin. You can add widgets to this sidebar in WordPress admin under **Appearance > Widgets > Referral Code Sidebar**.

= How is performance optimized for Google PageSpeed? =

The plugin includes several performance optimizations:

*   **Deferred CSS Loading:** Non-critical CSS is loaded asynchronously to prevent render-blocking
*   **JavaScript Optimization:** Scripts are loaded efficiently with proper dependencies
*   **Comment Caching:** User comments are cached for 1 hour to reduce database queries
*   **Efficient Asset Management:** CSS and JS files are conditionally loaded only where needed
*   **Optimized Templates:** Clean, semantic HTML with proper schema markup

== For Developers ==

= REST API Endpoints =

You can interact with the referral codes via the REST API.

*   **Get all referral codes:**
    `GET /wp-json/wp/v2/referral-codes`

*   **Get a single referral code:**
    `GET /wp-json/wp/v2/referral-codes/<id>`

The custom meta fields (`referral_code`, `referral_link`, `signup_bonus`) are available in the `meta` object of the API response.

= Customizing the Shortcode Output =

The shortcode uses standard Gutenberg CSS classes (`wp-block-media-text`, `wp-block-columns`, `wp-block-button`, etc.) for styling. This means it will inherit much of its appearance from your theme, ensuring a consistent look.

If you want to customize the output, you can unregister the default shortcode and register your own, or use CSS to target the existing classes.

Example of unregistering the shortcode in your theme's `functions.php`:
`remove_shortcode( 'referral_code_box' );`

You can then copy the `rcp_referral_code_box_shortcode` function from `referral-code-plugin.php` into your `functions.php`, rename it, and modify the HTML structure as needed before registering it with `add_shortcode`.

== Screenshots ==

1.  The "Referral Codes" custom post type in the WordPress admin menu.
2.  The Gutenberg editor with the "Referral Code Details" panel.
3.  An example of the front-end display of the referral code box.

== Changelog ==

= 1.6.0 =
*   Fixed "Auto Draft" issue in FAQ generation - now properly uses app_name from meta fields
*   Enhanced FAQ system with templated variables ({{app_name}}, {{referral_code}}, {{signup_bonus}}, {{referral_link}}, {{referral_rewards}})
*   Added comprehensive default FAQ questions covering all meta fields
*   Added 'referral-sidebar' registration for single post pages
*   Improved performance optimizations for Google PageSpeed:
    - Deferred CSS loading to prevent render-blocking
    - Efficient JavaScript loading and dependencies
    - Comment caching system (1-hour cache)
    - Conditional asset loading
*   Updated documentation with FAQ system details and performance optimizations

= 1.5.0 =
*   Added `[referral_codes_grid]` shortcode with AJAX load more functionality
*   Added category filtering support for the grid shortcode
*   Added customizable parameters: posts_per_page, loadmore, category, columns
*   Improved editor interface with shortcode help text below each field
*   Enhanced table link display to show "Visit [app name]" instead of full URL
*   Added compact sharing section after referral details table
*   Updated archive template to use the new grid shortcode

= 1.4.0 =
*   Added `referral_rewards` meta field.
*   Added `[referral_link_text]` and `[referral_link_copy]` shortcodes.

= 1.3.0 =
*   Added support for using post slugs in shortcodes (`[referral_code_box slug="..."]`).

= 1.2.0 =
*   Added `[referral_code_text]` shortcode to display the code in plain text.
*   Added `[referral_code_copy]` shortcode to display the code with a copy-to-clipboard button.
*   Added JavaScript for the copy functionality.
*   Added styles for the new shortcodes.

= 1.1.0 =
*   Added a custom template for single 'referral-codes' posts.

= 1.0.0 =
*   Initial release.
*   Added custom post type for referral codes.
*   Added custom meta fields for referral details.
*   Integrated with Gutenberg editor.
*   Added `[referral_code_box]` shortcode.
*   Enabled REST API support.
