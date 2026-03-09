<?php get_header();

$args = array(
    'posts_per_page' => 10, // عدد المقالات التي سيتم عرضها
);
$query = new WP_Query($args);
?>

<main class="my-8">
    <header class="bg-primary text-center py-8">
        <h1 class="entry-title font-bold text-white text-2xl sm:text-4xl">Blog</h1>
        <div class="arqamweb-breadcrumbs mt-4 text-white">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </header>
    <div class="my-8">
        <div class="container flex gap-6 flex-wrap lg:flex-nowrap">
            <!-- Main Content -->
            <div class="w-full lg:w-2/3">
                <?php if ($query->have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <article class="shadow-lg rounded-lg overflow-hidden border border-gray-300">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="w-full h-48 object-cover" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                                    </a>
                                <?php endif; ?>

                                <div class="p-6">
                                    <h2 class="text-xl font-semibold text-white">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-primary-600"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="text-gray-400 text-sm mt-2"><?php the_excerpt(); ?></div>
                                    <a href="<?php the_permalink(); ?>" class="font-medium mt-4 inline-block text-primary-600 hover:text-primary-800">Read more →</a>
                                </div>
                            </article>
                        <?php endwhile; ?>
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
                    $categories = get_categories();
                    foreach ($categories as $category) :
                    ?>
                        <li>
                            <a href="<?php echo get_category_link($category->term_id); ?>" class="text-blue-600 hover:text-blue-800"><?php echo $category->name; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </sidebar>
        </div>
    </div>
</main>

<?php get_footer(); ?>