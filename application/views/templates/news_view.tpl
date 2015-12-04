<!-- Выводим конкретную новость -->
{if $data['news']['mode'] == 'read'}
    {$news_data = $data['news'][0]}
    <!-- Заголовок -->
    <h2 class="news-title"> {$news_data['news_title']} </h2>
    <hr>
    <!-- Тело новости -->
    <div>
        {$news_data['text_news']}
    </div>
    <hr>
    <!-- Кол-во просмотров -->
    <p class="text-warning">Просмотров: {$news_data['views_count']}</p>
{/if}

<!-- Выводим список новостей -->
{if $data['news']['mode'] == 'list'}
    {foreach from=$data['news'] item=item}
        {if !is_array($item)}
           {continue}
        {/if}
        <div class="news-block">
            <div class="news-mini-img-div">
                <a href="news/read/{$item['id_news']}">
                    <img class="news-mini-img" src="{$item['mini_img']}" alt="{$item['news_title']}" />
                </a>
            </div>
            <div class="news-block-main">
                <a href="news/read/{$item['id_news']}">
                    <h3 class="news-title">{$item['news_title']}</h3>
                </a>
                <div class="news-block-body">
                    {$item['description']}
                </div>
                <span>{$item['date']|date_format:"%d.%m.%Y %H:%M"}</span>
            </div>
        </div>
    {/foreach}
    <div>
        {$data['news']['navigate']}
    </div>

{/if}

