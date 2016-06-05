<html>
<head>
    {include file="application/views/templates/block/head.tpl"}
</head>
<body>
<div class="container base-container">
    <div class="row">
        <header class="page-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1>Пример заголовка страницы <small>Дополнительный текст</small></h1>
        </header>
    </div>
    <div class="row">

    </div>
    <div class="row">
        {include file="../block/vertical_menu.tpl"}
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <!-- Вывод текстра страницы из БД, если таковой имеется -->
            {if !empty($data['page']['p_text'])}
                {$data['page']['p_text']}
            {/if}

            <!-- Вывод содержимого страницы из шаблона -->
            <div class="template_view">
                {$template_file = $data['template_path']|cat:$data['content_view']}
                {include file="$template_file"}
            </div>
        </div>
    </div>
    <div class="row">
        <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Футер</h3>
        </footer>
    </div>
</div>
</body>
</html>