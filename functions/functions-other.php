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


## Код кэширует минимальную и максимальную цену для
## каждой рубрики и по всем продуктам в целом.
## ver 1

// ставим обновление опции в очередь через минуту после обновления записи...
add_action( 'save_post_product', [ 'Minmax_Prices', 'save_post_update' ] );
add_action( 'deleted_post', [ 'Minmax_Prices', 'save_post_update' ] );

Minmax_Prices::check_for_update();

final class Minmax_Prices {

	// мета ключ в котором находится цена товара
	private static $price_meta_key = '_regular_price';
	// таксономия
	private static $tax_name = 'product_cat';
	// время в сек. после которого скрипт сработает при обновлении записи (продукта)
	private static $up_timeout = 60;

	private static $minmax_option = 'product_cat_minmax_prices';

	public static function get_data() {
		return get_option( self::$minmax_option, [] );
	}

	public static function check_for_update() {
		$minmax_prices = self::get_data();
		$uptime = &$minmax_prices['uptime'];
		if( empty( $uptime ) || time() > $uptime ){
			self::update_data();
		}
	}

	public static function save_post_update() {
		$minmax_prices = self::get_data();
		$minmax_prices['uptime'] = time() + self::$up_timeout;

		update_option( self::$minmax_option, $minmax_prices );
	}

	/**
	 * Обновляет все данные minmax разом.
	 *
	 * @return void
	 */
	public static function update_data() {
		global $wpdb;

		// все рубрики со всеми включенными или нет записями в них
		$cat_data_sql = "SELECT term_id, object_id, parent FROM $wpdb->term_taxonomy tax LEFT JOIN $wpdb->term_relationships rel
		ON (rel.term_taxonomy_id = tax.term_taxonomy_id) WHERE taxonomy = '" . esc_sql( self::$tax_name ) . "'";

		$cat_data = $wpdb->get_results( $cat_data_sql );
		$origin_cat_data = $cat_data; // сохраним на всякий...

		// создадим новый массив, где ключом будет ID рубрики, а значение объект с данными parent
		// и всеми ID рубрик в массиве object_id (в рубрике записей может быть несколько...)
		$_cat_data = [];
		foreach( $cat_data as $data ){
			$_term = &$_cat_data[ $data->term_id ];
			if( ! $_term ){
				$_term = (object) [
					'parent'    => $data->parent,
					'object_id' => [],
				];
			}

			if( $data->object_id ){
				$_term->object_id[] = $data->object_id;
			}
		}
		unset( $_term );
		$cat_data = $_cat_data;

		// соберем дочерние рубрики в родительские в элемент 'child'. child будет PHP ссылкой на текущий элемент рубрики, чтобы добится
		// рекурсиии и многоуровневой вложенности. Так каждая рубрика будет содержать все данные о записях своей и всех уровней вложенных подрубрик...
		foreach( $cat_data as $term_id => $data ){
			// есть родитель добавляем ссылку на этот элемент к родителю в элемент 'child'
			if( $data->parent ){
				$_child = &$cat_data[ $data->parent ]->child; // для удобности...
				if( empty( $_child ) ){
					$_child = [];
				}
				$_child[] = &$cat_data[ $term_id ]; // ссылка
			}
		}
		unset( $_child );
		// die( print_r(  $cat_data  ) ); // посмотреть что за монстр-массив у нас получился, без него код понять нереально :)

		// соберем все ID записей в один массив сэлементом вида: term_id => все ID записей из рубрики и всех уровней вложенных рубрик...
		$_cat_data = [];
		foreach( $cat_data as $term_id => $data ){
			$prod_ids = [];

			self::_recursion_collect_ids( $prod_ids, $data );

			$_cat_data[ $term_id ] = array_unique( $prod_ids );
		}
		$cat_data = $_cat_data;

		// ВСЕ! массив готов, обираем все MIN MAX данные
		$minmax_prices = [];
		$minmax_prices['uptime'] = time() + ( DAY_IN_SECONDS / 2 ); // каждые пол дня

		// all - для всех товаров
		$mnimax_sql_base = "SELECT MIN( CAST(meta_value as UNSIGNED) ) as min, MAX(CAST(meta_value as UNSIGNED)) as max
		FROM $wpdb->postmeta WHERE meta_key = '" . esc_sql( self::$price_meta_key ) . "' AND meta_value > 0";
		$minmax = $wpdb->get_row( $mnimax_sql_base, ARRAY_A );
		$minmax_prices['all'] = implode( ',', $minmax );

		// в разрезе рубрик
		foreach( $cat_data as $term_id => $prod_ids ){
			if( empty( $prod_ids ) ){
				continue;
			}

			$_IN_sql_list = implode( ',', array_map( 'intval', $prod_ids ) );

			$mnimax_sql = "$mnimax_sql_base AND post_id IN( $_IN_sql_list )";
			$minmax = $wpdb->get_row( $mnimax_sql, ARRAY_A );

			// если есть хоть одно значение
			if( array_filter( $minmax ) ){
				if( ! $minmax['min'] ){
					$minmax['min'] = $minmax['max'];
				} // нулей быть не должно
				if( ! $minmax['max'] ){
					$minmax['max'] = $minmax['min'];
				} // нулей быть не должно

				$minmax_prices[ $term_id ] = implode( ',', $minmax );
			}
		}

		// обновляем
		update_option( self::$minmax_option, $minmax_prices );
	}

	/**
	 * Рекурсивно собарает object_id в указанный $collector.
	 */
	private static function _recursion_collect_ids( &$collector, $data ) {
		// добавим родные данные
		if( $data->object_id ){
			if( is_array( $data->object_id ) ){
				$collector = array_merge( $collector, $data->object_id );
			}
			else{
				$collector[] = $data->object_id;
			}
		}

		// првоерим детей и там рекурсией...
		if( isset( $data->child ) ){
			foreach( $data->child as $_data ){
				self::_recursion_collect_ids( $collector, $_data ); // recursion
				//call_user_func_array( [__CLASS__, __METHOD__], [ $collector, $_data ] );
			}
		}
	}

}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
