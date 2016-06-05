<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Список существующих записей</h3>
        </div>

        {if empty($data['records'])}
            <h4>Нет доступных записей</h4>
        {else}
        <table id="records_list" class="table table-striped">
            <thead>
                <tr class="bg-primary">
                    <th>Имя записи</th>
                    <th>Имя шаблона</th>
                    <th>Дата создания</th>
                    <th>Создатель</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$data['records'] item=record}
                    <tr data-record-id="{$record.id_record}" data-record-name="{$record.name_record}">
                        <td><a href="admintools/edit_record/record/{$record.id_record}">{$record.name_record}</a></td>
                        <td>{$record.tpl_name}                                                                   </td>
                        <td>{$record.creation_date|date_format:"%d.%m.%Y %H:%M"}                                 </td>
                        <td>{$record.creator}                                                                    </td>
                        <td><a href="admintools/edit_record/record/{$record.id_record}">Редактировать</a>        </td>
                        <td><p class="drop_item" onclick="ask_about_drop(this);">Удалить</p>                   </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        {/if}
    </div>
</div>