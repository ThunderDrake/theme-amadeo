<?php

add_filter( 'template_include', function ( $template ) {
	return is_front_page() ? locate_template( '/templates/home-page/home-page.php' ) : $template;
}, 99 );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Настройки Главной',
		'menu_title'	=> 'Настройки Главной',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
    'position'    => 2
	));
	
}