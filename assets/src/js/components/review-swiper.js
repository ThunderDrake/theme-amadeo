import Swiper from 'swiper/bundle';
const sliderSectionContainer = document?.querySelector('.review__container');
if (sliderSectionContainer) {
  let slidesOffset;

if(window.matchMedia('(max-width: 768px)').matches) {
  slidesOffset = 80;
} else {
  slidesOffset = 30;
}

const swiper = new Swiper('.review__slider',{
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  },

  breakpoints: {
    320: {
      slidesPerView: 1,
      autoHeight: true
    },
    567: {
      slidesPerView: 'auto',
      spaceBetween: 16,
      slidesOffsetBefore: (document.documentElement.clientWidth + slidesOffset - sliderSectionContainer.offsetWidth) / 2,
      slidesOffsetAfter: (document.documentElement.clientWidth + slidesOffset - sliderSectionContainer.offsetWidth) / 2,
    }
  },
  pagination:{
    el: '.swiper-pagination',
    type: 'fraction',
    formatFractionTotal: function (number) {
      return number;
  }
  },



});

}
