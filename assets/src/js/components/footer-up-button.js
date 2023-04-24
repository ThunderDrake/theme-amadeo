document.addEventListener('DOMContentLoaded', ()=>{
  const scrollToTopButton = document.querySelector('[data-up-button]');

  if(scrollToTopButton) {
    const onClickBtnToTop = (e) => {
      e.preventDefault();

      window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });
    };

    scrollToTopButton.addEventListener('click', onClickBtnToTop);
  }
})
