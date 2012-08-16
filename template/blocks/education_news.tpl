[[if education_news]]
<div class="blockmidleft">
    <h2 class="block-name"><em>Образование</em></h2>
    <div class="cl"></div>
    <div>
        [[for new_item in education_news]]
        [[if loop.first == 1]]
        <div class="left-info">
            <a href="/[[if not(url)]]{education_news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/"><img alt="img1" src="/images/sitemodul_image/education/{new_item.id_new}/mini{new_item.picture}"/></a>
            <div class="left-text">
                <div class="headlink"><a href="/[[if not(url)]]{education_news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">{new_item.name_new}</a></div>
                <span>{new_item.anons}</span>
            </div>
        </div>
        <div class="right-info">
            <ul>
        [[else]]
                <li><a href="/[[if not(url)]]{education_news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">{new_item.name_new}</a></li>
        [[endif]]
        [[endfor]]
            </ul>
        </div> 
    </div>
    <div class="cl"></div>
    <div class="placessmall">
        [[for item in education_categories]]
        <a href="/[[if not(url)]]{education_news_url.redir}[[else]]{url}[[endif]]/{item.redir}/">{item.name}</a>
        [[endfor]]
    </div>
    <div class="events-all"><a href="/[[if not(url)]]{education_news_url.redir}[[else]]{url}[[endif]]/">Все новости образования</a></div>

</div>
[[endif]]