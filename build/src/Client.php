<?php
/**
 * Client Interface
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

/**
 * SMS Client interface.
 */
interface Client {

	/**
	 * Send method
	 *
	 * @param string $from Registered Number.
	 * @param string $to Recipient Number.
	 * @param string $message Body of message.
	 *
	 * @return void
	 */
	public function send( $from, $to, $message );
}
