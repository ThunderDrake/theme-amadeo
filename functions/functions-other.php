<?php

/**
 * При регистрации CTP "ловит" и применяет параметры "Шаблон" и "Количество выводимых постов".
 */
add_action( 'registered_post_type', function ( $post_type, $ctp_object ) {

	add_filter( 'template_include', function ( $templates ) use ( $ctp_object ) {
		// Задаём шаблон одиночной записи.
		if ( ! empty( $ctp_object->template_item ) && is_singular( $ctp_object->name ) ) {
			$templates = locate_template( $ctp_object->template_item );
		}

		// Задаём шаблон архиву записей.
		if ( ! empty( $ctp_object->template_archive ) && is_post_type_archive( $ctp_object->name ) ) {
			$templates = locate_template( $ctp_object->template_archive );
		}

		return $templates;
	} );

	// Устанавливаем количество выводимых записей в архивах.
	add_action( 'pre_get_posts', function ( $query ) use ( $ctp_object ) {
		if (
			! empty( $ctp_object->posts_per_page )
			&& ! is_admin()
			&& $query->is_main_query()
			&& $query->is_post_type_archive( $ctp_object->name )
		) {
			$query->set( 'posts_per_page', $ctp_object->posts_per_page );
		}
	} );

	// Устанавливаем плейсхолдер в поле Заголовок на странице редактирования записи
	add_filter( 'enter_title_here', function ( $text, $post ) use ( $ctp_object ) {
		if ( isset( $ctp_object->labels->title_placeholder ) && $post->post_type === $ctp_object->name ) {
			$text = $ctp_object->labels->title_placeholder;
		}

		return $text;
	}, 11, 2 );

}, 10, 2 );

/**
 * При регистрации Таксономии "ловит" и применяет параметры "Шаблон" и "Количество выводимых постов".
 */
add_action( 'registered_taxonomy', function ( $taxonomy, $object_type, $taxonomy_object ) {
	add_filter( 'template_include', function ( $templates ) use ( $taxonomy, $taxonomy_object ) {
		// Задаём шаблон термину.
		if ( ! empty( $taxonomy_object['template_item'] ) && is_tax( $taxonomy ) ) {
			$templates = locate_template( $taxonomy_object['template_item'] );
		}

		return $templates;
	} );

	// Устанавливаем количество выводимых записей в архивах.
	add_action( 'pre_get_posts', function ( $query ) use ( $taxonomy, $taxonomy_object ) {
		if (
			! empty( $taxonomy_object['posts_per_page'] )
			&& ! is_admin()
			&& $query->is_main_query()
			&& $query->is_tax( $taxonomy )
		) {
			$query->set( 'posts_per_page', $taxonomy_object['posts_per_page'] );
		}
	} );

}, 10, 3 );

// Удаляет из админ-сайдбара пункты меню.
add_action( 'admin_menu', function () {
	remove_menu_page( 'edit.php' );          // Записи
	remove_menu_page( 'edit-comments.php' ); // Комментарии
} );

/**
 * Возвращает ссылку на следующую страницу пагинации на странице архивов без GET параметров.
 *
 * @return false|string
 */
function get_next_paged_url() {
	$url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages ?: 1 );

	return strtok( $url, '?' );
}

/**
 * Получение ID страницы по её slug.
 *
 * @param string $page_slug Slug страницы
 *
 * @return int
 */
function get_id_by_slug( $page_slug ) {
	return get_page_by_path( $page_slug )->ID ?? null;
}

/**
 * Выводит на экран стили для таблицы в ACF поле Message.
 *
 * @return void
 */
function _show_css_for_table_with_files_and_images() {
	static $show = true;

	if ( $show ) {
		?>
        <style>
            table.fff333ggg,
            table.fff333ggg th,
            table.fff333ggg td {
                border-collapse: collapse;
                border: 1px solid grey;
                text-align: left;
                padding: 0 5px;
            }
        </style>
		<?php
	}

	$show = false;
}

/**
 * Возвращает направление сортировки (ASC или DESC) на основе GET параметра "sort".
 *
 * Варианты: old-first или new-first
 *
 * @return string
 */
function get_param_sort_value_for_query() {
	$sort = $_GET['sort'] ?? '';

	return $sort === 'old-first' ? 'ASC' : 'DESC';
}

/**
 * Проверяет, является ли запрос основным и выполняем во фронте.
 *
 * @param WP_Query $query
 *
 * @return bool
 */
function is_main_query_in_front( $query ) {
	return ! is_admin() && $query->is_main_query();
}

/**
 * Добавляет класс тегу <a> в меню WP.
 */
function add_additional_class_to_anchor( $classes, $item, $args ) {
	if ( isset( $args->add_a_class ) ) {
		$classes['class'] = $args->add_a_class;
	}

	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'add_additional_class_to_anchor', 1, 3 );

/**
 * Добавляет класс тегу <li> в меню WP.
 */
function add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'add_additional_class_on_li', 1, 3 );

/**
 * Добавляет поддержку SVG.
 */
add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

/**
 *
 * Исправляет MIME SVG.
 *
 * fix_svg_mime_type
 *
 * @param mixed $data
 * @param mixed $file
 * @param mixed $filename
 * @param mixed $mimes
 * @param mixed $real_mime
 *
 * @return void
 */

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ) {

	// WP 5.1 +
	if ( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ) {
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	} else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, - 4 ) ) );
	}

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if ( $dosvg ) {

		// разрешим
		if ( current_user_can( 'manage_options' ) ) {

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		} // запретим
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}

	}

	return $data;
}


/**
 * show_svg_in_media_library
 *
 * @param mixed $response
 *
 * @return void
 */
add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );
function show_svg_in_media_library( $response ) {

	if ( $response['mime'] === 'image/svg+xml' ) {

		// С выводом названия файла
		$response['image'] = [
			'src' => $response['url'],
		];
	}

	return $response;
}

/**
 * Возвращает миниатюру поста.
 *
 * @param array $args
 *
 * @return string
 */
function get_post_thumb( $args = [] ) {
	$args = array_merge( [ 'allow' => 'any' ], $args );

	return kama_thumb_src( $args );
}

/**
 * Получает соседние (по дате) записи.
 *
 * @param array $args         {
 *                            Массив аргументов:
 *
 * @type int    $limit        По сколько соседних записей нужно получить.
 * @type bool   $in_same_term Получать записи только из тех же терминов в кторых находится текущая запись.
 * @type string $taxonomy     Название таксы. Когда $in_same_term = true, нужно знать с какой таксой работать.
 * @type int/WP_Post $post         Пост от которого идет отсчет. По умолчанию: текущий.
 * @type string $order        Порядок сортировки. При DESC - элемент 'prev' будет содержать новые записи, а 'next' старые. При ASC наоборот...
 * @type bool   $cache_result Нужно ли кэшировать результат в объектный кэш?
 * }
 *
 * @return array Массив вида array( 'prev'=>array(посты), 'next'=>array(посты) ) или array() если не удалось получить записи или в запросе есть ошибка.
 *
 * @ver 1.0
 */
function get_post_adjacents( $args = [] ) {
	global $wpdb;

	$args = (object) array_merge( [
		'limit'        => 3,
		'in_same_term' => false,
		'taxonomy'     => 'category',
		'post'         => $GLOBALS['post'],
		'order'        => 'DESC',
		'cache_result' => false,
	], $args );

	$post = is_numeric( $args->post ) ? get_post( $args->post ) : $args->post;

	// in_same_term
	$join = $where = '';
	if ( $args->in_same_term ) {
		$join  .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
		$where .= $wpdb->prepare( "AND tt.taxonomy = %s", $args->taxonomy );

		if ( ! is_object_in_taxonomy( $post->post_type, $args->taxonomy ) ) {
			return [];
		}

		$term_array = wp_get_object_terms( $post->ID, $args->taxonomy, [ 'fields' => 'ids' ] );

		// Remove any exclusions from the term array to include.
		//$term_array = array_diff( $term_array, (array) $excluded_terms );

		if ( ! $term_array || is_wp_error( $term_array ) ) {
			return [];
		}

		$term_array = array_map( 'intval', $term_array );

		$where .= " AND tt.term_id IN (" . implode( ',', $term_array ) . ")";
	}

	$query = "
	(
		SELECT p.* FROM $wpdb->posts p $join
		WHERE
			p.post_date   > '" . esc_sql( $post->post_date ) . "' AND
			p.post_type   = '" . esc_sql( $post->post_type ) . "' AND
			p.post_status = 'publish' $where
		ORDER BY p.post_date ASC
		LIMIT " . intval( $args->limit ) . "
	)
	UNION
	( SELECT * FROM $wpdb->posts WHERE ID = $post->ID )
	UNION
	(
		SELECT p.* FROM $wpdb->posts p $join
		WHERE
			p.post_date   < '" . esc_sql( $post->post_date ) . "' AND
			p.post_type   = '" . esc_sql( $post->post_type ) . "' AND
			p.post_status = 'publish' $where
		ORDER BY p.post_date DESC
		LIMIT " . intval( $args->limit ) . "
	)
	ORDER by post_date " . ( $args->order === 'DESC' ? 'DESC' : 'ASC' ) . "
	";

	// пробуем получить кэш...
	if ( $args->cache_result ) {
		$query_key = 'post_adjacents_' . md5( $query );
		$result    = wp_cache_get( $query_key, 'counts' );
		if ( false === $result ) {
			$result = $wpdb->get_results( $query, OBJECT_K );
		}

		// кэшируем запрос...
		if ( ! $result ) {
			$result = [];
		}
		wp_cache_set( $query_key, $result, 'counts' );
	} else {
		$result = $wpdb->get_results( $query, OBJECT_K );
	}

	// соберем prev/next массивы
	if ( $result ) {

		$adjacents = [ 'prev' => [], 'next' => [] ];
		$indx      = 'prev';
		foreach ( $result as $pst ) {
			//unset($pst->post_content); // для дебага

			// текущий пост
			if ( $pst->ID == $post->ID ) {
				$indx = 'next';
				continue;
			}

			$adjacents[ $indx ][ $pst->ID ] = get_post( $pst ); // создадим объекты WP_Post
		}

	}

	return $adjacents;
}

/**
 * Возвращает домен из переданной ссылки.
 *
 * @param string $url
 *
 * @return string
 */
function get_domain_from_url( $url ) {
	return parse_url( $url )['host'];
}

/**
 * Возвращает домен из переданной ссылки. Не учитывается www.
 *
 * @param string $url
 *
 * @return string
 */
function get_domain_from_url_to_point( $url ) {
	return explode( '.', str_replace( 'www.', '', get_domain_from_url( $url ) ) )[0] ?? '';
}

/**
 * Возвращает записи по их ID.
 *
 * @param mixed $ids
 *
 * @return WP_Post[]
 */
function get_posts_by_ids( $ids ) {
	if ( empty( $ids ) ) {
		return [];
	}

	$ids = wp_parse_id_list( $ids );

	return $ids ? array_filter( array_map( 'get_post', $ids ) ) : [];
}

/**
 * Возвращает данные для построения кнопки пагинации на основе глобальных данных wp_query.
 *
 * @param string $titles
 *
 * @return array|false
 */
function get_archive_pagination_data( $titles ) {
	$next_url = get_next_paged_url();

	if ( ! $next_url ) {
		return false;
	}

	$per_page    = $GLOBALS['wp_query']->query_vars['posts_per_page'];
	$paged_now   = get_query_var( 'paged' ) ?: 1;
	$found_posts = $GLOBALS['wp_query']->found_posts;

	return get_pagination_data( $found_posts, $paged_now, $per_page, $titles, $next_url );
}

/**
 * Возвращает переданных с +1 по значению и "0" в начале по необходимости для списков.
 *
 * @param int $index
 *
 * @return string
 */
function get_index_increment_formating( $index ) {
	return (string) ( $index + 1 ) > 9 ? ( $index + 1 ) : '0' . ( $index + 1 );
}

/**
 * Добавляет параграфам в контенте указанные css классы.
 *
 * @param string $content
 * @param string $classes
 *
 * @return string
 */
function add_classes_to_tag_p( $content, $classes ) {
	return preg_replace( "/<p([> ])/", sprintf( '<p class="%s"$1', $classes ), $content );
}


/**
 * Избавляется от дубликатов записей.
 *
 * @param WP_Post[] $posts
 *
 * @return WP_Post[]
 */
function remove_duplicate_posts( $posts ) {
	$ids = array_map( static function ( WP_Post $post ) {
		return $post->ID;
	}, $posts );

	$unique_ids = array_unique( $ids, SORT_NUMERIC );

	return array_values( array_intersect_key( $posts, $unique_ids ) );
}

/**
 * Возвращает значение GET параметра в виде массива числовых данных.
 *
 * @param string $key
 *
 * @return int[]
 */
function get_param_ids_for_filter( $key ) {
	return array_filter( wp_parse_id_list( get_param_for_filter( $key ) ) );
}

/**
 * Возвращает значение GET параметра в виде массива строковых данных.
 *
 * @param string $key
 *
 * @return string[]
 */
function get_param_strings_for_filter( $key ) {
	return array_filter( wp_parse_slug_list( get_param_for_filter( $key ) ) );
}

/**
 * Возвращает значение GET параметра.
 *
 * @param string $key
 * @param string $default
 *
 * @return mixed
 */
function get_param_for_filter( $key, $default = '' ) {
	return $_GET[ $key ] ?? $default;
}
