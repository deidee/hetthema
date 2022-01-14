<?php
get_header();
?>
<div>Artwork</div>
<?php if ( have_posts() ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php
get_footer();
