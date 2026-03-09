<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package a-salah
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php if (have_posts()) : ?>
			<header class="page-header text-center py-8">
				<h1 class="entry-title font-bold text-white text-2xl sm:text-4xl"><?php single_cat_title(); ?></h1>

				<div class="arqamweb-breadcrumbs mt-4 text-white">
					<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</div>
			</header><!-- .page-header -->




			<div class="my-8">
				<div class="container flex gap-6 flex-wrap lg:flex-nowrap">
					<!-- Main Content -->
					<div class="w-full lg:w-2/3">
						<?php if (have_posts()) : ?>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
								<?php
								/* Start the Loop */
								while (have_posts()) :
									the_post();

									/*
									* Include the Post-Type-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Type name) and that will be used instead.
									*/
									get_template_part('template-parts/content/content');

								endwhile;
								?>
							</div>
						<?php else : ?>
							<p class="text-gray-600 text-center">There are no articles in this category.</p>
						<?php endif; ?>

						<div class="mt-8 flex justify-center">
							<?php the_posts_pagination(['mid_size' => 2, 'prev_text' => 'Prev', 'next_text' => 'Next']); ?>
						</div>
					</div>

					<!-- Sidebar with Categories -->
					<sidebar class="w-full lg:w-1/3 shadow-md rounded-lg p-4 h-max border">
						<h3 class="font-bold text-xl text-white mb-4">Categories</h3>
						<ul class="space-y-2">
							<?php
							// تحديد نوع التاكسونومي بناءً على نوع الـ post type الحالي
							if (is_post_type_archive('project') || is_tax('project_category')) {
								$taxonomy = 'project_category';
							} else {
								$taxonomy = 'category'; // التصنيفات العادية للمقالات
							}

							$terms = get_terms([
								'taxonomy' => $taxonomy,
								'hide_empty' => false,
							]);

							if (!empty($terms) && !is_wp_error($terms)) :
								foreach ($terms as $term) :
							?>
									<li>
										<a href="<?php echo get_term_link($term); ?>" class="text-blue-600 hover:text-blue-800">
											<?php echo $term->name; ?>
										</a>
									</li>
							<?php
								endforeach;
							endif;
							?>
						</ul>
					</sidebar>
				</div>
			</div>



		<?php
			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>
	</div>
</main><!-- #main -->

<?php
get_footer();
