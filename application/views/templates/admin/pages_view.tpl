<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 page_list">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Создание страниц и их сортировка</h3>
            </div>
            <div class="panel-body">
                <ul id="edit_pages" class="nav nav-pills nav-stacked">
                    {foreach from=$data['page'] item=val}
                        <li class="li_pages_sortable" data-id="{$val.p_id}" data-readonly="{$val.readonly}">
                            <div class="ol-lg-11 col-md-11 col-sm-11">
                                <b>{$val.p_title}</b>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1" style="text-align: right;">
                                    <a href="admintools/edit_page/page/{$val.p_id}"><span  class="glyphicon glyphicon-pencil" title="Редактировать"></span></a>
                                {if $val.readonly != 1}
                                    <span  class="glyphicon glyphicon-remove" title="Удалить" onclick="delete_page(this);"></span>
                                {/if}
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
        <div class="pg-btn-container">
            <button class="btn btn-primary">
                + Добавить страницу
            </button>
            <button id="save_changes" class="btn btn-success" disabled="disabled" onclick="save_page_sort(this)">
                Сохранить изменения
            </button>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        {*<textarea class="ck_editor">

        </textarea>*}
    </div>
</div>



