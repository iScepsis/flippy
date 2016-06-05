<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Список меню</h3>
        </div>

        {if empty($data['menus'])}
            <h4>Нет доступных меню</h4>
        {else}
            <table id="menus_list" class="table table-striped">
                <thead>
                <tr class="bg-primary">
                    <th>Название меню</th>
                    <th>Тип меню</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$data['menus'] item=menus}
                    <tr data-menu-id="{$menus.id_menu}" data-menu-name="{$menus.name_record}">
                        <td><a href="admintools/edit_menu/menu/{$menus.id_menu}">{$menus.name_menu}</a></td>
                        <td>
                            {if $menus.type_menu == 'tabs'}Вкладки{elseif $menus.type_menu == 'pills'}Кнопки{/if}
                        </td>
                        <td><a href="admintools/edit_menu/menu/{$menus.id_menu}">Редактировать</a>        </td>
                        <td><p class="drop_item" onclick="ask_about_drop(this);">Удалить</p>                   </td>
                        <td style="text-align: right">
                            <span class="glyphicon glyphicon-arrow-down" title="Предпросмотр" onclick="show_menu_preview(this, {$menus.id_menu});"></span>
                            <span class="glyphicon glyphicon-arrow-up" title="Скрыть" onclick="hide_menu_preview(this);" style="display: none;"></span>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="5">
                            <div class="menu_loader">
                                <img src="img/admin/loader.GIF" />
                            </div>
                            {if $menus.type_menu}
                                <ul class="menu_preview nav nav-tabs">
                            {else}
                                <ul class="menu_preview nav nav-pills">
                            {/if}
                                </ul>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        {/if}
    </div>
</div>