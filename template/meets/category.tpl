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
    
    <div class="midbackground">
        <div class="midbackbot">
            <div class="midbackmid townback">
                <h3>Поиск событий города</h3>
                <form action="" method="post">
                    <input type="hidden" name="action" value="search" />
                    <div class="inputtext">
                        <input name="search_string" value="" />
                        [[if categories]]
                        <select name="event_category" onchange="">
                            <option valie="">Выберите категорию</option>
                            [[for item in categories]]
                            <option value="{item.id}">{item.name}</option>
                            [[endfor]]
                        </select>
                        [[endif]]

                        <select name="event_date" onchange="">
                            <option value="">Выберите дату</option>
                            <option value="today">Сегодня</option>
                            <option value="yersterday">Вчера</option>
                            <option value="week">Неделя</option>
                            <option value="month">Месяц</option>
                        </select>
                        <a href="#" class="search" onclick="setSearch(); return false;">Найти</a>
                        <br/>
                        <a href="#" class="selectbydate">Выбрать по числу</a>
                    </div>                        
                </form>
            </div>
        </div>
    </div>
    
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