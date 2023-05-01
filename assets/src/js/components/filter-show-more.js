const filterGroups = document.querySelectorAll('[data-filter-group]');

if(filterGroups.length > 0) {
  filterGroups.forEach(function(el) {
    const filterList = el.querySelector('[data-filter-list]');

    if(filterList.children.length > 4) {

      const elems = filterList.children;
      for(let i = 0; i < elems.length; i++) {
        if(i > 3) {
          elems[i].classList.add('hidden');
        }
      }

      filterList.insertAdjacentHTML('afterend', `
        <button class="btn-reset filter-group__show-more" data-filter-group-show-more>Посмотреть все</button>
      `);

      const showMore = el.querySelector('[data-filter-group-show-more]');

      showMore.addEventListener('click', function(e) {
        e.preventDefault;

        for(let i = 0; i < filterList.children.length; i++) {
          elems[i].classList.remove('hidden');
        }

        e.target.remove();
      })
    }
  })
}
