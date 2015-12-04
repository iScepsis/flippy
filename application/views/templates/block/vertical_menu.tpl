<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <ul class="nav nav-pills nav-stacked" style="max-width: 260px">
        {foreach from=$data['layout']['menu'] key=key item=val}
            <li {if $data['layout']['menu'][$key]['p_view'] == $data['controller_name']} class="active" {/if}>
                <a href="{$data['layout']['menu'][$key]['p_view']}">
                    {$data['layout']['menu'][$key]['p_title']}
                </a>
            </li>
        {/foreach}
    </ul>
</div>