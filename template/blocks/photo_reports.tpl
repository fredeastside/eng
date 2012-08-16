[[if reports]]
    [[for item in reports]]
<div class="img-hoverlink">
    <div class="hoverlink"><a href="/[[if not(url)]]{reports_url.redir}[[else]]{url}[[endif]]/{item.redir}/">{item.name}</a></div>
    <img src="/images/sitemodul_image/gallery/{item.id}/mini{item.picture}" alt=""/>            
</div>
    [[endfor]]
[[endif]]