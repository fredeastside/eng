[[if meets]]  
<div class="blockmidleft">
    <h2 class="block-name"><em>Ближайшие события города</em></h2>
    <div class="cl"></div>

    <div class="block-background">
        <div class="background-bottom">
            <div class="background-mid">
                <div class="searchlink"><a href="/{meet_url.redir}/">Поиск событий</a></div>
                [[for item in meets]]
                <div class="news-item">
                    <div class="header"><a href="/[[if not(url)]]{meet_url.redir}[[else]]{url}[[endif]]/{item.cat_redir}/{item.redir_meet}/">{item.name_meet}</a></div>
                    <div class="item-text">{item.anons}</div>
                    <div class="moreinfo youaresospecial"><a href="/[[if not(url)]]{meet_url.redir}[[else]]{url}[[endif]]/{item.cat_redir}/{item.redir_meet}/">Подробнее</a></div>
                </div>
                [[endfor]]
                <div class="cl"></div>
            </div>
        </div>
    </div>
</div>
[[endif]]