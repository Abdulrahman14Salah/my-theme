<?php
/**
 * The template for displaying tag archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package a-salah
 */

get_header();
?>

	<main id="primary" class="site-main container py-12">

		<?php if (have_posts()) : ?>

			<header class="page-header mb-12">
				<h1 class="page-title text-4xl font-bold text-white mb-4">
					<svg class="inline-block w-8 h-8 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
					</svg>
					<?php single_tag_title(); ?>
				</h1>
				<?php
				$tag_description = tag_description();
				if ($tag_description) :
				?>
					<div class="archive-description text-gray-300 text-lg">
						<?php echo $tag_description; ?>
					</div>
				<?php endif; ?>
			</header>

			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php
				while (have_posts()) :
					the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('card variant-outlined overflow-hidden hover:border-primary-300 transition-colors'); ?>>
						<?php if (has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>" class="block">
								<?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
							</a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>" class="block">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.png" alt="<?php the_title(); ?>" class="w-full h-48 object-cover" />
							</a>
						<?php endif; ?>
						
						<div class="p-6">
							<div class="flex items-center gap-4 text-sm text-gray-400 mb-3">
								<time datetime="<?php echo get_the_date('c'); ?>">
									<?php echo get_the_date(); ?>
								</time>
								<span>•</span>
								<span><?php echo get_the_category_list(', '); ?></span>
							</div>
							
							<h2 class="text-xl font-bold mb-3">
								<a href="<?php the_permalink(); ?>" class="text-white hover:text-primary-300">
									<?php the_title(); ?>
								</a>
							</h2>
							
							<div class="text-gray-300 mb-4">
								<?php the_excerpt(); ?>
							</div>
							
							<a href="<?php the_permalink(); ?>" class="btn variant-neutral sz-sm inline-flex">
								<span>اقرأ المزيد</span>
							</a>
						</div>
					</article>
				<?php
				endwhile;
				?>
			</div>

			<?php
			the_posts_navigation([
				'prev_text' => __('&larr; الأقدم', 'a-salah'),
				'next_text' => __('الأحدث &rarr;', 'a-salah'),
			]);
			?>

		<?php else : ?>
			
			<div class="text-center py-12">
				<h1 class="text-3xl font-bold text-white mb-4">لم يتم العثور على منشورات</h1>
				<p class="text-gray-300 mb-8">عذراً، لا توجد منشورات بهذا الوسم حالياً.</p>
				<a href="<?php echo home_url(); ?>" class="btn variant-neutral">
					<span>العودة للصفحة الرئيسية</span>
				</a>
			</div>

		<?php endif; ?>

	</main>

<?php
get_sidebar();
get_footer();
