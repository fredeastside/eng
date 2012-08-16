<h1>Главные новости</h1>
<div class="main-news">
    [[if news]]
    [[for new_item in news]]
    [[if loop.first == 1]]
    <div class="left-info">
        <a href="/[[if not(url)]]{news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/"><img alt="img1" src="/images/sitemodul_image/{new_item.id_new}/vb{new_item.picture}"/></a>
        <div class="left-text">
            <div class="headlink"><a href="/[[if not(url)]]{news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">{new_item.name_new}</a></div>
            <span>{new_item.anons}</span>
            <div class="moreinfo"><a href="/[[if not(url)]]{news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">Подробнее</a></div>
        </div>
    </div>							
    <div class="right-info">
        <ul>
            [[else]]				
            <li><a href="/[[if not(url)]]{news_url.redir}[[else]]{url}[[endif]]/{new_item.cat_redir}/{new_item.redir_new}/">{new_item.name_new}</a></li>
            [[endif]]
            [[endfor]]
        </ul>
    </div>
    [[endif]]
</div>