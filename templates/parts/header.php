<?php
/**
 * Шаблон шапки сайта
 */

$header_class = is_front_page() ? '' : 'header--inner'
?>
<!DOCTYPE html>
<html lang="ru" class="page">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/Gilroy-Regular.woff2" as="font" crossorigin="anonymous">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/Gilroy-Medium.woff2" as="font" crossorigin="anonymous">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/Gilroy-Semibold.woff2" as="font"
    crossorigin="anonymous">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/Gilroy-Bold.woff2" as="font" crossorigin="anonymous">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/Gilroy-Extrabold.woff2" as="font"
    crossorigin="anonymous">
  <link rel="preload" href="<?= ct()->get_static_url() ?>/fonts/Gilroy-Black.woff2" as="font" crossorigin="anonymous">
  <?php wp_head() ?>
</head>

<body class="page__body">
  <div class="mobile-menu" data-menu>
    <div class="mobile-menu__container container">
      <div class="mobile-menu__nav">
        <nav class="main-nav__menu accordion main-nav__accordion" data-accordion="parent"
          data-destroy="(max-width: 1023px)">
          <ul class="main-nav__list">
            <li class="main-nav__item accordion__element" data-has-submenu data-accordion="element">
              <div class="accordion__button" data-accordion="button" tabindex="0">
                <a class="mobile-menu__link"
                  href="/schools/">школьная форма</a>
              </div>
              <div class="accordion__content" data-accordion="content">
                <div class="submenu" data-submenu>
                  <div class="container">
                    <div class="submenu__wrap">
                      <a class="mobile-menu__link mobile-menu__link--second" href="#">для девочек</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="main-nav__item accordion__element" data-has-submenu data-accordion="element">
              <div class="accordion__button" data-accordion="button" tabindex="0">
                <a class="mobile-menu__link"
                  href="/schools/">верхняя одежда</a>
              </div>
              <div class="accordion__content" data-accordion="content">
                <div class="submenu" data-submenu>
                  <div class="container">
                    <div class="submenu__wrap">
                      <a class="mobile-menu__link mobile-menu__link--second" href="#">для девочек</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="main-nav__item accordion__element" data-has-submenu data-accordion="element">
              <div class="accordion__button" data-accordion="button" tabindex="0">
                <a class="mobile-menu__link"
                  href="/schools/">оптовым клиентам</a>
              </div>
              <div class="accordion__content" data-accordion="content">
                <div class="submenu" data-submenu>
                  <div class="container">
                    <div class="submenu__wrap">
                      <a class="mobile-menu__link mobile-menu__link--second" href="#">для девочек</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="main-nav__item accordion__element main-nav__item--no-submenu" data-no-submenu>
              <a class="mobile-menu__link"
                href="#">доставка и оплата</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="mobile-menu__footer">
        <ul class="mobile-menu__footer-nav list-reset">
          <li class="mobile-menu__footer-item"><a class="mobile-menu__link" href="#">популярные товары</a></li>
          <li class="mobile-menu__footer-item"><a class="mobile-menu__link" href="#">лукбук</a></li>
          <li class="mobile-menu__footer-item"><a class="mobile-menu__link" href="#">о нас</a></li>
        </ul>
      </div>
    </div>
  </div>
  <header class="header <?= $header_class ?>">
    <div class="header__container container">
      <a class="header__logo logo" href="#">
        <svg class="logo__svg" width="92" height="26">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#logo"></use>
        </svg>
        <!-- <img loading="lazy" src="<?= ct()->get_static_url() ?>/img/logo.svg" class="logo__image" width="92" height="26" alt="Amadeo logo"> -->
      </a>
      <button class="header__burger burger btn-reset" aria-label="Открыть меню" aria-expanded="false" data-burger>
        <svg class="burger__icon" width="24" height="24">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#burger"></use>
        </svg>
        <svg class="burger__icon burger__icon--close" width="24" height="24">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#burger-close"></use>
        </svg>
      </button>
      <nav class="header__nav nav">
        <ul class="nav__list list-reset">
          <li class="nav__item"><a href="#" class="nav__link">школьная форма</a></li>
          <li class="nav__item"><a href="#" class="nav__link">верхняя одежда</a></li>
          <li class="nav__item"><a href="#" class="nav__link">оптовым клиентам</a></li>
          <li class="nav__item"><a href="#" class="nav__link">доставка и оплата</a></li>
        </ul>
      </nav>
      <div class="header__search search-form__wrapper">
        <button class="btn-reset search-form__back">
          <svg class="search-form__back-icon" width="24" height="24">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#search-form__back"></use>
          </svg>
        </button>
        <form action="#" class="search-form">
          <label class="search-form__label">
            <input type="text" name="s" class="input-reset search-form__input" placeholder="Поиск">
          </label>
          <button class="btn-reset search-form__btn">
            <svg class="search-form__btn-icon" width="24" height="24">
              <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#search"></use>
            </svg>
          </button>
        </form>
      </div>
      <div class="header__icons">
        <button class="header__search-button header__icons-item btn-reset" href="#">
          <svg class="header__icon" width="24" height="24">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#search"></use>
          </svg>
        </button>
        <a class="header__user header__icons-item" href="#">
          <svg class="header__icon" width="24" height="24">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#user"></use>
          </svg>
        </a>
        <a class="header__favorite header__icons-item" href="#">
          <svg class="header__icon" width="24" height="24">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#favorite"></use>
          </svg>
        </a>
        <a class="header__cart header__icons-item" href="#">
          <svg class="header__icon" width="24" height="24">
            <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#cart"></use>
          </svg>
        </a>
      </div>
    </div>
  </header>
