<?php
/**
 * Plugin Name: WooCommerce Pending Order Reminder
 * Description: Send SMS messages to buyers notifying them of abandoned cart orders.
 * Version: 1.0.0
 * Author: Chigozie Orunta
 * Author URI: https://github.com/chigozieorunta/woo-pending-order-bot
 * Text Domain: wporb
 *
 * @package WooPendingOrderBot
 */

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

\WooPendingOrderBot\Plugin::init();
