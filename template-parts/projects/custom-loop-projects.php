<!-- Projects -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    $args = array(
        'post_type' => 'project',
        'posts_per_page' => $args['postCount'],
        'order' => 'ASC',
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        $count = 0;
        while ($the_query->have_posts()) :
            $the_query->the_post();
            // Make Service Counter 
            $count++;

            get_template_part('template-parts/content/content', get_post_type());

        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>
<!-- Projects -->