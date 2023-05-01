<?php
/**
 * Шаблон списка товаров
 */

global $post;
globaL $wp_query;
$q_obj = get_queried_object();

$terms = $q_obj->name ? ['tax_query' => array(
  array(
    'taxonomy' => 'product_cat',
    'field'    => 'slug',
    'terms'    => $q_obj->name
  )
)] : [];

$args = array_merge([
  'post_type' => 'product',
  'numberposts' => -1,
  'posts_per_page' => 6,
  'paged'          => get_query_var( 'paged' ),
], $terms);

$products = new WP_Query($args);
$total_pages = $products->max_num_pages;

error_log( print_r( get_query_var( 'paged' ), true ) );
?>
<?php error_log( print_r( $total_pages, true ) ); ?>
<div class="catalog__content-wrapper">
  <div class="catalog__list">
    <?php if ( $products->have_posts() ) {
      while ( $products->have_posts() ) : $products->the_post();
        ct()->template( '/parts/product-card.php' );
      endwhile;
      $current_page = max(1, get_query_var('paged'));
      echo paginate_links(
        apply_filters(
          'woocommerce_pagination_args',
          array( // WPCS: XSS ok.
            'base'      => get_pagenum_link(1) . '%_%',
            'format'    => 'page/%#%',
            'add_args'  => false,
            'current'   => max( 1, $current_page ),
            'total'     => $total_pages,
            'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
            'next_text' => is_rtl() ? '&larr;' : '&rarr;',
            'type'      => 'list',
            'end_size'  => 3,
            'mid_size'  => 3,
          )
        )
      );
      } else { ?>
      <p>Извините, материалов по вашему запросу нет.</p>
    <?php } ?>
    <?php wp_reset_postdata() ?>
  </div>

</div>
