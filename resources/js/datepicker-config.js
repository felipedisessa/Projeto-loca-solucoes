import  {Datepicker}  from 'flowbite-datepicker';

const datepickerEl =  document.querySelector('#start');

new Datepicker(datepickerEl, {
    defaultDatepickerId: null,
    autohide: true,
    format: 'dd/mm/yyyy',
    orientation: 'bottom',
    autoSelectToday: false,
    language: 'pt-BR',
    rangePicker: false,
})