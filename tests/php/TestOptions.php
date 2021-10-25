<?php
/**
 * Tests for Options class.
 *
 * @package WooPendingOrderBot
 */

namespace WooPendingOrderBot;

use Mockery;
use WP_Mock;

/**
 * Test the Options class
 */
class TestOptions extends TestCase {
	/**
	 * Test get_sender to return string.
	 *
	 * @covers \WooPendingOrderBot\Options::get_sender()
	 */
	public function test_get_sender() {
		$mock = Mockery::mock( 'WooPendingOrderBot' );
		$mock->shouldReceive( 'get_sender' )->once()->andReturn( Mockery::type( 'string' ) );
		$mock->get_sender();
	}
}
