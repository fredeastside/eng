[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block content]]
<div class="left-menu">
    <h1>Навигация</h1>
    [[ include TEMPLATE_PATH ~ "blocks/menu.tpl"]]
    <div class="banner-left">
        {configs.left_block|raw}
    </div>
</div>

<div class="right-block">

    <div class="cucumbers">
        <a href="/">Главная </a>
        <span>/</span>
        {item.name}
    </div>
    
    <h1>{item.name}</h1><br/>
    
    [[if news]]
        [[for item in news]]
            <div class="event-header">
                <a href="/[[if not(url)]]{news_url}[[else]]{url}[[endif]]/{item.cat_redir}/{item.redir_new}/">{item.name_new}</a>
            </div>
            [[if item.picture]]<img class="event-image" src="/images/sitemodul_image/{item.id_new}/vm{item.picture}" alt="image">[[endif]]
            <p class="paragraphtoimage">
                {item.anons|raw}
            </p>
        [[endfor]]
        
        [[if pag_menu]]
            <div class="pager" align="center">
                {pag_menu|raw}
            </div>
        [[endif]]
        
    [[endif]]
    
    {item.text|raw}

</div>
[[endblock]]