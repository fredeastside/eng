[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block content]]
[[ include TEMPLATE_PATH ~ "blocks/left_side.tpl"]]

<div class="right-block">

    <div class="cucumbers">
        <a href="/">Главная </a>
        <span>/</span>
        [[for bread_crumb in breadcrubs]]
	    [[if loop.last]]
                {bread_crumb.caption}
	    [[else]]
                <a href="/{bread_crumb.redir}/{bread_crumb.id}/">{bread_crumb.caption}</a> <span>/</span>
	    [[endif]]
        [[endfor]]
    </div>
    
    <h1>{modul_params.caption}</h1><br/>
    
    [[if reports]]
        [[for item in reports]]
            <div class="event-header">
                <a href="/[[if not(url)]]{reports_url}[[else]]{url}[[endif]]/{item.redir}/">{item.name}</a>
            </div>
            [[if item.picture]]<img class="event-image" src="/images/sitemodul_image/gallery/{item.id}/vm{item.picture}" alt="image">[[endif]]
            <p class="paragraphtoimage">
            </p>
        [[endfor]]
        
        [[if pag_menu]]
            <div class="pager" align="center">
                {pag_menu|raw}
            </div>
        [[endif]]
        
    [[endif]]

</div>
[[endblock]]