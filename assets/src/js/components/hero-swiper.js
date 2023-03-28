import Swiper from 'swiper/bundle';
const sliderSectionContainer = document?.querySelector('.hero-slider');
if (sliderSectionContainer) {
  const swiper = new Swiper('.hero-slider',{
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
      }
    },
    pagination:{
      el: '.hero-slider__pagination',
      type: 'bullets',
    },
  });

  const sliderText = document.querySelectorAll('.hero-slide__text');

  sliderText.forEach((el) => {
    let nodes = null;

    nodes = el.innerText.split("").map(function(text, index){
      const node = document.createElement('span')

      node.textContent = text

      return node
    });

    if (nodes) {
      el.firstChild.replaceWith(...nodes)
    }
  })
}
