import Swiper, { Navigation, Pagination } from 'swiper';

const productImagesContainer = document.querySelector('.product__images');

if(productImagesContainer) {
  let productMainSlider = new Swiper('.product__main-slider', {
    slidesPerView: 1,
    spaceBetween: 0,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
    }
  });

  let productAdditionalSlider = new Swiper('.product__additional-slider', {
    slidesPerView: 2,
    direction: 'vertical',
    navigation: {
      nextEl: '.product__additional-slider-button.swiper-button-next',
    },
  })
}
