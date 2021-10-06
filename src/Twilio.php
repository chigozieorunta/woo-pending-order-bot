<?php
/**
 * Adapter Class
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

use Twilio\Rest\Client as TwilioClient;

/**
 * Twilio Adapter
 */
class Twilio implements Client {

	/**
	 * Client instance
	 *
	 * @var object
	 */
	private $client;

	/**
	 * Instantiate Adapter
	 *
	 * @param string $sid Twilio Account SID.
	 * @param string $token Twilio Token.
	 *
	 * @return void
	 */
	public function __construct( $sid, $token ) {
		$this->client = new TwilioClient( $sid, $token );
	}

	/**
	 * Send SMS
	 *
	 * @param string $from Registered Number.
	 * @param string $to Recipient Number.
	 * @param string $message Body of message.
	 *
	 * @return object
	 */
	public function send( $from, $to, $message ) {
		return $this->client->messages->create( $to, [ 'from' => $from, 'body' => $message ] );
	}
}