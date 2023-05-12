<?php
/**
 * Шаблон списка товаров
 */

globaL $wp_query;

$total_pages = $wp_query->max_num_pages;

?>
<div class="catalog__content-wrapper">
  <div class="catalog__header">
    <button class="catalog__filter-button btn-reset" data-filter-open>
      <svg class="catalog__filter-button-icon" width="24" height="24">
        <use xlink:href="<?= ct()->get_static_url(); ?>/img/sprite.svg#filter-button"></use>
      </svg>
      Все фильтры
    </button>
    <?php
      /**
       * Hook: woocommerce_before_shop_loop.
       *
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */
      do_action( 'woocommerce_before_shop_loop' );
    ?>
  </div>
  <?php
      if ( woocommerce_product_loop() ) {
        ?>
        <div class="catalog__list">
        <?php
        woocommerce_product_loop_start();

        if ( wc_get_loop_prop( 'total' ) ) {
          while ( have_posts() ) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action( 'woocommerce_shop_loop' );

            ct()->template( '/parts/product-card.php' );
          }
        }

        woocommerce_product_loop_end();
      } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action( 'woocommerce_no_products_found' );
      }
      ?>
      </div>

  <?php
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
        'prev_text' => '&larr; Назад ',
        'next_text' => 'Далее &rarr;',
        'type'      => 'list',
        'end_size'  => 3,
        'mid_size'  => 3,
      )
    )
  );
  ?>

</div>
