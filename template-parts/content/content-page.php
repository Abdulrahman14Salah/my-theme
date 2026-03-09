<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package a-salah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="bg-primary text-center py-8">
		<?php the_title('<h1 class="entry-title font-bold text-white text-2xl sm:text-4xl">', '</h1>'); ?>
		<div class="arqamweb-breadcrumbs mt-4 text-white">
			<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
		</div><!-- Rank Math -->
	</header><!-- .entry-header -->

	<?php a_salah_post_thumbnail(); ?>

	<div class="entry-content text-gray-400">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links text-white">' . esc_html__('Pages:', 'a-salah'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Edit <span class="screen-reader-text">%s</span>', 'a-salah'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->