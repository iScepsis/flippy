<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="new_pages">

            <div class="form-group">
                <label class="control-label" for="input1">Заголовок страницы</label>
                <input name="p_title" type="text" class="form-control" id="input1" aria-describedby="helpBlock1" maxlength="200">
                <span id="helpBlock1" class="help-block">Данный заголовок также будет использоваться также и как название страницы.</span>
            </div>

            <div class="form-group">
                <label class="control-label" for="input2">Название страницы в URL (адресной строке) <sup class="question_mark">&nbsp;?&nbsp;</sup>
                <span class="question_mark_text">
                    Данное название будет использоваться для построения адреса страницы.<br> Допускаются только
                    латинские буквы нижнего регистра, числа, знаки<br>  подчеркивания, ведущей в названии должна быть латинская буква, минимальная длинна - 2 символа.
                    Пример:<br><img src='img/question_mark_1.png' title='Пример названия страницы'>
                    </span>
                </label>
                <input name="p_view" type="text" class="form-control" id="input2" aria-describedby="helpBlock2"
                       onkeyup="check_input_for_regexp(this, regexp_check_p_view);" maxlength="15"  width="200px">
                <span id="helpBlock2" class="help-block">Допускаются только латинские буквы нижнего регистра, числа, знаки
                        подчеркивания. Ведущей в названии должна быть латинская буква.</span>
            </div>

            <div class="form-group">
                <label class="control-label" for="input3">Ключевые слова (мета-информация)</label>
                <input name="meta_key" type="text" class="form-control" id="input3" aria-describedby="helpBlock3" maxlength="200">
                <span id="helpBlock3" class="help-block">Ввводите ключевые слова храктеризующие контент страницы (рекомендуется вводить слова через зяпятую).</span>
            </div>

            <div class="form-group">
                <label class="control-label" for="input4">Краткое описание (мета-информация)</label>
                <textarea name="meta_description" id="input4" aria-describedby="helpBlock4" maxlength="2000" style="width: 100%; margin-bottom: 10px;"></textarea>
                <span id="helpBlock4" class="help-block"> Введите краткое описание характеризующее контент страницы.</span>
            </div>

            <p>
                <b>
                    Содержимое страницы
                </b>
            </p>

            <p>
                <select class="page_content form-control" style="width: 250px;  margin-bottom: 10px;" onchange="show_p_text(this);" >
                    <option value="1">Ввести текст</option>
                    <option value="2">Прикрепить запись</option>
                    <option value="3">Прикрепить меню</option>
                </select>
            </p>

            <div id="p_text">
                <textarea class="ck_editor"></textarea>

                <div id="p_text_2" class="ui-widget" style="display: none">
                    <select id="combobox_1" class="fid_record" onchange="change_record_info();">
                        <option value=""></option>
                        {foreach from=$data['records_list'] item=record}
                            <option value="{$record.id_record}">{$record.name_record}</option>
                        {/foreach}
                    </select>
                </div>

                <div id="p_text_3" class="ui-widget" style="display: none">
                    <select id="combobox_2" class="fid_menus" onchange="change_record_info();">
                        <option value=""></option>
                        {foreach from=$data['menus_list'] item=menu}
                            <option value="{$menu.id_menu}">{$menu.name_menu}</option>
                        {/foreach}
                    </select>
                </div>

            </div>
            <br />
            <div  class="pg-btn-container">
                <button class="btn btn-success" onclick="save_pages(this);">
                    Добавить страницу
                </button>
            </div>
        </div>
    </div>

</div>