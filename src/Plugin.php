<?php
/**
 * Plugin class.
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

use Twilio\Rest\Client;

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
		add_action( 'publish_post', [ $this, 'send_reminders' ], 10, 2 );
	}

	/**
	 * Reminder method
	 *
	 * @return void
	 */
	public function send_reminders( $post_id, $post ) {
		$client = new Client( $this->options->get_sid(), $this->options->get_token() );

		$message = $client->messages->create(
			'+2348035454516',
			[
				'from' => '+13202335241',
				'body' => $this->options->get_message(),
			]
		);

		if($message->sid) {
			echo '<h1>'.'Your Message was successful'.'</h1>';
		} else {
			echo '<h1>'.'Something went wrong...'.'</h1>';
		}
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
		return __( 'Chigozie Orunta', 'wporb' );
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
