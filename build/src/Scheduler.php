<?php
/**
 * Scheduler class.
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

/**
 * SMS Scheduler
 */
class Scheduler {

	/**
	 * Setup Scheduler
	 *
	 * @param Options $option Options instance.
	 *
	 * @return void
	 */
	public function __construct( Options $option ) {
		$this->options = $option;
		add_action( 'wp_loaded', [ $this, 'schedule_reminders' ] );
		add_filter( 'cron_schedules', [ $this, 'schedule_interval' ] );
		add_action( 'send_reminders_hook', [ $this, 'send_reminders' ] );
	}

	/**
	 * Entry point for scheduling reminders
	 *
	 * @return void
	 */
	public function schedule_reminders() {
		if ( ! wp_next_scheduled( 'send_reminders_hook' ) ) {
			wp_schedule_event( time(), '2 days', 'send_reminders_hook' );
		}
	}

	/**
	 * Defined custom interval for cron jobs
	 *
	 * @param array $schedules List of custom Schedules.
	 * @return array
	 */
	public function schedule_interval( $schedules ) {
		$twodays = 2 * 24 * 60 * 60;

		$schedules['2 days'] = array(
			'interval' => $twodays,
			'display'  => esc_html__( 'Every 2 days' ),
		);

		return $schedules;
	}

	/**
	 * Reminder method
	 *
	 * @return void
	 */
	public function send_reminders() {
		$from    = $this->options->get_phone();
		$message = $this->options->get_message() . ' - ' . $this->options->get_sender();
		$client  = new Twilio( $this->options->get_sid(), $this->options->get_token() );

		$pending_orders = wc_get_orders(
			array(
				'limit'  => -1,
				'status' => 'pending',
			)
		);

		foreach ( $pending_orders as $order ) {
			$client->send( $from, $order->get_billing_phone(), $message );
		}
	}
}
