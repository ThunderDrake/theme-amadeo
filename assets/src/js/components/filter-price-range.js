import noUiSlider from 'nouislider';
const priceSlider = document.querySelector('[data-price-slider]');

if(priceSlider) {
  noUiSlider.create(priceSlider, {
    start: [500, 999999],
    connect: true,
    step: 1,
    range: {
      'min': 500,
      'max': 999999
    }
  });

  const inputMin = document.querySelector('[data-price-input-min]');
  const inputMax = document.querySelector('[data-price-input-max]');
  const inputs = [inputMin, inputMax]

  priceSlider.noUiSlider.on('update', function(values, handle) {
    inputs[handle].value = Math.round(values[handle]);
  });

  const setRangeSlider = (i, value) => {
    let arr = [null, null];
    arr[i] = value

    priceSlider.noUiSlider.set(arr)
  }

  inputs.forEach((el, index) =>{
    el.addEventListener('change', (e) => {
      setRangeSlider(index, e.currentTarget.value)
    })
  })
}
