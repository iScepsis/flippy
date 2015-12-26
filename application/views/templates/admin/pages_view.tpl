<div class="row">

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Создание страниц и их сортировка</h3>
            </div>
            <div class="panel-body">
                <ul id="sortable" class="nav nav-pills nav-stacked">
                    {foreach from=$data['page'] item=val}
                        <li class="ui-state-default" data-id="{$val.p_id}" data-readonly="{$val.readonly}">
                            {$val.p_title}
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
        <div class="pg-btn-container">
            <button class="btn btn-primary">
                + Добавить страницу
            </button>
        </div>
        <div class="pg-btn-container">
            <button class="btn btn-success">
                Сохранить
            </button>
        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8">

    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <textarea class="ck_editor">

        </textarea>
    </div>
</div>



