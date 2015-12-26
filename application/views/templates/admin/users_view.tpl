<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Список существующих записей</h3>
        </div>

        <p>
            <a href="admintools/add_user" role="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Добавить пользователя</a>
        </p>

        {if empty($data['users'])}
            <h4>Нет пользователей, как ты вообще сюда попал? 0_о</h4>
        {else}
            <table id="users_list" class="table table-striped">
                <thead>
                <tr class="bg-primary">
                    <th>Логин</th>
                    <th>Роль</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$data['users'] item=user}
                    <tr data-user-id="{$user.id_user}" data-user-login="{$user.login}">
                        <td>{$user.login}                                                                   </td>
                        <td>{$user.role}                                                                    </td>
                        <td><a href="admintools/edit_user/user/{$user.id_user}">Редактировать</a>           </td>
                        <td><p class="drop_item" onclick="ask_about_drop_user(this);">Удалить</p>           </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        {/if}
    </div>
</div>