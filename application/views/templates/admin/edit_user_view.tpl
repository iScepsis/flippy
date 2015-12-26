<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Изменение учетной записи пользователя "{$data.user.login}" </h3>
        </div>

        <div class="edit_user" data-record-id="{$data.user.id_user}">
            <p>
                <b>
                    Пароль:
                </b>
            </p>
            <p>
                <input name="password" type="password" class="form-control" maxlength="20" width="100%"
                       title="Минимальная длинна - 3 символа, максимальная - 20. Пароль может содержать цифры,
                              латинские символы, знаки - и _"/>
            </p>

            <div class="incorrect-pswd alert alert-danger" style="display: none">Некорректный пароль. Минимальная длинна - 3 символа,
                максимальная - 20. Пароль может содержать цифры, латинские символы, знаки - и _</div>

            <p>
                <b>
                    Повторите пароль:
                </b>
            </p>
            <p>
                <input name="repeat_password" type="password" class="form-control" maxlength="20" width="100%" />
            </p>

            <div class="mismatch-pswd alert alert-danger" style="display: none">Пароли не совпадают</div>

            <p>
                <b>
                    Права пользователя
                </b>
            </p>

            <select name="role" class="form-control">
                <option value="Администратор" {if $data.user.role == "Администратор"}selected{/if}>Администратор</option>
                <option value="Пользователь"  {if $data.user.role == "Пользователь"} selected{/if}>Пользователь</option>
            </select>

            <br>

            <p>
                <button class="save-btn btn btn-success" onclick="update_user(this);">
                    Сохранить изменения
                </button>
            </p>
        </div>
    </div>
</div>