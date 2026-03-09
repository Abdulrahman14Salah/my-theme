<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package a-salah
 */

get_header();
?>

<?php get_header(); ?>

<div class="container mx-auto px-4 py-8">
	<!-- Breadcrumbs -->
	<div class="text-sm text-gray-400 mb-6">
		<a href="<?php echo home_url(); ?>" class="hover:text-primary">الرئيسية</a>
		<span class="mx-2">/</span>
		<?php
		$categories = get_the_category();
		if ($categories) {
			echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="hover:text-primary">' . esc_html($categories[0]->name) . '</a>';
		}
		?>
		<span class="mx-2">/</span>
		<span class="text-gray-900 dark:text-gray-200"><?php the_title(); ?></span>
	</div>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-12">
				<!-- Featured Image -->
				<?php if (has_post_thumbnail()) : ?>
					<div class="relative h-96 w-full">
						<?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
					</div>
				<?php endif; ?>

				<!-- Post Content -->
				<div class="p-6 md:p-10">
					<!-- Post Meta -->
					<div class="flex flex-wrap items-center text-sm text-gray-400 mb-4">
						<span class="mr-4 flex items-center">
							<svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
							</svg>
							<?php echo get_the_date(); ?>
						</span>
						<span class="mr-4 flex items-center">
							<svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
							</svg>
							<?php the_author(); ?>
						</span>
						<span class="mr-4 flex items-center">
							<svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
							</svg>
							<?php the_category(', '); ?>
						</span>
					</div>

					<!-- Post Title -->
					<h1 class="text-3xl md:text-4xl font-bold text-white mb-6"><?php the_title(); ?></h1>

					<!-- Post Content -->
					<div class="entry-content prose prose-lg max-w-none dark:prose-invert prose-headings:font-semibold prose-headings:text-gray-900  prose-p:text-gray-700">
						<?php the_content(); ?>
					</div>

					<!-- Tags -->
					<?php if (get_the_tags()) : ?>
						<div class="flex flex-wrap mt-8">
							<?php
							$tags = get_the_tags();
							foreach ($tags as $tag) {
								echo '<a href="' . get_tag_link($tag->term_id) . '" class="bg-gray-700 text-gray-800 dark:text-gray-200 rounded-full px-3 py-1 text-sm ml-2 mb-2 hover:bg-primary hover:text-white transition-colors">#' . $tag->name . '</a>';
							}
							?>
						</div>
					<?php endif; ?>
				</div>
			</article>
	<?php endwhile;
	endif; ?>

	<!-- Post Navigation -->
	<div class="flex flex-col sm:flex-row justify-between mb-12 space-y-4 sm:space-y-0">
		<?php $prev_post = get_previous_post();
		if (!empty($prev_post)) : ?>
			<a href="<?php echo get_permalink($prev_post->ID); ?>" class="bg-gray-800 rounded-lg shadow-md p-6 flex flex-col sm:flex-row items-center hover:bg-gray-750 transition-colors w-full sm:w-[48%]">
				<div class="flex items-center mr-4 text-primary">
					<svg class="w-5 h-5 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
					</svg>
				</div>
				<div class="text-center sm:text-right">
					<span class="block text-sm text-gray-400 mb-1">المقال السابق</span>
					<h4 class="font-bold text-gray-400"><?php echo get_the_title($prev_post->ID); ?></h4>
				</div>
			</a>
		<?php endif; ?>

		<?php $next_post = get_next_post();
		if (!empty($next_post)) : ?>
			<a href="<?php echo get_permalink($next_post->ID); ?>" class="bg-gray-800 rounded-lg shadow-md p-6 flex flex-col sm:flex-row items-center hover:bg-gray-750 transition-colors w-full sm:w-[48%] justify-end">
				<div class="text-center sm:text-left">
					<span class="block text-sm text-gray-400 mb-1">المقال التالي</span>
					<h4 class="font-bold text-gray-400"><?php echo get_the_title($next_post->ID); ?></h4>
				</div>
				<div class="flex items-center ml-4 text-primary">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
					</svg>
				</div>
			</a>
		<?php endif; ?>
	</div>

	<!-- Related Posts -->
	<?php
	$categories = get_the_category();
	if ($categories) {
		$category_ids = [];
		foreach ($categories as $category) {
			$category_ids[] = $category->term_id;
		}

		$args = [
			'category__in' => $category_ids,
			'post__not_in' => [get_the_ID()],
			'posts_per_page' => 3,
			'orderby' => 'rand'
		];

		$related_posts = new WP_Query($args);

		if ($related_posts->have_posts()) : ?>
			<div class="mb-12">
				<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">مقالات ذات صلة</h3>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
					<?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
							<div class="h-48 overflow-hidden">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300']); ?>
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
								<?php endif; ?>
							</div>
							<div class="p-6">
								<h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2"><?php the_title(); ?></h4>
								<p class="text-gray-700 dark:text-gray-300 text-sm"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
								<span class="inline-block mt-3 text-primary text-sm font-medium hover:underline">اقرأ المزيد</span>
							</div>
						</a>
					<?php endwhile; ?>
				</div>
			</div>
	<?php endif;
		wp_reset_postdata();
	}
	?>

	<!-- Comments -->
	<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-12 p-6 md:p-10">
		<?php
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
	</div>

</div>

<?php get_footer(); ?>
<?php

get_footer();
