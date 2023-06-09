<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

ct()->header([ 'class' => 'header--inner']);

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
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
