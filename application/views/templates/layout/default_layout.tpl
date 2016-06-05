<html>
<head>
    {include file="application/views/templates/block/head.tpl"}
</head>
<body>
<div class="container base-container">
    <header class="site-header row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            <img src="./img/logo-primary.png" height="150px" title="flippy">
        </div>
        <div class="right-header col-lg-7 col-md-7 col-sm-7 col-xs-7">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form class="navbar-form navbar-right" role="search">
                        <button type="submit" class="search-btn btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        <div class="form-group">
                            <input class="form-control grid-width-100" placeholder="Поиск..." type="text">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="right-block col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <blockquote class="blockquote-reverse">
                        <p>Следующее высказывание — правда. Предыдущее — ложь!</p>
                        <small class="text-primary">Джордж Карлин</small>
                    </blockquote>
                    <hr class="head-hr">
                </div>
            </div>

        </div>
    </header>
    <div class="row">
        {include file="../block/vertical_menu.tpl"}
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <!-- Вывод содержимого страницы из шаблона -->
            <div class="template_view">
                {$template_file = $data['template_path']|cat:$data['content_view']}
                {include file="$template_file"}
            </div>
        </div>
    </div>
    <div class="row">
        <hr>
        <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p>Футер</p>
        </footer>
    </div>
</div>
</body>
</html>