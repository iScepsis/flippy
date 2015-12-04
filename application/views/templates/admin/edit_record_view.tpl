<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Редактирование записи "{$data.record.name_record}"</h3>
        </div>

        <div class="edit_record" data-record-id="{$data.record.id_record}">
            <p>
                <b>
                    Название записи
                </b>
            </p>
            <p>
                <input name="name_record" class="form-control" maxlength="200" width="100%" value="{$data.record.name_record}" />
            </p>

            <p>
                <b>
                    Имя шаблона (необязательно)
                </b>
            </p>
            <p>
                <input name="tpl_name" class="form-control" maxlength="200" width="100%" value="{$data.record.tpl_name}"/>
            </p>

            <p>
                <b>
                    Содержимое записи
                </b>
            </p>

            <textarea name="text_record" class="ck_editor">
                {if $data.record.tpl_text}
                    {$data.record.tpl_text}
                {/if}
            </textarea>

            <br>

            <p>
                <button class="btn btn-success" onclick="update_record(this);">
                    Сохранить запись
                </button>
            </p>
        </div>
    </div>
</div>