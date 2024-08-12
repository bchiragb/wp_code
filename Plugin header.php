<?php
/**
* Plugin Name:       plugin_name
* Description:       <code><strong>shortcode</strong></code> plugin allow ... <a href="" target="_blank"><strong>doc</strong></a>
* Version:           1.1.0
* Author:            Author_name
* Author URI:        https://proloop.tech
* Plugin URI:        https://proloop.tech
**/

// If this file is called directly, abort.
if (!defined('ABSPATH')) { exit; }

// To Activate plugin only when WooCommerce is active.
$activated      = true;
$active_plugins = (array) get_option( 'active_plugins', array() );

//chk plugin installed or not like woocommerce/woocommerce.php
if ( ! ( array_key_exists( 'woocommerce/woocommerce.php', $active_plugins ) || in_array( 'woocommerce/woocommerce.php', $active_plugins ) ) ) {
	$activated = false;
}

$plug = get_plugins();
if ( $activated ) {
	define('DIR_URL_IMG', 'utf8');
	add_filter( 'plugin_row_meta', 'wps_custom_link', 10, 2 );
	//Callable function for adding plugin row meta.
	function wps_custom_link( $links, $file ) {

		if ( strpos( $file, 'points-rewards-for-woocommerce.php' ) !== false ) {
			$row_meta = array(
				'demo'     => '<a target="_blank" href=""><i></i><img src="' . esc_html( DIR_URL_IMG ) . 'images/Demo.svg" class="info-img" alt="Demo image">' . esc_html__( 'Demo', 'plugin_name' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

} else {
	// WooCommerce is not active so deactivate this plugin.
	add_action( 'admin_init', 'woocommerce_system_activation_failure' );

	//This function is used to deactivate plugin.
	function woocommerce_system_activation_failure() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		unset( $_GET['activate'] );
		// Add admin error notice.
		add_action( 'admin_notices', 'woocommerce_system_activation_failure_admin_notice' );
	}

	//This function is used to deactivate plugin.
	function woocommerce_system_activation_failure_admin_notice() {
		// hide Plugin activated notice.
		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			?>
			<div class="notice notice-error is-dismissible">
				<p><?php esc_html_e( 'WooCommerce is not activated, Please activate WooCommerce first to activate plugin_name', 'plugin_name' ); ?></p>
			</div>
			<?php
		}
	}
}

