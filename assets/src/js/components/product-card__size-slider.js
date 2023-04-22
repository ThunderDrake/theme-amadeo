import Swiper, { Navigation } from 'swiper';

const productCard = document.querySelectorAll('.product-card');

if(productCard.length > 0) {
  productCard.forEach(el => {
    const id = el.dataset.productId;
    const sizeSlider = el.querySelector(`.product-card__size-buttons[data-id="${id}"]`);

    if(sizeSlider) {
      let buttonSlider = new Swiper(sizeSlider, {
        slidesPerView: 'auto',
        spaceBetween: 18,
        slidesOffsetBefore: 30,
        slidesOffsetAfter: 30,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })
    }
  })
}
