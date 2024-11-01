<?php
/**
 * TDT LazyLoad
 *
 * @package     tdt-lazyload
 * @author      Anh Tuan
 * @copyright   2017 Anh Tuan
 * @license     GPL-2.0+
 *
 * Plugin Name: TDT LazyLoad
 * Plugin URI:  https://duonganhtuan.com/tdt-lazyload/
 * Description: Save tons of bandwidth and make website load faster
 * Version:     1.2
 * Author:      Anh Tuan
 * Author URI:  https://duonganhtuan.com
 * Text Domain: tdt-lazyload
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TDT_LAZYLOAD_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'TDT_LAZYLOAD_PLUGIN_DIR', trailingslashit( plugin_dir_url( __FILE__ ) ) );

require TDT_LAZYLOAD_PLUGIN_PATH . 'classes/class.lazyload.php';
require TDT_LAZYLOAD_PLUGIN_PATH . 'classes/class.lazyload.admin.php';
