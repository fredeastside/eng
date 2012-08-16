[[if business_news]]
<div class="blockmidleft sosedbackground">
    <h2 class="block-name"><em>Бизнес</em></h2>
    <div class="cl"></div>
    <div>
        [[for new_item in business_news]]
        [[if loop.first == 1]]
        <div class="left-info">
            <a href="/[[if not(url)]]{business_news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/"><img alt="img1" src="/images/sitemodul_image/business/{new_item.id_new}/mini{new_item.picture}"/></a>
            <div class="left-text">
                <div class="headlink"><a href="/[[if not(url)]]{business_news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">{new_item.name_new}</a></div>
                <span>{new_item.anons}</span>
            </div>
        </div>
        <div class="right-info">
            <ul>
        [[else]]
                <li><a href="/[[if not(url)]]{business_news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">{new_item.name_new}</a></li>
        [[endif]]
        [[endfor]]
            </ul>
        </div> 
    </div>
    <div class="cl"></div>
    <div class="placessmall">
        [[for item in business_categories]]
        <a href="/[[if not(url)]]{business_news_url.redir}[[else]]{url}[[endif]]/{item.redir}/">{item.name}</a>
        [[endfor]]
    </div>
    <div class="events-all"><a href="/[[if not(url)]]{business_news_url.redir}[[else]]{url}[[endif]]/">Все новости бизнеса</a></div>

</div>
[[endif]]