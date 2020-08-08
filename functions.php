<?php

function hetthema_setup_theme() {
	// Enable some basic theme support.
	// See https://developer.wordpress.org/reference/functions/add_theme_support/.
	add_theme_support( 'align-wide' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-font-sizes' );
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script' ) );

	load_theme_textdomain( 'hetthema' );
}
add_action( 'after_setup_theme', 'hetthema_setup_theme' );

// Disable smileys (these are not actual emoji).
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Apply stylesheet.
function deidee_scripts() {
	wp_register_style( 'default-style', 'https://default.style/', '', '1.0.0' );
	wp_enqueue_style( 'default-style' );
}
add_action( 'wp_enqueue_scripts', 'deidee_scripts' );

if(!function_exists('hetthema_lorem_picsum')) {
	function hetthema_lorem_picsum($width = 512, $height = NULL) {
		if(empty($height)) $height = $width;

		return 'https://picsum.photos/' . $width . '/' . $height;
	}
}

if(!function_exists('jw')) {
	function jw() {
		ob_start();
		$expression = func_get_args();
		call_user_func_array('var_dump', $expression);
		echo '<pre><code class="language-php">' . htmlentities(ob_get_clean()) . '</code></pre>';
	}
}
