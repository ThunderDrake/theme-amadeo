<?php
global $post;

$products = get_posts( [
  'post_type' => 'product',
  'numberposts' => 4
] )
?>
<section class="home-popular">
  <div class="home-popular__container container">
    <div class="home-popular__header block-header">
      <h2 class="block-header__title">Популярные товары</h2>
      <a class="link block-header__link" href="#">посмотреть все</a>
    </div>
    <ul class="home-popular__list list-reset">
      <?php foreach($products as $post): ?>
        <?php setup_postdata( $post ); ?>
        <li class="home-popular__list-item">
          <?php ct()->template('/parts/product-card.php') ?>
        </li>
      <?php endforeach; ?>
      <?php wp_reset_postdata(); ?>
    </ul>
  </div>
</section>
