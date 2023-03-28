function initSearchform() {
  const searchButton = document.querySelector('.header__search-button');
  const searchFormBlock = document.querySelector('.search-form__wrapper');
  const closeSearchform = document.querySelector('.search-form__back');
  const breakpoint = window.matchMedia('(max-width: 576px)');

  if (!searchButton) {
    return
  }

  if(breakpoint.matches) {
    searchButton.addEventListener('click', (e)=>{
      searchFormBlock.classList.add('search-form--active');
    });

    closeSearchform.addEventListener('click', ()=>{
      searchFormBlock.classList.remove('search-form--active');
    })
  }
}

initSearchform();
