const $datepickerEl = document.querySelector('.datepicker-custom');
console.log('    $datepickerEl', $datepickerEl);

// optional options with default values and callback functions
const options = {
    defaultDatepickerId: null,
    autohide: false,
    format: 'dd/mm/yyyy',
    maxDate: null,
    minDate: null,
    orientation: 'bottom',
    buttons: false,
    autoSelectToday: false,
    title: null,
    language: 'pt-br',
    rangePicker: false,
    onShow: () => {
    },
    onHide: () => {
    },
};

const instanceOptions = {
    id: 'end',
    override: true
};


/*
 * $datepickerEl: required
 * options: optional
 */
const datepicker = new Datepicker($datepickerEl, options, instanceOptions);
