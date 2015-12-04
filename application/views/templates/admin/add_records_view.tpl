<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Добавление новой записи</h3>
        </div>

        <div class="new_record">
            <p>
                <b>
                    Название записи
                </b>
            </p>
            <p>
                <input name="name_record" class="form-control" maxlength="200" width="100%" />
            </p>

            <p>
                <b>
                    Имя шаблона
                </b>
            </p>
            <p>
                <input name="tpl_name" class="form-control" maxlength="200" width="100%" />
            </p>

            <p>
                <b>
                    Содержимое записи
                </b>
            </p>

            <textarea name="text_record" class="ck_editor">
            </textarea>

            <br>

            <p>
                <button class="btn btn-success" onclick="save_record(this);">
                    Сохранить запись
                </button>
            </p>
        </div>
    </div>
</div>