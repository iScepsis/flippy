//----------- DOCUMENT READY ---------------//
$(function() {
    //Добавление разделов для меню в админке
    $( ".sortable" ).sortable({
        revert: true
    });

    //Редактирование разделов для меню
    $( "#edit_sections, #drop_sections" ).sortable({
        revert: true,
        connectWith: ".menu_elements"
    }).disableSelection();

    $(".ck_editor").ckeditor();

    $( "#combobox" ).combobox();

    //Событие клика по добавленному разделу в меню сортировки
    $(".menu_elements").on("click", ".add-menu-sortable", function(){
        onclick_section(this);
    });

    //Подсказка для стрелки предпросмотра при выводи списка меню
    $('.glyphicon-arrow-down').tooltip();



});
//----------- END DOCUMENT READY ---------------//
var droped_record_id = '';

var defObj = {
    type: 'post',
    url:  'handler.php',
    data: {},
    success: function(data){
        if(data){
            alert(data);
        }
    },
    error: function(e, str, t){
        alert(e.status + ' ||| ' + e.statusText + ' ||| ' + e.responseText  + ' ||| ' + str + ' ||| ' + t);
    }
};

/**Показать диалоговое окно
 *
 * @param str - Содержимое окна
 * @param title - Заголовок окна
 */
function show_dialog(str, title){
    title = title || 'Информация';
    var am = $('.alert-modal');
    $(am).find('.modal-title').text(title);
    $(am).find('.modal-body').html(str);
    $(am).fadeIn(300);
}

/**
 * Скрыть диалоговые окна
 */
function close_dialog(){
    $('.modal').fadeOut(300);
}

/**
 * Вызов диалогового окна на подобии confirm в js
 *
 * @param str - текст, выводимый в теле диалогового окна
 * @param funcName - имя функции, вызываемой в случае положительного ответа на вопрос
 * @param title - заголовок диалогового окна
 */
function show_confirm(str, callback, title){
    title = title || 'Информация';
    var cf = $('.confirm-modal');
    var submitBtn = $(cf).find('.submit-btn'); //Кнопка "Подтвердить"
    var abortBtn = $(cf).find('.abort-btn');

    $(cf).find('.modal-title').text(title);
    $(cf).find('.modal-body').html(str);

    //Удаляем старые и вешаем новые обработчики событий на кнопки диалогового окна
    $(submitBtn).unbind('click');
    $(abortBtn).unbind('click');

    $(submitBtn).on('click', function(){ callback(); });
    $(abortBtn).on('click', function(){ close_dialog(); });

    $(cf).fadeIn(300);
}

/**Сохранение записи
 *
 * @param obj - объект из которого инициировано сохранение анкеты
 */
function save_record(obj){
    var parent      = $(obj).closest('.new_record');
    var name_record = $(parent).find('input[name="name_record"]').val();
    var tpl_name    = $(parent).find('input[name="tpl_name"]').val();
    var text_record = $(parent).find('textarea[name="text_record"]').val();

    //Проверка введенных значений
    if (name_record.length < 3) {
        show_dialog("Имя записи должно состоять не менее чем из 3 символов");
        return;
    }
    if (tpl_name.length > 0) {
        if (tpl_name.length < 3) {
            show_dialog("Имя шаблона должно состоять не менее чем из 3 символов латинского алфавита");
            return;
        }
        var regexp = /^[a-zA-Z0-9]+([a-zA-Z\_0-9-]*)$/;
        if (!regexp.test(tpl_name)) {
            show_dialog("Имя шаблона содержит недопустимые символы");
            return;
        }
    }
    if (name_record.length < 3) {
        show_dialog("Слишком короткое имя записи - менее 3 символов");
        return;
    }

    //Передача данных скрипту для записи в БД и шаблон
    var tObj = Object.create(defObj);
    tObj.url = 'admintools/save_record/';

    tObj.data = Object.create(defObj.data);
    tObj.data.name_record = name_record;
    tObj.data.tpl_name    = tpl_name;
    tObj.data.text_record = text_record;

    tObj.success = function(data){
        if (parseInt(data) != data) {
            show_dialog(data, 'Ошибка');
        } else {
            show_dialog('Запись "<b>' + tObj.data.name_record + '"</b> успешно сохранена.');
        }
    }
    $.ajax(tObj);
}

/**
 * Обновление записи
 * @param obj - элемент из которого был инициирован вызов функции
 */
function update_record(obj){
    var parent      = $(obj).closest('.edit_record');
    var id_record   = $(parent).attr('data-record-id');
    var name_record = $(parent).find('input[name="name_record"]').val();
    var tpl_name    = $(parent).find('input[name="tpl_name"]').val();
    var text_record = $(parent).find('textarea[name="text_record"]').val();

    //Проверка введенных значений
    if (name_record.length < 3) {
        show_dialog("Имя записи должно состоять не менее чем из 3 символов");
        return;
    }
    if (tpl_name.length > 0) {
        if (tpl_name.length < 3) {
            show_dialog("Имя шаблона должно состоять не менее чем из 3 символов латинского алфавита");
            return;
        }
        var regexp = /^[a-zA-Z0-9]+([a-zA-Z\_0-9-]*)$/;
        if (!regexp.test(tpl_name)) {
            show_dialog("Имя шаблона содержит недопустимые символы");
            return;
        }
    }
    if (name_record.length < 3) {
        show_dialog("Слишком короткое имя записи - менее 3 символов");
        return;
    }

    //Передача данных скрипту для записи в БД и шаблон
    var tObj = Object.create(defObj);
    tObj.url = 'admintools/update_record/';

    tObj.data = Object.create(defObj.data);
    tObj.data.id_record   = id_record;
    tObj.data.name_record = name_record;
    tObj.data.tpl_name    = tpl_name;
    tObj.data.text_record = text_record;

    tObj.success = function(data){
        if (parseInt(data) != data) {
            show_dialog(data, 'Ошибка');
        } else {
            show_dialog('Запись "<b>' + tObj.data.name_record + '"</b> успешно обновлена.');
        }
    }
    $.ajax(tObj);
}

function ask_about_drop(obj){
    droped_record_id = $(obj).closest('tr').attr('data-record-id');
    var record_name = $(obj).closest('tr').attr('data-record-name');
    var str = "Вы действительно хотите удалить запись: <br> " + record_name;
    var title = "Подтверждение удаления записи";
    show_confirm(str, drop_record, title);
}

/**
 * Удаление записи
 *
 */
function drop_record(){
    close_dialog();

    var tObj = Object.create(defObj);
    tObj.url = 'admintools/drop_record/';

    tObj.data = Object.create(defObj.data);
    tObj.data.id_record = droped_record_id;

    tObj.success = function(data){
        if (parseInt(data) != data) {
            show_dialog(data, 'Ошибка');
        } else {
            $('#records_list').find('tr[data-record-id="' + droped_record_id + '"]').slideUp(300);
            droped_record_id = '';
        }
    }
    $.ajax(tObj);
}

function show_step_two(obj){
    $(obj).closest('.step_one').slideUp(300);
    $(obj).closest('.add_menu').find('.step_two').slideDown(400);
}

/**
 * Создание раздела
 */
function create_section(){
    $('.sortable').find('.add-menu-sortable-active').removeClass('add-menu-sortable-active');

    var section = '<li class="add-menu-sortable add-menu-sortable-active ui-state-default" data-text_record="" ' +
        'data-fid_record="" data-request_type="" data-html_id="">Новый раздел</li>';

    $('.sortable').append(section);
    $('.sortable').find('.add-menu-sortable-active').trigger('click');
}

/**
 * Функция вызываемая при клике на раздел в меню сортировки перед сохранение меню, показывает данные о разделе
 * @param obj
 */
function onclick_section(obj){
    $('.add-menu-sortable').removeClass('add-menu-sortable-active');
    $(obj).addClass('add-menu-sortable-active');

    $('.create_section').find('input[name="section_name"]').val($(obj).text());
    $('#combobox').combobox('setVal', $(obj).attr('data-text_record'), $(obj).attr('data-fid_record'));
    $('.create_section').find('input[name="request_type"]').val($(obj).attr('data-request_type'));
    $('.create_section').find('input[name="html_id"]').val($(obj).attr('data-html_id'));

    $('.change_section').fadeIn(300);
}

//Изменение имени активного раздела в редакторе меню
function change_section_name(obj){
    var changed = $('.add-menu-sortable-active');

    $(changed).text($(obj).val());
}

//Изменение выбранной записи
function change_record_info(){
    var changed = $('.add-menu-sortable-active');
    var fid_record = $('#combobox').combobox('getVal');

    console.log(fid_record);
    //console.log(changed);

    $(changed).attr('data-text_record', fid_record['text']);
    $(changed).attr('data-fid_record', fid_record['value']);
}

//Изменение типа обращения
function change_request_type(obj){
    var changed = $('.add-menu-sortable-active');

    $(changed).attr('data-request_type', $(obj).val());
}

//Изменение html id
function change_html_id(obj){
    var changed = $('.add-menu-sortable-active');

    $(changed).attr('data-html_id', $(obj).val());
}


/*function change_section(){
    var changed = $('.add-menu-sortable-active');
    var fid_record = $('#combobox').combobox('getVal');

    $(changed).text($('.create_section').find('input[name="section_name"]').val());
    $(changed).attr('data-text_record', fid_record['text']);
    $(changed).attr('data-fid_record', fid_record['value']);
    $(changed).attr('data-request_type', $('.create_section').find('input[name="request_type"]').val());
    $(changed).attr('data-html_id', $('.create_section').find('input[name="html_id"]').val());

    $('.change_section').fadeOut(300);
}*/

/**
 * Сохранение меню
 */
function save_menu(){
    var parent = $('.add_menu');
    $(".save_menu-btn").prop('disabled', true);

    //Создание меню
    var menu_name = $(parent).find('input[name="menu_name"]').val();
    var typeMenu = $(parent).find('input[name="typeMenu"]:checked').val();
    var menu_class = $(parent).find('input[name="menu_class"]').val();

    var tObj = Object.create(defObj);
    tObj.url = 'admintools/create_menu/';
    tObj.data = Object.create(defObj.data);
    tObj.data.menu_name  = menu_name;
    tObj.data.typeMenu   = typeMenu;
    tObj.data.menu_class = menu_class;

    tObj.data.sections = {};
        //Создание разделов
    $('.add-menu-sortable').each(function(key, section){
        tObj.data.sections[key] = {};
        tObj.data.sections[key]['section_name'] = $(section).text();
        tObj.data.sections[key]['fid_record']   = $(section).attr('data-fid_record');
        tObj.data.sections[key]['request_type'] = $(section).attr('data-request_type');
        tObj.data.sections[key]['html_id']      = $(section).attr('data-html_id');
        tObj.data.sections[key]['section_sort'] = key;
    });

    tObj.success = function(data){
        $(".save_menu-btn").prop('disabled', false);
        show_dialog(data);
    }

    tObj.error = function(data){
        $(".save_menu-btn").prop('disabled', false);
        show_dialog(data, 'Ошибка');
    }

    $.ajax(tObj);
}

/**
 * Показать превью для меню
 *
 * @param obj
 * @param menu_fid
 */
function show_menu_preview(obj, menu_fid){
    $(obj).hide();
    $(obj).next('.glyphicon-arrow-up').show();
    var parent = $(obj).closest('tr');
    var next_tr = $(parent).next('tr');
    var menu = $(next_tr).find('.menu_preview');

    var tObj = Object.create(defObj);
    tObj.url = 'admintools/show_menu_preview/';
    tObj.data = Object.create(defObj.data);
    tObj.data.menu_fid = menu_fid;

    $(next_tr).slideDown(300);

    tObj.success = function(data){
        if (is_json(data)) {
            var d = $.parseJSON(data);

            for (var key in d) {
                $(menu).append('<li><a href="#menus_list">' + d[key]['name_section'] + '</a></li>');
            }
            $(next_tr).find('.menu_loader').hide();
        } else {
            show_dialog(data, "Ошибка");
        }
    }

    if ($.trim($(menu).html()) == '') {
        $.ajax(tObj);
    }
}

/**
 * Cкрыть превью меню
 *
 * @param obj
 */
function hide_menu_preview(obj){
    $(obj).hide();
    $(obj).prev('.glyphicon-arrow-down').show();
    var next_tr = $(obj).closest('tr').next('tr');
    $(next_tr).slideUp();
}


function edit_menu(obj){
    var parent = $(obj).closest('.edit_menu');

    //Основная информация по меню
    var menu_id     = $(parent).find('input[name="menu_id"]').val();
    var tpl_file    = $(parent).find('input[name="tpl_file"]').val();
    var menu_name   = $(parent).find('input[name="menu_name"]').val();
    var typeMenu    = $(parent).find('input[name="typeMenu"]:checked').val();
    var menu_class  = $(parent).find('input[name="menu_class"]').val();

    var tObj = Object.create(defObj);
    tObj.url = 'admintools/update_menu/';
    tObj.data = Object.create(defObj.data);
    tObj.data.menu_id    = menu_id;
    tObj.data.tpl_file   = tpl_file;
    tObj.data.menu_name  = menu_name;
    tObj.data.typeMenu   = typeMenu;
    tObj.data.menu_class = menu_class;

    tObj.data.sections = {};
    //Редактирование разделов
    $('#edit_sections>li').each(function(key, section){
        tObj.data.sections[key] = {};
        tObj.data.sections[key]['section_name'] = $(section).text();
        tObj.data.sections[key]['fid_record']   = $(section).attr('data-fid_record');
        tObj.data.sections[key]['request_type'] = $(section).attr('data-request_type');
        tObj.data.sections[key]['html_id']      = $(section).attr('data-html_id');
        tObj.data.sections[key]['section_sort'] = key;
        if ($(section).attr('data-id_section')) {
            tObj.data.sections[key]['id_section'] = $(section).attr('data-id_section');
        }
    });

    //Удаление разделов
    var counter = Object.keys(tObj.data.sections).length;
    $('#drop_sections>li').each(function(key, section){
        counter++;
        //Если раздел существовал ранее, помечаем, и отправляем на сервер, а если был добавлен и после удален - скрываем
        if ($(section).attr('data-id_section')) {
            tObj.data.sections[counter] = {};
            tObj.data.sections[counter]['id_section'] = $(section).attr('data-id_section');
            tObj.data.sections[counter]['deleted'] = true;
        } else {
            $(section).fadeOut(300);
        }
    });

    tObj.success = function(data){
        $(".save_menu-btn").prop('disabled', false);
        show_dialog(data);
    }

    tObj.error = function(data){
        $(".save_menu-btn").prop('disabled', false);
        show_dialog(data, 'Ошибка');
    }

    $.ajax(tObj);
}


// JQUERY COMBOBOX //

$.widget( "custom.combobox", {

    _create: function() {
        this.wrapper = $( "<span>" )
            .addClass( "custom-combobox" )
            .insertAfter( this.element );

        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
    },

    _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
            value = selected.val() ? selected.text() : "";

        this.input = $( "<input>" )
            .appendTo( this.wrapper )
            .val( value )
            .attr( "title", "" )
            .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: $.proxy( this, "_source" )
            })
            .tooltip({
                tooltipClass: "ui-state-highlight"
            });

        this._on( this.input, {
            autocompleteselect: function( event, ui ) {
                ui.item.option.selected = true;
                this._trigger( "select", event, {
                    item: ui.item.option
                });
                this.e_value = ui.item.option.value;
                this.e_text  = ui.item.label;

                //вызываем событие onchange у родительского элемента
                this.element.trigger('change');
            },

            autocompletechange: "_removeIfInvalid"
        });
    },

    //Установка значения
    setVal: function(text, value){
        this.element.val(text);
        this.input.val(text);
        this.e_value = value;
        this.e_text = text;
    },

    //Получение значений
    getVal: function() {
        return {
            value: this.e_value,
            text: this.e_text
        }
    },

    _createShowAllButton: function() {
        var input = this.input,
            wasOpen = false;

        $( "<a>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Показать все" )
            .tooltip()
            .appendTo( this.wrapper )
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass( "ui-corner-all" )
            .addClass( "custom-combobox-toggle ui-corner-right" )
            .mousedown(function() {
                wasOpen = input.autocomplete( "widget" ).is( ":visible" );
            })
            .click(function() {
                input.focus();

                // Close if already visible
                if ( wasOpen ) {
                    return;
                }

                // Pass empty string as value to search for, displaying all results
                input.autocomplete( "search", "" );
            });
    },

    _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
            var text = $( this ).text();
            //var val = $( this ).val();
            if ( this.value && ( !request.term || matcher.test(text) ) )
                return {
                    label: text,
                    value: text,
                    option: this
                };
        }) );
    },

    _removeIfInvalid: function( event, ui ) {

        // Selected an item, nothing to do
        if ( ui.item ) {
            return;
        }

        // Search for a match (case-insensitive)
        var value = this.input.val(),
            valueLowerCase = value.toLowerCase(),
            valid = false;
        this.element.children( "option" ).each(function() {
            if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                this.selected = valid = true;
                return false;
            }
        });

        // Found a match, nothing to do
        if ( valid ) {
            return;
        }

        // Remove invalid value
        this.input
            .val( "" )
            .attr( "title", value + " didn't match any item" )
            .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
            this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
    },

    _destroy: function() {
        this.wrapper.remove();
        this.element.show();
    }


});

function is_json(str){
    try
    {
        var json = $.parseJSON(str);
        return true;
    }
    catch(err)
    {
        return false;
    }
}