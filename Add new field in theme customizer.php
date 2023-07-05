<?php

//add code to add color option in theme customizer of theme (Default)
function my_theme_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'header_bg_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color', array(
        'label' => __( 'Header Background Color', 'my_theme' ),
        'section' => 'colors',
        'settings' => 'header_bg_color',
    ) ) );
}
add_action( 'customize_register', 'my_theme_customize_register' );


//call for get value
echo $header_bg_color = get_theme_mod( 'header_bg_color', '#ffffff' );

?>
