<?php

/**
 * Plugin Name: Essential Box Widgets
 * Description: Custom widgets from elementor.
 * Plugin URI:  https://proloop.tech/
 * Version:     1.0.0
 * Author:      proloop.tech
 * Author URI:  https://proloop.tech/
 * Text Domain: essential-box-widget
 *
 * Elementor tested up to: 3.13.4
 * Elementor Pro tested up to: 0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Widgets.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_custom_widgets( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/card-widget.php' );  // include the widget file

    $widgets_manager->register( new \Essential_Elementor_box_Widget() );  // register the widget

}
add_action( 'elementor/widgets/register', 'register_custom_widgets' );