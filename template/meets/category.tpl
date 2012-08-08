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
    
    <h1>{item.name}</h1>
    
    [[if categories]]
        <div class="afisha-topic">
        [[for item in categories]]
             <a href="/[[if not(url)]]{meet_url}[[else]]{url}[[endif]]/{item.redir}/" [[if request.modul == item.redir]]class="active"[[endif]]>{item.name}</a>
        [[endfor]]
        </div>
    [[endif]]
    
    [[ include TEMPLATE_PATH ~ "blocks/meet_filter.tpl"]]
    
    [[if meets]]
    [[for item in meets]]
    <div class="event-header">
        <a href="/[[if not(url)]]{meet_url}[[else]]{url}[[endif]]/{item.cat_redir}/{item.redir_meet}/">{item.name_meet}</a>
    </div>
    [[if item.picture]]<img class="event-image" src="/images/sitemodul_image/meets/{item.id_meets}/vm{item.picture}" alt="image">[[endif]]
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