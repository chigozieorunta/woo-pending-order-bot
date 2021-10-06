<?php
/**
 * Options class.
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * WordPress options page
 */
class Options {

	/**
	 * Plugin instance
	 *
	 * @var object
	 */
	private $plugin;

	/**
	 * Sender Name
	 *
	 * @var string
	 */
	private $sender;

	/**
	 * Frequency
	 *
	 * @var string
	 */
	private $frequency;

	/**
	 * Message
	 *
	 * @var string
	 */
	private $message;

	/**
	 * Twilio WebHook
	 *
	 * @var string
	 */
	private $webhook;

	/**
	 * Instantiate class
	 *
	 * @param Plugin $plugin Plugin Instance.
	 *
	 * @return void
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
		add_action( 'after_setup_theme', [ $this, 'init' ] );
		add_action( 'carbon_fields_register_fields', [ $this, 'load_fields' ] );
		add_action( 'carbon_fields_register_fields', [ $this, 'set_fields' ] );
	}

	/**
	 * Set up Carbon Fields
	 *
	 * @return void
	 */
	public function init() {
		\Carbon_Fields\Carbon_Fields::boot();
	}

	/**
	 * Load plugin fields
	 *
	 * @return void
	 */
	public function load_fields() {
		Container::make( 'theme_options', $this->plugin->get_title() )

		->set_page_file( 'wporb' )

		->set_icon( 'dashicons-cart' )

		->add_fields(
			array(
				Field::make( 'html', 'crb_title' )
				->set_html( '<strong>' . __( 'Description', 'wporb' ) . '</strong>' ),

				Field::make( 'html', 'crb_desc' )
				->set_html( $this->plugin->get_description() ),

				Field::make( 'text', 'crb_sender', 'Sender Name' )
				->help_text( 'e.g. John Doe' )
				->set_width( 50 ),

				Field::make( 'text', 'crb_frequency', 'SMS Frequency (per day)' )
				->help_text( 'e.g. 1' )
				->set_width( 50 ),

				Field::make( 'textarea', 'crb_message', 'SMS Message (Reminder)' ),

				Field::make( 'text', 'crb_webhook', 'Twilio WebHook' )
				->help_text( 'e.g. https://hooks.twilio.com/services/xxxxxx' ),
			)
		);
	}

	/**
	 * Retrieve Carbon Field values and set private variables
	 *
	 * @return void
	 */
	public function set_fields() {
		$this->sender = carbon_get_theme_option( 'crb_sender' );
		$this->frequency  = carbon_get_theme_option( 'crb_frequency' );
		$this->message  = carbon_get_theme_option( 'crb_message' );
		$this->webhook  = carbon_get_theme_option( 'crb_webhook' );
	}

	/**
	 * Return sender
	 *
	 * @return string
	 */
	public function get_sender() {
		return $this->sender;
	}

	/**
	 * Return frequency
	 *
	 * @return string
	 */
	public function get_frequency() {
		return $this->frequency;
	}
}
