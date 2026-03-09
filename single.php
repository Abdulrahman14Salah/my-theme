<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package a-salah
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container mx-auto px-4 py-8">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-12' ); ?> itemscope itemtype="https://schema.org/BlogPosting">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="relative h-96 w-full">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover', 'itemprop' => 'image' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="p-6 md:p-10">
					<header class="mb-6">
						<h1 class="text-3xl md:text-4xl font-bold text-white mb-4" itemprop="headline"><?php the_title(); ?></h1>
						<p class="text-sm text-gray-400">
							<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" itemprop="datePublished"><?php echo esc_html( get_the_date() ); ?></time>
						</p>
					</header>

					<div class="entry-content prose prose-lg max-w-none dark:prose-invert prose-headings:font-semibold prose-headings:text-gray-900 prose-p:text-gray-700" itemprop="articleBody">
						<?php the_content(); ?>
					</div>
				</div>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
