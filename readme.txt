=== Simple Behance Portfolio ===
Contributors: Kozulowski
Donate Link: http://goo.gl/UewX4G
Tags: behance, portfolio, creative
Requires at least: 3.9
Tested up to: 4.0.1
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin for displaying projects from a user's Behance feed.

== Description ==

The plugin allows to list recent projects form a Behance account. It currently supports up to 25 projects (due to the api limit). All you need is a Behance account and an API key.

NOTE ON UPDATING FROM 0.1: You will have to re-enter the api key and username in the plugin settings as from now on the Titan Framework handles the options for the plugin. This is a one time thing and you will not have to reconfigure anything in the future.

If you like the plugin and would like it to grow and enable me to make new ones, consider donating at: http://goo.gl/UewX4G

== Installation ==

1. Upload the `simple-behance-portfolio` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Generate an API key here - https://www.behance.net/dev/register
4. Configure the plugin in the `Simple Behance Portfolio` section in the admin panel
5. Place the [BehancePortfolio] shortcode on the page you want the portfolio to appear

== Frequently Asked Questions ==

= Can I style the apperance to my liking? =

Yes, the plugin uses pretty simple css, refer to the sbhpf-front.css file located in the css subdirectory.

== Screenshots ==

1. Settings section

== Changelog ==

= 0.2 =
* Rewritten the plugin into a class
* Used the Titan Framework for the settings for easier future improvements, please note that you will have to reconfigure your plugin
* Added the option to show project titles on hover
* Modified the css a bit, but you can style it as you wish
* Added prettier errors

= 0.1 =
* First version
