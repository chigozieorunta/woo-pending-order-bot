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
	private $client;

	public function __construct( $sid, $token ) {
		$this->client = new TwilioClient( $sid, $token );
	}

	public function send( $from, $to, $message ) {
		return $this->client->messages->create( $to, [ 'from' => $from, 'body' => $message ] );
	}
}