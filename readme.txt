=== Referral Code Plugin ===
Contributors: sonusourav
Tags: referral code, custom post type, shortcode, gutenberg, rest api, affiliate
Requires at least: 5.2
Tested up to: 6.0
Stable tag: 1.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A powerful and easy-to-use plugin for managing and displaying referral codes on your WordPress website.

== Description ==

This plugin provides a complete solution for affiliate marketers and bloggers who want to share referral codes. It creates a dedicated "Referral Codes" custom post type, allowing you to organize and display your codes with ease.

**Key Features:**

*   **Dedicated Custom Post Type:** Manage all your referral codes in one place with a 'Referral Codes' section in the WordPress admin.
*   **Custom Fields for Details:**
    *   **Referral Code:** The actual code to be shared.
    *   **Referral Link:** The URL for users to click.
    *   **Sign-up Bonus:** Highlight the incentive for users.
*   **Gutenberg Integration:** A seamless editing experience with a custom panel in the Gutenberg editor for managing referral details. No complex meta boxes.
*   **REST API Enabled:** All referral code data, including custom meta fields, is exposed through the WordPress REST API for headless or custom applications.
*   **Flexible Shortcode:** Use the `[referral_code_box]` shortcode to display beautifully formatted referral boxes anywhere on your site.
*   **Single Post Template:** Includes a custom template for a clean, consistent look on single referral code pages.
*   **Developer Friendly:** Built with standard WordPress functions and hooks, making it easy to customize and extend.

== Installation ==

1.  Download the plugin zip file.
2.  In your WordPress admin, go to `Plugins > Add New > Upload Plugin`.
3.  Choose the downloaded zip file and click `Install Now`.
4.  Activate the plugin through the 'Plugins' menu in WordPress.
5.  A "Referral Codes" menu will now appear in your WordPress admin.

== Frequently Asked Questions ==

= How do I use the shortcodes? =

The plugin provides three shortcodes for displaying referral codes. You can use either the post ID or the post slug to specify which referral code to display.

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

= How are the custom fields stored? =

The custom fields are stored as post meta data with the following keys:
*   `referral_code`
*   `referral_link`
*   `signup_bonus`

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
