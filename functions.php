<?php

defined( 'ABSPATH' ) || exit;

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
    add_theme_support( 'custom-logo' );

	// Load translations.
    load_theme_textdomain( 'hetthema', get_template_directory() . '/languages' );
}

// Disable smileys (these are not actual emoji).
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Apply stylesheet.
add_action( 'wp_enqueue_scripts', 'hetthema_scripts' );
function hetthema_scripts() {
	wp_register_style( 'default-style', 'https://default.style/', '', '1.0.0' );
	wp_enqueue_style( 'default-style' );
}
// Call this in child theme if Default.style is unwanted.
function hetthema_remove_default_style() {
    wp_dequeue_style( 'default-style' );
    wp_deregister_style( 'default-style' );
}

// Modern Web browsers only allow videos to autoplay when they are inline and muted.
add_filter( 'wp_video_shortcode', function( $html ) {
	if(strpos($html, ' autoplay') !== false) {
		return str_replace( '<video', '<video muted playsinline', $html );
	}

	return $html;
} );

// Custom Post Type: Artist.
add_action( 'init', 'hetthema_ctp_artist' );
function hetthema_ctp_artist() {
    // See https://developer.wordpress.org/reference/functions/register_post_type/.
    register_post_type('artist', [
        'labels' => [
            'name' => __('Artists', 'hetthema'),
            'singular_name' => __('Artist', 'hetthema'),
            'add_new' => __('New Artist', 'hetthema'),
            'add_new_item' => __('Add New Artist', 'hetthema'),
            'edit_item' => __('Edit Artist', 'hetthema'),
            'new_item' => __('New Artist', 'hetthema'),
            'view_item' => __('View Artist', 'hetthema'),
            'view_items' => __('View Artists', 'hetthema'),
            'search_items' => __('Search Artists', 'hetthema'),
            'not_found' => __('No artists found', 'hetthema'),
            'not_found_in_trash' => __('No artists found in Trash', 'hetthema'),
            //'parent_item_colon' => 'Parent Artist',
            'all_items' => __('All Artists', 'hetthema'),
            'archives' => __('Artist Archives', 'hetthema'),
            'attributes' => __('Artist Attributes', 'hetthema'),
            'insert_into_item' => __(/** @lang text */ 'Insert into artist', 'hetthema'),
            'uploaded_to_this_item' => __('Uploaded to this artist', 'hetthema'),
            //'featured_image' => 'Featured image',
            //'set_featured_image' => 'Set featured image',
            //'remove_featured_image' => 'Remove featured image',
            //'use_featured_image' => 'Use featured image',
            //'menu_name' => 'Artists',
            'filter_items_list' => __('Filter artists list', 'hetthema'),
            //'filter_by_date' => 'Filter by date',
            'items_list_navigation' => __('Artists list navigation', 'hetthema'),
            'items_list' => __('Artists list', 'hetthema'),
            'item_published' => __('Artist published', 'hetthema'),
            'item_published_privately' => __('Artist published privately', 'hetthema'),
            'item_reverted_to_draft' => __('Artist reverted to draft', 'hetthema'),
            'item_scheduled' => __('Artist scheduled', 'hetthema'),
            'item_updated' => __('Artist updated', 'hetthema'),
            'item_link' => __('Artist Link', 'hetthema'),
            'item_link_description' => __('A link to an artist', 'hetthema')
        ],
        //'labels' => [],
        'description' => 'An artist.',
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
        'menu_icon' => 'dashicons-art',
        // 'capability_type',
        //'capabilities',
        //'map_meta_cap',
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'revisions'
        ],
        //'register_meta_box_cb'
        'taxonomies' => ['country'],
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        //'query_var' => 'artist',
        //'can_export' => true,
        'delete_with_user' => false,
        //'template' => [],
        //'template_lock' => false,
        //'_builtin' => false,
        //'_edit_link' => 'post.php?post=%d'
    ]);
}

// Custom Post Type: Artwork.
add_action( 'init', 'hetthema_ctp_artwork' );
function hetthema_ctp_artwork() {
    // See https://developer.wordpress.org/reference/functions/register_post_type/.
    register_post_type('artwork', [
        'labels' => [
            'name' => __('Artworks', 'hetthema'),
            'singular_name' => __('Artwork', 'hetthema'),
            'add_new' => __('New Artwork', 'hetthema'),
            'add_new_item' => __('Add New Artwork', 'hetthema'),
            'edit_item' => __('Edit Artwork', 'hetthema'),
            'new_item' => __('New Artwork', 'hetthema'),
            'view_item' => __('View Artwork', 'hetthema'),
            'view_items' => __('View Artworks', 'hetthema'),
            'search_items' => __('Search Artworks', 'hetthema'),
            'not_found' => __('No artworks found', 'hetthema'),
            'not_found_in_trash' => __('No artworks found in Trash', 'hetthema'),
            //'parent_item_colon' => 'Parent Artwork',
            'all_items' => __('All Artworks', 'hetthema'),
            'archives' => __('Artwork Archives', 'hetthema'),
            'attributes' => __('Artwork Attributes', 'hetthema'),
            'insert_into_item' => __(/** @lang text */ 'Insert into artwork', 'hetthema'),
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
        //'rest_base' => 'artwork',
        //'rest_controller_class' => 'WP_REST_Posts_Controller',
        'menu_position' => 7,
        'menu_icon' => 'dashicons-art',
        // 'capability_type',
        //'capabilities',
        //'map_meta_cap',
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'revisions'
        ],
        //'register_meta_box_cb'
        'taxonomies' => ['artform'],
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        //'query_var' => 'artwork',
        //'can_export' => true,
        'delete_with_user' => false,
        //'template' => [],
        //'template_lock' => false,
        //'_builtin' => false,
        //'_edit_link' => 'post.php?post=%d'
    ]);
}

// Custom Post Type: Exhibition.
add_action( 'init', 'hetthema_ctp_exhibition' );
function hetthema_ctp_exhibition() {
    // See https://developer.wordpress.org/reference/functions/register_post_type/.
    register_post_type('exhibition', [
        //'label' => 'Exhibition',
        'labels' => [
            'name' => __('Exhibitions', 'hetthema'),
            'singular_name' => __('Exhibition', 'hetthema'),
            'add_new' => __('New Exhibition', 'hetthema'),
            'add_new_item' => __('Add New Exhibition', 'hetthema'),
            'edit_item' => __('Edit Exhibition', 'hetthema'),
            'new_item' => __('New Exhibition', 'hetthema'),
            'view_item' => __('View Exhibition', 'hetthema'),
            'view_items' => __('View Exhibitions', 'hetthema'),
            'search_items' => __('Search Exhibitions', 'hetthema'),
            'not_found' => __('No exhibitions found', 'hetthema'),
            'not_found_in_trash' => __('No exhibitions found in Trash', 'hetthema'),
            //'parent_item_colon' => 'Parent Exhibition',
            'all_items' => __('All Exhibitions', 'hetthema'),
            'archives' => __('Exhibition Archives', 'hetthema'),
            'attributes' => __('Exhibition Attributes', 'hetthema'),
            'insert_into_item' => __(/** @lang text */ 'Insert into exhibition', 'hetthema'),
            'uploaded_to_this_item' => __('Uploaded to this exhibition', 'hetthema'),
            //'featured_image' => 'Featured image',
            //'set_featured_image' => 'Set featured image',
            //'remove_featured_image' => 'Remove featured image',
            //'use_featured_image' => 'Use featured image',
            //'menu_name' => 'Exhibitions',
            'filter_items_list' => __('Filter exhibitions list', 'hetthema'),
            //'filter_by_date' => 'Filter by date',
            'items_list_navigation' => __('Exhibitions list navigation', 'hetthema'),
            'items_list' => __('Exhibitions list', 'hetthema'),
            'item_published' => __('Exhibition published', 'hetthema'),
            'item_published_privately' => __('Exhibition published privately', 'hetthema'),
            'item_reverted_to_draft' => __('Exhibition reverted to draft', 'hetthema'),
            'item_scheduled' => __('Exhibition scheduled', 'hetthema'),
            'item_updated' => __('Exhibition updated', 'hetthema'),
            'item_link' => __('Exhibition Link', 'hetthema'),
            'item_link_description' => __('A link to an exhibition', 'hetthema')
        ],
        'description' => 'An exhibition.',
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
        'menu_position' => 8,
        'menu_icon' => 'dashicons-art',
        // 'capability_type',
        //'capabilities',
        //'map_meta_cap',
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'revisions'
        ],
        //'register_meta_box_cb'
        //'taxonomies' => ['fair'], // TODO
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        //'query_var' => 'exhibition',
        //'can_export' => true,
        'delete_with_user' => false,
        //'template' => [],
        //'template_lock' => false,
        //'_builtin' => false,
        //'_edit_link' => 'post.php?post=%d'
    ]);
}

// Custom Post Type: Artwork.
add_action( 'init', 'hetthema_ctp_location' );
function hetthema_ctp_location() {
    // See https://developer.wordpress.org/reference/functions/register_post_type/.
    register_post_type('location', [
        'labels' => [
            'name' => __('Locations', 'hetthema'),
            'singular_name' => __('Location', 'hetthema'),
            'add_new' => __('New Location', 'hetthema'),
            'add_new_item' => __('Add New Location', 'hetthema'),
            'edit_item' => __('Edit Location', 'hetthema'),
            'new_item' => __('New Location', 'hetthema'),
            'view_item' => __('View Location', 'hetthema'),
            'view_items' => __('View Locations', 'hetthema'),
            'search_items' => __('Search Locations', 'hetthema'),
            'not_found' => __('No locations found', 'hetthema'),
            'not_found_in_trash' => __('No locations found in Trash', 'hetthema'),
            //'parent_item_colon' => 'Parent Location',
            'all_items' => __('All Locations', 'hetthema'),
            'archives' => __('Location Archives', 'hetthema'),
            'attributes' => __('Location Attributes', 'hetthema'),
            'insert_into_item' => __(/** @lang text */ 'Insert into locations', 'hetthema'),
            'uploaded_to_this_item' => __('Uploaded to this location', 'hetthema'),
            //'featured_image' => 'Featured image',
            //'set_featured_image' => 'Set featured image',
            //'remove_featured_image' => 'Remove featured image',
            //'use_featured_image' => 'Use featured image',
            //'menu_name' => 'Locations',
            'filter_items_list' => __('Filter Locations list', 'hetthema'),
            //'filter_by_date' => 'Filter by date',
            'items_list_navigation' => __('Locations list navigation', 'hetthema'),
            'items_list' => __('Locations list', 'hetthema'),
            'item_published' => __('Location published', 'hetthema'),
            'item_published_privately' => __('Location published privately', 'hetthema'),
            'item_reverted_to_draft' => __('Location reverted to draft', 'hetthema'),
            'item_scheduled' => __('Location scheduled', 'hetthema'),
            'item_updated' => __('Location updated', 'hetthema'),
            'item_link' => __('Location Link', 'hetthema'),
            'item_link_description' => __('A link to an location', 'hetthema')
        ],
        //'labels' => [],
        'description' => 'A location.',
        'public' => true,
        //'hierarchical' => false,
        //'exclude_from_search' => false,
        //'publicly_queryable' => true,
        //'show_ui' => true,
        //'show_in_menu' => true,
        //'show_in_nav_menus' => true,
        //'show_in_admin_bar' => true,
        //'show_in_rest' => true,
        //'rest_base' => 'location',
        //'rest_controller_class' => 'WP_REST_Posts_Controller',
        'menu_position' => 7,
        'menu_icon' => 'dashicons-location-alt',
        // 'capability_type',
        //'capabilities',
        //'map_meta_cap',
        'supports' => [
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'page-attributes',
            'revisions'
        ],
        //'register_meta_box_cb'
        //'taxonomies' => ['artform'],
        'has_archive' => true,
        'rewrite' => [
            'with_front' => false
        ],
        //'query_var' => 'location',
        //'can_export' => true,
        'delete_with_user' => false,
        //'template' => [],
        //'template_lock' => false,
        //'_builtin' => false,
        //'_edit_link' => 'post.php?post=%d'
    ]);
}

// Custom Taxonomy: Artform.
add_action( 'init', 'hetthema_tax_artform' );
function hetthema_tax_artform() {
    register_taxonomy('artform', 'artwork', [
        'labels' => [
            'name' => 'Artforms',
            'singular_name' => 'Artform',
            'search_items' => 'Search Artforms',
            'popular_items' => 'Popular Artforms',
            'all_items' => 'All Artforms',
            'parent_item' => 'Parent Artform',
            'parent_item_colon' => 'Parent Artform:',
            'edit_item' => 'Edit Artform',
            'view_item' => 'View Artform',
            'update_item' => 'Update Artform',
            'add_new_item' => 'Add New Artform',
            'new_item_name' => 'New Artform Name',
            'separate_items_with_commas' => 'Separate artforms with commas',
            'add_or_remove_items' => 'Add or remove artforms',
            'choose_from_most_used' => 'Choose from the most used artforms',
            'not_found' => 'No artforms found',
            'no_terms' => 'No artforms',
            'filter_by_item' => 'Filter by artform',
            //'items_list_navigation' => '',
            //'items_list' => '',
            'most_used' => 'Most Used',
            //'back_to_items' => '',
            'item_link' => 'Artform Link',
            'item_link_description' => 'A link to an artform'
        ],
        'description' => 'e.g. Painting, Drawing, Sculpture, Print, Photograph, Assemblage, Collage, etc.',
        'public' => true,
        'publicly_queryable' => false,
        //'hierarchical' => false,
        //'show_ui' => false,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'show_in_rest' => false,
        //'rest_base' => '',
        //'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_tagcloud' => false,
        'show_in_quick_edit' => false,
        //'show_admin_column' => false,
        //'meta_box_cb',
        //'meta_box_sanitize_cb',
        //'capabilities' => [],
        'rewrite' => [
            'with_front' => false
        ],
        'query_var' => false,
        //'update_count_callback' => '',
        'default_term' => [
            'name' => 'Painting',
            'slug' => 'painting'
        ],
        //'sort' => false,
        //'args' => [],
        //'_builtin' => false
    ]);
}

// Custom Taxonomy: Country.
add_action( 'init', 'hetthema_tax_country' );
function hetthema_tax_country() {
    register_taxonomy('country', 'artist', [
        'labels' => [
            'name' => 'Countries',
            'singular_name' => 'Country',
            'search_items' => 'Search Countries',
            'popular_items' => 'Popular Countries',
            'all_items' => 'All Countries',
            'parent_item' => 'Parent Country',
            'parent_item_colon' => 'Parent Country:',
            'edit_item' => 'Edit Country',
            'view_item' => 'View Country',
            'update_item' => 'Update Country',
            'add_new_item' => 'Add New Country',
            'new_item_name' => 'New Country Name',
            'separate_items_with_commas' => 'Separate countries with commas',
            'add_or_remove_items' => 'Add or remove countries',
            'choose_from_most_used' => 'Choose from the most used countries',
            'not_found' => 'No countries found',
            'no_terms' => 'No countries',
            'filter_by_item' => 'Filter by country',
            //'items_list_navigation' => '',
            //'items_list' => '',
            'most_used' => 'Most Used',
            //'back_to_items' => '',
            'item_link' => 'Country Link',
            'item_link_description' => 'A link to a country'
        ],
        //'description' => '',
        'public' => true,
        'publicly_queryable' => false,
        //'hierarchical' => false,
        //'show_ui' => false,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'show_in_rest' => false,
        //'rest_base' => '',
        //'rest_controller_class' => 'WP_REST_Terms_Controller',
        'show_tagcloud' => false,
        'show_in_quick_edit' => false,
        //'show_admin_column' => false,
        //'meta_box_cb',
        //'meta_box_sanitize_cb',
        //'capabilities' => [],
        'rewrite' => [
            'with_front' => false
        ],
        'query_var' => false,
        //'update_count_callback' => '',
        'default_term' => [
            'name' => 'Netherlands',
            'slug' => 'nl'
        ],
        //'sort' => false,
        //'args' => [],
        //'_builtin' => false
    ]);
}

function hetthema_dashboard_widget( $post, $callback_args ) {
    echo <<<HTML
<p>Dit thema is gebaseerd op <a href="https://github.com/deidee/hetthema">hetthema</a> van <a href="https://deidee.nl/">deidee</a>.</p>
HTML;

}

function hetthema_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'dashboard_widget', 'hetThema', 'hetthema_dashboard_widget' );
}
add_action( 'wp_dashboard_setup', 'hetthema_add_dashboard_widgets' );

if(!function_exists('hetthema_lorem_picsum')) {
	function hetthema_lorem_picsum($width = 512, $height = NULL) {
		if(empty($height)) $height = $width;

		return 'https://picsum.photos/' . $width . '/' . $height;
	}
}

if(!function_exists('hetthema_jsonld')) {
    function hetthema_jsonld($object)
    {
        $r = '<script type="application/ld+json">';
        $r .= json_encode($object);
        $r .= '</script>';

        return $r;
    }
}

// Pretty var_dump.
if(!function_exists('jw')) {
	function jw() {
		ob_start();
		$expression = func_get_args();
		call_user_func_array('var_dump', $expression);
		echo '<pre><code class="language-php">' . htmlentities(ob_get_clean()) . '</code></pre>';
	}
}
