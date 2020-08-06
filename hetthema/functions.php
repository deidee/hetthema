<?php

// Enable some basic theme support.
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array(
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
    'style',
    'script' ) );

// Disable smileys (these are not actual emoji).
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

if(!function_exists('jw')) {
    function jw() {
        ob_start();
        $expression = func_get_args();
        call_user_func_array('var_dump', $expression);
        echo '<pre><code class="language-php">' . htmlentities(ob_get_clean()) . '</code></pre>';
    }
}
