<?php
/**
 * Шаблон страницы 404
 */

ct()->header();
?>
<main class="no-page">
  <div class="no-page__content">
    <div class="no-page__title">Похоже, мы  не можем найти страницу</div>
    <div class="no-page__image-wrapper">
      <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/404.svg" class="no-page__image" width="440" height="313" alt="Страница не найдена">
    </div>
  </div>
</main>
<?php
ct()->footer();
