<html>
<head>
    {include file="application/views/templates/block/auth_head.tpl"}
</head>
<body>
<div class="container base-container">
    {$template_file = $data['template_path']|cat:$data['content_view']}
    {include file="$template_file"}
</div>
</body>
</html>