<?php
/**
* Шаблон Каталога товаров
*/
ct()->header([ 'class' => 'header--inner']);
do_action( 'woocommerce_before_main_content' );
?>

<main class="catalog">
  <?php ct()->template( '/catalog-page/parts/inner-header.php' ); ?>

  <div class="container">
    <div class="catalog__content">
      <?php ct()->template( '/catalog-page/parts/filters.php' ); ?>
      <?php ct()->template( '/catalog-page/parts/catalog-list.php' ); ?>
    </div>
  </div>
</main>
<?php
do_action( 'woocommerce_after_main_content' );
ct()->footer();
