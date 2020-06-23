<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Ewplugin
 */

define( 'WP_TESTS_CONFIG_FILE_PATH', dirname( __FILE__ ) . '/tmp/wp-tests-config.php' );

$_tests_dir = dirname( __FILE__ ) . '/tmp/wordpress-tests-lib';

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	require dirname( dirname( __FILE__ ) ) . '/ewplugin.php';
}

tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require dirname( dirname( __FILE__ ) ) . '/includes/class-ewplugin-activator.php';
require dirname( dirname( __FILE__ ) ) . '/includes/class-ewplugin-deactivator.php';

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
