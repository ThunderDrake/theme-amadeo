<?php 
/**
 * Шаблон страницы 404
 */

ct()->header();
?>
<main class="main--single-block">
  <section class="single-block">
    <div class="container">
      <h1 class="single-block__title title title--h1"><?php _e('Упс!<br/>Тут ничего нет', 'university') ?> :(</h1><a class="single-block__link btn" href="/"><span><?php _e('на главную', 'university') ?></span></a>
    </div>
  </section>
</main>
<?php
ct()->footer();