<?php

add_action( 'after_setup_theme', 'hetthema_setup_theme' );
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

// Disable smileys (these are not actual emoji).
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Apply stylesheet.
add_action( 'wp_enqueue_scripts', 'deidee_scripts' );
function deidee_scripts() {
	wp_register_style( 'default-style', 'https://default.style/', '', '1.0.0' );
	wp_enqueue_style( 'default-style' );
}

// Modern Web browsers only allow videos to autoplay when they are inline and muted.
add_filter( 'wp_video_shortcode', function( $html ) {
	if(strpos($html, ' autoplay') !== false) {
		return str_replace( '<video', '<video muted playsinline', $html );
	}

	return $html;
} );

add_action( 'init', 'hetthema_ctp_artwork' );
// See https://developer.wordpress.org/reference/functions/register_post_type/.
register_post_type('artwork', [
    'labels' => [
        'name' => __('Artworks', 'hetthema'),
        'singular_name' => __('Artwork', 'hetthema'),
        //'add_new' => '',
        'add_new_item' => __('Add New Artwork', 'hetthema'),
        'edit_item' => __('Edit Artwork', 'hetthema'),
        'new_item ' => __('New Artwork', 'hetthema'),
        'view_item' => __('View Artwork', 'hetthema'),
        'view_items' => __('View Artworks', 'hetthema'),
        'search_items' => __('Search Artworks', 'hetthema'),
        'not_found' => __('No artworks found', 'hetthema'),
        'not_found_in_trash' => __('No artworks found in Trash', 'hetthema'),
        //'parent_item_colon' => 'Parent Artwork',
        'all_items' => __('All Artworks', 'hetthema'),
        'archives' => __('Artwork Archives', 'hetthema'),
        'attributes' => __('Artwork Attributes', 'hetthema'),
        'insert_into_item' => __('Insert into artwork', 'hetthema'),
        'uploaded_to_this_item' => __('Uploaded to this artwork', 'hetthema'),
        //'featured_image' => 'Featured image',
        //'set_featured_image' => 'Set featured image',
        //'remove_featured_image' => 'Remove featured image',
        //'use_featured_image' => 'Use featured image',
        //'menu_name' => 'Artworks',
        'filter_items_list' => __('Filter artworks list', 'hetthema'),
        //'filter_by_date' => 'Filter by date',
        'items_list_navigation' => __('Artworks list navigation', 'hetthema'),
        'items_list' => __('Artworks list', 'hetthema'),
        'item_published' => __('Artwork published', 'hetthema'),
        'item_published_privately' => __('Artwork published privately', 'hetthema'),
        'item_reverted_to_draft' => __('Artwork reverted to draft', 'hetthema'),
        'item_scheduled' => __('Artwork scheduled', 'hetthema'),
        'item_updated' => __('Artwork updated', 'hetthema'),
        'item_link' => __('Artwork Link', 'hetthema'),
        'item_link_description' => __('A link to an artwork', 'hetthema')
    ],
    //'labels' => [],
    'description' => 'A work of art.',
    'public' => true,
    //'hierarchical' => false,
    //'exclude_from_search' => false,
    //'publicly_queryable' => true,
    //'show_ui' => true,
    //'show_in_menu' => true,
    //'show_in_nav_menus' => true,
    //'show_in_admin_bar' => true,
    //'show_in_rest' => true,
    //'rest_base' => 'artist',
    //'rest_controller_class' => 'WP_REST_Posts_Controller',
    'menu_position' => 6,
    // Artist by Gregor Cresnar from NounProject.com
    'menu_icon' => 'dashicons-art',
    // 'capability_type',
    //'capabilities',
    //'map_meta_cap',
    'supports' => [
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt'
    ],
    //'register_meta_box_cb'
    //'taxonomies' => ['series', 'artform'], // TODO
    //'has_archive' => true,
    //'rewrite' => [],
    //'query_var' => 'artist',
    //'can_export' => true,
    'delete_with_user' => false,
    //'template' => [],
    //'template_lock' => false,
    //'_builtin' => false,
    //'_edit_link' => 'post.php?post=%d'
]);

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
