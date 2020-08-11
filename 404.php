<?php

get_header();

/*if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	}
}*/
?>
<h1><?= __('Niet gevonden') ?></h1>
<p><?= __('De pagina waar u naar zoekt is niet gevonden op dit adres.') ?></p>
<?php

get_footer();
