import { validateForms } from '../functions/validate-forms';
const rules1 = [
  {
    ruleSelector: '.form__input--name',
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
    ruleSelector: '.form__input--phone',
    tel: true,
    telError: 'Введите корректный телефон',
    rules: [
      {
        rule: 'required',
        value: true,
        errorMessage: 'Заполните телефон!'
      }
    ]
  },
  {
    ruleSelector: '.form__input--type',
    rules: [
      {
        rule: 'minLength',
        value: 3
      },
      {
        rule: 'required',
        value: true,
        errorMessage: 'Выберите какое мероприятие!'
      }
    ]
  },
  {
    ruleSelector: '.form__input--count',
    rules: [
      {
        rule: 'number',
      },
      {
        rule: 'required',
        value: true,
        errorMessage: 'Выберите количество гостей!'
      }
    ]
  },
  {
    ruleSelector: '.form--privacy',
    rules: [
      {
        rule: 'required',
        value: true,
        errorMessage: 'Примите соглашение на обработку!'
      }
    ]
  },
];

const afterForm = () => {
  console.log('Произошла отправка, тут можно писать любые действия');
};

validateForms('.form', rules1, afterForm);
