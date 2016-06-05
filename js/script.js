/*
    СОДЕРЖАНИЕ

    1. Константы и глобальные переменные
    2. Общие функции
        2.1  Новости
    3. DOCUMENT READY
 */


//--------  1. КОНСТАНТЫ И ГЛОБАЛЬНЫЕ ПЕРЕМЕННЫЕ --------------- //
var SITE_NAME = "http://localhost/flippy/";
/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
        'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
        'Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false
};
$.datepicker.setDefaults($.datepicker.regional['ru']);
//-------- 2. ОБЩИЕ ФУНКЦИИ START --------------- //

// 2.1 НОВОСТИ =============================


//==========================================


//-------- 3. DOCUMENT READY START --------------- //
$(document).ready(function(){
    //Аккордион
    $( ".accordion" ).accordion({
        heightStyle: "content"
    });

    $("#datepicker").datepicker();


});
