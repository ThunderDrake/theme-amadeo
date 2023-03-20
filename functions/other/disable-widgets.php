<?php

// Отключает все стандартные виджеты WordPress.
remove_action( 'init', 'wp_widgets_init', 1 );

/**
 * Выборочно отключает стандартные виджеты WordPress.
 * Код оставлен на случай надобности такой возможности.
 *
 * @return void
 */
/*function unregister_basic_widgets() {
	unregister_widget( 'WP_Widget_Pages' );            // Виджет страниц
	unregister_widget( 'WP_Widget_Calendar' );         // Календарь
	unregister_widget( 'WP_Widget_Archives' );         // Архивы
	unregister_widget( 'WP_Widget_Links' );            // Ссылки
	unregister_widget( 'WP_Widget_Meta' );             // Мета виджет
	unregister_widget( 'WP_Widget_Search' );           // Поиск
	unregister_widget( 'WP_Widget_Text' );             // Текст
	unregister_widget( 'WP_Widget_Categories' );       // Категории
	unregister_widget( 'WP_Widget_Recent_Posts' );     // Последние записи
	unregister_widget( 'WP_Widget_Recent_Comments' );  // Последние комментарии
	unregister_widget( 'WP_Widget_RSS' );              // RSS
	unregister_widget( 'WP_Widget_Tag_Cloud' );        // Облако меток
	unregister_widget( 'WP_Nav_Menu_Widget' );         // Меню
	unregister_widget( 'WP_Widget_Media_Audio' );      // Audio
	unregister_widget( 'WP_Widget_Media_Video' );      // Video
	unregister_widget( 'WP_Widget_Media_Gallery' );    // Gallery
	unregister_widget( 'WP_Widget_Media_Image' );      // Image
	unregister_widget( 'WP_Widget_Custom_HTML' );      // Произвольный HTML код
	unregister_widget( 'WP_Widget_Block' );            // Блок
}

add_action( 'widgets_init', 'unregister_basic_widgets' );*/
