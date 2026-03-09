<?php
/**
 * Hero Section Pattern
 *
 * @package a-salah
 */

return array(
	'title'      => __( 'Hero Section', 'a-salah' ),
	'categories' => array( 'header' ),
	'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"8rem","bottom":"8rem"}}},"backgroundColor":"background-color","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull has-background-color-background-color has-background" style="padding-top:8rem;padding-bottom:8rem"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"3.5rem","lineHeight":"1.2"}}} -->
<h1 style="font-size:3.5rem;line-height:1.2">Building Digital Experiences That Matter</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem"}},"textColor":"gray-400"} -->
<p class="has-gray-400-color has-text-color" style="font-size:1.25rem">We create professional, high-performance websites tailored to your needs.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-primary-gradient"} -->
<div class="wp-block-button is-style-primary-gradient"><a class="wp-block-button__link">Get Started</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded-shadow"} -->
<figure class="wp-block-image size-large is-style-rounded-shadow"><img src="' . get_template_directory_uri() . '/assets/images/placeholder.png" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
