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

		->set_icon( 'dashicons-cart' );
	}
}
