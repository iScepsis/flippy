<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Создание новой учетной записи</h3>
        </div>

        <div class="add_user">
            <p>
                <b>
                   Логин:
                </b>
            </p>
            <p>
                <input name="login" type="text" class="form-control" maxlength="20" width="100%"
                       title="Минимальная длинна - 3 символа, максимальная - 20. Логин должен начинаться на латинскую
                              букву и может содержать цифры, латинские символы, знаки - и _"/>
            </p>

            <div class="incorrect-login alert alert-danger" style="display: none">Некорректный логин. Минимальная длинна - 3 символа,
                максимальная - 20. Логин должен начинаться на латинскую букву и может содержать цифры, латинские
                символы, знаки - и _</div>

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
                    Права пользователя:
                </b>
            </p>

            <select name="role" class="form-control">
                <option value="Администратор">Администратор</option>
                <option value="Пользователь">Пользователь</option>
            </select>

            <br>

            <p>
                <button class="save-btn btn btn-success" onclick="create_user(this);">
                    Сохранить изменения
                </button>
            </p>
        </div>
    </div>
</div>