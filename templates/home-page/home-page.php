<?php
/**
* Шаблон Главной страницы
*/

ct()->header();
?>

<main>
  <?php ct()->template( '/home-page/parts/home-page__hero.php' ); ?>
  <?php ct()->template( '/home-page/parts/home-page__category.php' ); ?>
</main>
<?php

ct()->footer();
