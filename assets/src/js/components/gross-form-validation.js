import { validateForms } from '../functions/validate-forms';

const grossForm = document.querySelector('.form-gross');

if(grossForm) {

const grossRules = [
  {
    ruleSelector: '[data-input-type="name"]',
    rules: [
      {
        rule: 'minLength',
        value: 3
      },
      {
        rule: 'required',
        value: true,
        errorMessage: 'Заполните имя!'
      }
    ]
  },
  {
    ruleSelector: '[data-input-type="email"]',
    rules: [
      {
        rule: 'required',
        value: true,
        errorMessage: 'Заполните e-mail!'
      },
      {
        rule: 'email',
      },
    ]
  },
];

const afterForm = () => {
  console.log('Произошла отправка, тут можно писать любые действия');
};

validateForms('.form-gross', grossRules, afterForm);

}
