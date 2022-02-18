<?php

get_header();

/*if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	}
}*/
?>
<h1><?= __('Not Found', 'hetthema') ?></h1>
<p><?= __('The page you are looking for cannot be found on this address.', 'hetthema') ?></p>
<?php

get_footer();
