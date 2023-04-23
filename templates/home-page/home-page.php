<?php
/**
* Шаблон Главной страницы
*/

ct()->header();
?>

<main>
  <?php ct()->template( '/home-page/parts/home-page__hero.php' ); ?>
  <?php ct()->template( '/home-page/parts/home-page__category.php' ); ?>
  <?php ct()->template( '/home-page/parts/home-page__popular.php' ); ?>
  <?php ct()->template( '/home-page/parts/home-page__lookbook.php' ); ?>
  <?php ct()->template( '/home-page/parts/home-page__about.php' ); ?>
  <?php ct()->template( '/home-page/parts/home-page__gross-form.php' ); ?>
</main>
<?php

ct()->footer();
