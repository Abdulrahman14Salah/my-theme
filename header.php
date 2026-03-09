<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package a-salah
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PCRBP2TB');</script>
    <!-- End Google Tag Manager -->
    
    <script src="https://analytics.ahrefs.com/analytics.js" data-key="qzmWDeZGuq/0ychhIKTjyQ" async></script>
    <script>
      var ahrefs_analytics_script = document.createElement('script');
      ahrefs_analytics_script.async = true;
      ahrefs_analytics_script.src = 'https://analytics.ahrefs.com/analytics.js';
      ahrefs_analytics_script.setAttribute('data-key', 'qzmWDeZGuq/0ychhIKTjyQ');
      document.getElementsByTagName('head')[0].appendChild(ahrefs_analytics_script);
    </script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCRBP2TB"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
	<div id="page" class="site">
		<a class="skip-link screen-reader-text focus:not-sr-only focus:absolute focus:z-50 focus:p-4 focus:bg-white focus:text-black" href="#primary"><?php esc_html_e('Skip to content', 'a-salah'); ?></a>
		<header id="header" class="group">
			<nav class="overflow-hidden z-20 w-full" aria-label="<?php esc_attr_e( 'Primary Navigation', 'a-salah' ); ?>">
				<div class="container">
					<div class="flex flex-wrap items-center justify-between py-2 sm:py-4">
						<div class="w-full items-center flex justify-between lg:w-auto">
							<a href="<?php echo home_url(); ?>" class="flex items-center">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="me-3" width="32" height="33" alt="Abdulrahman Salah Logo" />
						<span class="self-center text-2xl font-semibold whitespace-nowrap text-primary-300">Abdulrahman Salah</span>
					</a>
							<div class="flex lg:hidden">
								<button id="menu-btn" aria-label="open menu"
									class="btn variant-ghost sz-md icon-only relative z-20 -mr-2.5 block cursor-pointer lg:hidden text-white">

									<!-- Menu Icon -->
									<svg class="m-auto size-6 transition-[transform,opacity] duration-300 
                group-data-[state=active]:rotate-180 group-data-[state=active]:scale-0 group-data-[state=active]:opacity-0"
										xmlns="http://www.w3.org/2000/svg" fill="none"
										viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"></path>
									</svg>

									<!-- Close Icon -->
									<svg class="absolute inset-0 m-auto size-6 -rotate-180 scale-0 opacity-0 
                transition-[transform,opacity] duration-300 
                group-data-[state=active]:rotate-0 group-data-[state=active]:scale-100 group-data-[state=active]:opacity-100"
										xmlns="http://www.w3.org/2000/svg" fill="none"
										viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
									</svg>
								</button>
							</div>
						</div>
						<div class="w-full group-data-[state=active]:h-fit h-0 lg:w-fit flex-wrap justify-end items-center space-y-8 lg:space-y-0 lg:flex lg:h-fit md:flex-nowrap">
							<div class="mt-6 text-body md:-ml-4 lg:pr-4 lg:mt-0">
								<?php
								wp_nav_menu(
									[
										'theme_location'  => 'menu-1',
										'menu_id'         => 'primary-menu',
										'menu_class'      => 'custom-ul-class space-y-6 tracking-wide text-base lg:text-sm lg:flex lg:space-y-0', // Add class to <ul>
										'container'       => 'nav', // Change the container element
										'container_class' => 'custom-nav-class', // Add class to container
										'walker'          => new Custom_Walker_Nav_Menu() // Custom walker for <li> and <a>
									]
								);
								?>
							</div>

							<div class="w-full space-y-2 gap-2 pt-6 pb-4 lg:pb-0 border-t items-center flex flex-col lg:flex-row lg:space-y-0 lg:w-fit lg:border-l lg:border-t-0 lg:pt-0 lg:pl-2">
								<a href="<?php echo home_url(); ?>" class="btn variant-neutral sz-sm">
									<span>Get Quote</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</header>