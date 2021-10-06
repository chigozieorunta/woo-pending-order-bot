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
	 * Setup the plugin.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->options = new Options( $this );
	}

	/**
	 * Reminder method
	 *
	 * @return void
	 */
	public function send_reminders() {
		$client = new Twilio\Rest\Client( $this->options->get_sid(), $this->options->get_token() );

		$message = $client->messages->create(
			'2348035454516',
			[
				'from' => $this->options->get_sender(),
				'body' => $this->options->get_message(),
			]
		);
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
		return __( 'WooCommerce Pending Order Reminder Bot', 'wporb' );
	}

	/**
	 * Get Plugin Author
	 *
	 * @return string
	 */
	public function get_author() {
		return __( 'Chigozie Orunta', 'slack-bot' );
	}

	/**
	 * Get Plugin Description
	 *
	 * @return string
	 */
	public function get_description() {
		return __( 'Send SMS messages to buyers notifying them of abandoned cart orders.', 'wporb' );
	}
}
