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
	 * Twilio SID
	 *
	 * @var string
	 */
	private $sid;

	/**
	 * Twilio Token
	 *
	 * @var string
	 */
	private $token;

	/**
	 * Twilio Phone
	 *
	 * @var string
	 */
	private $phone;

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

				Field::make( 'text', 'crb_phone', 'Twilio Phone Number' )
				->help_text( 'e.g. +13021545862' ),

				Field::make( 'text', 'crb_sid', 'Twilio SID' )
				->help_text( 'e.g. ACccc6cd908be393ee0b02c3855bcde65e' ),

				Field::make( 'text', 'crb_token', 'Twilio Token' )
				->help_text( 'e.g. a13ab322b56ae3307ae94aff69653fc4' ),

				Field::make( 'textarea', 'crb_message', 'SMS Message (Reminder)' ),
			)
		);
	}

	/**
	 * Retrieve Carbon Field values and set private variables
	 *
	 * @return void
	 */
	public function set_fields() {
		$this->sender    = carbon_get_theme_option( 'crb_sender' );
		$this->frequency = carbon_get_theme_option( 'crb_frequency' );
		$this->message   = carbon_get_theme_option( 'crb_message' );
		$this->sid       = carbon_get_theme_option( 'crb_sid' );
		$this->token     = carbon_get_theme_option( 'crb_token' );
		$this->phone     = carbon_get_theme_option( 'crb_phone' );
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

	/**
	 * Return SMS message/reminder
	 *
	 * @return string
	 */
	public function get_message() {
		return $this->message;
	}

	/**
	 * Return Twilio Account SID
	 *
	 * @return string
	 */
	public function get_sid() {
		return $this->sid;
	}

	/**
	 * Return Twilio Token
	 *
	 * @return string
	 */
	public function get_token() {
		return $this->token;
	}

	/**
	 * Return Twilio Phone
	 *
	 * @return string
	 */
	public function get_phone() {
		return $this->phone;
	}
}
