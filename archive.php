<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package a-salah
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<header class="page-header text-center py-8">
				<?php the_archive_title( '<h1 class="entry-title font-bold text-white text-2xl sm:text-4xl">', '</h1>' ); ?>
			</header>

			<div class="my-8 container flex gap-6 flex-wrap lg:flex-nowrap">
				<section class="w-full lg:w-2/3" aria-label="<?php esc_attr_e( 'Archive posts', 'a-salah' ); ?>">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content/content', get_post_type() );
						endwhile;
						?>
					</div>
					<div class="mt-8 flex justify-center">
						<?php the_posts_pagination(); ?>
					</div>
				</section>

				<aside class="w-full lg:w-1/3 shadow-md rounded-lg p-4 h-max border" aria-label="<?php esc_attr_e( 'Archive taxonomy links', 'a-salah' ); ?>">
					<h2 class="font-bold text-xl text-white mb-4"><?php esc_html_e( 'Categories', 'a-salah' ); ?></h2>
					<ul class="space-y-2">
						<?php
						$terms = get_terms(
							array(
								'taxonomy'   => is_post_type_archive( 'project' ) || is_tax( 'project_category' ) ? 'project_category' : 'category',
								'hide_empty' => false,
							)
						);
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
							foreach ( $terms as $term ) :
								?>
								<li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="text-blue-600 hover:text-blue-800"><?php echo esc_html( $term->name ); ?></a></li>
								<?php
							endforeach;
						endif;
						?>
					</ul>
				</aside>
			</div>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
