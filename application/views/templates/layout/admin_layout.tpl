<html>
<head>
    {include file="application/views/templates/block/admin_head.tpl"}
</head>
<body>
<div class="container base-container">
    <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    {*<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>*}
                    <a class="navbar-brand" href="admintools/">Админка</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Записи<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admintools/records/">Список записей</a></li>
                                <li><a href="admintools/add_records/">Добавить запись</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Навигация<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admintools/menus_list/">Список меню</a></li>
                                <li><a href="admintools/add_menus/">Добавить меню</a></li>
                            </ul>
                        </li>

                        <li><a href="admintools/users/">Пользователи</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span>{$smarty.session.login}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admintools/logout/">Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- Вывод содержимого страницы из шаблона -->
                <div class="template_view">
                    {$template_file = $data['template_path']|cat:$data['content_view']}
                    {include file="$template_file"}
                </div>
            </div>
    </div>
</div>

<!-- Диалоговое окно alert -->
<div class="modal alert-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_dialog();">
                    ×
                </button>
                <h4 class="modal-title">Информация</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="close_dialog();">
                    OK
                </button>
                <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<!-- Диалоговое окно confirm -->
<div id="confirm-modal" class="modal confirm-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_dialog();">
                    ×
                </button>
                <h4 class="modal-title">Информация</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="submit-btn btn btn-success" data-dismiss="modal">
                    Подтвердить
                </button>

                <button type="button" class="abort-btn btn btn-default" data-dismiss="modal">
                    Отмена
                </button>
                <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
</body>
</html>