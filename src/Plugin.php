<?php
/**
 * Plugin class.
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

/**
 * WordPress plugin interface.
 */
class Plugin {

	/**
	 * Plugin's singleton instance
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Private instance of options class
	 *
	 * @var object
	 */
	private $options;

	/**
	 * Private instance of scheduler class
	 *
	 * @var object
	 */
	private $scheduler;

	/**
	 * Setup the plugin.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->options = new Options( $this );
		$this->scheduler = new Scheduler ( $this->options );
	}	
	
	/**
	 * Plugin Entry point based on Singleton
	 *
	 * @return Plugin $plugin Instance of the plugin abstraction.
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get Plugin Title
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Woo Pending Order Reminder Bot', 'wporb' );
	}

	/**
	 * Get Plugin Author
	 *
	 * @return string
	 */
	public function get_author() {
		return __( 'Chigozie Orunta', 'wporb' );
	}

	/**
	 * Get Plugin Description
	 *
	 * @return string
	 */
	public function get_description() {
		return __( 'Send SMS reminders to buyers notifying them of abandoned cart orders. Start by signing up for a Twilio account on Twilio.com. To configure your WooCommerce Pending Order Reminder Bot, you will need to obtain your Account SID, Token and Phone numbers and then enter them here. Save changes and you are ready to go!', 'wporb' );
	}
}
