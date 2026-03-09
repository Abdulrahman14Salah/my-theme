<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package a-salah
 */

?>

<article id="post-<?php the_ID(); ?>" class="shadow-lg rounded-lg overflow-hidden border border-gray-300">
	<?php if (has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('latest-project', array('class' => 'project-img w-full object-cover', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title()))); ?>
		</a>
	<?php endif; ?>

	<div class="p-6">
		<h2 class="text-xl font-semibold text-white">
			<a href="<?php the_permalink(); ?>" class="hover:text-primary-600"><?php the_title(); ?></a>
		</h2>
		<div class="text-gray-400 text-sm mt-2"><?php the_excerpt(); ?></div>
		<a href="<?php the_permalink(); ?>" class="font-medium mt-4 inline-block text-primary-600 hover:text-primary-800">Read more →</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->