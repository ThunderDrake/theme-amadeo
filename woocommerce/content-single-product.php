<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $wp_query;


$terms = get_the_terms( get_the_ID(), 'product_cat' );
error_log( print_r( $terms, true ) );
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<main class="product-page">

  <div class="container product-page__container">
    <div id="product-<?php the_ID(); ?>" class="product-page__wrapper">

      <div class="breadcrumbs">
        <ul class="breadcrumbs__list list-reset">
          <li class="breadcrumbs__item">
            <a class="breadcrumbs__link" href="/">Главная</a>
          </li>
          <li class="breadcrumbs__item">
            <span class="breadcrumbs__link"><?= $terms[0]->name ?></span>
          </li>
        </ul>
      </div>

      <div class="product-page__product-info product">

      <?php if($attach_ids = $product->get_gallery_image_ids()): ?>

        <div class="product__images">
          <div class="swiper product__main-slider">
            <div class="swiper-wrapper">
              <?php foreach($attach_ids as $id): ?>
              <div class="swiper-slide product__main-image">
                <img src="<?= wp_get_attachment_image_url($id, 'full') ?>" alt="">
              </div>
              <?php endforeach; ?>
            </div>

            <div class="product__main-slider-pagination swiper-pagination"></div>
          </div>

          <div class="swiper product__additional-slider">
            <div class="swiper-wrapper">
              <?php foreach($attach_ids as $id): ?>
              <div class="swiper-slide product__additional-image">
                <img src="<?= wp_get_attachment_image_url($id, 'full') ?>" alt="">
              </div>
              <?php endforeach; ?>
            </div>
            <div class="product__additional-slider-button swiper-button-next"></div>
          </div>
        </div>
      <?php else: ?>
        <div class="product__images">
          <?= woocommerce_get_product_thumbnail('full') ?>
        </div>
      <?php endif; ?>
        <div class="product__data">
          <span class="product__sku">
            арт: <?= $product->get_sku() ?>
          </span>
          <h1 class="product__title"><?= get_the_title() ?></h1>
          <div class="product__labels">
            <!-- <div class="product__label">Sale</div> -->
          </div>
          <div class="product__autorize"><a class="product__autorize-link product__link" href="#">авторизуйтесь</a>,
            чтобы узнать скидку</div>
          <?php if($product->get_price()): ?>
          <?php if($product->get_sale_price()): ?>
          <div class="product__price">
            <div class="product__price-current"><?= $product->get_sale_price() ?> ₽</div>
            <div class="product__price-old"><?= $product->get_regular_price() ?> ₽</div>
          </div>
          <?php else: ?>
          <div class="product__price">
            <div class="product__price-current"><?= $product->get_price() ?> ₽</div>
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <div class="product-card__color-list">
            <span class="product-card__color-list-label">Цвет: </span>
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

          <div class="product__size">размер: <span>136</span></div>

          <div class="product__size-wrapper">
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
            </div>
            <div class="swiper-button-prev" data-id="<?= get_the_ID() ?>"></div>
            <div class="swiper-button-next" data-id="<?= get_the_ID() ?>"></div>
          </div>

          <a class="product__size-info product__link" href="#">справочник по размерам</a>

          <div class="product__info-accordion">

            <div class="accordion">
              <button class="accordion__control btn-reset" aria-expanded="false">
                <span class="accordion__title">Описание</span>
                <span class="accordion__icon">
                  <svg class="accordion__icon-icon" width="10" height="15">
                    <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#accordion-icon"></use>
                  </svg>
                </span>
              </button>
              <div class="accordion__content" aria-hidden="true">
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quos cumque quae harum rerum
                  minima quia distinctio, porro voluptatibus illum excepturi nam eligendi optio ab id nihil fuga. Earum,
                  necessitatibus!
                </p>
              </div>
            </div>

            <div class="accordion">
              <button class="accordion__control btn-reset" aria-expanded="false">
                <span class="accordion__title">Характеристики</span>
                <span class="accordion__icon">
                  <svg class="accordion__icon-icon" width="10" height="15">
                    <use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#accordion-icon"></use>
                  </svg>
                </span>
              </button>
              <div class="accordion__content" aria-hidden="true">
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quos cumque quae harum rerum
                  minima quia distinctio, porro voluptatibus illum excepturi nam eligendi optio ab id nihil fuga. Earum,
                  necessitatibus!
                </p>
              </div>
            </div>

          </div>
          <button class="product__cart-button btn-reset">В корзину</button>
        </div>

      </div>

    </div>
  </div>
</main>


<?php do_action( 'woocommerce_after_single_product' ); ?>
