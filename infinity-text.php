<?php
/**
 * Plugin Name:         Text Marquee
 * Description:  Widgets Text horizontal or vertical
 * Author:              María Flores   
 * version:             1.0
 * 
 */

//Incluir libreria JS
function wp_js_Marquee() {
    wp_enqueue_script( 'script-name', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js', array('jquery'), '1.5.0', true );

}
add_action( 'wp_enqueue_scripts', 'wp_js_Marquee' );

/**
 * Instancia el Widget
 */
function wptm_create_widget(){
    include_once(plugin_dir_path( __FILE__ ).'/widget.php');
    register_widget('wp_tm_widget');
}
add_action('widgets_init','wptm_create_widget');