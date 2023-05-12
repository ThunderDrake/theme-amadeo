import Swiper, { Navigation } from 'swiper';

const singleProductSizes = document.querySelector('.product-card__size-buttons');

if(singleProductSizes) {
  let buttonSlider = new Swiper(singleProductSizes, {
    slidesPerView: 4,
    spaceBetween: 20,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  })
}
