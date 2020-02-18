<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function smmchMinerShortcode( $atts ) {
    $args = shortcode_atts( array(), $atts );
	$output = smmch_footer_script('shortcode');
    return $output;
}
add_shortcode( 'simple-miner', 'smmchMinerShortcode' );