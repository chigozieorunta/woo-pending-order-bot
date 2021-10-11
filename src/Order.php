<?php
/**
 * Order Class
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

/**
 * Order Class
 */
class Order {

	/**
	 * Array of pending orders
	 *
	 * @var array
	 */
	private $pending_orders;

	/**
	 * Setup Order Class
	 *
	 * @return void
	 */
	public function __construct() {
		$this->pending_orders = wc_get_orders(
			array(
				'limit'  => -1,
				'status' => 'pending',
			)
		);
	}
}
