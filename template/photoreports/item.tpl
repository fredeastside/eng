[[ extends  TEMPLATE_PATH ~ "base/main.tpl" ]]
[[block content]]
[[ include TEMPLATE_PATH ~ "blocks/left_side.tpl"]]
<div class="right-block">

    <div class="cucumbers">
        <a href="/">Главная</a> 
        <span>/</span> <a href="/{reports_url.redir}/">{reports_url.caption}</a> <span>/</span>
        {item.name}
    </div>
    
    <h1>{item.name}</h1>
    
    [[if photos]]
    <div class="photos">
        [[for photo in photos]]
            <div class="photo">
                <a href="/images/galleries/{photo.id_catalog}/{photo.image}" class="show" title="{photo.title}">
                    <img src="/images/galleries/{photo.id_catalog}/thumbs/{photo.image}" alt="" />
                </a>
            </div>
        [[endfor]]
    </div>
    [[endif]]
    
    {item.text|raw}

</div>
[[endblock]]