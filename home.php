<?php
/**
 * Home posts index template.
 *
 * @package a-salah
 */

get_header();
?>

<main id="primary" class="site-main my-8">
	<header class="bg-primary text-center py-8">
		<h1 class="entry-title font-bold text-white text-2xl sm:text-4xl"><?php esc_html_e( 'Blog', 'a-salah' ); ?></h1>
		<div class="arqamweb-breadcrumbs mt-4 text-white">
			<?php if ( function_exists( 'rank_math_the_breadcrumbs' ) ) : ?>
				<?php rank_math_the_breadcrumbs(); ?>
			<?php endif; ?>
		</div>
	</header>

	<div class="my-8 container flex gap-6 flex-wrap lg:flex-nowrap">
		<section class="w-full lg:w-2/3" aria-label="<?php esc_attr_e( 'Posts', 'a-salah' ); ?>">
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="main-posts-container">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
					<?php endwhile; ?>
				</div>
				<div class="mt-8 flex justify-center">
					<?php the_posts_pagination(); ?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</section>

		<aside class="w-full lg:w-1/3 shadow-md rounded-lg p-4 h-max border" aria-label="<?php esc_attr_e( 'Categories', 'a-salah' ); ?>">
			<h2 class="font-bold text-xl text-white mb-4"><?php esc_html_e( 'Categories', 'a-salah' ); ?></h2>
			<ul class="space-y-2">
				<?php foreach ( get_categories() as $category ) : ?>
					<li>
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="text-blue-600 hover:text-blue-800"><?php echo esc_html( $category->name ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</aside>
	</div>
</main>

<?php
get_footer();
