<?php
global $product;
?>
<div class="product-card" data-product-id="<?= get_the_ID() ?>">
  <div class="product-card__image">
    <?= woocommerce_get_product_thumbnail() ?>
    <div class="product-card__label">sale</div>
    <button class="product-card__favorite btn-reset">
      <svg class="product-card__favorite-icon" width="17" height="15">
        <use xlink:href="<?= ct()->get_static_url(); ?>/img/sprite.svg#product-favorite"></use>
      </svg>
    </button>
  </div>
  <div class="product-card__content">
    <?php if($product->get_price()): ?>
      <?php if($product->get_sale_price()): ?>
      <div class="product-card__price">
        <div class="product-card__price-current"><?= $product->get_sale_price() ?> ₽</div>
        <div class="product-card__price-old"><?= $product->get_regular_price() ?> ₽</div>
      </div>
      <?php else: ?>
      <div class="product-card__price">
        <div class="product-card__price-current"><?= $product->get_regular_price() ?> ₽</div>
      </div>
      <?php endif; ?>
    <?php endif; ?>
    <a class="product-card__title" href="<?= get_permalink(get_the_ID()) ?>">
      <?= cth() -> trim_words(['maxchar' => 40, 'text' => get_the_title()]) ?>
    </a>
    <div class="product-card__color-list">
      <label class="product-card__color custom-radio custom-radio--colors" style="--color: #E4202C">
        <input class="custom-radio__input visually-hidden" type="radio" name="pa:color-<?= get_the_ID() ?>">
        <span class="custom-radio__elem"></span>
      </label>
      <label class="product-card__color custom-radio custom-radio--colors" style="--color: #FFD12D">
        <input class="custom-radio__input visually-hidden" type="radio" name="pa:color-<?= get_the_ID() ?>">
        <span class="custom-radio__elem"></span>
      </label>
      <label class="product-card__color custom-radio custom-radio--colors" style="--color: #2B3F34">
        <input class="custom-radio__input visually-hidden" type="radio" name="pa:color-<?= get_the_ID() ?>">
        <span class="custom-radio__elem"></span>
      </label>
    </div>
  </div>
  <div class="product-card__hidden-part">
    <div class="product-card__size-label">
      размер: <span class="product-card__size-value">86-170</span>
    </div>
    <div class="product-card__size-wrapper">
      <div class="swiper product-card__size-buttons" data-id="<?= get_the_ID() ?>">
        <div class="swiper-wrapper">
           <div class="swiper-slide">
            <label class="product-card__size custom-radio custom-radio--size">
              <input class="custom-radio__input visually-hidden" type="radio" name="pa:size-<?= get_the_ID() ?>">
              <span class="custom-radio__elem">86-92</span>
            </label>
           </div>
           <div class="swiper-slide">
            <label class="product-card__size custom-radio custom-radio--size">
              <input class="custom-radio__input visually-hidden" type="radio" name="pa:size-<?= get_the_ID() ?>">
              <span class="custom-radio__elem">86-92</span>
            </label>
           </div>
           <div class="swiper-slide">
            <label class="product-card__size custom-radio custom-radio--size">
              <input class="custom-radio__input visually-hidden" type="radio" name="pa:size-<?= get_the_ID() ?>">
              <span class="custom-radio__elem">86-92</span>
            </label>
           </div>
           <div class="swiper-slide">
            <label class="product-card__size custom-radio custom-radio--size">
              <input class="custom-radio__input visually-hidden" type="radio" name="pa:size-<?= get_the_ID() ?>">
              <span class="custom-radio__elem">86-92</span>
            </label>
           </div>
           <div class="swiper-slide">
            <label class="product-card__size custom-radio custom-radio--size">
              <input class="custom-radio__input visually-hidden" type="radio" name="pa:size-<?= get_the_ID() ?>">
              <span class="custom-radio__elem">86-92</span>
            </label>
           </div>
           <div class="swiper-slide">
            <label class="product-card__size custom-radio custom-radio--size">
              <input class="custom-radio__input visually-hidden" type="radio" name="pa:size-<?= get_the_ID() ?>">
              <span class="custom-radio__elem">86-92</span>
            </label>
           </div>
        </div>
        <div class="swiper-button-prev" data-id="<?= get_the_ID() ?>"></div>
        <div class="swiper-button-next" data-id="<?= get_the_ID() ?>"></div>
      </div>
    </div>
    <a class="product-card__button" href="#">в корзину</a>
  </div>
</div>
