<?php
/**
 * Шаблон внутренней шапки
 */
$q_obj = get_queried_object();

$page_title = '';

if($q_obj) {
  if(is_singular()) {
    $page_title = $q_obj->post_title;
  } elseif (is_tax()) {
    $page_title = $q_obj->name;
  };
}


?>

<div class="inner-header">
  <div class="container inner-header__container">

    <div class="breadcrumbs">
      <ul class="breadcrumbs__list list-reset">
        <li class="breadcrumbs__item">
          <a class="breadcrumbs__link" href="/">Главная</a>
        </li>
        <li class="breadcrumbs__item">
          <span class="breadcrumbs__link"><?= $page_title ?></span>
        </li>
      </ul>
    </div>

    <h1 class="inner-header__title"><?= $page_title ?></h1>
  </div>
</div>
