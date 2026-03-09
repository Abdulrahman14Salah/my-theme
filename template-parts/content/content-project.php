<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Arqam-Web
 */

?>
<article id="post-<?php the_ID(); ?>" class="group flex items-center flex-col gap-8">
	<div class="block">
		<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
			<?php the_post_thumbnail('latest-project', array('class' => 'project-img w-full rounded-[30px] rounded-3xl object-cover', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title()))); ?>
		</a>
	</div>
	<div class="flex items-center justify-between max-w-[406px] lg:max-w-full w-full lg:px-0">
		<div class="block">
			<h3 class="text-2xl font-manrope font-semibold text-white mb-1">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<div class="categories mb-2 rtl">
				<?php
				$categories = get_the_terms(get_the_ID(), 'project_category');
				if ($categories && !is_wp_error($categories)) {
					$total_categories = count($categories);
					$counter = 0;

					foreach ($categories as $category) {
						$counter++;
						$is_last = ($counter === $total_categories) ? '' : '<span class="inline-block px-1 font-medium text-lg text-gray-400">,</span>'; // Add slash except for the last item
						$category_link = get_term_link($category); // Get category link

						echo "<a href='" . esc_url($category_link) . "' class='category font-medium text-lg text-gray-400 relative text-[15px] font-light leading-[1.5em] text-primary hover:underline'>" . esc_html($category->name) . "</a>" . $is_last;
					}
				}
				?>
			</div>
		</div>
		<a href="<?php the_permalink(); ?>" class="border border-white py-2 px-3.5 rounded-full transition-all duration-300 group-hover:bg-black group-hover:border-black" aria-label="View project details">
			<svg class="stroke-white transition-all duration-300"
				xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16"
				fill="none">
				<path
					d="M9.62553 4L13.6664 8.0409M13.6664 8.0409L9.62553 12.0818M13.6664 8.0409L1.6665 8.0409"
					stroke="" stroke-width="1.6" stroke-linecap="round" />
			</svg>
		</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->