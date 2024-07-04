import {Datepicker} from 'flowbite-datepicker';

Datepicker.locales['pt'] = {
    days: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
    daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
    daysMin: ['Do', 'Se', 'Te', 'Qa', 'Qi', 'Se', 'Sa'],
    months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    today: 'Hoje',
    clear: 'Limpar',
    format: 'dd/mm/yyyy',
    titleFormat: 'MM yyyy',
    weekStart: 0
};

const datepickerEl = document.querySelectorAll('.datepicker-custom');

datepickerEl.forEach((el) => {
    new Datepicker(el, {
        defaultDatepickerId: null,
        autohide: true,
        format: 'dd/mm/yyyy',
        orientation: 'bottom',
        autoSelectToday: false,
        language: 'pt',
        rangePicker: false,
        locale: 'pt',
    });
});
