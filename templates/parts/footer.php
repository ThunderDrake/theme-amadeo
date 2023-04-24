
<?php wp_footer() ?>
</body>
<footer class="footer">
  <div class="footer__container container">
    <div class="footer__col footer__col--first">
      <a class="footer__logo logo" href="/">
        <svg class="logo__svg" width="92" height="26">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#logo"></use>
        </svg>
      </a>
      <div class="footer__phone">
        <svg class="footer__phone-icon" width="19" height="19">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-icon"></use>
        </svg>
        <a class="footer__phone-link" href="tel:+7(495)640-58-84">+7(495)640-58-84</a>
      </div>
      <div class="footer__work-time">Мы работаем с 10:00-21:00</div>
    </div>

    <div class="footer__col footer__col--second">
      <ul class="footer__menu list-reset">
        <li class="footer__menu-item">
          <a class="footer__menu-link" href="#">покупателю</a>
        </li>
        <li class="footer__menu-item">
          <a class="footer__menu-link" href="#">доставка и оплата</a>
        </li>
        <li class="footer__menu-item">
          <a class="footer__menu-link" href="#">возврат</a>
        </li>
        <li class="footer__menu-item">
          <a class="footer__menu-link" href="#">программа лояльности</a>
        </li>
      </ul>
    </div>

    <div class="footer__col footer__col--third">
      <ul class="footer__menu list-reset">
        <li class="footer__menu-item">
          <a class="footer__menu-link" href="#">стать оптовым покупателем</a>
        </li>
        <li class="footer__menu-item">
          <a class="footer__menu-link" href="#">оптовому покупателю</a>
        </li>
      </ul>
    </div>

    <div class="footer__up">
      <button class="footer__up-button btn-reset" data-up-button>
        <svg class="footer__up-icon" width="63" height="48">
          <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#up-icon"></use>
        </svg>
      </button>
    </div>
  </div>
</footer>
</html>
