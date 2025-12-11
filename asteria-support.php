<?php
/**
 * Plugin Name: Asteria Support
 * Plugin URI: https://asteria.com/plugins/asteria
 * Description: The Agency Base Support plugin for client
 * Author: Abdullah
 * Author URI: https://asteria.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: asteria-support
 *
 * @package Asteria Support
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Define const
define('ASTSP_VER', '1.0.0');
define('ASTSP_PLUGIN_NAME', 'Asteria');
define('ASTSP_FILE', __FILE__);
define('ASTSP_DIR', plugin_dir_path( ASTSP_FILE));
define('ASTSP_URL', plugins_url('/', ASTSP_FILE));
Define('ASTSP_ASSETS', plugins_url( '/assets', ASTSP_FILE) );
define('ASTSP_ROOT', dirname( plugin_basename(__FILE__)));
define('ASTSP_ADMIN', ASTSP_DIR . 'admin/');
define('ASTSP_ADMIN_URL', plugins_url('/', __FILE__) . 'admin/');

// Initiate Plugin Base Class
require_once ASTSP_DIR . 'includes/base.php';