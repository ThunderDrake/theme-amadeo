import Choices from "choices.js";

const sortSelect = document.querySelector('.catalog__orderby');

if(sortSelect) {
  const choiceSelect = new Choices(sortSelect, {
    searchEnabled: false,
  });
}
