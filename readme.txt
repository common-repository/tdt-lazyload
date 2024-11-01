=== TDT Lazyload ===
Contributors: duonganhtuan
Tags: lazyload
Donate link: https://paypal.me/mrsugarvn
Requires at least: 3.4
Tested up to: 4.9.1
Stable tag: 1.1.10
License: GPL v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.txt

Save tons of bandwidth and make website load faster because it's make image on website only load when it needs (scroll into the viewport)

== Installation ==
1. Download [latest version](https://downloads.wordpress.org/plugin/tdt-lazyload.zip) and unzip, you will have **tdt-lazyload** folder
1. Upload **tdt-lazyload** folder into your /wp-content/plugins/ folder.
1. Activate the plugin **TDT Lazyload** through the 'Plugins' menu in WordPress.
1. Done. You can customize plugin settings in 'Settings' > TDT Lazyload

== Changelog ==

= 1.1.10 =
* Better selector, improved performance
* Add exclude class on image, iframe

= 1.1.8 =
* Better performance.

= 1.1.6 =
* Prevent lazyload on better-amp page

= 1.1.5 =
* Now support Gravatar image

= 1.1.4 =
* Disable lazyload on AMP pages

= 1.1.3 =
* Fix bug post thumbnail not working on lazyload

= 1.1.2 =
* Hotfix a bug sometimes make a fatal error

= 1.1 =
A big update with:
* Change lazyload plugin to Lazysizes that write on pure Javascript. Thats mean plugin can work without jQuery and higher performance.
* Better HTML parser by using Simple HTML DOM instead of regex.
* Add a fallback to make sure images can load on Javascript-disabled browser.

= 1.0.7 =
* Fix error some images will not load correctly if have srcset, sizes in their name

= 1.0.6 =
* A huge update. Now support `srcset` and `sizes` attribute
