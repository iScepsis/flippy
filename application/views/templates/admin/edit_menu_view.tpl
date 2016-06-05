<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        {$menu_base = $data.menu_edit.base}
        {$menu_sections = $data.menu_edit.sections}
        <div class="well">
            <h3>Редактирование меню "{$menu_base.name_menu}"</h3>
        </div>

        <div class="edit_menu">
            <p>
                <b>
                    Название меню
                </b>
            </p>
            <input name="menu_id" type="hidden" value="{$menu_base.id_menu}" />
            <input name="tpl_file" type="hidden" value="{$menu_base.tpl_file}" />
            <p>
                <input name="menu_name" type="text" value="{$menu_base.name_menu}" class="form-control" maxlength="200" width="100%"/>
            </p>
            <p>
                <b>
                    Тип меню
                </b>
            </p>
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <p>
                        <img src="img/admin/tabs.jpg" alt="Вкладки" />
                    </p>
                    <label>
                        <input type="radio" name="typeMenu" value="1" {if $menu_base.type_menu="tabs"}checked=""{/if} />
                        <b><i>Вкладки</i></b>
                    </label>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-4">
                    <p>
                        <img src="img/admin/pills.jpg" alt="Кнопки" />
                    </p>
                    <label>
                        <input type="radio" name="typeMenu" value="2" {if $menu_base.type_menu="pills"}checked=""{/if} />
                        <b><i>Кнопки</i></b>
                    </label>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1">
                </div>

            </div>
            <p>
                <b>
                    Класс меню (необязательно)
                </b>
            </p>
            <p>
                <input name="menu_class" value="{$menu_base.class_menu}" class="form-control" maxlength="200" width="100%"/>
            </p>


            <div class="row">
                <div class="col-md-12">

                </div>

                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Сортировка разделов</h3>
                        </div>
                        <div class="panel-body">
                            <ul id="edit_sections" class="sortable menu_elements nav nav-pills nav-stacked">
                                {foreach from=$menu_sections item=item}
                                    <li class="add-menu-sortable ui-state-default" data-id_section="{$item.id_section}"
                                        data-text_record="{$item.name_record}"
                                        data-fid_record="{$item.id_record}"
                                        data-request_type="{$item.fid_rt}"
                                        data-html_id="{$item.html_id}">{$item.name_section}</li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                    <p>
                        <button class="btn btn-primary" onclick="create_section();">
                            <b>+ Добавить раздел</b>
                        </button>
                    </p>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2">

                </div>

                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Удаление разделов</h3>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-dismissible alert-danger">
                                Перетащите удаляемые разделы в блок ниже
                            </div>
                            <ul id="drop_sections" class="menu_elements nav nav-pills nav-stacked">

                            </ul>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="create_section">
                        <p>
                            <b>
                                Название раздела
                            </b>
                        </p>
                        <p>
                            <input name="section_name" class="form-control" onkeyup="change_section_name(this);"
                                   maxlength="200" width="100%"/>
                        </p>
                        <p>
                            <b>
                                Прикрепить запись (выберите из списка)
                            </b>
                        </p>
                        <div class="ui-widget">
                            <select id="combobox" class="fid_record" onchange="change_record_info();">
                                <option value=""></option>
                                {foreach from=$data['records_list'] item=record}
                                    <option value="{$record.id_record}">{$record.name_record}</option>
                                {/foreach}
                            </select>
                        </div>
                        <p>
                            id статуса фиксирующийся при выборе раздела (необязательно)
                        </p>
                        <p>
                            <input name="request_type" onkeyup="change_request_type(this);" class="form-control" maxlength="3" width="100%"/>
                        </p>
                        <p>
                            Уникальный идентификатор раздела (необязательно)
                        </p>
                        <p>
                            <input name="html_id" class="form-control" onkeyup="change_html_id(this);" maxlength="200" width="100%"/>
                        </p>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br />
                    <div class="pg-btn-container">
                        <button class="save_menu-btn btn btn-success" onclick="edit_menu(this);">
                            Сохранить меню
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>