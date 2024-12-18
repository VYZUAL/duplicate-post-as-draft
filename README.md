=== Duplicate Post as Draft ===
Contributors: ilonadehaan  
Tags: duplicate post, duplicate page, elementor, copy post, wordpress plugin, caching plugins  
Requires at least: 5.0  
Tested up to: 6.7  
Stable tag: 1.7  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html  

Easily duplicate posts and pages as drafts in WordPress, preserving all Elementor content, templates, metadata, and supporting caching plugins.

== Description ==

**Duplicate Post as Draft** allows you to quickly duplicate any WordPress post or page as a draft.  
This plugin fully supports **Elementor content**, including widgets, sections, global templates, and associated metadata. It is lightweight, secure, and works seamlessly with caching plugins for a smooth user experience.

### Key Features:
✅ **One-Click Duplication**: Quickly duplicate posts and pages as drafts.  
✅ **Elementor Support**: Preserves all Elementor content, including templates, widgets, and styling.  
✅ **Meta Data Preservation**: Copies SEO settings, custom fields, featured images, and global styles.  
✅ **Caching Plugin Compatibility**: Works with popular caching plugins like WP Super Cache, W3 Total Cache, LiteSpeed Cache, and more.  
✅ **Lightweight & Secure**: Built according to WordPress coding standards and optimized for performance.  

Whether you’re working with Elementor, Gutenberg, or the Classic Editor, this plugin ensures all your content and design are duplicated flawlessly while integrating smoothly with your site's caching setup.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Navigate to **Posts** or **Pages** in the admin dashboard.
4. Hover over the post or page you want to duplicate, and click **Duplicate**.

The duplicated post/page will appear as a draft and can be edited immediately.

== Frequently Asked Questions ==

= Does this plugin work with Elementor? =
Yes! The plugin fully supports Elementor content. It preserves all widgets, templates, styling, and metadata during duplication.

= Will this plugin work with other page builders? =
Yes, it works with Gutenberg, the Classic Editor, and other page builders, but Elementor is explicitly supported.

= What happens to featured images and custom fields? =
The plugin duplicates all metadata, including featured images, custom fields, and SEO settings.

= Is the plugin lightweight and optimized for performance? =
Yes! The plugin is designed to be as lightweight as possible, focusing solely on duplication functionality.

= Does this plugin support caching plugins? =
Yes! The plugin works with popular caching plugins such as WP Super Cache, W3 Total Cache, LiteSpeed Cache, Breeze, and WP Fastest Cache. It automatically clears the cache for the duplicated post to ensure everything works as expected.

= Does this plugin generate any unnecessary files? =
No. The plugin only duplicates the post/page and clears Elementor cache to ensure everything works smoothly.

== Changelog ==

= 1.7 =
* Added caching plugin support (WP Super Cache, W3 Total Cache, LiteSpeed Cache, and more).
* Improved compatibility with Elementor by ensuring CSS regeneration.
* Fully optimized duplication process to work seamlessly with caching.

= 1.6 =
* Full support for Elementor content and templates.
* Ensures all metadata, including `_elementor_data`, is preserved correctly.
* Added Elementor CSS regeneration for the duplicated post.

= 1.5 =
* Resolved issues with duplicating Elementor templates embedded in pages.
* Improved handling of nested Elementor JSON data for better compatibility.
* Ensured that Elementor global styles and references are preserved.

= 1.4 =
* Added support for duplicating Elementor-specific meta keys like `_elementor_css` and `_elementor_data`.
* Fixed an issue where duplicated pages were automatically opened in Elementor (set to draft instead).
* Improved overall compatibility with Elementor and other page builders.

= 1.3 =
* Enhanced duplication process to preserve all custom meta fields.
* Added sanitization and validation checks for improved security.
* Introduced nonce verification to prevent unauthorized duplication requests.

= 1.2 =
* Initial implementation of the duplication functionality.
* Added basic support for duplicating posts and pages as drafts.
* Implemented the "Duplicate" link in the actions menu for posts and pages.

== Upgrade Notice ==
Upgrade to 1.7 to ensure compatibility with popular caching plugins and improved Elementor CSS regeneration.

== License ==

This plugin is licensed under the [GPL-2.0 License](https://www.gnu.org/licenses/gpl-2.0.html).
