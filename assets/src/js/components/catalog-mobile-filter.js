import { disableScroll } from '../functions/disable-scroll';
import { enableScroll } from '../functions/enable-scroll';

(function(){
  const filterButton = document?.querySelector('[data-filter-open]');
  const filterBlock = document?.querySelector('[data-filter]');
  const closeButton = document?.querySelector('[data-filter-close]');
  const acceptButton = document?.querySelector('[data-filter-accept]');
  const header = document?.querySelector('.header');

  filterButton?.addEventListener('click', (e) => {
    e.preventDefault();
    filterButton?.classList.toggle('catalog__filter-button--active');
    filterBlock?.classList.toggle('filters--active');
    // header?.classList.toggle('header--menu-active');

    if (filterBlock?.classList.contains('filters--active')) {
      filterButton?.setAttribute('aria-expanded', 'true');
      filterButton?.setAttribute('aria-label', 'Закрыть меню');
      disableScroll();
    } else {
      filterButton?.setAttribute('aria-expanded', 'false');
      filterButton?.setAttribute('aria-label', 'Открыть меню');
      enableScroll();
    }
  });

  closeButton?.addEventListener('click', (e) => {
    e.preventDefault();
    filterButton?.setAttribute('aria-expanded', 'false');
    filterButton?.setAttribute('aria-label', 'Открыть меню');
    filterButton.classList.remove('catalog__filter-button--active');
    filterBlock.classList.remove('filters--active');
    enableScroll();
  });

  acceptButton?.addEventListener('click', (e) => {
    e.preventDefault();
    filterButton?.setAttribute('aria-expanded', 'false');
    filterButton?.setAttribute('aria-label', 'Открыть меню');
    filterButton.classList.remove('catalog__filter-button--active');
    filterBlock.classList.remove('filters--active');
    enableScroll();
  });
})();
